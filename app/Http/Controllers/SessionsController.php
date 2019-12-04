<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class SessionsController extends Controller
{
    //显示登录页面
    public function create(){


    	return view("sessions.create");
    }

    //处理登录请求
    public function store(Request $request){

    	$credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
       	]);

      //验证登录，并存储Session
    	if(Auth::attempt($credentials)){
    		session()->flash('success', '欢迎回来！');
           	return redirect()->route('users.show', [Auth::user()]);
    	}else{
    		session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
           	return redirect()->back()->withInput();
    	}

       return;

    }

    //处理退出
    public function destroy(){



    }
}
