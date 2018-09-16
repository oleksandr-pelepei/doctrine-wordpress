<?php 

namespace Wordpress\Entity\Term;

use Doctrine\Common\Collections\ArrayCollection;
use Wordpress\Entity\Post\Post;

/**
 * @Entity
 * @Table(name="term_taxonomy")
 */
class Taxonomy
{
    /**
     * @Id
     * @Column(type="bigint", length=20, nullable=false, options={"usigned": false})
     * @GeneratedValue(strategy="AUTO")
     */
    private $term_taxonomy_id;

    /**
     * @Column(type="bigint", length=20, nullable=false, options={"usigned": false})
     */
    private $term_id;

    /**
     * @Column(type="string", length=32, nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    private $taxonomy;

    /**
     * @Column(type="text", nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    private $description;

    /**
     * @Column(type="bigint", name="parent", length=20, nullable=false, options={"usigned": false})
     */
    private $parent_id;

    /**
     * @Column(type="bigint", length=20, nullable=false)
     */
    private $count;

    /**
     * @OneToOne(targetEntity="Term", mappedBy="taxonomy")
     */
    private $term;

    /**
     * @OneToMany(targetEntity="Relationship", mappedBy="taxonomy")
     */
    private $relationships;

    /**
     * @ManyToMany(targetEntity="Wordpress\Entity\Post\Post", mappedBy="taxonomies")
     */
    private $posts;

    public function __construct() {
    }

    public function getId() {
        return $this->term_taxonomy_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getTaxonomy()
    {
        return $this->taxonomy;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getParent() {
        return $this->parent;
    }

    public function getCount() {
        return $this->count;
    }

    public function getTerm() {
        return $this->term;
    }

    public function getPosts() {
        return $this->posts;
    }
}