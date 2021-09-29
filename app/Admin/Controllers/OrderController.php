<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Order;
use App\Models\OrderGoods;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Alert;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Table;

class OrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Order(['memberItem']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('order_sn');
            $grid->column('express_no');
            $grid->column('name');
            $grid->column('phone');
            $grid->column('total_price');
            $grid->column('goodsItem','订单商品')->modal('查看',function(){
                $data = [];
                $orderGoodsList = OrderGoods::with(['goodsItem'=>function($query){
                    return $query->select(['id','name','name_en','item_no','img_src']);
                }])->where('order_id',$this->id)->get(['id','order_id','goods_id','num','price','total_price'])->toArray();
                foreach($orderGoodsList as  $v){
                    $data[] = [
                        $v['goods_id'],
                        $v['goods_item']['name'],
                        $v['goods_item']['item_no'],
                        "<img src='".$v['goods_item']['img_src']."' width='100' >",
                        $v['num'],
                        $v['price'],
                        $v['total_price']

                    ];
                }
                $titles = [
                    'ID',
                    '商品名称',
                    '商品编号',
                    '商品图片',
                    '商品数量',
                    '商品价格',
                    '商品总价'

                ];
                return Table::make($titles, $data);

            });
            $grid->column('pay_type');
            $grid->column('status')->display(function($data){
                switch($data){
                    case 1:
                        return '待支付';
                        break;
                    case 2:
                        return '待发货';
                        break;
                    case 3:
                        return '已发货';
                        break;
                    case 4:
                        return '已完成';
                        break;
                    default:
                        return '已取消';
                        break;
                }
            });
            $grid->column('pay_at');
            $grid->column('delivery_at');
            $grid->column('created_at')->sortable();

            $grid->disableViewButton();
            $grid->disableDeleteButton();
            $grid->disableBatchDelete();
            $grid->disableCreateButton();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal('order_sn')->width(4);
                $filter->equal('phone')->width(4);
                $filter->like('name')->width(4);
                $filter->equal('status')->select([1=>'待支付',2=>'待发货',3=>'已发货',4=>'已完成',33=>'已取消'])->width(4);
                $filter->between('created_at')->datetime()->width(4);

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
        return Form::make(new Order(), function (Form $form) {
            if($form->isCreating()){
                admin_exit(
                    Content::make()
                        ->title('错误页')
                        ->description('访问出错啦')
                        ->body(Alert::make('订单不支持后台添加~', 'Error')->danger())
                );
            };
            $form->display('id');
            $form->display('order_sn');
            $form->text('express_no');
//            $form->datetime('date');
            $form->text('name')->required();
            $form->mobile('phone')->required();
            $form->html('2321','订单商品');
            $form->display('total_price');
            $form->radio('pay_type')->options([0=>'暂无',1=>'Paypal'])->value(0)->required();
            $form->select('status')->options([1=>'待支付',2=>'待发货',3=>'已发货',4=>'已完成',33=>'已取消'])->default(1);
            $form->datetime('pay_at');
            $form->datetime('delivery_at');
            $form->disableDeleteButton();
            $form->disableViewButton();
            $form->disableViewCheck();
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
