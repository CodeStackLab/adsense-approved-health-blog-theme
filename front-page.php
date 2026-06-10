<?php
/**
 * Front Page Template — Health Beyond Age
 * Exact HTML-to-WordPress conversion of healthbeyondage_updated_v3.html
 */
get_header();

$hero_image   = get_theme_mod( 'hba_hero_image', 'http://srv1740311.hstgr.cloud/wp-content/uploads/2026/06/Image-1-d2fab5ef.png' );
$hero_eyebrow = get_theme_mod( 'hba_hero_eyebrow', 'Evidence-Based Wellness' );
$hero_title   = get_theme_mod( 'hba_hero_title', 'Trusted Health Guidance For A Better Life' );
$hero_sub     = get_theme_mod( 'hba_hero_subtitle', 'Practical, Evidence-Based Wellness Advice Designed To Help You Live Healthier, Feel Stronger, And Age Confidently Every Day.' );
$btn1_text    = get_theme_mod( 'hba_hero_btn1_text', 'Explore Health Topics' );
$btn1_url     = get_theme_mod( 'hba_hero_btn1_url', home_url('/topics') );
$btn2_text    = get_theme_mod( 'hba_hero_btn2_text', 'Latest Articles' );
$btn2_url     = get_theme_mod( 'hba_hero_btn2_url', home_url('/blog') );
$trust1       = get_theme_mod( 'hba_hero_trust1', 'Medically Reviewed Content' );
$trust2       = get_theme_mod( 'hba_hero_trust2', 'Evidence-Based Research' );
$trust3       = get_theme_mod( 'hba_hero_trust3', 'Regularly Updated' );

// Advanced styling from Customizer
$h_bg = get_theme_mod('hba_hero_bg', '#ffffff');
$h_tc = get_theme_mod('hba_hero_title_color', '#111F16');
$h_sc = get_theme_mod('hba_hero_sub_color', '#4a5568');
$f_bg = get_theme_mod('hba_feat_bg', '#F5F8F6');
$n_bg = get_theme_mod('hba_nl_bg', '#1A7A3C');
$h_ts = get_theme_mod('hba_hero_title_size', 2.4);
$h_ss = get_theme_mod('hba_hero_sub_size', 1.15);
?>

