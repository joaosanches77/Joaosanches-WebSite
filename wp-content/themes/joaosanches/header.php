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

  <script type="text/javascript" charset="UTF-8"
    src="//cdn.cookie-script.com/s/9af0085cb2d33d870a63dfac78c75969.js"></script>

  <?php wp_head(); ?>


  <script src="<?= get_template_directory_uri() . "/dist/script/lib/owl.carousel.min.js" ?>"></script>

  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

  <meta name="google-site-verification" content="" />
</head>

<body <?php body_class(); ?>>
  <header class="fixed top-0 w-full inset-x-0 z-50 bg-gradient-to-b from-black to-transparent ">
    <div class="absolute w-[110vw] h-32 lg:h-72 bg-black blur-3xl top-1/2 -translate-y-1/2"></div>
    <nav id="main-nav" class=" relative z-30 main-container" aria-label="Top">
      <div id="menu" class="w-full py-6 flex items-center justify-between ">
        <div class="flex items-center">
          <a href="<?php echo home_url(); ?>">
            <div class="w-20 h-20  relative"> <img class=" w-full h-full object-contain"
                src="<?php echo get_template_directory_uri(); ?>/assets/img/jsnew.png"></div>
          </a>
        </div>
        <div class="flex items-center gap-8">
          <div class="hidden lg:flex lg:items-center lg:gap-8">
            <?php nav_main_menu(); ?>
          </div>

          <div class="hidden lg:flex">
            <a href="/#contactos"
              class="border border-white hover:bg-orange hover:border-orange js-transition px-6 py-3 rounded-full text-16px">Contactar</a>
          </div>
          <div class="flex items-center gap-4">
            <div class="hidden lg:block"> <?php language_selector(); ?>
            </div>
            <div class="lg:hidden">
              <button type="button" id="toggle-menu" class="p-2 rounded-md inline-flex items-center justify-center">
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
      <div id="mobile-menu" class=" rounded-b-3xl transition-main z-10 lg:hidden !overflow-visible">
        <nav class="w-full text-black flex flex-col items-center justify-center gap-10">
          <?php nav_main_menu("main-menu-mobile"); ?>
          <?php echo language_selector(); ?>
        </nav>
      </div>


    </nav>
  </header>