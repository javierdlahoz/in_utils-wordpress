<?php

namespace INUtils\Controller;

use INUtils\Entity\PostEntity;
use INUtils\Service\PostService;

class PostController extends AbstractController{

    const POST_PER_PAGE = 10;
    
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
        if(isset($_GET["query"])){
            $query = $_GET["query"];
        }
        else{
            $query = "";
        }

        if(isset($_GET["page"])){
            $paged = $_GET["page"];
        }
        else{
            $paged = 1;
        }
        
        if(isset($_GET["type"])){
            $type = $_GET["type"];  
        }
        else{
            $type = "post";
        }
        
        $postService = PostService::getSingleton();
        $postService->setPostType($type);
        $postService->setQuery($query);
        $postService->setPaged($paged);
        
        if(isset($_GET["taxonomy"]) && isset($_GET["category"])){
            $postService->setTaxonomyFilter($_GET["taxonomy"], $_GET["category"]);
        }
        
        
        if(isset($_GET["perPage"])){
            $postService->setPostsPerPage($_GET["perPage"]);
        }
        else{
            $postService->setPostsPerPage(self::POST_PER_PAGE);
        }
        
        if(isset($_GET["orderby"])){
            $postService->setOrderby($_GET["orderby"]);
        }
        if(isset($_GET["order"])){
            $postService->setOrder($_GET["order"]);
        }
        

        $postEntities = $postService->getPosts();
        return array(
            "posts" => $this->formatPostResultsAsArray($postEntities),
            "count" => $postService->getFoundPosts(),
            "paged" => $paged,
            "pagesNumber" => $postService->getMaxNumberOfPages()
        );
    }
    
    public function getAction(){
        if(!isset($_GET["slug"])){
            throw new \Exception("slug param is mandatory");
        }
        if(!isset($_GET["type"])){
            throw new \Exception("type param is mandatory");
        }
        
        $post = $this->getPostBySlugAndType($_GET["slug"], $_GET["type"]);
        return array("post" => $post->toArray());
    }
    
    public function indexAction(){
        if(!isset($_GET["id"])){
            throw new \Exception("ID param is mandatory");
        }
        
        $post = new PostEntity($_GET["id"]);
        return array("post" => $post->toArray());
    }
    
    private function getPostBySlugAndType($slug, $type){
        $postService = PostService::getSingleton();
        $postService->setName($slug);
        $postService->setPostType($type);
        
        $posts = $postService->getPosts();
        if(!isset($posts[0])){
            return null;
        }
        return $posts[0];
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
    
    public function allAction(){
        $postService = PostService::getSingleton();
        $postService->setPostsPerPage(-1);
        if(!isset($_GET["type"])){
            $type = "page";
        }
        else{
            $type = $_GET["type"];
        }
        $postService->setPostType($type);
        $postService->setPostStatus(array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'));
    
        $postEntities = $postService->getPosts();
        return array(
            "count" => $postService->getFoundPosts(),
            "posts" => $this->formatPostResultsAsArray($postEntities)
        );
    }

}