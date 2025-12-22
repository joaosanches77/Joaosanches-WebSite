<?php
# worksHighlights
$title = get_field("title_worksHighlights");
$button = get_field("button_worksHighlights");

$work_page_url = get_post_type_archive_link('works');
$work_tags = get_the_terms(get_the_ID(), 'work_tag');
?>


<section id="trabalhos" class=" pt-16 sm:pt-20 pb-24 sm:pb-40 relative">
    <div
        class="w-52 h-28 lg:w-72 lg:h-48 rotate-45 bg-orangeLight blur-3xl absolute -top-32 right-20 animate-float delay-5000 scale-50">
    </div>
    <div class="main-container flex flex-col">
        <div class="flex flex-col lg:flex-row justify-between">
            <div class="text-left flex flex-col gap-6 justify-center wow animate__animated animate__fadeIn z-30">
                <h1 class="text-32px tracking-tight text-green-01 sm:text-40px 3xl:text-56px !leading-[1.14] max-w-xl">
                    <?php echo esc_html($title); ?>
                </h1>
            </div>
            <div
                class="mt-6 flex-shrink-0 lg:flex-col gap-8 sm:gap-4 md:gap-0 items-center sm:space-x-4 lg:mt-0 wow animate__animated animate__fadeIn z-30 hidden lg:flex">
                <a href="<?= $button["url"] ?>"
                    class="w-full flex items-center justify-center gap-3 px-8 py-4 text-16px rounded-full text-white hover:text-black hover:bg-white js-transition font-medium border border-white">
                    <?php _e("Ver mais", "joaosanches"); ?>

                </a>
            </div>
        </div>

        <div class="mt-10 lg:mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
            <div class="owl-carousel product-carousel owl-theme">

                <?php

                $args = array(
                    'post_type' => 'work',
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                // Criamos uma nova instância da WP_Query
                $products_query = new WP_Query($args);

                // O Loop padrão do WordPress com a nossa query
                if ($products_query->have_posts()):
                    while ($products_query->have_posts()):
                        $products_query->the_post(); // Prepara os dados do post atual
                

                        $work_tags = get_the_terms(get_the_ID(), 'work_tag');

                        $discount = 0;
                        if ($regular_price && $sale_price) {
                            $discount = $regular_price - $sale_price;
                        }

                        ?>

                        <div class="item flex flex-col h-full mb-1 group py-2">
                            <a href="<?php the_permalink(); ?>"
                                class="h-full border border-grey-dark group-hover:-translate-y-1 js-transition rounded-3xl shadow-sm flex flex-col overflow-hidden cursor-pointer group">

                                <div class="flex-shrink-0 rounded-t-3xl overflow-hidden relative">

                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>"
                                        alt="<?php the_title(); ?>" class="h-96 w-full object-cover">

                                    <?php if ($work_tags && !is_wp_error($work_tags)): ?>
                                        <div class="absolute top-4 left-4 z-10 flex flex-wrap gap-2">
                                            <?php foreach ($work_tags as $tag): ?>
                                                <span
                                                    class="text-12px font-medium text-white bg-black/50 border border-grey-dark/50 px-3 py-1.5 rounded-full shadow-sm">
                                                    <?php echo esc_html($tag->name); ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="flex-grow flex flex-col p-5">

                                    <div class="flex items-end gap-2 mt-3">
                                        <h3 class="text-24px font-medium text-green-01">
                                            <?php the_title(); ?>
                                        </h3>
                                    </div>

                                    <div class="flex-grow"></div>

                                    <div class="mt-6 flex justify-between items-center">
                                        <span
                                            class="inline-flex items-center gap-3 px-3 py-2 bg-white/10 text-white text-sm rounded-full ">
                                            <?php
                                            $cats = get_the_terms(get_the_ID(), 'work_category');
                                            if (!$cats || is_wp_error($cats)) {
                                                $cats = get_the_terms(get_the_ID(), 'category');
                                            }

                                            if ($cats && !is_wp_error($cats)) {
                                                $names = array();
                                                foreach ($cats as $c) {
                                                    $names[] = esc_html($c->name);
                                                }
                                                echo implode(', ', $names);
                                            }
                                            ?>
                                        </span>

                                        <div class="text-right">
                                            <div
                                                class="carousel-prev-btn p-2 rounded-full w-10 h-10 flex items-center justify-center text-16px font-medium group-hover:bg-white group-hover:text-black js-transition border border-white text-white">
                                                <span class="sr-only"><?php _e("Ver Detalhe", "joaosanches"); ?></span>
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
        </div>
        <div
            class="mt-6 flex-shrink-0 flex flex-col gap-8 sm:gap-4 md:gap-0 items-center sm:space-x-4 lg:mt-0 wow animate__animated animate__fadeIn z-30 lg:hidden">
            <a href="<?= $button["url"] ?>"
                class="w-full flex items-center justify-center gap-3 px-8 py-4 text-16px rounded-full text-white hover:text-black hover:bg-white js-transition font-medium border border-white">
                <?php _e("Ver mais", "joaosanches"); ?>

            </a>
        </div>
    </div>

</section>