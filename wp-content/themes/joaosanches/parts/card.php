<?php

$background_image = get_field('image_card');
$title = get_field('title_card');

// Variáveis para a lógica do botão
$button_type = get_field('button_type');
$button_link = get_field('button_link');
$file = get_field('file_card');
?>

<section class="pb-24 lg:pb-40">
    <div class="container-large mx-auto wow animate__animated animate__fadeIn">
        <div
            class="relative rounded-3xl overflow-hidden min-h-[500px] flex items-center justify-center px-10 py-40 text-center text-white">

            <?php if ($background_image): ?>
                <img src="<?php echo esc_url($background_image['url']); ?>"
                    alt="<?php echo esc_attr($background_image['alt']); ?>"
                    class="absolute inset-0 w-full h-full object-cover">
            <?php endif; ?>

            <div class="absolute inset-0 bg-green-01/60"></div>

            <div class="relative z-10 max-w-5xl">
                <h2 class="text-40px md:text-56px 3xl:text-80px mx-auto !leading-tight">
                    <?php echo esc_html($title); ?>
                </h2>

                <div class="mt-8">


                    <a download href="<?php echo esc_url($button_download['url']); ?>" download
                        class="inline-flex w-full md:w-auto items-center justify-center gap-3 px-8 py-6 border-2 border-green-04 rounded-full text-base font-medium text-green-04 hover:bg-green-04 hover:text-white js-transition">
                        <span><?php _e("Download Brochure", "joaosanches"); ?></span> <svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M4 15.5911C2.81055 14.9966 2 13.8151 2 12.4545C2 10.89 3.0718 9.56223 4.55906 9.09163C4.52015 8.83913 4.5 8.58088 4.5 8.31818C4.5 5.38103 7.0184 3 10.125 3C12.2092 3 14.0287 4.0717 15.0005 5.66404C15.4153 5.47166 15.8818 5.36364 16.375 5.36364C18.1009 5.36364 19.5 6.68643 19.5 8.31818C19.5 8.58074 19.4638 8.8353 19.3958 9.07764C20.9065 9.53545 22 10.8743 22 12.4545C22 13.8151 21.1895 14.9966 20 15.5911M12 21L16 17M12 21L8 17M12 21V12"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>