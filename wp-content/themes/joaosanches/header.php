<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width" />
  <meta name="author" content="João Sanches" />
  <meta name="developer" content="João Sanches" />
  <meta name="author_website" content="https://www.joaosanches.pt" />

  <title>
    <?php if (is_front_page()) {
      bloginfo('name');
    } else {
      wp_title('&middot;', true, 'right') . bloginfo('name');
    } ?>
  </title>

  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <link rel="icon" href="<?= get_template_directory_uri() . "/assets/favicon.ico" ?>" type="image/x-icon" />


  <?php wp_head(); ?>

  <script>(function (w, d, s, l, i) {
      w[l] = w[l] || []; w[l].push({
        'gtm.start':
          new Date().getTime(), event: 'gtm.js'
      }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', '');</script>

  <script src="<?= get_template_directory_uri() . "/dist/script/lib/owl.carousel.min.js" ?>"></script>

  <meta name="google-site-verification" content="" />
</head>

<body <?php body_class(); ?>>
  <header class="fixed top-10 z-20 w-full main-container inset-x-0">
    <nav id="main-nav"
      class=" lg:max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative main-container shadow-lg rounded-full bg-white z-30"
      aria-label="Top">
      <div id="menu" class="w-full py-6 flex items-center justify-between ">
        <div class="flex items-center">
          <a href="<?php echo home_url(); ?>">
            <div class="w-24 h-10 bg-black"></div>
          </a>
        </div>
        <div class="flex items-center gap-8">
          <div class="hidden lg:flex lg:items-center lg:gap-8">
            <?php nav_main_menu(); ?>
          </div>

          <div class="flex items-center gap-4">
            <div class="hidden lg:block"> <?php language_selector(); ?>
            </div>
            <div class="lg:hidden">
              <button type="button" id="toggle-menu"
                class="p-2 rounded-md inline-flex items-center justify-center text-green-01">
                <span class="sr-only"><?php _e("Abrir Menu", "joaosanches"); ?></span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div id="mobile-menu" class=" bg-white rounded-b-3xl transition-main z-10 lg:hidden !overflow-visible">
        <nav class="w-full text-black flex flex-col items-center justify-center gap-10">
          <?php nav_main_menu("main-menu-mobile"); ?>
          <?php echo language_selector(); ?>
        </nav>
      </div>


    </nav>
  </header>