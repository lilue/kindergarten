<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use EasyWeChat;

class TemplateController extends Controller
{
    // gnqSCMYGufoQI6RdPBWWqIqYY-T_ebQS-ohfft8jUmE
    public function template()
    {
        $app = EasyWeChat::officialAccount();
        $res = DB::table('table_xsxx')->where('xsbh', '2019080001')->first();
        $first = "尊敬的" . $res->xsxm . "家长，您已成功缴费";
        dump($res->openid);
        $app->template_message->send([
            'touser'        =>  $res->openid,
            'template_id'   =>  'gnqSCMYGufoQI6RdPBWWqIqYY-T_ebQS-ohfft8jUmE',
            'url'           =>  'http://www.baidu.com',
            'data'          =>  [
                'first'         =>  $first,
                'keyword1'      =>  $res->xsxm,
                'keyword2'      =>  $res->bj,
                'keyword3'      =>  $res->bj,
                'keyword4'      =>  $res->bj,
                'keyword5'      =>  $res->bj,
                'remark'      =>  '感谢您的支持！',
            ],
        ]);

    }
}