<style>
.home-hero { background: <?php echo esc_html($h_bg); ?> !important; }
.home-hero h1 { color: <?php echo esc_html($h_tc); ?> !important; font-size: <?php echo esc_html($h_ts); ?>rem !important; }
.home-hero p.home-hero-subtitle { color: <?php echo esc_html($h_sc); ?> !important; font-size: <?php echo esc_html($h_ss); ?>rem !important; }
.section.bg-pale { background: <?php echo esc_html($f_bg); ?> !important; }
.nl-section { background: linear-gradient(155deg, <?php echo esc_html($n_bg); ?> 0%, #074030 100%) !important; }
@media (max-width: 768px) {
    .home-hero h1 { font-size: clamp(2rem, 8vw, <?php echo esc_html($h_ts); ?>rem) !important; line-height: 1.2 !important; }
    .home-hero p.home-hero-subtitle { font-size: 1.05rem !important; }
}
</style>

<!-- ===== HOMEPAGE HERO ===== -->
<section class="home-hero">
    <div class="home-hero-wrap">
        <div class="home-hero-left">
            <div class="home-eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></div>
            <h1><?php echo esc_html( $hero_title ); ?></h1>
            <p class="home-hero-subtitle"><?php echo esc_html( $hero_sub ); ?></p>
            <div class="home-ctas">
                <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-primary"><?php echo esc_html( $btn1_text ); ?></a>
                <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn-secondary"><?php echo esc_html( $btn2_text ); ?></a>
            </div>
            <div class="home-trust-row">
                <div class="htrust-item">
                    <div class="htrust-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>
                    </div>
                    <span class="htrust-lbl"><?php echo esc_html( $trust1 ); ?></span>
                </div>
                <div class="htrust-item">
                    <div class="htrust-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/><path d="M9 14h6"/><path d="M9 10h6"/></svg>
                    </div>
                    <span class="htrust-lbl"><?php echo esc_html( $trust2 ); ?></span>
                </div>
                <div class="htrust-item">
                    <div class="htrust-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <span class="htrust-lbl"><?php echo esc_html( $trust3 ); ?></span>
                </div>
            </div>
        </div>
        <div class="home-hero-right fade-up" style="display:flex;align-items:center;justify-content:center;position:relative">
            <div style="position:relative;width:100%;max-width:580px;margin:0 auto;">
                <?php if ( $hero_image ) : ?>
                    <img class="hero-photo" src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'Health Beyond Age', 'healthbeyondage' ); ?>" style="width:100%;height:420px;object-fit:cover;object-position:center top;border-radius:16px;display:block;box-shadow:0 12px 40px rgba(13,107,82,0.15)" />
                <?php endif; ?>
                <div class="home-medrev-card">
                    <div class="mrc-avatar">
                        <img src="<?php echo esc_url( get_theme_mod( 'hba_expert_photo', 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=100&q=80' ) ); ?>" alt="Medical Reviewer"/>
                    </div>
                    <div class="mrc-text">
                        <h4><?php esc_html_e( 'Medically Reviewed', 'healthbeyondage' ); ?></h4>
                        <p><?php esc_html_e( 'All Health Content Is Reviewed By Qualified Medical Professionals.', 'healthbeyondage' ); ?></p>
                        <a href="<?php echo esc_url( home_url('/team') ); ?>"><?php esc_html_e( 'Learn Our Process →', 'healthbeyondage' ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FEATURED ARTICLES ===== -->
<div style="background:var(--off)">
    <div class="section bg-pale">
        <div class="sec-hd feat-hd fade-up">
            <h2><?php echo esc_html( get_theme_mod('hba_feat_title', 'Featured Articles') ); ?></h2>
            <a href="<?php echo esc_url( get_theme_mod('hba_feat_link_url', home_url('/trending')) ); ?>" class="sec-hd-link"><?php echo esc_html( get_theme_mod('hba_feat_link_text', 'View all trending →') ); ?></a>
        </div>
        <div class="hfeat-grid">
            <!-- Main featured card -->
            <?php
            $main_feat = new WP_Query([
                'posts_per_page' => 1,
                'meta_key'       => '_thumbnail_id',
                'post_status'    => 'publish',
                'orderby'        => 'date',
            ]);
            if ( $main_feat->have_posts() ) {
                $main_feat->the_post();
                $pid = get_the_ID();
                $cats = get_the_category();
                $cat_name = !empty($cats) ? $cats[0]->name : 'Featured';
                $read_time = hba_reading_time($pid);
                ?>
                <div class="hfeat-main fade-up" onclick="window.location.href='<?php the_permalink(); ?>'">
                    <div class="hfeat-main-thumb">
                        <img src="<?php echo get_the_post_thumbnail_url($pid, 'large') ?: 'https://images.unsplash.com/photo-1584467541268-b040f83be3fd?w=700&q=80'; ?>" alt="<?php the_title_attribute(); ?>"/>
                        <div class="hfeat-trending"><?php esc_html_e('Trending', 'healthbeyondage'); ?></div>
                    </div>
                    <div class="hfeat-main-body">
                        <div class="hfeat-cat"><?php echo esc_html($cat_name); ?></div>
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <div class="hfeat-card-meta">
                            <span><?php echo get_the_date('F j, Y'); ?></span><span class="hfeat-dot"></span><span><?php echo esc_html($read_time); ?></span>
                        </div>
                        <div class="medrev-badge">✓ <?php esc_html_e('Medically Reviewed', 'healthbeyondage'); ?></div>
                    </div>
                </div>
                <?php
                wp_reset_postdata();
            }
            ?>
            <!-- Side stack -->
            <div class="hfeat-side-stack fade-up">
                <?php
                $side_feat = new WP_Query([
                    'posts_per_page' => 3,
                    'offset'         => 1,
                    'post_status'    => 'publish',
                ]);
                $t_classes = ['', 't2', 't3'];
                $i = 0;
                if ( $side_feat->have_posts() ) {
                    while ( $side_feat->have_posts() ) {
                        $side_feat->the_post();
                        $pid = get_the_ID();
                        $cats = get_the_category();
                        $cat_name = !empty($cats) ? $cats[0]->name : 'Trending';
                        $read_time = hba_reading_time($pid);
                        $t_class = $t_classes[$i % 3];
                        $img = get_the_post_thumbnail_url($pid, 'medium') ?: 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=200&q=75';
                        ?>
                        <div class="hfeat-side-card" onclick="window.location.href='<?php the_permalink(); ?>'">
                            <div class="hfeat-side-thumb <?php echo $t_class; ?>">
                                <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>"/>
                            </div>
                            <div class="hfeat-side-body">
                                <div class="hfeat-side-cat"><?php echo esc_html($cat_name); ?></div>
                                <h4><?php the_title(); ?></h4>
                                <div class="hfeat-side-meta"><?php echo get_the_date('M Y'); ?> · <?php echo esc_html($read_time); ?></div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- ===== EXPLORE BY HEALTH TOPIC ===== -->
<section class="explore-topics">
    <div class="explore-topics-inner">
        <div class="explore-topics-hd">
            <h2><?php echo esc_html( get_theme_mod('hba_topics_title', 'Explore by Health Topic') ); ?></h2>
            <a href="<?php echo esc_url( get_theme_mod('hba_topics_link_url', home_url('/topics')) ); ?>"><?php echo esc_html( get_theme_mod('hba_topics_link_text', 'View all topics →') ); ?></a>
        </div>
        <div class="topic-carousel-wrap">
            <div class="topic-carousel" id="topicCarousel">
                <?php
                $ordered_topics = [
                    ['slug' => 'anxiety-depression', 'name' => 'Anxiety & Depression', 'bg' => '#18868A'],
                    ['slug' => 'digestive-health', 'name' => 'Digestive Health', 'bg' => '#0A7A7E'],
                    ['slug' => 'heart-health', 'name' => 'Heart Health', 'bg' => '#128C8C'],
                    ['slug' => 'menopause', 'name' => 'Menopause', 'bg' => '#C4DFE6'],
                    ['slug' => 'type-2-diabetes', 'name' => 'Type 2 Diabetes', 'bg' => '#E8F5E9'],
                    ['slug' => 'weight-management', 'name' => 'Weight Management', 'bg' => '#18868A'],
                    ['slug' => 'sleep-health', 'name' => 'Sleep Health', 'bg' => '#0A7A7E'],
                    ['slug' => 'nutrition', 'name' => 'Nutrition', 'bg' => '#C4DFE6'],
                    ['slug' => 'skin-care', 'name' => 'Skin Care', 'bg' => '#128C8C'],
                    ['slug' => 'fitness', 'name' => 'Fitness & Exercise', 'bg' => '#E8F5E9'],
                    ['slug' => 'mental-wellness', 'name' => 'Mental Wellness', 'bg' => '#18868A'],
                    ['slug' => 'preventive-health', 'name' => 'Preventive Health', 'bg' => '#0A7A7E'],
                ];

                foreach ( $ordered_topics as $topic ) {
                    // Try category first
                    $term = get_term_by( 'slug', $topic['slug'], 'category' );
                    // If category is empty or doesn't exist, try tag
                    if ( ! $term || $term->count == 0 ) {
                        $tag = get_term_by( 'slug', $topic['slug'], 'post_tag' );
                        if ( $tag && $tag->count > 0 ) {
                            $term = $tag;
                        }
                    }

                    if ( $term ) {
                        $cat_img = get_term_meta( $term->term_id, 'hba_cat_image', true ) ?: 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=400&q=80';
                        ?>
                        <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="topic-card">
                            <div class="topic-card-img" style="background:<?php echo esc_attr( $topic['bg'] ); ?>">
                                <img src="<?php echo esc_url( $cat_img ); ?>" alt="<?php echo esc_attr( $topic['name'] ); ?>" loading="lazy" />
                            </div>
                            <div class="topic-card-name"><?php echo esc_html( $topic['name'] ); ?></div>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="carousel-bottom-ctrls">
            <div class="carousel-dots">
                <button class="carousel-dot active"></button>
                <button class="carousel-dot"></button>
                <button class="carousel-dot"></button>
            </div>
            <div class="carousel-arrows">
                <button class="carousel-btn prev" aria-label="Previous">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
                </button>
                <button class="carousel-btn next" aria-label="Next">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- ===== LATEST ARTICLES ===== -->
<div style="background:var(--off)">
    <div class="section">
        <div class="sec-hd latest-hd">
            <h2><?php echo esc_html( get_theme_mod('hba_latest_title', 'Latest Articles') ); ?></h2>
            <a href="<?php echo esc_url( get_theme_mod('hba_latest_link_url', home_url('/blog')) ); ?>" class="sec-hd-link"><?php echo esc_html( get_theme_mod('hba_latest_link_text', 'View all articles →') ); ?></a>
        </div>
        <div class="art-grid">
            <?php
            $latest = new WP_Query([
                'posts_per_page' => (int) get_theme_mod( 'hba_latest_articles_count', 6 ),
                'post_status'    => 'publish',
            ]);
            if ( $latest->have_posts() ) {
                while ( $latest->have_posts() ) {
                    $latest->the_post();
                    hba_article_card( get_the_ID() );
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</div>

<!-- ===== EXPERT QUOTE STRIP ===== -->
<div class="expert-strip">
    <div class="expert-strip-inner">
        <div style="text-align:center;">
            <?php
            $expert_photo = get_theme_mod( 'hba_expert_photo', 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=100&q=80' );
            $expert_name  = get_theme_mod( 'hba_expert_name', 'Dr. Sarah Matheson' );
            $expert_role  = get_theme_mod( 'hba_expert_role', 'Lead Medical Reviewer' );
            ?>
            <div class="exp-photo-wrap">
                <img src="<?php echo esc_url( $expert_photo ); ?>" alt="<?php echo esc_attr( $expert_name ); ?>" />
            </div>
            <div style="font-size:.82rem;font-weight:600;color:var(--text);"><?php echo esc_html( $expert_name ); ?></div>
            <div style="font-size:.7rem;color:var(--muted);"><?php echo esc_html( $expert_role ); ?></div>
        </div>
        <blockquote class="exp-quote">
            <?php echo wp_kses_post( get_theme_mod( 'hba_expert_quote', '"Good health isn\'t about perfection — it\'s about <strong>consistent, informed choices.</strong> Every article on this site is reviewed to give you the knowledge to make those choices with confidence."' ) ); ?>
        </blockquote>
        <div>
            <a href="<?php echo esc_url( get_theme_mod('hba_expert_btn_url', home_url('/team')) ); ?>" class="btn-green"><?php echo esc_html( get_theme_mod('hba_expert_btn_text', 'Meet Our Team') ); ?></a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
