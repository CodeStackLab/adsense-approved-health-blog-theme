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
    add_theme_support( 'appearance-tools' );
    add_theme_support( 'custom-spacing' );
    add_theme_support( 'custom-typography' );
    add_theme_support( 'custom-line-height' );

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
    // Google Fonts - Dynamic Enqueue based on Customizer selections
    $body_font = get_theme_mod( 'hba_body_font', "'DM Sans', system-ui, sans-serif" );
    $head_font = get_theme_mod( 'hba_heading_font', "'Merriweather', Georgia, serif" );
    $hero_font = get_theme_mod( 'hba_hero_font', '' );
    
    $fonts = [];
    if ( preg_match('/^\'([^\']+)\'/', $body_font, $b_match) ) {
        $fonts[] = urlencode($b_match[1]) . ':wght@300;400;500;600;700';
    } else {
        $fonts[] = 'DM+Sans:wght@300;400;500;600;700';
    }
    
    if ( preg_match('/^\'([^\']+)\'/', $head_font, $h_match) ) {
        $fonts[] = urlencode($h_match[1]) . ':ital,wght@0,300;0,400;0,700;1,300;1,400';
    } else {
        $fonts[] = 'Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400';
    }
    
    if ( !empty($hero_font) && preg_match('/^\'([^\']+)\'/', $hero_font, $hero_match) ) {
        $fonts[] = urlencode($hero_match[1]) . ':ital,wght@0,300;0,400;0,700;0,800;0,900;1,300;1,400';
    }

    $fonts = array_unique($fonts);
    $font_url = 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $fonts) . '&display=swap';

    wp_enqueue_style( 'hba-google-fonts', $font_url, [], null );

    // Main CSS
    wp_enqueue_style( 'hba-main', HBA_URI . '/assets/css/main.css', ['hba-google-fonts'], HBA_VERSION );

    // Customizer dynamic CSS
    wp_add_inline_style( 'hba-main', hba_get_customizer_css() );

    // Main JS
    wp_enqueue_script( 'hba-main', HBA_URI . '/assets/js/main.js', [], HBA_VERSION, true );
    wp_localize_script( 'hba-main', 'hbaData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' )
    ] );
}
add_action( 'wp_enqueue_scripts', 'hba_enqueue_assets' );

/* ============================================================
   3. LIVE SEARCH AJAX HANDLER
   ============================================================ */
add_action( 'wp_ajax_hba_live_search', 'hba_live_search_handler' );
add_action( 'wp_ajax_nopriv_hba_live_search', 'hba_live_search_handler' );
function hba_live_search_handler() {
    $term = isset($_POST['query']) ? sanitize_text_field( $_POST['query'] ) : '';
    if ( empty( $term ) ) wp_die();

    $q = new WP_Query([
        's'              => $term,
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 5
    ]);

    if ( $q->have_posts() ) {
        while ( $q->have_posts() ) { 
            $q->the_post();
            $thumb = get_the_post_thumbnail( get_the_ID(), 'thumbnail' ) ?: '<img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=100&q=80" alt="Placeholder" style="width:100%;height:100%;object-fit:cover;">';
            echo '<a href="' . esc_url( get_permalink() ) . '" class="ls-item">';
            echo '<div class="ls-thumb">' . $thumb . '</div>';
            echo '<div class="ls-text"><h4 style="margin:0;font-size:.85rem;">' . esc_html( get_the_title() ) . '</h4></div>';
            echo '</a>';
        }
    } else {
        echo '<div class="ls-empty" style="padding:1rem;color:var(--mid);text-align:center;">' . esc_html__('No articles found.', 'healthbeyondage') . '</div>';
    }
    wp_die();
}

/* ============================================================
   3. DYNAMIC CUSTOMIZER CSS OUTPUT
   ============================================================ */
