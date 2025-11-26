<?php
// Vai buscar os dados
$work_tags = get_the_terms(get_the_ID(), 'work_tag');
?>

<div class="item flex flex-col h-full mb-1 group py-2">
    <a href="<?php the_permalink(); ?>"
        class="h-full border border-grey-dark group-hover:-translate-y-1 js-transition rounded-3xl shadow-sm flex flex-col overflow-hidden cursor-pointer group bg-black z-30">

        <div class="flex-shrink-0 rounded-t-3xl overflow-hidden relative">

            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>"
                alt="<?php the_title(); ?>" class="h-96 w-full object-cover">

            <?php if ($work_tags && !is_wp_error($work_tags)): ?>
                <div class="absolute top-4 left-4 z-10 flex flex-wrap gap-2">
                    <?php foreach ($work_tags as $tag): ?>
                        <span
                            class="text-12px font-medium text-white bg-black/50 border border-grey-dark/50 px-3 py-1.5 rounded-full shadow-sm">
                            <?php echo esc_html($tag->name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="flex-grow flex flex-col p-5">

            <div class="flex items-end gap-2 mt-3">
                <h3 class="text-24px font-medium text-green-01">
                    <?php the_title(); ?>
                </h3>
            </div>

            <div class="flex-grow"></div>

            <div class="mt-6 flex justify-between items-center">
                <span class="inline-flex items-center gap-3 px-3 py-2 bg-white/10 text-white text-sm rounded-full ">
                    <?php
                    $cats = get_the_terms(get_the_ID(), 'work_category');
                    if (!$cats || is_wp_error($cats)) {
                        $cats = get_the_terms(get_the_ID(), 'category');
                    }

                    if ($cats && !is_wp_error($cats)) {
                        $names = array();
                        foreach ($cats as $c) {
                            $names[] = esc_html($c->name);
                        }
                        echo implode(', ', $names);
                    }
                    ?>
                </span>

                <div class="text-right">
                    <div
                        class="carousel-prev-btn p-2 rounded-full w-10 h-10 flex items-center justify-center text-16px font-medium group-hover:bg-white group-hover:text-black js-transition border border-white text-white">
                        <span class="sr-only"><?php _e("Ver Detalhe", "joaosanches"); ?></span>
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>