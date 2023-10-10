@extends('admin.layouts.master')
@section('admin.title', 'Панель администратора - Отзывы')

@section('admin.content')
    <div class="card">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                            <h2>Отзывы</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                            <li class="breadcrumb-item active">Отзывы</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="card-body pt-0">

        {{-- поиск--}}
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="col-sm-12 d-flex justify-content-end p-0">
                    <form action="{{ route('admin.reviews.index') }}" method="GET">
                        <div id="example1_filter" class="dataTables_filter">
                            <label>Поиск:<input type="search" class="form-control form-control-sm " name="keyword" placeholder="Пользователь, продукт" aria-controls="example1" value="{{ old('keyword', $keyword) }}"></label>
                            <button type="submit" class="btn btn-primary btn-sm mb-1">Искать</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                    <div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Пользователь</th>
                                    <th scope="col">Продукт</th>
                                    <th scope="col">Рейтинг</th>
                                    <th scope="col">Отзыв</th>
                                    <th scope="col">Дата</th>
                                    <th scope="col">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->user->email }}</td>
                                    <td>{{ $review->product->name }}</td>
                                    <td> {{ $review->rating }}</td>
                                    <td>{{ Str::limit($review->comment, 30) }}</td>
                                    <td>{{ $review->created_at }}</td>
                                    <td>
                                        <form action="{{ route('admin.reviews.destroy', $review->id ) }}" method="POST" >
                                            <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-success">Открыть</a>
                                            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-warning">Редактировать</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Вы точно хотите удалить отзыв?')" class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                <div class="m-2">
                    <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">Добавить отзыв</a>
                </div>
            </div>
        </div>

    </div>

    </div>
@endsection


