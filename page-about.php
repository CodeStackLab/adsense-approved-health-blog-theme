<?php
/**
 * Template Name: About Us
 */
get_header(); ?>

<div id="page-about-us" class="page active">
  <div class="breadcrumb"><div class="breadcrumb-inner"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="sep">›</span><span>About Us</span></div></div>

  <section class="about-hero">
    <div class="about-hero-inner">
      <div class="about-tag">✦ Our Story</div>
      <h1>Health Information You Can<br/><em>Actually Trust</em></h1>
      <p>Founded in 2021, Health Beyond Age exists to cut through the noise of the wellness industry and deliver evidence-based health guidance that genuinely helps people live longer, healthier lives.</p>
      <div class="about-hero-ctas">
        <a href="<?php echo esc_url(home_url('/team')); ?>" class="btn-white">Meet Our Team</a>
        <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn-outline-white">Read Our Articles</a>
      </div>
    </div>
  </section>

  <section class="mission-strip">
    <div class="mission-inner">
      <div class="fade-up">
        <div class="mission-label">Our Mission</div>
        <h2>Empowering <strong>Informed Decisions</strong> at Every Age</h2>
        <p>We believe that access to clear, accurate, and up-to-date health information is a fundamental need — not a privilege. That's why every article we publish is written by credentialed health professionals and reviewed by medical experts before it reaches you.</p>
        <p>Our editorial team of doctors, registered dietitians, certified trainers, and mental health professionals ensures that what you read here reflects the current scientific consensus — not trends, not sponsored talking points.</p>
      </div>
      <div class="mission-pillars fade-up">
        <div class="pillar"><div class="pillar-ico">🔬</div><h4>Evidence-Based</h4><p>Every claim is grounded in peer-reviewed research and current clinical guidelines.</p></div>
        <div class="pillar"><div class="pillar-ico">✓</div><h4>Medically Reviewed</h4><p>All content goes through expert review before publication and is updated regularly.</p></div>
        <div class="pillar"><div class="pillar-ico">🎯</div><h4>Practical First</h4><p>Science is only useful if you can act on it. We translate research into real-world advice.</p></div>
        <div class="pillar"><div class="pillar-ico">🛡️</div><h4>Independent</h4><p>No sponsored content. No paid promotions. Our editorial integrity is non-negotiable.</p></div>
      </div>
    </div>
  </section>

  <section class="values-section">
    <div class="values-inner">
      <div class="section-title fade-up">
        <div class="label">What We Stand For</div>
        <h2>Our Core Values</h2>
        <p>The principles that guide every article, every decision, and every relationship we build with our readers.</p>
      </div>
      <div class="values-grid">
        <div class="value-card fade-up"><div class="value-ico">🏆</div><h3>Scientific Integrity</h3><p>We never publish health claims that aren't supported by credible evidence, even when that means saying "the research isn't clear yet."</p></div>
        <div class="value-card fade-up"><div class="value-ico">💬</div><h3>Clarity Over Jargon</h3><p>Medical knowledge should be accessible to everyone. We write in plain language without dumbing down the science.</p></div>
        <div class="value-card fade-up"><div class="value-ico">🌍</div><h3>Inclusivity</h3><p>Health looks different for everyone. We write for diverse bodies, backgrounds, and life circumstances.</p></div>
        <div class="value-card fade-up"><div class="value-ico">🔄</div><h3>Continuous Updates</h3><p>Science evolves. We regularly review and update existing articles to reflect new research and revised guidelines.</p></div>
        <div class="value-card fade-up"><div class="value-ico">🤝</div><h3>Reader Trust</h3><p>Your trust is our most valuable asset. We're transparent about our sources, conflicts of interest, and editorial process.</p></div>
        <div class="value-card fade-up"><div class="value-ico">❤️</div><h3>Genuine Care</h3><p>Behind every article is a team of people who genuinely want to help you live better — not just drive traffic.</p></div>
      </div>
    </div>
  </section>

  <div style="background:#fff;border-top:1px solid var(--border);border-bottom:1px solid var(--border)">
    <div class="section" style="padding-top:3rem;padding-bottom:3rem;text-align:center">
      <div class="section-title fade-up" style="margin-bottom:2rem">
        <div class="label">By the Numbers</div>
        <h2>Health Beyond Age in 2026</h2>
      </div>
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;max-width:800px;margin:0 auto" class="fade-up">
        <div><div style="font-family:var(--serif);font-size:2.5rem;color:var(--g1);font-weight:700;line-height:1">150+</div><div style="font-size:0.78rem;color:var(--muted);margin-top:0.4rem">Expert Articles</div></div>
        <div><div style="font-family:var(--serif);font-size:2.5rem;color:var(--g1);font-weight:700;line-height:1">5</div><div style="font-size:0.78rem;color:var(--muted);margin-top:0.4rem">Health Categories</div></div>
        <div><div style="font-family:var(--serif);font-size:2.5rem;color:var(--g1);font-weight:700;line-height:1">100%</div><div style="font-size:0.78rem;color:var(--muted);margin-top:0.4rem">Medically Reviewed</div></div>
        <div><div style="font-family:var(--serif);font-size:2.5rem;color:var(--g1);font-weight:700;line-height:1">2021</div><div style="font-size:0.78rem;color:var(--muted);margin-top:0.4rem">Publishing Since</div></div>
      </div>
    </div>
  </div>

  <?php hba_newsletter_section('✦ Join our community', 'Stay Ahead of Your Health', 'Expert-curated wellness insights, the latest research, and practical tips — delivered every Friday. No noise, no spam.'); ?>

</div>

<?php get_footer(); ?>
