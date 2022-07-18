<?php

use App\Models\Advertisement;
use App\Models\ImageLink;
use Database\Factories\ImageLinkFactory;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $advertisement = Advertisement::factory()->has(ImageLink::factory()->count(3))->count(3)->create();

    return $advertisement;
});
