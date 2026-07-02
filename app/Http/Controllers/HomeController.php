<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Motor;
use App\Models\MotorType;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $brands = Brand::query()->orderBy('name')->get();
        $types = MotorType::query()->orderBy('name')->get();
        $motors = Motor::query()->with(['brand', 'type'])->latest()->take(8)->get();

        return view('pages.home', [
            'brands' => $brands,
            'types' => $types,
            'motors' => $motors,
            'homeData' => [
                'brands' => $brands->map(fn ($brand) => [
                    'name' => $brand->name,
                    'logo' => $brand->logo_path ? asset($brand->logo_path) : null,
                ])->values(),
                'types' => $types->map(fn ($type) => ['name' => $type->name])->values(),
                'motors' => $motors->map(fn ($motor) => [
                    'name' => $motor->name,
                    'slug' => $motor->slug,
                    'brand' => $motor->brand->name,
                    'type' => $motor->type->name,
                    'image' => asset($motor->image_path),
                    'cc' => $motor->cc,
                    'seats' => 2,
                    'trans' => $motor->transmission,
                    'rating' => (float) $motor->rating,
                    'reviews' => $motor->reviews_count,
                    'price' => $motor->price_per_day,
                    'tone' => $motor->tone,
                    'detailUrl' => route('motors.show', $motor),
                ])->values(),
                'catalogUrl' => route('motors.index'),
            ],
        ]);
    }
}
