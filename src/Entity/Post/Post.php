<?php 

namespace Wordpress\Entity\Post;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Wordpress\Entity\Post\Meta;
use Wordpress\Entity\Term\Taxonomy;
use Wordpress\Entity\Term\Term;

/**
 * @Entity(repositoryClass="Wordpress\Repository\PostRepository")
 * @Table(name="posts", indexes={ 
 *     @Index(name="post_name", columns={"post_name"}),
 *     @Index(name="type_status_date", columns={"post_type", "post_status", "post_date", "ID"}),
 *     @Index(name="post_parent", columns={"post_parent"}),
 *     @Index(name="post_author", columns={"post_author"})
 * })
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="post_type", type="string", length=20)
 */
class Post
{
    /**
     * @Id
     * @Column(type="bigint", length=20, unique=true, nullable=false, options={"unsigned":true})
     * @GeneratedValue(strategy="AUTO")
     */
    protected $ID;

    /**
     * @Column(type="bigint", length=20, nullable=false, options={"unsigned":true, "default":0})
     */
    protected $post_author;

    /**
     * @Column(type="datetime", length=20, nullable=false, options={"default": "0000-00-00 00:00:00"})
     */
    protected $post_date;

    /**
     * @Column(type="datetime", length=20, nullable=false, options={"default": "0000-00-00 00:00:00"})
     */
    protected $post_date_gmt;

    /**
     * @Column(type="text", nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    protected $post_content;

    /**
     * @Column(type="text", nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    protected $post_title;

    /**
     * @Column(type="text", nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    protected $post_excerpt;

    /**
     * @Column(type="string", length=20, nullable=false, options={"collation": "utf8mb4_unicode_ci", "default": "publish"})
     */
    protected $post_status;

    /**
     * @Column(type="string", length=20, nullable=false, options={"collation": "utf8mb4_unicode_ci", "default": "open"})
     */
    protected $comment_status;

    /**
     * @Column(type="string", length=20, nullable=false, options={"collation": "utf8mb4_unicode_ci", "default": "open"})
     */
    protected $ping_status;

    /**
     * @Column(type="string", length=255, nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    protected $post_password;

    /**
     * @Column(type="string", length=200, nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    protected $post_name;

    /**
     * @Column(type="text", nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    protected $to_ping;

    /**
     * @Column(type="text", nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    protected $pinged;

    /**
     * @Column(type="datetime", length=20, nullable=false, options={"default": "0000-00-00 00:00:00"})
     */
    protected $post_modified;

    /**
     * @Column(type="datetime", length=20, nullable=false, options={"default": "0000-00-00 00:00:00"})
     */
    protected $post_modified_gmt;

    /**
     * @Column(type="text", nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    protected $post_content_filtered;

    /**
     * @Column(type="bigint", length=20, nullable=false, options={"unsigned": true})
     */
    protected $post_parent;

    /**
     * @Column(type="text", length=255, nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    protected $guid;

    /**
     * @Column(type="integer", length=11, nullable=false, options={"default": 0})
     */
    protected $menu_order;

    /**
     * @Column(type="bigint", length=20, nullable=false, options={"default": 0})
     */
    protected $comment_count;

    /**
     * @OneToMany(targetEntity="Meta", mappedBy="post")
     */
    protected $meta;

    /**
     * @ManyToMany(targetEntity="\Wordpress\Entity\Term\Taxonomy", inversedBy="posts")
     * @JoinTable(
     *     name="term_relationships",
     *     joinColumns={
     *         @JoinColumn(name="object_id", referencedColumnName="ID")
     *     },
     *     inverseJoinColumns={
     *         @JoinColumn(name="term_taxonomy_id", referencedColumnName="term_taxonomy_id")
     *     }
     * )
     */
    protected $taxonomies;

    /**
     * @OneToMany(targetEntity="Wordpress\Entity\Term\Relationship", mappedBy="posts")
     */
    protected $relationships;

    public function __construct() {
        $this->meta = new ArrayCollection();
        $this->taxonomies = new ArrayCollection();
    }

    public function getID() {
        return $this->ID;
    }

    public function getSlug() {
        return $this->post_name;
    }

    public function setSlug($slug) {
        $this->post_name = $slug;

        return $this;
    }

    public function getDate() {
        return clone $this->post_date;
    }

    public function setDate(\DateTime $date) {
        $this->post_date = clone $date;

        return $this;
    }
    
    public function getDateGMT() {
        return clone $this->post_date_gmt;
    }

    public function setDateGMT(\DateTime $date) {
        $this->post_date = clone $date;

        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->post_content = $content;

        return $this;
    }

    public function getTitle() {
        return $this->post_title;
    }

    public function setTitle($title) {
        $this->post_title = $title;

        return $this;
    }

    public function getExcerpt() {
        return $this->post_excerpt;
    }

    public function setExcerpt($excerpt) {
        $this->post_excerpt = $excerpt;

        return $this;
    }

    public function setPassword($pass) {
        $this->post_password = $pass;

        return $this;
    }

    public function comparePassword($pass) {
        return $this->post_password === $pass;
    }
    
    public function autoGenerateExcerpt($length = 200) {
        $excerpt = strip_tags($this->post_content);

        if ( strlen($excerpt) > 200 ) {
            $excerpt = substr($excerpt, 0, 200) . '...';
        }

        $this->post_excerpt = $excerpt;

        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->post_status = clone $status;

        return $this;
    }
    
    public function getModified() {
        return clone $this->post_modified;
    }

    public function setModified(\DateTime $date) {
        $this->post_modified = clone $date;

        return $this;
    }
    
    public function getModifiedGMT() {
        return clone $this->post_modified_gmt;
    }

    public function setModifiedGMT(\DateTime $date) {
        $this->post_modified_gmt = clone $date;

        return $this;
    }

    public function getMenuOrder() {
        return $this->menu_order;
    }

    public function setMenuOrder($order) {
        $this->menu_order = $order;

        return $this;
    }

    public function getTaxonomies() {
        return $this->taxonomies;
    }

    public function getTerms() {
        $terms = new ArrayCollection();

        foreach ($this->taxonomies as $taxonomy) {
            $terms[] = $taxonomy->getTerm();
        }

        return $terms;
    }
    
    public function addTerm(Term $term) {
        $taxonomy = $term->getTaxonomy();
        
        if (!$taxonomy instanceof Taxonomy) {
            throw new Exception('Invalid term. Term without taxonomy.');
        }
        
        $this->taxonomies[] = $taxonomy;
    }

    public function getTags() {
        return $this->getTaxonomyTerms('post_tag');
    }

    public function getCategories() {
        return $this->getTaxonomyTerms('category');
    }

    public function getTaxonomyTerms($tax) {
        $terms = new ArrayCollection();
        $criteria = Criteria::create();
        $criteria->where( Criteria::expr()->eq('taxonomy', $tax) );

        $taxs = $this->taxonomies->matching($criteria);

        foreach ($taxs as $taxonomy) {
            $terms[] = $taxonomy->getTerm();
        }

        return $terms;
    }

    public function getMeta($key = '') {
        $criteria = Criteria::create();

        if ($key) {
            $criteria->where( Criteria::expr()->eq('meta_key', $key) );
        }

        return $this->meta->matching($criteria);
    }
}