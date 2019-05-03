<?php

namespace App\Http\Controllers;

use App\course_all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Menu\Laravel\Facades\Menu;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $major=[
        '专业1'=>'专业1',
        '专业2'=>'专业2',
        '专业3'=>'专业3',
        '专业4'=>'专业4',
    ];
    public function index()
    {
        //判断是否有用户登录
        $auth=Auth::check();
        if(!$auth or Auth::user()->type!=1){

            return response('请返回登录',200);
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
        $course=course_all::where('user_id',Auth::id())->first();
        return view('student/index',[
            'menu'=>$menu,
            'course'=>$course,
            'major'=>$this->major
            ]);
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
