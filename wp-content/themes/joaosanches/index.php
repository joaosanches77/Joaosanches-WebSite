<?php
get_header();


$news_page = get_page_by_path('noticias');
$news_page_id = null;

if ($news_page) {
	$news_page_id = $news_page->ID;
}

$tagline = get_field('tagline_news', $news_page_id) ?? 'Notícias';
$title = get_field('title_news', $news_page_id) ?? get_the_title($news_page_id);
$description = get_field('description_news', $news_page_id) ?? '';


$background_image = get_field('image_highlightblock', $news_page_id);
$taglineb = get_field('tagline_highlightblock', $news_page_id);
$titleb = get_field('title_highlightblock', $news_page_id);
$descriptionb = get_field('description_highlightblock', $news_page_id);

$have_location = get_field('have_location_highlightblock', $news_page_id);
$location = get_field('location_highlightblock', $news_page_id);

$button_type = get_field('button_type', $news_page_id);
$button_link = get_field('button_link_highlightblock', $news_page_id);
$button_download = get_field('button_download_highlightblock', $news_page_id);



$categories = get_categories();

global $wp_query;
$needLoadMore = $wp_query->max_num_pages > 1;

?>

<section id="storys" class="padding-nav-small min-h-screen main-container wow animate__animated animate__fadeIn">
	<div class="flex flex-col justify-center max-w-xl text-center mx-auto mb-20">
		<p class="text-12px font-bold text-green-04 uppercase">
			<?php echo esc_html($tagline); ?>
		</p>
		<h2 class="mt-4 text-48px lg:text-56px text-green-01">
			<?php echo esc_html($title); ?>
		</h2>
		<p class="mt-6 text-16px text-grey-02">
			<?php echo esc_html($description); ?>
		</p>
	</div>
	<div class="">
		<div id="list_news"
			class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8 wow animate__animated animate__fadeInUp"
			data-wow-delay=".3s">
			<?php if (have_posts()): ?>
				<?php while (have_posts()):
					the_post();

					// --- LÓGICA DO LINK EXTERNO AQUI ---
					$is_external = get_field('external'); // Devolve true/false
					$external_link_data = get_field('external_link'); // Devolve um array (url, title, target)
			
					// Define o URL e o target com base na condição
					$link_url = get_permalink(); // Link padrão
					$link_target = '_self';    // Target padrão
					$link_rel = '';            // Rel padrão
			
					if ($is_external && !empty($external_link_data['url'])) {
						$link_url = $external_link_data['url'];
						// Usa o target definido no ACF, ou '_blank' como fallback para links externos
						$link_target = !empty($external_link_data['target']) ? $external_link_data['target'] : '_blank';
						// Adiciona 'rel' para segurança em links que abrem em novo separador
						if ($link_target === '_blank') {
							$link_rel = 'rel="noopener noreferrer"';
						}
					}
					// --- FIM DA LÓGICA DO LINK ---
			
					$categories = get_the_category();
					$category = (is_array($categories) && count($categories)) ? $categories[0] : null;
					?>
					<article class="flex flex-col h-full">
						<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" <?php echo $link_rel; ?> class="block overflow-hidden rounded-3xl">
							<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
								alt="<?php the_title(); ?>"
								class="w-full h-64 object-cover transform hover:scale-105 transition-transform duration-300">
						</a>
						<div class="mt-4 flex flex-col flex-grow">
							<div class="flex-grow">
								<h3 class="text-24px text-green-01 leading-tight line-clamp-2">
									<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"
										<?php echo $link_rel; ?>><?php the_title(); ?></a>
								</h3>
								<p class="mt-1 text-16px text-green-01">
									<?php echo get_the_date('j M, Y'); ?>
								</p>
								<div class="mt-3 text-14px text-grey-02 line-clamp-3">
									<?php the_excerpt(); ?>
								</div>
							</div>

							<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" <?php echo $link_rel; ?>
								class="inline-flex self-start w-auto items-center justify-center gap-3 px-6 py-4 mt-6 border-2 border-green-04 rounded-full text-16px font-medium text-green-04 hover:bg-green-04 hover:text-white js-transition">
								<span>Ler mais</span>
								<svg class="w-5 h-5 -rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none"
									viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
								</svg>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			<?php else: ?>
				<article class="post error col-span-1 sm:col-span-2 xl:col-span-4">
					<h1 class="404 text-center text-grey-02"><?php _e("Em breve", "joaosanches"); ?></h1>
				</article>
			<?php endif; ?>
		</div>
		<div class="flex justify-center text-white">
			<button id="load_more_news" style="<?= $needLoadMore ? "" : "display:none;" ?>"
				data-count="<?= get_option('posts_per_page') ?>"
				class="hover:bg-grey/50 duration-500 ease-out border font-bold p-4">
				<?php _e("Carregar mais", "joaosanches"); ?>
			</button>
		</div>
	</div>
