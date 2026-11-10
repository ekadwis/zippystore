<?php

if (! function_exists('hitung_harga_sosmed')) {
    /**
     * Hitung harga sosmed berdasarkan rules:
     * - Khusus Views Instagram & TikTok (min 1.000):
     *   1k = 2.000
     *   10k = 15.000
     *   100k = 110.000 (kelipatan 100k dihitung 110.000 / 100k = 1.100 per 1k)
     * - Layanan Lainnya (YouTube Subs/Like/Views, IG/TikTok Followers, Likes):
     *   Mengikuti rate tier yang terdekat di bawahnya (rate termahal yang terlewati).
     *   Contoh: YT Subs (50: 90k, 100: 150k, 500: 650k, 1000: 1jt)
     *   - Order 75 subs -> ikut rate 50 subs (90.000 / 50 = 1.800/sub -> 75 * 1.800 = 135.000)
     *   - Order 130 subs -> ikut rate 100 subs (150.000 / 100 = 1.500/sub -> 130 * 1.500 = 195.000)
     *   - Order 400 subs -> ikut rate 100 subs (1.500/sub -> 400 * 1.500 = 600.000)
     *   - Order 700 subs -> ikut rate 500 subs (650.000 / 500 = 1.300/sub -> 700 * 1.300 = 910.000)
     *
     * @param array $pakets       Array paket layanan (harus berisi ['jumlah','harga']), urut jumlah ASC.
     * @param int   $jumlah       Quantity yang diminta user.
     * @param bool  $isIgTtViews  Apakah ini layanan views Instagram / TikTok yang punya rule khusus
     * @return array              ['harga'=>int, 'unit'=>float, 'tier'=>string]
     */
    function hitung_harga_sosmed(array $pakets, int $jumlah, bool $isIgTtViews = false): array
    {
        if ($jumlah <= 0) {
            return ['harga' => 0, 'unit' => 0, 'tier' => '-'];
        }

        // 1. RULES KHUSUS VIEWS INSTAGRAM & TIKTOK
        if ($isIgTtViews) {
            if ($jumlah < 1000) {
                return ['harga' => 0, 'unit' => 0, 'tier' => 'invalid_min'];
            }

            if ($jumlah >= 100000) {
                $harga = ($jumlah / 100000) * 110000;
                $tier = '>=100k (Rate Rp 110.000 / 100k)';
            } elseif ($jumlah >= 10000) {
                $harga = ($jumlah / 10000) * 15000;
                $tier = '10k-99k (Rate Rp 15.000 / 10k)';
            } else {
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

        // 2. RULES UMUM (Rate Tier Terdekat / Step-Down Tier)
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

        $keys = array_keys($byJumlah);
        sort($keys, SORT_NUMERIC);
        $minKey = min($keys);
        $maxKey = max($keys);

        // Cari tier acuan terbesar yang <= $jumlah
        $chosenTierKey = $minKey;
        foreach ($keys as $k) {
            if ($jumlah >= $k) {
                $chosenTierKey = $k;
            }
        }

        // Hitung rate per unit dari tier acuan
        $ratePerUnit = $byJumlah[$chosenTierKey] / $chosenTierKey;
        $harga = $jumlah * $ratePerUnit;
        $tier = "Tier {$chosenTierKey} (Rate Rp " . number_format($ratePerUnit, 2, ',', '.') . "/unit)";

        // Bulatkan ke ratusan terdekat
        $harga = (int) (round($harga / 100) * 100);

        return [
            'harga' => $harga,
            'unit'  => round($ratePerUnit, 2),
            'tier'  => $tier,
        ];
    }
}
