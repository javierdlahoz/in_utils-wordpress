<?php
namespace INUtils\Service;

class PostService extends WPPostService
{
    const ENTITY_CLASS = "INUtils\Entity\PostEntity";
    
    protected function init()
    {
        $this->setEntityClass(self::ENTITY_CLASS);
    }
}