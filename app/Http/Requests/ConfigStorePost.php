<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfigStorePost extends FormRequest
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

     public function rules()
    {
        return [
            //
            'conf_name' => 'required',
            'conf_title' => 'required',
            'inc_type' => Rule::in(['text', 'textarea', 'radio']),
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
            'conf_name.required' => '配置项名称不能为空！',
            'conf_title.required' => '配置项标题不能为空！',
            'inc_type.in' => '配置输入类型不正确！',
        ];
    }
}
