<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Lilue
 * @Date: 2019-08-06 17:12:55
 * @LastEditors: Lilue
 * @LastEditTime: 2019-08-26 17:01:52
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat;

class WeChatController extends Controller
{
    /**
     * @description: 
     * @param {type} 
     * @return: 
     * @author: Lilue
     */
    public function serve()
    {
        $app = EasyWeChat::officialAccount();
        $app->server->push(function ($message) {
            return "欢迎关注" . config('app.name') . "！";
        });

        return $app->server->serve();
    }
}
