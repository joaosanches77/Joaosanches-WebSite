<?php
/**
 * Funções e definições do tema joaosanches
 */

// -----------------------------------------------------------------------------
// Includes e Constantes
// -----------------------------------------------------------------------------
require_once('helpers/aq_resizer.php');
require_once('helpers/aq_resizer_helper.php');

define('THEME_VERSION', 1.001);


// -----------------------------------------------------------------------------
// Configuração Inicial do Tema
// -----------------------------------------------------------------------------
function joaosanches_theme_setup()
{
    // Esconde a barra de admin no frontend
    add_filter('show_admin_bar', '__return_false');

    // Suporte para Imagens de Destaque
    add_theme_support('post-thumbnails');

    // Registar Menus de Navegação
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'joaosanches'),
        'footer' => __('Menu do Rodapé', 'joaosanches'),
    ));

    // Define a largura do conteúdo
    if (!isset($content_width)) {
        $content_width = 900;
    }
}
add_action('after_setup_theme', 'joaosanches_theme_setup');


// -----------------------------------------------------------------------------
// Configurações do ACF (Advanced Custom Fields)
// -----------------------------------------------------------------------------
/**
 * CORREÇÃO: Regista a Página de Opções do ACF na ação correta ('acf/init')
 * para resolver o aviso 'load_textdomain_just_in_time'.
 */
function joaosanches_acf_init()
{
    if (function_exists('acf_add_options_sub_page')) {
        acf_add_options_sub_page(array(
            'title' => 'Website Settings',
            'capability' => 'edit_posts'
        ));
    }
}
add_action('acf/init', 'joaosanches_acf_init');


