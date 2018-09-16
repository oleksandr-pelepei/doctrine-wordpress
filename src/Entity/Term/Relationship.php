<?php 

namespace Wordpress\Entity\Term;

/**
 * @Entity
 * @Table(name="term_relationships")
 */
class Relationship
{
    /**
     * @Id
     * @Column(type="bigint", length=20, nullable=false, options={"usigned": false})
     */
    private $object_id;

    /**
     * @Id
     * @Column(type="bigint", length=20, nullable=false, options={"usigned": false})
     */
    private $term_taxonomy_id;

    /**
     * @Column(type="integer", length=11, nullable=false)
     */
    private $term_order;

    /**
     * @ManyToOne(targetEntity="Taxonomy", inversedBy="relationships")
     * @JoinColumn(name="term_taxonomy_id", referencedColumnName="term_taxonomy_id")
     */
    private $taxonomy;

    /**
     * @ManyToOne(targetEntity="Wordpress\Entity\Post\Post", inversedBy="relationships")
     * @JoinColumn(name="object_id", referencedColumnName="ID")
     */
    private $posts;
}