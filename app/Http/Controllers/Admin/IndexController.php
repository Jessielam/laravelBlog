<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index()
    {   
        if(!session('user')) {
            return redirect('admin/login');
        }
        
        $user = session('user');
        return view('admin.index', compact('user'));
    }

    public function info()
    {
        return view('admin.info');
    }

    /**
     * 修改用户密码
     */
    public function edit()
    {
        if ($input = Request::all()) {
            $rules = [
                'password' => 'bail|required|between:6,20|confirmed',
            ];
            $message = [
                'password.required' => '新密码不能为空!',
                'password.between' => '新密码必须在6-20位之间!',
                'password.confirmed' => '新密码与确认密码不一致!',
            ];
            $validator = Validator::make($input, $rules, $message);
            if ($validator->passes()) {
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if ($input['password_o'] == $_password) {
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors', '密码修改成功!');
                } else {
                    return back()->with('errors', '原密码错误!');
                }
            } else {
                //$validator->errors()->all()
                return back()->withErrors($validator);
            }
        }
        return view('admin.pass');
    }
}
