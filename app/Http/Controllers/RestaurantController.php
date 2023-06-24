<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'name_katakana' => [
                'required',
                'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            ],
            'categories' => 'array',
            'review' => 'required|numeric|min:1|max:5',
            'food_picture_file' => [
                'required',
                File::image()
                    ->max(12 * 1024),
            ],
            'map_url' => 'required|url',
            'comment' => 'required|string|max:300',
        ]);
        
        $path = Storage::disk('public')->putFile('food-pictures', $validated['food_picture_file']);
        $validated['food_picture'] = asset('storage/' . $path);

        if(!$validated['food_picture']) {
            return redirect()->back()->with('error', '画像のアップロードに失敗しました。');
        }

        $restaurant = $request->user()->restaurants()->create($validated);

        $restaurant->categories()->sync(array_column($validated['categories'], 'id'));

        return redirect(route('restaurants.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant): Response
    {
        $restaurant['categories'] = $restaurant->categories;

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
}
