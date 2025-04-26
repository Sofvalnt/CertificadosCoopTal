<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use App\Models\Verificacion;

class DiplomaController extends Controller
{
    public function generarQR(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
        ]);

        $nombre = $request->input('nombre');
        $nombreCurso = $request->input('curso');

        // Generar un código único
        $codigo = Str::random(40);

        // Guardar en la base de datos
        $verificacion = Verificacion::create([
            'codigo' => $codigo,
            'nombre_estudiante' => $nombre,
            'nombre_curso' => $nombreCurso,
        ]);

        // Crear la URL de verificación
        $urlVerificacion = url('/verificar/' . $codigo);

        // Generar el código QR
        $qr = Builder::create()
            ->data($urlVerificacion)
            ->size(300)  // Aumenté el tamaño para mejor legibilidad
            ->margin(15)
            ->build();

        // Devolver respuesta JSON con los datos
        return response()->json([
            'success' => true,
            'qr' => $qr->getDataUri(),
            'codigo' => $codigo,
            'datos' => [
                'nombre' => $nombre,
                'curso' => $nombreCurso,
                'fecha' => $verificacion->created_at->format('d/m/Y')
            ]
        ]);
    }

    public function verificar($codigo)
    {
        $verificacion = Verificacion::where('codigo', $codigo)->first();

        if ($verificacion) {
            return view('verificacion.valida', [
                'verificacion' => $verificacion,
                'valido' => true,
                'fecha' => $verificacion->created_at->format('d/m/Y H:i:s')
            ]);
        }

        return view('verificacion.invalida', [
            'valido' => false,
            'mensaje' => 'El código de verificación no existe o ha expirado'
        ]);
    }
}