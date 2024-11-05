<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImageController extends Controller
{
  /**
   * Retrieve and return the image by name.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  string  $imageName
   * @return \Illuminate\Http\Response
   */
  public function show($imageName)
  {
    // Obtener todos los archivos en el directorio 'storage/app/public'
    $files = Storage::allFiles('public');

    // Buscar el archivo que coincida con el nombre de la imagen
    $filePath = null;
    foreach ($files as $file) {
      if (basename($file) === $imageName) {
        $filePath = $file;
        break;
      }
    }

    // Si no se encuentra el archivo, devolver el assets/img/default.png
    // Si no se encuentra el archivo, devolver la imagen predeterminada desde 'public/assets/img/default.png'
    if (!$filePath) {
      $defaultPath = public_path('assets/img/default.jpg');

      // Verificar si el archivo predeterminado existe
      if (!file_exists($defaultPath)) {
        abort(404, 'Imagen predeterminada no encontrada');
      }

      // Devolver la imagen predeterminada como una respuesta de flujo
      return new StreamedResponse(function () use ($defaultPath) {
        $stream = fopen($defaultPath, 'rb');
        fpassthru($stream);
        fclose($stream);
      }, 200, [
        'Content-Type' => mime_content_type($defaultPath),
        'Content-Length' => filesize($defaultPath),
        'Content-Disposition' => 'inline; filename="' . basename($defaultPath) . '"',
      ]);
    }

    // Devolver la imagen como una respuesta de flujo
    return new StreamedResponse(function () use ($filePath) {
      $stream = Storage::readStream($filePath);
      fpassthru($stream);
    }, 200, [
      'Content-Type' => Storage::mimeType($filePath),
      'Content-Length' => Storage::size($filePath),
      'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
    ]);
  }
}
