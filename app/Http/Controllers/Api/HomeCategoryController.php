<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Resources\HomeCategoryCollection;
use App\Models\HomeCategory;

class HomeCategoryController extends Controller
{
    public function index()
    {
        return new HomeCategoryCollection(Category::where('featured', 1)->where('published',true)->get());
    }
}
