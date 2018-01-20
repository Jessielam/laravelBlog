<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinksStorePost extends FormRequest
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
            'link_name' => 'required',
            'link_title' => 'required',
            'link_url'  => 'bail|required|active_url'
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
            'link_name.required' => '友情链接名称不能为空！',
            'link_url.required' => '友情链接URL不能为空！',
            'link_url.active_url' => '友情链接URL必须是合法的URL地址！',
            'link_title.required' => '友链标题不能为空！'
        ];
    }
}
