<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Slideshow;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Alert;
use Dcat\Admin\Layout\Content;

class SlideshowController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Slideshow(), function (Grid $grid) {
            $grid->model()->orderBy('sort');
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('title_en');
            $grid->column('img_src')->image('',100,100);
            $grid->column('link_src')->link();
            $grid->column('sort');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->disableViewButton();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();


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
        return Form::make(new Slideshow(), function (Form $form) {
            $form->display('id');
            $form->image('img_src')->autoUpload()->uniqueName()->required();
            $form->text('title');
            $form->text('title_en');
            $form->url('link_src');
            $form->number('sort')->value(0)->min(0)->max(99999);
            $form->disableViewCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