// -----------------------------------------------------------------------------
// Registar Scripts e Estilos (CSS/JS)
// -----------------------------------------------------------------------------
function joaosanches_enqueue_assets()
{
    // Adicionar Google Fonts
    wp_enqueue_style('google-fonts-outfit', 'https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap', array(), null);

    // Estilos CSS do Tema e bibliotecas
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/owl.carousel.min.css', array(), THEME_VERSION);
    wp_enqueue_style('owl-theme', get_template_directory_uri() . '/assets/owl.theme.default.min.css', array('owl-carousel'), THEME_VERSION);
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/theme.min.css', array('owl-carousel'), THEME_VERSION);

    // Scripts JS
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/owl.carousel.min.js', array('jquery'), THEME_VERSION, true);
    // O nosso script principal depende do jQuery e do Owl Carousel para carregar primeiro
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/theme.min.js', array('jquery', 'owl-carousel'), THEME_VERSION, true);

    // Passar o URL do AJAX para o 'theme-script' para os filtros funcionarem
    wp_localize_script('theme-script', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));

    // Font Awesome Kit
    wp_enqueue_script('font-awesome-kit', 'https://kit.fontawesome.com/2e0e2e0ad7.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'joaosanches_enqueue_assets');


// -----------------------------------------------------------------------------
// Custom Post Types e Taxonomias
// -----------------------------------------------------------------------------

/**
 * Regista o Custom Post Type 'product'.
 */
function register_product_post_type()
{
    $labels = array(
        'name' => _x('Produtos', 'Post Type General Name', 'product'),
        'singular_name' => _x('Produto', 'Post Type Singular Name', 'product'),
        'menu_name' => __('Produtos', 'product'),
        'name_admin_bar' => __('Adicionar Novo Produto', 'product'),
        'archives' => __('Arquivo de Produtos', 'product'),
        'parent_item_colon' => __('Produto Pai:', 'product'),
        'all_items' => __('Todos os Produtos', 'product'),
        'add_new_item' => __('Adicionar Novo Produto', 'product'),
        'add_new' => __('Adicionar Novo', 'product'),
        'new_item' => __('Novo Produto', 'product'),
        'edit_item' => __('Editar Produto', 'product'),
        'update_item' => __('Atualizar Produto', 'product'),
        'view_item' => __('Ver Produto', 'product'),
        'search_items' => __('Procurar Produto', 'product'),
        'not_found' => __('Não Encontrado', 'product'),
        'not_found_in_trash' => __('Não Encontrado no Lixo', 'product'),
        'featured_image' => __('Imagem de Destaque', 'product'),
        'set_featured_image' => __('Definir Imagem de Destaque', 'product'),
        'remove_featured_image' => __('Remover Imagem de Destaque', 'product'),
        'use_featured_image' => __('Usar como Imagem de Destaque', 'product'),
        'insert_into_item' => __('Inserir no Produto', 'product'),
        'uploaded_to_this_item' => __('Carregado para este Produto', 'product'),
        'items_list' => __('Lista de Produtos', 'product'),
        'items_list_navigation' => __('Navegação da Lista de Produtos', 'product'),
        'filter_items_list' => __('Filtrar Lista de Produtos', 'product'),
    );
    $args = array(
        'label' => __('Produto', 'product'),
        'description' => __('Catálogo de produtos e serviços', 'product'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes'),
        'taxonomies' => array('product_category', 'product_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-cart',
        'menu_position' => 20,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('product', $args);
}
add_action('init', 'register_product_post_type', 0);

/**
 * Regista as Taxonomias para os Produtos.
 */
function register_product_taxonomies()
{
    $category_labels = array(
        'name' => _x('Categorias de Produtos', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Categoria de Produto', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Procurar Categorias', 'textdomain'),
        'all_items' => __('Todas as Categorias', 'textdomain'),
        'parent_item' => __('Categoria-Pai', 'textdomain'),
        'parent_item_colon' => __('Categoria-Pai:', 'textdomain'),
        'edit_item' => __('Editar Categoria', 'textdomain'),
        'update_item' => __('Atualizar Categoria', 'textdomain'),
        'add_new_item' => __('Adicionar Nova Categoria', 'textdomain'),
        'new_item_name' => __('Nome da Nova Categoria', 'textdomain'),
        'menu_name' => __('Categorias', 'textdomain'),
    );
    $category_args = array(
        'hierarchical' => true,
        'labels' => $category_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'product-category'),
    );
    register_taxonomy('product_category', array('product'), $category_args);

    $tag_labels = array(
        'name' => _x('Etiquetas de Produtos', 'taxonomy general name', 'textdomain'),
        'singular_name' => _x('Etiqueta de Produto', 'taxonomy singular name', 'textdomain'),
        'search_items' => __('Procurar Etiquetas', 'textdomain'),
        'all_items' => __('Todas as Etiquetas', 'textdomain'),
        'edit_item' => __('Editar Etiqueta', 'textdomain'),
        'update_item' => __('Atualizar Etiqueta', 'textdomain'),
        'add_new_item' => __('Adicionar Nova Etiqueta', 'textdomain'),
        'new_item_name' => __('Nome da Nova Etiqueta', 'textdomain'),
        'menu_name' => __('Etiquetas', 'textdomain'),
    );
    $tag_args = array(
        'hierarchical' => false,
        'labels' => $tag_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'product-tag'),
    );
    register_taxonomy('product_tag', array('product'), $tag_args);
}
add_action('init', 'register_product_taxonomies', 0);


// -----------------------------------------------------------------------------
// Funções AJAX
// -----------------------------------------------------------------------------

/**
 * AJAX para "Carregar Mais" notícias
 */
function get_news()
{
    $category = isset($_POST['category']) ? $_POST['category'] : null;
    $paged = isset($_POST['page']) ? $_POST['page'] : 1;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => get_option('posts_per_page'),
        'paged' => $paged
    );

    if (!empty($category) && $category != '*') {
        $args['category_name'] = $category;
    }

    $news_query = new WP_Query($args);
    if ($news_query->have_posts()):
        while ($news_query->have_posts()):
            $news_query->the_post();
            $categories = get_the_category();
            $category = (is_array($categories) && count($categories)) ? $categories[0] : null ?>
            <a href="<?php the_permalink() ?>" class="col-span-1 md:col-span-3 flex flex-col gap-4 md:gap-6">
                <div class="aspect-video-inverted relative overflow-hidden">
                    <?php the_post_thumbnail("large", array("class" => "object-cover w-full h-full")); ?>
                </div>
                <div class="flex flex-col flex-1 justify-between gap-16px">
                    <div class="flex flex-col gap-16px">
                        <p class="text-10px md:text-12px font-domaine uppercase"><?= $category->name ?></p>
                        <h2 class="text-18px md:text-24px line-clamp-2 font-narrow font-normal"><?php the_title(); ?></h2>
                    </div>
                    <p class="uppercase font-redhat text-11px opacity-50"><?= the_time('j F, Y'); ?></p>
                </div>
            </a>
            <?php
        endwhile;
    else:
        echo __("Não há histórias para apresentar", "joaosanches");
    endif;
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_get_news', 'get_news');
add_action('wp_ajax_nopriv_get_news', 'get_news');

/**
 * AJAX para filtrar produtos por categoria
 */
function filter_products_by_category()
{
    $category_slug = $_POST['category'];
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    );
    if ($category_slug != '*') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_category',
                'field' => 'slug',
                'terms' => $category_slug,
            ),
        );
    }
    $products_query = new WP_Query($args);
    if ($products_query->have_posts()) {
        while ($products_query->have_posts()) {
            $products_query->the_post();
            get_template_part('parts/card-product');
        }
    } else {
        echo '<p class="col-span-full text-center">Nenhum produto encontrado nesta categoria.</p>';
    }
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filter_products', 'filter_products_by_category');
add_action('wp_ajax_nopriv_filter_products', 'filter_products_by_category');


