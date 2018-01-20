<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavsStorePost extends FormRequest
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
            'nav_name' => 'required',
            'nav_url'  => 'bail|required|active_url'
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
            'nav_name.required' => '自定义导航名称不能为空！',
            'nav_url.required' => '自定义导航URL不能为空！',
            'nav_url.active_url' => '自定义导航URL必须是合法的URL地址！',
        ];
    }
}
