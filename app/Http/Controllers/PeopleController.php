<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Person;

class PeopleController extends Controller
{
    public function list(){
        $search = request('search') ?? null;
        $status = request('status') ?? null;
        $paginate = request('paginate') ?? 10;
        // dd($status);
        $data = Person::where(function($query) use ($search){
                    if($search){
                        $query->OrwhereHas('user', function($query) use($search){
                            $query->whereRaw("name like '%$search%'");
                        })
                        ->OrWhereRaw("id = '$search'")
                        ->OrWhereRaw("nombre_completo like '%$search%'")
                        ->OrWhereRaw("ci like '%$search%'")
                        ->OrWhereRaw("provincia like '%$search%'")
                        ->OrWhereRaw("municipio like '%$search%'")
                        ->OrWhereRaw("localidad like '%$search%'")
                        ->OrWhereRaw("operador like '%$search%'");
                    }
                })
                ->whereRaw($status != '' ? "estado = $status" : 1)
                ->orderBy('nombre_completo', 'ASC')->paginate($paginate);
        return view('vendor.voyager.people.list', compact('data'));
    }
}
