<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class invest extends Controller
{
    public function hitung(Request $request)
    {
        $jenis_kelamin = $request->input('jenis_kelamin');
        $usia = $request->input('usia');
        $Perokok = $request->input('perokok');
        $Nominal = $request->input('nominal');
        $LamaInvestasi = $request->input('lama_investasi');
        $Persentase = 0;

        if ($Perokok == "Ya" && $jenis_kelamin == "Pria") {
            $Persentase = 1;
            if ($usia > 0 && $usia <= 30) {
                $Persentase += 1;
            } else if ($usia >= 31 && $usia <= 50) {
                $Persentase += 0.5;
            } else if ($usia > 50) {
                $Persentase = 0;
            }
        } else if ($Perokok == "Tidak" && $jenis_kelamin == "Pria") {
            $Persentase = 2;
            if ($usia > 0 && $usia <= 30) {
                $Persentase += 1;
            } else if ($usia >= 31 && $usia <= 50) {
                $Persentase += 0.5;
            } else if ($usia > 50) {
                $Persentase = 0;
            }
        } else if ($Perokok == "Ya" && $jenis_kelamin == "Wanita") {
            $Persentase = 2;
            if ($usia > 0 && $usia <= 30) {
                $Persentase += 1;
            } else if ($usia >= 31 && $usia <= 50) {
                $Persentase += 0.5;
            } else if ($usia > 50) {
                $Persentase = 0;
            }
        } else if ($Perokok == "Tidak" && $jenis_kelamin == "Wanita") {
            $Persentase = 3;
            if ($usia > 0 && $usia <= 30) {
                $Persentase += 1;
            } else if ($usia >= 31 && $usia <= 50) {
                $Persentase += 0.5;
            } else if ($usia > 50) {
                $Persentase = 0;
            }
        }
        $Awal = $Nominal;
        $Bunga = 0;
        $Akhir = 0;
        $Result = [];
        for ($i = 1; $i <= $LamaInvestasi; $i++) {
            $Awal += $Bunga;
            $Bunga = $Awal * ($Persentase / 100);
            $Akhir = $Awal + $Bunga;
            $data = array(
                'Awal' => intval($Awal),
                'Bunga' => intval($Bunga),
                'Akhir' => intval($Akhir),
            );
            array_push($Result, $data);
        }

        return response()->json([
            'message' => 'success',
            'status' => 200,
            'data' => $Result,
        ]);
    }
}
