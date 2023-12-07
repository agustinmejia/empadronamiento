<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ReportsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('admin');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('people/list/ajax', [PeopleController::class, 'list'])->name('people.list');

    Route::get('people/{id}/credential', function ($id) {
        $person = App\Models\Person::find($id);
        return view('vendor.voyager.people.credential', compact('person'));
    })->name('people.credential');
    
    Route::get('people/{id}/credential/download', function ($id) {
        $response = Http::get('https://image-from-url.ideacreativa.dev/generate?url='.route('people.credential', $id));
        if($response->ok()){
            $res = json_decode($response->body());
            $filename = 'credencial.png';
            $tempImage = tempnam(sys_get_temp_dir(), $filename);
            copy($res->url, $tempImage);
            return response()->download($tempImage, $filename);
        }else{
            return "Error";
        }
    })->name('people.credential.download');

    Route::get('reports/people', [ReportsController::class, 'people_browse'])->name('reports.people');
    Route::post('reports/people/generate', [ReportsController::class, 'people_list'])->name('reports.people.generate');
});

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
