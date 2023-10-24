<?php

namespace App\Http\Controllers;

use App\Models\Api as Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Api extends Controller
{
    function index()
    {
        $poli = Poli::all();

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

        $response = [
            'success' => true,
            'message' => 'Berhasil Input',
            'data' => $request->all()
        ];
        $kode = 400;
        // $validate = validator::make($request->all(), [
        //     'poli' => 'required',
        // ]);


        // if ($validate->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Data Poli Wajib Diisi',
        //         'data' => $validate->errors()
        //     ];
        //     $kode = 401;
        // } else {
        //     $poli = Poli::create([
        //         'poli' => $request->input('poli')
        //     ]);

        //     if ($poli) {
        //         $response = [
        //             'success' => true,
        //             'message' => 'Berhasil Input',
        //             'data' => $poli
        //         ];
        //         $kode = 201;
        //     } else {
        //         $response = [
        //             'success' => false,
        //             'message' => 'Gagal Input',
        //             'data' => ''
        //         ];
        //         $kode = 400;
        //     }
        // }

        return response()->json($response, $kode);
    }
}
