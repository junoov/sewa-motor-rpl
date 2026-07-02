<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function toggle(Request $request, Motor $motor): JsonResponse
    {
        $user = $request->user();

        $existing = Wishlist::query()
            ->where('user_id', $user->id)
            ->where('motor_id', $motor->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['status' => 'removed']);
        }

        Wishlist::create([
            'user_id' => $user->id,
            'motor_id' => $motor->id,
        ]);

        return response()->json(['status' => 'added']);
    }

    public function index(Request $request)
    {
        $motors = Motor::query()
            ->whereHas('wishlists', fn ($q) => $q->where('user_id', $request->user()->id))
            ->with(['brand', 'type', 'location'])
            ->latest()
            ->get();

        $wishlistIds = Wishlist::query()
            ->where('user_id', $request->user()->id)
            ->pluck('motor_id')
            ->toArray();

        return view('motors.index', [
            'motors' => $motors,
            'brands' => \App\Models\Brand::query()->orderBy('name')->get(),
            'types' => \App\Models\MotorType::query()->orderBy('name')->get(),
            'locations' => \App\Models\Location::query()->where('is_active', true)->orderBy('city')->get(),
            'priceRange' => [
                'min' => 0,
                'max' => 0,
                'selected_min' => 0,
                'selected_max' => 0,
            ],
            'selectedEngineRanges' => collect(),
            'selectedTransmissions' => collect(),
            'currentSort' => 'popular',
            'wishlistIds' => $wishlistIds,
        ]);
    }
}
