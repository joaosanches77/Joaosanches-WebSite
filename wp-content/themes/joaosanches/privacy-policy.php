<?php
get_header();
?>

<section id="privacy-page" class="padding-nav pb-10 lg:pb-20">
    <div class="main-container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()):
                        the_post(); ?>
                        <div class="inner-page-title">
                            <h1 class="text-center text-48px lg:text-56px text-green-01 wow animate__animated animate__fadeInUp mb-10"
                                data-wow-delay=".1s">
                                <?php the_title(); ?>
                            </h1>
                        </div>
                        <div class="txt-block legal-info text-grey-02 wow animate__animated animate__fadeIn" data-wow-delay=".3s">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <article class="post error">
                        <h1 class="404">Nothing posted yet</h1>
                    </article>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php
get_footer();
?>