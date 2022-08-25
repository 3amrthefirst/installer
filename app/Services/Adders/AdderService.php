<?php

namespace App\Services\Adders;

use App\Models\Adder;
use Illuminate\Http\Request;

class AdderService
{
public function index()
{
    $data = Adder::all();
    return $data ;
}
public function indexPaginate()
{
    $data = Adder::paginate(10);
    return $data ;
}
public function show($id)
{
    $data = Adder::findOrFail($id);
    return $data ;
}
public function store(Request $request)
{
    $data = Adder::create($request->all());
    return $data ;
}
public function update(Request $request , $id)
{
    $id = $this->show($id);
    $data = $id->update($request->all());
    return $data ;
}
public function destroy($id)
{
$user = $this->show($id);
$user->delete();
return "deleted" ;
}

}
