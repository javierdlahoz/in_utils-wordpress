<?php
namespace INUtils\Entity;

use INUtils\Helper\TextHelper;
abstract class WPPostEntity implements WPPostInterface
{
    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $content;

    /**
     *
     * @var string
     */
    private $permalink;

    /**
     *
     * @var string
     */
    private $image;

    /**
     *
     * @var string
     */
    private $type;

    /**
     *
     * @var string
     */
    private $title;

    /**
     *
     * @var string
     */
    private $date;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var string
     */
    private $author;

    /**
     *
     * @var array
     */
    private $comments;
    
    /**
     * 
     * @var string
     */
    private $excerpt;
    
    /**
     * 
     * @var string
     */
    private $timestamp;

    /**
     * 
     * @var array
     */
    private $categories;

    /**
     * 
     * @var array
     */
    private $taxonomies;

    /**
     *
     * @return array
     */
    public function getComments(){
        $args = array(
	       'post_id' => $this->id,
        );

        return get_comments($args);
    }


    /**
     * @return the $author
     */
    public function getAuthor()
    {
        return get_the_author_meta("display_name", $this->author);
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

     /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

 /**
     * @return the $date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return the $permalink
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * @return the $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return the $title
     */
    public function getTitle()
    {
        return $this->title;
    }


     /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
    

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    function __construct($postId){
        $post = get_post($postId);
        
        $this->id = $post->ID;
        $this->content = $post->post_content;
        $this->image = wp_get_attachment_url(get_post_thumbnail_id($this->id));
        $this->type = $post->post_type;
        $this->title = $post->post_title;
        $this->date = $post->post_date;
        $this->name = $post->post_name;
        $this->author = $post->post_author;
        $this->excerpt = $post->post_excerpt;
        $this->post = $post;
        $this->timestamp = get_the_time('U', $post);
        $this->categories = wp_get_post_categories($post->ID);
        
        if($this->type == "page"){
            $this->permalink = $this->post->guid;
        }
        else{
            $this->permalink = get_permalink($this->id);
        }
    }

    /**
     *
     * @param string $fieldName
     * @return mixed
     */
    public function getMetaField($fieldName){
        return get_post_meta($this->id, $fieldName, true);
    }

    /**
     *
     * @param string $fieldName
     * @param string $fieldValue
     */
    public function setMetaField($fieldName, $fieldValue){
        update_post_meta($this->id, $fieldName, $fieldValue);
    }


    /**
     *
     * @param string $format
     * @return Ambigous <string, number, boolean, mixed>
     */
    public function getFormattedDate($format = "j M Y"){
        return mysql2date($format, $this->date);
    }

    /**
     *
     * @return multitype:\INUtils\Entity\WPPostEntity
     */
    public function getChildren(){
        $my_wp_query = new \WP_Query();
        $all_wp_pages = $my_wp_query->query(array('post_type' => $this->getType()));
        $children = get_page_children($this->getId(), $all_wp_pages);
        return $this->formatChildren($children);
    }

    /**
     *
     * @param unknown $children
     * @return multitype:\INUtils\Entity\WPPostEntity
     */
    private function formatChildren($children){
        $finalClass = get_class($this);
        $childrenEntities = array();
        foreach ($children as $child){
            $childrenEntities[] = new $finalClass($child->ID);
        }
        return $childrenEntities;
    }

    /**
     *
     * @param string $taxonomy
     * @return multitype:\INUtils\Entity\WPTermEntity
     */
    public function getTermList($taxonomy){
        $termList = array();
        $terms = wp_get_post_terms($this->getId(), $taxonomy);
        foreach ($terms as $term){
            $termList[] = new WPTermEntity($term->term_id, $taxonomy);
        }
        return $termList;
    }

    /**
     *
     * @return multitype:\INUtils\Entity\WPTermEntity
     */
    public function getTags(){
        return $this->getTermList("post_tag");
    }

    /**
     *
     * @return string
     */
    public function getTagsAsString(){
        $isFirst = true;
        $tags = "";
        foreach($this->getTags() as $tag){
            if($isFirst){
                $tags = $tag->getName();
                $isFirst = false;
            }
            else{
                $tags .= ", ".$tag->getName();
            }
        }
        return $tags;
    }
    
    /**
     * @return array 
     */
    public function getMeta(){
        $meta = get_post_meta($this->getId());
        unset($meta["_edit_lock"]);
        unset($meta["_edit_last"]);
        
        $metaArray = array();
        foreach($meta as $key => $value){
            $metaArray[$key] = $value[0];
        }
        return $metaArray;
    }

    /**
     * @return array 
     */
    public function getCategories(){
        $cats = array();
        foreach ($this->categories as $categorieId) {
            $cats[] = get_cat_name($categorieId);
        }
        return $cats;
    }
    
    /**
     *
     * @return multitype:\INUtils\Entity\the \INUtils\Entity\Ambigous
     */
    public function toArray(){
        return array(
            "id" => $this->getId(),
            "title" => $this->getTitle(),
            "content" => $this->getContent(),
            "permalink" => $this->getPermalink(),
            "image" => $this->getImage(),
            "postDate" => $this->date,
            "date" => $this->getFormattedDate(),
            "type" => $this->getType(),
            "name" => $this->getName(),
            "author" => $this->getAuthor(),
            "limitedContent" => TextHelper::cropText($this->getContent(), 300),
            "excerpt" => $this->getExcerpt(), 
            "timestamp" => $this->getTimestamp(),
            "slug" => $this->getName(),
            "categories" => $this->getCategories(),
            "meta" => $this->getMeta()
        );
    }
    
    /**
     *
     * @param string $method
     */
    protected function getFieldNameFromMethodCall($method){
        $fieldName = substr($method, 3);
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $fieldName));
    }
    
    /**
     *
     * @param array $args
     */
    protected function getArgsForMethodCall($args){
        if(count($args) == 1){
            $args = $args[0];
        }
        return $args;
    }
    
    /**
     *
     * @param string $method
     * @param array $args
     */
    public function __call($method, $args){
        if(strpos($method, "set") === 0){
            $this->setMetaField($this->getFieldNameFromMethodCall($method), $this->getArgsForMethodCall($args));
        }
    
        if(strpos($method, "get") === 0){
            return $this->getMetaField($this->getFieldNameFromMethodCall($method));
        }
        return null;
    }
    
    /**
     *
     * @return Ambigous <WP_Post, multitype:, NULL>
     */
    public function getPost(){
        return $this->post;
    }

    /**
     *
     * @return the string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     *
     * @param
     *            $excerpt
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * 
     * @param string $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

}