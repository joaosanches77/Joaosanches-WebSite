<?php

$image = get_field('image_about');
$title = get_field('title_about');
$description = get_field('description_about');
?>

<section class="pt-32 pb-40">
    <div class="main-container mx-auto">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-10 lg:gap-0">
            <div class="flex justify-center lg:justify-end wow animate__animated animate__fadeIn lg:w-1/3 relative">
                <div class="bg-gradient-to-b from-transparent from-70% to-black w-full h-full absolute top-0"></div>
                <?php if ($image): ?>
                    <img class="w-full rounded-lg object-cover" src="<?php echo esc_url($image['url']); ?>"
                        alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
            </div>
            <div class="lg:w-1/2">

                <div class="flex flex-col wow animate__animated animate__fadeIn">
                    <p class="text-12px font-bold text-green-04 uppercase">
                        <?php echo esc_html($tagline); ?>
                    </p>
                    <h2 class="mt-4 text-48px 3xl:text-56px text-green-01">
                        <?php echo esc_html($title); ?>
                    </h2>
                    <p class="mt-6 text-16px text-grey-02">
                        <?php echo esc_html($description); ?>
                    </p>

                </div>

            </div>
        </div>
</section>