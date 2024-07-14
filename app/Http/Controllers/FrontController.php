<?php

namespace App\Http\Controllers;

use App\Models\ArticleNews;
use App\Models\Author;
use App\Models\BannerAdvertisement;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view('front.index',[
            'categories'  => Category::all(),
            'authors'     => Author::all(),
            'articlenews' => ArticleNews::with('category')
            ->where('is_featured', 'not_featured')
            ->latest()
            ->take(3)
            ->get(),

            'featuredarticlenews' => ArticleNews::with('category')
            ->where('is_featured', 'featured')
            ->latest()
            ->inRandomOrder()
            ->take(3)
            ->get(),

            'bannerads' => BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'banner')
            ->inRandomOrder()
            ->first(),

            'entertainment_articlenews' => ArticleNews::whereHas('category', function ($query){
                $query->where('name', 'Entertainment');
            })
            ->where('is_featured', 'not_featured')
            ->latest()
            ->take(6)
            ->get(),

            'fentertainment_articlenews' => ArticleNews::whereHas('category', function($query){
                $query->where('name', 'Entertainment');
            })
            ->where('is_featured', 'featured')
            ->inRandomOrder()
            ->first(),

            'automotive_articlenews' => ArticleNews::whereHas('category', function ($query){
                $query->where('name', 'Automotive');
            })
            ->where('is_featured', 'not_featured')
            ->latest()
            ->take(6)
            ->get(),

            'fautomotive_articlenews' => ArticleNews::whereHas('category', function($query){
                $query->where('name', 'Automotive');
            })
            ->where('is_featured', 'featured')
            ->inRandomOrder()
            ->first(),
        ]);
    }

    public function category(Category $category) {

        return view('front.category', [
            'categories'  => Category::all(),
            'category'    => $category,

            'bannerads' => BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'banner')
            ->inRandomOrder()
            ->first(),
        ]);
    }
    public function details(ArticleNews $article_news) {

         $square_bannerads = BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'square')
            ->inRandomOrder()
            ->take(2)
            ->get();

            if ($square_bannerads->count() < 2) {
                $square_bannerads_1 = $square_bannerads->first();
                $square_bannerads_2 = null;
            } else{
                $square_bannerads_1 = $square_bannerads->get(0);
                $square_bannerads_2 = $square_bannerads->get(1);

            }
        return view('front.details', [
            'categories'           => Category::all(),
            'details_article_news' => $article_news,
            'author_articlenews'   => ArticleNews::with('category')
            ->where('author_id', $article_news->author_id)
            ->where('id', '!=' , $article_news->id)
            ->latest()
            ->take(6)
            ->get(),

            'articlenews' => ArticleNews::with('category')
            ->where('id', '!=' , $article_news->id)
            ->latest()
            ->inRandomOrder()
            ->take(3)
            ->get(),

            'bannerads' => BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'banner')
            ->inRandomOrder()
            ->first(),

            'square_bannerads_1' => $square_bannerads_1,
            'square_bannerads_2' => $square_bannerads_2,

            // 'square_bannerads2' => BannerAdvertisement::where('is_active', 'active')
            // ->where('type', 'square')
            // ->inRandomOrder()
            // ->first(),
        ]);
    }


    public function author(Author $author) {

        return view('front.author', [
            'categories' => Category::all(),
            'author'     => $author,

            'bannerads' => BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'banner')
            ->inRandomOrder()
            ->first(),
        ]);
    }


    public function search(Request $request) {

        $request->validate([
                'keyword' => ['required', 'string', 'max:255']
            ]);
            $keyword = $request->keyword;
            $key     = "%$keyword%";

        return view('front.search', [

            'categories' => Category::all(),

            'keyword'    => $keyword,

            'articlenews' => ArticleNews::with('category', 'author')
            ->where(function ($q) use ($key){
                $q->whereHas('author', function ($qr) use ($key) {
                $qr->where('name', 'LIKE', $key);
                });
                $q->orWhereHas('category', function ($qr) use ($key) {
                    $qr->where('name', 'LIKE', $key);
                });
                $q->orWhereRaw('LOWER(title) LIKE ?', [$key]);
                $q->orWhereRaw('LOWER(content) LIKE ?', [$key]);
            })
            ->paginate(6),

            'bannerads' => BannerAdvertisement::where('is_active', 'active')
            ->where('type', 'banner')
            ->inRandomOrder()
            ->first(),
        ]);
    }
}
