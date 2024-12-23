<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Employee;
use App\Models\GalleryCatalog;
use App\Models\Home;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Partner;
use App\Models\PhotoGallery;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Review;
use App\Models\VideoGallery;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $homeinfo = Home::where('lang', app()->getLocale())->firstOrFail();
        $contact = Contact::where('lang', app()->getLocale())->firstOrFail();
        $productCatigory = ProductCategory::where('lang', app()->getLocale())->get();

        $news = Post::where('lang', app()->getLocale())->where('type', 'post')->limit(4)->get();

        if($homeinfo->seo)
        {
            $metaTitle = $homeinfo->seo_title;
            $metaDescription = $homeinfo->seo_description;
        }
        else
        {
            $metaTitle = trans('name');
            $metaDescription="";
        }
        
        return view('pages.home', compact('homeinfo','contact','productCatigory','news', 'metaTitle', 'metaDescription'));
    }

    // end Home function
    // start Postpage functio

    public function postpage($lang, $id, $slug)
    {
        $pageData = Page::where('slug', $slug)->firstOrFail();
        $menu = Menu::where('id', $id)->firstOrFail();
        $menus = Menu::where('parent_id', $menu->parent_id)->get();
        $parentMenu = Menu::where('id', $menu->parent_id)->firstOrFail();
        $page = [];
        $vacancies = [];
        if(in_array($pageData->slug, ['kadry', 'kadrlar-bilan-ishlash', 'hr']))
        {
            $vacancies = Page::where('lang', app()->getLocale())->where('type', 'vacancy')->where('status', 1)->get();
        }
        foreach($menus as $item)
        {
            $item->page_id==null?$page[$item->id] = null:$page[$item->id] = Page::find($item->page_id)->slug;
        }

        if($pageData->seo and !empty($pageData->seo_title))
        {
            $metaTitle = $pageData->seo_title;
            $metaDescription = $pageData->seo_description;
        }
        else
        {
            $metaTitle = $pageData->title;
            $metaDescription="";
        }

        if($menu->type == 'page')
            return view('pages.post-page', compact('pageData','page','parentMenu','menus','menu','metaTitle', 'metaDescription', 'vacancies'));
        else{
            return view('pages.forms.form', compact('pageData','page','parentMenu','menus','menu','metaTitle', 'metaDescription', 'vacancies'));
        }
    }

    // end Postpage function
    // start Contact functions
    
    public function contact($lang, $slug)
    {
        
        $page = Page::where('slug', $slug)->firstOrFail();
        if($page->seo)
        {
            $metaTitle = $page->seo_title;
            $metaDescription = $page->seo_description;
        }
        else
        {
            $metaTitle = $page->title;
            $metaDescription="";
        }
        return view('pages.contact', compact('page','metaTitle', 'metaDescription'));
    }

    // end Contact functions
    // start Gallery functions

    public function gallery($lang)
    {
        $data = PhotoGallery::where('lang',$lang)->get();
        $metaTitle = trans('Gallery');
        $metaDescription="";

        return view('pages.gallery.photo-gallery', compact('data','metaTitle', 'metaDescription'));
    }

    public function photo($lang, $slug)
    {

        $data = PhotoGallery::where('slug',$slug)->firstOrFail();
        $metaTitle = $data->name;
        $metaDescription="";

        return view('pages.gallery.photo', compact('data','metaTitle', 'metaDescription'));
    }

    public function video($lang)
    {
        $data = VideoGallery::where('lang',$lang)->get();
        $metaTitle = trans('Video gallery');
        $metaDescription="";

        return view('pages.gallery.video-gallery', compact('data','metaTitle', 'metaDescription'));
    }

    // end Gallery functions
    // start Sitemap function

    public function sitemap($lang)
    {
        $page = [];
        $data = Menu::where('lang', $lang)->get();
        $categories = ProductCategory::where('lang', app()->getLocale())->get();

        foreach($data as $item)
        {
            $item->page_id==null?$page[$item->id] = null:$page[$item->id] = Page::find($item->page_id)->slug;
        }
       

            $metaTitle = trans('Sitemap');
            $metaDescription="";

        return view('pages.site-map', compact('data','page','categories','metaTitle', 'metaDescription'));
    }

    // end Sitemap function
    // start Reviews functions

    public function reviews($lang)
    {
        $reviews = Review::where('lang', $lang)->paginate(8);
        
        {
            $metaTitle = trans('Customer Reviews');
            $metaDescription="";
        }
        return view('pages.reviews', compact('reviews','metaTitle', 'metaDescription'));
    }

    public function review($lang, $slug)
    {
        $review = Review::where('slug', $slug)->firstOrFail();
        $reviews = Review::where('lang', $lang)->skip(0)->take(10)->get();
        if($review->seo)
        {
            $metaTitle = $review->seo_title;
            $metaDescription = $review->seo_description;
        }
        else
        {
            $metaTitle = trans('Customer Reviews');
            $metaDescription="";
        }
        return view('pages.review', compact('reviews','review','metaTitle', 'metaDescription'));
    }

    // end Reviews functions
    // start Staffs functions

    public function staffs($lang)
    {
        $staffs = Employee::where('lang', $lang)->paginate(6);
        
        $metaTitle = trans('Our leaders');
        $metaDescription="";
    
        return view('pages.staffs.employees', compact('staffs','metaTitle', 'metaDescription'));
    }

    public function staff($lang, $slug)
    {
        $staff = Employee::where('slug', $slug)->firstOrFail();
        
        $metaTitle = trans('Our leaders');
        $metaDescription="";
    
        return view('pages.staffs.employee', compact('staff','metaTitle', 'metaDescription'));
    }

    // end Staffs functions
    // start Search function

    public function search($query)
    {
        $lang = app()->getLocale();

        $posts = Post::where("title", 'LIKE', "%{$query}%")->get();
        $menus = Menu::where("name", 'LIKE', "%{$query}%")->with('Page')->get();
        $products = Product::where("name", 'LIKE', "%{$query}%")->get();
        $productCategory = ProductCategory::where("name", 'LIKE', "%{$query}%")->get();
        $productSubCategory = ProductSubCategory::where("name", 'LIKE', "%{$query}%")->get();

        $results = collect();

        $results = $results->merge($posts->map(function ($post) use ($lang) {
            
            return [
                'name' => $post->title,
                'url' => url($lang."/posts-".$post->type."/".$post->slug),
                'type' => 'post'
            ];
        
        }));

        $results = $results->merge($menus->map(function ($menu) use ($lang) {
            
            return [
                'name' => $menu->name,
                'url' => url($lang."/menu-".$menu->id."/".$menu['Page']['slug']),
                'type' => 'menu'
            ];
        
        }));

        $results = $results->merge($productCategory->map(function ($category) use ($lang) {
            return [
                'name' => $category->name,
                'url' => url($lang.'/products-catalog/'.$category->slug),
                'type' => 'category'
            ];
        }));

        $results = $results->merge($products->map(function ($product) use ($lang) {
            return [
                'name' => $product->name,
                'url' => url($lang."/product/".$product->slug),
                'type' => 'product'
            ];
        }));

        $results = $results->merge($productSubCategory->map(function ($subCategory) use ($lang) {
            return [
                'name' => $subCategory->name,
                'url' => url($lang.'/products/'.$subCategory->slug),
                'type' => 'subCategory'
            ];
        }));

        return response()->json(['results' => $results]);
    }

    // end Search function
}
