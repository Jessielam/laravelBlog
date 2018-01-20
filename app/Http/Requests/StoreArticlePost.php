<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticlePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'arc_title' => 'bail|required|max:45',
            'arc_author' => 'bail|required|max:45',
            'arc_digest'   => 'bail|required|max:200',
            'arc_content' => 'required',
            'cate_id' => 'required'
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cate_id.required' => '文章所属栏目不能为空！',
            'arc_title.required' => '文章标题不能为空！',
            'arc_title.max' => '文章标题不能超过45个字符！',
            'arc_author.required' => '文章作者不能为空！',
            'arc_author.max' => '作者名字长度不能超过45个字符！',
            'arc_digest.required' => '文章摘要不能为空',
            'arc_content.required' => '文章内容不能为空！'
        ];
    }
}
