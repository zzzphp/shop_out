<?php

namespace Database\Seeders;

use Dcat\Admin\Models;
use Illuminate\Database\Seeder;
use DB;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        Models\Menu::truncate();
        Models\Menu::insert(
            [
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "extension" => "",
                    "icon" => "feather icon-bar-chart-2",
                    "id" => 1,
                    "order" => 1,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "Index",
                    "updated_at" => NULL,
                    "uri" => "/"
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "extension" => "",
                    "icon" => "feather icon-settings",
                    "id" => 2,
                    "order" => 38,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "Admin",
                    "updated_at" => "2021-10-18 16:57:43",
                    "uri" => NULL
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "extension" => "",
                    "icon" => "",
                    "id" => 3,
                    "order" => 39,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Users",
                    "updated_at" => "2021-10-18 16:57:43",
                    "uri" => "auth/users"
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "extension" => "",
                    "icon" => "",
                    "id" => 4,
                    "order" => 40,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Roles",
                    "updated_at" => "2021-10-18 16:57:44",
                    "uri" => "auth/roles"
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "extension" => "",
                    "icon" => "",
                    "id" => 5,
                    "order" => 41,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Permission",
                    "updated_at" => "2021-10-18 16:57:44",
                    "uri" => "auth/permissions"
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "extension" => "",
                    "icon" => "",
                    "id" => 6,
                    "order" => 42,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Menu",
                    "updated_at" => "2021-10-18 16:57:44",
                    "uri" => "auth/menu"
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "extension" => "",
                    "icon" => "",
                    "id" => 7,
                    "order" => 43,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Extensions",
                    "updated_at" => "2021-10-18 16:57:44",
                    "uri" => "auth/extensions"
                ],
                [
                    "created_at" => "2021-03-05 03:34:55",
                    "extension" => "",
                    "icon" => "fa-users",
                    "id" => 8,
                    "order" => 4,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "账号管理",
                    "updated_at" => "2021-10-18 16:57:38",
                    "uri" => "users"
                ],
                [
                    "created_at" => "2021-03-05 05:48:03",
                    "extension" => "",
                    "icon" => "fa-hacker-news",
                    "id" => 9,
                    "order" => 30,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "新闻中心",
                    "updated_at" => "2021-10-18 16:57:42",
                    "uri" => "news"
                ],
                [
                    "created_at" => "2021-03-05 07:15:29",
                    "extension" => "",
                    "icon" => "fa-btc",
                    "id" => 10,
                    "order" => 2,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "币种管理",
                    "updated_at" => "2021-07-13 17:46:05",
                    "uri" => "currencies"
                ],
                [
                    "created_at" => "2021-03-05 07:35:19",
                    "extension" => "",
                    "icon" => "fa-product-hunt",
                    "id" => 11,
                    "order" => 16,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "产品管理",
                    "updated_at" => "2021-10-18 16:57:40",
                    "uri" => "products"
                ],
                [
                    "created_at" => "2021-03-09 06:52:54",
                    "extension" => "",
                    "icon" => "fa-first-order",
                    "id" => 12,
                    "order" => 22,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "订单管理",
                    "updated_at" => "2021-10-18 16:57:41",
                    "uri" => "orders"
                ],
                [
                    "created_at" => "2021-03-11 11:13:40",
                    "extension" => "",
                    "icon" => "fa-sign-in",
                    "id" => 14,
                    "order" => 7,
                    "parent_id" => 8,
                    "show" => 1,
                    "title" => "充值管理",
                    "updated_at" => "2021-10-18 16:57:38",
                    "uri" => "recharges"
                ],
                [
                    "created_at" => "2021-03-16 06:20:22",
                    "extension" => "",
                    "icon" => "fa-usd",
                    "id" => 15,
                    "order" => 33,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "邀请奖励",
                    "updated_at" => "2021-10-18 16:57:43",
                    "uri" => "commissions"
                ],
                [
                    "created_at" => "2021-03-16 09:16:18",
                    "extension" => "",
                    "icon" => "fa-foursquare",
                    "id" => 16,
                    "order" => 25,
                    "parent_id" => 0,
                    "show" => 0,
                    "title" => "发币管理",
                    "updated_at" => "2021-10-18 16:57:41",
                    "uri" => "distributes"
                ],
                [
                    "created_at" => "2021-03-18 08:38:29",
                    "extension" => "",
                    "icon" => "fa-text-width",
                    "id" => 17,
                    "order" => 8,
                    "parent_id" => 8,
                    "show" => 1,
                    "title" => "提现管理",
                    "updated_at" => "2021-10-18 16:57:38",
                    "uri" => "withdrawals"
                ],
                [
                    "created_at" => "2021-03-28 13:11:13",
                    "extension" => "",
                    "icon" => "fa-gears",
                    "id" => 18,
                    "order" => 34,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "客户端配置",
                    "updated_at" => "2021-10-18 16:57:43",
                    "uri" => NULL
                ],
                [
                    "created_at" => "2021-03-28 13:11:54",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 19,
                    "order" => 35,
                    "parent_id" => 18,
                    "show" => 1,
                    "title" => "首页轮播图",
                    "updated_at" => "2021-10-18 16:57:43",
                    "uri" => "carousels"
                ],
                [
                    "created_at" => "2021-03-31 09:01:13",
                    "extension" => "",
                    "icon" => "fa-sort-numeric-asc",
                    "id" => 20,
                    "order" => 17,
                    "parent_id" => 11,
                    "show" => 0,
                    "title" => "期数管理",
                    "updated_at" => "2021-10-18 16:57:40",
                    "uri" => "stages"
                ],
                [
                    "created_at" => "2021-04-01 06:21:13",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 21,
                    "order" => 26,
                    "parent_id" => 16,
                    "show" => 1,
                    "title" => "整机发币",
                    "updated_at" => "2021-10-18 16:57:42",
                    "uri" => "distributes"
                ],
                [
                    "created_at" => "2021-04-01 07:35:00",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 22,
                    "order" => 27,
                    "parent_id" => 16,
                    "show" => 1,
                    "title" => "算力发币",
                    "updated_at" => "2021-10-18 16:57:42",
                    "uri" => "power_distributes"
                ],
                [
                    "created_at" => "2021-05-12 12:02:56",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 23,
                    "order" => 28,
                    "parent_id" => 16,
                    "show" => 1,
                    "title" => "发币记录",
                    "updated_at" => "2021-10-18 16:57:42",
                    "uri" => "logs"
                ],
                [
                    "created_at" => "2021-06-14 12:19:01",
                    "extension" => "",
                    "icon" => "fa-american-sign-language-interpreting",
                    "id" => 24,
                    "order" => 13,
                    "parent_id" => 0,
                    "show" => 0,
                    "title" => "代理管理",
                    "updated_at" => "2021-10-18 16:57:39",
                    "uri" => "agents"
                ],
                [
                    "created_at" => "2021-06-15 14:34:14",
                    "extension" => "",
                    "icon" => "fa-user-circle-o",
                    "id" => 25,
                    "order" => 5,
                    "parent_id" => 8,
                    "show" => 1,
                    "title" => "用户列表",
                    "updated_at" => "2021-10-18 16:57:38",
                    "uri" => "users"
                ],
                [
                    "created_at" => "2021-06-15 15:39:16",
                    "extension" => "",
                    "icon" => "fa-desktop",
                    "id" => 26,
                    "order" => 18,
                    "parent_id" => 11,
                    "show" => 1,
                    "title" => "产品列表",
                    "updated_at" => "2021-10-18 16:57:40",
                    "uri" => "products"
                ],
                [
                    "created_at" => "2021-06-15 15:40:31",
                    "extension" => "",
                    "icon" => "fa-dedent",
                    "id" => 27,
                    "order" => 19,
                    "parent_id" => 11,
                    "show" => 1,
                    "title" => "产品分类",
                    "updated_at" => "2021-10-18 16:57:40",
                    "uri" => "categories"
                ],
                [
                    "created_at" => "2021-06-18 14:27:24",
                    "extension" => "",
                    "icon" => "fa-user-md",
                    "id" => 28,
                    "order" => 14,
                    "parent_id" => 24,
                    "show" => 1,
                    "title" => "代理列表",
                    "updated_at" => "2021-10-18 16:57:40",
                    "uri" => "agents"
                ],
                [
                    "created_at" => "2021-06-18 14:31:21",
                    "extension" => "",
                    "icon" => "fa-copyright",
                    "id" => 29,
                    "order" => 15,
                    "parent_id" => 24,
                    "show" => 1,
                    "title" => "业绩统计",
                    "updated_at" => "2021-10-18 16:57:40",
                    "uri" => "agent_statistics"
                ],
                [
                    "created_at" => "2021-06-18 17:08:04",
                    "extension" => "",
                    "icon" => "fa-sort-amount-desc",
                    "id" => 30,
                    "order" => 9,
                    "parent_id" => 8,
                    "show" => 1,
                    "title" => "资金明细",
                    "updated_at" => "2021-10-18 16:57:39",
                    "uri" => "asset_details"
                ],
                [
                    "created_at" => "2021-06-21 10:33:43",
                    "extension" => "",
                    "icon" => "fa-paste",
                    "id" => 31,
                    "order" => 20,
                    "parent_id" => 11,
                    "show" => 1,
                    "title" => "协议管理",
                    "updated_at" => "2021-10-18 16:57:40",
                    "uri" => "agreements"
                ],
                [
                    "created_at" => "2021-06-25 16:55:48",
                    "extension" => "",
                    "icon" => "fa-stack-overflow",
                    "id" => 32,
                    "order" => 24,
                    "parent_id" => 12,
                    "show" => 0,
                    "title" => "分期管理",
                    "updated_at" => "2021-10-18 16:57:41",
                    "uri" => "installment_items"
                ],
                [
                    "created_at" => "2021-06-25 16:56:24",
                    "extension" => "",
                    "icon" => "fa-first-order",
                    "id" => 33,
                    "order" => 23,
                    "parent_id" => 12,
                    "show" => 1,
                    "title" => "订单列表",
                    "updated_at" => "2021-10-18 16:57:41",
                    "uri" => "orders"
                ],
                [
                    "created_at" => "2021-06-26 15:34:08",
                    "extension" => "",
                    "icon" => "fa-paypal",
                    "id" => 34,
                    "order" => 21,
                    "parent_id" => 11,
                    "show" => 0,
                    "title" => "支付管理",
                    "updated_at" => "2021-10-18 16:57:40",
                    "uri" => "pay_methods"
                ],
                [
                    "created_at" => "2021-06-27 15:00:46",
                    "extension" => "",
                    "icon" => "fa-file-powerpoint-o",
                    "id" => 35,
                    "order" => 10,
                    "parent_id" => 8,
                    "show" => 0,
                    "title" => "有效算力",
                    "updated_at" => "2021-10-18 16:57:39",
                    "uri" => "powers"
                ],
                [
                    "created_at" => "2021-07-13 17:48:09",
                    "extension" => "",
                    "icon" => "fa-database",
                    "id" => 36,
                    "order" => 11,
                    "parent_id" => 0,
                    "show" => 0,
                    "title" => "借贷管理",
                    "updated_at" => "2021-10-18 16:57:39",
                    "uri" => NULL
                ],
                [
                    "created_at" => "2021-07-14 11:58:08",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 37,
                    "order" => 12,
                    "parent_id" => 36,
                    "show" => 1,
                    "title" => "借款信息",
                    "updated_at" => "2021-10-18 16:57:39",
                    "uri" => "loans"
                ],
                [
                    "created_at" => "2021-07-16 09:40:47",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 38,
                    "order" => 36,
                    "parent_id" => 18,
                    "show" => 0,
                    "title" => "BIKI行情配置",
                    "updated_at" => "2021-10-18 16:57:43",
                    "uri" => "market_biki"
                ],
                [
                    "created_at" => "2021-07-24 14:11:15",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 39,
                    "order" => 29,
                    "parent_id" => 16,
                    "show" => 1,
                    "title" => "自动发币",
                    "updated_at" => "2021-10-18 16:57:42",
                    "uri" => "automatics"
                ],
                [
                    "created_at" => "2021-08-02 15:40:57",
                    "extension" => "",
                    "icon" => "fa-angle-double-up",
                    "id" => 40,
                    "order" => 37,
                    "parent_id" => 18,
                    "show" => 1,
                    "title" => "APP版本更新配置",
                    "updated_at" => "2021-10-18 16:57:43",
                    "uri" => "versions"
                ],
                [
                    "created_at" => "2021-10-05 11:51:02",
                    "extension" => "",
                    "icon" => "fa-creative-commons",
                    "id" => 41,
                    "order" => 6,
                    "parent_id" => 8,
                    "show" => 1,
                    "title" => "实名认证",
                    "updated_at" => "2021-10-18 16:57:38",
                    "uri" => "real_names"
                ],
                [
                    "created_at" => "2021-10-13 15:02:27",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 42,
                    "order" => 31,
                    "parent_id" => 9,
                    "show" => 1,
                    "title" => "资讯中心",
                    "updated_at" => "2021-10-18 16:57:42",
                    "uri" => "information"
                ],
                [
                    "created_at" => "2021-10-13 15:03:49",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 43,
                    "order" => 32,
                    "parent_id" => 9,
                    "show" => 1,
                    "title" => "活动公告",
                    "updated_at" => "2021-10-18 16:57:43",
                    "uri" => "news"
                ],
                [
                    "created_at" => "2021-10-18 16:57:07",
                    "extension" => "",
                    "icon" => "fa-share-alt",
                    "id" => 45,
                    "order" => 3,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "店铺管理",
                    "updated_at" => "2021-10-18 16:57:37",
                    "uri" => "shops"
                ]
            ]
        );

        Models\Permission::truncate();
        Models\Permission::insert(
            [
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "http_method" => "",
                    "http_path" => "",
                    "id" => 1,
                    "name" => "Auth management",
                    "order" => 1,
                    "parent_id" => 0,
                    "slug" => "auth-management",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "http_method" => "",
                    "http_path" => "/auth/users*",
                    "id" => 2,
                    "name" => "Users",
                    "order" => 2,
                    "parent_id" => 1,
                    "slug" => "users",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "http_method" => "",
                    "http_path" => "/auth/roles*",
                    "id" => 3,
                    "name" => "Roles",
                    "order" => 3,
                    "parent_id" => 1,
                    "slug" => "roles",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "http_method" => "",
                    "http_path" => "/auth/permissions*",
                    "id" => 4,
                    "name" => "Permissions",
                    "order" => 4,
                    "parent_id" => 1,
                    "slug" => "permissions",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "http_method" => "",
                    "http_path" => "/auth/menu*",
                    "id" => 5,
                    "name" => "Menu",
                    "order" => 5,
                    "parent_id" => 1,
                    "slug" => "menu",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "http_method" => "",
                    "http_path" => "/auth/extensions*",
                    "id" => 6,
                    "name" => "Extension",
                    "order" => 6,
                    "parent_id" => 1,
                    "slug" => "extension",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-06-14 10:18:23",
                    "http_method" => "",
                    "http_path" => "/users*",
                    "id" => 7,
                    "name" => "users",
                    "order" => 8,
                    "parent_id" => 0,
                    "slug" => "customer",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "created_at" => "2021-06-14 10:25:03",
                    "http_method" => "",
                    "http_path" => "/orders",
                    "id" => 8,
                    "name" => "orders",
                    "order" => 9,
                    "parent_id" => 0,
                    "slug" => "orders",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "created_at" => "2021-06-14 10:31:45",
                    "http_method" => "",
                    "http_path" => "/recharges",
                    "id" => 9,
                    "name" => "recharges",
                    "order" => 10,
                    "parent_id" => 0,
                    "slug" => "recharges",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "created_at" => "2021-06-14 10:32:19",
                    "http_method" => "",
                    "http_path" => "/withdrawals",
                    "id" => 10,
                    "name" => "withdrawals",
                    "order" => 11,
                    "parent_id" => 0,
                    "slug" => "withdrawals",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "created_at" => "2021-06-14 17:01:07",
                    "http_method" => "",
                    "http_path" => "/agents*",
                    "id" => 11,
                    "name" => "agents",
                    "order" => 12,
                    "parent_id" => 0,
                    "slug" => "agents",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "created_at" => "2021-06-18 17:20:58",
                    "http_method" => "GET",
                    "http_path" => "/asset_details",
                    "id" => 12,
                    "name" => "asset_details",
                    "order" => 13,
                    "parent_id" => 0,
                    "slug" => "asset_details",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "created_at" => "2021-06-18 17:23:29",
                    "http_method" => "GET",
                    "http_path" => "/agent_statistics",
                    "id" => 13,
                    "name" => "agent_statistics",
                    "order" => 14,
                    "parent_id" => 0,
                    "slug" => "agent_statistics",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "created_at" => "2021-10-12 16:01:35",
                    "http_method" => "GET,POST",
                    "http_path" => "/products/create*,/products,/products/*/edit,/products/*",
                    "id" => 14,
                    "name" => "products",
                    "order" => 15,
                    "parent_id" => 0,
                    "slug" => "products",
                    "updated_at" => "2021-10-13 14:27:42"
                ],
                [
                    "created_at" => "2021-10-13 12:20:36",
                    "http_method" => "",
                    "http_path" => "/real_names*",
                    "id" => 15,
                    "name" => "realname",
                    "order" => 7,
                    "parent_id" => 0,
                    "slug" => "realname",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "created_at" => "2021-10-13 14:46:36",
                    "http_method" => "",
                    "http_path" => "/categories*",
                    "id" => 16,
                    "name" => "categories",
                    "order" => 16,
                    "parent_id" => 0,
                    "slug" => "categories",
                    "updated_at" => "2021-10-13 14:46:36"
                ],
                [
                    "created_at" => "2021-10-13 14:51:08",
                    "http_method" => "",
                    "http_path" => "/children*",
                    "id" => 17,
                    "name" => "children",
                    "order" => 17,
                    "parent_id" => 0,
                    "slug" => "children",
                    "updated_at" => "2021-10-13 14:51:08"
                ],
                [
                    "created_at" => "2021-10-13 15:06:24",
                    "http_method" => "",
                    "http_path" => "/news*",
                    "id" => 18,
                    "name" => "news",
                    "order" => 18,
                    "parent_id" => 0,
                    "slug" => "news",
                    "updated_at" => "2021-10-13 15:06:24"
                ],
                [
                    "created_at" => "2021-10-13 15:06:58",
                    "http_method" => "",
                    "http_path" => "/information*",
                    "id" => 19,
                    "name" => "information",
                    "order" => 19,
                    "parent_id" => 0,
                    "slug" => "information",
                    "updated_at" => "2021-10-13 15:06:58"
                ],
                [
                    "created_at" => "2021-10-13 15:14:10",
                    "http_method" => "",
                    "http_path" => "/commissions*",
                    "id" => 20,
                    "name" => "commissions",
                    "order" => 20,
                    "parent_id" => 0,
                    "slug" => "commissions",
                    "updated_at" => "2021-10-13 15:14:10"
                ],
                [
                    "created_at" => "2021-10-18 17:54:10",
                    "http_method" => "GET,POST,PUT",
                    "http_path" => "/shops,/shops/*/edit,/shops/*",
                    "id" => 21,
                    "name" => "shops",
                    "order" => 21,
                    "parent_id" => 0,
                    "slug" => "shops",
                    "updated_at" => "2021-10-18 18:00:20"
                ]
            ]
        );

        Models\Role::truncate();
        Models\Role::insert(
            [
                [
                    "created_at" => "2021-03-05 03:11:11",
                    "id" => 1,
                    "name" => "超级管理员",
                    "slug" => "administrator",
                    "updated_at" => "2021-10-12 15:38:26"
                ],
                [
                    "created_at" => "2021-10-12 15:39:29",
                    "id" => 3,
                    "name" => "产品管理员",
                    "slug" => "products",
                    "updated_at" => "2021-10-12 15:39:29"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "id" => 5,
                    "name" => "馆长",
                    "slug" => "curator",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-13 15:09:31",
                    "id" => 6,
                    "name" => "客服",
                    "slug" => "service",
                    "updated_at" => "2021-10-13 15:09:31"
                ],
                [
                    "created_at" => "2021-10-13 15:13:31",
                    "id" => 7,
                    "name" => "财务",
                    "slug" => "finance",
                    "updated_at" => "2021-10-13 15:13:41"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "id" => 8,
                    "name" => "董事长",
                    "slug" => "chairman",
                    "updated_at" => "2021-10-13 16:11:57"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "id" => 9,
                    "name" => "CEO",
                    "slug" => "ceo",
                    "updated_at" => "2021-10-13 16:12:19"
                ]
            ]
        );

        Models\Setting::truncate();
		Models\Setting::insert(
			[

            ]
		);

		Models\Extension::truncate();
		Models\Extension::insert(
			[

            ]
		);

		Models\ExtensionHistory::truncate();
		Models\ExtensionHistory::insert(
			[

            ]
		);

        // pivot tables
        DB::table('admin_permission_menu')->truncate();
		DB::table('admin_permission_menu')->insert(
			[
                [
                    "created_at" => "2021-06-14 10:18:51",
                    "menu_id" => 8,
                    "permission_id" => 7,
                    "updated_at" => "2021-06-14 10:18:51"
                ],
                [
                    "created_at" => "2021-06-15 14:34:14",
                    "menu_id" => 25,
                    "permission_id" => 7,
                    "updated_at" => "2021-06-15 14:34:14"
                ],
                [
                    "created_at" => "2021-06-25 16:56:24",
                    "menu_id" => 33,
                    "permission_id" => 8,
                    "updated_at" => "2021-06-25 16:56:24"
                ],
                [
                    "created_at" => "2021-06-18 14:27:24",
                    "menu_id" => 28,
                    "permission_id" => 11,
                    "updated_at" => "2021-06-18 14:27:24"
                ],
                [
                    "created_at" => "2021-10-12 16:01:35",
                    "menu_id" => 11,
                    "permission_id" => 14,
                    "updated_at" => "2021-10-12 16:01:35"
                ],
                [
                    "created_at" => "2021-10-12 16:01:35",
                    "menu_id" => 26,
                    "permission_id" => 14,
                    "updated_at" => "2021-10-12 16:01:35"
                ],
                [
                    "created_at" => "2021-10-13 12:20:36",
                    "menu_id" => 41,
                    "permission_id" => 15,
                    "updated_at" => "2021-10-13 12:20:36"
                ],
                [
                    "created_at" => "2021-10-13 14:48:12",
                    "menu_id" => 27,
                    "permission_id" => 16,
                    "updated_at" => "2021-10-13 14:48:12"
                ],
                [
                    "created_at" => "2021-10-13 15:06:24",
                    "menu_id" => 43,
                    "permission_id" => 18,
                    "updated_at" => "2021-10-13 15:06:24"
                ],
                [
                    "created_at" => "2021-10-13 15:06:58",
                    "menu_id" => 42,
                    "permission_id" => 19,
                    "updated_at" => "2021-10-13 15:06:58"
                ],
                [
                    "created_at" => "2021-10-13 15:14:10",
                    "menu_id" => 15,
                    "permission_id" => 20,
                    "updated_at" => "2021-10-13 15:14:10"
                ],
                [
                    "created_at" => "2021-10-18 17:54:10",
                    "menu_id" => 45,
                    "permission_id" => 21,
                    "updated_at" => "2021-10-18 17:54:10"
                ]
            ]
		);

        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "created_at" => "2021-06-14 10:23:41",
                    "menu_id" => 2,
                    "role_id" => 1,
                    "updated_at" => "2021-06-14 10:23:41"
                ],
                [
                    "created_at" => "2021-03-05 03:34:55",
                    "menu_id" => 8,
                    "role_id" => 1,
                    "updated_at" => "2021-03-05 03:34:55"
                ],
                [
                    "created_at" => "2021-03-05 05:48:03",
                    "menu_id" => 9,
                    "role_id" => 1,
                    "updated_at" => "2021-03-05 05:48:03"
                ],
                [
                    "created_at" => "2021-03-05 07:15:29",
                    "menu_id" => 10,
                    "role_id" => 1,
                    "updated_at" => "2021-03-05 07:15:29"
                ],
                [
                    "created_at" => "2021-03-05 07:35:19",
                    "menu_id" => 11,
                    "role_id" => 1,
                    "updated_at" => "2021-03-05 07:35:19"
                ],
                [
                    "created_at" => "2021-03-09 06:52:54",
                    "menu_id" => 12,
                    "role_id" => 1,
                    "updated_at" => "2021-03-09 06:52:54"
                ],
                [
                    "created_at" => "2021-03-11 11:13:40",
                    "menu_id" => 14,
                    "role_id" => 1,
                    "updated_at" => "2021-03-11 11:13:40"
                ],
                [
                    "created_at" => "2021-06-14 10:22:19",
                    "menu_id" => 15,
                    "role_id" => 1,
                    "updated_at" => "2021-06-14 10:22:19"
                ],
                [
                    "created_at" => "2021-03-16 09:16:18",
                    "menu_id" => 16,
                    "role_id" => 1,
                    "updated_at" => "2021-03-16 09:16:18"
                ],
                [
                    "created_at" => "2021-03-18 08:38:29",
                    "menu_id" => 17,
                    "role_id" => 1,
                    "updated_at" => "2021-03-18 08:38:29"
                ],
                [
                    "created_at" => "2021-06-14 10:24:01",
                    "menu_id" => 18,
                    "role_id" => 1,
                    "updated_at" => "2021-06-14 10:24:01"
                ],
                [
                    "created_at" => "2021-03-28 13:11:54",
                    "menu_id" => 19,
                    "role_id" => 1,
                    "updated_at" => "2021-03-28 13:11:54"
                ],
                [
                    "created_at" => "2021-06-14 10:21:51",
                    "menu_id" => 20,
                    "role_id" => 1,
                    "updated_at" => "2021-06-14 10:21:51"
                ],
                [
                    "created_at" => "2021-06-14 12:19:01",
                    "menu_id" => 24,
                    "role_id" => 1,
                    "updated_at" => "2021-06-14 12:19:01"
                ],
                [
                    "created_at" => "2021-06-15 14:34:14",
                    "menu_id" => 25,
                    "role_id" => 1,
                    "updated_at" => "2021-06-15 14:34:14"
                ],
                [
                    "created_at" => "2021-06-15 15:39:26",
                    "menu_id" => 26,
                    "role_id" => 1,
                    "updated_at" => "2021-06-15 15:39:26"
                ],
                [
                    "created_at" => "2021-06-15 15:40:31",
                    "menu_id" => 27,
                    "role_id" => 1,
                    "updated_at" => "2021-06-15 15:40:31"
                ],
                [
                    "created_at" => "2021-06-18 14:27:24",
                    "menu_id" => 28,
                    "role_id" => 1,
                    "updated_at" => "2021-06-18 14:27:24"
                ],
                [
                    "created_at" => "2021-06-18 14:31:21",
                    "menu_id" => 29,
                    "role_id" => 1,
                    "updated_at" => "2021-06-18 14:31:21"
                ],
                [
                    "created_at" => "2021-06-18 17:08:04",
                    "menu_id" => 30,
                    "role_id" => 1,
                    "updated_at" => "2021-06-18 17:08:04"
                ],
                [
                    "created_at" => "2021-06-21 10:33:43",
                    "menu_id" => 31,
                    "role_id" => 1,
                    "updated_at" => "2021-06-21 10:33:43"
                ],
                [
                    "created_at" => "2021-06-25 16:56:24",
                    "menu_id" => 33,
                    "role_id" => 1,
                    "updated_at" => "2021-06-25 16:56:24"
                ],
                [
                    "created_at" => "2021-06-26 15:34:08",
                    "menu_id" => 34,
                    "role_id" => 1,
                    "updated_at" => "2021-06-26 15:34:08"
                ],
                [
                    "created_at" => "2021-06-27 15:00:46",
                    "menu_id" => 35,
                    "role_id" => 1,
                    "updated_at" => "2021-06-27 15:00:46"
                ],
                [
                    "created_at" => "2021-07-13 17:48:10",
                    "menu_id" => 36,
                    "role_id" => 1,
                    "updated_at" => "2021-07-13 17:48:10"
                ],
                [
                    "created_at" => "2021-07-14 11:58:08",
                    "menu_id" => 37,
                    "role_id" => 1,
                    "updated_at" => "2021-07-14 11:58:08"
                ],
                [
                    "created_at" => "2021-07-16 09:40:47",
                    "menu_id" => 38,
                    "role_id" => 1,
                    "updated_at" => "2021-07-16 09:40:47"
                ],
                [
                    "created_at" => "2021-07-24 14:11:15",
                    "menu_id" => 39,
                    "role_id" => 1,
                    "updated_at" => "2021-07-24 14:11:15"
                ],
                [
                    "created_at" => "2021-08-02 15:40:57",
                    "menu_id" => 40,
                    "role_id" => 1,
                    "updated_at" => "2021-08-02 15:40:57"
                ],
                [
                    "created_at" => "2021-10-05 11:51:02",
                    "menu_id" => 41,
                    "role_id" => 1,
                    "updated_at" => "2021-10-05 11:51:02"
                ],
                [
                    "created_at" => "2021-06-14 10:18:51",
                    "menu_id" => 8,
                    "role_id" => 2,
                    "updated_at" => "2021-06-14 10:18:51"
                ],
                [
                    "created_at" => "2021-06-14 10:23:10",
                    "menu_id" => 12,
                    "role_id" => 2,
                    "updated_at" => "2021-06-14 10:23:10"
                ],
                [
                    "created_at" => "2021-06-14 10:22:57",
                    "menu_id" => 17,
                    "role_id" => 2,
                    "updated_at" => "2021-06-14 10:22:57"
                ],
                [
                    "created_at" => "2021-06-14 17:00:42",
                    "menu_id" => 24,
                    "role_id" => 2,
                    "updated_at" => "2021-06-14 17:00:42"
                ],
                [
                    "created_at" => "2021-06-15 14:34:14",
                    "menu_id" => 25,
                    "role_id" => 2,
                    "updated_at" => "2021-06-15 14:34:14"
                ],
                [
                    "created_at" => "2021-06-18 14:27:24",
                    "menu_id" => 28,
                    "role_id" => 2,
                    "updated_at" => "2021-06-18 14:27:24"
                ],
                [
                    "created_at" => "2021-06-18 14:31:21",
                    "menu_id" => 29,
                    "role_id" => 2,
                    "updated_at" => "2021-06-18 14:31:21"
                ],
                [
                    "created_at" => "2021-06-18 17:08:04",
                    "menu_id" => 30,
                    "role_id" => 2,
                    "updated_at" => "2021-06-18 17:08:04"
                ],
                [
                    "created_at" => "2021-06-25 16:56:24",
                    "menu_id" => 33,
                    "role_id" => 2,
                    "updated_at" => "2021-06-25 16:56:24"
                ],
                [
                    "created_at" => "2021-10-12 15:39:29",
                    "menu_id" => 11,
                    "role_id" => 3,
                    "updated_at" => "2021-10-12 15:39:29"
                ],
                [
                    "created_at" => "2021-10-12 15:39:29",
                    "menu_id" => 26,
                    "role_id" => 3,
                    "updated_at" => "2021-10-12 15:39:29"
                ],
                [
                    "created_at" => "2021-10-13 09:30:35",
                    "menu_id" => 8,
                    "role_id" => 4,
                    "updated_at" => "2021-10-13 09:30:35"
                ],
                [
                    "created_at" => "2021-10-13 09:30:35",
                    "menu_id" => 25,
                    "role_id" => 4,
                    "updated_at" => "2021-10-13 09:30:35"
                ],
                [
                    "created_at" => "2021-10-13 09:30:35",
                    "menu_id" => 41,
                    "role_id" => 4,
                    "updated_at" => "2021-10-13 09:30:35"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "menu_id" => 8,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-13 14:25:01",
                    "menu_id" => 11,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "created_at" => "2021-10-13 14:25:01",
                    "menu_id" => 12,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "created_at" => "2021-10-13 14:25:01",
                    "menu_id" => 14,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "created_at" => "2021-10-13 14:25:01",
                    "menu_id" => 17,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "menu_id" => 25,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-13 14:25:01",
                    "menu_id" => 26,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "created_at" => "2021-10-18 16:34:06",
                    "menu_id" => 27,
                    "role_id" => 5,
                    "updated_at" => "2021-10-18 16:34:06"
                ],
                [
                    "created_at" => "2021-10-13 14:25:01",
                    "menu_id" => 30,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "created_at" => "2021-10-13 14:25:01",
                    "menu_id" => 33,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "menu_id" => 41,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-18 17:54:31",
                    "menu_id" => 45,
                    "role_id" => 5,
                    "updated_at" => "2021-10-18 17:54:31"
                ],
                [
                    "created_at" => "2021-10-13 15:09:32",
                    "menu_id" => 9,
                    "role_id" => 6,
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "created_at" => "2021-10-13 15:09:32",
                    "menu_id" => 25,
                    "role_id" => 6,
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "created_at" => "2021-10-13 15:09:32",
                    "menu_id" => 41,
                    "role_id" => 6,
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "created_at" => "2021-10-13 15:09:32",
                    "menu_id" => 42,
                    "role_id" => 6,
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "created_at" => "2021-10-13 15:09:32",
                    "menu_id" => 43,
                    "role_id" => 6,
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "created_at" => "2021-10-13 15:13:31",
                    "menu_id" => 15,
                    "role_id" => 7,
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "created_at" => "2021-10-13 15:13:31",
                    "menu_id" => 17,
                    "role_id" => 7,
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "created_at" => "2021-10-13 15:13:31",
                    "menu_id" => 25,
                    "role_id" => 7,
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "created_at" => "2021-10-13 15:13:31",
                    "menu_id" => 30,
                    "role_id" => 7,
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 1,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 3,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 4,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 5,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 6,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 7,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 8,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 9,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 10,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 11,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 12,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 14,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 15,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 16,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 17,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 18,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 19,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 20,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 21,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 22,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 23,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 24,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 25,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 26,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 27,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 28,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 29,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 30,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 31,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 32,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 33,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 34,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 35,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 36,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 37,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 38,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:11:36",
                    "menu_id" => 39,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 40,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "menu_id" => 41,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 42,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:11:37",
                    "menu_id" => 43,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 1,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 8,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:22",
                    "menu_id" => 9,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 10,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 11,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 12,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 14,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:22",
                    "menu_id" => 15,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 16,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 17,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:22",
                    "menu_id" => 18,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "created_at" => "2021-10-13 16:12:22",
                    "menu_id" => 19,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 20,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 21,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 22,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 23,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 24,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 25,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 26,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 27,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 28,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 29,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 30,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 31,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 32,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 33,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 34,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 35,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 36,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:21",
                    "menu_id" => 37,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "created_at" => "2021-10-13 16:12:22",
                    "menu_id" => 38,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "created_at" => "2021-10-13 16:12:22",
                    "menu_id" => 39,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "created_at" => "2021-10-13 16:12:22",
                    "menu_id" => 40,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "menu_id" => 41,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:22",
                    "menu_id" => 42,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "created_at" => "2021-10-13 16:12:22",
                    "menu_id" => 43,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:22"
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "created_at" => "2021-10-12 16:02:09",
                    "permission_id" => 14,
                    "role_id" => 3,
                    "updated_at" => "2021-10-12 16:02:09"
                ],
                [
                    "created_at" => "2021-10-13 14:28:06",
                    "permission_id" => 7,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:28:06"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "permission_id" => 8,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "permission_id" => 9,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "permission_id" => 10,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "permission_id" => 12,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "permission_id" => 14,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-13 14:25:00",
                    "permission_id" => 15,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "created_at" => "2021-10-18 16:34:06",
                    "permission_id" => 16,
                    "role_id" => 5,
                    "updated_at" => "2021-10-18 16:34:06"
                ],
                [
                    "created_at" => "2021-10-13 14:52:47",
                    "permission_id" => 17,
                    "role_id" => 5,
                    "updated_at" => "2021-10-13 14:52:47"
                ],
                [
                    "created_at" => "2021-10-18 17:54:30",
                    "permission_id" => 21,
                    "role_id" => 5,
                    "updated_at" => "2021-10-18 17:54:30"
                ],
                [
                    "created_at" => "2021-10-13 15:09:32",
                    "permission_id" => 7,
                    "role_id" => 6,
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "created_at" => "2021-10-13 15:09:32",
                    "permission_id" => 15,
                    "role_id" => 6,
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "created_at" => "2021-10-13 15:11:14",
                    "permission_id" => 18,
                    "role_id" => 6,
                    "updated_at" => "2021-10-13 15:11:14"
                ],
                [
                    "created_at" => "2021-10-13 15:11:14",
                    "permission_id" => 19,
                    "role_id" => 6,
                    "updated_at" => "2021-10-13 15:11:14"
                ],
                [
                    "created_at" => "2021-10-13 15:13:31",
                    "permission_id" => 7,
                    "role_id" => 7,
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "created_at" => "2021-10-13 15:13:31",
                    "permission_id" => 8,
                    "role_id" => 7,
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "created_at" => "2021-10-13 15:13:31",
                    "permission_id" => 10,
                    "role_id" => 7,
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "created_at" => "2021-10-13 15:13:31",
                    "permission_id" => 12,
                    "role_id" => 7,
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "created_at" => "2021-10-13 15:14:47",
                    "permission_id" => 20,
                    "role_id" => 7,
                    "updated_at" => "2021-10-13 15:14:47"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 7,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 8,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 9,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 10,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 11,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 12,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 13,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 14,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 15,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 16,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 17,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:34",
                    "permission_id" => 18,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "permission_id" => 19,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:11:35",
                    "permission_id" => 20,
                    "role_id" => 8,
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "permission_id" => 7,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "permission_id" => 8,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "permission_id" => 9,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "permission_id" => 10,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "permission_id" => 11,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "permission_id" => 12,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "permission_id" => 13,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "permission_id" => 14,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "created_at" => "2021-10-13 16:12:19",
                    "permission_id" => 15,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "permission_id" => 16,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "permission_id" => 17,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "permission_id" => 18,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "permission_id" => 19,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "created_at" => "2021-10-13 16:12:20",
                    "permission_id" => 20,
                    "role_id" => 9,
                    "updated_at" => "2021-10-13 16:12:20"
                ]
            ]
        );

        // finish
    }
}
