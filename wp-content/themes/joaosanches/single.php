<?php

get_header();

$blocks = get_field("blocks");
$categories = get_categories();


$blog_page_url = get_post_type_archive_link('post');



?>

<section id="story-content" class="padding-nav-small pb-16 sm:pb-24">
	<div class="main-container max-w-4xl mx-auto">

		<div class="text-center">
			<h1 class="text-48px lg:text-56px text-green-01">
				<?php the_title(); ?>
			</h1>
			<p class="mt-4 text-16px text-green-02">
				<?php echo get_the_date('j M, Y'); ?>
			</p>
		</div>

		<div class="mt-10 w-full overflow-hidden rounded-3xl aspect-[2/1]">
			<?php the_post_thumbnail("large", array("class" => "w-full h-full object-cover")); ?>
		</div>

		<div class="relative">
			<?php if ($blocks && is_array($blocks)): ?>
				<?php foreach ($blocks as $index => $item): ?>
					<?php
					// Media block
					if ($item['type'] === "media" && (!empty($item['media']['video']['url']) || !empty($item['media']['image']['url']))):
						?>
						<div class="mx-auto z-50 pt-16 md:pt-24">
							<div class="relative aspect-video w-full overflow-hidden">
								<?php if ($item['media']['type'] === "video"): ?>
									<video controls class="object-cover w-full h-full rounded-3xl">
										<source src="<?= esc_url($item['media']['video']['url']) ?>" type="video/mp4">
									</video>
								<?php elseif ($item['media']['type'] === "image"): ?>
									<img src="<?= $item['media']['image']['url'] ?>" alt="<?= $item['media']['image']['alt'] ?>"
										class="object-cover w-full h-full rounded-3xl" />
								<?php endif; ?>
							</div>
						</div>
						<?php
						// Text block
					elseif ($item['type'] === "text" && !empty($item['text'])): ?>
						<div class="mx-auto pt-16 md:pt-24">
							<div class="text-16px text-grey-02 editor prose max-w-none">
								<?= wpautop($item['text']) ?>
							</div>
						</div>
						<?php
						// Gallery block
					elseif ($item['type'] === "gallery"): ?>
						<div id="article-gallery" class="relative pt-16 md:pt-24 z-50">
							<div id="carousel-detail-storys" class="owl-carousel owl-theme wow animate__fadeInRight"
								data-wow-duration="3s">
								<?php foreach ($item["gallery"] as $image): ?>
									<?php if (isset($image) && is_array($image) && !empty($image['url'])): ?>
										<div class="relative">
											<div class="relative aspect-video overflow-hidden rounded-2xl">
												<img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt']) ?>"
													class="w-full h-full object-cover" />
											</div>
											<?php if (!empty($image["title"])): ?>
												<div class="text-center p-6">
													<strong
														class="font-narrow text-20px italic leading-[1.3] text-green-01"><?= esc_html($image["title"]); ?></strong>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>

							<div class="mt-6">
								<div class="hidden lg:grid grid-cols-3 items-center">
									<div></div>
									<div class="slider-counter text-center text-grey-02 font-medium">
									</div>

									<div class="flex items-center justify-end gap-4">
										<button
											class="gallery-prev-btn px-8 py-6 rounded-full bg-green-04/10 text-green-01 hover:bg-green-04/20 transition-colors">
											<span class="sr-only">Anterior</span>
											<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
												stroke-width="2" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
											</svg>
										</button>
										<button
											class="gallery-next-btn px-8 py-6 rounded-full bg-green-04/10 text-green-01 hover:bg-green-04/20 transition-colors">
											<span class="sr-only">Seguinte</span>
											<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
												stroke-width="2" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
											</svg>
										</button>
									</div>
								</div>

								<div class="lg:hidden text-center">
									<div class="flex items-center justify-center gap-4">
										<button
											class="gallery-prev-btn px-8 py-6 rounded-full bg-green-04/10 text-green-01 hover:bg-green-04/20 transition-colors">
											<span class="sr-only">Anterior</span>
											<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
												stroke-width="2" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
											</svg>
										</button>
										<button
											class="gallery-next-btn px-8 py-6 rounded-full bg-green-04/10 text-green-01 hover:bg-green-04/20 transition-colors">
											<span class="sr-only">Seguinte</span>
											<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
												stroke-width="2" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
											</svg>
										</button>
									</div>

									<div class="slider-counter text-grey-02 font-medium mt-4">
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<div class="mt-16 md:mt-24 text-center">
			<a href="<?php echo esc_url($blog_page_url); ?>"
				class="inline-flex items-center justify-center gap-3 px-8 py-6 text-16px rounded-full text-green-01 bg-green-04/10 hover:bg-green-04/30 js-transition font-medium">
				<span><?php _e("Explorar todas as notícias", "joaosanches"); ?></span>
				<svg class="w-5 h-5 -rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
					stroke-width="1.5" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
				</svg>
			</a>

		</div>

	</div>
</section>


<?php get_footer(); ?>