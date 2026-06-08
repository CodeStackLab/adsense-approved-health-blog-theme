<?php
/**
 * Health Beyond Age Theme Functions
 * Complete theme setup, enqueuing, customizer, menus, widgets, and admin panel.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'HBA_VERSION', time() );
define( 'HBA_DIR', get_template_directory() );
define( 'HBA_URI', get_template_directory_uri() );

/* ============================================================
   1. THEME SETUP
   ============================================================ */
function hba_setup() {
    load_theme_textdomain( 'healthbeyondage', HBA_DIR . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', ['search-form','comment-form','comment-list','gallery','caption','style','script'] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );

    // Custom image sizes
    add_image_size( 'hba-thumbnail',  400, 280, true );
    add_image_size( 'hba-featured',   800, 450, true );
    add_image_size( 'hba-hero',      1200, 600, true );
    add_image_size( 'hba-square',     400, 400, true );

    // Register nav menus
    register_nav_menus([
        'primary'  => __( 'Primary Menu', 'healthbeyondage' ),
        'footer'   => __( 'Footer Menu', 'healthbeyondage' ),
        'social'   => __( 'Social Links', 'healthbeyondage' ),
    ]);
}
add_action( 'after_setup_theme', 'hba_setup' );

/* ============================================================
   2. ENQUEUE SCRIPTS & STYLES
   ============================================================ */
function hba_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'hba-google-fonts',
        'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap',
        [], null
    );

    // Main CSS
    wp_enqueue_style( 'hba-main', HBA_URI . '/assets/css/main.css', ['hba-google-fonts'], HBA_VERSION );

    // Customizer dynamic CSS
    wp_add_inline_style( 'hba-main', hba_get_customizer_css() );

    // Main JS
    wp_enqueue_script( 'hba-main', HBA_URI . '/assets/js/main.js', [], HBA_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'hba_enqueue_assets' );

/* ============================================================
   3. DYNAMIC CUSTOMIZER CSS OUTPUT
   ============================================================ */
function hba_get_customizer_css() {
    $primary   = get_theme_mod( 'hba_primary_color',   '#1A7A3C' );
    $secondary = get_theme_mod( 'hba_secondary_color', '#22963F' );
    $bg        = get_theme_mod( 'hba_body_bg',         '#F5F8F6' );
    $text      = get_theme_mod( 'hba_text_color',      '#111F16' );
    $body_font = get_theme_mod( 'hba_body_font',       "'DM Sans', system-ui, sans-serif" );
    $head_font = get_theme_mod( 'hba_heading_font',    "'Merriweather', Georgia, serif" );

    $sp_title_size   = get_theme_mod( 'hba_sp_title_size', 2.2 );
    $sp_content_size = get_theme_mod( 'hba_sp_content_size', 0.92 );
    $sp_kt_bg        = get_theme_mod( 'hba_sp_kt_bg', '#1B6B3A' );
    $sp_callout_border = get_theme_mod( 'hba_sp_callout_border', '#27903F' );

    return "
    :root {
        --g1: {$primary};
        --g2: {$secondary};
        --off: {$bg};
        --text: {$text};
        --sans: {$body_font};
        --serif: {$head_font};
    }
    .single-post .article-main h1 { font-size: {$sp_title_size}rem !important; }
    .single-post .article-body { font-size: {$sp_content_size}rem !important; }
    .single-post .key-takeaways { background: {$sp_kt_bg} !important; }
    .single-post .callout { border-left-color: {$sp_callout_border} !important; }
    ";
}

/* ============================================================
   4. WIDGET AREAS
   ============================================================ */
function hba_widgets_init() {
    register_sidebar([
        'name'          => __( 'Article Sidebar', 'healthbeyondage' ),
        'id'            => 'article-sidebar',
        'description'   => __( 'Widgets in the single article sidebar.', 'healthbeyondage' ),
        'before_widget' => '<div class="sidebar-card">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="sidebar-card-hd">',
        'after_title'   => '</div><div class="sidebar-card-body">',
    ]);
    register_sidebar([
        'name'          => __( 'Footer Widget 1', 'healthbeyondage' ),
        'id'            => 'footer-1',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h5>',
        'after_title'   => '</h5>',
    ]);
}
add_action( 'widgets_init', 'hba_widgets_init' );

/* ============================================================
   5. CUSTOMIZER
   ============================================================ */
require_once HBA_DIR . '/inc/customizer.php';

/* ============================================================
   6. ADMIN MENU PAGE
   ============================================================ */
require_once HBA_DIR . '/inc/admin-panel.php';

