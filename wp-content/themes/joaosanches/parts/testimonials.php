<section class="pt-40 lg:pt-56 relative overflow-hidden">
    <div
        class="animate-float delay-5000 w-96 h-96 bg-green-01/20 blur-[100px] absolute top-0 left-0 rounded-full pointer-events-none">
    </div>

    <div class="main-container relative z-10">

        <div class="mb-12 lg:mb-20 lg:text-center wow animate__animated animate__fadeIn">
            <h2 class="text-32px lg:text-48px text-white font-medium mb-4">
                O que dizem sobre mim
            </h2>
        </div>

        <div class="owl-carousel testimonial-carousel owl-theme wow animate__animated animate__fadeInUp">

            <?php
            $args = array(
                // AQUI ESTÁ A MUDANÇA: Vamos buscar aos dois sítios
                'post_type' => array('work', 'testimonial'),
                'posts_per_page' => 10,
                'meta_query' => array(
                    array(
                        'key' => 'client_quote',
                        'value' => '',
                        'compare' => '!=' // Garante que não traz vazios
                    )
                )
            );
            $testimonials = new WP_Query($args);

            if ($testimonials->have_posts()):
                while ($testimonials->have_posts()):
                    $testimonials->the_post();

                    // Os campos ACF funcionam igual, independentemente do post type
                    $quote = get_field('client_quote');
                    $name = get_field('client_name');
                    $role = get_field('client_role');
                    $photo = get_field('client_photo');
                    $rating = get_field('client_rating');
                    if (!$rating)
                        $rating = 5;

                    // Se for um TRABALHO, podemos querer mostrar um link para ver o projeto
                    $is_work = get_post_type() == 'work';
                    ?>

                    <div class="item px-2 h-full">
                        <div class="bg-white/5 border border-grey-dark/50 p-8 rounded-3xl relative  h-full flex flex-col">

                            <div class="text-green-04 text-5xl opacity-30 font-serif leading-none absolute top-6 right-8">“
                            </div>

                            <div class="flex gap-1 mb-6">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <svg class="w-5 h-5 <?php echo ($i <= $rating) ? 'text-yellow-400 fill-current' : 'text-grey-dark fill-none'; ?>"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                    </svg>
                                <?php endfor; ?>
                            </div>

                            <div class="relative z-10 flex-grow">
                                <p class="text-grey-02 text-16px leading-relaxed font-light italic">
                                    "<?php echo esc_html($quote); ?>"
                                </p>
                            </div>

                            <div class="mt-8 flex items-center gap-4 pt-6 border-t border-white/10">

                                <div class="flex-shrink-0">
                                    <?php if ($photo): ?>
                                        <img src="<?php echo esc_url($photo['sizes']['thumbnail']); ?>"
                                            alt="<?php echo esc_attr($name); ?>"
                                            class="w-14 h-14 rounded-full object-cover border-2 border-green-04/50 p-0.5">
                                    <?php else: ?>
                                        <div
                                            class="w-14 h-14 rounded-full bg-white/10 flex items-center justify-center border-2 border-white/20 text-white font-bold">
                                            <?php echo substr($name, 0, 1); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="flex-grow">
                                    <h4 class="text-white text-16px font-bold"><?php echo esc_html($name); ?></h4>

                                    <div class="flex flex-col  gap-2">
                                        <?php if ($role): ?>
                                            <p class="text-green-01 text-12px uppercase tracking-wide">
                                                <?php echo esc_html($role); ?>
                                            </p>
                                        <?php endif; ?>

                                        <?php if ($is_work): ?>
                                            <span class="text-grey-dark text-xs hidden ">•</span>
                                            <a href="<?php the_permalink(); ?>"
                                                class="text-white hover:text-orange text-xs underline  underline-offset-2 js-transition">Ver
                                                Projeto</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>