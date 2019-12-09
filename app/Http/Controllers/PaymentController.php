<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat;
use App\Http\Requests\AmountRequest;
use DB;

class PaymentController extends Controller
{
    public function show()
    {
        return view('payment.show');
    }

    public function inputAmout()
    {
        return view('payment.amout');
    }

    public function pay(AmountRequest $request)
    {
        $openid = DB::table('table_xsxx')->where('xsbh', $request->id)->value('openid');
        $payments = EasyWeChat::payment();
        $amount = $request->amount;
        $trade_no = $request->dh . random_int(10000, 99999);
        $unify = $payments->order->unify([
            'body'          => $request->id . '自助缴费',
            'out_trade_no'  => $trade_no,
            'attach'        => $request->id,
            'total_fee'     => $amount * 100,
            'notify_url'    => Route('notify_url'),
            'trade_type'    => 'JSAPI',
            'sub_openid'    => $openid
        ]);
        // dd($unify);
        Log::info("去支付" . $unify);
        $config = $payments->jssdk->sdkConfig($unify['prepay_id']);
        // dd($config);
        $app = EasyWeChat::officialAccount();
        $baseJson = $app->jssdk->buildConfig(array('chooseWXPay'));
        // dd($baseJson);
        return view('payment.pay', compact('config', 'baseJson', 'trade_no', 'amount'));

    }

    /**
     * @验证是否付款成功: 
     * @param {type} 
     * @return:                                
     * @author: Lilue
     */
    public function checkTradeNumber(Request $request)
    {
        $payments = EasyWeChat::payment();
        $result = $payments->order->queryByOutTradeNumber($request->trade_no);
        if ($result['result_code'] == "SUCCESS" && $result['trade_state'] == "SUCCESS")
        {
            $data = array('status' => 'SUCCESS');
        }else{
            $data = array('status' => "FAIL");
        }
        return json_encode($data);
    }

     
    public function payments($trade)
    {
        // dump($trade);
        $payments = EasyWeChat::payment();
        $result = $payments->order->queryByOutTradeNumber($trade);
        $data = DB::table('table_sfjl')->where('trade_no', $trade)->first();
        return view('payment.successful',compact('result', 'data'));
    }
}
