<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Customer;

class CustomerController extends Controller
{
    /*public function checkCustomer(Request $request)
    {
        //$customer = Customer::where('national_id',$request->national_id)->first();

        $national_id = Redis::get('national_'.$request->national_id);

        if($national_id)
        {

        }
        /*
        if($customer) //update
        {
            $customer->update($request->all());
            return "updated";
        }
        else
        {
            Customer::create($request->all());
            return "created";
        }*/
    //}*/

    public function checkCustomer(Request $request)
    {
        $customerId = Redis::get('national_'.$request->national_id);
        //return $customerId;
        //$customerId = Customer::where('national_id',$request->national_id)->first()->national_id;
        if($customerId)
        {
            info("Line 40");
            Customer::where('id',$customerId)->update($request->all());
        }
        else
        {
            info('Line 45');
            Customer::create($request->all());
        }
    }

}
