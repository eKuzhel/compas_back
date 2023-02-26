<?php

namespace App\Admin\Controllers;

use App\Models\File;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Storage;

class FileController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Файлы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new File());
        $grid->disableExport();

        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->ilike('name', 'Название');
        });

        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'Название');
        $grid->column('path', 'Файл')->display(function ($val) {
            $url = Storage::url($val);

            return "<a href='{$url}' target='_blank'>{$url}</a>";
        });
        $grid->disableActions();

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new File);
        $form->text('name', 'Название')->rules(['required', 'string', 'max:255']);
        $form->file('path', 'Файл')->uniqueName()->rules(['required']);
        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}
