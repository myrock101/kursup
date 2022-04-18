@extends('layouts.admin-master')

@section('title')
Создание статьи
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Создание статьи</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">Блог</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header d-felx justify-content-between">
                <h4>Редактирование статьи</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('blog.update', $blog) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('admin.blog._form')

                    <button type="submit" class="btn btn-primary">
                        Сохранить
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection