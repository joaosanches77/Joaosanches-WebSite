<?php

$social = function_exists('get_field') ? get_field("social", "options") : null;


?>
</main>


<footer class="">
  <div
    class="main-container py-8 overflow-hidden flex flex-col gap-7 lg:gap-0 lg:flex-row justify-between items-center">
    <div class="text-center sm:text-left mx-auto sm:m-0 flex flex-col justify-center sm:justify-between">
      <a class="flex items-center gap-4 text-12px" href="<?php echo home_url(); ?>">
        <div class="w-20 h-20  relative"> <img class=" w-full h-full object-contain"
            src="<?php echo get_template_directory_uri(); ?>/assets/img/jsnew.png"></div>
        © 2025 João Sanches. All rights Reserved.
      </a>
    </div>
    <div class="">
      <?php if (!empty($social) && is_array($social)): ?>
        <div class="flex gap-5">
          <?php foreach ($social as $item): ?>
            <?php if (!empty($item['platform']['url']['url']) && !empty($item['platform']['title'])): ?>
              <a href="<?= esc_url($item['platform']['url']['url']) ?>" target="_blank" rel="noopener noreferrer"
                class="hover:text-green-03 js-transition text-white hover:underline hover:text-orange"
                aria-label="<?= esc_attr($item['platform']['title']) ?>">
                <?= $item['platform']['title'] ?>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="py-5 flex flex-col lg:flex-row justify-between items-center text-12px gap-5 lg:gap-0">
      <div class="flex justify-center">
        <a href="https://www.joaosanches.pt/" target="_blank" rel="noopener noreferrer"
          aria-label="link to author - joaosanches">
          <p class=""> Made by <a class="underline hover:text-orange js-transition"
              href="https://www.joaosanches.pt">João Sanches</a>
          </p>
        </a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>


</body>

</html>