<?php

namespace INUtils\Controller;

use INUtils\Entity\PostEntity;
use INUtils\Service\PostService;
use Resource\Helper\ResourceHelper;
use Staff\Helper\StaffHelper;
use Director\Helper\DirectorHelper;
use Client\Helper\ClientHelper;
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

        $postService = PostService::getSingleton();
        $postService->setPostType($this->getAllPostTypes());
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
     * @return array
     */
    public function getAllPostTypes(){
        $postTypes = array(
            "post",
            ResourceHelper::RESOURCE_POST_TYPE,
            StaffHelper::STAFF_POST_TYPE,
            DirectorHelper::DIRECTOR_POST_TYPE,
            ClientHelper::CLIENT_POST_TYPE
        );

        return $postTypes;
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

}