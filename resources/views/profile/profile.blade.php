@extends('layouts.app')
@section('title', 'Mi perfil')
@section('content')

@auth
<div class="bg-slate-50 mt-16 md:mt-20 pb-16">
    <!-- BREADCRUMBS -->
    <div class="breadcrumbs bg-white">
        <a href="{{ route('home') }}">Inicio</a>
        <span>></span>
        <span class="txtforobc">Mi perfil</span>
    </div>

    <!-- Contenedor del perfil -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Tarjeta Principal Unificada -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- Primera sección: Banner con Gradiente y Foto de Perfil -->
            <div class="bg-gradient-to-r from-[#79EFF7] to-[#87C8CD] w-full flex items-center gap-6 px-8 py-10">
                <!-- Imagen de perfil -->
                <img src="{{ auth()->user()->avatar_url }}"
                    alt="Imagen de {{ auth()->user()->usuario }}"
                    class="h-24 w-24 rounded-full border-4 border-white shadow-lg object-cover" />

                <div class="text-white">
                    <h1 class="text-3xl font-bold leading-tight">{{ auth()->user()->username }}</h1>
                    <p class="text-[#183133]/80 mt-1 font-medium">Miembro de la comunidad</p>
                </div>
            </div>

            <!-- Segunda sección: Información Personal (Ahora dentro de la misma tarjeta) -->
            <div class="flex flex-col px-8 py-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Información Personal</h2>

                <div class="space-y-4">
                    <!-- Nombre de usuario -->
                    <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-lg">
                        <div class="h-5 w-5 mt-0.5 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#617678" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path d="M17.925 20.056a6 6 0 0 0-11.851.001" />
                                <circle cx="12" cy="11" r="4" />
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre de usuario</p>
                            <p class="text-base text-gray-900 mt-0.5 font-medium">{{ auth()->user()->username }}</p>
                        </div>
                    </div>

                    <!-- Correo electrónico -->
                    <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-lg">
                        <div class="h-5 w-5 mt-0.5 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#617678" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Correo electrónico</p>
                            <p class="text-base text-gray-900 mt-0.5 font-medium">{{ auth()->user()->usuario }}</p>
                        </div>
                    </div>

                    <!-- Miembro desde -->
                    <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-lg">
                        <div class="h-5 w-5 mt-0.5 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#617678" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path d="M8 2v4" />
                                <path d="M16 2v4" />
                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                <path d="M3 10h18" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Miembro desde</p>
                            <p class="text-base text-gray-900 mt-0.5 font-medium">{{ auth()->user()->created_at?->isoFormat('D [de] MMMM [de] YYYY') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 border-t border-gray-100 overflow-hidden">
                <div class="flex flex-col px-8 py-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Actividad en el Foro</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white p-2 rounded-lg border border-gray-200">
                            <p class="text-2xl font-bold text-[#79EFF7]">{{ $publicaciones }}</p>
                            <p class="text-sm text-gray-600 mt-1">Publicaciones</p>
                        </div>
                        <div class="bg-white p-2 rounded-lg border border-gray-200">
                            <p class="text-2xl font-bold text-[#79EFF7]">{{ $publicaciones }}</p>
                            <p class="text-sm text-gray-600 mt-1">Comentarios</p>
                        </div>
                        <div class="bg-white p-2 rounded-lg border border-gray-200">
                            <p class="text-2xl font-bold text-[#79EFF7]">{{ $meGustaRecibidos }}</p>
                            <p class="text-sm text-gray-600 mt-1">Me gusta recibidos</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    @endauth
    @endsection