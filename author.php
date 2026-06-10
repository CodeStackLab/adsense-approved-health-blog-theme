<?php
/**
 * Author Archive Template — Health Beyond Age
 */
get_header();

$author = get_queried_object();
$author_id = $author->ID;
$author_name = $author->display_name;
$author_bio = get_the_author_meta( 'description', $author_id );
$author_role = get_the_author_meta( 'hba_author_role', $author_id ) ?: 'Health & Wellness Author';

// Count posts
$post_count = count_user_posts( $author_id );
?>

<!-- PREMIUM AUTHOR HERO -->
<div class="author-hero-enhanced fade-up">
    <div class="author-hero-content">
        <div class="author-hero-avatar">
            <?php echo hba_get_author_avatar( $author_id, 240, [240, 240] ); ?>
        </div>
        <div class="author-hero-text">
            <span class="author-badge"><?php esc_html_e( 'Meet the Author', 'healthbeyondage' ); ?></span>
            <h1 class="author-name"><?php echo esc_html( $author_name ); ?></h1>
            <div class="author-role"><?php echo esc_html( $author_role ); ?></div>
            
            <?php if ( $author_bio ) : ?>
                <div class="author-bio">
                    <p><?php echo wp_kses_post( $author_bio ); ?></p>
                </div>
            <?php endif; ?>

            <div class="author-meta-footer">
                <div class="author-stats">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    <span><?php printf( esc_html__( '%d Published Articles', 'healthbeyondage' ), $post_count ); ?></span>
                </div>

                <?php
                // Social & Contact Links
                $user_url = get_the_author_meta('user_url', $author_id);
                $twitter = get_the_author_meta('twitter', $author_id);
                $facebook = get_the_author_meta('facebook', $author_id);
                $linkedin = get_the_author_meta('linkedin', $author_id);
                $instagram = get_the_author_meta('instagram', $author_id);

                if ( $user_url || $twitter || $facebook || $linkedin || $instagram ) :
                ?>
                <div class="author-social-links">
                    <?php if ( $user_url ) : ?><a href="<?php echo esc_url($user_url); ?>" target="_blank" title="Website">🌐</a><?php endif; ?>
                    <?php if ( $twitter ) : ?><a href="<?php echo esc_url($twitter); ?>" target="_blank" title="Twitter">𝕏</a><?php endif; ?>
                    <?php if ( $facebook ) : ?><a href="<?php echo esc_url($facebook); ?>" target="_blank" title="Facebook">f</a><?php endif; ?>
                    <?php if ( $linkedin ) : ?><a href="<?php echo esc_url($linkedin); ?>" target="_blank" title="LinkedIn">in</a><?php endif; ?>
                    <?php if ( $instagram ) : ?><a href="<?php echo esc_url($instagram); ?>" target="_blank" title="Instagram">📸</a><?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div class="section" style="background:var(--off); padding: 4rem 1.5rem;">
    <div style="max-width:1180px; margin:0 auto; display:grid; grid-template-columns: 2.5fr 1fr; gap: 3rem; align-items:start;" class="author-layout-grid">
        
        <div class="articles-main">
            <div class="sec-hd" style="margin-bottom:2rem; border-bottom:2px solid var(--border); padding-bottom:1rem;">
                <h2 style="font-size:1.8rem; font-family:var(--serif); margin:0; color:var(--text); font-weight:700;">
                    <?php printf( esc_html__( 'Articles by %s', 'healthbeyondage' ), $author_name ); ?>
                </h2>
            </div>

            <div class="art-list">
                <?php 
                $author_query = new WP_Query([
                    'author' => $author_id,
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => get_option('posts_per_page'),
                    'paged' => get_query_var('paged') ?: 1
                ]);
                if ( $author_query->have_posts() ) {
                    while ( $author_query->have_posts() ) { 
                        $author_query->the_post(); 
                        hba_article_list_item( get_the_ID() ); 
                    }
                    wp_reset_postdata();
                } else {
                    echo '<div style="padding:3rem; text-align:center; background:#fff; border-radius:12px; border:1px solid var(--border);"><p style="color:var(--mid); margin:0;">' . esc_html__('No articles found for this author.','healthbeyondage') . '</p></div>';
                } ?>
            </div>
            
            <div style="margin-top:3rem;">
                <?php 
                // Custom pagination for custom query
                $big = 999999999;
                $pages = paginate_links([
                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, get_query_var('paged') ),
                    'total'     => $author_query->max_num_pages,
                    'prev_text' => '←',
                    'next_text' => '→',
                ]);
                if ( $pages ) {
                    echo '<div class="load-more">' . $pages . '</div>';
                }
                ?>
            </div>
        </div>

        <aside class="articles-sidebar">
            <div class="sidebar-box" style="background:#fff; border-radius:16px; border:1px solid var(--border); padding:2rem; position:sticky; top:100px;">
                <h4 style="font-family:var(--sans); font-size:1.2rem; color:var(--text); margin-bottom:1.5rem; font-weight:700;">Explore Categories</h4>
                <?php
                $cats = get_categories(['hide_empty' => true]);
                foreach ( $cats as $c ) :
                ?>
                    <a href="<?php echo esc_url(get_category_link($c->term_id)); ?>" class="sidebar-cat-link" style="display:flex; justify-content:space-between; padding:0.8rem 0; border-bottom:1px solid var(--border); text-decoration:none; color:var(--text); font-weight:600; transition:color 0.2s;">
                        <span><?php echo esc_html($c->name); ?></span>
                        <span style="color:var(--mid); font-size:0.9rem; background:var(--off); padding:0.2rem 0.6rem; border-radius:12px;"><?php echo esc_html($c->count); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </aside>

    </div>
</div>

<style>
/* Additional specific CSS for author sidebar links */
.sidebar-cat-link:hover { color: var(--g1) !important; }
.sidebar-cat-link:hover span:last-child { background: var(--g-pale) !important; color: var(--g1) !important; }
@media (max-width: 992px) {
    .author-layout-grid { grid-template-columns: 1fr !important; }
}
</style>

<?php get_footer(); ?>
