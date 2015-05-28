<?php

namespace INUtils\Controller;

use INUtils\Entity\PostEntity;
use INUtils\Service\PostService;

class PostController extends AbstractController{

    public function save($postId){
        if(isset($_POST[PostEntity::VIDEO])){
            $postEntity = new PostEntity($postId);
            $postEntity->setVideo($_POST[PostEntity::VIDEO]);
        }
    }

    /**
     *
     * @return array
     */
    public function searchAction(){
        if(isset($_POST["query"])){
            $query = $_POST["query"];
        }
        else{
            $query = "";
        }

        if(isset($_POST["paged"])){
            $paged = $_POST["paged"];
        }
        else{
            $paged = 1;
        }
        
        if(isset($_POST["type"])){
            $type = $_POST["type"];  
        }
        else{
            $type = $this->getAllPostTypes();
        }

        $postService = PostService::getSingleton();
        $postService->setPostType($type);
        $postService->setQuery($query);
        $postService->setPaged($paged);
        $postService->setPostsPerPage(2);

        $postEntities = $postService->getPosts();
        return array(
            "posts" => $this->formatPostResultsAsArray($postEntities),
            "count" => $postService->getFoundPosts(),
            "paged" => $paged,
            "pagesNumber" => $postService->getMaxNumberOfPages()
        );
    }

    /**
     * 
     * @return multitype:multitype:
     */
    public function recentsAction(){
        $posts = PostService::getSingleton()->getRecentPosts();
        return array("posts" => $this->formatPostResultsAsArray($posts));
    }

    /**
     *
     * @param array $postEntities
     * @return array
     */
    private function formatPostResultsAsArray($postEntities){
        $formattedPosts = array();
        foreach ($postEntities as $post){
            $formattedPosts[] = $post->toArray();
        }

        return $formattedPosts;
    }
    
    /**
     * 
     */
    public function postAction(){
        $slug = $this->getPost('slug');
        $type = $this->getPost('type');
        $postService = PostService::getSingleton();
        $postService->setName($slug);
        $postService->setPostType($type);
        $posts = $postService->getPosts();
        if(count($posts) > 0){
            return array("post" => $posts[0]->toArray());
        }
        else{
            return array("post" => null);
        }
    }

}