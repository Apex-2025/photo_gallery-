@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Завантажити нове фото</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('/photos') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">Назва фотографії</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Опис</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Файл зображення</label>
                                <input type="file" id="image" name="image" required>
                                <p class="help-block">Будь ласка, завантажте файл зображення (JPG, PNG, GIF, WEBP) до 5 МБ.</p>
                            </div>

                            <button type="submit" class="btn btn-primary">Завантажити</button>
                            <a href="{{ url('/photos') }}" class="btn btn-default">Скасувати</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
