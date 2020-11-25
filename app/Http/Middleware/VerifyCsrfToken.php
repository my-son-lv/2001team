<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admin/brand",
        "/admin/brand/store",
        "/admin/brand/del",
        "/admin/brand/upd",
        "/admin/brand/update_do",
        "/admin/brand_do",
        "/admin/advert_do",
        "/admin/advert_del",
        "/admin/advert_upd_do",
        "/admin/specs/create",
        "/admin/position_do",
        "/admin/position_advert_do",
        "/admin/goods/upload",
        "/admin/goods/uploads",
        "/admin/goods/specs",
        "/admin/goods/specs_create",
        "/admin/store",
        "/admin/del",
        "/admin/upd",
        "/admin/update_do",
        "/admin/cate/store",
        "/admin/cate/check_cateshows",
        "/admin/cate/del/",
        "/admin/goods/store",
        "/admin/coupon/store",
        "/admin/coupon/del",
        "/admin_login_do",
        "/admin/goods/del",
        "/index/addcart",
        "/saller/regdo",
        "/saller/logindo",
        "/saller/sallerdo",
        "/saller/goods/specs",
        "/saller/goods/specs_create",
        "/saller/goods/uploads",
        "/saller/goods/upload",
        "/saller/goods",
        "/saller/goods/create",
        "/saller/goods/store",
        "/saller/goods/del",
        "/index/cart",
        "/index/settl",
        "/admin/kill_do",
        "/saller/sallerdo",
        "/user_kill",
        "/admin/examine/exam_true",
        "/admin/examine/exam_false",
        "/admin/saller_examine/saller_true",
        "/admin/saller_examine/saller_false",
        "/admin/saller_examine/saller_down",
        "/index/getorder",
        "/user_kill",
        "/index/order",
        "/index/getTypePrice",
        "/index/getTypePrices",
        "/index/getInputPrice",
        "/index/del",
        "/index/manydel",
        "/index/order",
        "/user_colle",
    ];
}
