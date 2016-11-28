<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class DiscoverController extends Controller {

    private $categories;

    public function __construct() {
        $this->middleware('auth')->only('index');
        $this->categories = Category::orderBy('name')->get();
    }

    public function index() {
        $subscriptions = Auth::user()->subscriptions()->pluck('tags.id');

        $with = ['user', 'content'];

        if (Auth::user()) {
            $with['content.votes'] = function ($query) {
                $query->where('user_id', Auth::user()->id);
            };
        }

        $posts = Post::whereHas('tags', function ($query) use ($subscriptions) {
            $query->whereIn('tags.id', $subscriptions);
        })->with($with)->latest()->get();

        return view('discover.index', [
            'categories' => $this->categories,
            'posts'      => $posts,
        ]);
    }

    public function category($category) {
        $tag = Tag::where('text', $category)->first();

        if (!$tag) {
            return redirect()->route('discover.index');
        }

        $rootCategory = $tag->categories()->where('root', true)->first();

        $with = ['user', 'content'];

        if (Auth::user()) {
            $with['content.votes'] = function ($query) {
                $query->where('user_id', Auth::user()->id);
            };
        }

        if ($rootCategory) {
            $tagIds = $rootCategory->tags()->pluck('tags.id');

            $posts = Post::whereHas('tags', function ($query) use ($tagIds) {
                $query->whereIn('tags.id', $tagIds);
            })->with($with)->latest()->get();
        } else {
            $posts = $tag->posts()->with($with)->latest()->get();
        }

        return view('discover.category', [
            'tag'        => $tag,
            'category'   => $category,
            'categories' => $this->categories,
            'subscribed' => Auth::user() ? Auth::user()->subscriptions()->where('tag_id', $tag->id)->exists() : false,
            'posts'      => $posts,
            'isRoot'     => !is_null($rootCategory),
        ]);
    }
}
