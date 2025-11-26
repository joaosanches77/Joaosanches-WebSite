<?php
// 1. Obter o Título (Nome correto: title_hero)
$hero_title = get_field('title_hero');

// 2. Obter os Subtítulos do Repetidor (Nome correto: subtitles_hero)
$typed_strings = [];

if (have_rows('subtitles_hero')) {
    while (have_rows('subtitles_hero')) {
        the_row();

        // 3. Obter o Texto de cada linha (Nome correto: subtitles)
        $text = get_sub_field('subtitles');

        if ($text) {
            $typed_strings[] = $text;
        }
    }
}

// Junta tudo com vírgulas: "Fotografia,Video,Websites,..."
$data_items = implode(',', $typed_strings);
?>

<section id="hero" class="bg-black h-[95vh] relative">
    <video autoplay muted loop playsinline
        class="absolute inset-0 w-full h-full object-cover blur-3xl opacity-80 scale-75 lg:scale-100">
        <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/fireballs2.mp4" type="video/mp4">
    </video>

    <div class="main-container absolute top-1/2 right-1/2 translate-x-1/2 -translate-y-1/2 z-30 text-center w-full px-4"
        data-aos="zoom-in" data-aos-delay="100">

        <h1 class="text-40px sm:text-80px text-white mb-2 leading-tight">
            <?php echo esc_html($hero_title); ?>
        </h1>

        <p class="text-orange text-32px sm:text-40px font-medium min-h-[60px]">
            <span class="typed" data-typed-items="<?php echo esc_attr($data_items); ?>"></span>
        </p>

    </div>
</section>