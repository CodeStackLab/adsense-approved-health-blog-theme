<?php
/**
 * Taxonomy Template for Health Topics (e.g. Anxiety and Depression)
 */

get_header();

$term = get_queried_object();

// Automatically redirect to the matching standard Category page to fix the issue where custom taxonomy posts don't match.
$cat = get_category_by_slug( $term->slug );
if ( $cat ) {
    wp_redirect( get_category_link( $cat->term_id ), 301 );
    exit;
}
?>

<!-- TOPIC HERO -->
<div class="topic-hero" style="background:#fff; border-bottom:1px solid var(--border); padding:4rem 1.5rem;">
    <div style="max-width:900px; margin:0 auto; text-align:center;" class="fade-up">
        <div style="display:inline-block; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.12em; color:var(--g1); background:var(--g-pale); padding:0.4rem 1rem; border-radius:20px; margin-bottom:1rem;">
            Health Topic
        </div>
        <h1 style="font-family:var(--sans); font-size:clamp(2.2rem, 4vw, 3.5rem); font-weight:700; color:var(--text); margin-bottom:1.5rem;">
            <?php echo esc_html( $term->name ); ?>
        </h1>
        <?php if ( ! empty( $term->description ) ) : ?>
            <div style="font-size:1.15rem; color:var(--mid); line-height:1.7; max-width:800px; margin:0 auto;">
                <?php echo wp_kses_post( wpautop( $term->description ) ); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<!-- ARTICLES GRID -->
<div class="section" style="background:var(--off); min-height:50vh; padding: 4rem 1.5rem;">
    <div style="max-width:1180px; margin:0 auto;">
        
        <div class="topic-articles-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:2rem;">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    
                    <article <?php post_class('article-card fade-up'); ?> style="background:#fff; border:1px solid var(--border); border-radius:16px; overflow:hidden; display:flex; flex-direction:column; box-shadow:0 4px 20px rgba(0,0,0,0.03); transition:transform 0.3s ease, box-shadow 0.3s ease;">
                        <a href="<?php the_permalink(); ?>" style="display:block; width:100%; aspect-ratio:16/10; overflow:hidden;">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('large', ['style' => 'width:100%; height:100%; object-fit:cover; transition:transform 0.5s ease;']); ?>
                            <?php else : ?>
                                <div style="width:100%; height:100%; background:var(--g-pale); display:flex; align-items:center; justify-content:center; color:var(--g2);">No Image</div>
                            <?php endif; ?>
                        </a>
                        <div class="article-card-body" style="padding:1.5rem; display:flex; flex-direction:column; flex-grow:1;">
                            <?php 
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) {
                                echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" style="font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:var(--g1); text-decoration:none; margin-bottom:0.75rem;">' . esc_html( $categories[0]->name ) . '</a>';
                            }
                            ?>
                            <h2 style="font-size:1.2rem; font-family:var(--serif); font-weight:700; line-height:1.4; margin-bottom:1rem;">
                                <a href="<?php the_permalink(); ?>" style="color:var(--text); text-decoration:none;"><?php the_title(); ?></a>
                            </h2>
                            <div style="margin-top:auto; font-size:0.8rem; color:var(--muted); display:flex; align-items:center; gap:0.5rem;">
                                <?php echo get_the_date(); ?>
                                <span>&middot;</span>
                                <?php 
                                $author_id = get_post_field( 'post_author', get_the_ID() );
                                echo esc_html( get_the_author_meta( 'display_name', $author_id ) );
                                ?>
                            </div>
                        </div>
                    </article>

                <?php endwhile; ?>
            <?php else : ?>
                <div style="grid-column:1/-1; text-align:center; padding:3rem; background:#fff; border-radius:12px; border:1px solid var(--border);">
                    <h3 style="font-size:1.2rem; color:var(--text); margin-bottom:0.5rem;">No articles found</h3>
                    <p style="color:var(--mid);">There are currently no articles assigned to this health topic.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div style="margin-top:4rem; text-align:center;">
            <?php 
            echo paginate_links([
                'prev_text' => '&larr; Previous',
                'next_text' => 'Next &rarr;',
                'type'      => 'list',
            ]);
            ?>
        </div>

    </div>
</div>

<style>
/* Subtle hover for article cards */
.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}
.article-card:hover img {
    transform: scale(1.05);
}
.article-card h2 a:hover {
    color: var(--g1);
}

/* Pagination styles */
.page-numbers {
    display: inline-flex;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
    margin: 0;
    justify-content: center;
}
.page-numbers li a, .page-numbers li span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: #fff;
    border: 1px solid var(--border);
    color: var(--text);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}
.page-numbers li a:hover {
    background: var(--g-pale);
    color: var(--g1);
    border-color: var(--g-light);
}
.page-numbers li span.current {
    background: var(--g1);
    color: #fff;
    border-color: var(--g1);
}
</style>

<?php get_footer(); ?>
