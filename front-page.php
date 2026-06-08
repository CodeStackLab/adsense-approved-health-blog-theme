<?php
/**
 * Front Page Template — Health Beyond Age
 * Exact HTML-to-WordPress conversion of healthbeyondage_updated_v3.html
 */
get_header();

$hero_image   = get_theme_mod( 'hba_hero_image', 'http://srv1740311.hstgr.cloud/wp-content/uploads/2026/06/Image-1-d2fab5ef.png' );
$hero_eyebrow = get_theme_mod( 'hba_hero_eyebrow', 'TRUSTED HEALTH GUIDANCE' );
$hero_title   = get_theme_mod( 'hba_hero_title', 'Trusted Health Guidance For A Better Life' );
$hero_sub     = get_theme_mod( 'hba_hero_subtitle', 'Practical, Evidence-Based Wellness Advice Designed To Help You Live Healthier, Feel Stronger, And Age Confidently Every Day.' );
$btn1_text    = get_theme_mod( 'hba_hero_btn1_text', 'Explore Health Topics' );
$btn1_url     = get_theme_mod( 'hba_hero_btn1_url', get_permalink( get_page_by_path('blog') ) ?: home_url('/blog') );
$btn2_text    = get_theme_mod( 'hba_hero_btn2_text', 'Latest Articles' );
$btn2_url     = get_theme_mod( 'hba_hero_btn2_url', home_url('/blog') );
$trust1       = get_theme_mod( 'hba_hero_trust1', 'Medically Reviewed Content' );
$trust2       = get_theme_mod( 'hba_hero_trust2', 'Evidence-Based Research' );
$trust3       = get_theme_mod( 'hba_hero_trust3', 'Regularly Updated' );
?>

<!-- ===== HOMEPAGE HERO ===== -->
<section class="home-hero">
    <div class="home-hero-wrap">
        <div class="home-hero-left">
            <div class="home-eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></div>
            <h1><?php echo esc_html( $hero_title ); ?></h1>
            <p><?php echo esc_html( $hero_sub ); ?></p>
            <div class="home-ctas">
                <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-primary"><?php echo esc_html( $btn1_text ); ?></a>
                <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn-secondary"><?php echo esc_html( $btn2_text ); ?></a>
            </div>
            <div class="home-trust-row">
                <div class="htrust-item">
                    <div class="htrust-ico">
                        <svg viewBox="0 0 24 24"><path d="M12 2l2.4 4.8 5.3.8-3.8 3.7.9 5.3L12 14l-4.8 2.6.9-5.3L4.3 7.6l5.3-.8z"/></svg>
                    </div>
                    <span class="htrust-lbl"><?php echo esc_html( $trust1 ); ?></span>
                </div>
                <div class="htrust-item">
                    <div class="htrust-ico">
                        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 12h4m0 0V8m0 4h4"/></svg>
                    </div>
                    <span class="htrust-lbl"><?php echo esc_html( $trust2 ); ?></span>
                </div>
                <div class="htrust-item">
                    <div class="htrust-ico">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                    </div>
                    <span class="htrust-lbl"><?php echo esc_html( $trust3 ); ?></span>
                </div>
            </div>
        </div>
        <div class="home-hero-right fade-up" style="display:flex;align-items:center;justify-content:center;padding:2rem;background:#fff;position:relative">
            <div style="position:relative;width:100%;max-width:520px;margin:0 auto;">
                <?php if ( $hero_image ) : ?>
                    <img class="hero-photo" src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'Health Beyond Age', 'healthbeyondage' ); ?>" style="width:100%;height:460px;object-fit:cover;object-position:center top;border-radius:24px;display:block;box-shadow:0 12px 40px rgba(13,107,82,0.15)" />
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
    <div class="section">
        <div class="sec-hd fade-up">
            <h2><?php esc_html_e( 'Featured', 'healthbeyondage' ); ?> <span><?php esc_html_e( 'Articles', 'healthbeyondage' ); ?></span></h2>
            <a href="<?php echo esc_url( home_url('/trending') ); ?>" class="sec-hd-link"><?php esc_html_e( 'View all trending →', 'healthbeyondage' ); ?></a>
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
            <h2><?php esc_html_e( 'Explore by Health Topic', 'healthbeyondage' ); ?></h2>
            <a href="<?php echo esc_url( home_url('/blog') ); ?>"><?php esc_html_e( 'View all topics →', 'healthbeyondage' ); ?></a>
        </div>
        <div class="topic-carousel-wrap">
            <button class="carousel-btn prev" aria-label="Previous">&#8592;</button>
            <div class="topic-carousel" id="topicCarousel">
                <?php
                $ordered_topics = [
                    ['slug' => 'anxiety-depression', 'name' => 'Anxiety & Depression', 'bg' => '#5A4A7A'],
                    ['slug' => 'digestive-health', 'name' => 'Digestive Health', 'bg' => '#3A7A5A'],
                    ['slug' => 'heart-health', 'name' => 'Heart Health', 'bg' => '#7A1A2A'],
                    ['slug' => 'menopause', 'name' => 'Menopause', 'bg' => '#6A3A7A'],
                    ['slug' => 'type-2-diabetes', 'name' => 'Type 2 Diabetes', 'bg' => '#1A5A7A'],
                    ['slug' => 'weight-management', 'name' => 'Weight Management', 'bg' => '#4A6A2A'],
                    ['slug' => 'sleep-health', 'name' => 'Sleep Health', 'bg' => '#2A2A6A'],
                    ['slug' => 'nutrition', 'name' => 'Nutrition', 'bg' => '#5A7A1A'],
                    ['slug' => 'skin-care', 'name' => 'Skin Care', 'bg' => '#7A4A2A'],
                    ['slug' => 'fitness', 'name' => 'Fitness & Exercise', 'bg' => '#1A7A3C'],
                    ['slug' => 'mental-wellness', 'name' => 'Mental Wellness', 'bg' => '#4A6A8A'],
                    ['slug' => 'preventive-health', 'name' => 'Preventive Health', 'bg' => '#6A5A1A'],
                ];

                foreach ( $ordered_topics as $topic ) {
                    $cat = get_term_by( 'slug', $topic['slug'], 'category' );
                    if ( $cat ) {
                        $cat_img = get_term_meta( $cat->term_id, 'hba_cat_image', true ) ?: 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=400&q=80';
                        ?>
                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="topic-card">
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
            <button class="carousel-btn next" aria-label="Next">&#8594;</button>
        </div>
        <div class="carousel-dots">
            <button class="carousel-dot active"></button>
            <button class="carousel-dot"></button>
            <button class="carousel-dot"></button>
        </div>
    </div>
</section>

<!-- ===== LATEST ARTICLES ===== -->
<div style="background:var(--off)">
    <div class="section">
        <div class="sec-hd">
            <h2><?php esc_html_e( 'Latest', 'healthbeyondage' ); ?> <span><?php esc_html_e( 'Articles', 'healthbeyondage' ); ?></span></h2>
            <a href="<?php echo esc_url( home_url('/blog') ); ?>" class="sec-hd-link"><?php esc_html_e( 'View all articles →', 'healthbeyondage' ); ?></a>
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
            <a href="<?php echo esc_url( home_url('/team') ); ?>" class="btn-green"><?php esc_html_e( 'Meet Our Team', 'healthbeyondage' ); ?></a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
