<?php

namespace App\Services\Jobs;

use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobsService
{
public function index()
{
    $data = WorkOrder::all();
    return $data ;
}
public function indexPaginate()
{
    $data = WorkOrder::paginate(10);
    return $data ;
}
public function show($id)
{
    $data = WorkOrder::findOrFail($id);
    return $data ;
}
public function store(Request $request)
{
    $zohoToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiOTI3NmEwZmY5ZmNiZTJkNTRjNDc4M2Q2NTA0MjRmZTJjYzVmMmZkMWYxMGZjNDhjMzIzNThjOTZhZjY1M2ZmMWQ1NmRkNjljNDJlZTY5ZmEiLCJpYXQiOjE2NjE5NjMxMjMuNDAyMjU3OTE5MzExNTIzNDM3NSwibmJmIjoxNjYxOTYzMTIzLjQwMjI2MTk3MjQyNzM2ODE2NDA2MjUsImV4cCI6MTY5MzQ5OTEyMy4zOTgyNjc5ODQzOTAyNTg3ODkwNjI1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.pFrDp0OK3_VSAkABizOyEHTzJZV3hBjLoqZh3H5aS0S0mlthI3eRquR0TDSyQ5huLkR_niDmDSJz6c4LbfLjrMxMn_IEOQg2Msy_WHtP2lQAJLjtGcwZqzJZ-F1wrsPPLQTkQBvKvgzNdsqeoGBbXivOV2mCPwynHN4kRdgT2ahJmpAlWE8eEgl_eTwAW9aQ6NVjIPug0DHH4sMPxjQ_7JC0S3ssbNiyddAwJvfHFJLEkdSgmu9dQOD7IoPtZgGL3TYQ-CjmaiEo7VT_gLDnW8-Ph3o9A-C4FvxbAYX-RDqCerorst3gP7V0EhbBDGm6h0R9FrvIXHwion9_gqmGwaJB2vaQixEDdAL3C3bEyZGpa-XcCq5svyEGMIInez_UJeCUJm8oPpF86bB6pDjwslKyeCmVKIwMDry1_j_zuqdwbWeRkMoshuE0x7ZkAJkZelZLhldNIK4F1rqLquYxNZTcJnOfTBi6_3NJ1k16YxZvqMmFsHQFqqkoL9abWtvfzU-wBUL6G23dliZ1OUMubkxFi7v9Q78Nlg_0WDR34z8jw796m59rzniPDMnx5KdHipiRB0vzZ4R-KaeDg0VsvWwfYR6CQWy7rxjY8TyerTAMfoRcIDjmnPTteKQWBh__tdu15fk9VthH3Im1_bwS7Wt83FwLM38TkyZe3C5t9NU";
    $getData = Http::withToken($zohoToken)->get('http://pmb.boxbyld.tech/api/tickets/17');
    $jsonResponse = $getData->json();

    $data = WorkOrder::create([
       'client_name' => $jsonResponse['data']['ticket']['client_name'] ,
       'client_address' => $jsonResponse['data']['ticket']['client_address'] ,
       'job_description' => $jsonResponse['data']['ticket']['note'] ,
    ]);
    return $data ;
}

public function destroy($id)
{
$user = $this->show($id);
$user->delete();
return "deleted" ;
}

}
