<?php 

namespace Wordpress\Repository;

use Doctrine\ORM\EntityRepository;
use Wordpress\Entity\Post\Post;
use Wordpress\Entity\Term\Taxonomy;
use Wordpress\Entity\Term\Term;
use Wordpress\Entity\Term\Relationship;

/**
 * 
 */
class PostRepository extends EntityRepository
{
    public function findPublished() {
        return $this->createQueryBuilder('p')
            ->where('p.post_status = :status')
            ->setParameter('status', 'publish')
            ->getQuery()
            ->getResult();    
    }
    
    public function findPrivate() {
        return $this
                ->createQueryBuilder('p')
                ->where('p.post_status = :status')
                ->setParameter('status', 'publish')
                ->getQuery()
                ->getResult();
    }
}