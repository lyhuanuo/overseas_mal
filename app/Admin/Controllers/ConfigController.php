<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Config;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Alert;
use Dcat\Admin\Layout\Content;

class ConfigController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        admin_exit(
            Content::make()
                ->title('错误页')
                ->description('访问出错啦')
                ->body(Alert::make('访问页面不存在~', 'Error')->danger())
        );

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
        return Form::make(new Config(), function (Form $form) {
            $form->text('site_name')->required();
            $form->image('logo_src')->autoUpload();
            $form->textarea('keywords');
            $form->textarea('description');
            $form->text('copyright');
            $form->text('record_no');

            $form->disableDeleteButton();
            $form->disableListButton();
            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
                $tools->disableView();
                $tools->disableList();
            });
            $form->saved(function (Form $form) {
                return $form->response()->success('保存成功')->redirect('config/1/edit');
            });
        });
    }
}
