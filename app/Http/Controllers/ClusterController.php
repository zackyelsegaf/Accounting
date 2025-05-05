<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cluster;
use Illuminate\Support\Facades\DB;

class ClusterController extends Controller
{
    public function daftarCluster()
    {
        return view('cluster.datacluster');
        
    }

    public function tambahCluster()
    {
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        return view('cluster.tambahcluster', compact('kota', 'provinsi'));
    }

    public function simpanCluster(Request $request){
        
        $validate = $request->validate([
            'nama_cluster'   => 'nullable|string|max:255',
            'no_hp'          => 'nullable|string|max:255',
            'luas_tanah'     => 'nullable|string|max:255',
            'total_unit'     => 'nullable|string|max:255',
            'provinsi'       => 'nullable|string|max:255',
            'kota'           => 'nullable|string|max:255',
            'kecamatan'      => 'nullable|string|max:255',
            'kelurahan'      => 'nullable|string|max:255',
            'alamat_cluster' => 'nullable|string|max:255',
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

            $cluster = new Cluster($validate);
            $cluster->save();

            DB::commit();
            sweetalert()->success('Create new cluster successfully :)');
            return redirect()->route('cluster/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function editCluster($id)
    {
        $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
        $kota = DB::table('kota')->orderBy('nama', 'asc')->get();
        $Cluster = Cluster::findOrFail($id);
        if (!$Cluster) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('cluster.ubahcluster', compact('Cluster', 'kota', 'provinsi'));
    }

    public function updateCluster(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_cluster'   => 'nullable|string|max:255',
            'no_hp'          => 'nullable|string|max:255',
            'luas_tanah'     => 'nullable|string|max:255',
            'total_unit'     => 'nullable|string|max:255',
            'provinsi'       => 'nullable|string|max:255',
            'kota'           => 'nullable|string|max:255',
            'kecamatan'      => 'nullable|string|max:255',
            'kelurahan'      => 'nullable|string|max:255',
            'alamat_cluster' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $cluster = Cluster::findOrFail($id);
            $cluster->update($validate);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('cluster/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function hapusCluster(Request $request)
    {
        try {
            $ids = $request->ids;
            Cluster::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('cluster/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function dataCluster(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $namaFilter      = $request->get('nama_cluster');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc

        $cluster =  DB::table('cluster');
        $totalRecords = $cluster->count();

        if ($namaFilter) {
            $cluster->where('nama_cluster', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $cluster->count();

        $records = $cluster
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="cluster_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "nama_cluster" => $record->nama_cluster,
                'kota'         => $record->kota,
                "no_hp"        => $record->no_hp,
                'luas_tanah'   => $record->luas_tanah,
                'total_unit'   => $record->total_unit,
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
