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
        // dump($request->id);
        // dump($request->dh);
        // dump($request->amount);
        // dd($request);
        $openid = DB::table('table_xsxx')->where('xsbh', $request->id)->value('openid');
        // dump($openid);
        $payments = EasyWeChat::payment();
        $trade_no = $request->dh . random_int(1000, 9999);
        $unify = $payments->order->unify([
            'body' => $request->id . '自助缴费',
            'out_trade_no' => $trade_no,
            'attach' => $request->id,
            'total_fee' => $request->amount/* * 100 */,
            'trade_type' => 'JSAPI',
            'sub_openid' => $openid
        ]);
        // dd($unify);
        $config = $payments->jssdk->sdkConfig($unify['prepay_id']);
        // dd($config);
        return view('payment.pay', compact('config'));

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
            // dd('支付成功');
            $data = array('status' => 'SUCCESS');
        }else{
            // dd('支付失败');
            $data = array('status' => "FAIL");
        }
        return json_encode($data);
    }

    /**
     * @支付类，下单
     * @param {type} 
     * @return: 
     * @author: Lilue
     */    
    public function payments()
    {
        $payments = EasyWeChat::payment();
        // $result = $payments->order->unify([
        //     'body' => $temp->in_car_plate . '停车费',
        //     'out_trade_no' => $trade_no,
        //     'attach'    => $temp->in_car_plate,
        //     'total_fee' => $money * 100,//$money * 100,
        //     'notify_url' => Route('notify_url'),
        //     'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
        //     'sub_openid' => $user->id,
        // ]);
        // $config = $payments->jssdk->sdkConfig($result['prepay_id']);
        // $app = EasyWeChat::officialAccount();
        // $baseJson = $app->jssdk->buildConfig(array('chooseWXPay'));
        // return view('payment.payments', compact('temp', 'money', 'config', 'baseJson', 'trade_no', 'time'));
    }
}
