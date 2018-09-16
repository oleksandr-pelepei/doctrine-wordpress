<?php 

namespace Wordpress\Entity\Term;

/**
 * @Entity
 * @Table(name="terms")
 */
class Term
{
    /**
     * @Id
     * @Column(type="bigint", length=20, nullable=false, options={"usigned": false})
     * @GeneratedValue(strategy="AUTO")
     */
    private $term_id;

    /**
     * @Column(type="string", length=200, nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    private $name;

    /**
     * @Column(type="string", length=200, nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    private $slug;

    /**
     * @OneToOne(targetEntity="Taxonomy", inversedBy="term")
     * @JoinColumn(name="term_id", referencedColumnName="term_id")
     */
    private $taxonomy;

    public function getName() {
        return $this->name;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getTaxonomy() {
        return $this->taxonomy->getTaxonomy();
    }

    public function getDescription() {
        return $this->taxonomy->getDescription();
    }
    
    public function getCount() {
        return $this->taxonomy->getCount();
    }

    public function getPosts() {
        return $this->taxonomy->getPosts();
    }

    public function getParent() {
        return $this->taxonomy->getParent()->getTerm();
    }

    public function getTaxonomyEntity() {
        return $this->taxonomy;
    }
}