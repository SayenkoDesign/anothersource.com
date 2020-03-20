<?php

require_once __DIR__.'/app/bootstrap.php';

use Timber\Timber;



/** @var $timber Timber */

$timber = $container->get('timber');

$context = Timber::get_context();

$post = Timber::query_post();

$context['post'] = $post;

$context['post_categories'] =  get_the_category_list( '' );

$context['sidebar'] = Timber::get_widgets('sample_sidebar'); // Timber::get_sidebar('sidebar.php');

$templates = ['single-post.html.twig'];

$timber::render($templates, $context);