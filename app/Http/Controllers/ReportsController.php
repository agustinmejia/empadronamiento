<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Person;

class ReportsController extends Controller
{
    public function people_browse(){
        return view('reports.people-browse');
    }

    public function people_list(Request $request){
        $group_by = $request->group_by;
        $summary = $request->summary;
        $people = Person::whereRaw($request->provincia ? "provincia = '".$request->provincia."'" : 1)
                    ->whereRaw($request->municipio ? "municipio = '".$request->municipio."'" : 1)
                    ->whereRaw($request->localidad ? "localidad = '".$request->localidad."'" : 1)
                    ->whereRaw($request->status != '' ? "estado = $request->status" : 1)
                    ->get();
        return view('reports.people-list', compact('people', 'group_by', 'summary'));
    }
}
