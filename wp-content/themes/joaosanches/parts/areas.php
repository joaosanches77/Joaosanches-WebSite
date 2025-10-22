<?php
$tagline = get_field('tagline_areas');
$title = get_field('title_areas');
$description = get_field('description_areas');
$items_areas = get_field('items_areas');
?>

<section id="areas" class="py-24 sm:py-40 overflow-hidden">
    <div class="main-container mx-auto">
        <div class="grid grid-cols-1 3xl:grid-cols-3 gap-8 3xl:gap-12 items-center">

            <div class="3xl:col-span-1 3xl:max-w-sm wow animate__animated animate__fadeIn">
                <p class="text-12px font-bold text-green-04 uppercase tracking-wider">
                    <?= $tagline ?>
                </p>
                <h2 class="mt-4 text-48px 3xl:text-56px text-green-01">
                    <?= $title ?>
                </h2>
                <p class="mt-4 text-16px text-grey-02">
                    <?= $description ?>
                </p>
                <div class="mt-8 flex items-center gap-4 w-auto">
                    <button
                        class="areas-carousel-prev-btn p-2 rounded-full flex items-center justify-center gap-3 px-8 py-6 text-16px font-medium text-green-01 bg-green-04/10 hover:bg-green-04/30 js-transition">
                        <span class="sr-only"><?php _e("Anterior", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </button>
                    <button
                        class="areas-carousel-next-btn p-2 rounded-full flex items-center justify-center gap-3 px-8 py-6 text-16px font-medium text-green-01 bg-green-04/10 hover:bg-green-04/30 js-transition">
                        <span class="sr-only"><?php _e("Seguinte", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="3xl:col-span-2">
                <?php if ($items_areas): ?>
                    <div class="owl-carousel areas-carousel owl-theme">
                        <?php $i = 0;
                        foreach ($items_areas as $item): ?>
                            <div class="item h-full wow animate__animated animate__fadeInRight"
                                data-wow-delay=".<?= 3 + $i++; ?>s">
                                <div class="bg-white rounded-3xl p-6 h-full flex flex-col">
                                    <div>
                                        <h3 class="text-24px font-medium text-green-01">
                                            <?php echo esc_html($item['title']); ?>
                                        </h3>
                                        <p class="mt-2 text-16px text-grey-02">
                                            <?php echo esc_html($item['description']); ?>
                                        </p>
                                    </div>

                                    <div class="flex-grow"></div>

                                    <div class="mt-24 <?php if (empty($item['button']))
                                        echo 'invisible'; ?>">
                                        <a download href="<?php echo esc_url($item['button']['url'] ?? '#'); ?>"
                                            target="<?php echo esc_attr($item['button']['target'] ?? '_self'); ?>"
                                            class="w-full flex items-center justify-center gap-3 px-8 py-6 text-16px font-medium rounded-full text-green-01 bg-green-04/10 hover:bg-green-04/30 js-transition">
                                            <span><?php echo esc_html($item['button']['title'] ?? 'Download'); ?></span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none">
                                                <path
                                                    d="M4 15.5911C2.81055 14.9966 2 13.8151 2 12.4545C2 10.89 3.0718 9.56223 4.55906 9.09163C4.52015 8.83913 4.5 8.58088 4.5 8.31818C4.5 5.38103 7.0184 3 10.125 3C12.2092 3 14.0287 4.0717 15.0005 5.66404C15.4153 5.47166 15.8818 5.36364 16.375 5.36364C18.1009 5.36364 19.5 6.68643 19.5 8.31818C19.5 8.58074 19.4638 8.8353 19.3958 9.07764C20.9065 9.53545 22 10.8743 22 12.4545C22 13.8151 21.1895 14.9966 20 15.5911M12 21L16 17M12 21L8 17M12 21V12"
                                                    stroke="#001A17" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="areas-carousel-dots flex justify-center gap-2 mt-8"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>