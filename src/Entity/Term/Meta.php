<?php 

namespace Wordpress\Entity\Term;

use Wordpress\Entity\BaseMeta;

/**
 * @Entity
 * @Table(name="termmeta")
 */
class Meta extends BaseMeta
{
    /**
     * @Id
     * @Column(type="bigint", length=20, unique=true, nullable=false, options={"unsigned":true})
     * @GeneratedValue(strategy="AUTO")
     */
    private $meta_id;

    /**
     * @Column(type="bigint", length=20, unique=true, nullable=false, options={"unsigned":true})
     */
    private $term_id;
}