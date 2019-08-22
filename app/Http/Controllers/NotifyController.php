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
                    // Log::info('支付成功');
                    // Log::info($message);
                    //支付成功
                    $pay_type = '微信支付';
                    $xsbh = $message['attach'];
                    $time = $message['time_end'];
                    $trade_no = $message['out_trade_no'];
                    $sfdh = substr($trade_no, 0, -5);
                    $total_fee = $message['total_fee'] / 100 ;
                    $fs = "微信";
                    $id = DB::table('table_sfjl')->insertGetId(['sfdh' => $sfdh, 'trade_no' => $trade_no, 'xsbh' => $xsbh, 'sfje' => $total_fee, 'sfsj' => $time, 'sfry'=> $fs, 'sffs' => $fs, 'zt' => 1]);
                    Log::info("插入数据id：" . $id);
                    if(empty($id))
                    {
                        Log::info("保存失败，请重新通知");
                        return $fail('保存失败，请重新通知');
                    }
                    // Log::info('执行完存储过程');
                    // Log::info($total_fee);
                    // return true;
                }
            } else {
                Log::info('通信失败');
                return $fail('通信失败，请稍后再通知我');
            }

        });
        Log::info("response->send()");
        $response->send();
    }
}
