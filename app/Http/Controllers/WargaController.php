<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\WargaRepository;
use App\Imports\WargaImport;
use App\Models\Family;
use Maatwebsite\Excel\Facades\Excel;

class WargaController extends Controller
{
    protected $wargaRepository;

    public function __construct(WargaRepository $wargaRepository)
    {
        $this->wargaRepository = $wargaRepository;
    }

    public function index()
    {
        $wargas     = $this->wargaRepository->getAll();
        $familyList = Family::orderBy('no_kk')->get();

        return view('pages.warga.index', compact('wargas', 'familyList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'            => 'required|string|size:16|unique:warga,nik',
            'name'           => 'required|string|max:255',
            'gender'         => 'required|in:L,P',
            'birth_place'    => 'required|string|max:255',
            'birth_date'     => 'required|date',
            'no_kk'          => 'nullable|exists:family,no_kk',
            'religious'      => 'nullable|string|max:255',
            'education'      => 'nullable|string|max:255',
            'living_status'  => 'nullable|in:hidup,meninggal,pindah,tidak_diketahui',
            'married_status' => 'nullable|string|max:255',
            'occupation'     => 'nullable|string|max:255',
            'blood_type'     => 'nullable|string|max:5',
        ]);

        try {
            $warga = $this->wargaRepository->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data warga berhasil ditambahkan',
                'data'    => $warga,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data warga: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $warga = $this->wargaRepository->findById($id);

            return response()->json([
                'success' => true,
                'data'    => [
                    'id'             => $warga->id,
                    'nik'            => $warga->nik,
                    'no_kk'          => $warga->no_kk ?? '-',
                    'name'           => $warga->name,
                    'gender'         => $warga->gender,
                    'birth_place'    => $warga->birth_place,
                    'birth_date'     => $warga->birth_date?->format('Y-m-d'),
                    'birth_date_fmt' => $warga->birth_date?->format('d M Y'),
                    'religious'      => $warga->religious ?? '-',
                    'education'      => $warga->education ?? '-',
                    'living_status'  => $warga->living_status ?? '-',
                    'married_status' => $warga->married_status ?? '-',
                    'occupation'     => $warga->occupation ?? '-',
                    'blood_type'     => $warga->blood_type ?? '-',
                    'created_at'     => $warga->created_at?->format('d M Y, H:i'),
                    'updated_at'     => $warga->updated_at?->format('d M Y, H:i'),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data warga tidak ditemukan',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nik'            => 'required|string|size:16|unique:warga,nik,' . $id,
            'name'           => 'required|string|max:255',
            'gender'         => 'required|in:L,P',
            'birth_place'    => 'required|string|max:255',
            'birth_date'     => 'required|date',
            'no_kk'          => 'nullable|exists:family,no_kk',
            'religious'      => 'nullable|string|max:255',
            'education'      => 'nullable|string|max:255',
            'living_status'  => 'nullable|in:hidup,meninggal,pindah,tidak_diketahui',
            'married_status' => 'nullable|string|max:255',
            'occupation'     => 'nullable|string|max:255',
            'blood_type'     => 'nullable|string|max:5',
        ]);

        try {
            $warga = $this->wargaRepository->update($id, $validated);

            return response()->json([
                'success' => true,
                'message' => 'Data warga berhasil diupdate',
                'data'    => $warga,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->wargaRepository->delete($id);

            return response()->json([
                'success' => true,
                'message' => 'Data warga berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function downloadTemplate()
    {
        $filePath = storage_path('app/public/templates/template_import_warga.xlsx');

        if (!file_exists($filePath)) {
            $headers = [
                'Content-Type'        => 'text/csv',
                'Content-Disposition' => 'attachment; filename="template_import_warga.csv"',
            ];

            $columns = [
                'nik', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
                'agama', 'pendidikan', 'status_pernikahan', 'pekerjaan',
                'golongan_darah', 'status_kehidupan',
                'no_kk', 'buat_kk_baru', 'rt', 'rw', 'alamat_kk'
            ];

            $example = [
                '3201234567890001', 'Budi Santoso', 'L', 'Bandung', '1990-05-15',
                'Islam', 'S1', 'Kawin', 'Guru', 'O', 'hidup',
                '9876543210987654', 'ya', '001', '001', 'Jl. Contoh No. 1'
            ];

            $callback = function () use ($columns, $example) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                fputcsv($file, $example);
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return response()->download($filePath, 'template_import_warga.xlsx');
    }

    /**
     * Proses import Excel/CSV warga
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120', // max 5MB
        ], [
            'file.required' => 'File wajib dipilih',
            'file.mimes'    => 'File harus berformat xlsx, xls, atau csv',
            'file.max'      => 'Ukuran file maksimal 5MB',
        ]);

        try {
            $import = new WargaImport();
            // Import hanya sheet pertama (index 0 = "Data Warga"), abaikan sheet lain
            Excel::import($import, $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

            $successCount = count($import->successes);
            $errorCount   = count($import->errors);

            return response()->json([
                'success'       => true,
                'message'       => "Import selesai: {$successCount} berhasil, {$errorCount} gagal.",
                'success_count' => $successCount,
                'error_count'   => $errorCount,
                'errors'        => $import->errors, // detail error per baris
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses file: ' . $e->getMessage(),
            ], 500);
        }
    }
}