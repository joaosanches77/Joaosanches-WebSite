<?php
// Link base para a página de arquivo de 'work'
$archive_link = get_post_type_archive_link('work');

$title = get_field('title_services');

// Loop para preparar os dados
$services = [
    '1' => get_field('service_1'),
    '2' => get_field('service_2'),
    '3' => get_field('service_3'),
];

foreach ($services as $key => $s) {
    // Tenta usar o slug do Título para filtrar a categoria
    $slug = sanitize_title($s['title']);

    // Se tiveres um campo específico para o slug no ACF, usa antes: $s['slug_categoria']

    $services[$key]['link'] = $archive_link . '?category=' . $slug;
}
?>

<section id="servicos" class="main-container lg:py-10">
    <div class="flex flex-col lg:flex-row justify-between">
        <div class="text-left flex flex-col gap-6 justify-center wow animate__animated animate__fadeIn">
            <h1 class="text-32px tracking-tight text-green-01 sm:text-40px 3xl:text-56px !leading-[1.14] max-w-xl">
                <?php echo esc_html($title); ?>
            </h1>
        </div>
    </div>

    <div
        class="grid grid-cols-1 lg:grid-cols-12 grid-rows-1 lg:grid-rows-2 gap-5 wow animate__animated animate__fadeIn relative mt-10 lg:mt-20">
        <div class="w-32 h-32 lg:w-48 lg:h-48 bg-blue blur-3xl absolute right-1/2 -top-20 animate-float"></div>
        <div
            class="w-52 h-28 lg:w-72 lg:h-48 rotate-45 bg-orangeLight blur-3xl absolute -bottom-24 right-1/2 animate-float">
        </div>

        <a href="<?php echo esc_url($services['1']['link']); ?>"
            class="col-span-6 lg:row-span-1 relative rounded-3xl overflow-hidden flex justify-between items-stretch p-10 text-white w-full lg:h-96 group cursor-pointer">

            <img src="<?= $services['1']['image']['url']; ?>" alt="<?= $services['1']['image']['alt']; ?>"
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 js-transition"></div>

            <div
                class="relative flex flex-row items-center lg:items-stretch lg:flex-col rounded-3xl h-full justify-between w-full">
                <div>
                    <h2 class="text-24px md:text-32px 3xl:text-40px max-w-2xl text-white">
                        <?php echo esc_html($services['1']['title']); ?>
                    </h2>
                </div>
                <div class="flex justify-end">
                    <div
                        class="p-2 rounded-full w-10 h-10 flex items-center justify-center gap-3 px-2 py-2 text-16px font-medium group-hover:bg-white group-hover:text-black js-transition border border-white">
                        <span class="sr-only"><?php _e("Ver Trabalhos", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>

        <a href="<?php echo esc_url($services['3']['link']); ?>"
            class="col-span-6 lg:row-span-2 relative rounded-3xl overflow-hidden flex justify-between items-stretch p-10 text-white w-full h-full group cursor-pointer">

            <img src="<?= $services['3']['image']['url']; ?>" alt="<?= $services['3']['image']['alt']; ?>"
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 js-transition"></div>

            <div
                class="relative flex flex-row items-center lg:items-stretch lg:flex-col rounded-3xl h-full justify-between w-full">
                <div>
                    <h2 class="text-24px md:text-32px 3xl:text-40px max-w-2xl text-white">
                        <?php echo esc_html($services['3']['title']); ?>
                    </h2>
                </div>
                <div class="flex justify-end">
                    <div
                        class="p-2 rounded-full w-10 h-10 flex items-center justify-center gap-3 px-2 py-2 text-16px font-medium group-hover:bg-white group-hover:text-black js-transition border border-white">
                        <span class="sr-only"><?php _e("Ver Trabalhos", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>

        <a href="<?php echo esc_url($services['2']['link']); ?>"
            class="col-span-6 lg:row-span-1 relative rounded-3xl overflow-hidden flex justify-between items-stretch p-10 text-white w-full h-full group cursor-pointer">

            <img src="<?= $services['2']['image']['url']; ?>" alt="<?= $services['2']['image']['alt']; ?>"
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 js-transition"></div>

            <div
                class="relative flex flex-row items-center lg:items-stretch lg:flex-col rounded-3xl h-full justify-between w-full">
                <div>
                    <h2 class="text-24px md:text-32px 3xl:text-40px max-w-2xl text-white">
                        <?php echo esc_html($services['2']['title']); ?>
                    </h2>
                </div>
                <div class="flex justify-end">
                    <div
                        class="p-2 rounded-full w-10 h-10 flex items-center justify-center gap-3 px-2 py-2 text-16px font-medium group-hover:bg-white group-hover:text-black js-transition border border-white">
                        <span class="sr-only"><?php _e("Ver Trabalhos", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>

    </div>
</section>