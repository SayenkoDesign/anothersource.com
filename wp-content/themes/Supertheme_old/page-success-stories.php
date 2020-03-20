<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;
use Timber\Post;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = Timber::get_context();

$args = ['post_type' => 'success_stories'];
if(get_query_var('term')) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $args['tax_query'] = [[
        'taxonomy' => 'success_category',
        'field' => 'id',
        'terms' => $term->term_id,
    ]];
    $context['current_category'] = $term;
}


$context['post'] =  new Post();
$context["acf"] = get_field_objects($context["post"]->ID);
$context['categories'] = Timber::get_terms('success_category');
$context['posts'] = Timber::get_posts($args);

$templates = ['archive-success_stories.html.twig', 'archive.html.twig', 'index.html.twig'];
$timber::render($templates, $context);
