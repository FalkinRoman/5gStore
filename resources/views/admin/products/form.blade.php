@extends('admin.layouts.master')
@isset($product)
    @section('admin.title', 'Редактировать товар ' .$product-> name)
@else
    @section('admin.title', 'Создать товар')
@endisset


@section('admin.content')
    <body>
    <div class="container mt-4">
        @isset($product)
            <h2>Редактировать товар <b>{{ $product->name }}</b></h2>
        @else
            <h2>Создать товар</h2>
        @endisset
        <form  method="POST" enctype="multipart/form-data"
        @isset($product)
            action="{{ route('admin.products.update',$product->id) }}"
            @else
            action="{{ route('admin.products.store') }}"
            @endisset
        >
            @csrf
{{--            Изменяем метод на PUT для update--}}
            @isset($product)
                @method('PUT')
            @endisset

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group mt-4">
                <label for="code">Код:</label>
                <input name="code" type="text" class="form-control" id="code" placeholder="Введите код" value="@isset($product){{ $product->code }} @endisset">
            </div>
            <div class="form-group mt-2">
                <label for="name">Название:</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Введите название" value="@isset($product){{ $product->name }} @endisset">
            </div>
            <div class="form-group mt-2">
                <label for="description">Описание:</label>
                <textarea name="description" class="form-control" id="description" rows="5" placeholder="Введите описание">@isset($product){{ $product->description }} @endisset</textarea>
            </div>
            <div class="form-group">
                <label for="exampleSelect">Выберите категорию:</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @isset($product)
                                @if($product->category_id == $category->id)
                                    selected
                                @endif
                                @endisset
                        > {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="image">Картинка:</label>
                <input name="image" type="file" class="form-control-file" id="image" value="@isset($product){{ $product->image }} @endisset">
            </div>
            <div class="form-group mt-2">
                <label for="description">Цена:</label>
                <input name="price" type="text" class="form-control" id="price" placeholder="Введите цену" value="@isset($product){{ $product->price }} @endisset">
            </div>
            <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
        </form>
    </div>
    </body>

@endsection




