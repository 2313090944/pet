<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

/* 后台登录控制器 */

class HomeController extends BackendController
{

    /**
     * @desc:   后台登录面板
     * @auth:   hyb
     * @date:   2017/9/26
     * @time:   21:53
     * @param:
     * @return: view
     */
    public function index(){
        return view('backend.home');
    }
}