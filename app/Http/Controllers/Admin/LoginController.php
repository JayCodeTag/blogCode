<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
        if ($input = Input::all()) {
            $code = new \Code;
            $_code = $code->get();
            if (strtoupper($input['code']) != $_code) {
                return back()->with('msg','验证码错误!');
            }
            $user = User::first();
            if ($user->user_name!=$input['user_name'] || Crypt::decrypt($user->user_pass)!=$input['user_pass']) {
                return back()->with('msg','用户名或者密码错误!');
            }

            session(['user'=>$user]);
//            $users = session('user');
//            echo $users->user_name;
//            dd(session('user'));

            return redirect('admin/index');

        } else {
            return view('admin.login');
        }
    }

    public function code()
    {
        $code = new \Code;
        $code->make();
    }

//    加密测试
//    public function crypt()
//    {
//        $str = 123456;
//        $str1 = 'eyJpdiI6Ing3Q0VPUWs3eDA2MTlnbGlSMGlBMHc9PSIsInZhbHVlIjoiYWZ1OE1tb0YxVnVXSjJ3ZnYyRFdOZz09IiwibWFjIjoiODU3NThhYThjZDMyZmYwNTE5ZWRlNWI1YmYzNGYzNTY4N2Q3MjBiYTQyOGVmM2I0YTlhNmZjZmE4MGRhODRjNyJ9';
//        echo Crypt::encrypt($str);
//        echo '<br/>';
//        echo Crypt::decrypt($str1);
//    }

    /*退出*/
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }


}
