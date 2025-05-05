<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsumen;
use Illuminate\Support\Facades\DB;

class KonsumenController extends Controller
{
    public function daftarKonsumen()
    {
        return view('konsumen.datakonsumen');
        
    }

    public function tambahKonsumen()
    {
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $jenis_kelamin = DB::table('gender')->orderBy('nama', 'asc')->get();
        $pekerjaan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        $cluster = DB::table('cluster')->orderBy('nama', 'asc')->get();
        $status_pengajuan = DB::table('status_pengajuan')->orderBy('nama', 'asc')->get();
        return view('konsumen.tambahkonsumen', compact('kota', 'provinsi', 'jenis_kelamin', 'pekerjaan', 'cluster', 'status_pengajuan'));
    }

    public function simpanKonsumen(Request $request){
        
        $validate = $request->validate([
            'nama_konsumen'    => 'nullable|string|max:255',
            'nik_konsumen'     => 'nullable|string|max:255',
            'no_hp'            => 'nullable|string|max:255',
            'status_pengajuan' => 'nullable|string|max:255',
            'jenis_kelamin'    => 'nullable|string|max:255',
            'cluster'          => 'nullable|string|max:255',
            'provinsi'         => 'nullable|string|max:255',
            'kota'             => 'nullable|string|max:255',
            'kecamatan'        => 'nullable|string|max:255',
            'kelurahan'        => 'nullable|string|max:255',
            'alamat_konsumen'  => 'nullable|string|max:255',
            'pekerjaan'        => 'nullable|string|max:255',
            'marketing'        => 'nullable|string|max:255',
            'nik_pasangan'     => 'nullable|string|max:255',
            'nama_pasangan'    => 'nullable|string|max:255',
            'no_hp_pasangan'   => 'nullable|string|max:255',
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

            $konsumen = new Konsumen($validate);
            $konsumen->save();

            DB::commit();
            sweetalert()->success('Create new cluster successfully :)');
            return redirect()->route('konsumen/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function editKonsumen($id)
    {
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $jenis_kelamin = DB::table('gender')->orderBy('nama', 'asc')->get();
        $pekerjaan = DB::table('tipe_pelanggan')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        $cluster = DB::table('cluster')->orderBy('nama', 'asc')->get();
        $status_pengajuan = DB::table('status_pengajuan')->orderBy('nama', 'asc')->get();
        $Konsumen = Konsumen::findOrFail($id);
        if (!$Konsumen) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('konsumen.ubahkonsumen', compact('Konsumen', 'kota', 'provinsi', 'jenis_kelamin', 'pekerjaan', 'cluster', 'status_pengajuan'));
    }

    public function updateKonsumen(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_konsumen'    => 'nullable|string|max:255',
            'nik_konsumen'     => 'nullable|string|max:255',
            'no_hp'            => 'nullable|string|max:255',
            'status_pengajuan' => 'nullable|string|max:255',
            'jenis_kelamin'    => 'nullable|string|max:255',
            'cluster'          => 'nullable|string|max:255',
            'provinsi'         => 'nullable|string|max:255',
            'kota'             => 'nullable|string|max:255',
            'kecamatan'        => 'nullable|string|max:255',
            'kelurahan'        => 'nullable|string|max:255',
            'alamat_konsumen'  => 'nullable|string|max:255',
            'pekerjaan'        => 'nullable|string|max:255',
            'marketing'        => 'nullable|string|max:255',
            'nik_pasangan'     => 'nullable|string|max:255',
            'nama_pasangan'    => 'nullable|string|max:255',
            'no_hp_pasangan'   => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $konsumen = Konsumen::findOrFail($id);
            $konsumen->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('konsumen/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Updated record failed :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusKonsumen(Request $request)
    {
        try {
            $ids = $request->ids;
            Konsumen::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('konsumen/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataKonsumen(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_konsumen');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $konsumen =  DB::table('konsumen');
        $totalRecords = $konsumen->count();

        if ($namaFilter) {
            $konsumen->where('nama_konsumen', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $konsumen->count();

        $records = $konsumen
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
            
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="konsumen_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"      => $checkbox,
                "no"            => $start + $key + 1,
                "id"            => $record->id,
                "nik_konsumen"  => $record->nik_konsumen,
                "nama_konsumen" => $record->nama_konsumen,
                'no_hp'         => $record->no_hp,
                // 'email'         => $record->email,
                'cluster'       => $record->cluster,
                'kota'          => $record->kota,
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