/* ============================================================
   7. HELPER FUNCTIONS
   ============================================================ */

/**
 * Get reading time estimate
 */
function hba_reading_time( $post_id = null ) {
    $content    = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    $minutes    = max( 1, round( $word_count / 200 ) );
    return $minutes . ' min read';
}

/**
 * Get author initials
 */
function hba_author_initials( $user_id = null ) {
    if ( ! $user_id ) $user_id = get_the_author_meta( 'ID' );
    $first = get_the_author_meta( 'first_name', $user_id );
    $last  = get_the_author_meta( 'last_name', $user_id );
    if ( $first && $last ) return strtoupper( $first[0] . $last[0] );
    $name  = get_the_author_meta( 'display_name', $user_id );
    $parts = explode( ' ', $name );
    $init  = '';
    foreach ( $parts as $p ) $init .= strtoupper( $p[0] ?? '' );
    return substr( $init, 0, 2 );
}

/**
 * Get category badge class
 */
function hba_category_badge_class( $cat_slug ) {
    $map = [
        'nutrition'         => 'bg-green',
        'fitness'           => 'bg-gold',
        'mental-wellness'   => 'bg-plum',
        'preventive-health' => 'bg-blue',
        'skin-care'         => 'bg-rust',
        'sleep'             => 'bg-teal',
    ];
    return $map[ $cat_slug ] ?? 'bg-green';
}

/**
 * Output announcement bar
 */
function hba_announcement_bar() {
    $text = get_theme_mod( 'hba_ann_bar_text', 'All content is <strong>medically reviewed</strong> by qualified health professionals — updated regularly for accuracy.' );
    echo '<div class="ann-bar">' . wp_kses_post( $text ) . '</div>';
}

/**
 * Output newsletter section
 */
