<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\File;
use Illuminate\Support\Facades\Storage;

class FileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function save($file, $modelo,  $folder = 'default', $disk = 'public')
    {
        $hash = Storage::disk($disk)->putFile($folder, $file);

        $result = $modelo->files()->create([
                    'original' => $file->getClientOriginalName(),
                    'hash' => $hash,
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getClientSize(),
                    'key' => uniqid(),
                    'disk' => $disk
                ]);

        return $result;
    }

    public static function getUrl($file_id)
    {
        $file = File::find($file_id);

        return url("/file/" . $file->key);
    }

    public static function getPath($key)
    {
        $file = File::where("key",$key)->first();
        $url = Storage::disk($file->disk)->getDriver()->getAdapter()->applyPathPrefix($file->hash);
        return $url;
    }

    public static function delete($file_id)
    {
        
        $old_file = File::find($file_id);
        
        if(strpos($old_file->key, 'default')!==false){
            return false;
        }
        //Lo borramos del servidor
        Storage::disk($old_file->disk)->delete($old_file->hash);
        //Lo borramos de la base de datos
        if ($old_file->delete()) {
            return true;
        }
        else{
            return false;
        }
    }
}
