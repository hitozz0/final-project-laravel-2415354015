<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/customers", [CustomersController::class, "index"])->name("customers.index");
Route::post("/customers", [CustomersController::class, "store"])->name("customers.store");
Route::patch("/customers/{id}", [CustomersController::class, "update"])->name("customers.update");
Route::delete("/customers/{id}", [CustomersController::class, "destroy"])->name("customers.destroy");
Route::patch("/customers/{id}/activate", [
    CustomersController::class,
    "activate",
])->name("customers.activate");
Route::patch("/customers/{id}/deactivate", [
    CustomersController::class,
    "deactivate",
])->name("customers.deactivate");

Route::get("/services", [ServiceController::class, "index"])->name("services.index",);
Route::post("/services", [ServiceController::class, "store"])->name("services.store",);
Route::patch("/services/{id}", [ServiceController::class, "update"])->name("services.update",);
Route::delete("/services/{id}", [ServiceController::class, "destroy"])->name("services.destroy",);
Route::patch("/services/{id}/activate", [
    ServiceController::class,
    "activate",
])->name("services.activate");
Route::patch("/services/{id}/deactivate", [
    ServiceController::class,
    "deactivate",
])->name("services.deactivate");

Route::get("/subscriptions", [SubscriptionController::class, "index"])->name("subscriptions.index",);
Route::post("/subscriptions", [SubscriptionController::class, "store"])->name("subscriptions.store",);
Route::patch("/subscriptions/{id}/activate", [
    SubscriptionController::class,
    "activate",
])->name("subscriptions.activate");
Route::patch("/subscriptions/{id}/deactivate", [
    SubscriptionController::class,
    "deactivate",
])->name("subscriptions.deactivate");
Route::patch("/subscriptions/{id}/trial", [
    SubscriptionController::class,
    "trial",
])->name("subscriptions.trial");
Route::patch("/subscriptions/{id}/isolir", [
    SubscriptionController::class,
    "isolir",
])->name("subscriptions.isolir");
Route::patch("/subscriptions/{id}/dismantle", [
    SubscriptionController::class,
    "dismantle",
])->name("subscriptions.dismantle");