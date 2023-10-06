@extends('admin.layouts.master')

@isset($product)
    @section('admin.title', 'Редактировать товар ' . $product->name)
@else
    @section('admin.title', 'Создать товар')
@endisset

@section('admin.content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @isset($product)
                        <h2>Редактировать продукт <b>{{ $product->name }}</b></h2>
                    @else
                        <h2>Создать продукт</h2>
                    @endisset
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Продукты</a></li>
                        <li class="breadcrumb-item active">
                            @isset($product)
                                Редактировать продукт <b>{{ $product->name }}</b>
                            @else
                                Создать продукт
                            @endisset
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card-body pt-0">
        <div class="card card-primary p-4">
            <div class="card-header">
                @isset($product)
                    <h3 class="card-title">Изменить данные</h3>
                @else
                    <h3 class="card-title">Ваша новый продукт</h3>
                @endisset
            </div>
            <form method="POST" enctype="multipart/form-data"
                  @isset($product)
                      action="{{ route('admin.products.update', $product->id) }}"
                  @else
                      action="{{ route('admin.products.store') }}"
                @endisset
            >
                @csrf
                {{-- Изменяем метод на PUT для update --}}
                @isset($product)
                    @method('PUT')
                @endisset

                <div class="form-group mt-4">
                    <label for="code">Код:</label>
                    <input name="code" type="text" class="form-control @error('code') is-invalid @enderror"
                           id="code" placeholder="Введите код"
                           value="{{ old('code', isset($product) ? $product->code : null) }}">
                    @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="name">Название:</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" placeholder="Введите название"
                           value="{{ old('name', isset($product) ? $product->name : null) }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="description">Описание:</label>
                    <textarea name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              id="description" rows="5" placeholder="Введите описание">{{ old('description', isset($product) ? $product->description : null) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="category_id">Выберите категорию:</label>
                    <select class="form-control" id="category_id" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @isset($product)
                                        @if($product->category_id == $category->id)
                                            selected
                                @endif
                                @endisset
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="subcategory_id">Выберите субкатегорию:</label>
                    <select class="form-control" id="subcategory_id" name="subcategory_id">
                        <option value="" @empty($product->subcategory_id) selected @endempty>Нет субкатегории</option>
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}"
                                    @isset($product)
                                        @if($product->subcategory_id == $subcategory->id)
                                            selected
                                @endif
                                @endisset
                            >{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="brand_id">Выберите бренд :</label>
                    <select class="form-control" id="brand_id" name="brand_id" required>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                                    @isset($product)
                                        @if($product->brand_id == $brand->id)
                                            selected
                                @endif
                                @endisset
                            >{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>


                @if(isset($product) && !empty($product->image))
                    <div class="form-group mt-4">
                        <label>Старые изображения:</label>
                        @foreach(json_decode($product->image, true) as $oldImage)
                            <img style="height:140px; width: 120px;" src="{{ asset('storage/' . $oldImage) }}" alt="Старое изображение" class="img-thumbnail">
                        @endforeach
                    </div>
                @endif

                <div class="form-group mt-4">
                    <label for="images">Изображения (допускаются несколько изображений):</label>
                    <input name="images[]" type="file" class="form-control-file" id="images" multiple>
                </div>

                <!-- Добавьте блок для отображения новых изображений после загрузки (если они есть) -->
                @if(old('images') && is_array(old('images')))
                    <div class="form-group mt-4">
                        <label>Новые изображения:</label>
                        @foreach(old('images') as $newImage)
                            <img  src="{{ asset('storage/' . $newImage) }}" alt="Новое изображение" class="img-thumbnail">
                        @endforeach
                    </div>
                @endif

                <div class="form-group mt-4">
                    <label for="price">Цена:</label>
                    <input name="price" type="text" class="form-control @error('price') is-invalid @enderror"
                           id="price" placeholder="Введите цену"
                           value="{{ old('price', isset($product) ? $product->price : null) }}">
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="count">Колличество товаров:</label>
                    <input name="count" type="text" class="form-control @error('count') is-invalid @enderror"
                           id="count" placeholder="Введите кол-во"
                           value="{{ old('count', isset($product) ? $product->count : null) }}">
                    @error('count')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <h4>Дополнительные характеристики:</h4>
                    @foreach([
                                      'hit' => 'Хит',
                                      'new' => 'Новинка',
                                      'recommend' => 'Рекомендуемые',
                                    ] as $field => $title)
                        <div class="form-check">
                            <input name="{{ $field }}" type="checkbox" class="form-check-input" id="{{ $field }}"
                                   @if(isset($product) && $product->$field === 1)
                                       checked = 'checked'
                            @endif
                            <label class="form-check-label" for="{{ $field }}">{{ $title }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group mt-4">
                    <label for="cryptocurrency_id">Выберите криптовалюту:</label>
                    <select class="form-control" id="cryptocurrency_id" name="cryptocurrency_id">
                        <option value="">Выберите криптовалюту</option>
                        @foreach($cryptocurrencies as $cryptocurrency)
                            <option value="{{ $cryptocurrency->id }}"
                                    @isset($product)
                                        @if($product->cryptocurrencies->contains($cryptocurrency->id))
                                            selected
                                @endif
                                @endisset
                            >{{ $cryptocurrency->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="cashback_percentage">Процент кэшбэка:</label>
                    <input name="cashback_percentage" type="text" class="form-control @error('cashback_percentage') is-invalid @enderror"
                           id="cashback_percentage" placeholder="Введите процент кэшбэка"
                           value="{{ old('cashback_percentage', isset($product) && $product->cashbacks ? $product->cashbacks->first()->cashback_percentage : null) }}">
                    @error('cashback_percentage')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
            </form>


        </div>
    </div>
@endsection



