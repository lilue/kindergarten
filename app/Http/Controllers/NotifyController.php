<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat;
use DB;
use Log;

class NotifyController extends Controller
{
    public function notify()
    {
        Log::info('进入回调通知');
        $payment = $payment = EasyWeChat::payment();
        $response = $payment->handlePaidNotify(function($message, $fail){
            if ($message['return_code'] === 'SUCCESS')
            {
                $app = EasyWeChat::payment();
                $result = $app->order->queryByOutTradeNumber($message['out_trade_no']);
                if ($result['result_code'] == "SUCCESS" && $result['trade_state'] == "SUCCESS")
                {
                    Log::info('支付成功');
                    Log::info($message);
                    //支付成功
                    // $pay_type = '微信支付';
                    // $carno = $message['attach'];
                    // $time = $message['time_end'];
                    // $openid = $message['sub_openid'];
                    // $trade_no = $message['out_trade_no'];
                    // $total_fee = $message['total_fee'] / 100 ;
                    // $res = DB::select("CALL pro_saveCharge('$carno', '$time', '$total_fee', '$pay_type', '$openid', '$trade_no', @result)");
                    // Log::info('执行完存储过程');
                    // Log::info($total_fee);
                    // return true;
                }
            } else {
                Log::info('通信失败');
                return $fail('通信失败，请稍后再通知我');
            }

        });
        $response->send();
    }
}
