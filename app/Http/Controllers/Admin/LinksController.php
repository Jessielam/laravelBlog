<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Links;
use App\Http\Requests\LinksStorePost;

class LinksController extends CommonController
{
    //
    public function index()
    {
    	//获取所有的友情链接
    	$links = Links::orderBy('link_sort', 'asc')->get();
    	return view('admin.links.index', compact('links'));
    }

    //创建
    public function create()
    {
		return view('admin.links.add');
    }

    //数据新增保存
    public function store(LinksStorePost $request)
    {
    	$input = Input::except('_token');
    	//保存数据
    	$result = Links::create($input);
    	 if ($result) {
            //数据添加成功
             return redirect('admin/link');
        } else {
            return back()->with('errors', '友链添加失败，请稍后重试！');
        }
    }

    public function show()
    {

    }

	/**
     * @method GET
     */
    public function edit($link_id)
    {
    	$link = Links::find($link_id);
    	return view('admin.links.edit', compact('link'));
    }

    //数据更新保存
    public function update(LinksStorePost $request, $link_id)
    {
    	$link = Input::except('_token', '_method');
    	$result = Links::where('link_id', $link_id)->update($link);

    	 if ($result) {
            //数据修改成功
             return redirect('admin/link');
        } else {
            return back()->with('errors', '友链更新失败，请稍后重试！');
        }
    }

    //delete.admin/link/{link}
    public function destroy($link_id)
    {
        $result = Links::where('link_id', $link_id)->delete();
        if ($result) {
            $data = ['status' => 1, 'msg' => '友链删除成功!'];
        } else {
            $data = ['status' => 0, 'msg' => '友链删除失败，请稍候重试!'];
        }
        return $data;
    }
    
    public function sort()
    {
    	$input = Input::all();
        $link = Links::find($input['link_id']);
        $link->link_sort = $input['link_sort'];
        $result = $link->update();
        if ($result) {
            $data = ['status' => 0, 'msg' => '排序更新成功!'];
        } else {
            $data = ['status' => 1, 'msg' => '排序更新失败，请稍候重试!'];
        }

        return $data;
    }
}
