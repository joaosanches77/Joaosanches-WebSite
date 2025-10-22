<?php
# productsHighlights
$tagline = get_field("tagline_productsHighlights");
$title = get_field("title_productsHighlights");
$description = get_field("description_productsHighlights");

$product_page_url = get_post_type_archive_link('product');
?>


<section id="products" class="bg-gradient-to-b from-beje-02 to-white pt-16 sm:pt-20 pb-24 sm:pb-40">
    <div class="main-container">
        <div class="flex flex-col lg:flex-row justify-between">
            <div class="text-left flex flex-col gap-6 justify-center wow animate__animated animate__fadeIn">
                <p class="text-sm font-semibold text-green-04 uppercase tracking-wider">
                    <?php echo esc_html($tagline); ?>
                </p>
                <h1 class="text-32px tracking-tight text-green-01 sm:text-40px 3xl:text-56px !leading-[1.14] max-w-xl">
                    <?php echo esc_html($title); ?>
                </h1>
                <p class="text-grey-02 text-14px sm:max-w-xl md:text-16px lg:mx-0">
                    <?php echo esc_html($description); ?>
                </p>
            </div>
            <div
                class="mt-6 flex-shrink-0 flex flex-col sm:flex-row gap-8 sm:gap-4 md:gap-0 items-center sm:space-x-4 lg:mt-0 wow animate__animated animate__fadeIn">
                <a href="<?= $product_page_url ?>"
                    class="w-full flex items-center justify-center gap-3 px-8 py-6 text-16px rounded-full text-green-01 bg-green-04/10 hover:bg-green-04/30 js-transition font-medium">
                    <?php _e("Explorar toda a gama", "joaosanches"); ?>
                    <svg class="w-5 h-5 -rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <div class="flex items-center space-x-2">
                    <button
                        class="carousel-prev-btn p-2 rounded-full w-full flex items-center justify-center gap-3 px-8 py-6 text-16px font-medium text-green-01 bg-green-04/10 hover:bg-green-04/30 js-transition">
                        <span class="sr-only"><?php _e("Anterior", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </button>
                    <button
                        class="carousel-next-btn p-2 rounded-full w-full flex items-center justify-center gap-3 px-8 py-6 text-16px font-medium text-green-01 bg-green-04/10 hover:bg-green-04/30 js-transition">
                        <span class="sr-only"><?php _e("Seguinte", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-10 lg:mt-20 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
            <div class="owl-carousel product-carousel owl-theme">

                <?php

                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 9,
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

                        <div class="item flex flex-col h-full bg-white p-5 rounded-3xl shadow-sm mb-1">
                            <div class="flex justify-between items-center">
                                <?php if ($discount > 0): ?>
                                    <span
                                        class="text-16px text-green-02 bg-[#FFB260] px-2 py-1 rounded-md"><?php _e("Poupe", "joaosanches"); ?>
                                        <?php echo number_format($discount, 2, ',', ''); ?>€</span>
                                <?php else: ?>
                                    <span
                                        class="text-16px text-white bg-white px-2 py-1 rounded-md"><?php _e("Poupe", "joaosanches"); ?>0€</span>
                                <?php endif; ?>

                                <a href="<?php the_permalink(); ?>"
                                    class="text-16px text-green-03 hover:text-green-03/70 flex items-center gap-1 js-transition">
                                    <?php _e("Saber Mais", "joaosanches"); ?>
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </a>
                            </div>
                            <div class="py-6 flex-shrink-0">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>"
                                        alt="<?php the_title(); ?>" class="mx-auto h-56 object-contain">
                                </a>
                            </div>
                            <div class="flex-grow flex flex-col">
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

                                    <?php if ($product_volume): ?>
                                        <p class="text-16px text-green-01 mb-0.5"><?php echo esc_html($product_volume); ?></p>
                                    <?php endif; ?>

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
                                    <a href="<?php the_permalink(); ?>"
                                        class="inline-flex items-center gap-3 px-6 py-4 bg-green-01 text-white text-sm font-semibold rounded-full hover:bg-green-03 js-transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <path
                                                d="M4 7H22L20.3216 15.3922C20.1346 16.3271 19.3138 17 18.3604 17H7.63961C6.68625 17 5.86542 16.3271 5.67845 15.3922L4 7ZM4 7L3.18937 3.75746C3.07807 3.3123 2.67809 3 2.21922 3H1M18 21C18 21.5523 17.5523 22 17 22C16.4477 22 16 21.5523 16 21C16 20.4477 16.4477 20 17 20C17.5523 20 18 20.4477 18 21ZM10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21Z"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <?php _e("Ver na loja", "joaosanches"); ?>
                                    </a>
                                    <div class="text-right">
                                        <?php if ($discount > 0): ?>
                                            <span
                                                class="text-sm line-through text-grey-01"><?php echo number_format($regular_price, 2, ',', ''); ?>€</span>
                                        <?php endif; ?>
                                        <?php if ($sale_price): ?>
                                            <span
                                                class="text-xl font-bold text-green-01 ml-2"><?php echo number_format($sale_price, 2, ',', ''); ?>€</span>
                                        <?php else: ?>
                                            <span
                                                class="text-xl font-bold text-green-01 ml-2"><?php echo number_format($regular_price, 2, ',', ''); ?>€</span>
                                        <?php endif; ?>
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
    </div>

</section>