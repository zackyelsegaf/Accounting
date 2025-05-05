<?php

namespace App\Http\Controllers;

use App\Models\Syarat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class SyaratController extends Controller
{
    public function syaratList()
    {
        return view('syarat.listsyarat');
    }

    public function SyaratAddNew()
    {
        return view('syarat.syarataddnew');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'batas_hutang'      => 'required|string|max:255',
            'cash_on_delivery'  => 'required|boolean',
            'persentase_diskon' => 'required|string|max:255',
            'periode_diskon'    => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $syarat = Syarat::findOrFail($id);
            $syarat->update($validated);
            
            DB::commit();
            sweetalert()->success('Updated record successfully :)');
            return redirect()->route('syarat/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $syarat = Syarat::findOrFail($id);
        if (!$syarat) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('syarat.syaratedit', compact('syarat'));
    }

    public function saveRecordSyarat(Request $request){
        $validated = $request->validate([
            'nama'              => 'required|string|max:255',
            'batas_hutang'      => 'required|string|max:255',
            'cash_on_delivery'  => 'required|boolean',
            'persentase_diskon' => 'required|string|max:255',
            'periode_diskon'    => 'required|string|max:255',
        ]);

        //debug
        // DB::enableQueryLog();
        // MataUang::create($request->all());
        // dd(DB::getQueryLog());

        DB::beginTransaction();
        try {
            $syarat = new Syarat($validated);
            $syarat->save();
            
            DB::commit();
            sweetalert()->success('Create new Syarat successfully :)');
            return redirect()->route('syarat/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal :)');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Syarat::whereIn('id', $ids)->delete();
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('syarat/list/page');    
            
        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getSyarat(Request $request)
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

        $syarat =  DB::table('syarat');
        $totalRecords = $syarat->count();

        if ($namaFilter) {
            $syarat->where('nama', 'like', '%' . $namaFilter . '%');
        }

        $totalRecordsWithFilter = $syarat->count();

        $records = $syarat
            ->orderBy($columnName, $columnSortOrder)
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];

        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="syarat_checkbox" value="'.$record->id.'">';

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
