<?php

namespace INUtils\Helper;

class TextHelper {

    /**
     *
     * @param string $text
     * @return string
     */
    public static function cropText($text, $textSize = 150) {
		$textToReturn = $text;
		$textToReturn = self::avoidHtmlTags($textToReturn);
// 		$textToReturn = self::avoidImages($textToReturn);
//         $textToReturn = self::avoidAnchors($textToReturn);
//         $textToReturn = self::avoidIFrame($textToReturn);
//         $textToReturn = self::avoidAnchors2($textToReturn);
//         $textToReturn = self::avoidGalleryIds($textToReturn);
//         $textToReturn = self::avoidImage($textToReturn);


        if ($textSize != null && strlen($textToReturn) > $textSize) {
            $textToReturn = substr($textToReturn, 0, $textSize) . "...";
        }
        return $textToReturn;
    }

    /**
     *
     * @param string $fileSize
     * @return string
     */
    public static function formatFileSize($fileSize) {
        return number_format($fileSize / 1024, 0);
    }

    /**
     *
     * @param string $text
     * @return mixed
     */
    public static function formatSpaces($text) {
    	$text = str_replace(":", "\:", $text);
    	$text = str_replace(" ", "\ ", $text);
    	return $text;
    }

    /**
     *
     * @param  string $text
     * @return string
     */
    public static function avoidImage($text) {
        $contents = explode("<img ", $text);
        if (count($contents) == 1) {
            return $text;
        } else {
            if (strlen($contents[0]) > 10) {
                return $contents[0];
            }
            else{
              $src_contents = explode("</a>", $contents[1]);
              if(strlen($src_contents[1]) > 10){
                return $src_contents[1];
              }
            }
            return $contents[0];
        }
    }

    /**
     * Return the video url
     *
     * @param  string $videoUrl
     * @return string The video required url to be used in a iframe element src property
     */
    public static function getEmbedVideoUrl($videoUrl){
       // Process vimeo and youtube videos
        if(strpos($videoUrl , "vimeo") !== FALSE){
            $tmp = explode("/", $videoUrl );
            $values = array_values($tmp);
            $src = "//player.vimeo.com/video/" . end( $values );
            return $src;
        }
        else if(strpos($videoUrl , "youtube") !== FALSE){
            $tmp = explode("=", $videoUrl );
            $values = array_values($tmp);
            $src = "//www.youtube.com/embed/" . end($values)."?modestbranding=1&autohide=1&showinfo=0&controls=0";
            return $src;
        }

        return $videoUrl;
    }

    /**
     *
     * @param string $postContent
     * @return NULL|string
     */
    public static function getImage($postContent) {
    	$contents = explode("<img", $postContent);
    	if (count($contents) == 1) {
    		return null;
    	} else {
    		$src_contents = explode("src=\"", $contents[1]);
    		$image_src = explode("\"", $src_contents[1]);
    		return $image_src[0];
    	}
    }

    /**
     *
     * @param string $postContent
     * @return string
     */
    public static function avoidAnchors($postContent){
    	$contents = explode("<a", $postContent);
    	if (count($contents) == 1) {
    		return $contents[0];
    	} else {
    		$srcContents = explode("</a>", $contents[1]);
    		if(isset($srcContents[1])){
    			return $contents[0]." ".$srcContents[1];
    		}
    		else{
    			return $contents[0];
    		}
    	}
    }


    /**
     * Remove iframe elements from a string
     *
     * @param  string $text
     * @return string Data without iframe tags
     */
    public static function avoidIFrame($text) {
        $newText = preg_replace('/<iframe.*?\/iframe>/i','', $text);
        $newText = preg_replace('/<iframe.*?\/>/i'      ,'', $newText);
        return $newText;

    }

     /**
     * Remove image elements from a string
     *
     * @param  string $text
     * @return string Data without image tags
     */
    public static function avoidImages($text) {
        $newText = preg_replace('/<image.*?\/image>/i','', $text);
        $newText = preg_replace('/<image.*?\/>/i'     ,'', $newText);
        return $newText;

    }

    /**
     * Remove anchors elements from a string
     *
     * @param  string $text
     * @return string Data without anchor tags
     */
    public static function avoidAnchors2($text) {
        $newText = preg_replace('/<a.*?\/a>/i','', $text);
        $newText = preg_replace('/<a.*?\/>/i' ,'', $newText);
        return $newText;

    }

    /**
     * Remove gallery ids elements from a string
     *
     * @param  string $text
     * @return string Data without anchor gallery ids
     */
    public static function avoidGalleryIds($text) {

    	$newText = preg_replace('/\[gallery.+ids=[\'"](.+?)[\'"]\]/', '', $text);
    	return $newText;

    }

    /**
     *
     * @param string $imagemapper
     * @return string
     */
    public static function getImageFromImageMapper($imagemapper){
    	$settings = "";
        if(isset($imagemapper->settings)){
            foreach(explode('||',$imagemapper->settings) as $val)
            {
                if (substr($val, strpos($val, '-')) != 'dummy')
                {
                    $expl = explode('::',$val);
                    $settings[$expl[0]] = $expl[1];
                }
            }
            return $settings['map-image'];
        }
    	else{
            return "";
        }
    }

    /**
     *
     * @param string $imagemapper
     * @return string
     */
    public static function getImageFromImageMapperId($imagemapperId){
        global $wpdb;
        $imagemappers = $wpdb->
            get_results('SELECT * FROM ' . $wpdb->base_prefix . 'image_mapper WHERE id = "'.$imagemapperId.'"');

        if(!isset($imagemappers[0])){
            return null;
        }
        $imagemapper = $imagemappers[0];

        $settings = "";
        if(isset($imagemapper->settings)){
            foreach(explode('||',$imagemapper->settings) as $val)
            {
                if (substr($val, strpos($val, '-')) != 'dummy')
                {
                    $expl = explode('::',$val);
                    $settings[$expl[0]] = $expl[1];
                }
            }
            return $settings['map-image'];
        }
        else{
            return "";
        }
    }

    /**
     *
     * @return string
     */
    public static function getPostIdByPermalinkFromPrevUrl(){
        $prevUrl = $_SERVER['HTTP_REFERER'];
        $prevPostId = url_to_postid($prevUrl);
        return $prevPostId;
    }

    /**
     *
     * @param string $text
     * @return string
     */
    public static function avoidHtmlTags($text){
        return strip_tags($text);
    }


    /**
     *
     * @param string $fileName
     * @return string
     */
    public static function getFileNameFromUniqueId($fileName){
        $fileNameWithOutUniqueIdArray = explode("-", $fileName);
        $filteredFileName = "";
        for($i = 1; $i < count($fileNameWithOutUniqueIdArray); $i++){
            $filteredFileName .= $fileNameWithOutUniqueIdArray[$i];
        }

        return $filteredFileName;
    }

    /**
     *
     * @param string $url
     * @return string
     */
    public static function getUrlWithOutQueries($url){
        $urls = explode("?", $url);
        return $urls[0];
    }

    /**
     *
     * @param string $text
     * @return string
     */
    public static function camelCaseToUnderscoreCase($text){
        $text = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $text));
        return $text;
    }

}
