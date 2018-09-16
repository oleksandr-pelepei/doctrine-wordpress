<?php 

namespace Wordpress\Entity\Post;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 */
class Page extends Post
{
    /**
     * @ManyToOne(targetEntity="Page", inversedBy="children")
     * @JoinColumn(name="post_parent", referencedColumnName="ID")
     */
    private $parent;

    /**
     * @OneToMany(targetEntity="Page", mappedBy="parent")
     */
    private $children;

    public function __construct() {
        parent::__construct();

        $this->children = new ArrayCollection();
    }

    public function getParent() {
        return $this->parent;
    }

    public function getChildren() {
        return $this->children;
    }

    public function setParent(Page $parent) {
        $this->parent = $parent;
    }

    public function addChild(Page $page) {
        $this->children[] = $page;
    }

    public function getTemplate() {
        $res = '';
        $meta = $this->getMeta('_wp_page_template');

        if ($meta->count()) {
            $res = $meta->first()->getValue();
        }

        return $res;
    }
}