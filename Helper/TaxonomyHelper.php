<?php
namespace INUtils\Helper;

use INUtils\Singleton\AbstractSingleton;
use INUtils\Entity\WPTermEntity;

class TaxonomyHelper extends AbstractSingleton
{
    /**
     * 
     * @param string $name
     * @param string $title
     * @param string $singularName
     * @param string $pluralName
     * @param string $postType
     */
    public function createTaxonomy($name, $title, $singularName, $pluralName, $postType = "post"){
        register_taxonomy($name, $postType, array(
            // Hierarchical taxonomy (like categories)
            'hierarchical' => true,
            // This array of options controls the labels displayed in the WordPress Admin UI
            'labels' => array(
            'name' => _x( $title, $name),
            'singular_name' => _x( $singularName, $singularName),
            'search_items' =>  __( 'Search '.$pluralName ),
            'all_items' => __( 'All '.$pluralName ),
            'parent_item' => __( 'Parent '.$singularName ),
            'parent_item_colon' => __( 'Parent '.$singularName.":" ),
            'edit_item' => __( 'Edit '.$singularName ),
            'update_item' => __( 'Update '.$singularName ),
            'add_new_item' => __( 'Add New '.$singularName ),
            'new_item_name' => __( 'New '.$singularName.' Name' ),
            'menu_name' => __( $pluralName ),
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => $name, // This controls the base slug that will display before each term
                'with_front' => false, // Don't display the category base before "/locations/"
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
            ),
        ));
    }
    
    /**
     * 
     * @return multitype:string boolean
     */
    private function getArgsForTaxonomies(){
        $args = array(
            'orderby'           => 'name',
            'order'             => 'ASC',
            'hierarchical'      => true,
            'pad_counts'        => false,
            'cache_domain'      => 'core'
        );
        
        return $args;
    }
    
    /**
     * 
     * @param string $taxonomyName
     * @return multitype:\INUtils\Entity\WPTermEntity
     */
    public function getTaxonomyTerms($taxonomyName){
        $args = $this->getArgsForTaxonomies();
        $tems = get_terms(array($taxonomyName), $args);
        $termEntities = array();
        foreach($tems as $term){
            $termEntity = new WPTermEntity($term->term_id, $taxonomyName);
            $termEntities[] = $termEntity;
        }
        return $termEntities;
    }
}