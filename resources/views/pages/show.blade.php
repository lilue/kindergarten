@extends('layouts.app')
@section('title', '学生信息')
@section('content')
<div class="card-header">
    <h5>学生信息</h5>
</div>

<table class="table table-bordered">
  <tbody>
    <tr>
      <td colspan="1">学生编号</th>
      <td colspan="1" style="white-space:normal">{{ $date->xsbh }}</td>
      <td colspan="1">学生姓名</td>
      <td colspan="1" style="white-space:normal">{{ $date->xsxm }}</td>
    </tr>
    <tr>
      <td colspan="1">关联手机</th>
      <td colspan="1" style="white-space:normal">{{ $date->sjhm }}</td>
      @if(!empty($date->openid))
      <td colspan="2">已关联微信</td>
      @endif
    </tr>
  </tbody>
</table>

<div class="row">
@foreach($orders as $order)
  <div class="col-sm-6 my-1">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">收费单名称：{{ $order->sfdmc }}</h5>
        <p class="card-text">收费单金额：{{ $order->je }}</p>
        <a href="{{ route('pages.custom', ['id' => $date->xsbh, 'dh' => $order->sfdh, 'je' => $order->je]) }}" class="btn btn-primary">前往缴费</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
<a class="btn btn-danger btn-lg btn-block my-2" href="{{ route('pages.cancel', ['id' => $date->xsbh]) }}" role="button">解除微信关联</a>
@stop 