<?php
/**
 * Template Name: About Us
 */
get_header(); ?>

<div id="page-about-us" class="page active">
  <div class="breadcrumb"><div class="breadcrumb-inner"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="sep">›</span><span>About Us</span></div></div>

  <section class="about-hero">
    <div class="about-hero-inner">
      <div class="about-tag"><?php echo esc_html( get_theme_mod('hba_about_hero_tag', '✦ Our Story') ); ?></div>
      <h1><?php echo wp_kses_post( get_theme_mod('hba_about_hero_title', 'Health Information You Can<br/><em>Actually Trust</em>') ); ?></h1>
      <p><?php echo wp_kses_post( get_theme_mod('hba_about_hero_desc', 'Founded in 2021, Health Beyond Age exists to cut through the noise of the wellness industry and deliver evidence-based health guidance that genuinely helps people live longer, healthier lives.') ); ?></p>
      <div class="about-hero-ctas">
        <a href="<?php echo esc_url( get_theme_mod('hba_about_btn1_url', home_url('/team')) ); ?>" class="btn-white"><?php echo esc_html( get_theme_mod('hba_about_btn1_text', 'Meet Our Team') ); ?></a>
        <a href="<?php echo esc_url( get_theme_mod('hba_about_btn2_url', home_url('/blog')) ); ?>" class="btn-outline-white"><?php echo esc_html( get_theme_mod('hba_about_btn2_text', 'Read Our Articles') ); ?></a>
      </div>
    </div>
  </section>

  <section class="mission-strip">
    <div class="mission-inner">
      <div class="fade-up">
        <div class="mission-label"><?php echo esc_html( get_theme_mod('hba_about_mission_label', 'Our Mission') ); ?></div>
        <h2><?php echo wp_kses_post( get_theme_mod('hba_about_mission_title', 'Empowering <strong>Informed Decisions</strong> at Every Age') ); ?></h2>
        <?php echo wp_kses_post( get_theme_mod('hba_about_mission_text', '<p>We believe that access to clear, accurate, and up-to-date health information is a fundamental need — not a privilege. That\'s why every article we publish is written by credentialed health professionals and reviewed by medical experts before it reaches you.</p><p>Our editorial team of doctors, registered dietitians, certified trainers, and mental health professionals ensures that what you read here reflects the current scientific consensus — not trends, not sponsored talking points.</p>') ); ?>
      </div>
      <div class="mission-pillars fade-up">
        <div class="pillar"><div class="pillar-ico"><?php echo esc_html( get_theme_mod('hba_about_p1_icon', '🔬') ); ?></div><h4><?php echo esc_html( get_theme_mod('hba_about_p1_title', 'Evidence-Based') ); ?></h4><p><?php echo esc_html( get_theme_mod('hba_about_p1_desc', 'Every claim is grounded in peer-reviewed research and current clinical guidelines.') ); ?></p></div>
        <div class="pillar"><div class="pillar-ico"><?php echo esc_html( get_theme_mod('hba_about_p2_icon', '✓') ); ?></div><h4><?php echo esc_html( get_theme_mod('hba_about_p2_title', 'Medically Reviewed') ); ?></h4><p><?php echo esc_html( get_theme_mod('hba_about_p2_desc', 'All content goes through expert review before publication and is updated regularly.') ); ?></p></div>
        <div class="pillar"><div class="pillar-ico"><?php echo esc_html( get_theme_mod('hba_about_p3_icon', '🎯') ); ?></div><h4><?php echo esc_html( get_theme_mod('hba_about_p3_title', 'Practical First') ); ?></h4><p><?php echo esc_html( get_theme_mod('hba_about_p3_desc', 'Science is only useful if you can act on it. We translate research into real-world advice.') ); ?></p></div>
        <div class="pillar"><div class="pillar-ico"><?php echo esc_html( get_theme_mod('hba_about_p4_icon', '🛡️') ); ?></div><h4><?php echo esc_html( get_theme_mod('hba_about_p4_title', 'Independent') ); ?></h4><p><?php echo esc_html( get_theme_mod('hba_about_p4_desc', 'No sponsored content. No paid promotions. Our editorial integrity is non-negotiable.') ); ?></p></div>
      </div>
    </div>
  </section>

  <section class="values-section">
    <div class="values-inner">
      <div class="section-title fade-up">
        <div class="label"><?php echo esc_html( get_theme_mod('hba_about_val_label', 'What We Stand For') ); ?></div>
        <h2><?php echo esc_html( get_theme_mod('hba_about_val_title', 'Our Core Values') ); ?></h2>
        <p><?php echo esc_html( get_theme_mod('hba_about_val_desc', 'The principles that guide every article, every decision, and every relationship we build with our readers.') ); ?></p>
      </div>
      <div class="values-grid">
        <div class="value-card fade-up"><div class="value-ico"><?php echo esc_html( get_theme_mod('hba_about_v1_icon', '🏆') ); ?></div><h3><?php echo esc_html( get_theme_mod('hba_about_v1_title', 'Scientific Integrity') ); ?></h3><p><?php echo esc_html( get_theme_mod('hba_about_v1_desc', 'We never publish health claims that aren\'t supported by credible evidence, even when that means saying "the research isn\'t clear yet."') ); ?></p></div>
        <div class="value-card fade-up"><div class="value-ico"><?php echo esc_html( get_theme_mod('hba_about_v2_icon', '💬') ); ?></div><h3><?php echo esc_html( get_theme_mod('hba_about_v2_title', 'Clarity Over Jargon') ); ?></h3><p><?php echo esc_html( get_theme_mod('hba_about_v2_desc', 'Medical knowledge should be accessible to everyone. We write in plain language without dumbing down the science.') ); ?></p></div>
        <div class="value-card fade-up"><div class="value-ico"><?php echo esc_html( get_theme_mod('hba_about_v3_icon', '🌍') ); ?></div><h3><?php echo esc_html( get_theme_mod('hba_about_v3_title', 'Inclusivity') ); ?></h3><p><?php echo esc_html( get_theme_mod('hba_about_v3_desc', 'Health looks different for everyone. We write for diverse bodies, backgrounds, and life circumstances.') ); ?></p></div>
        <div class="value-card fade-up"><div class="value-ico"><?php echo esc_html( get_theme_mod('hba_about_v4_icon', '🔄') ); ?></div><h3><?php echo esc_html( get_theme_mod('hba_about_v4_title', 'Continuous Updates') ); ?></h3><p><?php echo esc_html( get_theme_mod('hba_about_v4_desc', 'Science evolves. We regularly review and update existing articles to reflect new research and revised guidelines.') ); ?></p></div>
        <div class="value-card fade-up"><div class="value-ico"><?php echo esc_html( get_theme_mod('hba_about_v5_icon', '🤝') ); ?></div><h3><?php echo esc_html( get_theme_mod('hba_about_v5_title', 'Reader Trust') ); ?></h3><p><?php echo esc_html( get_theme_mod('hba_about_v5_desc', 'Your trust is our most valuable asset. We\'re transparent about our sources, conflicts of interest, and editorial process.') ); ?></p></div>
        <div class="value-card fade-up"><div class="value-ico"><?php echo esc_html( get_theme_mod('hba_about_v6_icon', '❤️') ); ?></div><h3><?php echo esc_html( get_theme_mod('hba_about_v6_title', 'Genuine Care') ); ?></h3><p><?php echo esc_html( get_theme_mod('hba_about_v6_desc', 'Behind every article is a team of people who genuinely want to help you live better — not just drive traffic.') ); ?></p></div>
      </div>
    </div>
  </section>

  <div style="background:#fff;border-top:1px solid var(--border);border-bottom:1px solid var(--border)">
    <div class="section" style="padding-top:3rem;padding-bottom:3rem;text-align:center">
      <div class="section-title fade-up" style="margin-bottom:2rem">
        <div class="label">By the Numbers</div>
        <h2>Health Beyond Age in 2026</h2>
      </div>
      <div class="about-stats-grid fade-up">
        <div class="stat-item"><div class="stat-num">150+</div><div class="stat-lbl">Expert Articles</div></div>
        <div class="stat-item"><div class="stat-num">5</div><div class="stat-lbl">Health Categories</div></div>
        <div class="stat-item"><div class="stat-num">100%</div><div class="stat-lbl">Medically Reviewed</div></div>
        <div class="stat-item"><div class="stat-num">2021</div><div class="stat-lbl">Publishing Since</div></div>
      </div>
    </div>
  </div>



</div>

<?php get_footer(); ?>
