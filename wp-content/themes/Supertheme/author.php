<?php

require_once __DIR__.'/app/bootstrap.php';

use Timber\Timber;

use Timber\User;



/** @var $timber Timber */

$timber = $container->get('timber');

$context = Timber::get_context();

$context['posts'] = Timber::get_posts();

$context['sidebar'] = Timber::get_widgets('sample_sidebar'); // Timber::get_sidebar('sidebar.php');

$templates = ['author.html.twig', 'archive.html.twig', 'index.html.twig'];

if (isset($wp_query->query_vars['author'])) {

    $author = new User($wp_query->query_vars['author']);

    $context['author'] = $author;

    $context['title'] = $author->name();

}

$page_for_posts = get_option( 'page_for_posts' );

$blog = new TimberPost( $page_for_posts );

$context['blog'] = $blog;

$timber::render($templates, $context);

