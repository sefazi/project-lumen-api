<?php

namespace App\Http\Controllers;

use App\Models\Poli as P;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Poli extends Controller
{
    function index()
    {
        $poli = P::all();

        $response = [
            "success" => true,
            "message" => "List Poli",
            "data" => $poli,
        ];

        return response()->json($response, 200);
    }

    function store(Request $request)
    {
        $response = [];
        $kode = 0;

        $validate = validator::make($request->all(), [
            'poli' => 'required',
        ]);


        if ($validate->fails()) {
            $response = [
                'success' => false,
                'message' => 'Data Poli Wajib Diisi',
                'data' => $validate->errors()
            ];
            $kode = 401;
        } else {
            $poli = P::create([
                'poli' => $request->input('poli')
            ]);

            if ($poli) {
                $response = [
                    'success' => true,
                    'message' => 'Berhasil Input',
                    'data' => $poli
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
        $poli = P::find($id);
        // $poli = Poli::raw();

        if ($poli) {
            $response = [
                'success' => true,
                'message' => 'Data Poli',
                'data' => $poli
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
        $poli = P::whereId($id)->first();

        if ($poli != null) {
            $poli->delete();
            $response = [
                'success' => true,
                'message' => 'Data Poli Berhasil Dihapus',
                'data' => $poli
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
