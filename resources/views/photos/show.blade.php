{{-- resources/views/photos/show.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Деталі фотографії: {{ $photo->title }}
                        <div class="pull-right">
                            <a href="{{ url('/photos') }}" class="btn btn-xs btn-default">Повернутися до галереї</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="text-center">
                            <img src="{{ url('images/' . $photo->filename) }}" alt="{{ $photo->title }}" style="max-width: 100%; height: auto;">
                        </div>

                        <hr>

                        <h3>{{ $photo->title }}</h3>
                        @if ($photo->description)
                            <p>{{ $photo->description }}</p>
                        @else
                            <p>Опис відсутній.</p>
                        @endif
                        <p>
                            **Завантажено:** {{ $photo->user->name }}
                            <br>
                            **Дата завантаження:** {{ $photo->created_at->format('d M Y, H:i') }}
                        </p>

                        {{-- Якщо ви хочете додати кнопки редагування/видалення для власника фото --}}
                        @if (Auth::check() && Auth::id() == $photo->user_id)
                            <hr>
                            <p>
                                <a href="{{ url('/photos/' . $photo->id . '/edit') }}" class="btn btn-warning">Редагувати</a>
                                {{-- Форма для видалення - зробимо пізніше --}}
                                <form action="{{ url('/photos/' . $photo->id) }}" method="POST" style="display:inline;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені, що хочете видалити це фото?')">Видалити</button>
                                </form>
                            </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
