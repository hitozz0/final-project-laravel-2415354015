<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CustomersController;

Route::apiResource("services", ServiceController::class);
Route::patch("services/{service}/activate", [ServiceController::class,"activate",]);
Route::patch("services/{service}/deactivate", [ServiceController::class,"deactivate",]);

Route::apiResource("customers", CustomersController::class);
Route::patch("customers/{id}/activate", [CustomersController::class,"activate",]);
Route::patch("customers/{id}/deactivate", [CustomersController::class,"deactivate",]);


