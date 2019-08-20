@extends('layouts.app')
@section('title', '学生信息')
@section('content')
<div class="card bg-light mb-3">
    <div class="card-header">
        <h5>自助缴费</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('pay') }}">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $id }}" />
        <input type="hidden" name="dh" value="{{ $dh }}" />
        @include('shared._error')
        <span class="input-group-text mb-1" id="basic-addon2">收费单总金额:￥{{ $je }}元</span>

        <span class="input-group-text mb-1" id="basic-addon2">待缴金额:￥{{ $djje }}元</span>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">输入自定义金额：￥</span>
            </div>
            <input type="text" name="amount" class="form-control" value="{{ old('amount') }}">
            <div class="input-group-append">
                <span class="input-group-text">.00</span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">去支付</button>
        </form>
    </div>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">缴费金额(元)</th>
      <th scope="col">缴费方式</th>
      <th scope="col">缴费时间</th>
    </tr>
  </thead>
  <tbody>
      @foreach($jfjl as $jl)
    <tr>
      <td>￥{{ $jl->sfje }}</td>
      <td>{{ $jl->sffs }}</td>
      <td>{{ $jl->sfsj }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop 