<?php
require_once __DIR__.'/app/bootstrap.php';
use Timber\Timber;

/** @var $timber Timber */
$timber = $container->get('timber');
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$templates = ['404.html.twig', 'index.html.twig'];
$timber::render($templates, $context);
