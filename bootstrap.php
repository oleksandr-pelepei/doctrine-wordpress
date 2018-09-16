<?php

require __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Events;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Util\Debug;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Wordpress\DoctrineExtension\TablePrefix;
use Wordpress\Entity\Post\Post;
use Wordpress\Entity\Post\Page;
use Wordpress\Entity\Term\Taxonomy;
use Wordpress\Entity\Term\Term;

$config = Setup::createAnnotationMetadataConfiguration( [__DIR__ . '/src'], true );

$connectionConf = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => null,
    'dbname' => 'wp_playground'
];

$evm = new EventManager();

// Table Prefix
$wpTablePrefix = new TablePrefix('wp_');
$evm->addEventListener(Events::loadClassMetadata, $wpTablePrefix);

$entityManager = EntityManager::create($connectionConf, $config, $evm);

$connection = $entityManager->getConnection();

try {
    $rps = $entityManager->getRepository( Post::class );
    $term = $entityManager->getRepository( Term::class )->find(1);
    
    $post = new Post();
    
    $entityManager->persist($post);
    
    $post->setContent('Blah')
            ->setTitle('Blah')
            ->setSlug('blah');
    
    $post->addTerm($term);
    
        
    
    // $query = $entityManager->createQuery( 
    //     $r->createQueryBuilder('p')
    //     ->select()
    //     ->setFirstResult(0)
    //     ->setMaxResults(1)
    //     ->getDQL()
    // );
    // $res = $query->getResult();

    Debug::dump( $post );

} catch (Exception $e) {
    Debug::dump($e);
}