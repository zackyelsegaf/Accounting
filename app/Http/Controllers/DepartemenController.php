<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;
use Illuminate\Support\Facades\DB;

class DepartemenController extends Controller
{

    public function departemenList()
    {
        return view('departemen.listdepartemen');
    }

    public function departemenAddNew()
    {
        $tipe_departemen = DB::table('tipe_departemen')->orderBy('nama', 'asc')->get();
        $prefix = 'GMP-';
        $latest = Departemen::orderBy('departemen_id', 'desc')->first();
        $nextID = $latest ? intval(substr($latest->departemen_id, strlen($prefix))) + 1 : 1;
        $kodeBaru = $prefix . sprintf("%04d", $nextID);
        return view('departemen.departemenaddnew', compact('kodeBaru', 'tipe_departemen'));
    }

    public function saveRecordDepartemen(Request $request){
        
        $validated = $request->validate([
            'nama_departemen' => 'nullable|string|max:255',
            'nama_kontak'     => 'nullable|string|max:255',
            'tipe_departemen' => 'nullable|string|max:255',
            'dihentikan'      => 'nullable|boolean',
            'deskripsi'       => 'nullable|string|max:255',
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

            $departemen = new Departemen($validated);
            $departemen->save();

            DB::commit();
            sweetalert()->success('Create new Departemen successfully :)');
            return redirect()->route('departemen/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id, $departemen_id)
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
        $tipe_departemen = DB::table('tipe_departemen')->orderBy('nama', 'asc')->get();
        $departemenEdit = DB::table('departemen')->where('departemen_id',$departemen_id)->first();
        $Departemen = Departemen::findOrFail($id);
        if (!$Departemen) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('departemen.departemenedit', compact('Departemen', 'departemenEdit', 'tipe_departemen'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_departemen' => 'nullable|string|max:255',
            'nama_kontak'     => 'nullable|string|max:255',
            'tipe_departemen' => 'nullable|string|max:255',
            'dihentikan'      => 'nullable|boolean',
            'deskripsi'       => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $departemen = Departemen::findOrFail($id);
            $departemen->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('departemen/list/page');    
            
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
            Departemen::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('departemen/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getDepartemen(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_departemen');
        $departemenIdFilter  = $request->get('departemen_id');
        $departemenDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $departemen =  DB::table('departemen');
        $totalRecords = $departemen->count();

        if ($namaFilter) {
            $departemen->where('nama_departemen', 'like', '%' . $namaFilter . '%');
        }

        if ($departemenIdFilter) {
            $departemen->where('departemen_id', 'like', '%' . $departemenIdFilter . '%');
        }

        if ($departemenDihentikanFilter  !== null && $departemenDihentikanFilter !== '') {
            $departemen->where('dihentikan', $departemenDihentikanFilter);
        }

        $totalRecordsWithFilter = $departemen->count();

        $records = $departemen
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
            
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="departemen_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"        => $checkbox,
                "no"              => $start + $key + 1,
                "id"              => $record->id,
                "departemen_id"   => $record->departemen_id,
                "nama_departemen" => $record->nama_departemen,
                'nama_kontak'     => $record->nama_kontak,
                'deskripsi'       => $record->deskripsi,
                'tipe_departemen' => $record->tipe_departemen,
                'dihentikan'      => $record->dihentikan,
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
