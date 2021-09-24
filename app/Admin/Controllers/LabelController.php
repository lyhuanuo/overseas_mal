<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Label;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Alert;
use Dcat\Admin\Layout\Content;

class LabelController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Label(), function (Grid $grid) {
            $grid->model()->orderBy('sort')->orderByDesc('id');
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('name_en');
            $grid->column('icon')->image('',100,100);
            $grid->column('sort');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        admin_exit(
            Content::make()
                ->title('错误页')
                ->description('访问出错啦')
                ->body(Alert::make('访问页面不存在~', 'Error')->danger())
        );
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Label(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('name_en')->required();
            $form->image('icon')->autoUpload()->uniqueName()->required();
            $form->number('sort')->value(0)->min(0)->max(99999);
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
