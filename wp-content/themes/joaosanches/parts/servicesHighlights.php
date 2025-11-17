<?php


$block_1 = get_field('block_1');
$block_2 = get_field('block_2');
$block_3 = get_field('block_3');

?>


<div class="main-container">
    <div class="flex flex-col lg:flex-row justify-between">
        <div class="text-left flex flex-col gap-6 justify-center wow animate__animated animate__fadeIn">
            <h1 class="text-32px tracking-tight text-green-01 sm:text-40px 3xl:text-56px !leading-[1.14] max-w-xl">
                <?php echo esc_html($title); ?>
            </h1>
        </div>
        <div
            class="mt-6 flex-shrink-0 flex flex-col sm:flex-row gap-8 sm:gap-4 md:gap-0 items-center sm:space-x-4 lg:mt-0 wow animate__animated animate__fadeIn z-30">
            <a href="<?= $product_page_url ?>"
                class="w-full flex items-center justify-center gap-3 px-8 py-4 text-16px rounded-full text-white hover:text-black hover:bg-white js-transition font-medium border border-white">
                <?php _e("Ver mais", "joaosanches"); ?>

            </a>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 wow animate__animated animate__fadeIn relative">
        <div class="w-48 h-48 bg-blue blur-3xl absolute right-1/2"></div>
        <div
            class="col-span-12 relative rounded-3xl overflow-hidden flex items-center justify-between p-10 text-white w-full">
            <img src="<?= $block_1['image']['url']; ?>" alt="<?= $block_1['image']['alt']; ?>"
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
            <div
                class="relative flex flex-col min-h-[450px] lg:min-h-0 rounded-3xl h-full xl:flex-row justify-between items-center md:items-start xl:items-center lg:gap-10 w-full">
                <div>
                    <p class="text-sm font-semibold uppercase inline-block text-green-04">
                        <?php echo esc_html($block_1['tagline']); ?>
                    </p>
                    <h2 class="mt-4 text-24px md:text-32px 3xl:text-40px max-w-2xl text-beje-01">
                        <?php echo esc_html($block_1['title']); ?>
                    </h2>
                </div>

                <a download href="<?= $block_1['button']['url'] ?>"
                    class="inline-flex w-full md:w-auto items-center justify-center gap-3 px-8 py-6 border-2 border-green-04 rounded-full text-base font-medium text-green-04 hover:bg-green-04 hover:text-white js-transition">
                    <span><?php echo esc_html($block_1['button']['title']); ?></span><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        stroke="currentColor" fill="none">
                        <path
                            d="M4 15.5911C2.81055 14.9966 2 13.8151 2 12.4545C2 10.89 3.0718 9.56223 4.55906 9.09163C4.52015 8.83913 4.5 8.58088 4.5 8.31818C4.5 5.38103 7.0184 3 10.125 3C12.2092 3 14.0287 4.0717 15.0005 5.66404C15.4153 5.47166 15.8818 5.36364 16.375 5.36364C18.1009 5.36364 19.5 6.68643 19.5 8.31818C19.5 8.58074 19.4638 8.8353 19.3958 9.07764C20.9065 9.53545 22 10.8743 22 12.4545C22 13.8151 21.1895 14.9966 20 15.5911M12 21L16 17M12 21L8 17M12 21V12"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

            </div>
        </div>



        <div
            class="col-span-12 lg:col-span-7 3xl:col-span-5 relative rounded-3xl overflow-hidden text-white h-full flex">

            <div class="relative h-full flex-grow">

                <div class="item relative flex flex-col p-10 h-full">
                    <img src="<?php echo esc_url($item['image']['url']); ?>"
                        alt="<?php echo esc_attr($item['image']['alt']); ?>"
                        class="absolute inset-0 w-full h-full object-cover -z-10">
                    <div class="absolute inset-0 bg-black/60 -z-10"></div>

                    <div>
                        <div class="flex flex-col gap-4">
                            <p class="text-12px font-bold uppercase inline-block text-green-04">
                                <?php echo esc_html($item['tagline']); ?>
                            </p>
                            <h3 class="text-24px md:text-32px 3xl:text-40px max-w-md text-beje-01">
                                <?php echo esc_html($item['title']); ?>
                            </h3>
                        </div>
                    </div>

                    <div class="flex-grow"></div>

                    <div class="relative">
                        <div class="mt-6 flex flex-col sm:flex-row gap-4">
                            <?php if ($item && isset($item['button_read_more']) && !empty($item['button_read_more'])): ?>
                                <a href="<?php echo esc_url($item['button_read_more']['url']); ?>"
                                    target="<?php echo esc_attr($item['button_read_more']['target']); ?>"
                                    class="inline-flex w-full md:w-auto items-center justify-center gap-3 px-8 py-6 border-2 border-green-04 rounded-full text-base font-medium text-green-04 hover:bg-green-04 hover:text-white js-transition">
                                    <span><?php echo esc_html($item['button_read_more']['title']); ?></span>
                                </a>
                            <?php endif; ?>
                            <?php if ($item && isset($item['button_download']['url']) && !empty($item['button_download']['url'])): ?>
                                <a download href="<?php echo esc_url($item['button_download']['url']); ?>" target="_blank"
                                    class="inline-flex w-full md:w-auto items-center justify-center gap-3 px-8 py-6 border-2 border-green-04 rounded-full text-base font-medium text-green-04 hover:bg-green-04 hover:text-white js-transition">
                                    <span><?php echo esc_html($item['button_download']['title']); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>



        </div>

        <div class="flex flex-col 3xl:flex-row gap-5 col-span-12 lg:col-span-5 3xl:col-span-7">
            <div
                class="relative rounded-3xl overflow-hidden p-10 text-white bg-green-02 flex flex-col gap-12 min-h-[300px] 3xl:w-1/2">
                <div>
                    <?php if ($block_3 && $block_3['tagline']): ?>
                        <p class="text-12px font-bold uppercase inline-block self-start text-green-04">
                            <?= $block_3["tagline"] ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($block_3 && $block_3['title']): ?>
                        <h3 class="mt-4 text-24px md:text-32px text-beje-02"> <?= $block_3["title"] ?></h3>
                    <?php endif; ?>
                    <?php if ($block_3 && isset($block_3['description']) && !empty($block_3['description'])): ?>
                        <p class="mt-2 text-16px text-grey-01 line-clamp-3"> <?= $block_3["description"] ?></p>
                    <?php endif; ?>
                </div>
                <?php if (!empty($block_3["button"])): ?>
                    <div class="relative z-10">
                        <a href="<?= esc_url($block_3["button"]["url"]) ?>"
                            class="inline-flex w-full md:w-auto items-center justify-center gap-3 px-8 py-6 border-2 border-green-04 rounded-full text-base font-medium text-green-04 hover:bg-green-04 hover:text-white js-transition">
                            <span><?= esc_html($block_3["button"]["title"]) ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" stroke="currentColor"
                                viewBox="0 0 24" fill="none">
                                <path
                                    d="M7.46413 4.8C7.82249 4.31422 8.39306 4 9.03571 4C10.1206 4 11 4.89543 11 6C11 7.10457 10.1206 8 9.03571 8H3M10.4641 19.2C10.8225 19.6858 11.3931 20 12.0357 20C13.1206 20 14 19.1046 14 18C14 16.8954 13.1206 16 12.0357 16H3M14.8926 6.4C15.5116 5.54989 16.4971 5 17.6071 5C19.481 5 21 6.567 21 8.5C21 10.433 19.481 12 17.6071 12H3"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($block_3['image']['url'])): ?>
                    <img src="<?php echo esc_url($block_3['image']['url']); ?>"
                        alt="<?php echo esc_attr($block_3['image']['alt']); ?>"
                        class="hidden 3xl:block absolute -bottom-64 4xl:-bottom-[350px] left-0 w-[620px] h-full object-contain object-bottom pointer-events-none">
                <?php endif; ?>
            </div>
            <div
                class="relative rounded-3xl overflow-hidden p-10 text-white bg-green-01 flex flex-col min-h-[300px] 3xl:w-1/2 gap-12">
                <div>
                    <?php if ($block_4 && isset($block_4['tagline']) && !empty($block_4['tagline'])): ?>
                        <p class="text-12px font-bold uppercase inline-block self-start text-green-04">
                            <?= $block_4["tagline"] ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($block_4 && isset($block_4['title']) && !empty($block_4['title'])): ?>
                        <h3 class="mt-4 text-24px md:text-32px text-beje-02"><?= $block_4["title"] ?></h3>
                    <?php endif; ?>
                    <?php if ($block_4 && isset($block_4['description']) && !empty($block_4['description'])): ?>
                        <p class="mt-2 text-16px text-grey-01 line-clamp-3"><?= $block_4["description"] ?></p>
                    <?php endif; ?>
                </div>

                <div class=" text-green-04">
                    <?php if ($block_4 && isset($block_4['number']) && !empty($block_4['number'])): ?>
                        <p class="text-64px 3xl:text-80px"><?= $block_4["number"] ?></p>
                    <?php endif; ?>
                    <?php if ($block_4 && isset($block_4['number_description']) && !empty($block_4['number_description'])): ?>
                        <p class="text-16px mt-2"><?= $block_4["number_description"] ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>