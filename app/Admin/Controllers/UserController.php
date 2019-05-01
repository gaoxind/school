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

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
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
            ->header('Detail')
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
            ->header('Edit')
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
            ->header('Create')
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
        $grid->column('userInfo.class','班级')->display(function ($class){
            $name=Classes::find($class);
            return $name->name?$name->name:'';
        });
        $grid->column('userInfo.qq','QQ');
        $grid->column('userInfo.sex','性别')->display(function ($sex){
            if($sex==0){
                return '女';
            }
            return '男';
        });
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->model()->where('type',1);
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
        $show->name('Name');
        $show->type('Type');
        $show->email('Email');
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
        $form = new Form(new User);

        $form->text('name', '姓名');
        $form->email('email', '邮箱');
        $form->password('password', '密码');
        $form->select('userInfo.class','班级')->options(Classes::pluck('name','id'))->default(1);
        $form->text('userInfo.qq','qq');
        $form->select('userInfo.sex','性别')->options(['女','男']);
        $form->saving(function (Form $form){
        $form->password=Hash::make($form->password);
        });
        return $form;
    }
}
