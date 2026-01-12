<?php

namespace App\Http\Controllers;

use App\Models\ArticleNews;
use App\Models\Category;
use App\Models\Author;
use App\Models\BannerAdvertisement;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();

        $articles = ArticleNews::with(['category'])
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(3)
        ->get();

        $featured_articles = ArticleNews::with(['category'])
        ->where('is_featured', 'featured')
        ->inRandomOrder()
        ->take(3)
        ->get();

        
        $bannerads = BannerAdvertisement::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        // ->take(1)
        ->first();
        
        $entertainment_articles = ArticleNews::whereHas('category', function($query) {
            $query->where('name', 'Entertainment');
        })
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(6)
        ->get();
        
        $entertainment_featured_articles = ArticleNews::whereHas('category', function($query) {
            $query->where('name', 'Entertainment');
        })
        ->where('is_featured', 'featured')
        ->inRandomOrder()
        ->first();
        
        $politik_articles = ArticleNews::whereHas('category', function($query) {
            $query->where('name', 'politik');
        })
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(6)
        ->get();
        
        $politik_featured_articles = ArticleNews::whereHas('category', function($query) {
            $query->where('name', 'politik');
        })
        ->where('is_featured', 'featured')
        ->inRandomOrder()
        ->first();
        
        $olahraga_articles = ArticleNews::whereHas('category', function($query) {
            $query->where('name', 'olahraga');
        })
        ->where('is_featured', 'not_featured')
        ->latest()
        ->take(6)
        ->get();
        
        $olahraga_featured_articles = ArticleNews::whereHas('category', function($query) {
            $query->where('name', 'olahraga');
        })
        ->where('is_featured', 'featured')
        ->inRandomOrder()
        ->first();
        
        $authors = Author::all();

        return view('front.index',compact(
            'olahraga_featured_articles',
            'olahraga_articles',
            'politik_featured_articles',
            'politik_articles',
            'entertainment_featured_articles',
            'entertainment_articles', 
            'categories','articles', 
            'authors',
            'featured_articles',
            'bannerads'
        ));
    }
    
    public function category(Category $category)
    {
        $categories = Category::all();
        $bannerads = BannerAdvertisement::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        ->first();
        return view('front.category', compact(
            'category',
            'categories',
            'bannerads'
        ));
    }
    
    public function author(Author $author)
    {
        $categories = Category::all();

        $bannerads = BannerAdvertisement::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        ->first();

        return view('front.author', compact(
            'categories',
            'author',
            'bannerads'
        ));
    }

    public function search (Request $request)
    {
        $categories = Category::all();
        $request->validate([
            'keyword' => 'required|string|max:255',
        ]);
        $keyword = $request->keyword;
        $articles = ArticleNews::with(['category', 'author'])
            ->where('name', 'like', "%{$keyword}%")
            ->paginate(6);
        
        return view('front.search', compact(
            'articles',
            'categories',
            'keyword'
        ));
    }

    public function details(ArticleNews $articleNews)
    {
        $articles = ArticleNews::with(['category'])
        ->where('is_featured', 'not_featured')
        ->where('id', '!=', $articleNews->id)
        ->latest()
        ->take(3)
        ->get();

        $categories = Category::all();
        $bannerads = BannerAdvertisement::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        // ->take(1)
        ->first();

        $square_ads = BannerAdvertisement::where('is_active', 'active')
        ->where('type', 'square')
        ->inRandomOrder()
        ->take(2)
        ->get();

        if ($square_ads->count() < 2) {
           $square_ads_1 = $square_ads->first();
           $square_ads_2 = null;
        } else {
            $square_ads_1 = $square_ads->get(0);
            $square_ads_2 = $square_ads->get(1);
        }

        $author_news = ArticleNews::where(['author_id' => $articleNews->author_id])
        ->where('id', '!=', $articleNews->id)
        ->inRandomOrder()
        ->get();

        return view('front.details', compact(
            'articleNews',
            'categories',
            'bannerads','articles',
            'square_ads_1',
            'square_ads_2',
            'author_news'
        ));
    }
}
