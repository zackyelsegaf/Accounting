<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use DB;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function storeUser(Request $request)
    {
        try {
            $request->validate([
                'name'         => 'nullable|string|max:255',
                'email'        => 'nullable|string|email|max:255|unique:users',
                'role_name'    => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:255',
                'position'     => 'nullable|string|max:255',
                'department'   => 'nullable|string|max:255',
                'avatar'       => 'nullable|file',
                'password'     => 'nullable|string|min:8|confirmed',
                'password_confirmation' => 'nullable',
            ]);

            $dt         = Carbon::now();
            $join_date  = $dt->toDayDateTimeString();

            $file_name = null;
            if ($request->hasFile('avatar')) {
                $photo = $request->file('avatar');
                $file_name = rand() . '.' . $photo->getClientOriginalName();
                $photo->move(public_path('/assets/img/'), $file_name);
            }

            $user = new User();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->phone_number = $request->phone_number;
            $user->join_date    = $join_date;
            $user->role_name    = $request->role_name;
            $user->position     = $request->position;
            $user->department   = $request->department;
            $user->avatar       = $file_name;
            $user->password     = Hash::make($request->password);
            $user->save();

            sweetalert()->success('Create new account successfully :)');
            return redirect('login');
        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

}
