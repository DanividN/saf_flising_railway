<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

function mover_archivos($request, $lista_archivo, $old_data,$ruta)
{
    $files = [];

    // Recorre cada campo en la lista de archivos
    foreach ($lista_archivo as $index => $field) {
        // Usa el nombre de campo personalizado si se ha proporcionado
        $actualFieldName = $fieldNames[$index] ?? $field;

        // Verifica si el request contiene un archivo para ese campo
        if ($request->hasFile($field)) {
            // Elimina el archivo antiguo si existe
            if ($old_data && isset($old_data[$actualFieldName]) && Storage::exists($old_data[$actualFieldName])) {
                Storage::delete($old_data[$actualFieldName]);
            }

            // Obtén el archivo del request
            $file = $request->file($field);
            $ldate = date('Ymd_His_');
            // Genera el nombre del archivo
            $filename = $ldate.$file->getClientOriginalName();

            // Construye la ruta completa en storage/app/public
            $filePath = "{$ruta}/{$filename}";

            // Usa Storage::disk('local')->put() para almacenar el archivo
            Storage::disk('public')->put($filePath, File::get($file));

            // Guarda la ruta del archivo en el array usando el nombre de campo
            $files[$actualFieldName] = $filePath;
        } elseif ($old_data && isset($old_data[$actualFieldName])) {
            // Si no hay un nuevo archivo, conserva la ruta del archivo antiguo
            $files[$actualFieldName] = $old_data[$actualFieldName];
        }
    }

    return $files;
}
