@extends('layouts.app')
@section('title', '首页')
@section('content')
<div class="card-header">
    <h5>已关联学员</h5>
</div>

<ul class="list-group">
@foreach($students as $student)
<a href="{{ route('pages.show', ['id' => $student->XSBH]) }}" class="list-group-item">{{ $student->XSXM }}</a>
@endforeach
</ul>
<a class="btn btn-primary my-2" href="{{ route('pages.linked') }}" role="button">新增关联</a>

@stop 