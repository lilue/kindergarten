<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat;

class MenuController extends Controller
{
    // $app = EasyWeChat::officialAccount();
    public function list()
    {
        $app = EasyWeChat::officialAccount();
        $list = $app->menu->list();
        var_dump($list);
    }

    public function present()
    {
        $app = EasyWeChat::officialAccount();
        $current = $app->menu->current();
        var_dump($current);
    }

    public function create()
    {
        $app = EasyWeChat::officialAccount();
    }
}