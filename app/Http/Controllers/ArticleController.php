<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    //
    public function getArticleByMenuItemName(string $name): \Illuminate\Http\JsonResponse
    {
        $article = Article::query()
            ->select(["articles.article_id", "menu_items.name as name", "articles.title", "articles.short_desc", "articles.desc"])
            ->join('menu_items', 'articles.menu_item_id', '=', 'menu_items.menu_item_id')
            ->where('menu_items.name', '=', $name)
            ->first();
        if (!$article) {
            return response()->json(['status' => false, 'message' => 'Article not found']);
        }
        return response()->json($article);
    }

    public function getArticlesAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[title]=asd
        */
        $articles = Article::query()
            ->where('title', 'like', '%' . $request->input('search.title', '') . '%')
            ->orderBy($request->get('sortBy', 'article_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($articles as &$item) {
            $item->setRelation('menu_item', $item->menuItem()->first(['menu_item_id', 'title']));
        }
        return response()->json($articles);
    }

    public function getArticleAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['status' => false, 'message' => 'Article not found']);
        }
        $article->setRelation($article->menuItem()->first(['menu_item_id', 'title']));
        return response()->json($article);
    }

    public function updateArticle(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('article_id') && $request->post('article_id') > 0) {
            $article = Article::find($request->post('article_id'));
            if (!$article) {
                return response()->json(['status' => false, 'message' => 'Article not found']);
            }
            $article->menu_item_id = (int) $request->post('menu_item_id', 0);
            $article->title = $request->post('title', '');
            $article->short_desc = $request->post('short_desc', '');
            $article->desc = $request->post('desc', '');
            $article->save();
            $article->setRelation('menu_item', $article->menuItem()->first(['menu_item_id', 'title']));
            return response()->json($article);
        }
        return response()->json(['status' => false, 'message' => 'Article not found']);
    }

    public function createArticle(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $article = new Article();
        $article->menu_item_id = (int) $request->post('menu_item_id', 0);
        $article->title = $request->post('title', '');
        $article->short_desc = $request->post('short_desc', '');
        $article->desc = $request->post('desc', '');
        $article->save();
        $article->setRelation('menu_item', $article->menuItem()->first(['menu_item_id', 'title']));
        return response()->json($article);
    }

    public function deleteArticle(int $id): \Illuminate\Http\JsonResponse
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['status' => false, 'message' => 'Article not found']);
        }
        $article->delete();
        return response()->json(['status' => true, 'message' => 'Article deleted']);
    }
}
