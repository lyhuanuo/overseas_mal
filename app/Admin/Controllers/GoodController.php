<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Good;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Alert;
use Dcat\Admin\Layout\Content;

class GoodController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Good(['cateItem','labelItem']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('name_en')->hide();
            $grid->column('item_no');
            $grid->column('cateItem.title','所属分类');
            $grid->column('labelItem.name','标签名称');
            $grid->column('keywords');
            $grid->column('keywords_en')->hide();
            $grid->column('img_src')->image('',100,100);
            $grid->column('pictures');
            $grid->column('price');
            $grid->column('stock');
            $grid->column('sort')->editable(true);
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

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
        return Form::make(new Good(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('name_en');
            $form->text('item_no');
            $form->select('cate_id')->options(function(){

            })->required();
            $form->select('label_id')->options(function(){

            });
            $form->image('img_src')->autoUpload()->uniqueName()->required();
            $form->text('keywords');
            $form->text('keywords_en');
            $form->textarea('descr');
            $form->textarea('descr_en');

            $form->multipleImage('pictures')->autoUpload();
            $form->decimal('price')->min(0)->value(0.00);
            $form->number('stock')->min(0)->value(0);
            $form->number('sort')->value(0);
            $form->editor('content');
            $form->editor('content_en');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
