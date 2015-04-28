<?php
namespace INUtils\Entity;

class WPTermEntity
{
    /**
     *
     * @var int
     */
    private $term_id;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var string
     */
    private $slug;

    /**
     *
     * @var string
     */
    private $term_group;

    /**
     *
     * @var string
     */
    private $term_taxonomy_id;

    /**
     *
     * @var string
     */
    private $taxonomy;

    /**
     *
     * @var string
     */
    private $description;

    /**
     *
     * @var string
     */
    private $parent;

    /**
     *
     * @var int
     */
    private $count;

    /**
     * @return the $term_id
     */
    public function getTermId()
    {
        return $this->term_id;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return the $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return the $term_group
     */
    public function getTermGroup()
    {
        return $this->term_group;
    }

    /**
     * @return the $term_taxonomy_id
     */
    public function getTermTaxonomyId()
    {
        return $this->term_taxonomy_id;
    }

    /**
     * @return the $taxonomy
     */
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }

    /**
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return the $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return the $count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     *
     * @return string
     */
    public function getPermalink(){
        return get_term_link($this->getTermId(), $this->getTaxonomy());
    }


    function __construct($id, $taxonomy){
        $term = get_term($id, $taxonomy);
        foreach ($term as $key => $value){
            $this->{$key} = $value;
        }
    }
}