@extends('layouts.admin-master')

@section('title')
Блог
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Блог</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">Блог</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header d-felx justify-content-between">
                <h4>Статьи</h4>
                <a href="{{ route('blog.create') }}">Создать статью</a>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped  no-footer">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog['id'] }}</td>
                                        <td>{{ $blog['title'] }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('blog.edit', $blog) }}">Ред.</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection