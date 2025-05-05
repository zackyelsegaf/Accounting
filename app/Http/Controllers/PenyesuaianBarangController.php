<?php

namespace App\Http\Controllers;

use App\Models\PenyesuaianBarang;
use App\Models\PenyesuaianBarangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyesuaianBarangController extends Controller
{
    public function daftarPenyesuaian(Request $request)
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        return view('penyesuaian.datapenyesuaian', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang'));
    }

    public function tambahPenyesuaian()
    {
        $nama_barang = DB::table('barang')->get();
        $tipe_barang = DB::table('tipe_barang')->get();
        $tipe_persediaan = DB::table('tipe_persediaan')->get();
        $kategori_barang = DB::table('kategori_barang')->get();
        $gudang = DB::table('gudang')->get();
        $departemen = DB::table('departemen')->get();
        $proyek = DB::table('proyek')->get();
        $pemasok = DB::table('pemasok')->get();
        $satuan = DB::table('satuan')->get();
        $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        $nama_akun = DB::table('akun')->orderBy('nama', 'asc')->get();
        $prefix = 'GMP';
        $latest = PenyesuaianBarang::orderBy('no_penyesuaian', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->no_barang, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);
        return view('penyesuaian.tambahpenyesuaian', compact('nama_barang','tipe_barang', 'tipe_persediaan', 'kategori_barang', 'gudang', 'departemen', 'proyek', 'pemasok', 'satuan', 'mata_uang', 'kodeBaru', 'nama_akun'));
    }

    public function simpanPenyesuaian(Request $request)
    {
        $rules = [
            'tgl_penyesuaian' => 'nullable|string|max:255',
            'akun_penyesuaian' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'nilai_penyesuaian_check' => 'nullable|boolean',
            'nilai_penyesuaian' => 'nullable|string|max:255',
            'pengguna_penyesuaian' => 'nullable|string|max:255',
        ];

        $validated = $request->validate($rules);
        $validated['biaya_satuan_saldo_awal'] = str_replace(['Rp', '.', ' '], '', $request->biaya_satuan_saldo_awal);
        $validated['total_saldo_awal'] = str_replace(['Rp', '.', ' '], '', $request->total_saldo_awal);
        $validated['kuantitas_saldo_sekarang'] = str_replace(['Rp', '.', ' '], '', $request->kuantitas_saldo_sekarang);
        $validated['harga_satuan_sekarang'] = str_replace(['Rp', '.', ' '], '', $request->harga_satuan_sekarang);
        $validated['biaya_pokok_sekarang'] = str_replace(['Rp', '.', ' '], '', $request->biaya_pokok_sekarang);

        DB::beginTransaction();
        try {
            $penyesuaianBarang = new PenyesuaianBarang($validated);
            $penyesuaianBarang->save();

            $detail = new PenyesuaianBarangDetail();
            $detail->penyesuaian_barang_id = $penyesuaianBarang->id;
            $detail->no_barang = $request->no_barang;
            $detail->deskripsi_barang = $request->deskripsi_barang;
            $detail->kts_saat_ini = $request->kts_saat_ini;
            $detail->kts_baru = $request->kts_baru;
            $detail->nilai_saat_ini = $request->nilai_saat_ini;
            $detail->nilai_baru = $request->nilai_baru;
            $detail->departemen = $request->departemen;
            $detail->proyek = $request->proyek;
            $detail->gudang = $request->gudang;
            $checkboxAktif = $request->persentase_komplet_check == 1;
            $kts_baru = (int) str_replace(['.', ',', ' '], '', $request->kts_baru);
            $kts_saat_ini = (int) str_replace(['.', ',', ' '], '', $request->kts_saat_ini);

            if ($checkboxAktif && $kts_baru <= $kts_saat_ini) {
                sweetalert()->error('Gagal', 'Jika checkbox aktif, Kuantitas Baru harus lebih besar dari Saldo Sekarang.');
                return back()->withInput();
            }

            if (!$checkboxAktif && $kts_baru >= $kts_saat_ini) {
                sweetalert()->error('Gagal', 'Jika checkbox tidak aktif, Kuantitas Baru harus lebih kecil dari Saldo Sekarang.');
                return back()->withInput();
            }
            $detail->save();

            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('penyesuaian/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }



    public function dataPenyesuaian(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter         = $request->get('nama_barang');
        $penyesuaianNoFilter  = $request->get('no_penyesuaian');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $penyesuaian =  DB::table('penyesuaian_barang');
        $totalRecords = $penyesuaian->count();

        if ($penyesuaianNoFilter) {
            $penyesuaian->where('no_penyesuaian', 'like', '%' . $penyesuaianNoFilter . '%');
        }

        // if ($penyesuaianKategoriBarangFilter) {
        //     $penyesuaian->where('kategori_barang', $penyesuaianKategoriBarangFilter);
        // }

        // if ($penyesuaianTipePersediaanFilter) {
        //     $penyesuaian->where('tipe_persediaan', $penyesuaianTipePersediaanFilter);
        // }

        // if ($penyesuaianTipeBarangFilter) {
        //     $penyesuaian->where('tipe_barang', $penyesuaianTipeBarangFilter);
        // }

        // if ($penyesuaianDihentikanFilter  !== null && $penyesuaianDihentikanFilter !== '') {
        //     $penyesuaian->where('dihentikan', $penyesuaianDihentikanFilter);
        // }

        $totalRecordsWithFilter = $penyesuaian->count();

        $records = $penyesuaian
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="barang_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"        => $checkbox,
                "no"              => $start + $key + 1,
                "id"              => $record->id,
                "no_penyesuaian"  => $record->no_penyesuaian,
                "nama_barang"     => $record->nama_barang,
                'tgl_penyesuaian' => $record->tgl_penyesuaian,
                'akun_penyesuaian'=> $record->akun_penyesuaian,
                'satuan'          => $record->satuan,
                'rasio'           => $record->rasio,
                'tipe_barang'     => $record->tipe_barang,
                'kategori_barang' => $record->kategori_barang,
                'tipe_persediaan' => $record->tipe_persediaan,
            ];
        }
        
        return response()->json([
            "draw"                 => intval($draw),
            "recordsTotal"         => $totalRecords,
            "recordsFiltered"      => $totalRecordsWithFilter,
            "data"                 => $data_arr
        ])->header('Content-Type', 'application/json');        
    }
}
