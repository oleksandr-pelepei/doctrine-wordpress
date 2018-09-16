<?php 

namespace Wordpress\Entity;

/**
 * @MappedSuperclass
 */
class BaseMeta
{
    /**
     * @Column(type="text", length=255, nullable=true, options={"collation": "utf8mb4_unicode_ci", "default": NULL})
     */
    protected $meta_key;

    /**
     * @Column(type="text", nullable=true, options={"collation": "utf8mb4_unicode_ci", "default": NULL})
     */
    protected $meta_value;

    public function getValue() {
        return $this->meta_value;
    }
}