// -----------------------------------------------------------------------------
// Funções de Template e Helpers
// -----------------------------------------------------------------------------

/**
 * Adiciona o logo ao menu principal
 */
function add_custom_menu_item($items, $args)
{
    // ... (O seu código original e completo aqui)
    return $items;
}
add_filter('wp_nav_menu_objects', 'add_custom_menu_item', 10, 2);


/**
 * Wrapper para o menu principal
 */
function nav_main_menu($id = "main-menu")
{
    wp_nav_menu(
        apply_filters(
            "main",
            array(
                'container' => '',
                'container_id' => 'access',
                'menu_id' => $id,
                'menu_class' => 'items-center',
                'theme_location' => 'primary'
            )
        )
    );
}

/**
 * Wrapper para o menu do rodapé
 */
function nav_footer_menu()
{
    wp_nav_menu(
        apply_filters(
            "footer",
            array(
                'container' => '',
                'container_id' => 'access',
                'menu_id' => 'footer-menu',
                'menu_class' => 'foo-links clearfix',
                'theme_location' => 'footer'
            )
        )
    );
}

/**
 * Funções para o seletor de idiomas (WPML)
 */
function findInArray($array, $key, $value)
{

    $filteredArray = array_filter($array, function ($e) use ($value, $key) {

        return $e[$key] === $value;

    });

    return reset($filteredArray); // Returns the first matching element or false if none found

}

