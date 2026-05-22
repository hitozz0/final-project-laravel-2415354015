<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class SubsController extends Controller
{
    public function index(Request $request) : JsonResponse {
        $status = $request->query("status");
        $query = Subscription::query();

        if ($status !== null) {
            if (!in_array($status, ["active", "inactive", "trial", "isoler", "dismantle"], true)) {
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
        $subs = $query->latest()->get();

        return response()->json([
            "success" => true,
            "message" => "subscription Data",
            "data" => $subs,
        ]);
    }

    public function store(Request $request) : JsonResponse {
        $data = $request->validate([
            "customer_id" => ["required", "integer"],
            "service_id" => ["required", "integer"],
            "start_date" => ["nullable", "date"],
            "end_date" => ["nullable", "date"],
            "status" => ["nullable", "boolean"],
        ]);

        $date = now()->toDateString();
        $data["start_date"] = $data["start_date"] ?? $date;
        $data["status"] = $data["status"] ?? true;

        $subs = Subscription::query()->create($data);

        return response()->json([
            "success" => true,
            "message" => "New subscription created successfully",
            "data" => $subs,
        ], 201);
    }

    public function changeStatus(int $id, string $status) : JsonResponse {
        $subs = Subscription::query()->find($id);

        if (!$subs) {
            return response()->json([
                "success" => false,
                "message" => "Subscription not found",
                "errors" => [],
            ], 404);
        }

        if (!in_array($status, ["active", "inactive", "trial", "isoler", "dismantle"], true)) {
            return response()->json([
                "success" => false,
                "message" => "Validation failed",
                "errors" => [
                    "status" => ["The selected status is invalid."],
                ],
            ], 422);
        }

        $subs->update(["status" => $status]);

        return response()->json([
            "success" => true,
            "message" => "Subscription status Modified to {$status} successfully",
            "data" => $subs,
        ]);
    }
}
