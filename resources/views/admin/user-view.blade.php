@extends('layouts.app')

@section('title', 'Detalle del usuario')
@section('content')
<div class="admin-page user-view-page">
    <div class="user-view-card">
        <h1 class="admin-title">Correo: {{ $usuario->usuario }}</h1>
        <h1 class="admin-title">Username: {{ $usuario->username ?? 'None' }}</h1>

        <div class="user-view-info">
            <p><strong>ID:</strong> {{ $usuario->id }}</p>
            <p><strong>Tipo:</strong> {{ $usuario->tipo_usuario }}</p>
            <p><strong>Verificado:</strong> {{ $usuario->is_verified }}</p>
        </div>

        <h2 class="user-view-subtitle">Temas creados</h2>

        <div class="admin-table-container">
            <table class="admin-table">
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Categoria</th>
                    <th>Mensaje</th>
                    <th>Visible</th>
                </tr>

                @foreach($temas as $t)
                <tr>
                    <td>{{ $t->id_foro }}</td>
                    <td>{{ $t->titulo }}</td>
                    <td>{{ $t->categoria }}</td>
                    <td class="user-view-message">{{ $t->mensaje }}</td>
                    <td>
                        <span class="admin-status {{ $t->visible ? 'admin-status-active' : 'admin-status-disabled' }}">
                            {{ $t->visible ? 'SI' : 'NO' }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <a href="/admin" class="admin-link-button admin-btn admin-btn-primary user-view-back">Volver</a>
    </div>
</div>
@endsection