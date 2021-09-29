<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection title_en
     * @property Grid\Column|Collection copyright
     * @property Grid\Column|Collection keywords
     * @property Grid\Column|Collection logo_src
     * @property Grid\Column|Collection record_no
     * @property Grid\Column|Collection site_name
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection cate_id
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection content_en
     * @property Grid\Column|Collection deleted_at
     * @property Grid\Column|Collection descr
     * @property Grid\Column|Collection descr_en
     * @property Grid\Column|Collection img_src
     * @property Grid\Column|Collection item_no
     * @property Grid\Column|Collection keywords_en
     * @property Grid\Column|Collection label_id
     * @property Grid\Column|Collection name_en
     * @property Grid\Column|Collection pictures
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection sort
     * @property Grid\Column|Collection stock
     * @property Grid\Column|Collection date
     * @property Grid\Column|Collection delivery_at
     * @property Grid\Column|Collection express_no
     * @property Grid\Column|Collection mid
     * @property Grid\Column|Collection order_sn
     * @property Grid\Column|Collection pay_at
     * @property Grid\Column|Collection pay_info
     * @property Grid\Column|Collection pay_type
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection total_price
     * @property Grid\Column|Collection goods_id
     * @property Grid\Column|Collection num
     * @property Grid\Column|Collection order_id
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection link_src
     * @property Grid\Column|Collection email_verified_at
     *
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection title_en(string $label = null)
     * @method Grid\Column|Collection copyright(string $label = null)
     * @method Grid\Column|Collection keywords(string $label = null)
     * @method Grid\Column|Collection logo_src(string $label = null)
     * @method Grid\Column|Collection record_no(string $label = null)
     * @method Grid\Column|Collection site_name(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection cate_id(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection content_en(string $label = null)
     * @method Grid\Column|Collection deleted_at(string $label = null)
     * @method Grid\Column|Collection descr(string $label = null)
     * @method Grid\Column|Collection descr_en(string $label = null)
     * @method Grid\Column|Collection img_src(string $label = null)
     * @method Grid\Column|Collection item_no(string $label = null)
     * @method Grid\Column|Collection keywords_en(string $label = null)
     * @method Grid\Column|Collection label_id(string $label = null)
     * @method Grid\Column|Collection name_en(string $label = null)
     * @method Grid\Column|Collection pictures(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection sort(string $label = null)
     * @method Grid\Column|Collection stock(string $label = null)
     * @method Grid\Column|Collection date(string $label = null)
     * @method Grid\Column|Collection delivery_at(string $label = null)
     * @method Grid\Column|Collection express_no(string $label = null)
     * @method Grid\Column|Collection mid(string $label = null)
     * @method Grid\Column|Collection order_sn(string $label = null)
     * @method Grid\Column|Collection pay_at(string $label = null)
     * @method Grid\Column|Collection pay_info(string $label = null)
     * @method Grid\Column|Collection pay_type(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection total_price(string $label = null)
     * @method Grid\Column|Collection goods_id(string $label = null)
     * @method Grid\Column|Collection num(string $label = null)
     * @method Grid\Column|Collection order_id(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection link_src(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection version
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection order
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection username
     * @property Show\Field|Collection title_en
     * @property Show\Field|Collection copyright
     * @property Show\Field|Collection keywords
     * @property Show\Field|Collection logo_src
     * @property Show\Field|Collection record_no
     * @property Show\Field|Collection site_name
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection cate_id
     * @property Show\Field|Collection content
     * @property Show\Field|Collection content_en
     * @property Show\Field|Collection deleted_at
     * @property Show\Field|Collection descr
     * @property Show\Field|Collection descr_en
     * @property Show\Field|Collection img_src
     * @property Show\Field|Collection item_no
     * @property Show\Field|Collection keywords_en
     * @property Show\Field|Collection label_id
     * @property Show\Field|Collection name_en
     * @property Show\Field|Collection pictures
     * @property Show\Field|Collection price
     * @property Show\Field|Collection sort
     * @property Show\Field|Collection stock
     * @property Show\Field|Collection date
     * @property Show\Field|Collection delivery_at
     * @property Show\Field|Collection express_no
     * @property Show\Field|Collection mid
     * @property Show\Field|Collection order_sn
     * @property Show\Field|Collection pay_at
     * @property Show\Field|Collection pay_info
     * @property Show\Field|Collection pay_type
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection status
     * @property Show\Field|Collection total_price
     * @property Show\Field|Collection goods_id
     * @property Show\Field|Collection num
     * @property Show\Field|Collection order_id
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection link_src
     * @property Show\Field|Collection email_verified_at
     *
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection title_en(string $label = null)
     * @method Show\Field|Collection copyright(string $label = null)
     * @method Show\Field|Collection keywords(string $label = null)
     * @method Show\Field|Collection logo_src(string $label = null)
     * @method Show\Field|Collection record_no(string $label = null)
     * @method Show\Field|Collection site_name(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection cate_id(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection content_en(string $label = null)
     * @method Show\Field|Collection deleted_at(string $label = null)
     * @method Show\Field|Collection descr(string $label = null)
     * @method Show\Field|Collection descr_en(string $label = null)
     * @method Show\Field|Collection img_src(string $label = null)
     * @method Show\Field|Collection item_no(string $label = null)
     * @method Show\Field|Collection keywords_en(string $label = null)
     * @method Show\Field|Collection label_id(string $label = null)
     * @method Show\Field|Collection name_en(string $label = null)
     * @method Show\Field|Collection pictures(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection sort(string $label = null)
     * @method Show\Field|Collection stock(string $label = null)
     * @method Show\Field|Collection date(string $label = null)
     * @method Show\Field|Collection delivery_at(string $label = null)
     * @method Show\Field|Collection express_no(string $label = null)
     * @method Show\Field|Collection mid(string $label = null)
     * @method Show\Field|Collection order_sn(string $label = null)
     * @method Show\Field|Collection pay_at(string $label = null)
     * @method Show\Field|Collection pay_info(string $label = null)
     * @method Show\Field|Collection pay_type(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection total_price(string $label = null)
     * @method Show\Field|Collection goods_id(string $label = null)
     * @method Show\Field|Collection num(string $label = null)
     * @method Show\Field|Collection order_id(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection link_src(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
