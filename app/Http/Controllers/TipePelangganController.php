<?php

namespace App\Http\Controllers;

use App\Models\TipePelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class TipePelangganController extends Controller
{

    public function tipePelangganList()
    {
        return view('tipepelanggan.listtipepelanggan');
    }

    public function TipePelangganAddNew()
    {
        return view('tipepelanggan.tipepelangganaddnew');
    }

    public function saveRecordTipePelanggan(Request $request){
        $request->validate([
            'nama'          => 'required|string|max:255',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {
            $tipePelanggan = new TipePelanggan();
            $tipePelanggan->nama         = $request->nama;
            $tipePelanggan->save();
            
            DB::commit();
            sweetalert()->success('Create new Tipe Pelanggan successfully :)');
            return redirect()->route('tipepelanggan/list/page');    
            
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
            TipePelanggan::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('tipepelanggan/list/page');    
            
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
            $tipePelanggan = TipePelanggan::findOrFail($id);
            $tipePelanggan->nama = $request->nama;
            $tipePelanggan->save();
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('tipepelanggan/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $tipePelanggan = TipePelanggan::findOrFail($id);
        if (!$tipePelanggan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('tipepelanggan.tipepelangganedit', compact('tipePelanggan'));
    }

    public function getTipePelanggan(Request $request)
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

        $tipe_pelanggan =  DB::table('tipe_pelanggan');
        $totalRecords = $tipe_pelanggan->count();

        if ($namaFilter) {
            $tipe_pelanggan->where('nama', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $tipe_pelanggan->count();

        $records = $tipe_pelanggan
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="tipe_pelanggan_checkbox" value="'.$record->id.'">';

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
