<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;
use Inertia\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Restaurants/Index', [
            'restaurants' => Auth::user()->restaurants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Restaurants/Create', [
            'categories' => Auth::user()->categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant): Response
    {
        return Inertia::render('Restaurants/Show', [
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }

    /**
     * 確認画面を表示する
     */
    public function confirm(Request $request): Response
    {
        $restaurant = $request->validate([
            'name' => 'required|string|max:20',
            'name_katakana' => [
                'required',
                'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            ],
            'review' => 'required|numeric|min:1|max:5',
            'food_picture' => [
                'required',
                File::image()
                    ->max(12 * 1024),
            ],
            'map_url' => 'required|url',
            'comment' => 'required|string|max:300',
        ]);
        
        $restaurant['image_path'] = $restaurant['food_picture']->store('tmp', 'public');
        $restaurant['image_url'] = asset('storage/' . $restaurant['image_path']);
        unset($restaurant['food_picture']);

        return Inertia::render('Restaurants/Show', [
            'restaurant' => $restaurant,
            'type' => 'store',
        ]);
    }
}
