<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomersController extends Controller
{
    private string $url = "http://127.0.0.1:8000/api/customers";

    public function index(Request $req) : View {
        $query = [];
        if ($req->has("status")) {
            $query["status"] = $req->status;
        }

        $resp = Http::get($this->url, $query);
        $cust = $resp->successful() ? $resp->json("data") : [];

        return view("customers.index", [
            "active" => "customers",
            "customers" => $cust,
        ]);
    }
    public function store(Request $req) : RedirectResponse {
        $resp = Http::post($this->url, [
            "customer_id" => $req->customer_id,
            "name" => $req->name,
            "email" => $req->email,
            "phone" => $req->phone,
            "address" => $req->address,
            "status" => $req->status === "active",
        ]);

        if ($resp->successful()) {
            return redirect()
                ->route("customers.index")
                ->with("toast_success", $resp->json("message"));
        }

        if ($resp->status() === 422) {
            return back()
                ->withErrors($resp->json("errors") ?? [])
                ->withInput()
                ->with("toast_error", $resp->json("message"))
                ->with("open_modal", "addDataModal");
        }
        return back()
            ->withInput()
            ->with("toast_error", $resp->json("message") ?? "Something went wrong");
    }
    public function update(Request $req, int $id) : RedirectResponse {
        $resp = Http::patch("{$this->url}/{$id}", [
            "customer_id" => $req->customer_id,
            "name" => $req->name,
            "email" => $req->email,
            "phone" => $req->phone,
            "address" => $req->address,
            "status" => $req->status === "active",
        ]);

        if ($resp->successful()) {
            return redirect()
                ->route("customers.index")
                ->with("toast_success", $resp->json("message"));
        }

        if ($resp->status() === 422) {
            return back()
                ->withErrors($resp->json("errors") ?? [])
                ->withInput()
                ->with("toast_error", $resp->json("message"))
                ->with("open_modal", "editDataModal")
                ->with("edit_customer_id", $id);
        }
        return back()
            ->withInput()
            ->with("toast_error", $resp->json("message") ?? "Something went wrong");
    }
    public function destroy(int $id) : RedirectResponse {
        $resp = Http::delete("{$this->url}/{$id}");

        if ($resp->successful()) {
            return redirect()
                ->route("customers.index")
                ->with("toast_success", $resp->json("message"));
        }

        return back()->with(
            "toast_error",
            $resp->json("message") ?? "Something went wrong",
        );
    }
    public function activate(int $id) : RedirectResponse{
        $resp = Http::patch("{$this->url}/{$id}/activate");

        if ($resp->successful()) {
            return redirect()
                ->route("customers.index")
                ->with("toast_success", $resp->json("message"));
        }

        return back()->with(
            "toast_error",
            $resp->json("message") ?? "Something went wrong",
        );
    }
    public function deactivate(int $id) : RedirectResponse{
        $resp = Http::patch("{$this->url}/{$id}/deactivate");

        if ($resp->successful()) {
            return redirect()
                ->route("customers.index")
                ->with("toast_success", $resp->json("message"));
        }

        return back()->with(
            "toast_error",
            $resp->json("message") ?? "Something went wrong",
        );
    }
}