function hba_newsletter_section( $chip = '✦ Weekly digest', $title = 'Stay Ahead of<br/>Your Health', $desc = 'Expert-curated wellness insights, the latest research, and practical tips — delivered every Friday. No noise, no spam.' ) {
    $t = get_theme_mod( 'hba_newsletter_title', $title );
    $d = get_theme_mod( 'hba_newsletter_desc',  $desc );
    ?>
    <div class="nl-section">
        <div class="nl-inner">
            <div class="nl-chip"><?php echo esc_html( $chip ); ?></div>
            <h2><?php echo wp_kses_post( $t ); ?></h2>
            <p><?php echo wp_kses_post( $d ); ?></p>
            <form class="nl-form" method="post" action="#">
                <input type="email" name="email" placeholder="<?php esc_attr_e( 'your@email.com', 'healthbeyondage' ); ?>" required />
                <button type="submit"><?php esc_html_e( 'Subscribe Free', 'healthbeyondage' ); ?></button>
            </form>
            <div class="nl-perks">
                <div class="nl-perk"><div class="pdot"></div><?php esc_html_e( 'Weekly health insights', 'healthbeyondage' ); ?></div>
                <div class="nl-perk"><div class="pdot"></div><?php esc_html_e( 'Evidence-based research', 'healthbeyondage' ); ?></div>
                <div class="nl-perk"><div class="pdot"></div><?php esc_html_e( 'Unsubscribe anytime', 'healthbeyondage' ); ?></div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Render single article card
 */
function hba_article_card( $post_id, $extra_class = '' ) {
    $post   = get_post( $post_id );
    if ( ! $post ) return;

    $thumb_url = get_the_post_thumbnail_url( $post_id, 'hba-thumbnail' );
    $cats      = get_the_category( $post_id );
    $cat       = ! empty( $cats ) ? $cats[0] : null;
    $cat_name  = $cat ? $cat->name : '';
    $cat_slug  = $cat ? $cat->slug : '';
    $badge     = hba_category_badge_class( $cat_slug );
    $author_id = $post->post_author;
    $initials  = hba_author_initials( $author_id );
    $author    = get_the_author_meta( 'display_name', $author_id );
    $read_time = hba_reading_time( $post_id );
    $link      = get_permalink( $post_id );
    ?>
    <a href="<?php echo esc_url( $link ); ?>" class="art-card <?php echo esc_attr( $extra_class ); ?>">
        <div class="art-thumb">
            <?php if ( $thumb_url ) : ?>
                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" loading="lazy" />
            <?php endif; ?>
            <?php if ( $cat_name ) : ?>
                <span class="art-badge <?php echo esc_attr( $badge ); ?>"><?php echo esc_html( $cat_name ); ?></span>
            <?php endif; ?>
        </div>
        <div class="art-body">
            <h3><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
            <div class="art-foot">
                <div class="author-row">
                    <div class="av"><?php echo esc_html( $initials ); ?></div>
                    <span class="aname"><?php echo esc_html( $author ); ?></span>
                </div>
                <span class="rtime"><?php echo esc_html( $read_time ); ?></span>
            </div>
        </div>
    </a>
    <?php
}

/**
 * Render list-style article item
 */
function hba_article_list_item( $post_id ) {
    $thumb_url = get_the_post_thumbnail_url( $post_id, 'hba-square' );
    $cats      = get_the_category( $post_id );
    $cat_name  = ! empty( $cats ) ? $cats[0]->name : '';
    $read_time = hba_reading_time( $post_id );
    $link      = get_permalink( $post_id );
    ?>
    <a href="<?php echo esc_url( $link ); ?>" class="art-list-item">
        <div class="ali-thumb">
            <?php if ( $thumb_url ) : ?>
                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="" loading="lazy" />
            <?php endif; ?>
        </div>
        <div class="ali-body">
            <?php if ( $cat_name ) : ?>
                <div class="ali-cat"><?php echo esc_html( $cat_name ); ?></div>
            <?php endif; ?>
            <h3><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
            <div class="ali-meta"><?php echo get_the_date( '', $post_id ); ?> · <?php echo esc_html( $read_time ); ?></div>
        </div>
    </a>
    <?php
}

/**
 * Breadcrumb
 */
function hba_breadcrumb() {
    $sep = '<span class="sep">›</span>';
    echo '<div class="breadcrumb"><div class="breadcrumb-inner">';
    echo '<a href="' . home_url('/') . '">' . __('Home','healthbeyondage') . '</a>' . $sep;
    if ( is_single() ) {
        $cats = get_the_category();
        if ( $cats ) {
            echo '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . esc_html( $cats[0]->name ) . '</a>' . $sep;
        }
        echo '<span>' . get_the_title() . '</span>';
    } elseif ( is_category() ) {
        echo '<span>' . single_cat_title('',false) . '</span>';
    } elseif ( is_archive() ) {
        echo '<span>' . get_the_archive_title() . '</span>';
    } elseif ( is_search() ) {
        echo '<span>' . sprintf( __('Search: %s','healthbeyondage'), get_search_query() ) . '</span>';
    } elseif ( is_page() ) {
        echo '<span>' . get_the_title() . '</span>';
    }
    echo '</div></div>';
}

/**
 * Document title separator
 */
add_filter( 'document_title_separator', function() { return '—'; } );

/**
 * Excerpt length
 */
add_filter( 'excerpt_length', function() { return 25; } );
add_filter( 'excerpt_more', function() { return '…'; } );

/**
 * Content width
 */
if ( ! isset( $content_width ) ) $content_width = 1180;

/**
 * Add View Count (simple meta-based)
 */
function hba_count_post_views( $post_id ) {
    if ( is_single() && ! is_user_logged_in() ) {
        $count = (int) get_post_meta( $post_id, 'hba_view_count', true );
        update_post_meta( $post_id, 'hba_view_count', $count + 1 );
    }
}

function hba_get_post_views( $post_id ) {
    $count = (int) get_post_meta( $post_id, 'hba_view_count', true );
    return $count > 999 ? round($count/1000,1) . 'K' : $count;
}

/* ============================================================
   8. PAGINATION HELPER
   ============================================================ */
function hba_pagination() {
    global $wp_query;
    if ( $wp_query->max_num_pages <= 1 ) return;
    $big = 999999999;
    $pages = paginate_links([
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var( 'paged' ) ),
        'total'     => $wp_query->max_num_pages,
        'type'      => 'array',
        'prev_text' => '←',
        'next_text' => '→',
    ]);
    if ( $pages ) {
        echo '<div class="load-more">';
        foreach ( $pages as $page ) echo $page;
        echo '</div>';
    }
}

/* ============================================================
   9. SEO META TAGS
   ============================================================ */
function hba_seo_meta() {
    if ( is_single() || is_page() ) {
        $desc = wp_strip_all_tags( get_the_excerpt() );
        $img  = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">' . "\n";
        if ( $img ) echo '<meta property="og:image" content="' . esc_url( $img ) . '">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    } else {
        $desc = esc_attr( get_theme_mod( 'hba_site_description', get_bloginfo('description') ) );
        echo '<meta name="description" content="' . $desc . '">' . "\n";
    }
}
add_action( 'wp_head', 'hba_seo_meta' );

/* ============================================================
   10. INCLUDES
   ============================================================ */
require get_template_directory() . '/inc/medical-reviewers.php';
