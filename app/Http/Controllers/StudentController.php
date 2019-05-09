<?php

namespace App\Http\Controllers;

use App\Classes;
use App\course_all;
use App\Scholarship;
use App\User;
use App\UserScholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Menu\Laravel\Facades\Menu;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $pca = [
        '北京市',
        '上海市',
        '天津市',
        '广东省',
        '浙江省',
        '江苏省',
        '福建省',
        '湖南省',
        '湖北省',
        '重庆市',
        '辽宁省',
        '吉林省',
        '黑龙江省',
        '河北省',
        '河南省',
        '山东省',
        '陕西省',
        '甘肃省',
        '青海省',
        '新疆维吾尔自治区',
        '山西省',
        '四川省',
        '贵州省',
        '安徽省',
        '江西省',
        '云南省',
        '内蒙古自治区',
        '广西壮族自治区',
        '西藏自治区',
        '宁夏回族自治区',
        '海南省',
    ];
    protected $nations = ["汉族","蒙古族","回族","藏族","维吾尔族","苗族","彝族","壮族","布依族","朝鲜族","满族","侗族","瑶族","白族","土家族",
        "哈尼族","哈萨克族","傣族","黎族","傈僳族","佤族","畲族","高山族","拉祜族","水族","东乡族","纳西族","景颇族","柯尔克孜族",
        "土族","达斡尔族","仫佬族","羌族","布朗族","撒拉族","毛南族","仡佬族","锡伯族","阿昌族","普米族","塔吉克族","怒族", "乌孜别克族",
        "俄罗斯族","鄂温克族","德昂族","保安族","裕固族","京族","塔塔尔族","独龙族","鄂伦春族","赫哲族","门巴族","珞巴族","基诺族"];

    public $major = [
        '专业1' => '专业1',
        '专业2' => '专业2',
        '专业3' => '专业3',
        '专业4' => '专业4',
    ];

    public function index()
    {
        //判断是否有用户登录
        $auth = Auth::check();
        if (!$auth or Auth::user()->type != 1) {

            return response('请返回登录', 200);
        }
        $menu = Menu::new()
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
        $course = course_all::where('user_id', Auth::id())->first();
        return view('student/index', [
            'menu' => $menu,
            'course' => $course,
            'major' => $this->major,
            'cen'
        ]);
    }

    public function info(){
        $auth = Auth::check();
        if (!$auth or Auth::user()->type != 1) {

            return response('请返回登录', 200);
        }
        $menu = Menu::new()
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
        $user=User::find(Auth::user()->id);
        $class=Classes::pluck('name','id');
        return view('student/info', [
            'menu' => $menu,
            'info' => $user,
            'classes'=>$class,
            'pca'=>$this->pca,
            'nations'=>$this->nations
        ]);
    }
    //奖学金申请页
    public function scholarship()
    {
        //判断是否有用户登录
        $auth = Auth::check();
        if (!$auth) {
            return response('请返回登录', 200);
        } elseif (!User::find(Auth::id())->courseAll) {
            return response('后台还未录入你的成绩哦', 200);
        } elseif (User::find(Auth::id())->courseAll->break == 1) {
            return response('本学期你有违纪记录请消除后再申请', 200);
        }
        $scholarship = Auth::user()->scholarship;
        if ($scholarship) {
            if ($scholarship->status == 0) {
                return response('申请成功，等待辅导员审核', 200);
            } elseif ($scholarship->status == 1) {
                return response('辅导员已审核成功，等待校领导审核', 200);
            } else {
                return response('恭喜你，获得本期奖学金', 200);
            }
        }
        $menu = Menu::new()
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
        $schol = Scholarship::all();
        return view('student/scholarship', [
            'menu' => $menu,
            'name' => Auth::user()->name,
            'schol' => $schol
        ]);
    }

    public function forms()
    {
        $id = Auth::id();
        UserScholarship::create([
            'user_id' => $id,
            'scholarship_id' => \request()->post()['type'],
            'required_course' => \request()->post()['required_course'],
            'optional_course' => \request()->post()['optional_course'],
        ]);
        return response('恭喜你，申请成功，如有其它操作请返回', 200);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $menu = Menu::new()
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
        return view('student/theShow', ['user' => $user, 'menu' => $menu, 'name' => Auth::user()->name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        User::where('id', $id)->update([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Auth::logout();
        return response('恭喜你，个人信息修改成功,请重新登录', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
