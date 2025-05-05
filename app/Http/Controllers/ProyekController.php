<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use Illuminate\Support\Facades\DB;

class ProyekController extends Controller
{
    public function proyekList()
    {
        return view('proyek.listproyek');
    }

    public function proyekAddNew()
    {
        // $prefix = 'GMPC-';
        // $latest = Proyek::orderBy('pelanggan_id', 'desc')->first();
        // $nextID = $latest ? intval(substr($latest->pelanggan_id, strlen($prefix))) + 1 : 1;
        // $kodeBaru = $prefix . sprintf("%04d", $nextID);
        return view('proyek.proyekaddnew');
    }

    public function saveRecordProyek(Request $request){
        
        $validate = $request->validate([
            'proyek_id'                => 'nullable|string|max:255',
            'nama_proyek'              => 'nullable|string|max:255',
            'nama_kontak'              => 'nullable|string|max:255',
            'tanggal_from'             => 'nullable|string|max:255',
            'tanggal_to'               => 'nullable|string|max:255',
            'persentase_komplet'       => 'nullable|string|max:255',
            'persentase_komplet_check' => 'nullable|boolean',
            'deskripsi'                => 'nullable|string|max:255',
            'dihentikan'               => 'nullable|boolean',
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

            $proyek = new Proyek($validate);
            $proyek->save();

            DB::commit();
            sweetalert()->success('Create new Proyek successfully :)');
            return redirect()->route('proyek/list/page');    
            
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
        $Proyek = Proyek::findOrFail($id);
        if (!$Proyek) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('proyek.proyekedit', compact('Proyek'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'proyek_id'                => 'nullable|string|max:255',
            'nama_proyek'              => 'nullable|string|max:255',
            'nama_kontak'              => 'nullable|string|max:255',
            'tanggal_from'             => 'nullable|string|max:255',
            'tanggal_to'               => 'nullable|string|max:255',
            'persentase_komplet'       => 'nullable|string|max:255',
            'persentase_komplet_check' => 'nullable|boolean',
            'deskripsi'                => 'nullable|string|max:255',
            'dihentikan'               => 'nullable|boolean',
            // 'fileupload_2'               => 'nullable|string|max:255',
            // 'fileupload_3'               => 'nullable|string|max:255',
            // 'fileupload_4'               => 'nullable|string|max:255',
            // 'fileupload_5'               => 'nullable|string|max:255',
            // 'fileupload_6'               => 'nullable|string|max:255',
            // 'fileupload_7'               => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $proyek = Proyek::findOrFail($id);
            $proyek->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('proyek/list/page');    
            
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
            Proyek::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('proyek/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getProyek(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_proyek');
        $proyekIdFilter  = $request->get('proyek_id');
        $proyekDihentikanFilter  = $request->get('dihentikan');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $proyek =  DB::table('proyek');
        $totalRecords = $proyek->count();

        if ($namaFilter) {
            $proyek->where('nama_proyek', 'like', '%' . $namaFilter . '%');
        }

        if ($proyekIdFilter) {
            $proyek->where('proyek_id', 'like', '%' . $proyekIdFilter . '%');
        }

        if ($proyekDihentikanFilter  !== null && $proyekDihentikanFilter !== '') {
            $proyek->where('dihentikan', $proyekDihentikanFilter);
        }

        $totalRecordsWithFilter = $proyek->count();

        $records = $proyek
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="proyek_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"              => $checkbox,
                "no"                    => $start + $key + 1,
                "id"                    => $record->id,
                "proyek_id"             => $record->proyek_id,
                "nama_proyek"           => $record->nama_proyek,
                'nama_kontak'           => $record->nama_kontak,
                "deskripsi"             => $record->deskripsi,
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
