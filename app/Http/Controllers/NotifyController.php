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
                $appl = EasyWeChat::officialAccount();
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

                    $xsxx = DB::table('table_xsxx')->where('xsbh', $xsbh)->first();
                    $sfdmc = DB::table('table_sfd')->where('sfdh', $sfdh)->value('sfdmc');
                    $first = "尊敬的" . $xsxx->xsxm . "家长，您已成功缴费";
                    $appl->template_message->send([
                        'touser'        =>  $xsxx->openid,
                        'template_id'   =>  '0UY3WJ6ooLm2h6FoUwEAII1jsDmg80C7sKA_GG5S-jM',
                        'url'           =>  route('details', ['id' => $xsbh, 'dh' => $sfdh]),
                        'data'          =>  [
                            'first'         =>  $first,                     // 抬头
                            'keyword1'      =>  $xsxx->xsxm,                // 学生姓名
                            'keyword2'      =>  $xsxx->bj,                  // 班级
                            'keyword3'      =>  $sfdmc,                     // 账单名称
                            'keyword4'      =>  $total_fee,                 // 缴费金额
                            'keyword5'      =>  substr($time,0,4). "年" .substr($time,4,2) . "月" . substr($time,6,2) . '日  ' . substr($time,8,2) . ':' . substr($time,10,2) . ':' . substr($time,12,2),                      // 缴费时间
                            'remark'      =>  '感谢您的支持！点击查看缴费单。',
                        ],
                    ]);
                    // Log::info('执行完存储过程');
                    // Log::info($total_fee);
                    return true;
                } else {
                    Log::info('通信失败1');
                    return $fail('通信失败，请稍后再通知我');
                }
            } else {
                Log::info('通信失败');
                return $fail('通信失败，请稍后再通知我');
            }
        });
        Log::info("response->send()");
        return $response;
    }
}
