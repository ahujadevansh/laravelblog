@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end">
            <a class="btn btn-primary" href="{{ route('register') }}">Add User</a>
    </div>

    <div class="card">
        <div class="card-header">
            Users
        </div>

        <div class="card-body">
            @if ($users->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><img src="{{ \Thomaswelton\LaravelGravatar\Facades\Gravatar::src($user->email) }}" alt="User Image" width="128"></td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    @if(! $user->isAdmin())
                                        <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-outline-danger">Make Admin</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <h5>No User Available</h5>
            @endif
        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>

@endsection

