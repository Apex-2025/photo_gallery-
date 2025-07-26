@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Галерея фотографій</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(Auth::check())
                            <p><a href="{{ url('/photos/create') }}" class="btn btn-primary">Завантажити нове фото</a></p>
                        @else
                            <p>Увійдіть, щоб завантажувати фотографії.</p>
                        @endif

                        @if ($photos->isEmpty())
                            <p>Поки що немає фотографій. Будьте першими, хто завантажить!</p>
                        @else
                            <div class="row">
                                @foreach ($photos as $photo)
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <img src="{{ url('images/' . $photo->filename) }}" alt="{{ $photo->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                                            <div class="caption">
                                                <h3>{{ $photo->title }}</h3>
                                                <p>{{ str_limit($photo->description, 100) }}</p>
                                                <p>Завантажено: {{ $photo->user->name }}</p>
                                                {{-- <p><a href="#" class="btn btn-primary" role="button">Переглянути</a></p> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