function hba_get_customizer_css() {
    $primary   = get_theme_mod( 'hba_primary_color',   '#1A7A3C' );
    $secondary = get_theme_mod( 'hba_secondary_color', '#22963F' );
    $bg        = get_theme_mod( 'hba_body_bg',         '#F5F8F6' );
    $text      = get_theme_mod( 'hba_text_color',      '#111F16' );
    $link      = get_theme_mod( 'hba_link_color',      '#1A7A3C' );
    $link_hov  = get_theme_mod( 'hba_link_hover_color','#22963F' );
    $btn_color = get_theme_mod( 'hba_button_color',    '#22963F' );
    $btn_text  = get_theme_mod( 'hba_button_text',     '#ffffff' );
    $btn_h_bg  = get_theme_mod( 'hba_button_hov_bg',   '#1B6B3A' );
    $btn_h_txt = get_theme_mod( 'hba_button_hov_text', '#ffffff' );
    $nav_col   = get_theme_mod( 'hba_nav_color',       '#4a5568' );
    $nav_h_col = get_theme_mod( 'hba_nav_hov_color',   '#1A7A3C' );
    $head_bg   = get_theme_mod( 'hba_header_bg',       '#ffffff' );
    $foot_bg   = get_theme_mod( 'hba_footer_bg',       '#111F16' );
    $body_font = get_theme_mod( 'hba_body_font',       "'DM Sans', system-ui, sans-serif" );
    $head_font = get_theme_mod( 'hba_heading_font',    "'Merriweather', Georgia, serif" );

    $base_font = get_theme_mod( 'hba_base_font_size', 15 );
    $h1_size   = get_theme_mod( 'hba_h1_size', 2.5 );
    $h2_size   = get_theme_mod( 'hba_h2_size', 2.0 );
    $h3_size   = get_theme_mod( 'hba_h3_size', 1.5 );
    $h4_size   = get_theme_mod( 'hba_h4_size', 1.25 );
    $h5_size   = get_theme_mod( 'hba_h5_size', 1.1 );
    $h6_size   = get_theme_mod( 'hba_h6_size', 1.0 );
    $line_height = get_theme_mod( 'hba_body_line_height', 1.7 );
    $p_margin  = get_theme_mod( 'hba_p_margin_bottom', 1.5 );
    
    $max_width = get_theme_mod( 'hba_max_width', 1220 );
    $sec_pad   = get_theme_mod( 'hba_section_padding', 3.0 );
    $sec_mar   = get_theme_mod( 'hba_section_margin', 0 );
    $card_pad  = get_theme_mod( 'hba_card_padding', 1.5 );

    $br_rad    = get_theme_mod( 'hba_border_radius', 12 );
    $btn_rad   = get_theme_mod( 'hba_btn_border_radius', 8 );
    $img_rad   = get_theme_mod( 'hba_img_border_radius', 12 );
    $br_thick  = get_theme_mod( 'hba_border_thickness', 1 );

    $sp_title_size   = get_theme_mod( 'hba_sp_title_size', 2.2 );
    $sp_content_size = get_theme_mod( 'hba_sp_content_size', 0.92 );
    $sp_kt_bg        = get_theme_mod( 'hba_sp_kt_bg', '#1B6B3A' );
    $sp_callout_border = get_theme_mod( 'hba_sp_callout_border', '#27903F' );
    
    $card_title_size = get_theme_mod( 'hba_card_title_size', 1.3 );

    $hero_font_mod = get_theme_mod( 'hba_hero_font', '' );
    $hero_font     = !empty($hero_font_mod) ? $hero_font_mod : $head_font;
    $hero_weight   = get_theme_mod( 'hba_hero_title_weight', '800' );
    $hero_align    = get_theme_mod( 'hba_hero_text_align', 'center' );
    $hero_padding  = get_theme_mod( 'hba_hero_padding', 2.0 );
    $hero_overlay  = get_theme_mod( 'hba_hero_overlay', 0 );
    $hero_shadow   = get_theme_mod( 'hba_hero_text_shadow', false );
    $logo_width    = get_theme_mod( 'hba_logo_width', 200 );
    $nav_fs        = get_theme_mod( 'hba_nav_font_size', 1.0 );
    
    $hero_flex_align = 'center';
    if ($hero_align === 'left') $hero_flex_align = 'flex-start';
    if ($hero_align === 'right') $hero_flex_align = 'flex-end';

    $css = "
    :root {
        --g1: {$primary};
        --g2: {$secondary};
        --off: {$bg};
        --text: {$text};
        --link: {$link};
        --link-hov: {$link_hov};
        --btn-bg: {$btn_color};
        --btn-txt: {$btn_text};
        --btn-h-bg: {$btn_h_bg};
        --btn-h-txt: {$btn_h_txt};
        --nav-col: {$nav_col};
        --nav-h-col: {$nav_h_col};
        --head-bg: {$head_bg};
        --foot-bg: {$foot_bg};
        --sans: {$body_font};
        --serif: {$head_font};
        --hero-font: {$hero_font};
        --base-font: {$base_font}px;
        --h1-size: {$h1_size}rem;
        --h2-size: {$h2_size}rem;
        --h3-size: {$h3_size}rem;
        --h4-size: {$h4_size}rem;
        --h5-size: {$h5_size}rem;
        --h6-size: {$h6_size}rem;
        --sec-pad: {$sec_pad}rem;
        --sec-mar: {$sec_mar}rem;
        --card-pad: {$card_pad}rem;
        --br-rad: {$br_rad}px;
        --btn-rad: {$btn_rad}px;
        --img-rad: {$img_rad}px;
        --br-thick: {$br_thick}px;
        --max-width: {$max_width}px;
    }
    body { font-size: var(--base-font) !important; line-height: {$line_height} !important; color: var(--text) !important; background-color: var(--off) !important; }
    a { color: var(--link); }
    a:hover { color: var(--link-hov); }
    
    .site-header { background-color: var(--head-bg) !important; }
    .site-footer { background-color: var(--foot-bg) !important; }

    p { margin-bottom: {$p_margin}rem !important; }
    h1 { font-size: var(--h1-size) !important; }
    h2 { font-size: var(--h2-size) !important; }
    h3 { font-size: var(--h3-size) !important; }
    h4 { font-size: var(--h4-size) !important; }
    h5 { font-size: var(--h5-size) !important; }
    h6 { font-size: var(--h6-size) !important; }
    
    .section, .explore-topics, .expert-strip, .values-section, .mission-strip, .team-hero, .about-hero { 
        padding-top: var(--sec-pad) !important; 
        padding-bottom: var(--sec-pad) !important; 
        margin-top: var(--sec-mar) !important; 
        margin-bottom: var(--sec-mar) !important;
    }
    .container, .nav-wrap, .home-hero-wrap, .footer-wrap { max-width: var(--max-width) !important; }
    
    .art-card, .hfeat-main, .hfeat-side-card, .trend-main, .trend-item, .featured-longread, .sidebar-card, .home-medrev-card, .pillar, .value-card { 
        border-radius: var(--br-rad) !important; 
        border-width: var(--br-thick) !important;
    }
    .art-card { padding: var(--card-pad) !important; }
    .art-body h3 { font-size: {$card_title_size}rem !important; }
    .btn, .btn-ghost, .btn-green { border-radius: var(--btn-rad) !important; background-color: var(--btn-bg) !important; color: var(--btn-txt) !important; border-color: var(--btn-bg) !important; }
    .btn:hover, .btn-ghost:hover, .btn-green:hover { background-color: var(--btn-h-bg) !important; color: var(--btn-h-txt) !important; border-color: var(--btn-h-bg) !important; }
    img { border-radius: var(--img-rad); }
    
    .site-logo img { max-width: {$logo_width}px !important; }
    .nav-menu a { font-size: {$nav_fs}rem !important; color: var(--nav-col) !important; }
    .nav-menu a:hover { color: var(--nav-h-col) !important; }

    .home-hero { padding-top: {$hero_padding}rem !important; padding-bottom: {$hero_padding}rem !important; position: relative; z-index: 1; }
    .home-hero::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,{$hero_overlay}); z-index: -1; pointer-events: none; }
    .home-hero-left { text-align: {$hero_align} !important; align-items: {$hero_flex_align} !important; }
    .home-hero-left h1 { font-family: var(--hero-font) !important; font-weight: {$hero_weight} !important; text-align: {$hero_align} !important; " . ($hero_shadow ? "text-shadow: 0px 4px 10px rgba(0,0,0,0.5);" : "") . " }
    .home-hero-left p { text-align: {$hero_align} !important; " . ($hero_shadow ? "text-shadow: 0px 2px 6px rgba(0,0,0,0.5);" : "") . " }
    
    .single-post .article-main h1 { font-size: {$sp_title_size}rem !important; }
    .single-post .article-body { font-size: {$sp_content_size}rem !important; }
    .single-post .key-takeaways { background: {$sp_kt_bg} !important; }
    .single-post .callout { border-left-color: {$sp_callout_border} !important; }
    ";

    if ( get_theme_mod( 'hba_sticky_header', false ) ) {
        $css .= "
        .site-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        ";
    }

    return $css;
}

