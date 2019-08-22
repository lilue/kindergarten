@extends('layouts.app')
@section('title', '确认缴费')

@section('content')

<div class="jumbotron">
  <h1 class="display-3">支付成功</h1>
  <p class="lead">支付时间：</p>
  <hr class="my-4">
  <p>支付金额：￥1000 元。</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="{{ route('pages.root') }}" role="button">返回</a>
  </p>
</div>

@stop 