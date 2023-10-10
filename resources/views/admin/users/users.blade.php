@extends('admin.layouts.master')
@section('admin.title', 'Панель администратора - Пользователи')

@section('admin.content')
    <div class="card">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                            <h2>Пользователи</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main') }}">Главная страница</a></li>
                            <li class="breadcrumb-item active">Пользователи</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="card-body pt-0">

        {{-- поиск--}}
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="col-sm-12 d-flex justify-content-end p-0">
                    <form action="{{ route('admin.users.index') }}" method="GET">
                        <div id="example1_filter" class="dataTables_filter">
                            <label>Поиск:<input type="search" class="form-control form-control-sm " name="keyword" placeholder="" aria-controls="example1" value="{{ old('keyword', $keyword) }}"></label>
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
                                    <th scope="col">Имя</th>
                                    <th scope="col">e-mail</th>
                                    <th scope="col">Дата регистрации</th>
                                    <th scope="col">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $user->id ) }}" method="POST" >
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-success">Открыть</a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Редактировать</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Вы точно хотите удалить пользователя?')" class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                <div class="m-2">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Добавить пользователя</a>
                </div>
            </div>
        </div>

    </div>

    </div>
@endsection


