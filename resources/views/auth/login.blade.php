@extends('layouts.app')
@section('title', 'Login')
@section('content')

<div class="ctnerlogin">
    <div class="cform-l">
        <div class="login-form-login">
            <div class="icon-user-l">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <h2 class="text-t-lg">Bienvenido de nuevo</h2>
            <p class="text-s-l">Accede a tu cuenta para participar en el foro</p>

            <form id="loginForm" class="login-f" method="POST" action="/login">
                @csrf
                <div class="inps-ctner-login">
                    <div class="ip-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail icnl"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                        <input class="input-lg" type="email" name="email" placeholder="Correo electrónico" maxlength="50" required>
                    </div>
                    <div class="ip-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock icnl"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input class="input-lg" type="password" name="password" placeholder="Contraseña" minlength="6" maxlength="20" required>
                    </div>
                </div>
                <!-- Mensaje de error -->
                <div id="loginMessage" class="text-danger error-message"></div>
                <a href="/forgot-password" class="text-s-l bold-lg">¿Olvidaste tu contraseña?</a>
                
                <button type="submit" class="btn-blue-lg">
                    <div class="icon-btnb-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#324C4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <span class="text-btnb-l">Iniciar Sesión</span>
                </button>

                <div class="separator-login">
                    <hr>
                    <span class="text-s-l">¿No tienes una cuenta?</span>
                    <hr>
                </div>

                <button type="button" class="button-cc" onclick="window.location.href='/registro'">
                    <span>Crear una cuenta nueva</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#656E7B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>

            </form>

        </div>
    </div>
</div>