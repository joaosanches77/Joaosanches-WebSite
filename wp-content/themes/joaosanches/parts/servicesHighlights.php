<?php

$title = get_field('title_services');
$service_1 = get_field('service_1');
$service_2 = get_field('service_2');
$service_3 = get_field('service_3');

?>


<section id="" class="main-container lg:py-10">
    <div class="flex flex-col lg:flex-row justify-between">
        <div class="text-left flex flex-col gap-6 justify-center wow animate__animated animate__fadeIn">
            <h1 class="text-32px tracking-tight text-green-01 sm:text-40px 3xl:text-56px !leading-[1.14] max-w-xl">
                <?php echo esc_html($title); ?>
            </h1>
        </div>
    </div>
    <div
        class="grid grid-cols-1 lg:grid-cols-12 grid-rows-1 lg:grid-rows-2 gap-5 wow animate__animated animate__fadeIn relative mt-10 lg:mt-20">
        <div class="w-48 h-48 bg-blue blur-3xl absolute right-1/2"></div>
        <div class="w-72 h-48 rotate-45 bg-orange blur-3xl absolute -bottom-24 right-1/2"></div>
        <div
            class="col-span-6 lg:row-span-1 relative rounded-3xl overflow-hidden flex justify-between items-stretch p-10 text-white w-full lg:h-96 group">
            <img src="<?= $service_1['image']['url']; ?>" alt="<?= $service_1['image']['alt']; ?>"
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 js-transition"></div>
            <div class="relative flex flex-col rounded-3xl h-full justify-between w-full">
                <div>

                    <h2 class="text-24px md:text-32px 3xl:text-40px max-w-2xl text-white">
                        <?php echo esc_html($service_1['title']); ?>
                    </h2>
                </div>
                <div class="flex justify-end">
                    <a
                        class="p-2 rounded-full w-10 h-10 flex items-center justify-center gap-3 px-2 py-2 text-16px font-medium group-hover:bg-white group-hover:text-black js-transition border border-white">
                        <span class="sr-only"><?php _e("Anterior", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>



        <div
            class="col-span-6 lg:row-span-2 relative rounded-3xl overflow-hidden flex justify-between items-stretch p-10 text-white w-full h-full group">
            <img src="<?= $service_3['image']['url']; ?>" alt="<?= $service_3['image']['alt']; ?>"
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 js-transition"></div>
            <div class="relative flex flex-col rounded-3xl h-full justify-between w-full">
                <div>

                    <h2 class="text-24px md:text-32px 3xl:text-40px max-w-2xl text-white">
                        <?php echo esc_html($service_3['title']); ?>
                    </h2>
                </div>
                <div class="flex justify-end">
                    <a
                        class="p-2 rounded-full w-10 h-10 flex items-center justify-center gap-3 px-2 py-2 text-16px font-medium group-hover:bg-white group-hover:text-black js-transition border border-white">
                        <span class="sr-only"><?php _e("Anterior", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>



        <div
            class="col-span-6 lg:row-span-1 relative rounded-3xl overflow-hidden flex justify-between items-stretch p-10 text-white w-full h-full group">
            <img src="<?= $service_2['image']['url']; ?>" alt="<?= $service_2['image']['alt']; ?>"
                class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 js-transition"></div>
            <div class="relative flex flex-col rounded-3xl h-full justify-between w-full">
                <div>

                    <h2 class="text-24px md:text-32px 3xl:text-40px max-w-2xl text-white">
                        <?php echo esc_html($service_2['title']); ?>
                    </h2>
                </div>
                <div class="flex justify-end">
                    <a
                        class="p-2 rounded-full w-10 h-10 flex items-center justify-center gap-3 px-2 py-2 text-16px font-medium group-hover:bg-white group-hover:text-black js-transition border border-white">
                        <span class="sr-only"><?php _e("Anterior", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>




    </div>



    </div>
</section>