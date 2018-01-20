<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Navs;
use App\Http\Requests\NavsStorePost;

class NavsController extends CommonController
{
    //
     public function index()
    {
    	//获取所有的友情链接
    	$navs = Navs::orderBy('nav_sort', 'asc')->get();
    	return view('admin.navs.index', compact('navs'));
    }

    //创建
    public function create()
    {
		return view('admin.navs.add');
    }

    //数据新增保存
    public function store(NavsStorePost $request)
    {
    	$input = Input::except('_token');
    	//保存数据
    	$result = Navs::create($input);
    	 if ($result) {
            //数据添加成功
             return redirect('admin/navs');
        } else {
            return back()->with('errors', '自定义导航添加失败，请稍后重试！');
        }
    }

    public function show()
    {

    }

	/**
     * @method GET
     */
    public function edit($nav_id)
    {
    	$nav = Navs::find($nav_id);
    	return view('admin.navs.edit', compact('nav'));
    }

    //数据更新保存
    public function update(NavsStorePost $request, $nav_id)
    {
    	$navs = Input::except('_token', '_method');
    	$result = Navs::where('nav_id', $nav_id)->update($navs);

    	 if ($result) {
            //数据修改成功
             return redirect('admin/navs');
        } else {
            return back()->with('errors', '自定义导航更新失败，请稍后重试！');
        }
    }

    //delete.admin/navs/{navs}
    public function destroy($nav_id)
    {
        $result = Navs::where('nav_id', $nav_id)->delete();
        if ($result) {
            $data = ['status' => 1, 'msg' => '自定义导航删除成功!'];
        } else {
            $data = ['status' => 0, 'msg' => '自定义导航删除失败，请稍候重试!'];
        }
        return $data;
    }
    
    public function sort()
    {
    	$input = Input::all();
        $navs = Navs::find($input['nav_id']);
        $navs->nav_sort = $input['nav_sort'];

        $result = $navs->update();
        if ($result) {
            $data = ['status' => 0, 'msg' => '排序更新成功!'];
        } else {
            $data = ['status' => 1, 'msg' => '排序更新失败，请稍候重试!'];
        }

        return $data;
    }
}
