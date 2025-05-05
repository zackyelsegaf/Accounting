<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBarang;
use DataTables;
use Illuminate\Support\Facades\DB;

class KategoriBarangController extends Controller
{
    public function kategoriBarangList()
    {
        return view('kategoribarang.listkategoribarang');
    }

    public function KategoriBarangAddNew()
    {
        return view('kategoribarang.kategoribarangaddnew');
    }

    public function saveRecordKategoriBarang(Request $request){
        $request->validate([
            'nama'          => 'required|string|max:255',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {
            $kategoriBarang = new KategoriBarang();
            $kategoriBarang->nama = $request->nama;
            $kategoriBarang->save();
            
            DB::commit();
            sweetalert()->success('Create new Tipe Pelanggan successfully :)');
            return redirect()->route('kategoribarang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal :)');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids; // Ambil ID dari checkbox
            KategoriBarang::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('kategoribarang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $kategoriBarang = KategoriBarang::findOrFail($id);
            $kategoriBarang->nama = $request->nama;
            $kategoriBarang->save();
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('kategoribarang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $kategoriBarang = KategoriBarang::findOrFail($id);
        if (!$kategoriBarang) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('kategoribarang.kategoribarangedit', compact('kategoriBarang'));
    }

    public function getKategoriBarang(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $kategoriBarang =  DB::table('kategori_barang');
        $totalRecords = $kategoriBarang->count();

        if ($namaFilter) {
            $kategoriBarang->where('nama', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $kategoriBarang->count();

        $records = $kategoriBarang
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="kategori_barang_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "nama"         => $record->nama,
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
