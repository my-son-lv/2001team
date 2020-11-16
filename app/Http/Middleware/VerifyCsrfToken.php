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
        "/admin/cate/del/"
    ];
}
