<?php

namespace App\Admin\Controllers;

use App\Scholarship;
use App\UserScholarship;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserScholarshipController extends Controller
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
            ->header('奖学金复审')
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
        $grid = new Grid(new UserScholarship);
        $grid->id('Id');
        $grid->column('user.name','姓名');
        $grid->column('scholarship.name');
        $grid->required_course('必修课程');
        $grid->optional_course('选修课');
        if(Admin::user()->isAdministrator()){
            $states = [
                'on'  => ['value' => 1, 'text' => '初审', 'color' => 'danger'],
                'off' => ['value' => 2, 'text' => '复审', 'color' => 'success'],
            ];
        }else{
            $states = [
                'on'  => ['value' => 0, 'text' => '提审', 'color' => 'danger'],
                'off' => ['value' => 1, 'text' => '初审', 'color' => 'success'],
            ];
        }
        $grid->status()->switch($states);
        $grid->created_at('提交时间');
        $grid->updated_at('更新时间');
        $grid->disableCreateButton();
        if(Admin::user()->isAdministrator()){
        $grid->model()->whereNotIn('status', [0]);
        }else{
            $grid->model()->whereNotIn('status', [2]);
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
        $show = new Show(UserScholarship::findOrFail($id));

        $show->id('Id');


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UserScholarship());
        $states = [
            'on'  => ['value' => 1, 'text' => '初审', 'color' => 'danger'],
            'off' => ['value' => 2, 'text' => '复审', 'color' => 'success'],
        ];
        $form->switch('status','状态')->states($states);
        return $form;
    }
}
