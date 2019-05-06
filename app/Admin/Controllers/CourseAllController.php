<?php

namespace App\Admin\Controllers;

use App\Classes;
use App\Course;
use App\course_all;
use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CourseAllController extends Controller
{
    use HasResourceActions;
    public $major=[
        '专业1'=>'专业1',
        '专业2'=>'专业2',
        '专业3'=>'专业3',
        '专业4'=>'专业4',
        ];
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('成绩管理')
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
        $grid = new Grid(new course_all);

        $grid->id('Id');
        $grid->column('user.name','姓名');
        $grid->column('userInfo.class','班级')->display(function ($class){
            return Classes::find($class)?Classes::find($class)->name:'';
        });
        $grid->major('专业');
        $grid->courseNameOne('课程1');
        $grid->courseOne('分数');
        $grid->courseNameTwo('课程2');
        $grid->courseTwo('分数');
        $grid->courseNameThree('课程三');
        $grid->courseThree('分数');
        $grid->MoralCourse('体育分数');
        $grid->addCourse('加分');
        $grid->subCourse('减分');
        $grid->break('违纪')->display(function ($break){
            return $break?'违纪':'无';
        });
        $grid->created_at('创建时间');
        $grid->updated_at('添加时间');

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
        $show = new Show(course_all::findOrFail($id));

        $show->id('Id');
        $show->user_id('User id');
        $show->courseNameOne('CourseNameOne');
        $show->courseOne('CourseOne');
        $show->courseNameTwo('CourseNameTwo');
        $show->courseTwo('CourseTwo');
        $show->courseNameThree('CourseNameThree');
        $show->courseThree('CourseThree');
        $show->MoralCourse('MoralCourse');
        $show->addCourse('AddCourse');
        $show->subCourse('SubCourse');
        $show->break('Break');
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
        $form = new Form(new course_all);
        $form->select('user_id', '姓名')->options(User::pluck('name','id'))->default(1);
        $form->text('major','专业');
        $form->select('courseNameOne', '课程1')->options($this->major)->default(1);
        $form->number('courseOne', '成绩');
        $form->select('courseNameTwo', '课程2')->options($this->major)->default(1);
        $form->number('courseTwo', '成绩');
        $form->select('courseNameThree', '课程3')->options($this->major)->default(1);
        $form->number('courseThree', '成绩');
        $form->number('MoralCourse', '体育成绩');
        $form->number('addCourse', '加分');
        $form->number('subCourse', '减分');
        $states = [
            'on'  => ['value' => 1, 'text' => '违纪', 'color' => 'danger'],
            'off' => ['value' => 0, 'text' => '无', 'color' => 'success'],
        ];
        $form->switch('break', '违纪')->states($states);

        return $form;
    }
}
