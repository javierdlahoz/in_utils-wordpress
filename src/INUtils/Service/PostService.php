<?php
namespace INUtils\Service;

class PostService extends WPPostService
{
    const ENTITY_CLASS = "INUtils\Entity\PostEntity";
    const LIMIT_RECENT_POSTS = 5;
    
    protected function init()
    {
        $this->setEntityClass(self::ENTITY_CLASS);
    }
    
    /**
     * 
     * @return multitype:\INUtils\Entity\WPPostInterface
     */
    public function getRecentPosts(){
        $this->setPostsPerPage(self::LIMIT_RECENT_POSTS);
        return $this->getPosts();
    }
}