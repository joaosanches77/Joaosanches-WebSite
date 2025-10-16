<?php
get_header();


# HEADING
$heading = get_field("page404", "options");
?>

<section id="page-404" class="bg--white-300 division">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-9 col-lg-8">
                <div class="page-404-txt text-center">
                    <?php if ($heading && $heading["title"]) : ?>
                        <h2 class="s-56 w-700 color--dark"><?= $heading["title"]; ?></h2>
                    <?php else : ?>
                        <h2 class="s-56 w-700 color--dark"><?php _e("Página não encontrada", "verdagua"); ?></h2>
                    <?php endif; ?>
                    <?php if ($heading && $heading["text"]) : ?>
                        <h6 class="s-22 color--grey"><?= $heading["text"]; ?> </h6>
                    <?php else : ?>
                        <h6 class="s-22 color--grey">
                            <?php _e("Oops! The page you are looking for might have been moved, renamed or might never existed", "verdagua"); ?>
                        </h6>
                    <?php endif; ?>

                    <a href="<?= get_home_url(); ?>" class="btn btn--theme hover--theme"><?php _e("Voltar para a homepage", "verdagua"); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="divider divider-light" />

<?php get_footer(); ?>