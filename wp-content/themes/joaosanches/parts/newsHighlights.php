<?php
# newsHighlights
$tagline = get_field("tagline_news_highlights");
$title = get_field("title_news_highlights");
$description = get_field("description_news_highlights");

#news
$args = array('post_type' => 'post', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC');
$news_query = new WP_Query($args);
?>

<?php if ($news_query->have_posts()): ?>
    <section class="bg-white py-32 sm:py-40">
        <div class="main-container">
            <div class="grid grid-cols-1 lg:grid-cols-12 justify-between">
                <div class="lg:col-span-3 wow animate__animated animate__fadeIn">
                    <p class="text-12px font-bold text-green-04 uppercase"><?= $tagline ?></p>
                    <h2 class="mt-2 text-40px 3xl:text-48px text-green-01"><?= $title ?></h2>
                    <p class="mt-4 text-16px text-grey-02"><?= $description ?></p>
                </div>
                <div class="lg:col-span-8 lg:col-start-5 mt-10">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                        <?php
                        $i = 0;
                        while ($news_query->have_posts()):
                            $news_query->the_post();
                            ?>
                            <article class="flex flex-col h-full wow animate__animated animate__fadeInRight"
                                data-wow-delay=".<?= 3 + $i++; ?>s">
                                <a href="<?php the_permalink(); ?>" class="block overflow-hidden rounded-3xl">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
                                        alt="<?php the_title(); ?>"
                                        class="w-full h-64 object-cover transform hover:scale-105 transition-transform duration-300">
                                </a>
                                <div class="mt-4 flex flex-col flex-grow">
                                    <div class="flex-grow">
                                        <h3 class="text-24px text-green-01 leading-tight line-clamp-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <p class="mt-1 text-16px text-green-01">
                                            <?php echo get_the_date('j M, Y'); ?>
                                        </p>
                                        <div class="mt-3 text-14px text-grey-02 line-clamp-3">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    </div>

                                    <a href="<?php the_permalink(); ?>"
                                        class="inline-flex self-start w-auto items-center justify-center gap-3 px-6 py-4 mt-6 border-2 border-green-04 rounded-full text-16px font-medium text-green-04 hover:bg-green-04 hover:text-white lv-transition">
                                        <span><?php _e("Ler mais", "joaosanches"); ?></span>
                                        <svg class="w-5 h-5 -rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <div class="pt-32 sm:pt-40"></div>
<?php endif; ?>