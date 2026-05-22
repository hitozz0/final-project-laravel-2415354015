<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Http\JsonResponse;

class CustomersController extends Controller
{
    public function index(Request $request) : JsonResponse {
        $status = $request->query("status");
        $query = Customers::query();
        if ($status !== null) {
            if (!in_array($status, ["active", "inactive"], true)) {
                return response()->json([
                    "success" => false,
                    "message" => "Validation failed",
                    "errors" => [
                        "status" => ["The selected status is invalid."],
                    ],
                ], 422);
            }
            $query->where("status", $status === "active");
        }
        $customers = $query->latest()->get();

        return response()->json([
            "success" => true,
            "message" => "Customers Data",
            "data" => $customers,
        ]);
    }

    public function store(Request $request) : JsonResponse {
        $data = $request->validate([
            "customer_id" => ["required", "string"],
            "name" => ["required", "string"],
            "email" => ["required", "string"],
            "phone" => ["nullable", "string"],
            "address" => ["nullable", "string"],
            "status" => ["nullable", "boolean"],
        ]);

        $data["status"] = $data["status"] ?? true;

        $cust = Customers::query()->create($data);

        return response()->json([
            "success" => true,
            "message" => "New customers created successfully",
            "data" => $cust,
        ], 201);
    }

    public function show(int $id) : JsonResponse {
        $cust = Customers::query()->find($id);
        if (!$cust) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
                "errors" => [],
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Customer data retrieved successfully",
            "data" => $cust,
        ]);
    }

    public function update(Request $request, int $id) : JsonResponse {
        $cust = Customers::query()->find($id);

        if (!$cust) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
                "errors" => [],
            ], 404);
        }

        $data = $request->validate([
            "customer_id" => ["required", "string"],
            "name" => ["required", "string"],
            "email" => ["required", "string"],
            "phone" => ["nullable", "string"],
            "address" => ["nullable", "string"],
            "status" => ["nullable", "boolean"],
        ]);

        $cust->update($data);

        return response()->json([
            "success" => true,
            "message" => "Customer data updated successfully",
            "data" => $cust,
        ]);
    }

    public function destroy(int $id) : JsonResponse {
        $cust = Customers::query()->find($id);

        if (!$cust) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
                "errors" => [],
            ], 404);
        }

        if ($cust->subscriptions()->exists()) {
            return response()->json([
                "success" => false,
                "message" => "Customer data cannot be deleted because it has subscriptions",
                "errors" => [],
            ], 422);
        }

        $cust->delete();

        return response()->json([
            "success" => true,
            "message" => "Customer data deleted successfully",
            "data" => null,
        ]);
    }

    public function activate(int $id): JsonResponse{
        $cust = Customers::query()->find($id);

        if (!$cust) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
                "errors" => [],
            ], 404);
        }

        $cust->update(["status" => true]);

        return response()->json([
            "success" => true,
            "message" => "Customer status activated successfully",
            "data" => $cust,
        ]);
    }

    public function deactivate(int $id): JsonResponse{
        $cust = Customers::query()->find($id);

        if (!$cust) {
            return response()->json([
                "success" => false,
                "message" => "Customer not found",
                "errors" => [],
            ], 404);
        }

        $cust->update(["status" => false]);

        return response()->json([
            "success" => true,
            "message" => "Customer status deactivated successfully",
            "data" => $cust,
        ]);
    }
}
