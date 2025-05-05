<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjual;
use Illuminate\Support\Facades\DB;

class PenjualController extends Controller
{

    public function penjualList()
    {
        return view('penjual.listpenjual');
    }

    public function penjualAddNew()
    {
        // $data = DB::table('status_pemasok')->get();
        // $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        // $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        // $negara = DB::table('negara')->orderBy('nama', 'asc')->get();
        // $mata_uang = DB::table('mata_uang')->orderBy('nama', 'asc')->get();
        // $prefix = 'GMPSCR-';
        // $latest = Penjual::orderBy('pelanggan_id', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        // $pajak = DB::table('pajak')->orderBy('nama', 'asc')->get();
        // $syarat = DB::table('syarat')->orderBy('nama', 'asc')->get();
        // $tipe_pelanggan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        // $level_harga = DB::table('level_harga')->orderBy('nama', 'asc')->get();
        // $agama = DB::table('religion')->orderBy('nama', 'asc')->get();
        // $gender = DB::table('gender')->orderBy('nama', 'asc')->get();
        return view('penjual.penjualaddnew');
    }

    public function saveRecordPenjual(Request $request){
        
        $validate = $request->validate([
            'nama_depan_penjual'    => 'nullable|string|max:255',
            'nama_belakang_penjual' => 'nullable|string|max:255',
            'jabatan'               => 'nullable|string|max:255',
            'dihentikan'            => 'nullable|boolean',
            'no_kantor_1_penjual'   => 'nullable|string|max:255',
            'no_kantor_2_penjual'   => 'nullable|string|max:255',
            'no_ekstensi_1_penjual' => 'nullable|string|max:255',
            'no_ekstensi_2_penjual' => 'nullable|string|max:255',
            'no_hp_penjual'         => 'nullable|string|max:255',
            'no_telp_penjual'       => 'nullable|string|max:255',
            'no_fax_penjual'        => 'nullable|string|max:255',
            'pager_penjual'         => 'nullable|string|max:255',
            'email_penjual'         => 'nullable|string|max:255',
            'memo'                  => 'nullable|string|max:255',
            'fileupload_1'          => 'nullable|string|max:255',
            // 'fileupload_2'               => 'nullable|string|max:255',
            // 'fileupload_3'               => 'nullable|string|max:255',
            // 'fileupload_4'               => 'nullable|string|max:255',
            // 'fileupload_5'               => 'nullable|string|max:255',
            // 'fileupload_6'               => 'nullable|string|max:255',
            // 'fileupload_7'               => 'nullable|string|max:255',
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

            $penjual = new Penjual($validate);
            $penjual->save();

            DB::commit();
            sweetalert()->success('Create new Penjual successfully :)');
            return redirect()->route('penjual/list/page');    
            
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
        $Penjual = Penjual::findOrFail($id);
        if (!$Penjual) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('penjual.penjualedit', compact('Penjual'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_depan_penjual'    => 'nullable|string|max:255',
            'nama_belakang_penjual' => 'nullable|string|max:255',
            'jabatan'               => 'nullable|string|max:255',
            'dihentikan'            => 'nullable|boolean',
            'no_kantor_1_penjual'   => 'nullable|string|max:255',
            'no_kantor_2_penjual'   => 'nullable|string|max:255',
            'no_ekstensi_1_penjual' => 'nullable|string|max:255',
            'no_ekstensi_2_penjual' => 'nullable|string|max:255',
            'no_hp_penjual'         => 'nullable|string|max:255',
            'no_telp_penjual'       => 'nullable|string|max:255',
            'no_fax_penjual'        => 'nullable|string|max:255',
            'pager_penjual'         => 'nullable|string|max:255',
            'email_penjual'         => 'nullable|string|max:255',
            'memo'                  => 'nullable|string|max:255',
            'fileupload_1'          => 'nullable|string|max:255',
            // 'fileupload_2'               => 'nullable|string|max:255',
            // 'fileupload_3'               => 'nullable|string|max:255',
            // 'fileupload_4'               => 'nullable|string|max:255',
            // 'fileupload_5'               => 'nullable|string|max:255',
            // 'fileupload_6'               => 'nullable|string|max:255',
            // 'fileupload_7'               => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $penjual = Penjual::findOrFail($id);
            $penjual->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('penjual/list/page');    
            
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
            Penjual::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('penjual/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getPenjual(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter         = $request->get('nama_depan_penjual');
        $penjualDihentikanFilter  = $request->get('dihentikan');
        
        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $penjual =  DB::table('penjual');
        $totalRecords = $penjual->count();

        if ($namaFilter) {
            $penjual->where('nama_depan_penjual', 'like', '%' . $namaFilter . '%');
        }

        if ($penjualDihentikanFilter  !== null && $penjualDihentikanFilter !== '') {
            $penjual->where('dihentikan', $penjualDihentikanFilter);
        }

        $totalRecordsWithFilter = $penjual->count();

        $records = $penjual
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="penjual_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"              => $checkbox,
                "no"                    => $start + $key + 1,
                "id"                    => $record->id,
                // "pelanggan_id"   => $record->pelanggan_id,
                "nama_depan_penjual"    => $record->nama_depan_penjual,
                'nama_belakang_penjual' => $record->nama_belakang_penjual,
                "jabatan"               => $record->jabatan,
                'no_kantor_1_penjual'   => $record->no_kantor_1_penjual,
                'dihentikan'            => $record->dihentikan,
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
