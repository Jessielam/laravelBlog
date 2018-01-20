<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Tag;

class TagController extends CommonController
{
    //
    public function index()
    {
        $tagData = Tag::orderby('tag_id', 'desc')->paginate(10);;
        return view('admin.tag.index', compact('tagData'));
    }

    public function create()
    {
        return view('admin.tag.add');
    }

    public function store()
    {
        $input = Request::except('_token');
        $rules = [
            'tag_name' => 'bail|required',
        ];

        $message= [
            'tag_name.required' => '分类名称不能为空!'
        ];

        $valid = Validator::make($input, $rules, $message);

        $input['created_at'] = time();
        if ($valid->passes()) {
            $result = Tag::create($input);
            if ($result) {
                return redirect('admin/tag');
            } else {
                return back()->with('errors', '标签添加失败，请稍候重试!');
            }
        } else {
            return back()->withErrors($valid);
        }
    }

    public function edit($tag_id)
    {
        $tag = Tag::find($tag_id);
        return view('admin.tag.edit', compact('tag'));
    }

    public function update($tag_id)
    {
        $input = Request::except('_token', '_method');
        $rules = [
            'tag_name' => 'bail|required',
        ];

        $message= [
            'tag_name.required' => '标签名称不能为空!',
        ];

        $valid = Validator::make($input, $rules, $message);
        if ($valid->passes()) {
            $result = Tag::where('tag_id', $tag_id)->update($input);
            if ($result) {
                return redirect('admin/tag');
            } else {
                back()->with('errors', '标签更新失败');
            }
        } else {
            return back()->withErrors($valid);
        }
    }

    public function destroy($tag_id)
    {
        $result = Tag::where('tag_id', $tag_id)->delete();
        if ($result) {
            $data = ['status' => 0, 'msg' => '标签删除成功!'];
        } else {
            $data = ['status' => 1, 'msg' => '标签删除失败,请稍候重试!'];
        }
        
        return $data;
    }
}
