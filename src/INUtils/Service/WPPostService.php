<?php
namespace INUtils\Service;

use INUtils\Entity\WPPostInterface;
use INUtils\Singleton\AbstractSingleton;

abstract class WPPostService extends AbstractSingleton
{
    const ORDERBY_DATE = "post_date";
    const ORDERBY_ID = "ID";
    const ORDERBY_TITLE = "post_title";
    const ORDERBY_CONTENT = "post_content";

    const ASC = "ASC";
    const DESC = "DESC";

    const POST_TYPE_POST = "post";
    const POST_TYPE_PAGE = "page";

    const STATUS_PUBLISH = "publish";
    const STATUS_DRAFT = "draft";

    /**
     *
     * @var string
     */
    private $entityClass;

    /**
     *
     * @var int
     */
    private $posts_per_page;

    /**
     *
     * @var int
     */
    private $offset;

    /**
     *
     * @var string
     */
    private $category;

    /**
     *
     * @var string
     */
    private $category_name;

    /**
     *
     * @var string
     */
    private $orderby;

    /**
     *
     * @var string
     */
    private $order;

    /**
     *
     * @var string
     */
    private $include;

    /**
     *
     * @var string
     */
    private $exclude;

    /**
     *
     * @var string
     */
    private $meta_key;

    /**
     *
     * @var string
     */
    private $meta_value;

    /**
     *
     * @var string
     */
    private $post_type;

    /**
     *
     * @var string
     */
    private $post_mime_type;

    /**
     *
     * @var string
     */
    private $post_parent;

    /**
     *
     * @var string
     */
    private $post_status;

    /**
     *
     * @var string
     */
    private $suppress_filters;

    /**
     *
     * @var array
     */
    private $tax_query;

    /**
     *
     * @var string
     */
    private $query;

    /**
     *
     * @var boolean
     */
    private $is_sticky;

    /**
     *
     * @var int
     */
    private $paged;

    /**
     *
     * @var \WP_Query
     */
    private $wpQuery;

    /**
     *
     * @var string
     */
    private $name;

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \INUtils\Service\string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return the $paged
     */
    public function getPaged()
    {
        return $this->paged;
    }

     /**
     * @param number $paged
     */
    public function setPaged($paged)
    {
        $this->paged = $paged;
    }

    /**
     * @return the $query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * @return the $is_sticky
     */
    public function getIsSticky()
    {
        return $this->is_sticky;
    }

    /**
     * @param boolean $isSticky
     */
    public function setIsSticky($is_sticky = true)
    {
        $this->is_sticky = $is_sticky;
    }

    /**
     * @return the $tax_query
     */
    public function getTaxQuery()
    {
        return $this->tax_query;
    }

    /**
     * @param multitype: $tax_query
     */
    public function setTaxQuery($tax_query)
    {
        $this->tax_query = $tax_query;
    }

    /**
     * @return the $entityClass
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @param string $entityClass
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
    }

    /**
     * @return the $post_per_page
     */
    public function getPostsPerPage()
    {
        return $this->posts_per_page;
    }

    /**
     * @return the $offset
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return the $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return the $category_name
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @return the $orderby
     */
    public function getOrderby()
    {
        return $this->orderby;
    }

    /**
     * @return the $order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return the $include
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * @return the $exclude
     */
    public function getExclude()
    {
        return $this->exclude;
    }

    /**
     * @return the $meta_key
     */
    public function getMetaKey()
    {
        return $this->meta_key;
    }

    /**
     * @return the $meta_value
     */
    public function getMetaValue()
    {
        return $this->meta_value;
    }

    /**
     * @return the $post_type
     */
    public function getPostType()
    {
        return $this->post_type;
    }

    /**
     * @return the $post_mime_type
     */
    public function getPostMimeType()
    {
        return $this->post_mime_type;
    }

    /**
     * @return the $post_parent
     */
    public function getPostParent()
    {
        return $this->post_parent;
    }

    /**
     * @return the $post_status
     */
    public function getPostStatus()
    {
        return $this->post_status;
    }

    /**
     * @return the $suppress_filters
     */
    public function getSuppressFilters()
    {
        return $this->suppress_filters;
    }

    /**
     * @param number $post_per_page
     */
    public function setPostsPerPage($post_per_page)
    {
        $this->posts_per_page = $post_per_page;
    }

    /**
     * @param number $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @param string $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    /**
     * @param string $orderby
     */
    public function setOrderby($orderby)
    {
        $this->orderby = $orderby;
    }

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @param string $include
     */
    public function setInclude($include)
    {
        $this->include = $include;
    }

    /**
     * @param string $exclude
     */
    public function setExclude($exclude)
    {
        $this->exclude = $exclude;
    }

    /**
     * @param string $meta_key
     */
    public function setMetaKey($meta_key)
    {
        $this->meta_key = $meta_key;
    }

    /**
     * @param string $meta_value
     */
    public function setMetaValue($meta_value)
    {
        $this->meta_value = $meta_value;
    }

    /**
     * @param string $post_type
     */
    public function setPostType($post_type)
    {
        $this->post_type = $post_type;
    }

    /**
     * @param string $post_mime_type
     */
    public function setPostMimeType($post_mime_type)
    {
        $this->post_mime_type = $post_mime_type;
    }

    /**
     * @param string $post_parent
     */
    public function setPostParent($post_parent)
    {
        $this->post_parent = $post_parent;
    }

