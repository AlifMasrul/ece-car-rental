@extends('layouts.admin2')

@section('content_header')
<h1>User Management</h1>
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->is_admin == 1)
                        <span class="badge bg-danger">Admin</span>
                        @else
                        <span class="badge bg-primary">User</span>
                        @endif
                    </td>
                    <td>{{ $user->status }}</td>
                    <td>
                        @if ($user->is_admin == 0)
                        @if ($user->status === 'active')
                        <form action="{{ route('admin.users.block', $user->id) }}" method="POST" class="confirm-action">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Block</button>
                        </form>
                        @else
                        <form action="{{ route('admin.users.unblock', $user->id) }}" method="POST" class="confirm-action">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Unblock</button>
                        </form>
                        @endif
                        @else
                        <span class="text-muted">Cannot modify</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.confirm-action');
        forms.forEach(form => {
            form.addEventListener('submit', function (event) {
                const action = this.action.includes('unblock') ? 'unblock' : 'block';
                const confirmationMessage = `Are you sure you want to ${action} this user?`;
                if (!confirm(confirmationMessage)) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
@endsection