@extends('layouts.app')
@section('title', 'Reestablecer contraseña')
@section('content')

<div class="ctnerlogin">
    <div class="cform-l">
        <div class="login-form-login">
            <div class="icon-user-l">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                    stroke="#1D3638" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-key">
                    <path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4" />
                    <path d="m21 2-9.6 9.6" />
                    <circle cx="7.5" cy="15.5" r="5.5" />
                </svg>
            </div>
            @if(!session('otp_verified'))
            <h2 class="text-t-lg">Verificación de Seguridad</h2>
            <p class="text-s-l">Se te enviará un código de verificación por correo</p>

            <form id="forgotForm" class="login-f" method="POST" action="/forgot-password">
                @csrf
                <div class="inps-ctner-login">
                    <div class="ip-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-mail icnl">
                            <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                        </svg>
                        <input class="input-lg" type="email" name="usuario" placeholder="Correo electrónico" required>
                    </div>
                </div>

                <button type="submit" class="btn-blue-lg">
                    <div class="icon-btnb-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="#324C4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-send">
                            <line x1="22" y1="2" x2="11" y2="13" />
                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                        </svg>
                    </div>
                    <span class="text-btnb-l">Enviar código</span>
                </button>
            </form>

            @else
            <h2 class="text-t-lg">Restablecer contraseña</h2>
            <p class="text-s-l">Ingresa tu nueva contraseña</p>

            <form method="POST" action="/reset-password" class="login-f">
                <div class="inps-ctner-login">
                    @csrf
                    <div class="ip-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-lock-icon lucide-lock icnl">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>

                        <input class="input-lg" type="password" name="password" placeholder="Nueva contraseña"
                            minlength="6" maxlength="20" required>
                    </div>
                    @error('password')
                    <div class="text-danger error-message">{{ $message }}</div>
                    @enderror

                    <div class="ip-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-lock-icon lucide-lock icnl">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>

                        <input class="input-lg" type="password" name="password_confirmation"
                            placeholder="Confirmar contraseña" minlength="6" maxlength="20" required>
                    </div>

                    @error('password_confirmation')

                    <div class="text-danger error-message">{{ $message }}</div>

                    @enderror

                    <button type="submit" class="btn-blue-lg">
                        <div class="icon-btnb-lg">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#324C4D" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </div>
                        <span class="text-btnb-l">Cambiar contraseña</span>
                    </button>
                </div>
            </form>
            @endif

            <div class="separator-login">
                <hr>
            </div>

            <a href="/login" class="button-cc">
                <span>Volver al inicio de sesión</span>
            </a>
        </div>
    </div>
</div>
@endsection