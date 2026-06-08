<?php
/**
 * Single Medical Reviewer Profile Template
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
    $name = get_the_title();
    $role = get_post_meta( get_the_ID(), '_hba_reviewer_role', true ) ?: get_the_excerpt();
    $bio  = get_post_meta( get_the_ID(), '_hba_reviewer_bio', true ) ?: get_the_content();
    $img  = get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=500&q=80';
?>

<div class="articles-hero" style="background:var(--off);">
    <div class="articles-hero-inner" style="max-width:800px; text-align:center; padding-top:4rem; padding-bottom:3rem;">
        <div class="photo" style="width:120px; height:120px; border-radius:50%; margin:0 auto 1.5rem; border:4px solid #fff; box-shadow:0 10px 30px rgba(0,0,0,0.1); overflow:hidden; background:#fff;">
            <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $name ); ?>" style="width:100%; height:100%; object-fit:cover;" />
        </div>
        <div class="eyebrow" style="color:var(--g1); font-weight:700; margin-bottom:.5rem; text-transform:uppercase; letter-spacing:1px; font-size:.8rem;">
            <?php echo esc_html( $role ); ?>
        </div>
        <h1 style="font-family:var(--serif); font-size:2.5rem; color:var(--text); margin-bottom:1rem;">
            <?php echo esc_html( $name ); ?>
        </h1>
    </div>
</div>

<div class="section" style="max-width:800px; margin:0 auto; padding-top:2rem; padding-bottom:5rem;">
    <div class="article-body" style="font-size:1.1rem; line-height:1.8; color:var(--text);">
        <?php echo apply_filters('the_content', $bio); ?>
    </div>
    
    <hr style="border:none; border-top:1px solid var(--border); margin:4rem 0;" />
    
    <div style="text-align:center;">
        <h3 style="font-family:var(--serif); font-size:1.5rem; margin-bottom:2rem;">Articles reviewed by <?php echo esc_html($name); ?></h3>
        
        <?php
        // Find articles reviewed by this person
        $reviewed_articles = new WP_Query([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 10,
            'meta_query'     => [
                [
                    'key'   => '_hba_reviewer_id',
                    'value' => get_the_ID(),
                ]
            ]
        ]);
        
        if ( $reviewed_articles->have_posts() ) :
            echo '<div class="art-grid" style="text-align:left;">';
            while ( $reviewed_articles->have_posts() ) {
                $reviewed_articles->the_post();
                hba_article_card( get_the_ID() );
            }
            echo '</div>';
            wp_reset_postdata();
        else :
            echo '<p style="color:var(--mid);">No articles currently assigned to this reviewer.</p>';
        endif;
        ?>
    </div>
</div>

<?php
endwhile; endif;
get_footer();
