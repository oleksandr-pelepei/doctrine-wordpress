<?php 

namespace Wordpress\Entity\Post;

/**
 * @Entity
 */
class Attachment extends Post
{
    /**
     * @Column(type="text", length=100, nullable=false, options={"collation": "utf8mb4_unicode_ci"})
     */
    private $post_mime_type;

    public function getMimeType() {
        return $this->post_mime_type;
    }

    public function setMimeType($mime_type) {
        $this->post_mime_type = $mime_type;
        
        return $this;
    }
}