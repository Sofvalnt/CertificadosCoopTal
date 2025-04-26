@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-red-50 p-6">
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-lg w-full">
        <h1 class="text-3xl font-bold text-red-600 mb-4 text-center">❌ Diploma No Válido</h1>

        <p class="text-lg text-gray-700 mb-6 text-center">
            El código proporcionado no está asociado a un diploma registrado.
        </p>

        <div class="mt-6 text-center">
            <a href="{{ url('/') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                Volver al inicio
            </a>
        </div>
    </div>
</div>
@endsection
