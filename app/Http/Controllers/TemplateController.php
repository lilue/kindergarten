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
        dump($res);

    }
}
