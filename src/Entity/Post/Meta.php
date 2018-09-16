<?php 

namespace Wordpress\Entity\Post;

use Wordpress\Entity\BaseMeta;

/**
 * @Entity
 * @Table(name="postmeta")
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
    private $post_id;

    /**
     * @ManyToOne(targetEntity="Post", inversedBy="meta")
     * @JoinColumn(name="post_id", referencedColumnName="ID")
     */
    private $post;
}