<?php
namespace INUtils\Service;

use INUtils\Singleton\AbstractSingleton;

abstract class WPTermService extends AbstractSingleton
{
    const ASC = "ASC";
    const DESC = "DESC";

    /**
     *
     * @var string
     */
    private $entityClass;

    /**
     * @var string
     */
    private $orderby;

    /**
     * @var string
     */
    private $order;

    /**
     * @var boolean
     */
    private $hide_empty;

    /**
     * @var array
     */
    private $exclude;

    /**
     * @var array
     */
    private $include;

    /**
     * @var array
     */
    private $exclude_tree;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $fields;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $parent;

    /**
     * @var boolean
     */
    private $hierarchical;

    /**
     * @var number
     */
    private $child_of;

    /**
     * @var string
     */
    private $get;

    /**
     * @var string
     */
    private $name__like;

    /**
     * @var string
     */
    private $description__like;

    /**
     * @var boolean
     */
    private $pad__counts;

    /**
     * @var string
     */
    private $offset;

    /**
     * @var string
     */
    private $search;

    /**
     * @var string
     */
    private $cache_domain;

    /**
     * @var string
     */
    private $taxonomy;

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
     * @return the $taxonomies
     */
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }

    /**
     * @param multitype: $taxonomies
     */
    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;
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
     * @return the $hide_empty
     */
    public function getHideEmpty()
    {
        return $this->hide_empty;
    }

     /**
     * @return the $exclude
     */
    public function getExclude()
    {
        return $this->exclude;
    }

    /**
     * @return the $include
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * @return the $exclude_tree
     */
    public function getExcludeTree()
    {
        return $this->exclude_tree;
    }

    /**
     * @return the $number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return the $fields
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return the $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return the $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return the $hierarchical
     */
    public function getHierarchical()
    {
        return $this->hierarchical;
    }

    /**
     * @return the $child_of
     */
    public function getChildOf()
    {
        return $this->child_of;
    }

     /**
     * @return the $get
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @return the $name__like
     */
    public function getNameLike()
    {
        return $this->name__like;
    }

    /**
     * @return the $description__like
     */
    public function getDescriptionLike()
    {
        return $this->description__like;
    }

    /**
     * @return the $pad__counts
     */
    public function getPadCounts()
    {
        return $this->pad__counts;
    }

    /**
     * @return the $offset
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return the $search
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @return the $cache_domain
     */
    public function getCacheDomain()
    {
        return $this->cache_domain;
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
     * @param boolean $hide_empty
     */
    public function setHideEmpty($hide_empty)
    {
        $this->hide_empty = $hide_empty;
    }

    /**
     * @param multitype: $exclude
     */
    public function setExclude($exclude)
    {
        $this->exclude = $exclude;
    }

    /**
     * @param multitype: $include
     */
    public function setInclude($include)
    {
        $this->include = $include;
    }

    /**
     * @param multitype: $exclude_tree
     */
    public function setExcludeTree($exclude_tree)
    {
        $this->exclude_tree = $exclude_tree;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @param string $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @param string $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param boolean $hierarchical
     */
    public function setHierarchical($hierarchical)
    {
        $this->hierarchical = $hierarchical;
    }

    /**
     * @param number $child_of
     */
    public function setChildOf($child_of)
    {
        $this->child_of = $child_of;
    }

    /**
     * @param string $get
     */
    public function setGet($get)
    {
        $this->get = $get;
    }

    /**
     * @param string $name__like
     */
    public function setNameLike($name__like)
    {
        $this->name__like = $name__like;
    }

     /**
     * @param string $description__like
     */
    public function setDescriptionLike($description__like)
    {
        $this->description__like = $description__like;
    }

    /**
     * @param boolean $pad__counts
     */
    public function setPadCounts($pad__counts)
    {
        $this->pad__counts = $pad__counts;
    }

    /**
     * @param string $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param string $search
     */
    public function setSearch($search)
    {
        $this->search = $search;
    }

    /**
     * @param string $cache_domain
     */
    public function setCacheDomain($cache_domain)
    {
        $this->cache_domain = $cache_domain;
    }

    /**
     * It initializes the service
     */
    function __construct(){
        $this->init();
    }

    /**
     * it gets the args array
     */
    public function getArgs(){
        $args = array();

        $args["orderby"] = "name";
        $args["order"] = self::ASC;
        $args["hierarchical"] = false;
        $args["hide_empty"] = false;

        if($this->cache_domain != null){
            $args["cache_domain"] = $this->cache_domain;
        }
        if($this->child_of  != null){
            $args["child_of"] = $this->child_of;
        }
        if($this->description__like  != null){
            $args["description__like"] = $this->description__like;
        }
        if($this->exclude  != null){
            $args["exclude"] = $this->exclude;
        }
        if($this->exclude_tree  != null){
            $args["exclude_tree"] = $this->exclude_tree;
        }
        if($this->fields != null){
            $args["fields"] = $this->fields;
        }
        if($this->get != null){
            $args["get"] = $this->get;
        }
        if($this->hide_empty  != null){
            $args["hide_empty"] = $this->hide_empty;
        }
        if($this->hierarchical != null){
            $args["hierarchical"] = $this->hierarchical;
        }
        if($this->include != null){
            $args["include"] = $this->include;
        }
        if($this->name__like != null){
            $args["name__like"] = $this->name__like;
        }
        if($this->number != null){
            $args["number"] = $this->number;
        }
        if($this->offset != null){
            $args["offset"] = $this->offset;
        }
        if($this->order != null){
            $args["order"] = $this->order;
        }
        if($this->orderby  != null){
            $args["orderby"] = $this->orderby;
        }
        if($this->pad__counts != null){
            $args["pad__counts"] = $this->pad__counts;
        }
        if($this->parent != null){
            $args["parent"] = $this->parent;
        }
        if($this->search != null){
            $args["search"] = $this->search;
        }
        if($this->slug != null){
            $args["slug"] = $this->slug;
        }

        return $args;
    }

    /**
     *
     * @return Ambigous <multitype:, WP_Error>
     */
    private function getTermsFromWP(){
        return get_terms($this->getTaxonomy(), $this->getArgs());
    }

    /**
     *
     * @param array $terms
     * @return multitype:unknown
     */
    private function formatTermsAsEntities($terms){
        $termEntities = array();
        foreach($terms as $term){
            $termEntity = new $this->entityClass($term->term_id, $this->getTaxonomy());
            $termEntities[] = $termEntity;
        }
        return $termEntities;
    }

    /**
     *
     * @return multitype:$this->entityClass
     */
    public function getTerms(){
        return $this->formatTermsAsEntities($this->getTermsFromWP());
    }

    public abstract function init();
}