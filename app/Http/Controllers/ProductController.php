<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productCategory($lang)
    {
        
        $product = Product::all();

        $data = ProductCategory::where('lang', app()->getLocale())->get();
        $metaTitle = trans('Product catalog');
        $metaDescription = '';
        return view('pages.products.category', compact('data', 'metaTitle', 'metaDescription'));
    }

    public function products($lang, $slug)
    {

        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        //$parentCategory = ProductCategory::where('id', $category->parent_id)->firstOrFail();
        $data = Product::where('category_id', $category->id)->paginate(12);
        if($category->seo)
        {
            $metaTitle = $category->seo_title;
            $metaDescription = $category->seo_description;
        }else{
            $metaTitle = $category->name;
            $metaDescription = '';
        }

        return view('pages.products.products', compact('data', 'category', 'metaTitle', 'metaDescription'));

    }
    public function product($lang, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $data = Product::where('category_id', $product->category_id)->get();

        $category = ProductCategory::where('id', $product->category_id)->firstOrFail();
        if($product->seo)
        {
            $metaTitle = $product->seo_title;
            $metaDescription = $product->seo_description;
        }else{
            $metaTitle = $product->name;
            $metaDescription = '';
        }
        return view('pages.products.product', compact('data', 'product', 'category', 'metaTitle', 'metaDescription'));

    }
}
