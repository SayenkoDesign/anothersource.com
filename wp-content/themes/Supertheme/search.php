<?php

require_once __DIR__.'/app/bootstrap.php';

use Timber\Timber;



/** @var $timber Timber */

$timber = $container->get('timber');

$templates = ['search.html.twig', 'archive.html.twig', 'index.html.twig'];

$context = Timber::get_context();

$context['title'] = 'Search results for '. get_search_query();

$context['posts'] = Timber::get_posts();

$context['sidebar'] = Timber::get_widgets('sample_sidebar'); // Timber::get_sidebar('sidebar.php');

$page_for_posts = get_option( 'page_for_posts' );

$blog = new TimberPost( $page_for_posts );

$context['blog'] = $blog;

Timber::render($templates, $context);

