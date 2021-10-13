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
                    "id" => 1,
                    "parent_id" => 0,
                    "order" => 1,
                    "title" => "Index",
                    "icon" => "feather icon-bar-chart-2",
                    "uri" => "/",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => NULL
                ],
                [
                    "id" => 2,
                    "parent_id" => 0,
                    "order" => 35,
                    "title" => "Admin",
                    "icon" => "feather icon-settings",
                    "uri" => NULL,
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-10-05 11:51:26"
                ],
                [
                    "id" => 3,
                    "parent_id" => 2,
                    "order" => 36,
                    "title" => "Users",
                    "icon" => "",
                    "uri" => "auth/users",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-10-05 11:51:27"
                ],
                [
                    "id" => 4,
                    "parent_id" => 2,
                    "order" => 37,
                    "title" => "Roles",
                    "icon" => "",
                    "uri" => "auth/roles",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-10-05 11:51:27"
                ],
                [
                    "id" => 5,
                    "parent_id" => 2,
                    "order" => 38,
                    "title" => "Permission",
                    "icon" => "",
                    "uri" => "auth/permissions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-10-05 11:51:27"
                ],
                [
                    "id" => 6,
                    "parent_id" => 2,
                    "order" => 39,
                    "title" => "Menu",
                    "icon" => "",
                    "uri" => "auth/menu",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-10-05 11:51:28"
                ],
                [
                    "id" => 7,
                    "parent_id" => 2,
                    "order" => 40,
                    "title" => "Extensions",
                    "icon" => "",
                    "uri" => "auth/extensions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-10-05 11:51:28"
                ],
                [
                    "id" => 8,
                    "parent_id" => 0,
                    "order" => 3,
                    "title" => "账号管理",
                    "icon" => "fa-users",
                    "uri" => "users",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:34:55",
                    "updated_at" => "2021-07-13 17:33:10"
                ],
                [
                    "id" => 9,
                    "parent_id" => 0,
                    "order" => 29,
                    "title" => "新闻中心",
                    "icon" => "fa-hacker-news",
                    "uri" => "news",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 05:48:03",
                    "updated_at" => "2021-10-13 15:04:25"
                ],
                [
                    "id" => 10,
                    "parent_id" => 0,
                    "order" => 2,
                    "title" => "币种管理",
                    "icon" => "fa-btc",
                    "uri" => "currencies",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 07:15:29",
                    "updated_at" => "2021-07-13 17:46:05"
                ],
                [
                    "id" => 11,
                    "parent_id" => 0,
                    "order" => 15,
                    "title" => "产品管理",
                    "icon" => "fa-product-hunt",
                    "uri" => "products",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 07:35:19",
                    "updated_at" => "2021-10-05 11:51:18"
                ],
                [
                    "id" => 12,
                    "parent_id" => 0,
                    "order" => 21,
                    "title" => "订单管理",
                    "icon" => "fa-first-order",
                    "uri" => "orders",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-09 06:52:54",
                    "updated_at" => "2021-10-05 11:51:21"
                ],
                [
                    "id" => 14,
                    "parent_id" => 8,
                    "order" => 6,
                    "title" => "充值管理",
                    "icon" => "fa-sign-in",
                    "uri" => "recharges",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-11 11:13:40",
                    "updated_at" => "2021-10-05 11:51:15"
                ],
                [
                    "id" => 15,
                    "parent_id" => 0,
                    "order" => 30,
                    "title" => "邀请奖励",
                    "icon" => "fa-usd",
                    "uri" => "commissions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-16 06:20:22",
                    "updated_at" => "2021-10-05 11:51:24"
                ],
                [
                    "id" => 16,
                    "parent_id" => 0,
                    "order" => 24,
                    "title" => "发币管理",
                    "icon" => "fa-foursquare",
                    "uri" => "distributes",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-03-16 09:16:18",
                    "updated_at" => "2021-10-05 11:51:22"
                ],
                [
                    "id" => 17,
                    "parent_id" => 8,
                    "order" => 7,
                    "title" => "提现管理",
                    "icon" => "fa-text-width",
                    "uri" => "withdrawals",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-18 08:38:29",
                    "updated_at" => "2021-10-05 11:51:15"
                ],
                [
                    "id" => 18,
                    "parent_id" => 0,
                    "order" => 31,
                    "title" => "客户端配置",
                    "icon" => "fa-gears",
                    "uri" => NULL,
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-28 13:11:13",
                    "updated_at" => "2021-10-05 11:51:24"
                ],
                [
                    "id" => 19,
                    "parent_id" => 18,
                    "order" => 32,
                    "title" => "首页轮播图",
                    "icon" => NULL,
                    "uri" => "carousels",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-28 13:11:54",
                    "updated_at" => "2021-10-05 11:51:25"
                ],
                [
                    "id" => 20,
                    "parent_id" => 11,
                    "order" => 16,
                    "title" => "期数管理",
                    "icon" => "fa-sort-numeric-asc",
                    "uri" => "stages",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-03-31 09:01:13",
                    "updated_at" => "2021-10-05 11:51:19"
                ],
                [
                    "id" => 21,
                    "parent_id" => 16,
                    "order" => 25,
                    "title" => "整机发币",
                    "icon" => NULL,
                    "uri" => "distributes",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-04-01 06:21:13",
                    "updated_at" => "2021-10-05 11:51:22"
                ],
                [
                    "id" => 22,
                    "parent_id" => 16,
                    "order" => 26,
                    "title" => "算力发币",
                    "icon" => NULL,
                    "uri" => "power_distributes",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-04-01 07:35:00",
                    "updated_at" => "2021-10-05 11:51:23"
                ],
                [
                    "id" => 23,
                    "parent_id" => 16,
                    "order" => 27,
                    "title" => "发币记录",
                    "icon" => NULL,
                    "uri" => "logs",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-05-12 12:02:56",
                    "updated_at" => "2021-10-05 11:51:23"
                ],
                [
                    "id" => 24,
                    "parent_id" => 0,
                    "order" => 12,
                    "title" => "代理管理",
                    "icon" => "fa-american-sign-language-interpreting",
                    "uri" => "agents",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-06-14 12:19:01",
                    "updated_at" => "2021-10-05 11:51:17"
                ],
                [
                    "id" => 25,
                    "parent_id" => 8,
                    "order" => 4,
                    "title" => "用户列表",
                    "icon" => "fa-user-circle-o",
                    "uri" => "users",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 14:34:14",
                    "updated_at" => "2021-07-13 17:33:10"
                ],
                [
                    "id" => 26,
                    "parent_id" => 11,
                    "order" => 17,
                    "title" => "产品列表",
                    "icon" => "fa-desktop",
                    "uri" => "products",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 15:39:16",
                    "updated_at" => "2021-10-05 11:51:19"
                ],
                [
                    "id" => 27,
                    "parent_id" => 11,
                    "order" => 18,
                    "title" => "产品分类",
                    "icon" => "fa-dedent",
                    "uri" => "categories",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 15:40:31",
                    "updated_at" => "2021-10-05 11:51:19"
                ],
                [
                    "id" => 28,
                    "parent_id" => 24,
                    "order" => 13,
                    "title" => "代理列表",
                    "icon" => "fa-user-md",
                    "uri" => "agents",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-18 14:27:24",
                    "updated_at" => "2021-10-05 11:51:17"
                ],
                [
                    "id" => 29,
                    "parent_id" => 24,
                    "order" => 14,
                    "title" => "业绩统计",
                    "icon" => "fa-copyright",
                    "uri" => "agent_statistics",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-18 14:31:21",
                    "updated_at" => "2021-10-05 11:51:18"
                ],
                [
                    "id" => 30,
                    "parent_id" => 8,
                    "order" => 8,
                    "title" => "资金明细",
                    "icon" => "fa-sort-amount-desc",
                    "uri" => "asset_details",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-18 17:08:04",
                    "updated_at" => "2021-10-05 11:51:15"
                ],
                [
                    "id" => 31,
                    "parent_id" => 11,
                    "order" => 19,
                    "title" => "协议管理",
                    "icon" => "fa-paste",
                    "uri" => "agreements",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-21 10:33:43",
                    "updated_at" => "2021-10-05 11:51:20"
                ],
                [
                    "id" => 32,
                    "parent_id" => 12,
                    "order" => 23,
                    "title" => "分期管理",
                    "icon" => "fa-stack-overflow",
                    "uri" => "installment_items",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-06-25 16:55:48",
                    "updated_at" => "2021-10-05 11:51:22"
                ],
                [
                    "id" => 33,
                    "parent_id" => 12,
                    "order" => 22,
                    "title" => "订单列表",
                    "icon" => "fa-first-order",
                    "uri" => "orders",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-25 16:56:24",
                    "updated_at" => "2021-10-05 11:51:21"
                ],
                [
                    "id" => 34,
                    "parent_id" => 11,
                    "order" => 20,
                    "title" => "支付管理",
                    "icon" => "fa-paypal",
                    "uri" => "pay_methods",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-06-26 15:34:08",
                    "updated_at" => "2021-10-05 11:51:20"
                ],
                [
                    "id" => 35,
                    "parent_id" => 8,
                    "order" => 9,
                    "title" => "有效算力",
                    "icon" => "fa-file-powerpoint-o",
                    "uri" => "powers",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-06-27 15:00:46",
                    "updated_at" => "2021-10-05 11:51:16"
                ],
                [
                    "id" => 36,
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "借贷管理",
                    "icon" => "fa-database",
                    "uri" => NULL,
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-07-13 17:48:09",
                    "updated_at" => "2021-10-05 11:51:16"
                ],
                [
                    "id" => 37,
                    "parent_id" => 36,
                    "order" => 11,
                    "title" => "借款信息",
                    "icon" => NULL,
                    "uri" => "loans",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-07-14 11:58:08",
                    "updated_at" => "2021-10-05 11:51:17"
                ],
                [
                    "id" => 38,
                    "parent_id" => 18,
                    "order" => 33,
                    "title" => "BIKI行情配置",
                    "icon" => NULL,
                    "uri" => "market_biki",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-07-16 09:40:47",
                    "updated_at" => "2021-10-05 11:51:25"
                ],
                [
                    "id" => 39,
                    "parent_id" => 16,
                    "order" => 28,
                    "title" => "自动发币",
                    "icon" => NULL,
                    "uri" => "automatics",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-07-24 14:11:15",
                    "updated_at" => "2021-10-05 11:51:23"
                ],
                [
                    "id" => 40,
                    "parent_id" => 18,
                    "order" => 34,
                    "title" => "APP版本更新配置",
                    "icon" => "fa-angle-double-up",
                    "uri" => "versions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-08-02 15:40:57",
                    "updated_at" => "2021-10-05 11:51:26"
                ],
                [
                    "id" => 41,
                    "parent_id" => 8,
                    "order" => 5,
                    "title" => "实名认证",
                    "icon" => "fa-creative-commons",
                    "uri" => "real_names",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-10-05 11:51:02",
                    "updated_at" => "2021-10-05 11:51:14"
                ],
                [
                    "id" => 42,
                    "parent_id" => 9,
                    "order" => 41,
                    "title" => "资讯中心",
                    "icon" => NULL,
                    "uri" => "information",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-10-13 15:02:27",
                    "updated_at" => "2021-10-13 15:02:27"
                ],
                [
                    "id" => 43,
                    "parent_id" => 9,
                    "order" => 42,
                    "title" => "活动公告",
                    "icon" => NULL,
                    "uri" => "news",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-10-13 15:03:49",
                    "updated_at" => "2021-10-13 15:03:49"
                ]
            ]
        );

        Models\Permission::truncate();
        Models\Permission::insert(
            [
                [
                    "id" => 1,
                    "name" => "Auth management",
                    "slug" => "auth-management",
                    "http_method" => "",
                    "http_path" => "",
                    "order" => 1,
                    "parent_id" => 0,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => NULL
                ],
                [
                    "id" => 2,
                    "name" => "Users",
                    "slug" => "users",
                    "http_method" => "",
                    "http_path" => "/auth/users*",
                    "order" => 2,
                    "parent_id" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => NULL
                ],
                [
                    "id" => 3,
                    "name" => "Roles",
                    "slug" => "roles",
                    "http_method" => "",
                    "http_path" => "/auth/roles*",
                    "order" => 3,
                    "parent_id" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => NULL
                ],
                [
                    "id" => 4,
                    "name" => "Permissions",
                    "slug" => "permissions",
                    "http_method" => "",
                    "http_path" => "/auth/permissions*",
                    "order" => 4,
                    "parent_id" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => NULL
                ],
                [
                    "id" => 5,
                    "name" => "Menu",
                    "slug" => "menu",
                    "http_method" => "",
                    "http_path" => "/auth/menu*",
                    "order" => 5,
                    "parent_id" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => NULL
                ],
                [
                    "id" => 6,
                    "name" => "Extension",
                    "slug" => "extension",
                    "http_method" => "",
                    "http_path" => "/auth/extensions*",
                    "order" => 6,
                    "parent_id" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => NULL
                ],
                [
                    "id" => 7,
                    "name" => "users",
                    "slug" => "customer",
                    "http_method" => "",
                    "http_path" => "/users*",
                    "order" => 8,
                    "parent_id" => 0,
                    "created_at" => "2021-06-14 10:18:23",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "id" => 8,
                    "name" => "orders",
                    "slug" => "orders",
                    "http_method" => "",
                    "http_path" => "/orders",
                    "order" => 9,
                    "parent_id" => 0,
                    "created_at" => "2021-06-14 10:25:03",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "id" => 9,
                    "name" => "recharges",
                    "slug" => "recharges",
                    "http_method" => "",
                    "http_path" => "/recharges",
                    "order" => 10,
                    "parent_id" => 0,
                    "created_at" => "2021-06-14 10:31:45",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "id" => 10,
                    "name" => "withdrawals",
                    "slug" => "withdrawals",
                    "http_method" => "",
                    "http_path" => "/withdrawals",
                    "order" => 11,
                    "parent_id" => 0,
                    "created_at" => "2021-06-14 10:32:19",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "id" => 11,
                    "name" => "agents",
                    "slug" => "agents",
                    "http_method" => "",
                    "http_path" => "/agents*",
                    "order" => 12,
                    "parent_id" => 0,
                    "created_at" => "2021-06-14 17:01:07",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "id" => 12,
                    "name" => "asset_details",
                    "slug" => "asset_details",
                    "http_method" => "GET",
                    "http_path" => "/asset_details",
                    "order" => 13,
                    "parent_id" => 0,
                    "created_at" => "2021-06-18 17:20:58",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "id" => 13,
                    "name" => "agent_statistics",
                    "slug" => "agent_statistics",
                    "http_method" => "GET",
                    "http_path" => "/agent_statistics",
                    "order" => 14,
                    "parent_id" => 0,
                    "created_at" => "2021-06-18 17:23:29",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "id" => 14,
                    "name" => "products",
                    "slug" => "products",
                    "http_method" => "GET,POST",
                    "http_path" => "/products/create*,/products,/products/*/edit,/products/*",
                    "order" => 15,
                    "parent_id" => 0,
                    "created_at" => "2021-10-12 16:01:35",
                    "updated_at" => "2021-10-13 14:27:42"
                ],
                [
                    "id" => 15,
                    "name" => "realname",
                    "slug" => "realname",
                    "http_method" => "",
                    "http_path" => "/real_names*",
                    "order" => 7,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 12:20:36",
                    "updated_at" => "2021-10-13 14:27:41"
                ],
                [
                    "id" => 16,
                    "name" => "categories",
                    "slug" => "categories",
                    "http_method" => "",
                    "http_path" => "/categories*",
                    "order" => 16,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 14:46:36",
                    "updated_at" => "2021-10-13 14:46:36"
                ],
                [
                    "id" => 17,
                    "name" => "children",
                    "slug" => "children",
                    "http_method" => "",
                    "http_path" => "/children*",
                    "order" => 17,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 14:51:08",
                    "updated_at" => "2021-10-13 14:51:08"
                ],
                [
                    "id" => 18,
                    "name" => "news",
                    "slug" => "news",
                    "http_method" => "",
                    "http_path" => "/news*",
                    "order" => 18,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 15:06:24",
                    "updated_at" => "2021-10-13 15:06:24"
                ],
                [
                    "id" => 19,
                    "name" => "information",
                    "slug" => "information",
                    "http_method" => "",
                    "http_path" => "/information*",
                    "order" => 19,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 15:06:58",
                    "updated_at" => "2021-10-13 15:06:58"
                ],
                [
                    "id" => 20,
                    "name" => "commissions",
                    "slug" => "commissions",
                    "http_method" => "",
                    "http_path" => "/commissions*",
                    "order" => 20,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 15:14:10",
                    "updated_at" => "2021-10-13 15:14:10"
                ]
            ]
        );

        Models\Role::truncate();
        Models\Role::insert(
            [
                [
                    "id" => 1,
                    "name" => "超级管理员",
                    "slug" => "administrator",
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-10-12 15:38:26"
                ],
                [
                    "id" => 3,
                    "name" => "产品管理员",
                    "slug" => "products",
                    "created_at" => "2021-10-12 15:39:29",
                    "updated_at" => "2021-10-12 15:39:29"
                ],
                [
                    "id" => 5,
                    "name" => "馆长",
                    "slug" => "curator",
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "id" => 6,
                    "name" => "客服",
                    "slug" => "service",
                    "created_at" => "2021-10-13 15:09:31",
                    "updated_at" => "2021-10-13 15:09:31"
                ],
                [
                    "id" => 7,
                    "name" => "财务",
                    "slug" => "finance",
                    "created_at" => "2021-10-13 15:13:31",
                    "updated_at" => "2021-10-13 15:13:41"
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
                    "permission_id" => 7,
                    "menu_id" => 8,
                    "created_at" => "2021-06-14 10:18:51",
                    "updated_at" => "2021-06-14 10:18:51"
                ],
                [
                    "permission_id" => 7,
                    "menu_id" => 25,
                    "created_at" => "2021-06-15 14:34:14",
                    "updated_at" => "2021-06-15 14:34:14"
                ],
                [
                    "permission_id" => 8,
                    "menu_id" => 33,
                    "created_at" => "2021-06-25 16:56:24",
                    "updated_at" => "2021-06-25 16:56:24"
                ],
                [
                    "permission_id" => 11,
                    "menu_id" => 28,
                    "created_at" => "2021-06-18 14:27:24",
                    "updated_at" => "2021-06-18 14:27:24"
                ],
                [
                    "permission_id" => 14,
                    "menu_id" => 11,
                    "created_at" => "2021-10-12 16:01:35",
                    "updated_at" => "2021-10-12 16:01:35"
                ],
                [
                    "permission_id" => 14,
                    "menu_id" => 26,
                    "created_at" => "2021-10-12 16:01:35",
                    "updated_at" => "2021-10-12 16:01:35"
                ],
                [
                    "permission_id" => 15,
                    "menu_id" => 41,
                    "created_at" => "2021-10-13 12:20:36",
                    "updated_at" => "2021-10-13 12:20:36"
                ],
                [
                    "permission_id" => 16,
                    "menu_id" => 27,
                    "created_at" => "2021-10-13 14:48:12",
                    "updated_at" => "2021-10-13 14:48:12"
                ],
                [
                    "permission_id" => 18,
                    "menu_id" => 43,
                    "created_at" => "2021-10-13 15:06:24",
                    "updated_at" => "2021-10-13 15:06:24"
                ],
                [
                    "permission_id" => 19,
                    "menu_id" => 42,
                    "created_at" => "2021-10-13 15:06:58",
                    "updated_at" => "2021-10-13 15:06:58"
                ],
                [
                    "permission_id" => 20,
                    "menu_id" => 15,
                    "created_at" => "2021-10-13 15:14:10",
                    "updated_at" => "2021-10-13 15:14:10"
                ]
            ]
		);

        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "role_id" => 1,
                    "menu_id" => 2,
                    "created_at" => "2021-06-14 10:23:41",
                    "updated_at" => "2021-06-14 10:23:41"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 8,
                    "created_at" => "2021-03-05 03:34:55",
                    "updated_at" => "2021-03-05 03:34:55"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 9,
                    "created_at" => "2021-03-05 05:48:03",
                    "updated_at" => "2021-03-05 05:48:03"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 10,
                    "created_at" => "2021-03-05 07:15:29",
                    "updated_at" => "2021-03-05 07:15:29"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 11,
                    "created_at" => "2021-03-05 07:35:19",
                    "updated_at" => "2021-03-05 07:35:19"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 12,
                    "created_at" => "2021-03-09 06:52:54",
                    "updated_at" => "2021-03-09 06:52:54"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 14,
                    "created_at" => "2021-03-11 11:13:40",
                    "updated_at" => "2021-03-11 11:13:40"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 15,
                    "created_at" => "2021-06-14 10:22:19",
                    "updated_at" => "2021-06-14 10:22:19"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 16,
                    "created_at" => "2021-03-16 09:16:18",
                    "updated_at" => "2021-03-16 09:16:18"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 17,
                    "created_at" => "2021-03-18 08:38:29",
                    "updated_at" => "2021-03-18 08:38:29"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 18,
                    "created_at" => "2021-06-14 10:24:01",
                    "updated_at" => "2021-06-14 10:24:01"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 19,
                    "created_at" => "2021-03-28 13:11:54",
                    "updated_at" => "2021-03-28 13:11:54"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 20,
                    "created_at" => "2021-06-14 10:21:51",
                    "updated_at" => "2021-06-14 10:21:51"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 24,
                    "created_at" => "2021-06-14 12:19:01",
                    "updated_at" => "2021-06-14 12:19:01"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 25,
                    "created_at" => "2021-06-15 14:34:14",
                    "updated_at" => "2021-06-15 14:34:14"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 26,
                    "created_at" => "2021-06-15 15:39:26",
                    "updated_at" => "2021-06-15 15:39:26"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 27,
                    "created_at" => "2021-06-15 15:40:31",
                    "updated_at" => "2021-06-15 15:40:31"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 28,
                    "created_at" => "2021-06-18 14:27:24",
                    "updated_at" => "2021-06-18 14:27:24"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 29,
                    "created_at" => "2021-06-18 14:31:21",
                    "updated_at" => "2021-06-18 14:31:21"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 30,
                    "created_at" => "2021-06-18 17:08:04",
                    "updated_at" => "2021-06-18 17:08:04"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 31,
                    "created_at" => "2021-06-21 10:33:43",
                    "updated_at" => "2021-06-21 10:33:43"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 33,
                    "created_at" => "2021-06-25 16:56:24",
                    "updated_at" => "2021-06-25 16:56:24"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 34,
                    "created_at" => "2021-06-26 15:34:08",
                    "updated_at" => "2021-06-26 15:34:08"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 35,
                    "created_at" => "2021-06-27 15:00:46",
                    "updated_at" => "2021-06-27 15:00:46"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 36,
                    "created_at" => "2021-07-13 17:48:10",
                    "updated_at" => "2021-07-13 17:48:10"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 37,
                    "created_at" => "2021-07-14 11:58:08",
                    "updated_at" => "2021-07-14 11:58:08"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 38,
                    "created_at" => "2021-07-16 09:40:47",
                    "updated_at" => "2021-07-16 09:40:47"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 39,
                    "created_at" => "2021-07-24 14:11:15",
                    "updated_at" => "2021-07-24 14:11:15"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 40,
                    "created_at" => "2021-08-02 15:40:57",
                    "updated_at" => "2021-08-02 15:40:57"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 41,
                    "created_at" => "2021-10-05 11:51:02",
                    "updated_at" => "2021-10-05 11:51:02"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 8,
                    "created_at" => "2021-06-14 10:18:51",
                    "updated_at" => "2021-06-14 10:18:51"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 12,
                    "created_at" => "2021-06-14 10:23:10",
                    "updated_at" => "2021-06-14 10:23:10"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 17,
                    "created_at" => "2021-06-14 10:22:57",
                    "updated_at" => "2021-06-14 10:22:57"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 24,
                    "created_at" => "2021-06-14 17:00:42",
                    "updated_at" => "2021-06-14 17:00:42"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 25,
                    "created_at" => "2021-06-15 14:34:14",
                    "updated_at" => "2021-06-15 14:34:14"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 28,
                    "created_at" => "2021-06-18 14:27:24",
                    "updated_at" => "2021-06-18 14:27:24"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 29,
                    "created_at" => "2021-06-18 14:31:21",
                    "updated_at" => "2021-06-18 14:31:21"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 30,
                    "created_at" => "2021-06-18 17:08:04",
                    "updated_at" => "2021-06-18 17:08:04"
                ],
                [
                    "role_id" => 2,
                    "menu_id" => 33,
                    "created_at" => "2021-06-25 16:56:24",
                    "updated_at" => "2021-06-25 16:56:24"
                ],
                [
                    "role_id" => 3,
                    "menu_id" => 11,
                    "created_at" => "2021-10-12 15:39:29",
                    "updated_at" => "2021-10-12 15:39:29"
                ],
                [
                    "role_id" => 3,
                    "menu_id" => 26,
                    "created_at" => "2021-10-12 15:39:29",
                    "updated_at" => "2021-10-12 15:39:29"
                ],
                [
                    "role_id" => 4,
                    "menu_id" => 8,
                    "created_at" => "2021-10-13 09:30:35",
                    "updated_at" => "2021-10-13 09:30:35"
                ],
                [
                    "role_id" => 4,
                    "menu_id" => 25,
                    "created_at" => "2021-10-13 09:30:35",
                    "updated_at" => "2021-10-13 09:30:35"
                ],
                [
                    "role_id" => 4,
                    "menu_id" => 41,
                    "created_at" => "2021-10-13 09:30:35",
                    "updated_at" => "2021-10-13 09:30:35"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 8,
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 11,
                    "created_at" => "2021-10-13 14:25:01",
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 12,
                    "created_at" => "2021-10-13 14:25:01",
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 14,
                    "created_at" => "2021-10-13 14:25:01",
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 17,
                    "created_at" => "2021-10-13 14:25:01",
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 25,
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 26,
                    "created_at" => "2021-10-13 14:25:01",
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 30,
                    "created_at" => "2021-10-13 14:25:01",
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 33,
                    "created_at" => "2021-10-13 14:25:01",
                    "updated_at" => "2021-10-13 14:25:01"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 41,
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "role_id" => 6,
                    "menu_id" => 9,
                    "created_at" => "2021-10-13 15:09:32",
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "role_id" => 6,
                    "menu_id" => 25,
                    "created_at" => "2021-10-13 15:09:32",
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "role_id" => 6,
                    "menu_id" => 41,
                    "created_at" => "2021-10-13 15:09:32",
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "role_id" => 6,
                    "menu_id" => 42,
                    "created_at" => "2021-10-13 15:09:32",
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "role_id" => 6,
                    "menu_id" => 43,
                    "created_at" => "2021-10-13 15:09:32",
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "role_id" => 7,
                    "menu_id" => 15,
                    "created_at" => "2021-10-13 15:13:31",
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "role_id" => 7,
                    "menu_id" => 17,
                    "created_at" => "2021-10-13 15:13:31",
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "role_id" => 7,
                    "menu_id" => 25,
                    "created_at" => "2021-10-13 15:13:31",
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "role_id" => 7,
                    "menu_id" => 30,
                    "created_at" => "2021-10-13 15:13:31",
                    "updated_at" => "2021-10-13 15:13:31"
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "role_id" => 3,
                    "permission_id" => 14,
                    "created_at" => "2021-10-12 16:02:09",
                    "updated_at" => "2021-10-12 16:02:09"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 7,
                    "created_at" => "2021-10-13 14:28:06",
                    "updated_at" => "2021-10-13 14:28:06"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 8,
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 9,
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 10,
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 12,
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 14,
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 15,
                    "created_at" => "2021-10-13 14:25:00",
                    "updated_at" => "2021-10-13 14:25:00"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 17,
                    "created_at" => "2021-10-13 14:52:47",
                    "updated_at" => "2021-10-13 14:52:47"
                ],
                [
                    "role_id" => 6,
                    "permission_id" => 7,
                    "created_at" => "2021-10-13 15:09:32",
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "role_id" => 6,
                    "permission_id" => 15,
                    "created_at" => "2021-10-13 15:09:32",
                    "updated_at" => "2021-10-13 15:09:32"
                ],
                [
                    "role_id" => 6,
                    "permission_id" => 18,
                    "created_at" => "2021-10-13 15:11:14",
                    "updated_at" => "2021-10-13 15:11:14"
                ],
                [
                    "role_id" => 6,
                    "permission_id" => 19,
                    "created_at" => "2021-10-13 15:11:14",
                    "updated_at" => "2021-10-13 15:11:14"
                ],
                [
                    "role_id" => 7,
                    "permission_id" => 7,
                    "created_at" => "2021-10-13 15:13:31",
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "role_id" => 7,
                    "permission_id" => 8,
                    "created_at" => "2021-10-13 15:13:31",
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "role_id" => 7,
                    "permission_id" => 10,
                    "created_at" => "2021-10-13 15:13:31",
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "role_id" => 7,
                    "permission_id" => 12,
                    "created_at" => "2021-10-13 15:13:31",
                    "updated_at" => "2021-10-13 15:13:31"
                ],
                [
                    "role_id" => 7,
                    "permission_id" => 20,
                    "created_at" => "2021-10-13 15:14:47",
                    "updated_at" => "2021-10-13 15:14:47"
                ]
            ]
        );

        // finish
    }
}
