<?php

namespace App\Http\Controllers;

use App\Models\Pegawai as P;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Pegawai extends Controller
{
    function index()
    {
        $Pegawai = P::all();

        $response = [
            "success" => true,
            "message" => "List Pegawai",
            "data" => $Pegawai,
        ];

        return response()->json($response, 200);
    }

    function store(Request $request)
    {
        $response = [];
        $kode = 0;

        $validate = validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $response = [
                'success' => false,
                'message' => 'Data Pegawai Wajib Diisi',
                'data' => $validate->errors()
            ];
            $kode = 401;
        } else {
            $Pegawai = P::create([
                'nip' => $request->input('nip'),
                'nama' => $request->input('nama'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'nomor_telepon' => $request->input('nomor_telepon'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            if ($Pegawai) {
                $response = [
                    'success' => true,
                    'message' => 'Berhasil Input',
                    'data' => $Pegawai
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
        $Pegawai = P::find($id);
        // $Pegawai = Pegawai::raw();

        if ($Pegawai) {
            $response = [
                'success' => true,
                'message' => 'Data Pegawai',
                'data' => $Pegawai
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
        $Pegawai = P::whereId($id)->first();

        if ($Pegawai != null) {
            $Pegawai->delete();
            $response = [
                'success' => true,
                'message' => 'Data Pegawai Berhasil Dihapus',
                'data' => $Pegawai
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
