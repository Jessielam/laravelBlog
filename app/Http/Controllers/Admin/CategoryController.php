<?php
namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //get.admin/category
    public function index()
    {
        $categories = (new Category())->getTree();
        return view('admin.category.index')->with('data', $categories);
    }

    //post.admin/category
    public function store() 
    {
        $input = Request::except('_token'); 
        $rules = [
            'cate_name' => 'bail|required',
        ];

        $message= [
            'cate_name.required' => '分类名称不能为空!'
        ];

        $valid = Validator::make($input, $rules, $message);
        if ($valid->passes()) {
            $result = Category::create($input);
            if ($result) {
                return redirect('admin/category');
            } else {
                return back()->with('errors', '分类添加失败，请稍候重试!');
            }
        } else {
            return back()->withErrors($valid);
        }
    }

    //get.admin/category/create 
    /**
     * 添加分类
     */
    public function create()
    {
        $data = (new Category())->getTree();
        return view('admin.category.add', compact('data'));
    }

    //get.admin/category/{category}
    public function show()
    {

    }

    //put.admin/category/{category}
    public function update($cateId)
    {
        $input = Request::except('_token', '_method');
        $rules = [
            'cate_name' => 'bail|required',
            'cate_desc' => 'bail|required|between:1,30'
        ];

        $message= [
            'cate_name.required' => '分类名称不能为空!',
            'cate_desc.required' => '分类概述不能为空!',
            'cate_desc.between' => '分类概述不能超过30个字符长度!'
        ];

        $valid = Validator::make($input, $rules, $message);
        if ($valid->passes()) {
            $result = Category::where('cate_id', $cateId)->update($input);
            if ($result) {
                return redirect('admin/category');
            } else {
                back()->with('errors', '分类更新失败');
            }
        } else {
            return back()->withErrors($valid);
        }
    }

    //delete.admin/category/{category}
    public function destroy($cate_id)
    {
        $cateModel = new Category();
        $children = $cateModel->getChildren($cate_id);
        $children[] = $cate_id;
        $result = Category::whereIn('cate_id', $children)->delete();
        if ($result) {
            $data = ['status' => 0, 'msg' => '分类删除成功!'];
        } else {
            $data = ['status' => 1, 'msg' => '分类删除失败，请稍候重试!'];
        }
        return $data;
    }

    //get.admin/category/{category}/edit
    /**
     * 编辑分类
     */
    public function edit($cateId)
    {
        $cateModel = new Category();
        $categories = $cateModel->getTree();
        $category = Category::find($cateId);

        // 取出当前分类的子分类
        $children = $cateModel->getChildren($cateId);

        //修改的分类所属分类不能是自己以及自己的子分类
        $data = [];
        foreach ($categories as $val) {
            if ($val->cate_id == $cateId || in_array($val->cate_id, $children)) {
                continue;
            }
            $data[] = $val; 
        }
        return view('admin.category.edit', compact('data', 'category'));
    }

    //post
    public function sort()
    {
        $input = Request::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_sort = $input['cate_sort'];
        $result = $cate->update();
        if ($result) {
            $data = ['status' => 0, 'msg' => '排序更新成功!'];
        } else {
            $data = ['status' => 1, 'msg' => '排序更新失败，请稍候重试!'];
        }

        return $data;
    }
}
