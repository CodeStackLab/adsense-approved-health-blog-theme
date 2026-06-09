<?php
/**
 * Template Name: Topics Directory
 * Description: A page displaying all health topics in a directory grid grouped by letter.
 */

get_header();
?>

<div class="page-hdr" style="background:#fff; padding:4rem 1.5rem; text-align:center; border-bottom:1px solid var(--border);">
    <h1 style="font-family:var(--sans); font-size:clamp(2rem,4vw,3rem); color:var(--text); font-weight:700; margin-bottom:1rem;"><?php esc_html_e('Explore Health Topics', 'healthbeyondage'); ?></h1>
    <p style="color:var(--mid); font-size:1.1rem; max-width:650px; margin:0 auto; line-height:1.7;"><?php esc_html_e('Browse our comprehensive A-Z directory of health and wellness topics, conditions, and lifestyle guides.', 'healthbeyondage'); ?></p>
</div>

<?php hba_breadcrumb(); ?>

<div class="section" style="background:var(--off); min-height:60vh; padding: 4rem 1.5rem;">
    <div style="max-width:1180px; margin:0 auto;">
        
        <?php
        $topics = get_terms([
            'taxonomy' => 'hba_health_topic',
            'hide_empty' => true,
            'orderby' => 'name',
            'order' => 'ASC'
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
            echo '<div class="az-jump-links fade-up">';
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

            // Topics Grid
            echo '<div class="topics-az-container fade-up">';
            foreach ( $grouped_topics as $letter => $topics_in_letter ) {
                $anchor_id = $letter === '#' ? 'letter-hash' : 'letter-' . $letter;
                echo '<div class="topic-letter-group" id="' . esc_attr( $anchor_id ) . '">';
                echo '<h2 class="letter-heading">' . esc_html( $letter ) . '</h2>';
                echo '<ul class="topic-list">';
                foreach ( $topics_in_letter as $topic ) {
                    echo '<li><a href="' . esc_url( get_term_link( $topic ) ) . '">' . esc_html( $topic->name ) . '</a></li>';
                }
                echo '</ul>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<div style="text-align:center; padding:3rem; background:#fff; border-radius:12px; border:1px solid var(--border);">
                    <h3 style="font-size:1.2rem; color:var(--text); margin-bottom:0.5rem;">No Topics Found</h3>
                    <p style="color:var(--mid);">Please add some health topics from the WordPress Dashboard and assign them to published articles.</p>
                  </div>';
        }
        ?>

    </div>
</div>

<?php get_footer(); ?>
