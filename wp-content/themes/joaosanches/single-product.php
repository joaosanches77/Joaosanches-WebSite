<?php
get_header();

if (have_posts()):
  while (have_posts()):
    the_post();



    // Campos personalizados (ACF)
    $main_title = get_field('main_title');
    $regular_price = get_field('regular_price') || 0;
    $sale_price = get_field('sale_price');
    $product_volume = get_field('product_volume');
    $short_description = get_field('product_description');
    $main_ingredients = get_field('main_ingredients');
    $features = get_field('features');
    $benefits = get_field('benefits');
    $product_url_data = get_field('external_link');


    // NOVO: Campo de Galeria para o produto
    $product_gallery = get_field('product_gallery');

    $discount = 0;
    if ($regular_price && $sale_price) {
      $discount = $regular_price - $sale_price;
    }


    $tagline = get_field('tagline_products', 'option');
    $title = get_field('title_products', 'option');
    $description = get_field('description_products', 'option');
    ?>

    <section class="padding-nav-small pb-16 sm:pb-24">
      <div class="main-container mx-auto">

        <?php if ($main_title): ?>
          <h1 class="text-40px lg:text-48px xl:text-56px text-green-01 text-center max-w-4xl mx-auto !leading-tight">
            <?php echo esc_html($main_title); ?>
          </h1>
        <?php endif; ?>

        <div class="mt-20 grid grid-cols-1 xl:grid-cols-2 gap-12 lg:gap-16">

          <div class="space-y-8">

            <h2 class="text-24px lg:text-32px xl:text-40px text-green-01"><?php the_title(); ?>
              <?php if ($product_volume)
                echo esc_html($product_volume); ?>
            </h2>

            <div>
              <?php if ($product_gallery): ?>
                <div class="product-gallery-carousel owl-carousel owl-theme bg-white rounded-3xl p-4">
                  <?php foreach ($product_gallery as $image): ?>
                    <div class="item">
                      <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
                        class="w-full h-auto object-contain aspect-square">
                    </div>
                  <?php endforeach; ?>
                </div>

              <?php else: ?>
                <div class="relative">
                  <?php if ($discount > 0): ?>
                    <span
                      class="absolute top-4 left-4 text-base font-bold text-orange-800 bg-orange-200 px-3 py-1.5 rounded-md z-10">
                      <?php _e("Poupe", "joaosanches"); ?>         <?php echo number_format($discount, 2, ',', ''); ?>€
                    </span>
                  <?php endif; ?>
                  <div class="bg-white rounded-3xl p-8 aspect-square">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-contain']); ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 items-center">
              <div class="text-left">
                <?php if ($discount > 0): ?>
                  <span
                    class="text-lg line-through text-grey-01"><?php echo number_format($regular_price, 2, ',', ''); ?>€</span>
                <?php endif; ?>
                <span
                  class="text-3xl font-bold text-green-01 ml-2"><?php echo number_format($sale_price ?: $regular_price, 2, ',', ''); ?>€</span>
              </div>
              <div class="flex-grow"></div>
              <?php if (isset($product_url_data['url']) && !empty($product_url_data['url'])): ?>
                <div class="flex items-center gap-4">
                  <a href="<?php echo esc_url($product_url_data['url']); ?>"
                    target="<?php echo esc_attr($product_url_data['target']); ?>"
                    class="inline-flex items-center gap-3 px-6 py-4 bg-green-01 text-white text-sm font-semibold rounded-full hover:bg-green-03 js-transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path
                        d="M4 7H22L20.3216 15.3922C20.1346 16.3271 19.3138 17 18.3604 17H7.63961C6.68625 17 5.86542 16.3271 5.67845 15.3922L4 7ZM4 7L3.18937 3.75746C3.07807 3.3123 2.67809 3 2.21922 3H1M18 21C18 21.5523 17.5523 22 17 22C16.4477 22 16 21.5523 16 21C16 20.4477 16.4477 20 17 20C17.5523 20 18 20.4477 18 21ZM10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21Z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <?php _e("Ver na loja", "joaosanches"); ?>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="space-y-10">

            <div>
              <p class="text-12px font-bold text-green-04 uppercase tracking-wider">
                <?php _e("Descrição", "joaosanches"); ?>
              </p>
              <div class="mt-2 text-24px text-grey-02 prose max-w-none">
                <?php echo $short_description; ?>
              </div>
            </div>

            <?php
            $product_tags = get_the_terms(get_the_ID(), 'product_tag');
            if ($product_tags && !is_wp_error($product_tags)):
              ?>
              <div>
                <p class="text-12px font-bold text-green-04 uppercase tracking-wider">
                  <?php _e("Ingredientes Principais", "joaosanches"); ?>
                </p>
                <div class="mt-4 flex flex-wrap gap-2">
                  <?php foreach ($product_tags as $index => $tag): ?>
                    <div class="bg-green-03 text-white px-3 py-2 rounded-md text-16px">
                      <?php echo esc_html($tag->name); ?>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if ($features): ?>
              <div>
                <p class="text-12px font-bold text-green-04 uppercase tracking-wider">
                  <?php _e("Características", "joaosanches"); ?>
                </p>
                <div class="mt-4 flex flex-wrap gap-4">
                  <?php foreach ($features as $feature): ?>
                    <div class="w-full md:w-[calc(50%-0.5rem)]">
                      <div class="bg-beje-01 rounded-2xl p-6 h-full flex">
                        <div class="text-16px text-green-01">
                          <h4 class="font-semibold"><?php echo esc_html($feature['title']); ?></h4>
                          <p class="mt-2"><?php echo esc_html($feature['description']); ?></p>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if ($benefits): ?>
              <div>
                <p class="text-16px font-bold text-green-04 uppercase">
                  <?php _e("Benefícios", "joaosanches"); ?>
                </p>
                <div class="mt-4 flex flex-col sm:flex-row gap-5">
                  <?php foreach ($benefits as $benefit): ?>
                    <div class="border border-green-03 rounded-3xl p-6 text-center my-auto">
                      <span class="text-green-03 font-semibold text-16px"><?php echo esc_html($benefit['title']); ?></span>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>

          </div>
        </div>



      </div>

      <div class="main-container pt-48">
        <div class="flex flex-col lg:flex-row justify-between">
          <div class="text-left flex flex-col gap-6 justify-center">
            <p class="text-sm font-semibold text-green-04 uppercase tracking-wider">
              <?php echo esc_html($tagline); ?>
            </p>
            <h1 class="text-32px tracking-tight text-green-01 sm:text-40px md:text-56px !leading-[1.14] max-w-xl">
              <?php echo esc_html($title); ?>
            </h1>
            <p class="text-grey-02 text-14px sm:max-w-xl md:text-16px lg:mx-0">
              <?php echo esc_html($description); ?>
            </p>
          </div>
          <div
            class="mt-6 flex-shrink-0 flex flex-col sm:flex-row gap-8 sm:gap-4 md:gap-0 items-center sm:space-x-4 lg:mt-0">
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
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
              </button>
              <button
                class="carousel-next-btn p-2 rounded-full w-full flex items-center justify-center gap-3 px-8 py-6 text-16px font-medium text-green-01 bg-green-04/10 hover:bg-green-04/30 js-transition">
                <span class="sr-only"><?php _e("Seguinte", "joaosanches"); ?></span>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <div class="mt-10 lg:mt-20">
          <div class="owl-carousel product-carousel owl-theme">

            <?php

            $args = array(
              'post_type' => 'product',
              'posts_per_page' => 9,
              'orderby' => 'rand'
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

                <div class="item flex flex-col h-full bg-white p-5 rounded-3xl shadow-sm">
                  <div class="flex justify-between items-center">
                    <?php if ($discount > 0): ?>
                      <span class="text-16px text-green-02 bg-[#FFB260] px-2 py-1 rounded-md"><?php _e("Poupe", "joaosanches"); ?>
                        <?php echo number_format($discount, 2, ',', ''); ?>€</span>
                    <?php else: ?>
                      <span class="text-16px text-white bg-white px-2 py-1 rounded-md"><?php _e("Poupe", "joaosanches"); ?> 0
                        €</span>
                    <?php endif; ?>

                    <a href="<?php the_permalink(); ?>"
                      class="text-16px text-green-03 hover:text-green-03/70 flex items-center gap-1 js-transition">
                      <?php _e("Saber Mais", "joaosanches"); ?>
                      <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
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
                      <p class="text-14px text-grey-02 mt-2 line-clamp-3">
                        <?php echo esc_html($product_description); ?>
                      </p>
                    <?php endif; ?>

                    <div class="flex-grow"></div>
                    <div class="mt-6 flex justify-between items-center">
                      <a href="<?= $product_url["url"] ?>"
                        class="inline-flex items-center gap-3 px-6 py-4 bg-green-01 text-white text-sm font-semibold rounded-full hover:bg-green-03 js-transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path
                            d="M4 7H22L20.3216 15.3922C20.1346 16.3271 19.3138 17 18.3604 17H7.63961C6.68625 17 5.86542 16.3271 5.67845 15.3922L4 7ZM4 7L3.18937 3.75746C3.07807 3.3123 2.67809 3 2.21922 3H1M18 21C18 21.5523 17.5523 22 17 22C16.4477 22 16 21.5523 16 21C16 20.4477 16.4477 20 17 20C17.5523 20 18 20.4477 18 21ZM10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <?php _e("Ver na loja", "joaosanches"); ?>
                      </a>
                      <div class="text-right">
                        <?php if ($discount > 0): ?>
                          <span
                            class="text-sm line-through text-grey-01"><?php echo number_format($regular_price, 2, ',', ''); ?>€</span>
                        <?php endif; ?>
                        <span
                          class="text-xl font-bold text-green-01 ml-2"><?php echo number_format($sale_price ? $sale_price : $regular_price, 2, ',', ''); ?>€</span>
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

    <?php
  endwhile;
endif;
get_footer();
?>