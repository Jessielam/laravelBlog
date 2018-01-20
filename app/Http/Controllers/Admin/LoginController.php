<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Org\Code\Code;
//use Illuminate\Support\Facades\Input;
//use Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Crypt;
//use App\Http\Model\User;
use Illuminate\Support\Facades\DB;

class LoginController extends CommonController
{
    //
    public function login()
    {
        if($input = Request::all()) {
            //验证验证码
            $code = new Code();
            $_code = $code->get();
            if ($_code!==strtoupper($input['code'])) {
                return back()->with('msg', '验证码错误');
            }
            //$user = User::where('user_name', $input['user_name'])->get();
            $user = DB::table('user')->where('user_name', $input['user_name'])->first();

            if ($user) {
                if ($user->user_name!=$input['user_name'] || Crypt::decrypt($user->user_pass)!=$input['user_pass']) {
                    return back()->with('msg', '密码错误!');
                }
                //把用户信息保存到session中
                session(['user' => ['id'=>$user->id, 'user_name'=>$user->user_name]]);
                return redirect('admin/index');
            } else {
                return back()->with('msg', '用户名不存在!');
            }
        }
        return view('admin.login');
    }

    // 生成验证码
    public function code()
    {
        $code = new Code();
        $code->make();
    }

    //退出登录
    public function logout()
    {
        session(['user'=> null]);
        return redirect('admin/login');
    }
}
