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

<a id="back-to-top" href="#"
  class="fixed bottom-8 right-8 z-50 w-14 h-14 rounded-full bg-[#FF4500] text-white flex items-center justify-center shadow-lg transition-all duration-500 opacity-0 invisible hover:-translate-y-2 hover:shadow-xl group">

  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
    class="w-8 h-8 group-hover:scale-110 transition-transform duration-300">
    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
  </svg>
</a>
</body>

</html>