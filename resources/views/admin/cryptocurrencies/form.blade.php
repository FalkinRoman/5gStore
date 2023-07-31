@extends('admin.layouts.master')
@isset($cryptocurrency)
    @section('admin.title', 'Редактировать криптовалюту ' .$cryptocurrency-> name)
@else
    @section('admin.title', 'Создать криптовалюту')
@endisset


@section('admin.content')
    <body>
    <div class="container mt-4">
        @isset($cryptocurrency)
            <h2>Редактировать криптовалюту <b>{{ $cryptocurrency->name }}</b></h2>
        @else
            <h2>Создать криптовалюту</h2>
        @endisset
        <form  method="POST" enctype="multipart/form-data"
        @isset($cryptocurrency)
            action="{{ route('admin.cryptocurrencies.update', $cryptocurrency->id) }}"
            @else
            action="{{ route('admin.cryptocurrencies.store') }}"
            @endisset
        >
            @csrf
{{--            Изменяем метод на PUT для update--}}
            @isset($cryptocurrency)
                @method('PUT')
            @endisset

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group mt-4">
                <label for="symbol">Символ:</label>
                <input name="symbol" type="text" class="form-control @error('symbol') is-invalid @enderror" id="symbol" placeholder="Введите символ" value=" {{ old('symbol', isset($cryptocurrency) ? $cryptocurrency->symbol: null) }}">
                @error('symbol')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="name">Название:</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Введите название" value="{{ old('name', isset($cryptocurrency) ? $cryptocurrency->name: null) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <label for="image">Логотип:</label>
                <input name="image" type="file" class="form-control-file" id="image" value="{{ old('image', isset($cryptocurrency) ? $cryptocurrency->image: null) }}">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
        </form>
    </div>
    </body>

@endsection




