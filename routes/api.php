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

Route::get('/contacts/{id}', function (Request $request, $id) {
    $contacts = App\Models\Contact::where('id', $id)->get();
    return  response()->json($contacts[0]);
});

Route::put('/contacts/{id}', function (Request $request, $id) {
    $contacts = App\Models\Contact::where('id', $id)->get();
    $contact  = $contacts[0];
    $contact->name = $request->json()->all()["name"];
    $contact->address = $request->json()->all()["address"];
    $contact->phone = $request->json()->all()["phone"];
    $colorString = $request->json()->all()["color"];
    $colors = explode(",", $colorString);
    $cleanColors = array_map('trim', $colors);
    $contact->favorites = ["colors" => $cleanColors];
    $contact->save();
    return  response()->json($contact);
});

