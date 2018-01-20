<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Category;
use App\Http\Model\Article;
use App\Http\Requests\StoreArticlePost;

class ArticleController extends CommonController
{
    //
    public function index()
    {
        // $article = Article::find(1, ['arc_thumb']);
        // dd($article->arc_thumb);
        //获取所有文章
        $articles = Article::orderby('arc_id', 'desc')->paginate(10);
        return view('admin.article.index', compact('articles'));
    }

    /**
     * 添加文章
     * @method GET
     */
    public function create()
    {
        //获取分类数据
        $cateData = (new Category())->getTree();
        //获取所有的标签数据
        $tagData =  DB::table('tag')->get();

        return view('admin.article.add', compact('cateData', 'tagData'));
    }

    /**
     * 保存添加
     * @method POST
     */
    public function store() 
    {
        $input = Request::except('_token');
        $rules = [
            'arc_title' => 'bail|required|max:45',
            'arc_author' => 'bail|required|max:45',
            'arc_digest'   => 'bail|required|max:200',
            'arc_content' => 'required',
            'cate_id' => 'required'
        ];

        $message= [
            'cate_id.required' => '文章所属栏目不能为空！',
            'arc_title.required' => '文章标题不能为空！',
            'arc_title.max' => '文章标题不能超过45个字符！',
            'arc_author.required' => '文章作者不能为空！',
            'arc_author.max' => '作者名字长度不能超过45个字符！',
            'arc_digest.required' => '文章摘要不能为空',
            'arc_content.required' => '文章内容不能为空！'
        ];

        $valid = Validator::make($input, $rules, $message);
        if ($valid->passes()) {
            $arcModel = new Article();
            $result = $arcModel->saveArticle($input);
            if ($result['valid']) {
                //数据添加成功
                 return redirect('admin/article');
            } else {
                return back()->with('errors', $result['msg']);
            }
        } else {
            return back()->withErrors($valid);
        }
    }

    /**
     * 编辑
     * @method GET
     */
    public function edit($arc_id)
    {
        //获取分类数据
        $cateData = (new Category())->getTree();
        //获取所有的标签数据
        $tagData =  DB::table('tag')->get();
        //根据arc_id获取文章具体内容
        $article =  Article::find($arc_id);
        //获取文章的标签
        $arcTag = DB::table("article_tag")->where('arc_id', $arc_id)->pluck('tag_id');
        $arcTags = [];
        foreach ($arcTag as $tag) {
            $arcTags[] = $tag;
        }
        return view('admin.article.edit', compact('cateData', 'tagData', 'article', 'arcTags'));
    }

    /**
     * 更新数据
     * @method PUT
     */
    public function update(StoreArticlePost $request, $arc_id)
    {
        $input = Request::except('_token', '_method');
        
        $arcModel = new Article();
        //更新文章信息
        $result = $arcModel->updateArticle($input, $arc_id);
        if ($result['valid']) {
            //数据添加成功
             return redirect('admin/article');
        } else {
            return back()->with('errors', $result['msg']);
        }
    }

    /**
     * 删除数据
     * @method DELETE
     */
    public function destroy($arc_id)
    {
        $arcModel = new Article();
        $result = $arcModel->delArticle($arc_id);
        if ($result['valid']) {
            $data = ['status' => 0, 'msg' => $result['msg']];
        } else {
            $data = ['status' => 1, 'msg' => $result['msg']];
        }
        return $data;
    }

    //get.admin/article/{article}
    public function show()
    {

    }
}
