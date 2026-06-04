<?php

if (! function_exists('hitung_harga_sosmed')) {
    /**
     * Hitung estimasi harga custom berdasarkan paket layanan (dinamis).
     *
     * @param array $pakets  Array paket layanan (harus berisi ['jumlah','harga']), urut jumlah ASC.
     * @param int   $jumlah  Quantity yang diminta user.
     * @return array         ['harga'=>int, 'unit'=>float, 'tier'=>string, 'ref'=>array|null]
     */
    function hitung_harga_sosmed(array $pakets, int $jumlah): array
    {
        if (empty($pakets) || $jumlah <= 0) {
            return ['harga' => 0, 'unit' => 0, 'tier' => '-', 'ref' => null];
        }

        // Index paket by jumlah supaya gampang ambil 100/500/1000
        $byJumlah = [];
        foreach ($pakets as $p) {
            $byJumlah[(int) $p['jumlah']] = (float) $p['harga'];
        }

        // Tentukan paket referensi terbesar (basis tier >= 1000) -> ambil paket dgn jumlah terbesar
        $maxQty   = max(array_keys($byJumlah));
        $maxHarga = $byJumlah[$maxQty];

        // unit per tier (fallback berjenjang)
        $unitBesar  = $maxHarga / $maxQty;                                   // basis paket terbesar
        $unit500    = isset($byJumlah[500]) ? $byJumlah[500] / 500 : $unitBesar;
        $unit100    = isset($byJumlah[100]) ? $byJumlah[100] / 100 : $unit500;

        if ($jumlah >= 1000 && isset($byJumlah[1000])) {
            $harga = ($jumlah / 1000) * $byJumlah[1000];
            $unit  = $byJumlah[1000] / 1000;
            $tier  = '>=1000 (proporsional paket 1000)';
        } elseif ($jumlah >= $maxQty) {
            // untuk layanan berbasis ribuan (Views/Share) yg tidak punya paket 1000
            $harga = ($jumlah / $maxQty) * $maxHarga;
            $unit  = $unitBesar;
            $tier  = ">={$maxQty} (proporsional paket terbesar)";
        } elseif ($jumlah >= 500) {
            $harga = $jumlah * $unit500;
            $unit  = $unit500;
            $tier  = '500-999';
        } else { // 100-499
            $harga = $jumlah * $unit100;
            $unit  = $unit100;
            $tier  = '100-499';
        }

        // Bulatkan ke ratusan terdekat
        $harga = (int) (round($harga / 100) * 100);

        // Paket terdekat untuk perbandingan
        $ref = null;
        $bestDiff = PHP_INT_MAX;
        foreach ($pakets as $p) {
            $diff = abs((int) $p['jumlah'] - $jumlah);
            if ($diff < $bestDiff) {
                $bestDiff = $diff;
                $ref = $p;
            }
        }

        return ['harga' => $harga, 'unit' => round($unit, 2), 'tier' => $tier, 'ref' => $ref];
    }
}