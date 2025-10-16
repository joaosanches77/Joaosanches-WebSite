<?php
get_header();
$s = get_search_query();
$args = array('s' => $s);
$searchterm = strlen($s) >= 3 ? $s : null;

// GET TOTAL POSTS
$search_query = new WP_Query(array('s' => $s, 'post_type' => array('post', 'page', 'events', 'resources')));
?>

<section id="search-page" class="pb-80 inner-page-hero division">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <div class="inner-page-title">
          <h2 class="s-52 w-700">Search Results</h2>
        </div>
        <div class="txt-block">
          <!-- SEARCH -->
          <form role="search" method="get" action="<?= get_home_url(); ?>" class="newsletter-form">
            <div class="input-group r-06">
              <input type="text" name="s" minlength="3" value="<?= $searchterm; ?>" class="form-control" placeholder="Search by the terms" required id="search" />
              <span class="input-group-btn ico-15">
                <button type="submit" class="btn">
                  <span class="flaticon-right-arrow-1"></span>
                </button>
              </span>
            </div>
            <?php if ($searchterm) : ?>
              <?php if ($search_query->found_posts) : ?>
                <p><?php echo ($search_query->found_posts === 1) ? '1 result found' : $search_query->found_posts . ' results found'; ?></p>
              <?php else : ?>
                <p>No results found</p>
              <?php endif; ?>
            <?php endif; ?>
          </form>
          <?php if (strlen($s) >= 3) : ?>
            <!-- LIST -->
            <div class="posts-wrapper mt-20 mb-100">
              <?php
              /**
               * ARTICLES
               * * */
              $articles = new WP_Query(array('post_type' => 'post', 's' => $s));
              if ($articles->have_posts()) :
              ?>
                <div class="row mt-30">
                  <h2>News <span class="p-sm"><?= $articles->found_posts; ?></span></h2>
                  <?php
                  while ($articles->have_posts()) : $articles->the_post();
                    $url = get_the_post_thumbnail_url(); ?>
                    <div class="col-md-6 col-lg-4">
                      <div class="blog-post mb-40 wow fadeInUp clearfix">
                        <a href="<?php the_permalink(); ?>">
                          <div class="blog-post-img mb-35">
                            <?php if ($url) : ?>
                              <img class="img-fluid r-16" src="<?= aq_resize($url, 420, 300, true, true, true); ?>" alt="blog-post-image" />
                            <?php else : ?>
                              <div class="r-16"></div>
                            <?php endif; ?>
                          </div>
                        </a>
                        <div class="blog-post-txt">
                          <span class="post-tag color--primary"><?php echo get_the_category_list(); ?></span>
                          <h6 class="s-20 w-700">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo wp_trim_words(get_the_title(), 14); ?></a>
                            </h2>
                            <?php echo wp_trim_words(get_the_excerpt(), 16); ?>
                            <div class="blog-post-meta mt-20">
                              <ul class="post-meta-list ico-10">
                                <li>
                                  <p class="p-sm"><?php the_time('M d, Y'); ?></p>
                                </li>
                              </ul>
                            </div>
                        </div>
                      </div>
                    </div>
                  <?php endwhile;
                  wp_reset_postdata();
                  ?>
                </div>
              <?php endif; ?>

              <?php
              /**
               * EVENTS
               * * */
              $events = new WP_Query(array('post_type' => 'events', 's' => $s));
              if ($events->have_posts()) :
              ?>
                <div class="row mt-30">
                  <h2>Events <span class="p-sm"><?= $events->found_posts; ?></span></h2>
                  <?php while ($events->have_posts()) : $events->the_post();
                    $url = get_the_post_thumbnail_url();
                    $location = get_field("location");
                    $date = generate_date_sentence(get_field("start_date"), get_field("end_date")); ?>
                    <div class="col-md-6 col-lg-4">
                      <div class="blog-post mb-40 wow fadeInUp clearfix">
                        <a href="<?php the_permalink(); ?>">
                          <div class="blog-post-img mb-35">
                            <?php if ($url) : ?>
                              <img class="img-fluid r-16" src="<?= aq_resize($url, 420, 300, true, true, true); ?>" alt="blog-post-image" />
                            <?php else : ?>
                              <div class="r-16"></div>
                            <?php endif; ?>
                          </div>
                        </a>

                        <div class="blog-post-txt">
                          <span class="post-tag color--primary"><?php echo get_the_category_list(); ?></span>
                          <h6 class="s-20 w-700">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo wp_trim_words(get_the_title(), 16); ?></a>
                            </h2>
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            <div class="blog-post-meta mt-20">
                              <ul class="post-meta-list ico-10">
                                <?php if ($location) : ?>
                                  <li>
                                    <p class="p-sm w-500"><?= $location; ?></p>
                                  </li>
                                <?php endif; ?>
                              </ul>
                            </div>
                        </div>
                      </div>
                    </div>
                  <?php endwhile;
                  wp_reset_postdata(); ?>
                </div>
              <?php endif; ?>

              <?php
              /**
               * RESOURCES
               * * */
              $resources = new WP_Query(array('post_type' => 'resources', 's' => $s));
              if ($resources->have_posts()) :
              ?>
                <div class="row mt-30 resources-results">
                  <h2>Resources <span class="p-sm"><?= $resources->found_posts; ?></span></h2>
                  <?php while ($resources->have_posts()) : $resources->the_post();
                    $type = get_field("type");
                    $file = get_field("file");
                    $link = get_field("external_link");
                    $taxs = get_the_terms(get_the_ID(), "resource_category");
                    $description = get_field("description");
                  ?>
                    <?php if ($type === "file") : ?>
                      <div class="col-md-6 col-lg-4">
                        <div class="blog-post mb-40 wow fadeInUp clearfix">
                          <a href="<?= $file["url"]; ?>" download="<?= $file["filename"]; ?>">
                            <div class="blog-post-img mb-35">
                              <div class="r-16">
                                <span><?php foreach($taxs as $tax): echo "<span>".$tax->name."</span>"; endforeach; ?></span>
                                <h2 class="s-20 w-700"><?php the_title(); ?></h2>
                                <p>Download <span><?= get_simplified_mime_type($file); ?></span></p>
                              </div>
                            </div>
                          </a>
                        </div>
                      </div>
                    <?php else : ?>
                      <div class="col-md-6 col-lg-4">
                        <div class="blog-post mb-40 wow fadeInUp clearfix">
                          <a href="<?= $link; ?>">
                            <div class="blog-post-img mb-35">
                              <div class="r-16">
                                <span><?php foreach($taxs as $tax): echo "<span>".$tax->name."</span>"; endforeach; ?>External Link</span>
                                <h2 class="s-20 w-700"><?php the_title(); ?></h2>
                                <p>Open in new tab</p>
                              </div>
                            </div>
                          </a>
                        </div>
                      </div>
                    <?php endif; ?>
                  <?php endwhile;
                  wp_reset_postdata(); ?>
                </div>
              <?php endif; ?>

              <?php
              /**
               * PAGES
               * * */
              $results = new WP_Query(array('post_type' => 'page', 's' => $s));
              if ($results->have_posts()) :
              ?>
                <div class="row mt-30 pages-results">
                  <h2>Pages <span class="p-sm"><?= $results->found_posts; ?></span></h2>
                  <?php while ($results->have_posts()) : $results->the_post();
                    $url = get_the_post_thumbnail_url();
                    $location = get_field("location");
                    $date = generate_date_sentence(get_field("start_date"), get_field("end_date")); ?>
                    <div class="col-md-6 col-lg-4">
                      <div class="blog-post mb-40 wow fadeInUp clearfix">
                        <a href="<?php the_permalink(); ?>">
                          <div class="blog-post-img mb-35">
                            <div class="r-16">
                              <h2 class="s-20 w-700"><?php the_title(); ?></h2>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  <?php endwhile;
                  wp_reset_postdata(); ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>