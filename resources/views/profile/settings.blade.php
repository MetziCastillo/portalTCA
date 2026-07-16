@extends('layouts.app')

@section('content')
<main class="settings-page">

    <div class="settings-breadcrumb">
        <a href="{{ route('home') }}">Inicio</a>
        <span>›</span>
        <span>Configuración</span>
    </div>

    <div class="settings-container">

        <header class="settings-heading">
            <h1>Configuración</h1>
            <p>Administra tu cuenta y preferencias</p>
        </header>

        @if (session('success'))
            <div class="settings-alert settings-alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="settings-alert settings-alert-error">
                <strong>No se pudieron guardar los cambios.</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="settings-card">

            <div class="settings-card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#5ee7ef" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>

                <h2>Información de la cuenta</h2>
            </div>

            <form action="{{ route('profile.settings.update') }}" method="POST" class="settings-form">
                @csrf
                @method('PATCH')

                <div class="settings-field">
                    <label for="username">Nombre de usuario</label>

                    <input type="text" id="username" name="username" value="{{ old('username', auth()->user()->username) }}" maxlength="30" placeholder="Escribe un nombre de usuario" autocomplete="username">

                    <small>
                        Si no agregas uno, se mostrará tu correo electrónico.
                    </small>
                </div>

                <div class="settings-field">
                    <label for="email">Correo electrónico</label>

                    <input type="email" id="email" value="{{ auth()->user()->usuario }}" disabled>

                    <small>
                        El correo electrónico no puede modificarse desde esta sección.
                    </small>
                </div>

                <div>
                    <button type="submit" class="settings-primary-button">
                        Guardar cambios
                    </button>
                </div>
            </form>

        </section>

        {{-- Seguridad --}}
        <section class="settings-card">

            <div class="settings-card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#5ee7ef" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 13c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V5l8-3 8 3z"/>
                </svg>

                <h2>Seguridad</h2>
            </div>

            <div class="settings-security-content">

                <div class="settings-security-item">

                    <div class="settings-security-information">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#617678" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>

                        <div>
                            <h3>Contraseña</h3>
                            <p>
                                Cambia tu contraseña mediante una verificación por correo.
                            </p>
                        </div>
                    </div>

                    <a href="{{ url('/forgot-password') }}" class="settings-secondary-button" >
                        Cambiar
                    </a>
                </div>

                <div class="settings-security-item">

                    <div class="settings-security-information">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#617678" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 13c0 5-3.5 7.5-8 9-4.5-1.5-8-4-8-9V5l8-3 8 3z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>

                        <div>
                            <h3>Verificación en dos pasos</h3>
                            <p>
                                La verificación por código está integrada al inicio de sesión.
                            </p>
                        </div>
                    </div>

                    <span class="settings-status">
                        Activa
                    </span>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection