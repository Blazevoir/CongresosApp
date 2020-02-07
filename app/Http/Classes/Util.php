<?php

namespace App\Http\Classes;

use Illuminate\Http\Request;

class Util {
    
    static function deleteRepeatedFiles(string $name, string $extension, string $target = '.') {
        $deleted = 0;
        $search = $target . $name . '.*';
        $files = glob($search);
        foreach ($files as $file) {
            if (basename($file) != $name . '.' . $extension) {
                if(unlink($file)) {
                    $deleted++;
                }
            }
        }
        return $deleted;
    }

    static function uploadImage(string $name, string $fileParam, Request $request, string $target = '.') {
        $result = null;
        if($request->hasFile($fileParam) && $request->file($fileParam)->isValid()) {
            $file = $request->file($fileParam);
            $fileName = $name . '.' . $file->getClientOriginalExtension();
            if($file->move($target, $fileName)) {
                $result = $fileName;
            }
        }
        return $result;
    }
}

?>