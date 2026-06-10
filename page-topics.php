<?php
/**
 * Template Name: Topics Directory
 * Description: A page displaying all health topics in a directory grid grouped by letter.
 */

get_header();
?>

<!-- ENHANCED HERO SECTION -->
<div class="topics-hero-enhanced">
    <div class="topics-hero-content fade-up">
        <span class="topics-hero-badge">Health Directory</span>
        <h1 class="topics-hero-title"><?php esc_html_e('Explore Health Topics', 'healthbeyondage'); ?></h1>
        <p class="topics-hero-desc"><?php esc_html_e('Browse our comprehensive A-Z directory of health conditions, wellness guides, and medical insights.', 'healthbeyondage'); ?></p>
        
        <form role="search" method="get" class="topics-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="search" name="s" placeholder="Search for a health condition or topic..." value="<?php echo get_search_query(); ?>" required />
            <input type="hidden" name="post_type" value="post" />
            <button type="submit">Search</button>
        </form>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div class="section topics-body-section" style="background:var(--off); min-height:60vh; padding: 4rem 1.5rem;">
    <div style="max-width:1180px; margin:0 auto;">
        
        <?php
        $topics = get_terms([
            'taxonomy' => 'category',
            'hide_empty' => true,
            'orderby' => 'name',
            'order' => 'ASC',
            'exclude' => [1] // Usually Uncategorized is ID 1
        ]);

        if ( ! empty( $topics ) && ! is_wp_error( $topics ) ) {
            $grouped_topics = [];
            foreach ( $topics as $topic ) {
                $first_letter = strtoupper( substr( $topic->name, 0, 1 ) );
                if ( ! preg_match('/[A-Z]/', $first_letter) ) {
                    $first_letter = '#';
                }
                $grouped_topics[$first_letter][] = $topic;
            }

            // A-Z Jump Links
            echo '<div class="az-jump-container fade-up">';
            echo '<div class="az-jump-links">';
            foreach ( range('A', 'Z') as $char ) {
                if ( isset( $grouped_topics[$char] ) ) {
                    echo '<a href="#letter-' . $char . '">' . $char . '</a>';
                } else {
                    echo '<span class="disabled">' . $char . '</span>';
                }
            }
            if ( isset( $grouped_topics['#'] ) ) {
                echo '<a href="#letter-hash">#</a>';
            }
            echo '</div>';
            echo '</div>';

            // Topics Grid
            echo '<div class="topics-az-container fade-up">';
            foreach ( $grouped_topics as $letter => $topics_in_letter ) {
                $anchor_id = $letter === '#' ? 'letter-hash' : 'letter-' . $letter;
                echo '<div class="topic-letter-group" id="' . esc_attr( $anchor_id ) . '">';
                echo '<div class="letter-heading-wrap"><h2 class="letter-heading">' . esc_html( $letter ) . '</h2></div>';
                echo '<ul class="topic-list-enhanced">';
                foreach ( $topics_in_letter as $topic ) {
                    echo '<li><a href="' . esc_url( get_term_link( $topic ) ) . '">';
                    echo '<span class="topic-name">' . esc_html( $topic->name ) . '</span>';
                    echo '<span class="topic-count">' . esc_html( $topic->count ) . ' Articles <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>';
                    echo '</a></li>';
                }
                echo '</ul>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<div style="text-align:center; padding:5rem 2rem; background:#fff; border-radius:24px; border:1px solid var(--border); box-shadow: 0 10px 40px rgba(0,0,0,0.03);" class="fade-up">
                    <div style="font-size:3rem; margin-bottom:1rem;">📂</div>
                    <h3 style="font-family:var(--serif); font-size:1.8rem; color:var(--text); margin-bottom:0.8rem;">No Topics Found</h3>
                    <p style="color:var(--mid); font-size:1.05rem;">Please add some health topics from the WordPress Dashboard and assign them to published articles.</p>
                  </div>';
        }
        ?>

    </div>
</div>

<?php get_footer(); ?>
