<?php
$title = function_exists('get_field') ? get_field("title_footer", "options") : null;
$contacts = function_exists('get_field') ? get_field("contacts_footer", "options") : null;
$copyright = function_exists('get_field') ? get_field("copyright", "options") : null;
$newsletter = function_exists('get_field') ? get_field("newsletter", "options") : null;

$pages_bottom = function_exists('get_field') ? get_field("pages_bottom", "options") : null;
$social = function_exists('get_field') ? get_field("social", "options") : null;



?>
</main>


<footer class="">
  <div class="main-container py-8 overflow-hidden flex justify-between">
    <div class="text-center sm:text-left mx-auto sm:m-0 flex flex-col justify-center sm:justify-between">
      <a href="<?php echo home_url(); ?>">
        <div class="w-20 h-20  relative"> <img class=" w-full h-full object-contain"
            src="<?php echo get_template_directory_uri(); ?>/assets/img/jsnew.png"></div>
      </a>
    </div>
    <div class="flex flex-col md:flex-row items-center gap-6 text-grey-02">
      <span class="text-center sm:text-left"><?= $copyright ?></span>
    </div>
    <div class="">
      <?php if (!empty($social) && is_array($social)): ?>
        <div class="flex flex-col gap-1">
          <?php foreach ($social as $item): ?>
            <?php if (!empty($item['platform']['url']) && !empty($item['platform']['title'])): ?>
              <a href="<?= esc_url($item['platform']['url']) ?>" target="_blank" rel="noopener noreferrer"
                class="hover:text-green-03 js-transition text-white" aria-label="<?= esc_attr($item['platform']['title']) ?>">
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