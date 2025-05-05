<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\DB;

class AkunController extends Controller
{
    public function akunList()
    {
        $tipe_akun = DB::table('tipe_akun')->get();
        return view('akun.listakun', compact('tipe_akun'));
    }

    public function akunAddNew()
    {
        // $prefix = 'GMPC-';
        // $latest = Akun::orderBy('pelanggan_id', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        $mata_uang = DB::table('mata_uang')->get();
        $tipe_akun = DB::table('tipe_akun')->get();
        $nama_akun = DB::table('akun')->get();
        return view('akun.akunaddnew', compact('tipe_akun', 'nama_akun', 'mata_uang'));
    }

    public function saveRecordAkun(Request $request){
        
        $validate = $request->validate([
            'no_akun'             => 'nullable|string|max:255',
            'tipe_akun'           => 'nullable|string|max:255',
            'nama_akun_indonesia' => 'nullable|string|max:255',
            'nama_akun_inggris'   => 'nullable|string|max:255',
            'mata_uang'           => 'nullable|string|max:255',
            'sub_akun_check'      => 'nullable|boolean',
            'sub_akun'            => 'nullable|string|max:255',
            'saldo_akun'          => 'nullable|string|max:255',
            'tanggal'             => 'nullable|string|max:255',
            'dihentikan'          => 'nullable|boolean',
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

            $Akun = new Akun($validate);
            $Akun->save();

            DB::commit();
            sweetalert()->success('Create new Proyek successfully :)');
            return redirect()->route('akun/list/page');    
            
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
        $mata_uang = DB::table('mata_uang')->get();
        $tipe_akun = DB::table('tipe_akun')->get();
        $nama_akun = DB::table('akun')->get();
        $Akun = Akun::findOrFail($id);
        if (!$Akun) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('akun.akunedit', compact('Akun', 'tipe_akun', 'nama_akun', 'mata_uang'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'no_akun'             => 'nullable|string|max:255',
            'tipe_akun'           => 'nullable|string|max:255',
            'nama_akun_indonesia' => 'nullable|string|max:255',
            'nama_akun_inggris'   => 'nullable|string|max:255',
            'mata_uang'           => 'nullable|string|max:255',
            'sub_akun_check'      => 'nullable|boolean',
            'sub_akun'            => 'nullable|string|max:255',
            'saldo_akun'          => 'nullable|string|max:255',
            'tanggal'             => 'nullable|string|max:255',
            'dihentikan'          => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            $Akun = Akun::findOrFail($id);
            $Akun->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('akun/list/page');    
            
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
            Akun::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('akun/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getAKun(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_akun');
        $akunIdFilter  = $request->get('no_akun');
        $akunTipeAkunFilter  = $request->get('tipe_akun');
        $akunDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $Akun =  DB::table('akun');
        $totalRecords = $Akun->count();

        if ($namaFilter) {
            $Akun->where('nama_akun', 'like', '%' . $namaFilter . '%');
        }

        if ($akunIdFilter) {
            $Akun->where('no_akun', 'like', '%' . $akunIdFilter . '%');
        }

        if ($akunTipeAkunFilter) {
            $Akun->where('tipe_akun', 'like', '%' . $akunTipeAkunFilter . '%');
        }

        if ($akunDihentikanFilter  !== null && $akunDihentikanFilter !== '') {
            $Akun->where('dihentikan', $akunDihentikanFilter);
        }

        $totalRecordsWithFilter = $Akun->count();

        $records = $Akun
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="akun_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"              => $checkbox,
                "no"                    => $start + $key + 1,
                "id"                    => $record->id,
                "no_akun"               => $record->no_akun,
                "nama_akun_indonesia"   => $record->nama_akun_indonesia,
                'tipe_akun'             => $record->tipe_akun,
                "mata_uang"             => $record->mata_uang,
                "saldo_akun"           => 'Rp ' . number_format($record->saldo_akun, 0, ',', '.'),
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
