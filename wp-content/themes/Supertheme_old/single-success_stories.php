<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;
use Timber\Post;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = Timber::get_context();
$post = new Post();
$context['post'] = $post;
$context["acf"] = get_field_objects($context["post"]->ID);
$templates = ['single-success_stories.html.twig', 'page.html.twig', 'index.html.twig'];

if (is_front_page()) {
    array_unshift($templates, 'front.html.twig');
}

Timber::render($templates, $context);