{{-- C:\OSPanel\domains\photo_gallery\resources\views\partials\messages.blade.php --}}

@if (session()->has('app_status'))
    <div id="custom-success-message" style="
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: .25rem;
        text-align: center;
        font-weight: bold;
    ">
        {{ session('app_status') }}
        <button type="button" onclick="document.getElementById('custom-success-message').style.display='none'" style="float: right; background: none; border: none; font-size: 1.2em; cursor: pointer;">&times;</button>
    </div>
    {{ session()->forget('app_status') }}
@endif

@if (session()->has('app_error'))
    <div id="custom-error-message" style="
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: .25rem;
        text-align: center;
        font-weight: bold;
    ">
        {{ session('app_error') }}
        <button type="button" onclick="document.getElementById('custom-error-message').style.display='none'" style="float: right; background: none; border: none; font-size: 1.2em; cursor: pointer;">&times;</button>
    </div>
    {{ session()->forget('app_error') }}
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif