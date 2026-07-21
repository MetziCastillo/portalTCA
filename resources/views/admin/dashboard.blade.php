@extends('layouts.app')

@section('title', 'Administrador')
@section('content')
<div class="admin-page">
    <h1 class="admin-title">Panel Administrador</h1>

    <form method="GET" action="/admin" class="admin-search-form">
        <input class="admin-input admin-search-input" type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar usuario">
        <button class="admin-btn admin-btn-primary" type="submit">Buscar</button>

        <a href="/admin" class="admin-link-button admin-btn admin-btn-secondary">Limpiar</a>
    </form>

    <button class="admin-btn admin-btn-primary admin-create-button" type="button" onclick="crearUsuario()">Create User</button>

    <div class="admin-table-container">
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Correo</th>
                <th>Username</th>
                <th>Password</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <tr id="createRow" class="admin-create-row" style="display:none;">
                <td colspan="7">
                    <form method="POST" action="/admin/create" class="admin-inline-form">
                        @csrf

                        <span>Nuevo</span>

                        <input class="admin-input" type="email" name="usuario" placeholder="Correo" required>
                        <input class="admin-input" type="text" name="username" placeholder="Username opcional">
                        <input class="admin-input" type="text" name="password" placeholder="Password" required>

                        <select class="admin-select" name="tipo_usuario">
                            <option value="1">Admin</option>
                            <option value="2" selected>Basico</option>
                        </select>

                        <select class="admin-select" name="activo">
                            <option value="1" selected>Activo</option>
                            <option value="0">Desactivado</option>
                        </select>

                        <button class="admin-btn admin-btn-primary" type="submit">Guardar</button>
                        <button class="admin-btn admin-btn-secondary" type="button" onclick="cancelarCrear()">Cancel</button>
                    </form>
                </td>
            </tr>

            @foreach($usuarios as $u)
            <tr id="view{{ $u->id }}" class="fila-usuario">
                <td>{{ $u->id }}</td>
                <td>{{ $u->usuario }}</td>
                <td>{{ !empty($u->username) ? $u->username : 'None' }}</td>
                <td class="admin-password-cell">{{ $u->password }}</td>
                <td>{{ $u->tipo_usuario == 1 ? 'Admin' : 'Basico' }}</td>
                <td>
                    @if($u->activo == 1)
                        <span class="admin-status admin-status-active">Activo</span>
                    @else
                        <span class="admin-status admin-status-disabled">Desactivado</span>
                    @endif
                </td>

                <td class="admin-actions">
                    <button class="admin-btn admin-btn-secondary" type="button" onclick="editar({{ $u->id }})">Edit</button>

                    <form method="POST" action="/admin/delete/{{ $u->id }}" class="admin-action-form">
                        @csrf
                        <button class="admin-btn admin-btn-danger" type="submit">Delete</button>
                    </form>

                    <a href="/admin/user/{{ $u->id }}" class="admin-link-button admin-btn admin-btn-view">View</a>
                </td>
            </tr>

            <tr id="edit{{ $u->id }}" class="edit-row">
                <form method="POST" action="/admin/update/{{ $u->id }}">
                    @csrf

                    <td>{{ $u->id }}</td>
                    <td>
                        <input class="admin-input" type="text" name="usuario" value="{{ $u->usuario }}">
                    </td>
                    <td>
                        <input class="admin-input" type="text" name="username" value="{{ $u->username }}" placeholder="None">
                    </td>
                    <td>
                        <input class="admin-input" type="text" name="password" placeholder="Nueva contraseña">
                    </td>
                    <td>
                        <select class="admin-select" name="tipo_usuario">
                            <option value="1" {{ $u->tipo_usuario==1?'selected':'' }}>Admin</option>
                            <option value="2" {{ $u->tipo_usuario==2?'selected':'' }}>Basico</option>
                        </select>
                    </td>
                    <td>
                        @if($u->activo == 1)
                            <span class="admin-status admin-status-active">Activo</span>
                        @else
                            <span class="admin-status admin-status-disabled">Desactivado</span>
                        @endif
                    </td>

                    <td class="admin-actions">
                        <button class="admin-btn admin-btn-primary" type="submit">Save</button>
                        <button class="admin-btn admin-btn-secondary" type="button" onclick="cancelar({{ $u->id }})">Cancel</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="admin-pagination">
        @php
            $buscar = request('buscar');
        @endphp

        @if ($usuarios->onFirstPage())
            <button class="admin-btn admin-btn-secondary" disabled>Anterior</button>
        @else
            <a class="admin-link-button admin-btn admin-btn-secondary" href="{{ url('/admin?page=' . ($usuarios->currentPage() - 1) . '&buscar=' . urlencode($buscar)) }}">Anterior</a>
        @endif

        <span>Página {{ $usuarios->currentPage() }} de {{ $usuarios->lastPage() }}</span>

        @if ($usuarios->hasMorePages())
            <a class="admin-link-button admin-btn admin-btn-secondary" href="{{ url('/admin?page=' . ($usuarios->currentPage() + 1) . '&buscar=' . urlencode($buscar)) }}">Siguiente</a>
        @else
            <button class="admin-btn admin-btn-secondary" disabled>Siguiente</button>
        @endif
    </div>
</div>
@endsection