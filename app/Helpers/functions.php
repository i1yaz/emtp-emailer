<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
/* @function attachmentUpload()  @version v1.0  @since 1.0 */

if (!function_exists('attachmentUpload')) {
    function attachmentUpload($request)
    {

        $files = [];
        if ($request->has('attachments')) {
            //Year in YYYY format.
            $year = date("Y");

            //Month in mm format, with leading zeros.
            $month = date("m");

            //Day in dd format, with leading zeros.
            $day = date("d");
            //The folder path for our file should be YYYY/MM/DD
            $directory = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR) . $year . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR . $day . DIRECTORY_SEPARATOR;
            //If the directory doesn't already exists.
            if (!is_dir($directory)) {
                //Create our directory.
                mkdir($directory, 755, true);
            }

            foreach ($request->file('attachments') as $attachment) {
                $extension = $attachment->getClientOriginalExtension();
                $random = Str::random(20);
                $path = Storage::putFileAs("public/$year/$month/$day", $attachment, $random . "." . $extension);
                $path = Storage::url($path);
                $files[] = url($path);
            }
        }
        return $files;
    }
}

/* @function bodyImageUpload()  @version v1.0  @since 1.0 */
if (!function_exists('bodyImageUpload')) {
    function bodyImageUpload($content)
    {
        try {
            $dom = new \DomDocument();
            $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('imageFile');

            foreach ($imageFile as $item => $image) {
                $data = $image->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $image_name = "/upload/" . time() . $item . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $imgeData);

                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }

            return $dom->saveHTML();
        } catch (\Throwable $th) {
            return $content;
        }
        return $content;
    }
}
