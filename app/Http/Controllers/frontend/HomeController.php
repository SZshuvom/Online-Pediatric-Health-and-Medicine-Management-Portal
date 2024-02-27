<?php

namespace App\Http\Controllers\frontend;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerOne;
use App\Models\BannerTwo;
use App\Models\HeroBanner;
use App\Models\ProductRating;
use App\Models\SubCategory;

class HomeController extends Controller
{
    public function home(){

          //Banner
          $banners = Banner::all();
          $bannersOne = BannerOne   ::all();
          $bannersTwo = BannerTwo::all();

          //Category
          $categories = Category::latest()->limit(11)->get();
         

          //Products
          $products = Product::simplePaginate(20);

          //Hero Banner
          $heroBanners = HeroBanner::all();

          //Latest Category
          $latestCategories = Category::latest()->limit(5)->get();

          //Latest Products
          $latestProducts = Product::where('status',1)->latest()->limit(6)->get();

          //Product Stars
          $productRatings =ProductRating::all();
         //Trending
         $trendingProduct = Product::where('status',2)->latest()->limit(8)->get();
         return view('frontend.pages.home',
         compact('categories','products','latestProducts',
        'latestCategories','banners','heroBanners',
        'bannersTwo','bannersOne','productRatings','trendingProduct'));
    }

       public function categoryWiseProduct($id){

        $category = Category::findOrFail($id);

        //Feature Products
        $products = Product::where('category_id', $id)
        ->where('status', 1)->limit(20)
        ->get();



        return view('frontend.pages.catWizeProduct.categoryWizeProduct',compact('products','category'));
    }
}
