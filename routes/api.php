<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/contacts', function (Request $request) {
    $search = $request->query('search', '');
    $contacts = App\Models\Contact::where('name', 'like', "%$search%")->get();
    return  response()->json($contacts);
});

Route::delete('/contacts/{id}', function (Request $request, $id) {
    App\Models\Contact::where('id', $id)->delete();
    return  response()->json([]);
});
