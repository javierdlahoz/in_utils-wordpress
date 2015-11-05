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
        if(isset($_POST["query"])){
            $query = $_POST["query"];
        }
        else{
            $query = "";
        }

        if(isset($_POST["page"])){
            $paged = $_POST["page"];
        }
        else{
            $paged = 1;
        }
        
        if(isset($_POST["type"])){
            $type = $_POST["type"];  
        }
        else{
            $type = "post";
        }

        $postService = PostService::getSingleton();
        $postService->setPostType($type);
        $postService->setQuery($query);
        $postService->setPaged($paged);
        
        if(isset($_POST["perPage"])){
            $postService->setPostsPerPage($_POST["perPage"]);
        }
        else{
            $postService->setPostsPerPage(self::POST_PER_PAGE);
        }
        
        if(isset($_POST["orderby"])){
            $postService->setOrderby($_POST["orderby"]);
        }
        if(isset($_POST["order"])){
            $postService->setOrder($_POST["order"]);
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
        if(!isset($_POST["slug"])){
            throw new \Exception("slug param is mandatory");
        }
        if(!isset($_POST["type"])){
            throw new \Exception("type param is mandatory");
        }
        
        $post = $this->getPostBySlugAndType($_POST["slug"], $_POST["type"]);
        return array("post" => $post);
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

}