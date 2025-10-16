<?php
/**
 * 	Template Name: 001 - About
 */
get_header(); ?>

<?php

// BANNER
echo get_template_part("parts/hero"); 

// BLOCKS
 echo get_template_part("parts/blocks"); 

// AREAS
 echo get_template_part("parts/areas");

// CARD
 echo get_template_part("parts/card");

// TIMELINE
 echo get_template_part("parts/timeline"); 

// BLOCK HIGHLIGHT
 echo get_template_part("parts/blockhighlight"); 

// Products Highlights
echo get_template_part("parts/productsHighlights");



 get_footer(); ?>