<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroDiploma; // Asegúrate de importar el modelo

class RegistroDiplomaController extends Controller
{
    public function procesarCsv(Request $request)
    {
        // Validar que el archivo sea un CSV
        $request->validate([
            'archivo_csv' => 'required|mimes:csv,txt',
        ]);

        // Obtener el archivo cargado
        $archivoCsv = $request->file('archivo_csv');

        // Definir la ruta donde se guardará temporalmente el archivo
        $rutaArchivoCsv = $archivoCsv->getRealPath();

        $cantidadDiplomas = 0;
        $nombreDelCurso = null;

        if (($handle = fopen($rutaArchivoCsv, "r")) !== false) {
            $primeraLinea = true;
            while (($datos = fgetcsv($handle, 1000, ",")) !== false) {
                if ($primeraLinea) {
                    $primeraLinea = false;
                    continue; // Saltar encabezado
                }

                $nombreAlumno = $datos[0];
                $nombreDelCurso = $datos[1]; // Aquí asumiendo que en columna 1 viene el curso

                // Aquí generas tu diploma normalmente...

                $cantidadDiplomas++;
            }
            fclose($handle);
        }

        // Guardar el registro en la base de datos
        RegistroDiploma::create([
            'cantidad_generados' => $cantidadDiplomas,
            'curso' => $nombreDelCurso,
        ]);

        // Retornar una respuesta indicando que todo se procesó correctamente
        return back()->with('success', 'Archivo procesado correctamente y cantidad de diplomas registrada.');
    }
}
