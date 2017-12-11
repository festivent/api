<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\Category\StoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Auth;

/**
 * @resource UserCategory
 *
 * The category routes for logged in user.
 */
class CategoryController extends Controller
{
    /**
     * List
     *
     * List categories of logged in user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(
            Auth::user()->categories
        );
    }

    /**
     * Store
     *
     * Store the given category for logged in user.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $user = Auth::user();
        $category = Category::find($request->get('category_id'));

        if (!$user->categories->contains($category->id)) {
            $user->categories()->attach($category->id);
        }

        return response()->json([], 201);
    }

    /**
     * Delete
     *
     * Delete the given category for logged in user.
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $user = Auth::user();
        $user->categories()->detach($category->id);

        return response()->json();
    }
}
