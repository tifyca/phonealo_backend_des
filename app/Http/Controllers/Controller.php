<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Aws\S3\S3Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveFile($file, $path)
    {
        $fileName = "";
        if ($file) {
            $foto = json_decode($file);
	       /* list(, $extension) = explode('/', $foto->output->type);
            $fileName = (string)(date("YmdHis")) . (string)(rand(1, 9)) . (string)(rand(1, 9)) . '.' . $extension;
            $picture = $foto->output->image;
            $filepath = $path . $fileName;

            $s3 = S3Client::factory(config('app.s3'));

            $s3->putObject(array(
                'Bucket' => config('app.s3_bucket'),
                'Key' => $filepath,
                'SourceFile' => $picture,
                'ContentType' => 'image',
                'ACL' => 'public-read',
            ));*/

            $extension = $foto->output->type == 'image/png' ? '.png' : '.jpg';
            $fileName = (string)(date("YmdHis")) . (string)(rand(1, 9)) . (string)(rand(1, 9)) . $extension;
            $picture = $foto->output->image;
            $filepath = $path . $fileName;

            if ($foto->input->type == 'image/gif') {
                $path = $foto->input->name;
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $picture = 'data:image/' . $extension . ';base64,' . base64_encode($data);
                $fileName = (string)(date("YmdHis")) . (string)(rand(1, 9)) . (string)(rand(1, 9)) . $extension;
            }

            $s3 = S3Client::factory(config('app.s3'));

            $s3->putObject(array(
                'Bucket' => config('app.s3_bucket'),
                'Key' => $filepath,
                'SourceFile' => $picture,
                'ContentType' => 'image',
                'ACL' => 'public-read',
            ));
        


        }

        return $fileName;
    }
    public function saveFileApi($file, $path)
    {
    	$fileName='';
        if ($file) {
	        list($tipo, $Base64Img) = explode(';', $file);
	        //$extensio = $tipo == 'data:image/png' ? '.png' : '.jpg';
	        list(, $extension) = explode('/', $tipo);
	        $fileName = (string)(date("YmdHis")) . (string)(rand(1, 9)) . (string)(rand(1, 9)) . '.' . $extension;
	        $filepath = $path . $fileName;
//dd($file);
	        $s3 = S3Client::factory(config('app.s3'));
	        $result = $s3->putObject(array(
	            'Bucket' => config('app.s3_bucket'),
	            'Key' => $filepath,
	            'SourceFile' => $file,
	            'ContentType' => 'image',
	            'ACL' => 'public-read',
	        ));
	    }
        return $fileName;
    }

    public function deleteFile($file, $path)
    {
        try {
            if($file<>''){
                $s3 = S3Client::factory(config('app.s3'));

                $result = $s3->deleteObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $path . $file
                ));
            }
        } catch (Exception $e) {
            \Log::info('Error creating item: ' . $e);
        }
    }

}
