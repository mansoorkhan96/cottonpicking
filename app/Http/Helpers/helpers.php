<?php

    function toMann(float $kgs)
    {
        if ($kgs > 39) {
            $total_mann = $kgs / 40;
            $mann_kati = floor($total_mann);
            $total_kgs = $total_mann - $mann_kati;

            return $mann_kati.'-'.($total_kgs * 40);
        }

        return $kgs;
    }
