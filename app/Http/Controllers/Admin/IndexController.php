<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function Index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }

    //更改超级管理员密码
    public function pass()
    {
        if ($input = Input::all()) {
            $rules = [
               'password'=>'required|between:6,20|confirmed',
            ];//第三个confiremed验证2次密码是否一致,表的中确定密码的name应为password_conformation
            $message = [
                'password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须是6~20位之间',
                'password.confirmed'=>'两次密码不一致',
            ];
            $validator = Validator::make($input,$rules,$message);
            if ($validator->passes()) {
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if ($input['password_o'] == $_password) {
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码修改成功!');
                } else {
                    return back()->with('errors','原密码错误!');
                }
            } else {
//                dd($validator->errors()->all());
                return back()->withErrors($validator);//传递错误信息,模板中使用$errors,是个数组,若count($errors)大于0
            }
        } else {
            return view('admin.pass');
        }
    }
}
