@extends('layouts.app')
@section('title', 'Mi perfil')
@section('content')

@auth
<div class="bg-slate-50 mt-16 md:mt-20 mb-16">
    <!-- BREADCRUMBS -->
    <nav class="breadcrumbs">
        <a href="{{ route('home') }}">Inicio</a>
        <span>></span>
        <span class="txtforobc">Mi perfil</span>
    </nav>

    <!-- Contenedor del perfil -->
    <div class="bg-red-600 max-w-5xl w-full mx-auto rounded-lg overflow-hidden shadow">


        <!-- primer seccion, cuadro de imagen -->
        <div class="bg-gradient-to-r from-[#79EFF7] to-[#87C8CD] w-full flex justify-center items-center py-12">
            hola
        </div>
        <div class="bg-white">
            <p class="">Información Personal</p>
            <div class="bg-gray-50">
                <p class="">Correo electrónico</p>
                <p class="">{{auth()->user()->usuario }}</p>
                <p class="">Miembro desde</p>
                <p class="">{{ auth()->user()->created_at }}</p>
            </div>
        </div>
    </div>
</div>
@endauth