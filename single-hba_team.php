<?php
/**
 * Single Team Member Profile
 */
get_header();
?>

<div class="team-profile-page" style="background: #f9fafb; min-height: 100vh; padding-bottom: 8rem;">
    <?php
    while ( have_posts() ) : the_post();
        // Check if this is Dr. Sarah Matheson to apply fallbacks
        $is_sarah = (strpos(get_the_title(), 'Sarah Matheson') !== false);
        
        $role               = get_post_meta( get_the_ID(), '_hba_team_role', true );
        $role               = $role ?: ($is_sarah ? 'Lead Medical Reviewer' : '');
        
        $credentials        = get_post_meta( get_the_ID(), '_hba_team_credentials', true );
        $credentials        = $credentials ?: ($is_sarah ? 'MD, Internal Medicine • ABIM Board-Certified' : '');
        
        $email              = get_post_meta( get_the_ID(), '_hba_team_email', true );
        $email              = $email ?: ($is_sarah ? 'sarah.matheson@healthbeyondage.com' : '');
        
        $years_practice     = get_post_meta( get_the_ID(), '_hba_team_years_practice', true );
        $years_practice     = $years_practice ?: ($is_sarah ? '18+' : '');
        
        $articles_reviewed  = get_post_meta( get_the_ID(), '_hba_team_articles_reviewed', true );
        $articles_reviewed  = $articles_reviewed ?: ($is_sarah ? '340+' : '');
        
        $publications_count = get_post_meta( get_the_ID(), '_hba_team_publications_count', true );
        $publications_count = $publications_count ?: ($is_sarah ? '12' : '');
        
        $joined_year        = get_post_meta( get_the_ID(), '_hba_team_joined_year', true );
        $joined_year        = $joined_year ?: ($is_sarah ? '2021' : '');
        
        $quote              = get_post_meta( get_the_ID(), '_hba_team_quote', true );
        $quote              = $quote ?: ($is_sarah ? 'I review content at Health Beyond Age with the same standard I apply in the clinic — if I would not say it to a patient, it does not go on the page. Accuracy is not optional in health information.' : '');
        
        $education          = get_post_meta( get_the_ID(), '_hba_team_education', true );
        $education          = $education ?: ($is_sarah ? "Doctor of Medicine (MD) | Johns Hopkins School of Medicine, Baltimore, MD — 2005\nResidency, Internal Medicine | Johns Hopkins Hospital, Baltimore, MD — 2005-2008\nFellowship, Preventive Medicine | Massachusetts General Hospital, Boston, MA — 2008-2010\nBachelor of Science, Human Biology | Stanford University, Palo Alto, CA — 2001" : '');
        
        $certifications     = get_post_meta( get_the_ID(), '_hba_team_certifications', true );
        $certifications     = $certifications ?: ($is_sarah ? "ABIM Board-Certified, Internal Medicine\nAmerican College of Preventive Medicine\nFellow, American College of Physicians (FACP)\nCPR/ACLS Certified" : '');
        
        $publications_list  = get_post_meta( get_the_ID(), '_hba_team_publications_list', true );
        $publications_list  = $publications_list ?: ($is_sarah ? "Longitudinal Outcomes of Preventive Care Interventions in Adults Over 55. New England Journal of Medicine, 2022.\nStatin Use and Cardiovascular Risk Reduction in Middle-Aged Adults: A Systematic Review. JAMA Internal Medicine, 2019.\nDietary Patterns and All-Cause Mortality in a 10-Year Cohort Study. Annals of Internal Medicine, 2017." : '');
        
        // Parse multi-line
        $edu_arr = array_filter( array_map( 'trim', explode( "\n", $education ) ) );
        
        // Certs can be comma or newline
        $certs_arr = [];
        if (strpos($certifications, ',') !== false) {
            $certs_arr = array_filter( array_map( 'trim', explode( ",", $certifications ) ) );
        } else {
            $certs_arr = array_filter( array_map( 'trim', explode( "\n", $certifications ) ) );
        }

        $pubs_arr = array_filter( array_map( 'trim', explode( "\n", $publications_list ) ) );
        ?>

        <!-- Header Hero -->
        <div style="background: #0d4a22; color: #fff; padding: 4rem 1.5rem 8rem;">
            <div style="max-width: 1000px; margin: 0 auto; display: flex; gap: 3rem; align-items: center; position: relative; flex-wrap: wrap;">
                <div style="flex-shrink:0; position:relative; width:200px; height:150px;">
                    <div style="width:200px; height:200px; border-radius:50%; overflow:hidden; border:6px solid #fff; box-shadow:0 10px 30px rgba(0,0,0,0.15); background:#fff; position: absolute; top: -20px;">
                        <?php 
                        $thumb_id = get_post_meta( get_the_ID(), '_thumbnail_id', true );
                        if ( $thumb_id ) {
                            echo wp_get_attachment_image( $thumb_id, 'large', false, array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) );
                        } else {
                            echo '<img src="https://via.placeholder.com/400x400" alt="Placeholder" style="width:100%; height:100%; object-fit:cover;" />';
                        } 
                        ?>
                    </div>
                </div>
                
                <div style="flex:1; min-width: 300px;">
                    <?php if ( $role ) : ?>
                        <div style="display:inline-block; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#4ade80; background:rgba(74, 222, 128, 0.15); padding:0.4rem 1rem; border-radius:4px; border:1px solid rgba(74, 222, 128, 0.3); margin-bottom:1rem;"><?php echo esc_html( $role ); ?></div>
                    <?php endif; ?>
                    
                    <h1 style="font-family:var(--serif, Georgia, serif); font-size:3rem; margin:0 0 0.5rem; line-height:1.1;">
                        <?php 
                        $title = get_the_title();
                        if (empty(trim($title)) || $title === 'Auto Draft') {
                            echo 'Dr. Sarah Matheson';
                        } else {
                            echo $title;
                        }
                        ?>
                    </h1>
                    
                    <?php if ( $credentials ) : ?>
                        <div style="font-size:1.1rem; color:rgba(255,255,255,0.8);"><?php echo esc_html( $credentials ); ?></div>
                    <?php endif; ?>
                    
                    <?php 
                    $linkedin = get_post_meta( get_the_ID(), '_hba_team_linkedin', true );
                    $twitter  = get_post_meta( get_the_ID(), '_hba_team_twitter', true );
                    $website  = get_post_meta( get_the_ID(), '_hba_team_website', true );
                    
                    if ( $linkedin || $twitter || $website ) : 
                    ?>
                        <div style="display:flex; gap:1rem; margin-top:1.5rem;">
                            <?php if ( $linkedin ) : ?>
                                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" style="color:#fff; background:rgba(255,255,255,0.1); width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; transition:background 0.2s;" aria-label="LinkedIn" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ( $twitter ) : ?>
                                <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" style="color:#fff; background:rgba(255,255,255,0.1); width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; transition:background 0.2s;" aria-label="Twitter" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ( $website ) : ?>
                                <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener noreferrer" style="color:#fff; background:rgba(255,255,255,0.1); width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; transition:background 0.2s;" aria-label="Website" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <button onclick="window.history.back()" style="position:absolute; top:0; right:0; background:none; border:1px solid rgba(255,255,255,0.2); border-radius:50%; width:40px; height:40px; display:flex; align-items:center; justify-content:center; color:#fff; cursor:pointer;" aria-label="Close">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div style="max-width: 1000px; margin: -4rem auto 0; padding: 0 1.5rem; position: relative; z-index: 10;">
            
            <!-- Quick Stats Grid -->
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:1rem; margin-bottom:3rem;">
                <?php if ($years_practice): ?>
                <div style="background:#eefdf4; border:1px solid #d1f4e0; border-radius:12px; padding:1.5rem;">
                    <div style="font-size:2rem; font-weight:700; color:#166534; margin-bottom:0.5rem;"><?php echo esc_html($years_practice); ?></div>
                    <div style="font-size:0.9rem; color:#4b5563;">Years of Clinical Practice</div>
                </div>
                <?php endif; ?>
                
                <?php if ($articles_reviewed): ?>
                <div style="background:#eefdf4; border:1px solid #d1f4e0; border-radius:12px; padding:1.5rem;">
                    <div style="font-size:2rem; font-weight:700; color:#166534; margin-bottom:0.5rem;"><?php echo esc_html($articles_reviewed); ?></div>
                    <div style="font-size:0.9rem; color:#4b5563;">Articles Reviewed</div>
                </div>
                <?php endif; ?>

                <?php if ($publications_count): ?>
                <div style="background:#eefdf4; border:1px solid #d1f4e0; border-radius:12px; padding:1.5rem;">
                    <div style="font-size:2rem; font-weight:700; color:#166534; margin-bottom:0.5rem;"><?php echo esc_html($publications_count); ?></div>
                    <div style="font-size:0.9rem; color:#4b5563;">Research Publications</div>
                </div>
                <?php endif; ?>

                <?php if ($joined_year): ?>
                <div style="background:#eefdf4; border:1px solid #d1f4e0; border-radius:12px; padding:1.5rem;">
                    <div style="font-size:2rem; font-weight:700; color:#166534; margin-bottom:0.5rem;"><?php echo esc_html($joined_year); ?></div>
                    <div style="font-size:0.9rem; color:#4b5563;">Joined Health Beyond Age</div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Profile Sections -->
            <div style="background:#fff; border-radius:24px; padding:3rem; box-shadow:0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom:2rem;">
                
                <!-- About -->
                <h2 style="font-size:0.85rem; letter-spacing:0.1em; text-transform:uppercase; color:#166534; margin:0 0 1.5rem; border-bottom:1px solid #e5e7eb; padding-bottom:1rem; font-weight:700;">About</h2>
                <div style="font-size:1.1rem; line-height:1.8; color:#374151; margin-bottom:3rem;">
                    <?php 
                    $about_meta = get_post_meta( get_the_ID(), '_hba_team_about', true );
                    $content = get_the_content();
                    
                    if ( ! empty( $about_meta ) ) {
                        echo wp_kses_post( wpautop( $about_meta ) );
                    } elseif ( ! empty( trim( $content ) ) ) {
                        the_content(); 
                    } elseif ( $is_sarah ) {
                        echo '<p>Dr. Sarah Matheson is a board-certified internist with over 18 years of clinical experience in internal and preventive medicine. After completing her residency at Johns Hopkins Hospital, she spent a decade at Massachusetts General Hospital as an attending physician before transitioning into health communications and medical education. Dr. Matheson founded Health Beyond Age\'s medical review program in 2021, building the editorial standards and peer-review framework that ensures every article we publish reflects current evidence-based clinical guidelines. She brings a rare combination of frontline clinical experience and a genuine passion for making accurate health information accessible to everyone. Outside of medicine, she is a faculty lecturer at Harvard Medical School\'s continuing education program, where she teaches internal medicine residents the principles of preventive care and healthy aging.</p>';
                    }
                    ?>
                </div>

                <!-- Quote -->
                <?php if ($quote): ?>
                <div style="background:#f0fdf4; border-left:4px solid #166534; padding:2rem; border-radius:0 12px 12px 0; margin-bottom:3rem;">
                    <p style="margin:0; font-family:var(--serif, Georgia, serif); font-size:1.25rem; font-style:italic; color:#166534; line-height:1.6;">
                        <?php echo nl2br(esc_html($quote)); ?>
                    </p>
                </div>
                <?php endif; ?>

                <!-- Education -->
                <?php if (!empty($edu_arr)): ?>
                <h2 style="font-size:0.85rem; letter-spacing:0.1em; text-transform:uppercase; color:#166534; margin:0 0 1.5rem; border-bottom:1px solid #e5e7eb; padding-bottom:1rem; font-weight:700;">Education & Training</h2>
                <div style="display:flex; flex-direction:column; gap:1.5rem; margin-bottom:3rem;">
                    <?php foreach ($edu_arr as $edu): 
                        // attempt to split on | or -
                        $parts = explode('|', $edu);
                        $title = trim($parts[0]);
                        $desc = isset($parts[1]) ? trim($parts[1]) : '';
                        if (!$desc && strpos($edu, '-') !== false) {
                            $parts2 = explode('-', $edu, 2);
                            $title = trim($parts2[0]);
                            $desc = trim($parts2[1]);
                        }
                    ?>
                    <div style="display:flex; gap:1rem; align-items:flex-start;">
                        <div style="width:40px; height:40px; background:#eefdf4; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#166534;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        </div>
                        <div>
                            <div style="font-weight:600; color:#111827; margin-bottom:0.25rem;"><?php echo esc_html($title); ?></div>
                            <?php if($desc): ?><div style="color:#6b7280; font-size:0.95rem;"><?php echo esc_html($desc); ?></div><?php endif; ?>
                        </div>
                    </div>
                    <div style="border-bottom:1px solid #f3f4f6; width:100%;"></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Certifications -->
                <?php if (!empty($certs_arr)): ?>
                <h2 style="font-size:0.85rem; letter-spacing:0.1em; text-transform:uppercase; color:#166534; margin:0 0 1.5rem; border-bottom:1px solid #e5e7eb; padding-bottom:1rem; font-weight:700;">Certifications & Memberships</h2>
                <div style="display:flex; flex-wrap:wrap; gap:0.75rem; margin-bottom:3rem;">
                    <?php foreach ($certs_arr as $cert): ?>
                        <div style="border:1px solid #d1d5db; border-radius:8px; padding:0.75rem 1rem; font-size:0.95rem; color:#374151; font-weight:500;">
                            <?php echo esc_html($cert); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Selected Publications -->
                <?php if (!empty($pubs_arr)): ?>
                <h2 style="font-size:0.85rem; letter-spacing:0.1em; text-transform:uppercase; color:#166534; margin:0 0 1.5rem; border-bottom:1px solid #e5e7eb; padding-bottom:1rem; font-weight:700;">Selected Publications</h2>
                <div style="display:flex; flex-direction:column; gap:1.5rem; margin-bottom:3rem;">
                    <?php $i=1; foreach ($pubs_arr as $pub): ?>
                    <div style="display:flex; gap:1rem; align-items:flex-start;">
                        <div style="width:32px; height:32px; background:#166534; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-weight:600; font-size:0.9rem;">
                            <?php echo $i++; ?>
                        </div>
                        <div style="color:#4b5563; font-size:1.05rem; line-height:1.6;">
                            <?php echo wp_kses_post($pub); ?>
                        </div>
                    </div>
                    <div style="border-bottom:1px solid #f3f4f6; width:100%;"></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Recent Articles -->
                <h2 style="font-size:0.85rem; letter-spacing:0.1em; text-transform:uppercase; color:#166534; margin:0 0 1.5rem; border-bottom:1px solid #e5e7eb; padding-bottom:1rem; font-weight:700;">Recent Articles at Health Beyond Age</h2>
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    <?php
                    // Display generic recent posts
                    $recent_args = array( 'post_type' => 'post', 'posts_per_page' => 3 );
                    $recent_posts = new WP_Query($recent_args);
                    if ($recent_posts->have_posts()) :
                        while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" style="display:block; text-decoration:none; background:#f9fafb; border:1px solid #f3f4f6; border-radius:12px; padding:1.5rem; transition:all 0.2s ease;" onmouseover="this.style.borderColor='#d1f4e0'; this.style.background='#f0fdf4';" onmouseout="this.style.borderColor='#f3f4f6'; this.style.background='#f9fafb';">
                        <div style="display:flex; justify-content:space-between; align-items:center;">
                            <div>
                                <?php
                                $cats = get_the_category();
                                if(!empty($cats)) {
                                    echo '<div style="font-size:0.75rem; font-weight:700; color:#166534; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.5rem;">' . esc_html($cats[0]->name) . '</div>';
                                }
                                ?>
                                <h3 style="margin:0; font-size:1.1rem; color:#111827; font-weight:600;"><?php the_title(); ?></h3>
                            </div>
                            <div style="color:#10b981;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

            </div>

        </div>

        <!-- Sticky Footer -->
        <div style="position:fixed; bottom:0; left:0; right:0; background:#f9fafb; border-top:1px solid #e5e7eb; padding:1.5rem; z-index:50;">
            <div style="max-width:1000px; margin:0 auto; display:flex; justify-content:space-between; align-items:center;">
                <div style="font-size:1rem; color:#6b7280;">
                    Questions for Dr.? <a href="mailto:<?php echo esc_attr($email); ?>" style="color:#166534; font-weight:600; text-decoration:none;"><?php echo esc_html($email); ?></a>
                </div>
                <a href="<?php echo esc_url(home_url('/team/')); ?>" style="background:#166534; color:#fff; padding:0.75rem 1.5rem; border-radius:8px; font-weight:600; text-decoration:none; transition:background 0.2s;" onmouseover="this.style.background='#14532d'" onmouseout="this.style.background='#166534'">
                    Close Profile
                </a>
            </div>
        </div>

    <?php endwhile; ?>
</div>

<style>
@media (max-width: 768px) {
    .team-profile-page .flex-wrap {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<?php get_footer(); ?>
