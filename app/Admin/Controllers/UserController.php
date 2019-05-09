<?php

namespace App\Admin\Controllers;

use App\Classes;
use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use HasResourceActions;


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

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('学生管理')
            ->description('首页')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('学生管理')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('学生管理')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('学生管理')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->id('Id');
        $grid->name('姓名');
        $grid->email('邮箱');
        $grid->column('userinfo.class', '班级')->display(function ($class) {
            $name = Classes::find($class);
            return $name ? $name->name : '';
        });
        $grid->column('userInfo.qq', 'QQ');
        $grid->column('userInfo.sex', '性别')->display(function ($sex) {
            if ($sex == 0) {
                return '女';
            }
            return '男';
        });
        $grid->column('userinfo.birth', '生日');
        $pca=$this->pca;
        $nation=$this->nations;
        $grid->column('userinfo.census', '户籍')->display(function ($cen) use ($pca){
            return $cen?($pca[$cen]):'';
        });
        $grid->column('userinfo.nation', '民族')->display(function ($nat) use ($nation){
            return $nat?$nation[$nat]:'';
        });
        $grid->column('userinfo.politics', '政治面貌')->display(function ($pol){
            $arr=['无' => '无', '团员' => '团员', '党员' => '党员'];
            return $pol?$arr[$pol]:'';
        });
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->model()->where('type', 1);
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->name('姓名');
        $show->email('邮箱');
        $pca=$this->pca;
        $nation=$this->nations;
        $show->userinfo('详细信息',function ($info) use ($pca,$nation){
            $info->setResource('/admin/student');
            $info->class()->as(function ($class) {
                $name = Classes::find($class);
                return $name ? $name->name : '';
            });
            $info->qq();
            $info->sex('性别')->as(function ($sex) {
                if ($sex == 0) {
                    return '女';
                }
                return '男';
            });
            $info->birth('出生日期');
            $info->census('户籍')->as(function ($cen) use ($pca){
                return $cen?($pca[$cen]):'';
            });
            $info->nation('民族')->as(function ($nat) use ($nation){
                return $nat?$nation[$nat]:'';
            });
            $info->politics('政治面貌')->as(function ($pol){
                $arr=['无' => '无', '团员' => '团员', '党员' => '党员'];
                return $pol?$arr[$pol]:'';
            });;
        });


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('name', '姓名');
        $form->email('email', '邮箱');
        $form->password('password', '密码');
        $form->select('userinfo.class', '班级')->options(Classes::pluck('name', 'id'))->default(1);
        $form->number('userinfo.qq', 'QQ')->default(57415481);
        $form->select('userinfo.sex', '性别')->options(['女', '男']);
        $form->select('userinfo.census', '户籍')->options($this->pca)->default(1);
        $form->date('userinfo.birth', '出生年月');
        $form->select('userinfo.nation', '民族')->options($this->nations)->default(1);
        $form->select('userinfo.politics', '政治面貌')->options(['无' => '无', '团员' => '团员', '党员' => '党员'])->default('团员');
        $form->saving(function (Form $form) {
            $form->password = Hash::make($form->password);
        });
        return $form;
    }
}
