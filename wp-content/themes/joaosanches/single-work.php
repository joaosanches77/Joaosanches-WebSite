<?php
get_header();

// 1. Obter Categoria Principal para o Header
$categories = get_the_terms(get_the_ID(), 'work_category');
$category_name = '';
if ($categories && !is_wp_error($categories)) {
    $category_name = $categories[0]->name;
}


?>

<section class="padding-nav-small pb-16 sm:pb-24 relative">
    <div class="main-container mx-auto wow animate__animated animate__fadeIn">

        <div class="bg-black h-[50vh] relative rounded-3xl mt-4">
            <video autoplay muted loop playsinline
                class="absolute inset-0 w-full h-full object-cover blur-3xl opacity-50">
                <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/fireballs2.mp4" type="video/mp4">
            </video>

            <div class="absolute inset-0 flex flex-col items-center justify-center text-center z-30 px-4"
                data-aos="zoom-in" data-aos-delay="100">



                <h1 class="text-48px lg:text-80px text-white font-medium">
                    <?php echo esc_html(get_field('title')); ?>
                </h1>

                <?php if (get_field('subtitle')): ?>
                    <p class="mt-4 text-20px text-white opacity-75 max-w-2xl">
                        <?php echo esc_html(get_field('subtitle')); ?>
                    </p>
                <?php endif; ?>
                <?php if ($category_name): ?>
                    <span class=" px-8 py-4 text-14px rounded-full bg-white/10 text-white- mt-12">
                        <?php echo esc_html($category_name); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div id="work-content" class="mt-16 lg:mt-24 z-30 relative">

            <?php if (have_rows('blocks')): ?>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-center">

                    <?php while (have_rows('blocks')):
                        the_row();
                        // Variáveis do Repeater
                        $type = get_sub_field('type');   // image, text, video
                        $width = get_sub_field('width'); // full, half (Ver nota abaixo)
                
                        // Lógica de Largura (Tailwind)
                        // Assume que no ACF o valor devolvido é 'full' ou 'half'. 
                        // Se usaste '100' e '50', ajusta aqui o if.
                        $col_class = 'lg:col-span-12'; // Padrão 100%
                        if ($width === 'half' || $width === '50') {
                            $col_class = 'lg:col-span-6';
                        }
                        ?>

                        <div class="<?php echo $col_class; ?> w-full">

                            <?php
                            // --- CASO 1: IMAGEM ---
                            if ($type === 'image'):
                                $img = get_sub_field('image');
                                if ($img):
                                    ?>
                                    <?php
                                    $aspect_class = ($width === 'half' || $width === '50') ? 'aspect-square' : 'aspect-video';
                                    ?>
                                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>"
                                        class="w-full <?php echo $aspect_class; ?> rounded-lg shadow-sm block z-30 object-cover">
                                    <?php
                                endif;

                                // --- CASO 2: TEXTO ---
                            elseif ($type === 'text'):
                                $text = get_sub_field('text');
                                ?>
                                <div
                                    class="text-white font-montserrat text-base sm:text-xl lg:text-2xl font-normal leading-[133%] tracking-[-0.05em] prose prose-invert max-w-none">
                                    <?php echo $text; ?>
                                </div>

                                <?php
                                // --- CASO 3: VÍDEO (Já tinhas este) ---
                            elseif ($type === 'video'):
                                $video_url = get_sub_field('video');
                                if ($video_url):
                                    ?>
                                    <div class="rounded-lg overflow-hidden relative w-full aspect-video shadow-sm">
                                        <video controls class="w-full h-full object-cover">
                                            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                                        </video>
                                    </div>
                                    <?php
                                endif;

                                // --- CASO 4: GALERIA (NOVO) ---
                            elseif ($type === 'gallery'):
                                $images = get_sub_field('gallery');
                                if ($images):
                                    // Gerar um ID único caso tenhas várias galerias na mesma página
                                    $unique_id = 'gallery-' . get_row_index();
                                    ?>
                                    <div class="relative group">

                                        <div id="<?php echo $unique_id; ?>"
                                            class="owl-carousel work-gallery-carousel owl-theme rounded-lg overflow-hidden shadow-sm">
                                            <?php foreach ($images as $image): ?>
                                                <div class="item">
                                                    <?php
                                                    $aspect_class = ($width === 'half' || $width === '50') ? 'aspect-square' : 'aspect-video';
                                                    ?>
                                                    <img src="<?php echo esc_url($image['sizes']['large']); ?>"
                                                        alt="<?php echo esc_attr($image['alt']); ?>"
                                                        class="w-full <?php echo $aspect_class; ?> rounded-lg shadow-sm block object-cover">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <button
                                            class="custom-prev-<?php echo $unique_id; ?> absolute top-1/2 left-4 -translate-y-1/2 w-12 h-12 bg-black/30 border border-white/20 backdrop-blur-md text-white rounded-full flex items-center justify-center transition-all z-10 hover:bg-white hover:text-black hover:border-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                            </svg>
                                        </button>

                                        <button
                                            class="custom-next-<?php echo $unique_id; ?> absolute top-1/2 right-4 -translate-y-1/2 w-12 h-12 bg-black/30 border border-white/20 backdrop-blur-md text-white rounded-full flex items-center justify-center transition-all z-10 hover:bg-white hover:text-black hover:border-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            </svg>
                                        </button>

                                    </div>
                                    <?php
                                endif;
                            endif;
                            ?>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php else: ?>
                <p class="text-center text-grey-02">Conteúdo a ser inserido.</p>
            <?php endif; ?>

        </div>
    </div>
    <div
        class="hidden lg:block w-72 h-48 rotate-45 bg-orangeLight blur-3xl absolute -bottom-16 right-1/2 animate-float">
    </div>
