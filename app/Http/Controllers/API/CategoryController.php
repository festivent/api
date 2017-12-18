<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

/**
 * @resource Category
 *
 * The category routes.
 */
class CategoryController extends Controller
{
    /**
     * List
     *
     * List the parent categories.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = Category::orderBy('name')
            ->with('children')
            ->whereNull('parent_id')
            ->get();

        return CategoryResource::collection($categories);
    }

    /**
     * Children
     *
     * Show the children of given category.
     *
     * @param Category $category
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function children(Category $category)
    {
        return CategoryResource::collection(
            $category->children
        );
    }
}
