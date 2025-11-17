<?php
get_header();


$description = 'Aqui podes encontrar alguns dos meus
melhores trabalhos';

// Vai buscar todas as categorias de produtos para criar os botões de filtro.
$product_categories = get_terms(array(
  'taxonomy' => 'product_category',
  'hide_empty' => true,
));
?>

<section class="pb-24 sm:pb-40 padding-nav-small">
  <div class="main-container mx-auto wow animate__animated animate__fadeIn">

    <div class="flex flex-col justify-center max-w-2xl text-center mx-auto mb-20">
      <h1 class="mt-4 text-48px lg:text-56px text-green-01">
        <?php _e("Trabalhos", "joaosanches"); ?>
      </h1>
      <p class="mt-6 text-16px text-grey-02">
        <?php echo esc_html($description); ?>
      </p>
    </div>

    <?php if (!empty($product_categories) && !is_wp_error($product_categories)): ?>
      <div class="flex items-center justify-center flex-wrap gap-4 mb-12 mt-10">
        <button
          class="filter-btn is-active px-6 py-3 rounded-full text-base font-medium bg-green-04 text-white js-transition border border-green-04 hover:bg-green-04 hover:text-white wow animate__animated animate__fadeInRight"
          data-wow-delay=".3s" data-filter="*">
          <?php _e("Todos", "joaosanches"); ?>
        </button>
        <?php $i = 0;
        foreach ($product_categories as $category): ?>
          <button
            class="filter-btn px-6 py-3 rounded-full text-base font-medium border border-green-04 text-green-01 hover:bg-green-04 hover:text-white js-transition wow animate__animated animate__fadeInRight"
            data-wow-delay=".<?= 3 + $i++; ?>s" data-filter="<?php echo $category->slug; ?>">
            <?php echo esc_html($category->name); ?>
          </button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>


    <div id="product-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

      <?php
      if (have_posts()):
        $i = 0;
        while (have_posts()):
          the_post();
          ?>
          <div class="wow animate__animated animate__fadeInUp" data-wow-delay=".<?= 3 + $i++; ?>s">
            <?php get_template_part('parts/card-product'); ?>
          </div>
          <?php
        endwhile;
      else:
        echo '<p class="lg:col-span-3 text-center">Nenhum produto encontrado.</p>';
      endif;
      ?>
    </div>

    <div class="mt-16 text-center">
      <?php the_posts_pagination(); ?>
    </div>

  </div>
</section>

<?php
get_footer();
?>