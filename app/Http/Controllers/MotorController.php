<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Location;
use App\Models\Motor;
use App\Models\MotorType;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class MotorController extends Controller
{
    public function index(Request $request): View
    {
        $priceBounds = Motor::query()
            ->selectRaw('MIN(price_per_day) as min_price, MAX(price_per_day) as max_price')
            ->first();

        $catalogMinPrice = (int) ($priceBounds->min_price ?? 0);
        $catalogMaxPrice = (int) ($priceBounds->max_price ?? 0);
        $selectedMinPrice = max($catalogMinPrice, (int) $request->input('price_min', $catalogMinPrice));
        $selectedMaxPrice = min($catalogMaxPrice, (int) $request->input('price_max', $catalogMaxPrice));

        if ($selectedMinPrice > $selectedMaxPrice) {
            [$selectedMinPrice, $selectedMaxPrice] = [$selectedMaxPrice, $selectedMinPrice];
        }

        $selectedEngineRanges = collect($request->input('engine', []))
            ->map(fn ($range) => (string) $range)
            ->filter(fn (string $range): bool => in_array($range, ['under-125', '125-150', '150-200', 'over-200'], true))
            ->values();

        $selectedTransmissions = collect($request->input('transmission', []))
            ->map(fn ($transmission) => ucfirst(strtolower((string) $transmission)))
            ->filter(fn (string $transmission): bool => in_array($transmission, ['Matic', 'Manual'], true))
            ->values();

        $sort = $request->string('sort')->toString();

        if (! in_array($sort, ['popular', 'price_low', 'price_high', 'rating'], true)) {
            $sort = 'popular';
        }

        $motors = Motor::query()
            ->with(['brand', 'type', 'location'])
            ->when($request->filled('q'), function ($query) use ($request): void {
                $keyword = $request->string('q')->toString();
                $query->where(function ($subQuery) use ($keyword): void {
                    $subQuery->where('name', 'like', "%{$keyword}%")
                        ->orWhereHas('brand', fn ($brandQuery) => $brandQuery->where('name', 'like', "%{$keyword}%"));
                });
            })
            ->when($request->filled('brand'), fn ($query) => $query->whereHas('brand', fn ($brandQuery) => $brandQuery->where('slug', $request->string('brand')->toString())))
            ->when($request->filled('type'), fn ($query) => $query->whereHas('type', fn ($typeQuery) => $typeQuery->where('slug', $request->string('type')->toString())))
            ->when($request->filled('location'), fn ($query) => $query->whereHas('location', fn ($locationQuery) => $locationQuery->where('city', $request->string('location')->toString())))
            ->when($selectedMinPrice > $catalogMinPrice, fn ($query) => $query->where('price_per_day', '>=', $selectedMinPrice))
            ->when($selectedMaxPrice < $catalogMaxPrice, fn ($query) => $query->where('price_per_day', '<=', $selectedMaxPrice))
            ->when($selectedEngineRanges->isNotEmpty(), function ($query) use ($selectedEngineRanges): void {
                $query->where(function ($engineQuery) use ($selectedEngineRanges): void {
                    foreach ($selectedEngineRanges as $range) {
                        match ($range) {
                            'under-125' => $engineQuery->orWhere('cc', '<', 125),
                            '125-150' => $engineQuery->orWhereBetween('cc', [125, 150]),
                            '150-200' => $engineQuery->orWhereBetween('cc', [150, 200]),
                            'over-200' => $engineQuery->orWhere('cc', '>', 200),
                            default => null,
                        };
                    }
                });
            })
            ->when($selectedTransmissions->isNotEmpty(), fn ($query) => $query->whereIn('transmission', $selectedTransmissions->all()))
            ->tap(function ($query) use ($sort): void {
                match ($sort) {
                    'price_low' => $query->orderBy('price_per_day')->orderByDesc('rating'),
                    'price_high' => $query->orderByDesc('price_per_day')->orderByDesc('rating'),
                    'rating' => $query->orderByDesc('rating')->orderByDesc('reviews_count')->orderBy('price_per_day'),
                    default => $query->orderByDesc('is_popular')->orderByDesc('rating')->orderByDesc('reviews_count')->orderBy('price_per_day'),
                };
            })
            ->paginate(8)
            ->withQueryString();

        $typeOrder = ['Matic', 'Sport', 'Naked', 'Trail', 'Classic'];
        $types = MotorType::query()
            ->get()
            ->sortBy(fn (MotorType $type): int|bool => array_search($type->name, $typeOrder, true))
            ->values();

        $wishlistIds = auth()->check()
            ? Wishlist::query()->where('user_id', auth()->id())->pluck('motor_id')->toArray()
            : [];

        return view('motors.index', [
            'motors' => $motors,
            'brands' => Brand::query()->orderBy('name')->get(),
            'types' => $types,
            'locations' => Location::query()->where('is_active', true)->orderBy('city')->get(),
            'priceRange' => [
                'min' => $catalogMinPrice,
                'max' => $catalogMaxPrice,
                'selected_min' => $selectedMinPrice,
                'selected_max' => $selectedMaxPrice,
            ],
            'selectedEngineRanges' => $selectedEngineRanges,
            'selectedTransmissions' => $selectedTransmissions,
            'currentSort' => $sort,
            'wishlistIds' => $wishlistIds,
        ]);
    }

    public function show(Request $request, Motor $motor): View
    {
        $motor->load(['brand', 'type', 'location']);

        $bookings = $motor->bookings()
            ->where('end_date', '>=', now()->toDateString())
            ->whereNotIn('status', ['dibatalkan'])
            ->get(['start_date', 'end_date']);

        $bookedDates = [];
        foreach ($bookings as $booking) {
            $current = Carbon::parse($booking->start_date);
            $end = Carbon::parse($booking->end_date);
            while ($current <= $end) {
                $bookedDates[] = $current->toDateString();
                $current->addDay();
            }
        }
        $bookedDates = array_values(array_unique($bookedDates));

        $isWishlisted = auth()->check() && $motor->isWishlistedBy(auth()->user());

        return view('motors.show', [
            'motor' => $motor,
            'bookedDates' => $bookedDates,
            'isWishlisted' => $isWishlisted,
        ]);
    }
}

