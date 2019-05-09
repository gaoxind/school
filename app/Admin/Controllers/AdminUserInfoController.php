<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\AdminUserInfo;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AdminUserInfoController extends Controller
{
    use HasResourceActions;

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
            ->header('辅导员管理')
            ->description('description')
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
            ->header('辅导员管理')
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
            ->header('辅导员管理')
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
            ->header('辅导员管理')
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
        $grid = new Grid(new AdminUserInfo);

        $grid->id('Id');
        $grid->admin_user_id('姓名')->display(function ($id) {
            return AdminUser::find($id) ? AdminUser::find($id)->username : '';
        });
        $grid->sex('性别')->display(function ($sex) {
            return $sex ? '男' : '女';
        });
        $nation=$this->nations;
        $grid->nation('民族')->display(function ($nat) use ($nation){
        return array_key_exists($nat,$nation)?$nation[$nat]:'';
    });
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        if(!Admin::user()->isAdministrator()){
            $grid->model()->where('admin_user_id',Admin::user()->id);
            $grid->disableCreateButton();
        }
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
        $show = new Show(AdminUserInfo::findOrFail($id));

        $show->id('Id');
        $show->admin_user_id('姓名')->as(function ($id){
            return AdminUser::find($id) ? AdminUser::find($id)->username : '';
        });
        $show->sex('性别')->as(function ($sex){
            return $sex ? '男' : '女';
        });
        $nation=$this->nations;
        $show->nation('民族')->as(function ($nat) use ($nation){
            return array_key_exists($nat,$nation)?$nation[$nat]:'';
        });
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AdminUserInfo);
        if(Admin::user()->isAdministrator()){
            $form->select('admin_user_id', '姓名')->options(AdminUser::whereHas('AdminUserRole',function ($q){
                $q->where('role_id',2);
            })->pluck('username','id'));
        }else{
            $form->select('admin_user_id', '姓名')->options(AdminUser::whereHas('AdminUserRole',function ($q){
                $q->where('role_id',2);
            })->where('id',Admin::user()->id)->pluck('username','id'));
        }
        $form->select('sex', '性别')->options(['女', '男']);
        $form->select('nation', '民族')->options($this->nations)->default(1);
        return $form;
    }
}
