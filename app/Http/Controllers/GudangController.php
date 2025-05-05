<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use Illuminate\Support\Facades\DB;

class GudangController extends Controller
{
    public function gudangList()
    {
        return view('gudang.listgudang');
    }

    public function gudangAddNew()
    {
        // $prefix = 'GMPC-';
        // $latest = Proyek::orderBy('pelanggan_id', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        return view('gudang.gudangaddnew');
    }

    public function saveRecordGudang(Request $request){
        
        $validate = $request->validate([
            'nama_gudang'              => 'nullable|string|max:255',
            'alamat_gudang_1'              => 'nullable|string|max:255',
            'alamat_gudang_2'             => 'nullable|string|max:255',
            'alamat_gudang_3'               => 'nullable|string|max:255',
            'penanggung_jawab'       => 'nullable|string|max:255',
            'deskripsi'                => 'nullable|string|max:255',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {

            // $photo= $request->fileupload_1;
            // $file_name = rand() . '.' .$photo->getClientOriginalName();
            // $photo->move(public_path('/assets/img/'), $file_name);

            $gudang = new Gudang($validate);
            $gudang->save();

            DB::commit();
            sweetalert()->success('Create new gudang successfully :)');
            return redirect()->route('gudang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        // $data = DB::table('status_pemasok')->get();
        // $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        // $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        // $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        // $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        // $pajak = DB::table('pajak')->orderBy('nama', 'asc')->get();
        // $syarat = DB::table('syarat')->orderBy('nama', 'asc')->get();
        // $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        // $level_harga = DB::table('level_harga')->orderBy('nama', 'asc')->get();
        // $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        // $gender = DB::table('gender')->orderBy('nama', 'asc')->get();
        $Gudang = Gudang::findOrFail($id);
        if (!$Gudang) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('gudang.gudangedit', compact('Gudang'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_gudang'              => 'nullable|string|max:255',
            'alamat_gudang_1'              => 'nullable|string|max:255',
            'alamat_gudang_2'             => 'nullable|string|max:255',
            'alamat_gudang_3'               => 'nullable|string|max:255',
            'penanggung_jawab'       => 'nullable|string|max:255',
            'deskripsi'                => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $gudang = Gudang::findOrFail($id);
            $gudang->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('gudang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Gudang::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('gudang/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getGudang(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_gudang');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $gudang =  DB::table('gudang');
        $totalRecords = $gudang->count();

        if ($namaFilter) {
            $gudang->where('nama_gudang', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $gudang->count();

        $records = $gudang
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="gudang_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"              => $checkbox,
                "no"                    => $start + $key + 1,
                "id"                    => $record->id,
                "nama_gudang"           => $record->nama_gudang,
                'deskripsi'             => $record->deskripsi,
                'penanggung_jawab'      => $record->penanggung_jawab,
                'alamat_gudang_1'       => $record->alamat_gudang_1,
                "alamat_gudang_2"       => $record->alamat_gudang_2,
                'alamat_gudang_3'       => $record->alamat_gudang_3,
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
