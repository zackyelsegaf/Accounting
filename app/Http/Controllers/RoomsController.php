<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use DB;

class RoomsController extends Controller
{
    /** Index Page */
    public function allrooms()
    {
        $allRooms = DB::table('rooms')->get();
        return view('room.allroom',compact('allRooms'));
    }

    /** Room Page */
    public function addRoom()
    {
        $data = DB::table('room_types')->get();
        $user = DB::table('users')->get();
        return view('room.addroom',compact('user','data'));
    }

    /** View Record */
    public function editRoom($bkg_room_id)
    {
        $roomEdit = DB::table('rooms')->where('bkg_room_id',$bkg_room_id)->first();
        $data = DB::table('room_types')->get();
        $user = DB::table('users')->get();
        return view('room.editroom',compact('user','data','roomEdit'));
    }

    /** Save Record */
    public function saveRecordRoom(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'room_type'     => 'required|string|max:255',
            'ac_non_ac'     => 'required|string|max:255',
            'food'          => 'required|string|max:255',
            'bed_count'     => 'required|string|max:255',
            'charges_for_cancellation' => 'required|string|max:255',
            'rent'          => 'required|string|max:255',
            'phone_number'  => 'required|string|max:255',
            'fileupload'    => 'required|file',
            'message'       => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $photo= $request->fileupload;
            $file_name = rand() . '.' .$photo->getClientOriginalName();
            $photo->move(public_path('/assets/upload/'), $file_name);
           
            $room = new Room;
            $room->name         = $request->name;
            $room->room_type    = $request->room_type;
            $room->ac_non_ac    = $request->ac_non_ac;
            $room->food         = $request->food;
            $room->bed_count    = $request->bed_count;
            $room->charges_for_cancellation = $request->charges_for_cancellation;
            $room->rent         = $request->rent;
            $room->phone_number = $request->phone_number;
            $room->fileupload   = $file_name;
            $room->message      = $request->message;
            $room->save();
            
            DB::commit();
            flash()->success('Create new room successfully :)');
            return redirect()->back();
            
        } catch(\Exception $e) {
            DB::rollback();
            flash()->error('Add Room fail :)');
            return redirect()->back();
        }
    }

    /** Update Record */
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->fileupload)) {
                $photo = $request->fileupload;
                $file_name = rand() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('/assets/upload/'), $file_name);
            } else {
                $file_name = $request->hidden_fileupload;
            }

            $update = [
                'bkg_room_id'              => $request->bkg_room_id,
                'name'                     => $request->name,
                'room_type'                => $request->room_type,
                'ac_non_ac'                => $request->ac_non_ac,
                'food'                     => $request->food,
                'bed_count'                => $request->bed_count,
                'charges_for_cancellation' => $request->charges_for_cancellation,
                'phone_number'             => $request->phone_number,
                'fileupload'               => $file_name,
                'message'                  => $request->message,
            ];
            Room::where('bkg_room_id',$request->bkg_room_id)->update($update);
        
            DB::commit();
            flash()->error('Updated room successfully :)');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            flash()->error('Update room fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    /** Delete Record */
    public function deleteRecord(Request $request)
    {
        try {

            Room::destroy($request->id);
            unlink('assets/upload/'.$request->fileupload);
            flash()->success('Room deleted successfully :)');
            return redirect()->back();
        
        } catch(\Exception $e) {
            DB::rollback();
            flash()->error('Room delete fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }
}