</section>



<?php
// Campos do post atual
$quote = get_field('client_quote');
$name = get_field('client_name');
$role = get_field('client_role');
$photo = get_field('client_photo');
$rating = get_field('client_rating');
if (!$rating)
    $rating = 5;

if ($quote):
    ?>
    <section class="pt-40 lg:pt-56 relative">
        <div class="main-container mx-auto max-w-7xl wow animate__animated animate__fadeIn">

            <div class="relative text-center flex flex-col items-center">

                <div class="mb-8 relative">
                    <?php if ($photo): ?>
                        <img src="<?php echo esc_url($photo['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($name); ?>"
                            class="w-24 h-24 rounded-full object-cover border-2 border-green-04 p-1 shadow-lg shadow-green-04/20">
                    <?php else: ?>
                        <div
                            class="w-24 h-24 rounded-full bg-grey-dark flex items-center justify-center border-2 border-white/20 text-white text-2xl font-bold">
                            <?php echo substr($name, 0, 1); ?>
                        </div>
                    <?php endif; ?>

                    <div
                        class="absolute -bottom-2 -right-2 bg-green-04 text-black w-8 h-8 flex items-center justify-center rounded-full font-serif text-xl font-bold">
                        “</div>
                </div>

                <div class="flex gap-2 mb-8">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <svg class="w-6 h-6 <?php echo ($i <= $rating) ? 'text-yellow-400 fill-current' : 'text-grey-dark/30 fill-none'; ?>"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    <?php endfor; ?>
                </div>

                <h3 class="text-24px lg:text-32px text-white font-light leading-relaxed italic">
                    "<?php echo esc_html($quote); ?>"
                </h3>

                <div class="mt-8">
                    <h4 class="text-white text-20px font-bold tracking-wide uppercase">
                        <?php echo esc_html($name); ?>
                    </h4>
                    <?php if ($role): ?>
                        <p class="text-grey-02 mt-1 text-sm"><?php echo esc_html($role); ?></p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>
<?php endif; ?>

<?php
// Contacts
get_template_part("parts/contacts");

get_footer();
?>