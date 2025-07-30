@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редагувати фотографію: {{ $photo->title }}</div>
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

                        <form action="{{ url('/photos/' . $photo->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label for="title">Назва фотографії</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $photo->title) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="image">Змінити файл зображення (залиште порожнім, щоб зберегти поточний)</label>
                                <input type="file" id="image" name="image">
                                <p class="help-block">Поточне зображення: <img src="{{ url('images/' . $photo->filename) }}" alt="Поточне фото" style="max-width: 100px; height: auto;"></p>
                            </div>

                            <button type="submit" class="btn btn-primary">Оновити фото</button>
                            <a href="{{ url('/photos/' . $photo->id) }}" class="btn btn-default">Скасувати</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
