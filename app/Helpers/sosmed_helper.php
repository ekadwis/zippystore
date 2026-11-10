<?php

if (! function_exists('hitung_harga_sosmed')) {
    /**
     * Hitung harga sosmed berdasarkan rules:
     * - Khusus Views (min 1.000):
     *   1k = 2.000
     *   10k = 15.000
     *   100k = 110.000 (kelipatan 100k dihitung 110.000 / 100k = 1.100 per 1k)
     * - Khusus Followers / Likes:
     *   Sesuai tier paket yang tersedia secara proporsional.
     *
     * @param array $pakets  Array paket layanan (harus berisi ['jumlah','harga']), urut jumlah ASC.
     * @param int   $jumlah  Quantity yang diminta user.
     * @param bool  $isViews Apakah tipe layanan ini views
     * @return array         ['harga'=>int, 'unit'=>float, 'tier'=>string]
     */
    function hitung_harga_sosmed(array $pakets, int $jumlah, bool $isViews = false): array
    {
        if ($jumlah <= 0) {
            return ['harga' => 0, 'unit' => 0, 'tier' => '-'];
        }

        // 1. RULES KHUSUS VIEWS
        if ($isViews) {
            if ($jumlah < 1000) {
                return ['harga' => 0, 'unit' => 0, 'tier' => 'invalid_min'];
            }

            if ($jumlah >= 100000) {
                // Kelipatan 100k views = 110.000
                // Misal 150k -> (150.000 / 100.000) * 110.000 = 165.000
                $harga = ($jumlah / 100000) * 110000;
                $tier = '>=100k (Rate Rp 110.000 / 100k)';
            } elseif ($jumlah >= 10000) {
                // Di antara 10k s/d 99.999 -> proporsional dari 10k (15.000 / 10k = 1.500 per 1k)
                $harga = ($jumlah / 10000) * 15000;
                $tier = '10k-99k (Rate Rp 15.000 / 10k)';
            } else {
                // Di antara 1k s/d 9.999 -> proporsional dari 1k (2.000 / 1k = 2 per view)
                $harga = ($jumlah / 1000) * 2000;
                $tier = '1k-9k (Rate Rp 2.000 / 1k)';
            }

            $harga = (int) (round($harga / 100) * 100);
            return [
                'harga' => $harga,
                'unit'  => round($harga / $jumlah, 4),
                'tier'  => $tier,
            ];
        }

        // 2. RULES PAKET UMUM (Followers / Likes)
        $byJumlah = [];
        foreach ($pakets as $p) {
            $byJumlah[(int) $p['jumlah']] = (float) $p['harga'];
        }

        if (empty($byJumlah)) {
            return ['harga' => 0, 'unit' => 0, 'tier' => '-'];
        }

        // Jika persis ada di paket
        if (isset($byJumlah[$jumlah])) {
            return [
                'harga' => (int) $byJumlah[$jumlah],
                'unit'  => round($byJumlah[$jumlah] / $jumlah, 2),
                'tier'  => 'Exact Package',
            ];
        }

        // Cari batas atas & bawah yang paling relevan
        $keys = array_keys($byJumlah);
        sort($keys);
        $minKey = min($keys);
        $maxKey = max($keys);

        if ($jumlah >= $maxKey) {
            // Proporsional dari paket terbesar
            $ratePerPcs = $byJumlah[$maxKey] / $maxKey;
            $harga = $jumlah * $ratePerPcs;
            $tier = ">={$maxKey} (Proporsional)";
        } else {
            // Interpolasi atau cari tier terdekat
            $chosenRate = $byJumlah[$minKey] / $minKey;
            foreach ($keys as $k) {
                if ($jumlah >= $k) {
                    $chosenRate = $byJumlah[$k] / $k;
                }
            }
            $harga = $jumlah * $chosenRate;
            $tier = 'Custom Tier';
        }

        $harga = (int) (round($harga / 100) * 100);

        return [
            'harga' => $harga,
            'unit'  => round($harga / $jumlah, 2),
            'tier'  => $tier,
        ];
    }
}
