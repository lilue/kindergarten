@extends('layouts.app')
@section('title', '确认缴费')

@section('script')
@parent
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">wx.config({{ $baseJson }});</script>
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
                    alert('成功了');
                } else {
                    alert(res.errMsg);
                }
            },
            cancel: function (res) {
                alert('取消支付');
                // history.back();
            }
        });
    }
</script>
@endsection

@section('content')

<button type="button" onclick="callpay()" class="btn btn-success btn-lg btn-block">Success</button>

@stop 