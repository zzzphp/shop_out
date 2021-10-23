<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Home;
use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Dropdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('主页')
            ->description('当前时间：'.date('Y-m-d H:i:s', time()))
            ->body(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(12, new Home\TotalOrder());
                    });
                });
                $row->column(12, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(4, new Home\NewUsers());
                        $row->column(4, new Home\NewRecharge());
                        $row->column(4, new Home\NewWithdrawals());
                    });
                });
//                $row->column(12, function (Column $column) {
//                    $column->row(function (Row $row) {
//                        $row->column(4, new Home\TotalPledge());
//                        $row->column(4, new Home\TotalDistribute());
//                        $row->column(4, new Home\TotalPower());
//                    });
//                });
            });
    }

}
