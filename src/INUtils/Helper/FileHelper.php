<?php
namespace INUtils\Helper;

class FileHelper
{
    const UPLOAD_DIR = "/wp-content/uploads/";

    /**
     *
     * @param string $uploaddir
     * @param string $fileInputName
     * @return array
     */
    public static function uploadFile($fileInputName)
    {
        if(isset($_FILES) && $_FILES[$fileInputName]["name"] != ""){

            $uploaddir = __DIR__."/../../../../../../../../uploads/";
            $uniqueId = uniqid();

            $fileName = $uniqueId . "-" . $_FILES[$fileInputName]['name'];
            $uploadfile = $uploaddir . $fileName;
            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $uploadfile)) {
                return array(
                    "fileUrl" => self::UPLOAD_DIR.$fileName,
                    "fileName" => $fileName,
                    "fileSize" => $_FILES[$fileInputName]['size']
                    );
            }
            else {
                throw new \Exception("Error trying to upload a file");
            }
        }
    }
}