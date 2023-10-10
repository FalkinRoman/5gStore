@extends('admin.layouts.master')
@section('admin.title', 'Панель администратора - Продукты')

@section('admin.content')
    <div class="card">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Продукты</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                            <li class="breadcrumb-item active">Продукты</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="card-body pt-0">

            {{-- поиск--}}
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="col-sm-12 d-flex justify-content-end p-0">
                    <form action="{{ route('admin.products.index') }}" method="GET">
                        <div id="example1_filter" class="dataTables_filter">
                            <label>Поиск:<input type="search" class="form-control form-control-sm " name="keyword" placeholder="" aria-controls="example1" value="{{ old('keyword', $keyword) }}"></label>
                            <button type="submit" class="btn btn-primary btn-sm mb-1">Искать</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Код</th>
                                <th scope="col">Название</th>
                                <th scope="col">Категория</th>
                                <th scope="col">Колличество</th>
                                <th scope="col">Цена</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    {{--                   // @dd($product)--}}
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name}}</td>
                                    <td>{{ $product->count}} шт</td>
                                    <td>{{ $product->price}}  ₽</td>
                                    <td>
                                        <form action="{{ route('admin.products.destroy', $product->id ) }}" method="POST" >
                                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-success">Открыть</a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Редактировать</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Вы точно хотите удалить товар?')" class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <div id="pagination" class="d-flex justify-content-start mt-3">
                            {{ $products->links() }}
                        </div>
                        <a href="{{ route('admin.products.create') }}" class="mt-3 btn btn-primary">Добавить продукт</a>


                     </div>
                </div>
            </div>

    </div>
@endsection