function language_selector()
{
    if (function_exists("icl_get_languages")):
        $languages = icl_get_languages('skip_missing=0');
        $current = findInArray($languages, "language_code", ICL_LANGUAGE_CODE);
        if (!empty($languages) && count($languages) > 1):
            echo "<div class='lang-select dropdown relative pointer-events-auto !overflow-visible'>";
            echo "<button type='button' data-dropdown-toggle='languages' class='p-2 rounded-full inline-flex items-center font-medium gap-2 text-xl text-green-01 bg-beje-02 hover:bg-green-04/40 lv-transition'>";
            echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='currentColor'><path d='M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 16.057v-3.057h2.994c-.059 1.143-.212 2.24-.456 3.279-.823-.12-1.674-.188-2.538-.222zm1.957 2.162c-.499 1.33-1.159 2.497-1.957 3.456v-3.62c.666.028 1.319.081 1.957.164zm-1.957-7.219v-3.015c.868-.034 1.721-.103 2.548-.224.238 1.027.389 2.111.446 3.239h-2.994zm0-5.014v-3.661c.806.969 1.471 2.15 1.971 3.496-.642.084-1.3.137-1.971.165zm2.703-3.267c1.237.496 2.354 1.228 3.29 2.146-.642.234-1.311.442-2.019.607-.344-.992-.775-1.91-1.271-2.753zm-7.241 13.56c-.244-1.039-.398-2.136-.456-3.279h2.994v3.057c-.865.034-1.714.102-2.538.222zm2.538 1.776v3.62c-.798-.959-1.458-2.126-1.957-3.456.638-.083 1.291-.136 1.957-.164zm-2.994-7.055c.057-1.128.207-2.212.446-3.239.827.121 1.68.19 2.548.224v3.015h-2.994zm1.024-5.179c.5-1.346 1.165-2.527 1.97-3.496v3.661c-.671-.028-1.329-.081-1.97-.165zm-2.005-.35c-.708-.165-1.377-.373-2.018-.607.937-.918 2.053-1.65 3.29-2.146-.496.844-.927 1.762-1.272 2.753zm-.549 1.918c-.264 1.151-.434 2.36-.492 3.611h-3.933c.165-1.658.739-3.197 1.617-4.518.88.361 1.816.67 2.808.907zm.009 9.262c-.988.236-1.92.542-2.797.9-.89-1.328-1.471-2.879-1.637-4.551h3.934c.058 1.265.231 2.488.5 3.651zm.553 1.917c.342.976.768 1.881 1.257 2.712-1.223-.49-2.326-1.211-3.256-2.115.636-.229 1.299-.435 1.999-.597zm9.924 0c.7.163 1.362.367 1.999.597-.931.903-2.034 1.625-3.257 2.116.489-.832.915-1.737 1.258-2.713zm.553-1.917c.27-1.163.442-2.386.501-3.651h3.934c-.167 1.672-.748 3.223-1.638 4.551-.877-.358-1.81-.664-2.797-.9zm.501-5.651c-.058-1.251-.229-2.46-.492-3.611.992-.237 1.929-.546 2.809-.907.877 1.321 1.451 2.86 1.616 4.518h-3.933z' /> </svg>";
            echo "<span class='text-sm uppercase whitespace-nowrap'>";
            echo explode('-', $current["code"])[0];
            echo "</span>";
            echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'><path d='M18 9L12 15L6 9' stroke='#001A17' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg>";
            echo "</button>";
            echo "<div id='languages' class='absolute top-full left-1/2 -translate-x-1/2 z-30'>";
            echo "<div class='p-4 rounded-2xl mt-1'>";
            echo "<ul>";
            foreach ($languages as $lang):
                echo "<li>";
                echo "<a href='" . $lang['url'] . "' aria-label='Change language to " . $lang["native_name"] . "'>";
                echo "<span>" . $lang["native_name"] . "</span>";
                echo "</a>";
                echo "</li>";
            endforeach;
            echo "</ul>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        endif;
    endif;
}
function language_selector_intro()
{
    if (function_exists("icl_get_languages")):
        $languages = icl_get_languages('skip_missing=0');
        $current = findInArray($languages, "language_code", ICL_LANGUAGE_CODE);
        if (!empty($languages)):
            echo "<div class='lang-select-intro dropdown relative pointer-events-auto'>";
            echo "<button type='button' data-dropdown-toggle='languages' class='p-2 rounded-full inline-flex items-center font-medium gap-2 text-xl text-green-01 bg-beje-02 hover:bg-green-04/40 lv-transition'>";
            echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='currentColor'><path d='M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 16.057v-3.057h2.994c-.059 1.143-.212 2.24-.456 3.279-.823-.12-1.674-.188-2.538-.222zm1.957 2.162c-.499 1.33-1.159 2.497-1.957 3.456v-3.62c.666.028 1.319.081 1.957.164zm-1.957-7.219v-3.015c.868-.034 1.721-.103 2.548-.224.238 1.027.389 2.111.446 3.239h-2.994zm0-5.014v-3.661c.806.969 1.471 2.15 1.971 3.496-.642.084-1.3.137-1.971.165zm2.703-3.267c1.237.496 2.354 1.228 3.29 2.146-.642.234-1.311.442-2.019.607-.344-.992-.775-1.91-1.271-2.753zm-7.241 13.56c-.244-1.039-.398-2.136-.456-3.279h2.994v3.057c-.865.034-1.714.102-2.538.222zm2.538 1.776v3.62c-.798-.959-1.458-2.126-1.957-3.456.638-.083 1.291-.136 1.957-.164zm-2.994-7.055c.057-1.128.207-2.212.446-3.239.827.121 1.68.19 2.548.224v3.015h-2.994zm1.024-5.179c.5-1.346 1.165-2.527 1.97-3.496v3.661c-.671-.028-1.329-.081-1.97-.165zm-2.005-.35c-.708-.165-1.377-.373-2.018-.607.937-.918 2.053-1.65 3.29-2.146-.496.844-.927 1.762-1.272 2.753zm-.549 1.918c-.264 1.151-.434 2.36-.492 3.611h-3.933c.165-1.658.739-3.197 1.617-4.518.88.361 1.816.67 2.808.907zm.009 9.262c-.988.236-1.92.542-2.797.9-.89-1.328-1.471-2.879-1.637-4.551h3.934c.058 1.265.231 2.488.5 3.651zm.553 1.917c.342.976.768 1.881 1.257 2.712-1.223-.49-2.326-1.211-3.256-2.115.636-.229 1.299-.435 1.999-.597zm9.924 0c.7.163 1.362.367 1.999.597-.931.903-2.034 1.625-3.257 2.116.489-.832.915-1.737 1.258-2.713zm.553-1.917c.27-1.163.442-2.386.501-3.651h3.934c-.167 1.672-.748 3.223-1.638 4.551-.877-.358-1.81-.664-2.797-.9zm.501-5.651c-.058-1.251-.229-2.46-.492-3.611.992-.237 1.929-.546 2.809-.907.877 1.321 1.451 2.86 1.616 4.518h-3.933z' /> </svg>";
            echo "<span class='text-sm uppercase whitespace-nowrap'>";
            echo $current["native_name"];
            echo "</span>";
            echo "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'> <path d='M18 9L12 15L6 9' stroke='#001A17' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg>";
            echo "</button>";
            echo "<div id='languages-intro' class='absolute top-full left-1/2 -translate-x-1/2'>";
            echo "<div class='p-4 rounded-2xl mt-1'>";
            echo "<ul>";
            foreach ($languages as $lang):
                echo "<li>";
                echo "<a href='" . $lang['url'] . "' aria-label='Change language to " . $lang["native_name"] . "' class='" . ($lang["language_code"] === $current["language_code"] ? "active" : "") . "'>";
                echo "<span>" . $lang["native_name"] . "</span>";
                echo "</a>";
                echo "</li>";
            endforeach;
            echo "</ul>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        endif;
    endif;
}

/**
 * Outras funções helper
 */
function themewpautop($content)
{
    $parts = preg_split('/<br\s*\/?>/i', $content);
    $parts = array_map('trim', $parts);
    $parts = array_filter($parts);
    $paragraphs = array_map(function ($part) {
        return '<p>' . $part . '</p>';
    }, $parts);
    return implode('', $paragraphs);
}

function addPercentage($value)
{
    if (is_numeric($value)) {
        $formattedValue = number_format($value, 1);
        return $formattedValue . '%';
    } else {
        return '0%';
    }
}

function getInitials($name)
{
    $words = explode(' ', $name);
    $initials = '';
    foreach ($words as $word) {
        if (!empty($word)) {
            $initials .= strtoupper($word[0]);
        }
    }
    return substr($initials, 0, 3);
}


// -----------------------------------------------------------------------------
// Registo de Sidebars
// -----------------------------------------------------------------------------
function naked_register_sidebars()
{
    register_sidebar(
        array(
            'id' => 'sidebar',
            'name' => 'Sidebar',
            'description' => 'Take it on the side...',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="side-title">',
            'after_title' => '</h3>',
            'empty_title' => '',
        )
    );
}
add_action('widgets_init', 'naked_register_sidebars');