</section>

<?php


?>

<section class="relative text-white container-large pt-40 pb-7">
	<div class="flex flex-col relative p-8 md:p-10 justify-between min-h-[800px] rounded-3xl overflow-hidden">
		<?php if ($background_image): ?>
			<img src="<?php echo esc_url($background_image['url']); ?>"
				alt="<?php echo esc_attr($background_image['alt']); ?>" class="absolute inset-0 w-full h-full object-cover">
		<?php endif; ?>

		<div class="z-10 flex items-center gap-3">
			<?php if ($have_location): ?>
				<div>
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path
							d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
							stroke="#00C4B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						<path d="M10.5858 10.5858L8.46447 15.5355L13.4142 13.4142L15.5355 8.46447L10.5858 10.5858Z"
							stroke="#00C4B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</div>
			<?php endif; ?>
			<div class="flex flex-col">
				<p class="text-16 text-beje-02"><?= $location["title"] ?></p>
				<p class="text-grey-02 text-12px"><?= $location["description"] ?></p>
			</div>
		</div>

		<div class="z-10 flex justify-center">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 md:w-40 md:h-40 xl:w-52 xl:h-52"
				viewBox="0 0 213 214" fill="none">
				<path
					d="M212.103 107.103C212.006 118.115 210.195 129.069 206.719 139.473C193.208 181.526 150.946 211.826 107.103 210.978C51.7774 212.04 2.27421 162.207 3.60254 107.103C2.27421 51.9979 51.7774 2.16517 107.103 3.22754C150.946 2.37916 193.208 32.6794 206.719 74.7324C210.195 85.1357 212.006 96.0904 212.103 107.103C212.207 96.0907 210.585 85.0728 207.261 74.5564C194.407 32.0535 151.932 0.515688 107.103 0.977539C50.5687 -0.679927 -0.788965 50.3482 0.602539 107.103C-0.788965 163.857 50.5687 214.885 107.103 213.228C151.932 213.689 194.407 182.152 207.261 139.649C210.585 129.132 212.207 118.114 212.103 107.103Z"
					fill="#008375" />
				<path
					d="M212.103 113.103C211.563 116.914 207.374 118.38 204.216 119.801C200.811 121.158 197.349 122.114 193.805 122.965C165.41 129.122 136.107 129.992 107.103 129.978C72.1495 128.47 29.8941 130.856 3.60254 113.103C29.8941 95.3495 72.1495 97.735 107.103 96.2275C136.107 96.2131 165.41 97.0827 193.805 103.24C197.349 104.091 200.811 105.047 204.216 106.405C207.374 107.825 211.563 109.292 212.103 113.103C211.665 109.252 207.467 107.643 204.329 106.135C200.937 104.68 197.482 103.629 193.944 102.687C165.583 95.7989 136.209 94.3634 107.103 93.9775C71.3743 95.936 31.7107 89.1826 0.602539 113.103C31.7107 137.022 71.3743 130.269 107.103 132.228C136.209 131.842 165.583 130.406 193.944 123.518C197.482 122.576 200.937 121.525 204.329 120.07C207.467 118.562 211.665 116.953 212.103 113.103Z"
					fill="#008375" />
				<path
					d="M29.1025 107.103C29.2034 97.3288 30.318 87.6129 32.5018 78.1124C40.4977 40.9623 69.5419 3.00443 109.603 3.22755C160.557 4.38829 189.458 60.4655 188.603 107.103C189.458 153.74 160.557 209.817 109.603 210.978C69.5418 211.201 40.4977 173.243 32.5018 136.093C30.318 126.592 29.2034 116.876 29.1025 107.103C29.0034 116.876 29.928 126.634 31.9451 136.215C39.2815 173.595 67.9692 212.918 109.603 213.228C162.664 212.442 192.495 154.675 191.603 107.103C192.495 59.53 162.664 1.76272 109.603 0.977547C67.9693 1.28745 39.2815 40.6105 31.9451 77.9898C29.928 87.571 29.0034 97.3288 29.1025 107.103Z"
					fill="#008375" />
				<path
					d="M96.0493 156.103C94.938 151.656 93.9853 147.208 93.252 142.738C82.0521 100.625 116.576 65.7857 153.281 51.4664L151.22 50.5322C151.374 51.0479 151.525 51.5632 151.673 52.078C165.421 90.1429 150.533 139.338 109.047 151.863C104.772 153.528 100.515 154.899 96.0493 156.103C100.563 155.094 104.885 153.902 109.244 152.398C151.602 141.819 168.923 89.9497 154.557 51.2492C154.406 50.7241 154.252 50.1986 154.094 49.6728C153.817 48.746 152.913 48.336 152.033 48.7386C133.657 57.2784 115.302 67.6775 102.763 84.2636C89.8627 100.819 88.3575 123.244 92.6915 142.842C93.6052 147.298 94.7451 151.709 96.0493 156.103Z"
					fill="#008375" />
				<path
					d="M97.6111 155.337C65.5612 126.804 59.8678 99.5153 88.5159 54.0216C120.336 81.0297 132.72 117.696 97.6111 155.337Z"
					fill="#00C4B3" fill-opacity="0.2" />
			</svg>
		</div>
		<div class="absolute inset-0 bg-black/50"></div>



		<div class="flex flex-col xl:flex-row xl:justify-between xl:items-end w-full z-10 gap-8 xl:gap-0">
			<div class="max-w-2xl">
				<p class="text-12px font-bold uppercase inline-block self-start text-green-04">
					<?php echo esc_html($taglineb); ?>
				</p>
				<h2 class="mt-4 text-24px md:text-32px 3xl:text-40px text-beje-01">
					<?php echo esc_html($titleb); ?>
				</h2>
				<p class="mt-2 text-16px text-grey-01 line-clamp-3 md:line-clamp-none">
					<?php echo esc_html($descriptionb); ?>
				</p>
			</div>
			<div class="flex-shrink-0 w-full md:w-auto">
				<?php
				// Lógica Condicional para o Botão
				if ($button_type == 'link' && $button_link):
					?>
					<a href="<?php echo esc_url($button_link['url']); ?>"
						target="<?php echo esc_attr($button_link['target']); ?>"
						class="inline-flex w-full md:w-auto items-center justify-center gap-3 px-8 py-6 border-2 border-green-04 rounded-full text-base font-medium text-green-04 hover:bg-green-04 hover:text-white js-transition">
						<span><?php echo esc_html($button_link['title']); ?></span>
						<svg class="w-5 h-5 -rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
							stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
						</svg>
					</a>
					<?php
				elseif ($button_type == 'download' && $button_download):
					?>
					<a download href="<?php echo esc_url($button_download['url']); ?>" download
						class="inline-flex w-full md:w-auto items-center justify-center gap-3 px-8 py-6 border-2 border-green-04 rounded-full text-base font-medium text-green-04 hover:bg-green-04 hover:text-white js-transition">
						<span><?php echo esc_url($button_download['title']); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path
								d="M4 15.5911C2.81055 14.9966 2 13.8151 2 12.4545C2 10.89 3.0718 9.56223 4.55906 9.09163C4.52015 8.83913 4.5 8.58088 4.5 8.31818C4.5 5.38103 7.0184 3 10.125 3C12.2092 3 14.0287 4.0717 15.0005 5.66404C15.4153 5.47166 15.8818 5.36364 16.375 5.36364C18.1009 5.36364 19.5 6.68643 19.5 8.31818C19.5 8.58074 19.4638 8.8353 19.3958 9.07764C20.9065 9.53545 22 10.8743 22 12.4545C22 13.8151 21.1895 14.9966 20 15.5911M12 21L16 17M12 21L8 17M12 21V12"
								stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</a>
				<?php endif; ?>
			</div>
		</div>


	</div>
</section>

<?php
get_footer();
?>