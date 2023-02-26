<?php

namespace App\Admin\Controllers;

use App\Models\File;
use App\Models\PageFile;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class PageFileController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Страницы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PageFile());
        $grid->disableExport();

        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->ilike('name', 'Название');
        });

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'Название');


        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PageFile);
        $form->text('name', 'Название')->rules(['required', 'string', 'max:255']);
        $form->ckeditor('content')->options([ 'height' => 500]);
        $form->multipleSelect('files')->options(File::all()->pluck('name', 'id'));
        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}
