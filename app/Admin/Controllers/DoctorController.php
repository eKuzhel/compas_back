<?php


namespace App\Admin\Controllers;


use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Region;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class DoctorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Врачи';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Doctor());
        $grid->disableExport();

        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->ilike('fio', 'ФИО');
            $filter->equal('hospital_id', 'Больница')->select(Hospital::getOptionList());
        });

        $grid->column('id', 'ID')->sortable();
        $grid->column('fio', 'ФИО');
        $grid->column('job_title', 'Должность');
        $grid->column('hospital.name', 'Больница');

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Doctor);
        $form->text('fio', 'ФИО')->rules(['required', 'string', 'max:255']);
        $form->text('job_title', 'Должность')->rules(['required', 'string', 'max:255']);
        $form->select('hospital_id', 'Больница')->options(Hospital::getOptionList());
        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}
