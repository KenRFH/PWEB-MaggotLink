<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerjasama;
use App\Models\Kecamatan;
use App\Models\DetailAlamat;
use App\Models\Alamat;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KerjasamaController extends Controller
{
   public function create()
{
    $userId = auth()->guard('supplier')->user()->id;
    $pengajuan = Kerjasama::where('supplier_id', $userId)->latest()->first();

    if ($pengajuan) {
        if ($pengajuan->status === 'approved') {
            return view('pemasok.kerjasama-approved');
        } elseif ($pengajuan->status === 'pending') {
            return view('pemasok.kerjasama-pending');
        } elseif ($pengajuan->status === 'rejected') {
            return view('pemasok.kerjasama-rejected');
        }
    }

    // Jika belum ada pengajuan, tampilkan form pengajuan
    $kecamatanList = Kecamatan::all();

    return view('pemasok.kerjasama', [
        'kecamatanList' => $kecamatanList,
    ]);
}


     public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string',
        'name_company' => 'required|string',

        'alamat' => 'required|string',
        'no_telepon' => 'required|string|max:30',
        'kecamatan_id' => 'required|exists:kecamatan,id',
        'file_mou' => 'required|file|mimes:pdf|max:2048',
        'catatan' => 'nullable|string',
    ]);

     $alamat = Alamat::firstOrCreate(
        ['jalan' => $request->alamat,
        'kecamatan_id' => $request->kecamatan_id]

    );


    $path = $request->file('file_mou')->store('mou', 'public');
    $supplier = auth()->guard('supplier')->user();
    Kerjasama::create([
    'supplier_id' => auth()->guard('supplier')->user()->id,
    'nama' => $request->nama,
    'name_company' => $request->name_company,
    'alamat' => $request->alamat,
    'kecamatan_id' => $request->kecamatan_id,
    'no_telepon' => $request->no_telepon,
    'file_mou' => $path,
    'catatan' => $request->catatan,
    'status' => 'pending', // tambahkan ini
]);
 // Buat atau update alamat di detail_alamat
    // 3️⃣ Update atau buat `detail_alamat` dan simpan ID, bukan string
    DetailAlamat::updateOrCreate(
        ['supplier_id' => $supplier->id],
        [
            'alamat_id' => $alamat->id,
            'kecamatan_id' => $request->kecamatan_id
        ]
    );
 $supplier->alamat = $request->alamat;
    $supplier->save();
    return redirect()->route('halaman')->with('success', 'Pengajuan berhasil disimpan!');
}

    // Menampilkan semua pengajuan untuk admin
public function index()
{
    $pengajuanList = Kerjasama::with('supplier', 'kecamatan')->latest()->get();
    return view('admin.kerjasama', compact('pengajuanList'));
}

// Menyetujui pengajuan
public function approve($id)
{
    $pengajuan = Kerjasama::findOrFail($id);
    $pengajuan->status = 'approved';
    $pengajuan->save();

    return redirect()->back()->with('success', 'Pengajuan disetujui.');
}

// Menolak pengajuan
public function reject($id)
{
    $pengajuan = Kerjasama::findOrFail($id);
    $pengajuan->status = 'rejected';
    $pengajuan->save();

    return redirect()->back()->with('success', 'Pengajuan ditolak.');
}



public function getData()
{
    $query = Kerjasama::with('kecamatan');

    return DataTables::of($query)
        ->addColumn('aksi', function ($pengajuan) {
            if ($pengajuan->status === 'pending') {
                $approveUrl = route('admin.kerjasama.approve', $pengajuan->id);
                $rejectUrl = route('admin.kerjasama.reject', $pengajuan->id);

                return '
                    <form action="'.$approveUrl.'" method="POST" class="inline">
                        '.csrf_field().'
                        <button type="submit" class="text-green-600">Setujui</button>
                    </form>
                    <form action="'.$rejectUrl.'" method="POST" class="inline ml-2">
                        '.csrf_field().'
                        <button type="submit" class="text-red-600">Tolak</button>
                    </form>
                ';
            } else {
                return '<span class="text-gray-400 italic">Sudah diproses</span>';
            }
        })
        ->addColumn('file_mou_link', function ($pengajuan) {
            return '<a href="'.asset('storage/'.$pengajuan->file_mou).'" class="text-blue-500" target="_blank">Lihat PDF</a>';
        })
        ->editColumn('status', function ($pengajuan) {
            if ($pengajuan->status == 'pending') {
                return '<span class="text-yellow-600">Pending</span>';
            } elseif ($pengajuan->status == 'approved') {
                return '<span class="text-green-600">Disetujui</span>';
            } else {
                return '<span class="text-red-600">Ditolak</span>';
            }
        })
        ->rawColumns(['aksi', 'file_mou_link', 'status']) // agar HTML tidak di-escape
        ->make(true);
}



}