// Custom Excerpt Length
function hba_custom_excerpt_length( $length ) {
    return get_theme_mod( 'hba_excerpt_length', 20 );
}
add_filter( 'excerpt_length', 'hba_custom_excerpt_length', 999 );

// Custom Read More Text
function hba_custom_excerpt_more( $more ) {
    $text = get_theme_mod( 'hba_read_more_text', 'Read more' );
    return '... <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . esc_html( $text ) . '</a>';
}
add_filter( 'excerpt_more', 'hba_custom_excerpt_more' );

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
 * Get author avatar image HTML (Checks hba_team first, then get_avatar)
 */
function hba_get_author_avatar( $author_id, $size = 32, $size_array = [32, 32] ) {
    $author_name = get_the_author_meta( 'display_name', $author_id );
    
    // First check if they have a custom post type profile in hba_team
    $args = array(
        'post_type'      => 'hba_team',
        's'              => $author_name,
        'posts_per_page' => 1,
        'post_status'    => 'publish'
    );
    $team_query = new WP_Query($args);

    if ( $team_query->have_posts() ) {
        $team_post = $team_query->posts[0];
        $thumb_id = get_post_thumbnail_id( $team_post->ID );
        if ( $thumb_id ) {
            return wp_get_attachment_image( $thumb_id, $size_array );
        }
    }
    
    // Fallback to get_avatar
    return get_avatar( $author_id, $size );
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
            <div class="nl-chip"><?php echo esc_html( get_theme_mod('hba_nl_chip', $chip) ); ?></div>
            <h2><?php echo wp_kses_post( $t ); ?></h2>
            <p><?php echo wp_kses_post( $d ); ?></p>
            <form class="nl-form" method="post" action="#">
                <input type="email" name="email" placeholder="<?php echo esc_attr( get_theme_mod('hba_nl_placeholder', 'your@email.com') ); ?>" required />
                <button type="submit"><?php echo esc_html( get_theme_mod('hba_nl_btn', 'Subscribe Free') ); ?></button>
            </form>
            <div class="nl-perks">
                <div class="nl-perk"><div class="pdot"></div><?php echo esc_html( get_theme_mod('hba_nl_perk_1', 'Weekly health insights') ); ?></div>
                <div class="nl-perk"><div class="pdot"></div><?php echo esc_html( get_theme_mod('hba_nl_perk_2', 'Evidence-based research') ); ?></div>
                <div class="nl-perk"><div class="pdot"></div><?php echo esc_html( get_theme_mod('hba_nl_perk_3', 'Unsubscribe anytime') ); ?></div>
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
    // Rely on global post data so plugins like Co-Authors or Guest Authors work
    $author_id = get_the_author_meta('ID');
    $author    = get_the_author();
    
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
                    <div class="av"><?php echo hba_get_author_avatar( $author_id, 32, [32, 32] ); ?></div>
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
require get_template_directory() . '/inc/team-members.php';
require get_template_directory() . '/inc/health-topics.php';
require get_template_directory() . '/inc/author-avatar.php';
