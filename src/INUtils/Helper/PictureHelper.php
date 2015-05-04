<?php

namespace INUtils\Helper;

class PictureHelper
{
    const PERCENT = 25;
    const PATH = "/thumbnails/";
    const PATH_TO_HERE = "/wp-content/plugins/in_utils/Helper";

    public static function getThumbnail($url, $size = 25) {

        $fileName = self::getImageName($url);
        if(exif_imagetype($url) != IMAGETYPE_JPEG){
            list($widthOrig, $heightOrig) = getimagesize($url);

            if($heightOrig > 840){
                $width = ceil($widthOrig*$size/100);
                $height = ceil($heightOrig*$size/100);

                // This resamples the image
                $imageR = \imagecreatetruecolor($width, $height);
                $image = \imagecreatefromjpeg($url);
                \imagecopyresampled($imageR, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);

                $destinationPath = __DIR__.self::PATH.$fileName;
                if(!file_exists($destinationPath)){
                    imagejpeg($imageR, $destinationPath);
                }
                return self::PATH_TO_HERE.self::PATH.$fileName;
            }
            else{
                return $url;
            }
        }
        else{
            return $url;
        }
    }

    public static function getImageName($url){
        $urlPaths = explode("/", $url);
        return $urlPaths[count($urlPaths)-1];
    }
}