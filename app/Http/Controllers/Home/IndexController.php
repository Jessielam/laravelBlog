<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use Illuminate\Support\Facades\DB;

class IndexController extends CommonController
{
    //
    public function index()
    {
    	/** 获取最新发布的文章 **/
    	$articles = Article::orderBy('created_at', 'desc')->paginate(5);

    	/** 站长推荐 (5篇)**/
    	$clickMosts  = Article::orderBy('arc_click', 'desc')->take(5)->select('arc_id', 'arc_title')->get();

    	return view('home.index', compact('articles', 'clickMosts'));
    }

    public function category($cate_id)
    {
        //获取分类信息
        $category = Category::find($cate_id);
        if($category) {
            //获取该分类的下一级子分类
            $subCates = Category::where('cate_pid', $cate_id)->orderBy('cate_sort', 'asc')->take(4)->get();

            //获取该分类的最新的四篇文章
            $cateArticles = Article::where('cate_id', $cate_id)->orderBy('created_at', 'desc')->paginate(4);

            //获取点击量最高的五篇文章
            $clickMosts = Article::orderBy('arc_click', 'desc')
                ->where('cate_id', $cate_id)
                ->take(5)->select('arc_id', 'arc_title')->get();

        	return view('home.lst', compact('category', 'subCates', 'cateArticles', 'clickMosts'));
        } else {
            //报错
        }
    }

    /**
     * 文章内容
     */
    public function article($arc_id)
    {
        $article = Article::find($arc_id);
        if ($article) {
            //首先把游客点击的博文点击量加1;
            // $a = Article::where('arc_id', $arc_id)->increment('arc_click');
            // if ($a) {
            //     //显示的查看次数与后台的一致
            //     $article->arc_click += 1; 
            // }
            //获取文章标签
            $tags = DB::table('article_tag AS a')
                ->leftJoin('tag AS b', 'a.tag_id', '=', 'b.tag_id')
                ->where('arc_id', $arc_id)->pluck('b.tag_name')->implode(',');

            //获取上一篇 下一篇, 同分类
            $article['pre'] = Article::where('cate_id', $article->cate_id)
                ->where('arc_id', '<', $article->arc_id)
                ->orderBy('arc_id', 'desc')
                ->select('arc_id', 'arc_title')
                ->first();

            $article['next'] = Article::where('cate_id', $article->cate_id)
                ->where('arc_id', '>', $article->arc_id)
                ->orderBy('arc_id', 'asc')
                ->select('arc_id', 'arc_title')
                ->first();
            //dd($article);

            //获取相关的六篇文章
            $relateArc = Article::orderBy('created_at', 'desc')
                ->where('cate_id', $article->cate_id)
                ->where('arc_id', '<>', $article->arc_id)
                ->take(6)->select('arc_id', 'arc_title')->get();
            //dd($relateArc);

            //获取点击量最高的五篇文章
            $clickMosts = Article::orderBy('arc_click', 'desc')
                ->where('cate_id',$article->cate_id)
                ->take(5)->select('arc_id', 'arc_title')->get();


        	return view('home.article', compact('article', 'clickMosts', 'tags', 'relateArc'));
        } else {
            //错误页面
        }
    }
}
