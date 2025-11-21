<?php
# worksHighlights
$title = get_field("title_worksHighlights");

$product_page_url = get_post_type_archive_link('works');
?>


<section id="trabalhos" class=" pt-16 sm:pt-20 pb-24 sm:pb-40 relative">
    <div class="w-72 h-48 rotate-45 bg-orange blur-3xl absolute -top-32 right-0"></div>
    <div class="main-container flex flex-col">
        <div class="flex flex-col lg:flex-row justify-between">
            <div class="text-left flex flex-col gap-6 justify-center wow animate__animated animate__fadeIn">
                <h1 class="text-32px tracking-tight text-green-01 sm:text-40px 3xl:text-56px !leading-[1.14] max-w-xl">
                    <?php echo esc_html($title); ?>
                </h1>
            </div>
            <div
                class="mt-6 flex-shrink-0 lg:flex-col gap-8 sm:gap-4 md:gap-0 items-center sm:space-x-4 lg:mt-0 wow animate__animated animate__fadeIn z-30 hidden lg:flex">
                <a href="<?= $product_page_url ?>"
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
                
                        // Vamos buscar os campos personalizados (ACF)
                        $regular_price = get_field('regular_price') || 0;
                        $sale_price = get_field('sale_price');
                        $product_volume = get_field('product_volume');
                        $product_tags = get_the_terms(get_the_ID(), 'product_tag');

                        $discount = 0;
                        if ($regular_price && $sale_price) {
                            $discount = $regular_price - $sale_price;
                        }

                        ?>

                        <div class="item flex flex-col h-full  mb-1 group py-2  ">
                            <div
                                class=" border border-grey-dark group-hover:-translate-y-1 js-transition rounded-3xl shadow-sm">

                                <div class="flex-shrink-0 rounded-t-3xl overflow-hidden">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>"
                                            alt="<?php the_title(); ?>" class="mx-auto h-96 object-cover">
                                    </a>
                                </div>
                                <div class="flex-grow flex flex-col p-5">
                                    <?php if ($product_tags && !is_wp_error($product_tags)): ?>
                                        <div class="flex flex-wrap gap-2">
                                            <?php foreach ($product_tags as $tag): ?>
                                                <span
                                                    class="text-12px text-green-01 bg-beje-01 px-2 py-1 rounded-md"><?php echo esc_html($tag->name); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="flex items-end gap-2 mt-3">

                                        <h3 class="text-24px font-medium text-green-01 "><a
                                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                    </div>
                                    <?php
                                    $product_description = get_field('product_description');
                                    if ($product_description):
                                        ?>
                                        <p class="text-14px text-grey-02 mt-2 line-clamp-2">
                                            <?php echo esc_html($product_description); ?>
                                        </p>
                                    <?php endif; ?>

                                    <div class="flex-grow"></div>
                                    <div class="mt-6 flex justify-between items-center">
                                        <span
                                            class="inline-flex items-center gap-3 px-3 py-2 bg-white/10 text-white text-sm rounded-full">
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
                                            <a
                                                class="carousel-prev-btn p-2 rounded-full w-full flex items-center justify-center gap-3 px-2 py-2 text-16px font-medium  group-hover:bg-white group-hover:text-black js-transition border border-white">
                                                <span class="sr-only"><?php _e("Anterior", "joaosanches"); ?></span>
                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            <a href="<?= $product_page_url ?>"
                class="w-full flex items-center justify-center gap-3 px-8 py-4 text-16px rounded-full text-white hover:text-black hover:bg-white js-transition font-medium border border-white">
                <?php _e("Ver mais", "joaosanches"); ?>

            </a>
        </div>
    </div>

</section>