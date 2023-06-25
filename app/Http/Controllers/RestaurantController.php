<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), array_merge(self::COMMON_VALIDATION, [
            'food_picture_file' => [
                'required',
                File::image()
                    ->max(12 * 1024),
            ],
        ]));
        $validated = $validator->validate();
        
        $path = Storage::disk('public')->putFile('food-pictures', $validated['food_picture_file']);
        if ($path == false) {
            $validator->errors()->add('food_picture_file', '画像のアップロードに失敗しました。');
            return redirect()->back()->withErrors($validator);
        }
        $validated['food_picture'] = asset('storage/' . $path);

        $restaurant = $request->user()->restaurants()->create($validated);
        $restaurant->categories()->sync($validated['categories']);

        return redirect(route('restaurants.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant): Response
    {
        $restaurant['categories'] = $restaurant->categories()->pluck('id')->all();

        return Inertia::render('Restaurants/Show', [
            'restaurant' => $restaurant,
            'categories' => Auth::user()->categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant): Response
    {
        $restaurant['categories'] = $restaurant->categories()->pluck('id')->all();

        return Inertia::render('Restaurants/Edit', [
            'restaurant' => $restaurant,
            'categories' => Auth::user()->categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(), array_merge(self::COMMON_VALIDATION, [
            'food_picture_file' => [
                'nullable',
                File::image()
                    ->max(12 * 1024),
            ],
        ]));
        $validated = $validator->validate();
        $validated['food_picture'] = $restaurant->food_picture;
        
        if($validated['food_picture_file']) {
            $path = Storage::disk('public')->putFile('food-pictures', $validated['food_picture_file']);
            Storage::disk('public')->delete('food-pictures/' . basename($restaurant->food_picture));
            if ($path == false) {
                $validator->errors()->add('food_picture_file', '画像のアップロードに失敗しました。');
                return redirect()->back()->withErrors($validator);
            }
            $validated['food_picture'] = asset('storage/' . $path);
        }

        $restaurant->update($validated);
        $restaurant->categories()->sync($validated['categories']);

        return redirect(route('restaurants.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }

    /**
     * Common validation rules.
     */
    const COMMON_VALIDATION = [
        'name' => 'required|string|max:20',
        'name_katakana' => [
            'required',
            'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
        ],
        'categories' => 'array',
        'review' => 'required|numeric|min:1|max:5',
        'map_url' => 'required|url',
        'comment' => 'required|string|max:300',
    ];
}
