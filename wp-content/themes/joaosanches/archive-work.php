<?php
get_header();


$description = 'Aqui podes encontrar alguns dos meus
melhores trabalhos';

// Vai buscar todas as categorias de produtos para criar os botões de filtro.
$work_categories = get_terms(array(
  'taxonomy' => 'work_category',
  'hide_empty' => true,
));
?>

<section class="padding-nav-small relative">
  <div class="main-container mx-auto wow animate__animated animate__fadeIn z-30">
    <div class=" bg-black h-[50vh] relative">
      <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover blur-3xl opacity-50">
        <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/fireballs2.mp4" type="video/mp4">
      </video>
      <div class="main-container absolute top-1/2 right-1/2 translate-x-1/2 -translate-y-1/2 !z-30 text-center"
        data-aos="zoom-in" data-aos-delay="100">
        <h1 class="text-48px lg:text-80px text-white font-medium">
          <?php _e("Trabalhos", "joaosanches"); ?>
        </h1>
        <p class="mt-4 text-20px text-white opacity-75 max-w-2xl">
          <?php echo esc_html($description); ?>
        </p>
      </div>
    </div>



    <?php if (!empty($work_categories) && !is_wp_error($work_categories)): ?>
      <div class="flex items-center justify-center flex-wrap gap-4 mb-12 mt-20">
        <button
          class="filter-btn is-active px-6 py-3 rounded-full text-base font-medium js-transition border border-white hover:bg-white hover:text-black wow animate__animated animate__fadeInRight"
          data-wow-delay=".3s" data-filter="*">
          <?php _e("Todos", "joaosanches"); ?>
        </button>
        <?php $i = 0;
        foreach ($work_categories as $category): ?>
          <button
            class="filter-btn px-6 py-3 rounded-full text-base font-medium  js-transition border border-white hover:bg-white hover:text-black wow animate__animated animate__fadeInRight"
            data-wow-delay=".<?= 3 + $i++; ?>s" data-filter="<?php echo $category->slug; ?>">
            <?php echo esc_html($category->name); ?>
          </button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>


    <div id="work-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

      <?php
      if (have_posts()):
        $i = 0;
        while (have_posts()):
          the_post();
          ?>
          <div class="wow animate__animated animate__fadeInUp" data-wow-delay=".<?= 3 + $i++; ?>s">
            <?php get_template_part('parts/card-work'); ?>
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
  <div class="w-52 h-28 lg:w-72 lg:h-48 rotate-45 bg-orangeLight blur-3xl absolute -bottom-16 right-1/2 animate-float">
  </div>
</section>

<?php
// Contacts
get_template_part("parts/contacts");

get_footer();
?>