@extends('layouts.app')
@section('title', '学生信息')
@section('content')
<div class="card-header">
    <h5>学生信息</h5>
</div>

<table class="table table-bordered">
  <tbody>
    <tr>
      <td>学生编号</th>
      <td>{{ $date->XSBH }}</td>
      <td>学生姓名</td>
      <td>{{ $date->XSXM }}</td>
    </tr>
    <tr>
      @if(!empty($date->OPENID))
      <td colspan="2">已关联微信</td>
      @endif
      <td>关联手机</th>
      <td>{{ $date->SJHM }}</td>
    </tr>
  </tbody>
</table>

<div class="row">
@foreach($orders as $order)
  <div class="col-sm-6 my-1">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">收费单号：{{ $order->sfdh }}</h5>
        <p class="card-text">收费单金额：{{ $order->je }}</p>
        <a href="{{ route('pages.custom', ['id' => $date->XSBH, 'dh' => $order->sfdh, 'je' => $order->je]) }}" class="btn btn-primary">前往缴费</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
<a class="btn btn-danger btn-lg btn-block my-2" href="{{ route('pages.cancel', ['id' => $date->XSBH]) }}" role="button">解除微信关联</a>
@stop 