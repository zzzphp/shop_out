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
                    "order" => 41,
                    "title" => "Admin",
                    "icon" => "feather icon-settings",
                    "uri" => NULL,
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-11-02 12:16:58"
                ],
                [
                    "id" => 3,
                    "parent_id" => 2,
                    "order" => 42,
                    "title" => "Users",
                    "icon" => "",
                    "uri" => "auth/users",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-11-02 12:16:58"
                ],
                [
                    "id" => 4,
                    "parent_id" => 2,
                    "order" => 43,
                    "title" => "Roles",
                    "icon" => "",
                    "uri" => "auth/roles",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-11-02 12:16:58"
                ],
                [
                    "id" => 5,
                    "parent_id" => 2,
                    "order" => 44,
                    "title" => "Permission",
                    "icon" => "",
                    "uri" => "auth/permissions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-11-02 12:16:58"
                ],
                [
                    "id" => 6,
                    "parent_id" => 2,
                    "order" => 45,
                    "title" => "Menu",
                    "icon" => "",
                    "uri" => "auth/menu",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-11-02 12:16:58"
                ],
                [
                    "id" => 7,
                    "parent_id" => 2,
                    "order" => 46,
                    "title" => "Extensions",
                    "icon" => "",
                    "uri" => "auth/extensions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:11:11",
                    "updated_at" => "2021-11-02 12:16:59"
                ],
                [
                    "id" => 8,
                    "parent_id" => 0,
                    "order" => 5,
                    "title" => "账号管理",
                    "icon" => "fa-users",
                    "uri" => "users",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 03:34:55",
                    "updated_at" => "2021-11-02 12:16:51"
                ],
                [
                    "id" => 9,
                    "parent_id" => 0,
                    "order" => 33,
                    "title" => "新闻中心",
                    "icon" => "fa-hacker-news",
                    "uri" => "news",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 05:48:03",
                    "updated_at" => "2021-11-02 12:16:56"
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
                    "order" => 19,
                    "title" => "产品管理",
                    "icon" => "fa-product-hunt",
                    "uri" => "products",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-05 07:35:19",
                    "updated_at" => "2021-11-02 12:16:54"
                ],
                [
                    "id" => 12,
                    "parent_id" => 0,
                    "order" => 25,
                    "title" => "订单管理",
                    "icon" => "fa-first-order",
                    "uri" => "orders",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-09 06:52:54",
                    "updated_at" => "2021-11-02 12:16:55"
                ],
                [
                    "id" => 14,
                    "parent_id" => 8,
                    "order" => 9,
                    "title" => "充值管理",
                    "icon" => "fa-sign-in",
                    "uri" => "recharges",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-11 11:13:40",
                    "updated_at" => "2021-11-02 12:16:52"
                ],
                [
                    "id" => 15,
                    "parent_id" => 0,
                    "order" => 36,
                    "title" => "邀请奖励",
                    "icon" => "fa-usd",
                    "uri" => "commissions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-16 06:20:22",
                    "updated_at" => "2021-11-02 12:16:57"
                ],
                [
                    "id" => 16,
                    "parent_id" => 0,
                    "order" => 28,
                    "title" => "发币管理",
                    "icon" => "fa-foursquare",
                    "uri" => "distributes",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-03-16 09:16:18",
                    "updated_at" => "2021-11-02 12:16:55"
                ],
                [
                    "id" => 17,
                    "parent_id" => 8,
                    "order" => 10,
                    "title" => "提现管理",
                    "icon" => "fa-text-width",
                    "uri" => "withdrawals",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-18 08:38:29",
                    "updated_at" => "2021-11-02 12:16:52"
                ],
                [
                    "id" => 18,
                    "parent_id" => 0,
                    "order" => 37,
                    "title" => "客户端配置",
                    "icon" => "fa-gears",
                    "uri" => NULL,
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-28 13:11:13",
                    "updated_at" => "2021-11-02 12:16:57"
                ],
                [
                    "id" => 19,
                    "parent_id" => 18,
                    "order" => 38,
                    "title" => "首页轮播图",
                    "icon" => NULL,
                    "uri" => "carousels",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-03-28 13:11:54",
                    "updated_at" => "2021-11-02 12:16:57"
                ],
                [
                    "id" => 20,
                    "parent_id" => 11,
                    "order" => 20,
                    "title" => "期数管理",
                    "icon" => "fa-sort-numeric-asc",
                    "uri" => "stages",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-03-31 09:01:13",
                    "updated_at" => "2021-11-02 12:16:54"
                ],
                [
                    "id" => 21,
                    "parent_id" => 16,
                    "order" => 29,
                    "title" => "整机发币",
                    "icon" => NULL,
                    "uri" => "distributes",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-04-01 06:21:13",
                    "updated_at" => "2021-11-02 12:16:55"
                ],
                [
                    "id" => 22,
                    "parent_id" => 16,
                    "order" => 30,
                    "title" => "算力发币",
                    "icon" => NULL,
                    "uri" => "power_distributes",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-04-01 07:35:00",
                    "updated_at" => "2021-11-02 12:16:56"
                ],
                [
                    "id" => 23,
                    "parent_id" => 16,
                    "order" => 31,
                    "title" => "发币记录",
                    "icon" => NULL,
                    "uri" => "logs",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-05-12 12:02:56",
                    "updated_at" => "2021-11-02 12:16:56"
                ],
                [
                    "id" => 24,
                    "parent_id" => 0,
                    "order" => 16,
                    "title" => "代理管理",
                    "icon" => "fa-american-sign-language-interpreting",
                    "uri" => "agents",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-06-14 12:19:01",
                    "updated_at" => "2021-11-02 12:16:53"
                ],
                [
                    "id" => 25,
                    "parent_id" => 8,
                    "order" => 6,
                    "title" => "用户列表",
                    "icon" => "fa-user-circle-o",
                    "uri" => "users",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 14:34:14",
                    "updated_at" => "2021-11-02 12:16:51"
                ],
                [
                    "id" => 26,
                    "parent_id" => 11,
                    "order" => 21,
                    "title" => "产品列表",
                    "icon" => "fa-desktop",
                    "uri" => "products",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 15:39:16",
                    "updated_at" => "2021-11-02 12:16:54"
                ],
                [
                    "id" => 27,
                    "parent_id" => 11,
                    "order" => 22,
                    "title" => "产品分类",
                    "icon" => "fa-dedent",
                    "uri" => "categories",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 15:40:31",
                    "updated_at" => "2021-11-02 12:16:54"
                ],
                [
                    "id" => 28,
                    "parent_id" => 24,
                    "order" => 17,
                    "title" => "代理列表",
                    "icon" => "fa-user-md",
                    "uri" => "agents",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-18 14:27:24",
                    "updated_at" => "2021-11-02 12:16:53"
                ],
                [
                    "id" => 29,
                    "parent_id" => 24,
                    "order" => 18,
                    "title" => "业绩统计",
                    "icon" => "fa-copyright",
                    "uri" => "agent_statistics",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-18 14:31:21",
                    "updated_at" => "2021-11-02 12:16:53"
                ],
                [
                    "id" => 30,
                    "parent_id" => 8,
                    "order" => 11,
                    "title" => "资金明细",
                    "icon" => "fa-sort-amount-desc",
                    "uri" => "asset_details",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-18 17:08:04",
                    "updated_at" => "2021-11-02 12:16:52"
                ],
                [
                    "id" => 31,
                    "parent_id" => 11,
                    "order" => 23,
                    "title" => "协议管理",
                    "icon" => "fa-paste",
                    "uri" => "agreements",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-21 10:33:43",
                    "updated_at" => "2021-11-02 12:16:54"
                ],
                [
                    "id" => 32,
                    "parent_id" => 12,
                    "order" => 27,
                    "title" => "分期管理",
                    "icon" => "fa-stack-overflow",
                    "uri" => "installment_items",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-06-25 16:55:48",
                    "updated_at" => "2021-11-02 12:16:55"
                ],
                [
                    "id" => 33,
                    "parent_id" => 12,
                    "order" => 26,
                    "title" => "订单列表",
                    "icon" => "fa-first-order",
                    "uri" => "orders",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-25 16:56:24",
                    "updated_at" => "2021-11-02 12:16:55"
                ],
                [
                    "id" => 34,
                    "parent_id" => 11,
                    "order" => 24,
                    "title" => "支付管理",
                    "icon" => "fa-paypal",
                    "uri" => "pay_methods",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-06-26 15:34:08",
                    "updated_at" => "2021-11-02 12:16:55"
                ],
                [
                    "id" => 35,
                    "parent_id" => 8,
                    "order" => 12,
                    "title" => "有效算力",
                    "icon" => "fa-file-powerpoint-o",
                    "uri" => "powers",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-06-27 15:00:46",
                    "updated_at" => "2021-11-02 12:16:52"
                ],
                [
                    "id" => 36,
                    "parent_id" => 0,
                    "order" => 14,
                    "title" => "借贷管理",
                    "icon" => "fa-database",
                    "uri" => NULL,
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-07-13 17:48:09",
                    "updated_at" => "2021-11-02 12:16:53"
                ],
                [
                    "id" => 37,
                    "parent_id" => 36,
                    "order" => 15,
                    "title" => "借款信息",
                    "icon" => NULL,
                    "uri" => "loans",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-07-14 11:58:08",
                    "updated_at" => "2021-11-02 12:16:53"
                ],
                [
                    "id" => 38,
                    "parent_id" => 18,
                    "order" => 39,
                    "title" => "BIKI行情配置",
                    "icon" => NULL,
                    "uri" => "market_biki",
                    "extension" => "",
                    "show" => 0,
                    "created_at" => "2021-07-16 09:40:47",
                    "updated_at" => "2021-11-02 12:16:57"
                ],
                [
                    "id" => 39,
                    "parent_id" => 16,
                    "order" => 32,
                    "title" => "自动发币",
                    "icon" => NULL,
                    "uri" => "automatics",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-07-24 14:11:15",
                    "updated_at" => "2021-11-02 12:16:56"
                ],
                [
                    "id" => 40,
                    "parent_id" => 18,
                    "order" => 40,
                    "title" => "APP版本更新配置",
                    "icon" => "fa-angle-double-up",
                    "uri" => "versions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-08-02 15:40:57",
                    "updated_at" => "2021-11-02 12:16:58"
                ],
                [
                    "id" => 41,
                    "parent_id" => 8,
                    "order" => 8,
                    "title" => "实名认证",
                    "icon" => "fa-creative-commons",
                    "uri" => "real_names",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-10-05 11:51:02",
                    "updated_at" => "2021-11-02 12:16:52"
                ],
                [
                    "id" => 42,
                    "parent_id" => 9,
                    "order" => 34,
                    "title" => "资讯中心",
                    "icon" => NULL,
                    "uri" => "information",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-10-13 15:02:27",
                    "updated_at" => "2021-11-02 12:16:56"
                ],
                [
                    "id" => 43,
                    "parent_id" => 9,
                    "order" => 35,
                    "title" => "活动公告",
                    "icon" => NULL,
                    "uri" => "news",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-10-13 15:03:49",
                    "updated_at" => "2021-11-02 12:16:57"
                ],
                [
                    "id" => 45,
                    "parent_id" => 0,
                    "order" => 3,
                    "title" => "店铺管理",
                    "icon" => "fa-share-alt",
                    "uri" => "shops",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-10-18 16:57:07",
                    "updated_at" => "2021-10-18 16:57:37"
                ],
                [
                    "id" => 46,
                    "parent_id" => 8,
                    "order" => 13,
                    "title" => "管理员",
                    "icon" => NULL,
                    "uri" => "admin_user",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-10-26 13:24:01",
                    "updated_at" => "2021-11-02 12:16:53"
                ],
                [
                    "id" => 47,
                    "parent_id" => 8,
                    "order" => 7,
                    "title" => "店员业绩",
                    "icon" => "fa-steam",
                    "uri" => "user_team",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-10-26 15:03:00",
                    "updated_at" => "2021-11-02 12:16:51"
                ],
                [
                    "id" => 48,
                    "parent_id" => 0,
                    "order" => 4,
                    "title" => "服务商管理",
                    "icon" => "fa-server",
                    "uri" => "services",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-11-02 12:16:33",
                    "updated_at" => "2021-11-02 12:16:51"
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
                    "http_path" => "/recharges*",
                    "order" => 11,
                    "parent_id" => 0,
                    "created_at" => "2021-06-14 10:31:45",
                    "updated_at" => "2021-11-01 15:23:27"
                ],
                [
                    "id" => 10,
                    "name" => "withdrawals",
                    "slug" => "withdrawals",
                    "http_method" => "",
                    "http_path" => "/withdrawals",
                    "order" => 13,
                    "parent_id" => 0,
                    "created_at" => "2021-06-14 10:32:19",
                    "updated_at" => "2021-11-01 15:28:10"
                ],
                [
                    "id" => 11,
                    "name" => "agents",
                    "slug" => "agents",
                    "http_method" => "",
                    "http_path" => "/agents*",
                    "order" => 14,
                    "parent_id" => 0,
                    "created_at" => "2021-06-14 17:01:07",
                    "updated_at" => "2021-11-01 15:28:10"
                ],
                [
                    "id" => 12,
                    "name" => "asset_details",
                    "slug" => "asset_details",
                    "http_method" => "GET",
                    "http_path" => "/asset_details",
                    "order" => 15,
                    "parent_id" => 0,
                    "created_at" => "2021-06-18 17:20:58",
                    "updated_at" => "2021-11-01 15:28:10"
                ],
                [
                    "id" => 13,
                    "name" => "agent_statistics",
                    "slug" => "agent_statistics",
                    "http_method" => "GET",
                    "http_path" => "/agent_statistics",
                    "order" => 16,
                    "parent_id" => 0,
                    "created_at" => "2021-06-18 17:23:29",
                    "updated_at" => "2021-11-01 15:28:10"
                ],
                [
                    "id" => 14,
                    "name" => "products",
                    "slug" => "products",
                    "http_method" => "GET,POST,PUT",
                    "http_path" => "/products/create*,/products,/products/*/edit,/products/*",
                    "order" => 17,
                    "parent_id" => 0,
                    "created_at" => "2021-10-12 16:01:35",
                    "updated_at" => "2021-11-01 15:28:11"
                ],
                [
                    "id" => 15,
                    "name" => "realname",
                    "slug" => "realname",
                    "http_method" => "GET",
                    "http_path" => "/real_names",
                    "order" => 7,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 12:20:36",
                    "updated_at" => "2021-11-06 15:08:16"
                ],
                [
                    "id" => 16,
                    "name" => "categories",
                    "slug" => "categories",
                    "http_method" => "",
                    "http_path" => "/categories*",
                    "order" => 19,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 14:46:36",
                    "updated_at" => "2021-11-01 15:28:11"
                ],
                [
                    "id" => 17,
                    "name" => "children",
                    "slug" => "children",
                    "http_method" => "",
                    "http_path" => "/children*",
                    "order" => 20,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 14:51:08",
                    "updated_at" => "2021-11-01 15:28:11"
                ],
                [
                    "id" => 18,
                    "name" => "news",
                    "slug" => "news",
                    "http_method" => "",
                    "http_path" => "/news*",
                    "order" => 21,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 15:06:24",
                    "updated_at" => "2021-11-01 15:28:11"
                ],
                [
                    "id" => 19,
                    "name" => "information",
                    "slug" => "information",
                    "http_method" => "",
                    "http_path" => "/information*",
                    "order" => 22,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 15:06:58",
                    "updated_at" => "2021-11-01 15:28:11"
                ],
                [
                    "id" => 20,
                    "name" => "commissions",
                    "slug" => "commissions",
                    "http_method" => "",
                    "http_path" => "/commissions*",
                    "order" => 23,
                    "parent_id" => 0,
                    "created_at" => "2021-10-13 15:14:10",
                    "updated_at" => "2021-11-01 15:28:12"
                ],
                [
                    "id" => 21,
                    "name" => "shops",
                    "slug" => "shops",
                    "http_method" => "GET,POST,PUT",
                    "http_path" => "/shops,/shops/*/edit,/shops/create*,/shops/create,/shops/*",
                    "order" => 24,
                    "parent_id" => 0,
                    "created_at" => "2021-10-18 17:54:10",
                    "updated_at" => "2021-11-02 17:37:31"
                ],
                [
                    "id" => 22,
                    "name" => "shops_view",
                    "slug" => "shops_view",
                    "http_method" => "GET",
                    "http_path" => "/shops",
                    "order" => 25,
                    "parent_id" => 0,
                    "created_at" => "2021-10-26 16:15:10",
                    "updated_at" => "2021-11-02 17:28:14"
                ],
                [
                    "id" => 23,
                    "name" => "orders_view",
                    "slug" => "orders_view",
                    "http_method" => "GET",
                    "http_path" => "/orders",
                    "order" => 10,
                    "parent_id" => 0,
                    "created_at" => "2021-11-01 15:23:04",
                    "updated_at" => "2021-11-01 15:23:27"
                ],
                [
                    "id" => 24,
                    "name" => "products_view",
                    "slug" => "products_view",
                    "http_method" => "GET",
                    "http_path" => "/products",
                    "order" => 18,
                    "parent_id" => 0,
                    "created_at" => "2021-11-01 15:24:09",
                    "updated_at" => "2021-11-01 15:28:11"
                ],
                [
                    "id" => 25,
                    "name" => "recharges_view",
                    "slug" => "recharges_view",
                    "http_method" => "GET",
                    "http_path" => "/recharges",
                    "order" => 12,
                    "parent_id" => 0,
                    "created_at" => "2021-11-01 15:28:00",
                    "updated_at" => "2021-11-01 15:28:10"
                ],
                [
                    "id" => 26,
                    "name" => "withdrawals_view",
                    "slug" => "withdrawals_view",
                    "http_method" => "GET",
                    "http_path" => "/withdrawals",
                    "order" => 26,
                    "parent_id" => 0,
                    "created_at" => "2021-11-01 15:28:51",
                    "updated_at" => "2021-11-01 15:28:51"
                ],
                [
                    "id" => 27,
                    "name" => "user_team_view",
                    "slug" => "user_team_view",
                    "http_method" => "GET",
                    "http_path" => "/user_team",
                    "order" => 27,
                    "parent_id" => 0,
                    "created_at" => "2021-11-03 12:38:54",
                    "updated_at" => "2021-11-03 12:38:54"
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
                ],
                [
                    "id" => 8,
                    "name" => "董事长",
                    "slug" => "chairman",
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:57"
                ],
                [
                    "id" => 9,
                    "name" => "CEO",
                    "slug" => "ceo",
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "id" => 10,
                    "name" => "综合服务商",
                    "slug" => "service_provider",
                    "created_at" => "2021-11-01 15:30:49",
                    "updated_at" => "2021-11-01 15:32:36"
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
                ],
                [
                    "permission_id" => 21,
                    "menu_id" => 45,
                    "created_at" => "2021-10-18 17:54:10",
                    "updated_at" => "2021-10-18 17:54:10"
                ],
                [
                    "permission_id" => 22,
                    "menu_id" => 45,
                    "created_at" => "2021-10-26 16:15:10",
                    "updated_at" => "2021-10-26 16:15:10"
                ],
                [
                    "permission_id" => 23,
                    "menu_id" => 12,
                    "created_at" => "2021-11-01 15:23:04",
                    "updated_at" => "2021-11-01 15:23:04"
                ],
                [
                    "permission_id" => 23,
                    "menu_id" => 33,
                    "created_at" => "2021-11-01 15:23:04",
                    "updated_at" => "2021-11-01 15:23:04"
                ],
                [
                    "permission_id" => 24,
                    "menu_id" => 11,
                    "created_at" => "2021-11-01 15:24:09",
                    "updated_at" => "2021-11-01 15:24:09"
                ],
                [
                    "permission_id" => 24,
                    "menu_id" => 26,
                    "created_at" => "2021-11-01 15:24:10",
                    "updated_at" => "2021-11-01 15:24:10"
                ],
                [
                    "permission_id" => 25,
                    "menu_id" => 8,
                    "created_at" => "2021-11-01 15:28:00",
                    "updated_at" => "2021-11-01 15:28:00"
                ],
                [
                    "permission_id" => 25,
                    "menu_id" => 14,
                    "created_at" => "2021-11-01 15:28:01",
                    "updated_at" => "2021-11-01 15:28:01"
                ],
                [
                    "permission_id" => 26,
                    "menu_id" => 8,
                    "created_at" => "2021-11-01 15:28:51",
                    "updated_at" => "2021-11-01 15:28:51"
                ],
                [
                    "permission_id" => 26,
                    "menu_id" => 17,
                    "created_at" => "2021-11-01 15:28:52",
                    "updated_at" => "2021-11-01 15:28:52"
                ],
                [
                    "permission_id" => 27,
                    "menu_id" => 47,
                    "created_at" => "2021-11-03 12:38:54",
                    "updated_at" => "2021-11-03 12:38:54"
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
                    "role_id" => 1,
                    "menu_id" => 46,
                    "created_at" => "2021-10-26 13:24:01",
                    "updated_at" => "2021-10-26 13:24:01"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 47,
                    "created_at" => "2021-10-26 15:03:00",
                    "updated_at" => "2021-10-26 15:03:00"
                ],
                [
                    "role_id" => 1,
                    "menu_id" => 48,
                    "created_at" => "2021-11-02 12:16:33",
                    "updated_at" => "2021-11-02 12:16:33"
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
                    "menu_id" => 15,
                    "created_at" => "2021-11-03 12:40:34",
                    "updated_at" => "2021-11-03 12:40:34"
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
                    "menu_id" => 27,
                    "created_at" => "2021-10-18 16:34:06",
                    "updated_at" => "2021-10-18 16:34:06"
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
                    "created_at" => "2021-11-06 14:43:53",
                    "updated_at" => "2021-11-06 14:43:53"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 45,
                    "created_at" => "2021-10-18 17:54:31",
                    "updated_at" => "2021-10-18 17:54:31"
                ],
                [
                    "role_id" => 5,
                    "menu_id" => 47,
                    "created_at" => "2021-11-03 12:40:34",
                    "updated_at" => "2021-11-03 12:40:34"
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
                ],
                [
                    "role_id" => 7,
                    "menu_id" => 45,
                    "created_at" => "2021-10-26 16:16:06",
                    "updated_at" => "2021-10-26 16:16:06"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 1,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 3,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 4,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 5,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 6,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 7,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 8,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 9,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 10,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 11,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 12,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 14,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 15,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 16,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 17,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 18,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 19,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 20,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 21,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 22,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 23,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 24,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 25,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 26,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 27,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 28,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 29,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 30,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 31,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 32,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 33,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 34,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 35,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 36,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 37,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 38,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 39,
                    "created_at" => "2021-10-13 16:11:36",
                    "updated_at" => "2021-10-13 16:11:36"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 40,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 41,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 42,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 43,
                    "created_at" => "2021-10-13 16:11:37",
                    "updated_at" => "2021-10-13 16:11:37"
                ],
                [
                    "role_id" => 8,
                    "menu_id" => 45,
                    "created_at" => "2021-10-26 16:16:29",
                    "updated_at" => "2021-10-26 16:16:29"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 1,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 8,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 9,
                    "created_at" => "2021-10-13 16:12:22",
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 10,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 11,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 12,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 14,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 15,
                    "created_at" => "2021-10-13 16:12:22",
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 16,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 17,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 18,
                    "created_at" => "2021-10-13 16:12:22",
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 19,
                    "created_at" => "2021-10-13 16:12:22",
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 20,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 21,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 22,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 23,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 24,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 25,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 26,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 27,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 28,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 29,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 30,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 31,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 32,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 33,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 34,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 35,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 36,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 37,
                    "created_at" => "2021-10-13 16:12:21",
                    "updated_at" => "2021-10-13 16:12:21"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 38,
                    "created_at" => "2021-10-13 16:12:22",
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 39,
                    "created_at" => "2021-10-13 16:12:22",
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 40,
                    "created_at" => "2021-10-13 16:12:22",
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 41,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 42,
                    "created_at" => "2021-10-13 16:12:22",
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 43,
                    "created_at" => "2021-10-13 16:12:22",
                    "updated_at" => "2021-10-13 16:12:22"
                ],
                [
                    "role_id" => 9,
                    "menu_id" => 45,
                    "created_at" => "2021-10-26 16:16:20",
                    "updated_at" => "2021-10-26 16:16:20"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 8,
                    "created_at" => "2021-11-01 15:30:50",
                    "updated_at" => "2021-11-01 15:30:50"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 11,
                    "created_at" => "2021-11-01 15:30:51",
                    "updated_at" => "2021-11-01 15:30:51"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 12,
                    "created_at" => "2021-11-01 15:30:51",
                    "updated_at" => "2021-11-01 15:30:51"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 14,
                    "created_at" => "2021-11-01 15:30:50",
                    "updated_at" => "2021-11-01 15:30:50"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 15,
                    "created_at" => "2021-11-03 12:40:02",
                    "updated_at" => "2021-11-03 12:40:02"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 17,
                    "created_at" => "2021-11-01 15:30:50",
                    "updated_at" => "2021-11-01 15:30:50"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 25,
                    "created_at" => "2021-11-01 15:30:50",
                    "updated_at" => "2021-11-01 15:30:50"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 26,
                    "created_at" => "2021-11-01 15:30:51",
                    "updated_at" => "2021-11-01 15:30:51"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 30,
                    "created_at" => "2021-11-01 15:30:50",
                    "updated_at" => "2021-11-01 15:30:50"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 33,
                    "created_at" => "2021-11-01 15:30:51",
                    "updated_at" => "2021-11-01 15:30:51"
                ],
                [
                    "role_id" => 10,
                    "menu_id" => 47,
                    "created_at" => "2021-11-03 12:40:02",
                    "updated_at" => "2021-11-03 12:40:02"
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
                    "created_at" => "2021-11-06 14:43:29",
                    "updated_at" => "2021-11-06 14:43:29"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 16,
                    "created_at" => "2021-10-18 16:34:06",
                    "updated_at" => "2021-10-18 16:34:06"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 17,
                    "created_at" => "2021-10-13 14:52:47",
                    "updated_at" => "2021-10-13 14:52:47"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 20,
                    "created_at" => "2021-11-03 12:40:33",
                    "updated_at" => "2021-11-03 12:40:33"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 21,
                    "created_at" => "2021-10-18 17:54:30",
                    "updated_at" => "2021-10-18 17:54:30"
                ],
                [
                    "role_id" => 5,
                    "permission_id" => 27,
                    "created_at" => "2021-11-03 12:40:34",
                    "updated_at" => "2021-11-03 12:40:34"
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
                ],
                [
                    "role_id" => 7,
                    "permission_id" => 22,
                    "created_at" => "2021-10-26 16:16:06",
                    "updated_at" => "2021-10-26 16:16:06"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 7,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 8,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 9,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 10,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 11,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 12,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 13,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 14,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 15,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 16,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 17,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 18,
                    "created_at" => "2021-10-13 16:11:34",
                    "updated_at" => "2021-10-13 16:11:34"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 19,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 20,
                    "created_at" => "2021-10-13 16:11:35",
                    "updated_at" => "2021-10-13 16:11:35"
                ],
                [
                    "role_id" => 8,
                    "permission_id" => 22,
                    "created_at" => "2021-10-26 16:15:34",
                    "updated_at" => "2021-10-26 16:15:34"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 7,
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 8,
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 9,
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 10,
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 11,
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 12,
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 13,
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 14,
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 15,
                    "created_at" => "2021-10-13 16:12:19",
                    "updated_at" => "2021-10-13 16:12:19"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 16,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 17,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 18,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 19,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 20,
                    "created_at" => "2021-10-13 16:12:20",
                    "updated_at" => "2021-10-13 16:12:20"
                ],
                [
                    "role_id" => 9,
                    "permission_id" => 22,
                    "created_at" => "2021-10-26 16:15:39",
                    "updated_at" => "2021-10-26 16:15:39"
                ],
                [
                    "role_id" => 10,
                    "permission_id" => 7,
                    "created_at" => "2021-11-01 15:30:49",
                    "updated_at" => "2021-11-01 15:30:49"
                ],
                [
                    "role_id" => 10,
                    "permission_id" => 12,
                    "created_at" => "2021-11-01 15:30:49",
                    "updated_at" => "2021-11-01 15:30:49"
                ],
                [
                    "role_id" => 10,
                    "permission_id" => 20,
                    "created_at" => "2021-11-03 12:40:01",
                    "updated_at" => "2021-11-03 12:40:01"
                ],
                [
                    "role_id" => 10,
                    "permission_id" => 21,
                    "created_at" => "2021-11-01 15:30:49",
                    "updated_at" => "2021-11-01 15:30:49"
                ],
                [
                    "role_id" => 10,
                    "permission_id" => 23,
                    "created_at" => "2021-11-01 15:54:06",
                    "updated_at" => "2021-11-01 15:54:06"
                ],
                [
                    "role_id" => 10,
                    "permission_id" => 24,
                    "created_at" => "2021-11-01 15:30:50",
                    "updated_at" => "2021-11-01 15:30:50"
                ],
                [
                    "role_id" => 10,
                    "permission_id" => 25,
                    "created_at" => "2021-11-01 15:30:50",
                    "updated_at" => "2021-11-01 15:30:50"
                ],
                [
                    "role_id" => 10,
                    "permission_id" => 26,
                    "created_at" => "2021-11-01 15:30:50",
                    "updated_at" => "2021-11-01 15:30:50"
                ],
                [
                    "role_id" => 10,
                    "permission_id" => 27,
                    "created_at" => "2021-11-03 12:40:02",
                    "updated_at" => "2021-11-03 12:40:02"
                ]
            ]
        );

        // finish
    }
}
