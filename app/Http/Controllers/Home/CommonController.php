<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Model\Navs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    //
    public function __construct()
    {
    	//获取自定义导航
    	$navs = Db::table('navs')->orderBy('nav_sort', 'asc')->get();

    	/** 友情链接 **/
    	$links = Db::table('links')->orderBy('link_sort', 'desc')->get();

    	//获取全站点击量最高的文章(推荐)
        //获取点击量最高的五篇文章
        $recomends = Db::table('article')->orderBy('arc_click', 'desc')
            ->orderBy('created_at', 'desc')
            ->select('arc_id', 'arc_title')
            ->take(6)->get();

    	View::share('navs', $navs);
    	View::share('links', $links);
    	View::share('recomends', $recomends);
    }
}
