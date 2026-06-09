<?php
/**
 * Single Team Member Profile
 */
get_header();
?>

<div class="team-profile-container" style="max-width:1000px; margin: 4rem auto; padding: 0 1.5rem;">
    <?php
    while ( have_posts() ) : the_post();
        $role        = get_post_meta( get_the_ID(), '_hba_team_role', true );
        $credentials = get_post_meta( get_the_ID(), '_hba_team_credentials', true );
        $tags_string = get_post_meta( get_the_ID(), '_hba_team_tags', true );
        $tags        = array_filter( array_map( 'trim', explode( ',', $tags_string ) ) );
        ?>
        
        <div class="team-profile-header fade-up" style="display:flex; align-items:center; gap:3rem; margin-bottom:4rem; background:#fff; padding:3rem; border-radius:24px; border:1px solid var(--border); box-shadow:0 10px 40px rgba(0,0,0,0.03);">
            <div class="team-profile-avatar" style="flex-shrink:0; width:220px; height:220px; border-radius:50%; overflow:hidden; border:5px solid var(--g-pale); box-shadow:0 10px 25px rgba(0,0,0,0.08);">
                <?php 
                $thumb_id = get_post_meta( get_the_ID(), '_thumbnail_id', true );
                if ( $thumb_id ) {
                    echo wp_get_attachment_image( $thumb_id, 'large', false, array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) );
                } else {
                    echo '<img src="https://via.placeholder.com/600x600" alt="Placeholder" style="width:100%; height:100%; object-fit:cover;" />';
                } 
                ?>
            </div>
            
            <div class="team-profile-info">
                <?php if ( $role ) : ?>
                    <div style="display:inline-block; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.15em; color:var(--g1); background:var(--g-pale); padding:0.4rem 1.2rem; border-radius:20px; margin-bottom:1rem;"><?php echo esc_html( $role ); ?></div>
                <?php endif; ?>
                
                <h1 style="font-family:var(--serif); font-size:3rem; color:var(--text); margin-bottom:0.5rem; line-height:1.1;"><?php the_title(); ?></h1>
                
                <?php if ( $credentials ) : ?>
                    <div style="font-size:1.1rem; color:var(--mid); font-weight:600; margin-bottom:1.5rem;"><?php echo esc_html( $credentials ); ?></div>
                <?php endif; ?>
                
                <?php if ( ! empty( $tags ) ) : ?>
                    <div style="display:flex; flex-wrap:wrap; gap:0.5rem;">
                        <?php foreach ( $tags as $tag ) : ?>
                            <span style="font-size:0.8rem; font-weight:600; color:var(--g1); background:#fff; border:1px solid var(--g-light); padding:0.3rem 0.8rem; border-radius:20px;"><?php echo esc_html( $tag ); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="team-profile-content fade-up" style="background:#fff; padding:3rem; border-radius:24px; border:1px solid var(--border);">
            <h2 style="font-family:var(--serif); font-size:1.8rem; color:var(--text); margin-bottom:1.5rem; border-bottom:2px solid var(--border); padding-bottom:1rem;">About <?php the_title(); ?></h2>
            <div class="content-body" style="font-size:1.1rem; line-height:1.8; color:var(--text);">
                <?php the_content(); ?>
            </div>
            
            <div style="margin-top:3rem;">
                <a href="<?php echo esc_url( home_url('/team/') ); ?>" class="btn-ghost" style="display:inline-flex; align-items:center; gap:0.5rem;">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Back to Team
                </a>
            </div>
        </div>

    <?php endwhile; ?>
</div>

<style>
@media (max-width: 768px) {
    .team-profile-header {
        flex-direction: column;
        text-align: center;
        gap: 2rem !important;
        padding: 2rem !important;
    }
    .team-profile-content {
        padding: 2rem !important;
    }
}
</style>

<?php get_footer(); ?>
