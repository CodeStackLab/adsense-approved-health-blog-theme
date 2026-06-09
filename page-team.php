<?php
/**
 * Template Name: Meet Our Team
 */
get_header();
?>
<!-- TEAM HERO -->
  <section class="team-hero fade-up">
    <div class="team-hero-inner">
      <div class="team-hero-label"><?php echo esc_html( get_theme_mod('hba_team_label', 'Our Experts') ); ?></div>
      <h1 class="team-hero-title"><?php echo wp_kses_post( get_theme_mod('hba_team_title', 'Meet the Team Behind<br/>Health Beyond Age') ); ?></h1>
      <p class="team-hero-desc"><?php echo wp_kses_post( get_theme_mod('hba_team_desc', 'Every article on this site is shaped by credentialed health professionals &mdash; doctors, dietitians, trainers, and researchers committed to accuracy and your wellbeing.') ); ?></p>
    </div>
  </section>

  <!-- TEAM MEMBERS GRID -->
  <div class="team-grid-container">
    <div class="team-section-title"><?php echo esc_html( get_theme_mod('hba_team_grid_title', 'Medical Reviewers & Editorial Team') ); ?></div>
    <div class="team-dynamic-grid">
      <?php
      $team_query = new WP_Query([
          'post_type'      => 'hba_team',
          'posts_per_page' => -1,
          'orderby'        => 'menu_order title',
          'order'          => 'ASC'
      ]);

      if ( $team_query->have_posts() ) :
          while ( $team_query->have_posts() ) : $team_query->the_post();
              $role        = get_post_meta( get_the_ID(), '_hba_team_role', true );
              $credentials = get_post_meta( get_the_ID(), '_hba_team_credentials', true );
              $tags_string = get_post_meta( get_the_ID(), '_hba_team_tags', true );
              $tags        = array_filter( array_map( 'trim', explode( ',', $tags_string ) ) );
              ?>
              <div class="team-member-card fade-up">
                <div class="team-member-photo">
                  <?php 
                  $thumb_id = get_post_meta( get_the_ID(), '_thumbnail_id', true );
                  if ( $thumb_id ) {
                      echo wp_get_attachment_image( $thumb_id, 'large', false, array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) );
                  } else {
                      echo '<img src="https://via.placeholder.com/600x600" alt="Placeholder"/>';
                  } 
                  ?>
                </div>
                <div class="team-member-body">
                  <?php if ( $role ) : ?>
                    <div class="team-member-role"><?php echo esc_html( $role ); ?></div>
                  <?php endif; ?>
                  <h3 class="team-member-name"><?php the_title(); ?></h3>
                  <?php if ( $credentials ) : ?>
                    <div class="team-member-cred"><?php echo esc_html( $credentials ); ?></div>
                  <?php endif; ?>
                  
                  <div class="team-member-bio">
                      <?php the_excerpt(); ?>
                  </div>
                  
                  <?php if ( ! empty( $tags ) ) : ?>
                    <div class="team-member-tags">
                      <?php foreach ( $tags as $tag ) : ?>
                        <span class="team-tag"><?php echo esc_html( $tag ); ?></span>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                  
                  <div style="margin-top:1.5rem; width:100%;">
                      <a href="<?php the_permalink(); ?>" class="btn-ghost" style="width:100%; display:flex; justify-content:center; align-items:center; gap:0.5rem; padding:0.6rem 1rem;">
                          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                          View Full Profile
                      </a>
                  </div>
                </div>
              </div>
              <?php
          endwhile;
          wp_reset_postdata();
      else :
          echo '<p style="grid-column: 1/-1; text-align: center; padding: 2rem; background: var(--g-pale); border-radius: 12px; color: var(--mid);">No team members found. Please add them via the WordPress Dashboard -> Team.</p>';
      endif;
      ?>
    </div>

    <!-- EDITORIAL STANDARDS BOX -->
    <div class="editorial-standards-box fade-up">
      <div class="standards-col">
        <div class="standards-icon">🔬</div>
        <h4>Expert Authorship</h4>
        <p>Every article is written by a credentialed health professional with verified clinical experience.</p>
      </div>
      <div class="standards-col">
        <div class="standards-icon">✓</div>
        <h4>Peer Review</h4>
        <p>All content undergoes independent medical review before publication and is updated as evidence evolves.</p>
      </div>
      <div class="standards-col">
        <div class="standards-icon">📚</div>
        <h4>Primary Sources</h4>
        <p>Claims are fact-checked against peer-reviewed journals and current clinical guidelines — never opinion.</p>
      </div>
    </div>
    
    <div class="standards-cta fade-up">
      <a href="<?php echo esc_url( home_url('/about') ); ?>" class="btn-green">Learn About Our Editorial Process &rarr;</a>
    </div>
  </div>
<?php get_footer(); ?>
