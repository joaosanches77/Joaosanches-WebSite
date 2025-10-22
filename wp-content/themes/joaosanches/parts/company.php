<?php

$tagline = get_field('tagline_company');
$title = get_field('title_company');
$description = get_field('description_company');
$button = get_field('button_company');
$items = get_field('items_company');
?>

<section class="bg-white pt-32 pb-40">
    <div class="main-container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-12">

            <div class="flex flex-col max-w-xl wow animate__animated animate__fadeIn">
                <p class="text-12px font-bold text-green-04 uppercase">
                    <?php echo esc_html($tagline); ?>
                </p>
                <h2 class="mt-4 text-48px 3xl:text-56px text-green-01">
                    <?php echo esc_html($title); ?>
                </h2>
                <p class="mt-6 text-16px text-grey-02">
                    <?php echo esc_html($description); ?>
                </p>
                <div class="mt-4 sm:mt-10 sm:flex lg:justify-start">
                    <?php if ($button && isset($button['url']) && !empty($button['url'])): ?>
                        <div>
                            <a download href="<?= $button['url'] ?>"
                                class="w-full flex items-center justify-center gap-3 px-8 py-6 text-16px font-medium rounded-full text-green-01 bg-green-04/10 hover:bg-green-04/30 js-transition">
                                <span><?= $button["title"] ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M4 15.5911C2.81055 14.9966 2 13.8151 2 12.4545C2 10.89 3.0718 9.56223 4.55906 9.09163C4.52015 8.83913 4.5 8.58088 4.5 8.31818C4.5 5.38103 7.0184 3 10.125 3C12.2092 3 14.0287 4.0717 15.0005 5.66404C15.4153 5.47166 15.8818 5.36364 16.375 5.36364C18.1009 5.36364 19.5 6.68643 19.5 8.31818C19.5 8.58074 19.4638 8.8353 19.3958 9.07764C20.9065 9.53545 22 10.8743 22 12.4545C22 13.8151 21.1895 14.9966 20 15.5911M12 21L16 17M12 21L8 17M12 21V12"
                                        stroke="#001A17" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex flex-col space-y-10">

                <?php

                foreach ($items as $feature):
                    ?>
                    <a href="<?= isset($feature["link"]["url"]) ? esc_url($feature["link"]["url"]) : '#' ?>"
                        class="flex items-center wow animate__animated animate__fadeInRight" data-wow-delay=".3s">
                        <div class="flex-shrink-0 w-20 h-20 md:w-32 md:h-32 xl:w-40 xl:h-40 text-green-04">
                            <?php if (!empty($feature['icon'])): ?>
                                <img src="<?php echo esc_url($feature['icon']['url']); ?>"
                                    alt="<?php echo esc_attr($feature['icon']['alt'] ?? ''); ?>"
                                    class="w-20 h-20 md:w-32 md:h-32 xl:w-40 xl:h-40 object-contain" />
                            <?php endif; ?>

                        </div>
                        <div class="ml-5">
                            <h3 class="text-20px md:text-24px xl:text-32px text-green-01">
                                <?php echo esc_html($feature['title']); ?>
                            </h3>
                            <p class="mt-2 text-16px text-grey-02 line-clamp-3">
                                <?php echo esc_html($feature['description']); ?>
                            </p>
                        </div>
                    </a>
                    <?php
                endforeach;
                ?>


            </div>

        </div>
    </div>
</section>