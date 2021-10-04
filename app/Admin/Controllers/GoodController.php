<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Good;
use App\Models\Label;
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
            $cateModel = config('admin.database.cate_model');
            $grid->column('id')->sortable();
            $grid->model()->orderByDesc('id');
            $grid->column('name');
            $grid->column('name_en')->hide();
            $grid->column('item_no');
            $grid->column('cateItem.title','所属分类');
            $grid->column('labelItem.name','标签名称');
            $grid->column('keywords')->width(150);
            $grid->column('keywords_en')->width(150)->hide();
            $grid->column('img_src')->image('',100,100);
            $grid->column('pictures')->image('',80,80)->hide();
            $grid->column('price');
            $grid->column('stock')->sortable();
            $grid->column('status','状态')->select([1=>'上架',2=>'下架']);
            $grid->column('sort')->editable(true);
            $grid->column('created_at')->width(100);
            $grid->disableViewButton();
            $grid->showColumnSelector();
            $grid->quickSearch([ 'name', 'name_en','item_no'])->placeholder('名称或者编号');
            $grid->filter(function (Grid\Filter $filter) use($cateModel) {
                $filter->panel();
                $filter->like('name')->width(3);
                $filter->where('search', function ($query) {
                    $query->where('name', 'like', "%{$this->input}%")
                        ->orWhere('name_en', 'like', "%{$this->input}%")
                        ->orWhere('keywords', 'like', "%{$this->input}%")
                        ->orWhere('keywords_en', 'like', "%{$this->input}%");

                },'名称、关键词')->width(3);

                $filter->like('item_no')->width(3);
                $filter->equal('cate_id','所属分类')->select($cateModel::selectOptions())->width(3);
                $filter->equal('label_id','所属标签')->select(function(){
                    $labelList = Label::orderBy('sort')->get(['id','name'])->toArray();
                    $data = [];
                    foreach($labelList as $k => $v){
                        $data[$v['id']] = $v['name'];
                    }
                    return $data;
                })->width(3);
                $filter->equal('status','状态')->select([1=>'上架',2=>'下架'])->width(3);

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
            $cateModel = config('admin.database.cate_model');
            $form->display('id');
            $form->text('name');
            $form->text('name_en');
            $form->text('item_no');
            $form->select('cate_id')->options($cateModel::selectOptions())->required();
            $form->select('label_id','所属标签')->options(function(){
                $labelList = Label::orderBy('sort')->get(['id','name'])->toArray();
                $data = [];
                foreach($labelList as $k => $v){
                    $data[$v['id']] = $v['name'];
                }
                return $data;
            })->saving(function($v){
                return intval($v);
            });
            $form->image('img_src')->autoUpload()->uniqueName()->required();
            $form->text('keywords');
            $form->text('keywords_en');
            $form->textarea('descr');
            $form->textarea('descr_en');

            $form->multipleImage('pictures')->autoUpload()->saving(function($value){
                return json_encode($value,JSON_UNESCAPED_UNICODE);
            });
            $form->currency('price')->value(0.00)->symbol('￥');
            $form->number('stock')->min(0)->value(1);
            $form->select('status','状态')->options([1=>'上架',2=>'下架'])->required()->value(1);
            $form->number('sort')->value(0);
            $form->editor('content');
            $form->editor('content_en');
            $form->saving(function($form){
                if(!$form->name && !$form->name_en && !$form->item_no){
                    return $form->response()->error('商品名称与商品编号至少有一个必填！');
                }
                if($form->stock == 0 ){
                    $form->status = 2;
                }

            });

            $form->disableViewCheck();
            $form->disableViewButton();
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
