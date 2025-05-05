<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use DB;

class CustomerController extends Controller
{
    // View Page All Customer
    public function allCustomers()
    {
        $allCustomers = DB::table('customers')->get();
        return view('formcustomers.allcustomers',compact('allCustomers'));
    }

    /** Page Customer */
    public function addCustomer()
    {
        $data = DB::table('room_types')->get();
        $user = DB::table('users')->get();
        return view('formcustomers.addcustomer',compact('data','user'));
    }

    /** Save Record */
    public function saveCustomer(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'room_type'     => 'required|string|max:255',
            'total_numbers' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'arrival_date'  => 'required|string|max:255',
            'depature_date' => 'required|string|max:255',
            'email'      => 'required|string|max:255',
            'phone_number'  => 'required|string|max:255',
            'fileupload' => 'required|file',
            'message'    => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $photo= $request->fileupload;
            $file_name = rand() . '.' .$photo->getClientOriginalName();
            $photo->move(public_path('/assets/upload/'), $file_name);
           
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->room_type     = $request->room_type;
            $customer->total_numbers  = $request->total_numbers;
            $customer->date  = $request->date;
            $customer->time  = $request->time;
            $customer->arrival_date   = $request->arrival_date;
            $customer->depature_date  = $request->depature_date;
            $customer->email       = $request->email;
            $customer->ph_number   = $request->phone_number;
            $customer->fileupload  = $file_name;
            $customer->message     = $request->message;
            $customer->save();
            
            DB::commit();
            flash()->success('Create new customer successfully :)');
            return redirect()->back();
            
        } catch(\Exception $e) {
            DB::rollback();
            flash()->error('Add Customer fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    /** View Detail */
    public function updateCustomer($bkg_customer_id)
    {
        $customerEdit = DB::table('customers')->where('bkg_customer_id',$bkg_customer_id)->first();
        return view('formcustomers.editcustomer',compact('customerEdit'));
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
                'bkg_customer_id' => $request->bkg_customer_id,
                'name'            => $request->name,
                'room_type'       => $request->room_type,
                'total_numbers'   => $request->total_numbers,
                'date'            => $request->date,
                'time'            => $request->time,
                'arrival_date'    => $request->arrival_date,
                'depature_date'   => $request->depature_date,
                'email'           => $request->email,
                'ph_number'       => $request->phone_number,
                'fileupload'      => $file_name,
                'message'         => $request->message,
            ];
            Customer::where('bkg_customer_id',$request->bkg_customer_id)->update($update);
        
            DB::commit();
            flash()->success('Updated customer successfully :)');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            flash()->error('Update customer fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }
    
    /** Delete Record */
    public function deleteRecord(Request $request)
    {
        try {

            Customer::destroy($request->id);
            unlink('assets/upload/'.$request->fileupload);
            flash()->success('Customer deleted successfully :)');
            return redirect()->back();
        
        } catch(\Exception $e) {
            DB::rollback();
            flash()->error('Customer delete fail :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

}
