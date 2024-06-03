@extends('layouts.admin')

@section('upper_title')
    Użytkownicy
@endsection

@section('main_content')
<div>
    <h4>Filtruj według roli:</h4>
    @foreach ($roles as $role)
        <label>
            <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="role-checkbox"> {{ $role->name }}
        </label>
    @endforeach
</div>

<h4>Szukaj:</h4>
<form id="searchForm" method="POST" action="{{ route('admin.user.search') }}">
    @csrf
    <input type="text" name="searchTerm" id="searchTerm" placeholder="Szukaj...">
    <select name="searchType" id="searchType">
        <option value="id">ID</option>
        <option value="name">Username</option>
        <option value="email">Email</option>
        <option value="editor_id">Id editora</option>
    </select>
    <input type="hidden" name="roles" id="searchRoles">
    <button type="submit">Szukaj</button>
</form>

<h4>Sortuj:</h4>
<form id="sortForm" method="POST" action="{{ route('admin.user.sort') }}">
    @csrf
    <select name="sortColumn" id="sortColumn">
        <option value="id">ID</option>
        <option value="name">Username</option>
        <option value="email">Email</option>
        <option value="created_at">Data utworzenia</option>
        <option value="updated_at">Data ostaniej zmiany</option>
        <option value="editor_id">Id editora</option>
    </select>
    <select name="sortOrder" id="sortOrder">
        <option value="asc">Rosnąco</option>
        <option value="desc">Malejąco</option>
    </select>
    <input type="hidden" name="roles" id="sortRoles">
    <button type="submit">Sortuj</button>
</form>


<table id="usersTable" class="table table-striped  table-dark table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Data utworzenia</th>
            <th>Data ostaniej zmiany</th>
            <th>Ostatnio znieniono przez</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><a href="{{route('admin.user.show', $user->id)}}" class="btn btn-primary btn-as-link">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
                <td>ID: {{$user->editor_id}}</td>
                <td>@foreach ($user->roles as $role)
                    {{$role->name}}
                @endforeach</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="text-white mt-3">

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function getSelectedRoles() {
            var selectedRoles = [];
            $('.role-checkbox:checked').each(function() {
                selectedRoles.push($(this).val());
            });
            return selectedRoles;
        }

        function appendUsers(users) {
            $('#usersTable tbody').empty();
            users.forEach(function(user) {
                let createdAt = new Date(user.created_at).toLocaleString('pl-PL', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                let updatedAt = new Date(user.updated_at).toLocaleString('pl-PL', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                let roles = user.roles ? user.roles.map(role => role.name).join(', ') : '';
                let editorId = user.editor_id ? user.editor_id : '';
                $('#usersTable tbody').append(`
                    <tr>
                        <td>${user.id}</td>
                        <td><a href="/admin/user/${user.id}/show" class="btn btn-primary btn-as-link">${user.name}</a></td>
                        <td>${user.email}</td>
                        <td>${createdAt}</td>
                        <td>${updatedAt}</td>
                        <td>ID: ${editorId}</td>
                        <td>${roles}</td>
                    </tr>
                `);
            });
        }

        $('#searchForm').on('submit', function(event) {
            event.preventDefault();
            $('#searchRoles').val(getSelectedRoles().join(','));
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    appendUsers(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#sortForm').on('submit', function(event) {
            event.preventDefault();
            $('#sortRoles').val(getSelectedRoles().join(','));
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    appendUsers(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

</script>

@endsection