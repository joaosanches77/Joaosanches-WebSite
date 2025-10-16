<?php
// Vai buscar os dados do campo Repetidor 'timeline'
$timeline_items = get_field('timeline');
?>

<section id="timeline" class="pb-24 lg:pb-40">
    <div class="main-container mx-auto">

        <?php if ($timeline_items): ?>
            <div class="space-y-12 sm:space-y-16">

                <?php
                foreach ($timeline_items as $index => $item):
                    $image_order_class = ($index % 2 != 0) ? 'lg:order-first' : '';
                    ?>

                    <div
                        class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center wow animate__animated animate__fadeIn">

                        <div class="lg:max-w-lg">
                            <?php if ($item['tagline']): ?>
                                <p class="text-12px font-bold text-green-04 uppercase">
                                    <?php echo esc_html($item['tagline']); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($item['title']): ?>
                                <h2 class="mt-4 text-48px 3xl:text-56px text-green-01">
                                    <?php echo esc_html($item['title']); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if ($item['description']): ?>
                                <div class="mt-4 text-16px text-grey-02">
                                    <?php echo $item['description']; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="<?php echo $image_order_class; ?>">
                            <?php if ($item['image']): ?>
                                <img class="w-full h-auto object-cover rounded-3xl"
                                    src="<?php echo esc_url($item['image']['url']); ?>"
                                    alt="<?php echo esc_attr($item['image']['alt']); ?>">
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</section>