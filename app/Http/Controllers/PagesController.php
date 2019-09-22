<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//首页
class PagesController extends Controller
{
    // 处理首页的展示
    public function root()
    {
        return view('pages.root');
    }
}
