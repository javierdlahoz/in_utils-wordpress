<?php

namespace INUtils\Controller;

use INUtils\Entity\PostEntity;
class PostController extends AbstractController{
    
    public function save($postId){
        if(isset($_POST[PostEntity::VIDEO])){
            $postEntity = new PostEntity($postId);
            $postEntity->setVideo($_POST[PostEntity::VIDEO]);
        }
    }
}