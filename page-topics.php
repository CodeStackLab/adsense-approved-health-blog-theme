<?php
/**
 * Template Name: Topics Directory
 * Description: A page displaying all health topics in a directory grid.
 */

get_header();
?>

<div class="page-hdr" style="background:#fff; padding:3rem 1.5rem; text-align:center; border-bottom:1px solid var(--border);">
    <h1 style="font-family:var(--sans); font-size:2.5rem; color:var(--text); font-weight:700; margin-bottom:1rem;"><?php esc_html_e('Explore by Health Topic', 'healthbeyondage'); ?></h1>
    <p style="color:var(--mid); font-size:1.1rem; max-width:600px; margin:0 auto;"><?php esc_html_e('Browse our comprehensive directory of health and wellness topics.', 'healthbeyondage'); ?></p>
</div>

<?php hba_breadcrumb(); ?>

<div class="section" style="background:var(--off); min-height:50vh;">
    <div class="topics-directory-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(250px, 1fr)); gap:1.5rem; max-width:1180px; margin:0 auto;">
        <?php
        $cats = get_terms(['taxonomy' => ['category', 'post_tag'], 'hide_empty' => true]);
        $colors = ['bg-green','bg-gold','bg-plum','bg-blue','bg-rust'];
        
        foreach ( $cats as $idx => $cat ) {
            if ( $cat->name === 'Uncategorized' ) continue;
            
            $cat_img = get_term_meta( $cat->term_id, 'hba_cat_image', true ) ?: 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=400&q=80';
            $bg_color = ['#18868A','#0A7A7E','#128C8C','#C4DFE6','#E8F5E9'][$idx % 5];
            ?>
            <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="topic-dir-card" style="display:flex; align-items:center; gap:1rem; background:#fff; padding:1rem; border-radius:12px; border:1px solid var(--border); transition:all 0.2s; text-decoration:none; color:var(--text);">
                <div class="tdc-img" style="width:60px; height:60px; border-radius:10px; background:<?php echo esc_attr($bg_color); ?>; overflow:hidden; flex-shrink:0;">
                    <img src="<?php echo esc_url($cat_img); ?>" alt="<?php echo esc_attr($cat->name); ?>" style="width:100%; height:100%; object-fit:cover;" loading="lazy" />
                </div>
                <div class="tdc-info">
                    <h3 style="font-family:var(--sans); font-size:1rem; font-weight:700; margin-bottom:0.25rem;"><?php echo esc_html($cat->name); ?></h3>
                    <span style="font-size:0.75rem; color:var(--muted);"><?php echo esc_html($cat->count); ?> <?php esc_html_e('Articles', 'healthbeyondage'); ?></span>
                </div>
            </a>
            <?php
        }
        ?>
    </div>
</div>

<style>
.topic-dir-card:hover { transform:translateY(-3px); box-shadow:var(--shadow-md); border-color:var(--g1); }
</style>

<?php get_footer(); ?>
