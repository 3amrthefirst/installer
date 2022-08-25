<?php

namespace App\Services\Adders;

use App\Models\Adder;
use App\Models\User;
use Illuminate\Http\Request;

class installer_AdderService
{
public function indexAdders()
{
    $data = Adder::with('users')->get();
    return $data ;
}
public function indexInstallers()
{
    $data = User::with('adders')->get();
    return $data ;
}

public function showAdder($id)
{
    $data = Adder::with('users')->where('id' , '=' , $id)->get();
    return $data ;
}

public function showInstaller($id)
{
    $data = User::with('adders')->where('id' , '=' , $id)->get();
    return $data ;
}

public function store(Request $request)
{
    $user = auth()->user();
        $arr = is_array($request->all());
        if($arr){
            foreach ($request->data as $reqord){
                $data =  $user->Adders()->syncWithoutDetaching( [ $reqord['adder_id']  => [
                        'price'    => $reqord['price'] ,
                        'unit'     => $reqord['unit'],
                    ] ]
                );
            }
        }
        else{
            $data =  $user->Adders()->syncWithoutDetaching( [ $request->adder_id  => [
                    'price'    => $request->price ,
                    'unit'     => $request->unit,
                ] ]
            );
        }

    return $data ;
}
public function show($id){
    $user = auth()->user();
    $data = $user->Adders()->where('adder_id' , '=' , $id)->get();
    return $data;
}
public function show_adder($id){
    $adder_id = Adder::findOrFail($id);
    return  $adder_id;
}
public function update(Request $request , $id)
{
    $user = auth()->user();
    $this->show_adder($id);
    foreach ($request->data as $reqord){
        $data =  $user->Adders()->syncWithoutDetaching( [ $id  => [
                'price'    => $reqord['price'] ,
                'unit'     => $reqord['unit'],
            ] ]
        );
    }
    return $data ;
}

public function destroy($id)
{

    $user = auth()->user();
    $adder_id = $this->show_adder($id);
    $user->Adders()->detach($adder_id);

return "deleted" ;
}

}
