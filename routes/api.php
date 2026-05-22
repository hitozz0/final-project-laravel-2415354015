<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CustomersController;

Route::apiResource("services", ServiceController::class);
Route::patch("services/{service}/activate", [ServiceController::class,"activate",]);
Route::patch("services/{service}/deactivate", [ServiceController::class,"deactive",]);

Route::apiResource("customers", CustomersController::class);
Route::patch("services/{service}/activate", [CustomersController::class,"activate",]);
Route::patch("services/{service}/deactivate", [CustomersController::class,"deactive",]);


