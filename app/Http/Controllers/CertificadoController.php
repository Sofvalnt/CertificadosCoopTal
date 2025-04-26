<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class CertificadoController extends Controller
{
    public function generarCertificado(Request $request)
    {
        $nombre = $request->input('nombre');
        $curso = $request->input('curso');
        $fecha = $request->input('fecha');
        $tipo = $request->input('tipo');

        // Generar un identificador único para el QR
        $codigo = substr(md5(uniqid()), 0, 8);

        // Generar el QR como imagen usando endroid/qr-code
        $qrData = route('verificar', ['codigo' => $codigo]);
        $qrCode = QrCode::create($qrData)->setSize(150)->setMargin(10);
        $writer = new PngWriter();
        $qrResult = $writer->write($qrCode);
        $qrImage = Image::make($qrResult->getString());

        // Cargar plantilla según tipo
        $plantilla = public_path("plantillas/$tipo.png");

        if (!file_exists($plantilla)) {
            return response()->json(['error' => 'Plantilla no encontrada'], 404);
        }

        try {
            $img = Image::make($plantilla);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo cargar la plantilla',
                'detalle' => $e->getMessage()
            ], 500);
        }

        // Insertar textos
        $img->text($nombre, 1000, 1100, function ($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(60);
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        $img->text($curso, 1000, 1200, function ($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(50);
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        $img->text($fecha, 1000, 1300, function ($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(40);
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        // Insertar QR en la esquina inferior derecha
        $img->insert($qrImage, 'bottom-right', 50, 50);

        // Guardar la imagen temporalmente
        $nombreArchivo = 'certificado_' . time() . '.png';
        $ruta = public_path('certificados/' . $nombreArchivo);
        $img->save($ruta);

        return response()->download($ruta)->deleteFileAfterSend(true);
    }
}
