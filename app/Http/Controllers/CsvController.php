<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroDiploma; // Asegúrate de que el modelo esté importado

class CsvController extends Controller
{
    public function cargarCsv(Request $request)
    {
        // Validar que el archivo sea un CSV
        $request->validate([
            'archivo_csv' => 'required|mimes:csv,txt',
        ]);

        // Obtener el archivo cargado
        $archivoCsv = $request->file('archivo_csv');

        // Obtener la ruta del archivo cargado
        $rutaArchivoCsv = $archivoCsv->getRealPath();

        // Inicializar variables para contar los diplomas
        $cantidadDiplomas = 0;
        $nombreDelCurso = null;

        // Procesar el archivo CSV
        if (($handle = fopen($rutaArchivoCsv, "r")) !== false) {
            $primeraLinea = true;
            while (($datos = fgetcsv($handle, 1000, ",")) !== false) {
                if ($primeraLinea) {
                    $primeraLinea = false;
                    continue; // Saltar encabezado
                }

                // Asumiendo que el nombre del alumno está en la columna 0 y el curso en la columna 1
                $nombreAlumno = $datos[0];
                $nombreDelCurso = $datos[1]; // Aquí se obtiene el nombre del curso desde la columna 1

                // Aquí es donde generas el diploma para cada alumno. Si tienes la lógica para generar el diploma, añádela aquí.

                // Incrementar la cantidad de diplomas generados
                $cantidadDiplomas++;
            }
            fclose($handle);
        }

        // Guardar el registro de la cantidad de diplomas generados y el nombre del curso
        RegistroDiploma::create([
            'cantidad_generados' => $cantidadDiplomas,
            'curso' => $nombreDelCurso,
        ]);

        // Redirigir de vuelta con un mensaje de éxito
        return back()->with('success', 'Archivo procesado correctamente. Se generaron ' . $cantidadDiplomas . ' diplomas para el curso "' . $nombreDelCurso . '".');
    }
}
