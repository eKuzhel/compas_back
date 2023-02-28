<?php


namespace App\Admin\Controllers;


use App\Enums\DiseaseType;
use App\Models\Hospital;
use App\Models\Region;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class HospitalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Больницы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Hospital());
        $grid->disableExport();
        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->ilike('name', 'Название');
            $filter->equal('region_id', 'Регион')->select(Region::getOptionList());
        });

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'Название');
        $grid->column('region.name', 'Регион');

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $radioList = [0 => 'Нет', 1 => 'Да'];
        $form = new Form(new Hospital);
        $form->text('name', 'Название')->rules(['required', 'string', 'max:255']);
        $form->text('address', 'Адрес')->rules(['required', 'string', 'max:255']);
        $form->text('phone', 'Телефон')->rules(['nullable', 'string', 'max:255']);
        $form->text('url', 'Внешняя ссылка')->rules(['nullable', 'string', 'max:255']);
        $form->select('region_id', 'Регион')->options(Region::getOptionList())->rules(['required']);
        $form->radioButton('has_adult', 'Взрослая')->options($radioList);
        $form->radioButton('has_child', 'Десткая')->options($radioList);

        $form->radioButton('has_rlo', 'РЛО')->options($radioList);
        $form->radioButton('has_omc', 'ОМС')->options($radioList);
        $form->radioButton('has_vmp', 'ВМП')->options($radioList);
        $form->radioButton('has_vzn', 'ВЗН')->options($radioList);
        $form->radioButton('has_kd', 'КД')->options($radioList);
        $form->multipleSelect('diseases', 'Заболевания')->options(DiseaseType::toArray())->rules(['required']);

        $form->hasMany('doctors', function (Form\NestedForm $form) {
            $form->text('fio', 'ФИО');
            $form->text('job_title', 'Должность');
        });

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
