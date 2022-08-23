<?php

namespace App\Services\BusinessLicence;

use App\Models\BusinessLicense;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BusinessLicenceService
{
    public function index()
    {
        //
        $data = BusinessLicense::with('user')->get();
        return $data ;
    }

    public function indexPaginate()
    {
        $data = BusinessLicense::with('user')->paginate(10);
        return $data ;
    }

    public function store(Request $request)
    {
        //
        $license_img =$request->file('license_img');
        $image_name = date('YmdHi').$license_img->getClientOriginalName();
        $license_expiration_date = Carbon::parse($request->license_expiration_date)->format('y-m-d') ;
        if ( $request->hasFile('license_img')) {
                $license_img->move(public_path('/images/license'), $image_name);
                $data = BusinessLicense::create([
                    'user_id' => auth()->user()->id,
                    'license_number' => $request->license_number,
                    'license_img' => '/images/license/' . $image_name,
                    'license_type' => $request->license_type,
                    'phone' => $request->phone,
                    'state' => $request->state,
                    'license_expiration_date' => $license_expiration_date,
                ]);
            }
        return $data;
    }

    public function show($id)
    {
        //
        $data = BusinessLicense::findorfail($id);
        return $data ;
    }

    public function update(Request $request ,$id)
    {
        //
        $user_data = $this->show($id);
        $license_expiration_date = Carbon::parse($request->license_expiration_date)->format('y-m-d') ;
        $logo = $request->file('license_img');

        if ( $request->hasFile('license_img')) {
            $image_name = date('YmdHi').$logo->getClientOriginalName();
            $logo->move(public_path('/images/license'), $image_name);
            $data = $user_data->update([
                'user_id' => auth()->user()->id,
                'license_number' => $request->license_number,
                'license_img' => '/images/license/' . $image_name,
                'license_type' => $request->license_type,
                'phone' => $request->phone,
                'state' => $request->state,
                'license_expiration_date' => $license_expiration_date,
            ]);
        }

        if($request->has('date_of_origination')){
            $user_data->update([
                'date_of_origination' =>  $license_expiration_date
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

    public function search($search){
        $data = BusinessLicense::where('phone' , 'LIKE' , "%$search%")
            ->orWhere('state' , 'LIKE' , "%$search%")->get();
        return $data;
    }
}
