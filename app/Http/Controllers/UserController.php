<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Submission 3
    public function home () {
        $data = [
            [
                'id' => '1',
                'nama' => 'Yuningsih',
                'email' => 'yuningsihyuni286@gmail.com',
                'jeniskelamin' => 'Perempuan',
                'telp' => '083130484846',
                'alamat' => 'Bandung'
            ]
        ];
        $data = array_merge($data);

        return view('users/datapengunjung', compact('data'));
    }

    public function create () {
        return view('users/create');

    }

    public function tampil () {
        return view('users/edit');
    }

    // Submission 2
    public function index() {
        $data = [
            [
                'nama' => 'Yuningsih',
                'email' => 'yuningsihyuni286@gmail.com',
                'telp' => '086453218907',
                'alamat' => [
                    'street' => 'Jl. Budi',
                    'postcode' => '4510295'
                ]
            ],
            [
                'nama' => 'yulia',
                'email' => 'yulia@gmail.com',
                'telp' => '088123456654',
                'alamat' => [
                    'street' => 'Jl. Budi',
                    'postcode' => '4510295'
                ]
            ],
            [
                'nama' => 'faisal',
                'email' => 'faisal@gmail.com',
                'telp' => '089876534527',
                'alamat' => [
                    'street' =>'Jl. Budi',
                    'postcode' => '4510295'
                ]
            ]
        ];

        $data2 = [
            [
                'nama' => 'yaya',
                'email' => 'yaya@gmail.com',
                'telp' => '087654327184',
                'alamat' => [
                    'street' => 'Jl. Budi',
                    'postcode' => '4510295'
                ]
            ]
        ];

        $data = array_merge($data, $data2);

        $id = '111';

        return view('users/user', compact('data', 'id'));

    }

    public function getDataUser(Request $request) {
        $nama = $request->get('nama');
        $email = $request->get('email');

        $arrNama = [
            'nama' => $nama,
            'email' => $email
        ];

        return json_encode($arrNama);
    }

    public function createDataUser(Request $request) {
        $post = $request->post();
        $arr = [];
        $arr['username'] = $request->post('username');
        $arr['email'] = $request->post('email');
        $arr['no_telp'] = $request->post('no_telp');

        $isValid = self::cekUser($arr['username']);
        if ($isValid){
            $res['status'] = true;
            $res['message'] = 'Username Valid!';
            $code = 200;
        } else {
            $res['status'] = false;
            $res['message'] = 'Username Tidak Valid!';
            $code = 401;
        }

        //Contoh response json
        return response()->json($res, $code);
    }

    private static function cekUser($username) {
        if ($username == 'Yuningsih') {
            return true;
        } else {
            return false;
        }
    }

    public function updateDataUser(Request $request) {
        $post = $request->post();
        $arr = [];
        $arr['username'] = $request->post('username');
        $arr['email'] = $request->post('email');
        $arr['no_telp'] = $request->post('no_telp');

        //Buat response seperti ketika insert, silahkan improve sendiri

        return response()->json($arr, 200);
    }

    public function deleteDataUser(Request $request) {
        $arr = [];
        $arr['username'] = $request->get('username');

        $isValid = self::cekUser($arr['username']);
        if ($isValid){
            $res['status'] = true;
            $res['message'] = 'Data berhasil dihapus!';
            $code = 200;
        } else {
            $res['status'] = false;
            $res['message'] = 'Data tidak ditemukan / username tidak valid!';
            $code = 401;
        }

        return response()->json($res, $code);
    }
}


