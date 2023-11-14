<?php

namespace App\Http\Controllers;

use App\Models\Pasien as P;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Pasien extends Controller
{
    function index()
    {
        $Pasien = P::all();

        $response = [
            "success" => true,
            "message" => "List Pasien",
            "data" => $Pasien,
        ];

        return response()->json($response, 200);
    }

    function store(Request $request)
    {
        $response = [];
        $kode = 0;

        $validate = validator::make($request->all(), [
            'nomor_rm' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
        ]);

        if ($validate->fails()) {
            $response = [
                'success' => false,
                'message' => 'Data Pasien Wajib Diisi',
                'data' => $validate->errors()
            ];
            $kode = 401;
        } else {
            $Pasien = P::create([
                'nomor_rm' => $request->input('nomor_rm'),
                'nama' => $request->input('nama'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'nomor_telepon' => $request->input('nomor_telepon'),
                'alamat' => $request->input('alamat'),
            ]);

            if ($Pasien) {
                $response = [
                    'success' => true,
                    'message' => 'Berhasil Input',
                    'data' => $Pasien
                ];
                $kode = 201;
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Gagal Input',
                    'data' => ''
                ];
                $kode = 400;
            }
        }

        return response()->json($response, $kode);
    }

    function show($id)
    {
        $Pasien = P::find($id);
        // $Pasien = Pasien::raw();

        if ($Pasien) {
            $response = [
                'success' => true,
                'message' => 'Data Pasien',
                'data' => $Pasien
            ];
            $kode = 200;
        } else {
            $response = [
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
                'data' => ""
            ];
            $kode = 404;
        }

        return response()->json($response, $kode);
    }

    function destroy($id)
    {
        $Pasien = P::whereId($id)->first();

        if ($Pasien != null) {
            $Pasien->delete();
            $response = [
                'success' => true,
                'message' => 'Data Pasien Berhasil Dihapus',
                'data' => $Pasien
            ];
            $kode = 200;
        } else {
            $response = [
                'success' => false,
                'message' => 'Data Tidak Ditemukan',
                'data' => ""
            ];
            $kode = 404;
        }

        return response()->json($response, $kode);
    }
}
