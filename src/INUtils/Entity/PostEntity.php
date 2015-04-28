<?php
namespace INUtils\Entity;

class PostEntity extends WPPostEntity
{
    const VIDEO = "video";
    
    /**
     * 
     * @var string
     */
    private $video;
    
    /**
     * @return the $video
     */
    public function getVideo()
    {
        return $this->getMetaField(self::VIDEO);
    }

    /**
     * @param string $video
     */
    public function setVideo($video)
    {
        $this->setMetaField(self::VIDEO, $video);
    }
    
}