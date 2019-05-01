<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Menu\Laravel\Facades\Menu;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $auth=Auth::check();
  //     Auth::logout();
        //判断是否登录
        $user='';
        $type=1;
        if($auth){
            //登录状态获取登录用户
            $user = Auth::user();
        }
        $menu=Menu::new()
            ->addClass('nav navbar-nav')
            ->link(config('menu.title.1.url'), config('menu.title.1.name'))
            ->link(config('menu.title.2.url'), config('menu.title.2.name'))
            ->link(config('menu.title.3.url'), config('menu.title.3.name'))
            ->link(config('menu.title.4.url'), config('menu.title.4.name'))
            ->link(config('menu.title.5.url'), config('menu.title.5.name'))
            ->link(config('menu.title.6.url'), config('menu.title.6.name'))
            ->link(config('menu.title.7.url'), config('menu.title.7.name'))
            ->wrap('div.collapse.navbar-collapse')
            ->setActive(config('menu.title.1.url'));
       return view('index/index',['menu'=>$menu,'auth'=>$auth,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
