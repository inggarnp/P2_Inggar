<?php

namespace App\Http\Controllers;

use App\Models\Rukun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RukunController extends Controller
{
    public function index()
    {
        $rukuns = Rukun::orderBy('type', 'asc')
                      ->orderBy('no', 'asc')
                      ->get();
        
        return view('pages.rukun.index', compact('rukuns'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:RT,RW',
            'no' => 'required|string|max:10',
        ], [
            'type.required' => 'Type harus dipilih',
            'type.in' => 'Type harus RT atau RW',
            'no.required' => 'Nomor harus diisi',
            'no.max' => 'Nomor maksimal 10 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $exists = Rukun::where('type', $request->type)
                       ->where('no', $request->no)
                       ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Data sudah ada! ' . $request->type . ' nomor ' . $request->no . ' sudah terdaftar.',
                'errors' => [
                    'no' => ['Kombinasi Type dan Nomor ini sudah ada']
                ]
            ], 422);
        }

        try {
            $rukun = Rukun::create([
                'type' => $request->type,
                'no' => $request->no,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data ' . $rukun->type . ' nomor ' . $rukun->no . ' berhasil ditambahkan',
                'data' => $rukun
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'errors' => ['system' => [$e->getMessage()]]
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $rukun = Rukun::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $rukun->id,
                    'type' => $rukun->type,
                    'no' => $rukun->no,
                    'full_name' => $rukun->full_name,
                    'created_at' => $rukun->created_at->format('d M Y H:i'),
                    'updated_at' => $rukun->updated_at->format('d M Y H:i'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $rukun = Rukun::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'required|in:RT,RW',
            'no' => 'required|string|max:10',
        ], [
            'type.required' => 'Type harus dipilih',
            'type.in' => 'Type harus RT atau RW',
            'no.required' => 'Nomor harus diisi',
            'no.max' => 'Nomor maksimal 10 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $exists = Rukun::where('type', $request->type)
                       ->where('no', $request->no)
                       ->where('id', '!=', $id)
                       ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Data sudah ada! ' . $request->type . ' nomor ' . $request->no . ' sudah terdaftar.',
                'errors' => [
                    'no' => ['Kombinasi Type dan Nomor ini sudah ada']
                ]
            ], 422);
        }

        try {
            $rukun->update([
                'type' => $request->type,
                'no' => $request->no,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data ' . $rukun->type . ' nomor ' . $rukun->no . ' berhasil diupdate',
                'data' => $rukun
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupdate data',
                'errors' => ['system' => [$e->getMessage()]]
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $rukun = Rukun::findOrFail($id);
            
            $rukunName = $rukun->full_name;
            
            $rukun->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data ' . $rukunName . ' berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan atau gagal dihapus'
            ], 404);
        }
    }
}