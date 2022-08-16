<?php

namespace App\Services\BusinessInfo;

use App\Models\BusinessInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BusinessInfoService
{
    public function index()
    {
        //
        $data = BusinessInfo::with('user')->get();
        return $data ;
    }

    public function indexPaginate()
    {
        $data = BusinessInfo::with('user')->paginate(10);
        return $data ;
    }

    public function store(Request $request)
    {
        //

        if ( $request->hasFile('logo_url')) {
                $logo =$request->file('logo_url');
                $image_name = date('YmdHi').$logo->getClientOriginalName();
                $logo->move(public_path('/images/businessInfo'), $image_name);
                $date_of_origination = Carbon::parse($request->date_of_origination)->format('y-m-d');
                $data = BusinessInfo::create([
                    'user_id' => auth()->user()->id,
                    'company_name' => $request->company_name,
                    'phone' => $request->phone,
                    'business_fax' => $request->business_fax,
                    "logo_url" => '/images/businessInfo/' . $image_name,
                    'address' => $request->address,
                    'date_of_origination' => $date_of_origination,
                ]);
            }
        return $data;
    }

    public function show($id)
    {
        //
       $data = BusinessInfo::findorfail($id);
        return $data ;
    }

    public function update(Request $request ,$id)
    {
        //
        $user_data = $this->show($id);
        $date_of_origination = Carbon::parse($request->date_of_origination)->format('y-m-d');
        $logo = $request->file('logo_url');

        if ( $request->hasFile('logo_url')) {
            $image_name = date('YmdHi').$logo->getClientOriginalName();
            $logo->move(public_path('/images/businessInfo'), $image_name);
            $data = $user_data->update([
                'user_id' => auth()->user()->id,
                'company_name' => $request->company_name,
                'phone' => $request->phone,
                'business_fax' => $request->business_fax,
                "logo_url" => '/images/businessInfo/' . $image_name,
                'address' => $request->address,
                'date_of_origination' => $date_of_origination,
            ]);
        }

        if($request->has('date_of_origination')){
            $user_data->update([
                'date_of_origination' =>  $date_of_origination
            ]);
        }
        $data = $user_data->update($request->all());

        return $data;

    }

    public function destroy($id)
    {
        $user_data = $this->show($id);
        $data = $user_data->delete();
        return $data;
    }
    public function search(){
        return 'l';
    }
}
