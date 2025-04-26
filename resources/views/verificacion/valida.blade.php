@extends('layouts.app') {{-- Usa tu layout si tienes uno --}}

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-green-50 p-6">
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-lg w-full">
        <h1 class="text-3xl font-bold text-green-600 mb-4 text-center">✅ Diploma Válido</h1>

        <p class="text-lg text-gray-700 mb-4 text-center">
            Este diploma pertenece a <span class="font-semibold text-green-700">{{ $verificacion->nombre_estudiante }}</span>
            y corresponde al curso <span class="font-semibold text-green-700">{{ $verificacion->nombre_curso }}</span>.
        </p>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">Código de verificación:</p>
            <p class="text-sm font-mono text-gray-700">{{ $verificacion->codigo }}</p>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                Volver al inicio
            </a>
        </div>
    </div>
</div>
@endsection
