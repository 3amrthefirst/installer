<?php

namespace App\Services\Jobs;

use App\Models\Adder;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class installer_OrdersService
{
public function indexOrders()
{
    $data = WorkOrder::with('users')->get();
    return $data ;
}
public function indexInstallers()
{
    $data = User::with('Orders')->get();
    return $data ;
}

public function showOrders($id)
{
    $data = WorkOrder::with('users')->where('id' , '=' , $id)->get();
    return $data ;
}

public function showInstaller($id)
{
    $data = User::with('Orders')->where('id' , '=' , $id)->get();
    return $data ;
}

public function store(Request $request)
{


        foreach ($request->data as $reqord){

            $job = WorkOrder::findOrFail($reqord['job_id']);
            $data =  $job->Users()->syncWithoutDetaching( [ $reqord['user_id']  => [
                    'price'    => $reqord['price'] ,
                ] ]
            );
        }
    return $data ;
}

public function show($id){
    $user = auth()->user();
    $data = $user->Orders()->where('job_id' , '=' , $id)->get();
    return $data;
}

public function show_Order($id){
    $adder_id = WorkOrder::findOrFail($id);
    return  $adder_id;
}
public function updatePrice($request , $id){
    $user = auth()->user();
    $data =  $user->Orders()->syncWithoutDetaching( [ $id  => [
            'price'    => $request['price'] ,
        ] ]
    );
    return $data ;
}
    public function updateStatus($request ){
        $user = User::findOrFail($request->user_id);
        $data =  $user->Orders()->syncWithoutDetaching( [ $request->order_id  => [
                'status'    => $request['status'] ,
            ] ]
        );
        return $data ;
    }

public function destroy($id)
{

    $user = auth()->user();
    $Orders_id = $this->show_Order($id);
    $user->Orders()->detach($Orders_id);

return "deleted" ;
}

}
