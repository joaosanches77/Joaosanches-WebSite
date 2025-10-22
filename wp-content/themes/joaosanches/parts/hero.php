<?php
# Hero
$slides = get_field("slides_hero");
$image = get_field("image_hero");
$image2 = get_field("image2_hero");
$badges = get_field("badges_hero");
$badges_link = get_field("badges_link_hero");

?>

<section id="hero-section" class="relative xl:min-h-screen flex flex-col padding-nav pb-20">
    <div class="main-container relative w-full flex flex-col mb-8">
        <div class="relative z-10 sm:space-y-5 lg:space-y-0">
            <div class=" lg:w-1/2 <?php if (count($slides) > 1) {
                echo 'owl-carousel hero-carousel ';
            } ?>">
                <?php if ($slides):
                    foreach ($slides as $slide): ?>
                        <div
                            class="sm:text-center lg:text-left flex flex-col gap-6 lg:w-full justify-center wow animate__animated animate__fadeInUp overflow-hidden">
                            <p class="text-12px font-semibold text-green-04 uppercase tracking-wider">
                                <?= $slide["tagline"] ?>
                            </p>
                            <h1 class="text-40px md:text-56px tracking-tight text-green-01 3xl:text-80px !leading-[1.1]">
                                <?= $slide["title"] ?>
                            </h1>
                            <p class="text-16px text-grey-02 sm:text-20px sm:max-w-xl sm:mx-auto md:text-24px lg:mx-0">
                                <?= $slide["description"] ?>
                            </p>
                            <?php if (!empty($slide['button']) && !empty($slide['button']['url'])): ?>
                                <div class="mt-4 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="">
                                        <a href="<?= esc_url($slide['button']['url']) ?>"
                                            class="w-full flex items-center justify-center gap-3 px-8 py-6 text-16px font-medium rounded-full text-green-01 bg-green-04/10 sm:hover:bg-green-04/30 js-transition">
                                            <span><?= esc_html($slide['button']["title"]) ?></span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none">
                                                <path
                                                    d="M9 8C9 8.55228 8.55228 9 8 9C7.44772 9 7 8.55228 7 8C7 7.44772 7.44772 7 8 7C8.55228 7 9 7.44772 9 8Z"
                                                    stroke="#001A17" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M21.7929 12.7929L11.5858 2.58579C11.2107 2.21071 10.702 2 10.1716 2H3C2.44772 2 2 2.44772 2 3V10.1716C2 10.702 2.21071 11.2107 2.58579 11.5858L12.7929 21.7929C13.1834 22.1834 13.8166 22.1834 14.2071 21.7929L21.7929 14.2071C22.1834 13.8166 22.1834 13.1834 21.7929 12.7929Z"
                                                    stroke="#001A17" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; endif; ?>
            </div>
            <div
                class="relative lg:absolute lg:inset-y-0 lg:-right-10 w-full lg:w-1/2 overflow-visible lg:z-50 min-h-[500px] lg:min-h-0 wow animate__animated animate__fadeInRight">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div
                        class="w-[350px] sm:w-[450px] lg:w-[500px] 3xl:w-[700px] aspect-square rounded-full overflow-hidden">
                        <img class="object-cover w-full h-full" src="<?php echo esc_url($image['url']); ?>"
                            alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                </div>

                <?php if ($image2): ?>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/3 w-full flex justify-center">
                        <div
                            class="w-[350px] h-[600px] sm:w-[450px] sm:h-[700px] lg:w-[500px] lg:h-[800px] 3xl:w-[700px] 3xl:h-[1000px]">
                            <img class="object-contain w-full h-full" src="<?php echo esc_url($image2['url']); ?>"
                                alt="<?php echo esc_attr($image2['alt']); ?>" />
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="hero-carousel-pagination items-center gap-4 mt-20 hidden lg:flex">
            <div class="hero-carousel-dots flex items-center gap-3"></div>
            <div class="hero-carousel-counter text-green-01 font-medium text-14px"></div>
        </div>
    </div>
    <?php if ($badges && is_array($badges)): ?>
        <div id="badges-bar" class="bg-beje-01 w-full h-16 flex items-center justify-center fixed bottom-0 z-10 gap-2">
            <?php foreach ($badges as $badge): ?>
                <a href="<?= isset($badge["link"]["url"]) ? esc_url($badge["link"]["url"]) : '#' ?>" class="h-12 mx-2">
                    <img class="object-contain w-full h-full" src="<?php echo esc_url($badge['badge']['url']); ?>"
                        alt="<?php echo esc_attr($badge['badge']['alt']); ?>" />
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>