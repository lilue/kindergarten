@extends('layouts.app')
@section('title', '确认缴费')

@section('script')
@parent
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">wx.config(<?php echo $baseJson ?>);</script>
<script type="text/javascript">
    function callpay()
    {
        wx.chooseWXPay({
            timestamp: <?= $config['timestamp'] ?>,
            nonceStr: '<?= $config['nonceStr'] ?>',
            package: '<?= $config['package'] ?>',
            signType: '<?= $config['signType'] ?>',
            paySign: '<?= $config['paySign'] ?>', // 支付签名
            success: function (res) {
                // document.write(Object.entries(res));
                if(res.errMsg == "chooseWXPay:ok" ) {
                    // alert('成功了');
                    window.location.href = "{{ route('notice', ['trade' => $trade_no]) }}"
                } else {
                    alert(res.errMsg);
                }
            },
            cancel: function (res) {
                alert('取消支付');
            }
        });
    }
</script>
@endsection

@section('content')

<div class="card">
  <h5 class="card-header">支付订单创建成功</h4>
  <div class="card-body">
    <h4 class="card-title">支付金额：￥{{ $amount }} 元</h4>
    <p class="card-text">请点击确认支付完成支付。</p>
    <button type="button" onclick="callpay()" class="btn btn-success btn-lg btn-block">确认支付</button>
  </div>
</div>

@stop 