    /**
     * @param string $post_status
     */
    public function setPostStatus($post_status)
    {
        $this->post_status = $post_status;
    }

    /**
     * @param string $suppress_filters
     */
    public function setSuppressFilters($suppress_filters)
    {
        $this->suppress_filters = $suppress_filters;
    }

    protected abstract function init();

    function __construct(){
        $this->posts_per_page = -1;
        $this->offset = 0;
        $this->orderby = self::ORDERBY_DATE;
        $this->order = self::DESC;
        $this->post_type = self::POST_TYPE_POST;
        $this->post_status = self::STATUS_PUBLISH;
        $this->is_sticky = false;

        $this->init();
    }

    /**
     * it clears query params
     */
    public function clearQuery(){
        $this->__construct();
    }

    /**
     *
     * @return multitype:number string
     */
    public function getArgsArray(){
        $args = array();
        $args["posts_per_page"] = $this->posts_per_page;
        //$args["offset"] = $this->offset;
        $args["orderby"] = $this->orderby;
        $args["order"] = $this->order;
        $args["post_type"] = $this->post_type;
        $args["post_status"] = $this->post_status;

        if($this->paged != null){
            $args["paged"] = $this->paged;
        }
        else{
            $args["paged"] = 1;
        }

        if($this->category != null){
            $args["category"] = $this->category;
        }
        if($this->category_name != null){
            $args["category_name"] = $this->category_name;
        }
        if($this->include != null){
            $args["include"] = $this->include;
        }
        if($this->exclude != null){
            $args["exclude"] = $this->exclude;
        }
        if($this->meta_key != null){
            $args["meta_key"] = $this->meta_key;
        }
        if($this->meta_value != null){
            $args["meta_value"] = $this->meta_value;
        }
        if($this->post_mime_type != null){
            $args["post_mime_type"] = $this->post_mime_type;
        }
        if($this->post_parent != null){
            $args["post_parent"] = $this->post_parent;
        }
        if($this->suppress_filters != null){
            $args["suppress_filters"] = $this->suppress_filters;
        }
        if($this->tax_query != null){
            $args["tax_query"] = $this->tax_query;
        }
        if($this->is_sticky === true){
            $args["post__in"] = get_option( 'sticky_posts' );
        }
        if($this->query != null){
            $args["s"] = $this->query;
        }
        if($this->name != null){
            $args["name"] = $this->name;
        }

        return $args;
    }

    /**
     *
     * @param string $taxonomyName
     * @param string $termName
     * @param array $termsArray
     */
    public function setTaxonomyFilter($taxonomyName, $termName, $termsArray = null){
        if($termsArray != null){
           $terms = $termsArray;
        }
        else{
            $terms = $termName;
        }

        $taxQuery = array(
            array(
                "taxonomy" => $taxonomyName,
                "terms" => $terms
            )
        );

        $this->setTaxQuery($taxQuery);
    }

    /**
     *
     * @return Ambigous <multitype:, multitype:number >
     */
    private function getPostsFromWP(){
        $this->wpQuery = new \WP_Query($this->getArgsArray());
        return $this->wpQuery->get_posts();
    }

    /**
     *
     * @param array $posts
     * @return WPPostInterface
     */
    private function formatWPPostsAsEntities($posts){
        $postEntities = array();
        foreach($posts as $post){
            $postEntity = new $this->entityClass($post->ID);
            $postEntities[] = $postEntity;
        }
        return $postEntities;
    }

    /**
     *
     * @return multitype:\INUtils\Entity\WPPostInterface
     */
    public function getPosts(){
        $posts = $this->formatWPPostsAsEntities($this->getPostsFromWP());
        $this->clearQuery();
        return $posts;
    }

    /**
     * @return multitype:\INUtils\Entity\WPPostInterface
     */
    public function getStickyPosts($limit = 10){
        $this->setIsSticky(true);
        $this->setPostsPerPage($limit);
        $stickyPosts = $this->getPosts();
        return $stickyPosts;
    }

    private function validateQuery(){
        if($this->wpQuery == null){
            throw new \Exception("the query hasn't been executed");
        }
    }

    /**
     *
     * @return number
     */
    public function getPostCount(){
        $this->validateQuery();
        return $this->wpQuery->post_count;
    }

    /**
     *
     * @return number
     */
    public function getFoundPosts(){
        $this->validateQuery();
        return $this->wpQuery->found_posts;
    }

    /**
     *
     * @return number
     */
    public function getMaxNumberOfPages(){
        $this->validateQuery();
        return $this->wpQuery->max_num_pages;
    }

    /**
     *
     * @return NULL|number
     */
    public function getNextPageNumber(){
        $this->validateQuery();
        if($this->getPaged() >= $this->getMaxNumberOfPages()){
            return null;
        }
        else{
            return $this->getPaged() + 1;
        }
    }

    /**
     *
     * @return NULL|number
     */
    public function getPrevPageNumber(){
        $this->validateQuery();
        if($this->getPaged() == 1){
            return null;
        }
        else{
            return $this->getPaged() - 1;
        }
    }

    /**
     *
     * @param string $pageName
     * @return \INUtils\Entity\WPEntityInterface
     */
    public function getPostByPageName($pageName){
        $post = get_page_by_path($pageName);
        if(isset($post->ID)){
            return new $this->entityClass($post->ID);
        }
        else{
            throw new \Exception("No post was found");
        }
    }

}