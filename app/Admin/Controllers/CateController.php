<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Cate;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Widgets\Alert;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Cate as CateModel;

class CateController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Cate(), function (Grid $grid) {
            $grid->model()->orderBy('order');
            $grid->column('id')->sortable();
            $grid->title->tree();
            $grid->column('title_en');
            $grid->column('parent_id','所属父级分类')->display(function($data){
                $title = CateModel::where('id',$data)->value('title');
                return $title ? $title :'顶级';
            });
            $grid->column('icon')->image('',100);
            $grid->column('order')->editable(true);
            Admin::style(<<<CSS
        .grid-column-editable{
            min-width:50px;
        }
CSS
            );
            $grid->column('created_at')->width(200);
            $grid->column('updated_at')->width(200)->sortable();
            $grid->disableViewButton();
            $grid->setActionClass(Grid\Displayers\Actions::class);
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();
            });
            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like('title')->width(4);

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
        return Form::make(new Cate(), function (Form $form) {
            $cateModel = config('admin.database.cate_model');
            $form->display('id');
            $form->text('title')->required();
            $form->text('title_en')->required();
            $form->select('parent_id')->options($cateModel::selectOptions())->required()->saving(function($v){
                return intval($v);
            });
            $form->image('icon')->autoUpload()->uniqueName();
            $form->number('order')->value(0)->required();
            $form->saving(function(Form $form){
                $parentId = CateModel::where('id',$form->parent_id)->value('parent_id');
                if($parentId != 0){
                    return $form->response()->error('暂只支持二级分类~');
                }
            });

            $form->disableViewButton();
            $form->disableViewCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
                $tools->disableView();
            });

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
