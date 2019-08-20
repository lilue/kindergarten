@extends('layouts.app')
@section('title', '首页')
@section('content')
<div class="card bg-light mb-3">
    <div class="card-header">
        <h5>新增关联</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('pages.linked') }}">
        {{ csrf_field() }}
        @include('shared._error')
          <div class="form-group">
            <label for="xsbh">学生编号：</label>
            <input type="text" name="xsbh" class="form-control" value="{{ old('xsbh') }}">
          </div>
          <div class="form-group">
            <label for="phone">手机号码：</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
          </div>
          <button type="submit" class="btn btn-primary">关联</button>
        </form>
    </div>
</div>


@stop 