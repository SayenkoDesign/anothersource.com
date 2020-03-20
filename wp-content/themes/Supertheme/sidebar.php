<?php
/* sidebar.php */
$context = array();
$context['widget'] = Timber::get_widgets('sample_sidebar');
Timber::render('sidebar.html.twig', $context);