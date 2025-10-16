<?php
get_header();
?>

<?php

// HERO
echo get_template_part("parts/hero");

// Products Highlights
echo get_template_part("parts/productsHighlights");

// BLOCKS
echo get_template_part("parts/blocks");

// Company
echo get_template_part("parts/company");

// Block Highlight
echo get_template_part("parts/blockhighlight");

// News Highlights
echo get_template_part("parts/newsHighlights");


?>



<?php
get_footer();
?>