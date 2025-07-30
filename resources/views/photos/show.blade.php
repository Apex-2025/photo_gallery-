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
                        <p>
                            **Завантажено:** {{ $photo->user->name }}
                            <br>
                            **Дата завантаження:** {{ $photo->created_at->format('d M Y, H:i') }}
                        </p>

                        @if (Auth::check() && Auth::id() == $photo->user_id)
                            <hr>
                            @if (Auth::check() && Auth::id() == $photo->user_id)
                                <hr>
                                <div style="display: flex; gap: 15px; margin-top: 15px;">
                                    <a href="{{ url('/photos/' . $photo->id . '/edit') }}" class="btn btn-warning" style="min-width: 100px; text-align: center;">Редагувати</a>

                                    <form action="{{ url('/photos/' . $photo->id) }}" method="POST" style="display:inline;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger" style="min-width: 100px; text-align: center;" onclick="return confirm('Ви впевнені, що хочете видалити це фото?')">Видалити</button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
