<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerjasama;
use App\Models\Kecamatan;
use App\Models\Supplier;
use App\Models\Alamat;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KerjasamaController extends Controller
{
    // Tampilkan form atau status pengajuan untuk supplier
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

        $kecamatanList = Kecamatan::all();
        return view('pemasok.kerjasama', compact('kecamatanList'));
    }

    // Simpan pengajuan kerjasama
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:30',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:30',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'file_mou' => 'required|file|mimes:pdf|max:2048',
            'catatan' => 'nullable|string',
        ]);

        $supplier = auth()->guard('supplier')->user(); // Harus didefinisikan dulu

        // Simpan atau ambil alamat
        $alamat = Alamat::firstOrCreate([
            'jalan' => $request->alamat,
            'kecamatan_id' => $request->kecamatan_id,
            'supplier_id' => $supplier->id,
        ]);

        // Simpan file
        $path = $request->file('file_mou')->store('mou', 'public');

        // Simpan pengajuan
        $kerjasama = Kerjasama::create([
            'supplier_id' => $supplier->id,

            'alamat_id' => $alamat->id,

            'file_mou' => $path,
            'catatan' => $request->catatan,
            'status' => 'pending',
        ]);

        $supplier->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->back()->with('success', 'Pengajuan disetujui.');
    }

    // Untuk admin - tampilkan semua pengajuan
    public function index()
    {
        $pengajuanList = Kerjasama::with('supplier', 'alamat.kecamatan')->latest()->get();
        return view('admin.kerjasama', compact('pengajuanList'));
    }

    // Untuk admin - setujui pengajuan
    public function approve($id)
    {
        $pengajuan = Kerjasama::findOrFail($id);
        $pengajuan->status = 'approved';
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan disetujui.');
    }

    // Untuk admin - tolak pengajuan
    public function reject($id)
    {
        $pengajuan = Kerjasama::findOrFail($id);
        $pengajuan->status = 'rejected';
        $pengajuan->save();

        return redirect()->back()->with('success', 'Pengajuan ditolak.');
    }

    // Untuk admin - DataTables JSON
  public function getData()
    {
        $query = Kerjasama::from('kerja_sama')
            ->join('supplier', 'kerja_sama.supplier_id', '=', 'supplier.id')
            ->leftJoin('alamat', 'alamat.supplier_id', '=', 'supplier.id')
            ->leftJoin('kecamatan', 'alamat.kecamatan_id', '=', 'kecamatan.id')
            ->select([
                'kerja_sama.*',
                'supplier.nama as supplier_nama',
                'supplier.nama_perusahaan',
                'alamat.jalan as alamat_jalan',
                'kecamatan.nama as kecamatan_nama',
            ]);

        return DataTables::of($query)
            ->addColumn('nama', fn($row) => $row->supplier_nama)
            ->addColumn('alamat', fn($row) => $row->alamat_jalan ?? '-')
            ->addColumn('kecamatan', fn($row) => $row->kecamatan_nama ?? '-')
            ->addColumn('file_mou_link', fn($row) =>
                '<a href="'.asset('storage/'.$row->file_mou).'" class="text-blue-500" target="_blank">Lihat PDF</a>'
            )
            ->addColumn('aksi', function ($row) {
                if ($row->status === 'pending') {
                    $approveUrl = route('admin.kerjasama.approve', $row->id);
                    $rejectUrl = route('admin.kerjasama.reject', $row->id);

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
            ->editColumn('status', fn($row) => match($row->status) {
                'pending' => '<span class="text-yellow-600">Pending</span>',
                'approved' => '<span class="text-green-600">Disetujui</span>',
                'rejected' => '<span class="text-red-600">Ditolak</span>',
                default => $row->status,
            })
            ->rawColumns(['aksi', 'file_mou_link', 'status'])
            ->make(true);
    }


}
