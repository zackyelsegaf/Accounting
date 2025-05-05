<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;

class UserManagementController extends Controller
{
    /** User List */
    public function userList()
    {
        return view('usermanagement.listuser');
    }

    /** Add Neew Users */
    public function userAddNew()
    {
        return view('usermanagement.useraddnew');
    }

    /** View Record */
    public function userView($user_id)
    {
        $userData = User::where('user_id',$user_id)->first();
        return view('usermanagement.useredit',compact('userData'));
    }

    /** Update Record */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->avatar)) {
                $photo = $request->avatar;
                $file_name = rand() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('/assets/img/'), $file_name);
            } else {
                $file_name = $request->hidden_avatar;
            }
            $updateRecord = [
                'name'         => $request->name,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
                'position'     => $request->position,
                'avatar'       => $file_name,
                'department'   => $request->department,
            ];
            User::where('user_id',$request->user_id)->update($updateRecord);
        
            DB::commit();
            flash()->success('Updated record successfully :)');
            return redirect()->route('users/list/page');    
        } catch(\Exception $e) {
            DB::rollback();
            flash()->error('Update record fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    /** Delete Record */
    public function userDelete($id)
    {
        try {

            $deleteRecord = User::find($id);
            $deleteRecord->delete();
            flash()->success('User deleted successfully :)');
            return redirect()->back();
        
        } catch(\Exception $e) {
            DB::rollback();
            flash()->error('User delete fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $userEdit = User::findOrFail($id);
        if (!$userEdit) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        return view('usermanagement.useredit', compact('userEdit'));
    }

    /** Get Users Data */
    public function getUsersData(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $rowPerPage      = $request->get("length"); // total number of rows per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $search_arr      = $request->get('search');

        $columnIndex     = $columnIndex_arr[0]['column']; // Column index
        $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue     = $search_arr['value']; // Search value

        $users =  DB::table('users');
        $totalRecords = $users->count();

        $totalRecordsWithFilter = $users->where(function ($query) use ($searchValue) {
            $query->where('name', 'like', '%' . $searchValue . '%');
            $query->orWhere('email', 'like', '%' . $searchValue . '%');
            $query->orWhere('position', 'like', '%' . $searchValue . '%');
            $query->orWhere('phone_number', 'like', '%' . $searchValue . '%');
            $query->orWhere('status', 'like', '%' . $searchValue . '%');
        })->count();

        if ($columnName == 'name') {
            $columnName = 'name';
        }
        $records = $users->orderBy($columnName, $columnSortOrder)
            ->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
                $query->orWhere('email', 'like', '%' . $searchValue . '%');
                $query->orWhere('position', 'like', '%' . $searchValue . '%');
                $query->orWhere('phone_number', 'like', '%' . $searchValue . '%');
                $query->orWhere('status', 'like', '%' . $searchValue . '%');
            })
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = [];
        
        foreach ($records as $key => $record) {
            $checkbox = '<input type="checkbox" class="userlist_checkbox" value="'.$record->user_id.'">';

            if (!empty($record->avatar) && file_exists(public_path('assets/img/'.$record->avatar))) {
                $avatarUrl = asset('../../public/assets/img/'.$record->avatar);
            } else {
                $avatarUrl = asset('assets/img/profile.png');
            }
        
            $avatarImg = '<img src="'.$avatarUrl.'" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">';

            // $modify = '
            //     <td class="text-right">
            //         <div class="dropdown dropdown-action">
            //             <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            //                 <i class="fas fa-ellipsis-v ellipse_color"></i>
            //             </a>
            //             <div class="dropdown-menu dropdown-menu-right">
            //                 <a class="dropdown-item" href="'.url('users/add/edit/'.$record->user_id).'">
            //                     <i class="fas fa-pencil-alt m-r-5"></i> Edit
            //                 </a>
            //                 <a class="dropdown-item" href="'.url('users/delete/'.$record->id).'">
            //                     <i class="fas fa-trash-alt m-r-5"></i> Delete
            //                 </a>
            //             </div>
            //         </div>
            //     </td>
            // ';
        
            $data_arr[] = [
                "checkbox"     => $checkbox,
                "no"           => $start + $key + 1,
                "id"           => $record->id,
                "user_id"      => $record->user_id,
                "avatar"       => $avatarImg,
                "name"         => $record->name,
                "email"        => $record->email,
                "position"     => $record->position,
                "phone_number" => $record->phone_number,
                "status"       => $record->status, 
                // "modify"       => $modify, 
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
