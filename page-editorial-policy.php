<?php
/**
 * Template Name: Editorial Policy
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Editorial Policy - <?php bloginfo('name'); ?></title>
<?php wp_head(); ?>
<style>
  :root{
    --ink:#1b2430;
    --muted:#5b6675;
    --line:#e7e3d9;
    --bg-soft:#f7f5ef;
    --accent:#2f6f5e;
    --accent-dark:#234f43;
    --accent-soft:#e7f0ec;
    --card-bg:#ffffff;
    --radius:14px;
    --maxw:1180px;
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
  }
  *{box-sizing:border-box;}
  body{margin:0;background:#fff;color:var(--ink);line-height:1.65;-webkit-font-smoothing:antialiased;}
  a{color:inherit;text-decoration:none;}
  img{max-width:100%;display:block;}

  /* ============ TOP NAV ============ */
  .ep-site-header{border-bottom:1px solid var(--line);position:sticky;top:0;background:#fff;z-index:50;}
  .ep-nav-wrap{max-width:var(--maxw);margin:0 auto;display:flex;align-items:center;justify-content:space-between;padding:14px 24px;gap:24px;}
  .ep-logo{display:flex;align-items:center;gap:10px;font-weight:700;font-size:19px;letter-spacing:-0.01em;color:var(--ink);flex:none;}
  .ep-logo-mark{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,var(--accent),var(--accent-dark));display:flex;align-items:center;justify-content:center;color:#fff;font-size:17px;flex:none;}
  .ep-primary-nav{display:flex;gap:28px;list-style:none;margin:0;padding:0;flex:1;justify-content:center;}
  .ep-primary-nav a{font-size:15px;font-weight:500;color:var(--ink);padding:6px 2px;border-bottom:2px solid transparent;}
  .ep-primary-nav a:hover{color:var(--accent);}
  .ep-nav-right{display:flex;align-items:center;gap:18px;flex:none;}
  .ep-nav-right a{font-size:14.5px;font-weight:500;}
  .ep-btn-outline{border:1px solid var(--line);border-radius:999px;padding:8px 18px;}
  .ep-btn-outline:hover{border-color:var(--accent);color:var(--accent);}

  @media(max-width:900px){
    .ep-primary-nav{display:none;}
    .ep-btn-outline{padding:7px 14px;font-size:13.5px;}
  }

  /* ============ BREADCRUMB STRIP ============ */
  .ep-breadcrumb-strip{background:var(--bg-soft);border-bottom:1px solid var(--line);}
  .ep-breadcrumb-wrap{max-width:var(--maxw);margin:0 auto;padding:12px 24px;font-size:13.5px;color:var(--muted);}
  .ep-breadcrumb-wrap a:hover{color:var(--accent);}

  /* ============ PAGE LAYOUT ============ */
  .ep-page-wrap{max-width:var(--maxw);margin:0 auto;padding:0 24px 64px;display:grid;grid-template-columns:1fr 320px;gap:48px;}
  @media(max-width:980px){.ep-page-wrap{grid-template-columns:1fr;}}

  .ep-main-col{min-width:0;}

  /* ============ HERO ============ */
  .ep-policy-hero{padding:44px 0 30px;border-bottom:1px solid var(--line);margin-bottom:38px;}
  .ep-eyebrow{display:inline-flex;align-items:center;gap:8px;font-size:12.5px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:var(--accent);background:var(--accent-soft);padding:6px 14px;border-radius:999px;margin-bottom:18px;}
  .ep-policy-hero h1{font-size:clamp(28px,4vw,38px);line-height:1.15;margin:0 0 14px;letter-spacing:-0.01em;}
  .ep-policy-hero p.ep-lede{font-size:17.5px;color:var(--muted);max-width:600px;margin:0 0 20px;}
  .ep-meta-row{display:flex;flex-wrap:wrap;gap:18px;font-size:13.5px;color:var(--muted);}
  .ep-meta-row span{display:inline-flex;align-items:center;gap:6px;}

  /* ============ CONTENT SECTIONS ============ */
  .ep-section{margin:42px 0;}
  .ep-section h2{font-size:22px;margin:0 0 8px;letter-spacing:-0.01em;}
  .ep-section .ep-section-sub{color:var(--muted);font-size:14.5px;margin:0 0 20px;}
  .ep-section p{margin:0 0 16px;font-size:15.5px;}

  .ep-card-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:14px;margin:20px 0;}
  .ep-pcard{background:var(--bg-soft);border:1px solid var(--line);border-radius:var(--radius);padding:18px 18px 16px;}
  .ep-pcard .ep-pcard-num{font-size:11.5px;font-weight:700;color:var(--accent);letter-spacing:0.05em;margin-bottom:8px;display:block;}
  .ep-pcard h3{font-size:15.5px;margin:0 0 8px;}
  .ep-pcard p{font-size:14px;color:var(--muted);margin:0;}

  .ep-steps{border-left:2px solid var(--line);margin:22px 0 22px 6px;padding-left:26px;}
  .ep-step{position:relative;padding-bottom:26px;}
  .ep-step:last-child{padding-bottom:0;}
  .ep-step::before{content:"";position:absolute;left:-33px;top:2px;width:14px;height:14px;border-radius:50%;background:var(--accent);border:3px solid #fff;box-shadow:0 0 0 1px var(--line);}
  .ep-step h3{font-size:16px;margin:0 0 6px;}
  .ep-step p{font-size:14.5px;color:var(--muted);margin:0;}

  .ep-table-wrap{overflow-x:auto;margin:18px 0;border:1px solid var(--line);border-radius:var(--radius);}
  table.ep-policy-table{width:100%;border-collapse:collapse;font-size:14px;}
  table.ep-policy-table th,table.ep-policy-table td{text-align:left;padding:12px 14px;border-bottom:1px solid var(--line);vertical-align:top;}
  table.ep-policy-table tr:last-child td{border-bottom:none;}
  table.ep-policy-table th{background:var(--bg-soft);font-weight:600;font-size:12.5px;text-transform:uppercase;letter-spacing:0.03em;color:var(--muted);}

  .ep-source-list{list-style:none;margin:16px 0;padding:0;display:grid;gap:9px;}
  .ep-source-list li{display:flex;gap:12px;align-items:flex-start;font-size:14.5px;background:#fff;border:1px solid var(--line);border-radius:10px;padding:11px 14px;}
  .ep-source-tag{flex:none;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;color:var(--accent);background:var(--accent-soft);border-radius:6px;padding:3px 8px;margin-top:1px;}

  .ep-callout{background:var(--accent-soft);border:1px solid #cfe3da;border-radius:var(--radius);padding:20px 22px;margin:22px 0;}
  .ep-callout h3{margin:0 0 8px;font-size:15.5px;}
  .ep-callout p{margin:0;font-size:14.5px;}

  .ep-reviewer-row{display:flex;align-items:center;gap:14px;margin-top:14px;}
  .ep-reviewer-row img{width:50px;height:50px;border-radius:50%;object-fit:cover;flex:none;display:block;background:var(--accent-soft);overflow:hidden;}
  .ep-reviewer-row .ep-rname{font-weight:600;font-size:14px;}
  .ep-reviewer-row .ep-rrole{font-size:12.5px;color:var(--muted);}

  ul.ep-plain{margin:0 0 16px;padding-left:20px;}
  ul.ep-plain li{margin-bottom:8px;font-size:14.5px;}

  .ep-faq-item{border:1px solid var(--line);border-radius:10px;padding:15px 17px;margin-bottom:11px;}
  .ep-faq-item h3{font-size:15px;margin:0 0 6px;}
  .ep-faq-item p{font-size:14px;color:var(--muted);margin:0;}

  .ep-contact-box{text-align:center;border:1px solid var(--line);border-radius:var(--radius);padding:34px 24px;margin-top:46px;background:linear-gradient(180deg,var(--bg-soft),#fff);}
  .ep-contact-box h2{margin:0 0 10px;font-size:21px;}
  .ep-contact-box p{color:var(--muted);margin:0 0 18px;font-size:14.5px;}
  .ep-btn-fill{display:inline-block;background:var(--accent);color:#fff!important;font-weight:600;font-size:14.5px;padding:11px 24px;border-radius:999px;}
  .ep-btn-fill:hover{background:var(--accent-dark);}

  /* ============ SIDEBAR ============ */
  .ep-sidebar{display:flex;flex-direction:column;gap:30px;padding-top:6px;}
  .ep-widget{}
  .ep-widget-title{display:flex;align-items:center;gap:7px;font-size:14px;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;color:var(--ink);margin:0 0 16px;}
  .ep-widget-title .ep-dot{width:7px;height:7px;border-radius:50%;background:var(--accent);}

  .ep-trend-item{display:flex;gap:12px;padding:11px 0;border-bottom:1px solid var(--line);}
  .ep-trend-item:last-child{border-bottom:none;padding-bottom:0;}
  .ep-trend-rank{flex:none;width:24px;height:24px;border-radius:50%;background:var(--bg-soft);color:var(--accent);font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;}
  .ep-trend-meta{font-size:11px;color:var(--accent);font-weight:600;text-transform:uppercase;letter-spacing:0.03em;margin-bottom:3px;}
  .ep-trend-title{font-size:13.5px;font-weight:500;line-height:1.4;color:var(--ink);}
  .ep-trend-title:hover{color:var(--accent);}
  .ep-trend-sub{font-size:11.5px;color:var(--muted);margin-top:3px;}

  .ep-topic-pills{display:flex;flex-wrap:wrap;gap:8px;}
  .ep-topic-pills a{font-size:13px;font-weight:500;border:1px solid var(--line);border-radius:999px;padding:7px 13px;color:var(--ink);}
  .ep-topic-pills a:hover{border-color:var(--accent);color:var(--accent);background:var(--accent-soft);}

  .ep-story-item{display:flex;gap:10px;align-items:flex-start;padding:10px 0;border-bottom:1px solid var(--line);}
  .ep-story-item:last-child{border-bottom:none;padding-bottom:0;}
  .ep-story-thumb{width:56px;height:56px;border-radius:9px;object-fit:cover;flex:none;background:var(--bg-soft);display:block;}
  .ep-story-cat{font-size:10.5px;color:var(--accent);font-weight:700;text-transform:uppercase;letter-spacing:0.03em;margin-bottom:2px;}
  .ep-story-title{font-size:13px;font-weight:500;line-height:1.35;}
  .ep-story-title:hover{color:var(--accent);}

  .ep-sidebar-card{background:var(--bg-soft);border:1px solid var(--line);border-radius:var(--radius);padding:20px;}
  .ep-sidebar-card.ep-reviewer-card{text-align:center;}
  .ep-sidebar-card.ep-reviewer-card img{width:64px;height:64px;border-radius:50%;object-fit:cover;margin:0 auto 12px;display:block;background:var(--accent-soft);overflow:hidden;}
  .ep-sidebar-card.ep-reviewer-card h4{font-size:15px;margin:0 0 4px;}
  .ep-sidebar-card.ep-reviewer-card .ep-role{font-size:12px;color:var(--accent);font-weight:600;margin-bottom:10px;}
  .ep-sidebar-card.ep-reviewer-card p{font-size:12.5px;color:var(--muted);margin:0 0 14px;}
  .ep-sidebar-card.ep-reviewer-card a{font-size:12.5px;font-weight:600;color:var(--accent);}

  .ep-newsletter-card{background:var(--accent-dark);border-radius:var(--radius);padding:24px 20px;color:#fff;}
  .ep-newsletter-card h4{margin:0 0 8px;font-size:15.5px;}
  .ep-newsletter-card p{font-size:12.5px;color:#cfe3da;margin:0 0 14px;}
  .ep-newsletter-card .ep-btn-fill{background:#fff;color:var(--accent-dark)!important;width:100%;text-align:center;display:block;}
  .ep-newsletter-card .ep-btn-fill:hover{background:#f1f1f1;}

  @media(max-width:980px){
    .ep-sidebar{flex-direction:row;flex-wrap:wrap;}
    .ep-widget{flex:1 1 280px;}
  }

  /* ============ FOOTER ============ */
  .ep-site-footer{background:var(--bg-soft);border-top:1px solid var(--line);margin-top:20px;}
  .ep-footer-wrap{max-width:var(--maxw);margin:0 auto;padding:48px 24px 28px;}
  .ep-footer-top{display:grid;grid-template-columns:1.6fr 1fr 1fr 1fr;gap:36px;margin-bottom:36px;}
  @media(max-width:800px){.ep-footer-top{grid-template-columns:1fr 1fr;}}
  .ep-footer-brand .ep-logo{margin-bottom:14px;}
  .ep-footer-brand p{font-size:13.5px;color:var(--muted);max-width:280px;}
  .ep-footer-col h5{font-size:12.5px;text-transform:uppercase;letter-spacing:0.04em;color:var(--ink);margin:0 0 14px;}
  .ep-footer-col ul{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:10px;}
  .ep-footer-col a{font-size:13.5px;color:var(--muted);}
  .ep-footer-col a:hover{color:var(--accent);}
  .ep-footer-stats{display:flex;flex-wrap:wrap;gap:24px;border-top:1px solid var(--line);padding-top:22px;margin-bottom:18px;font-size:13px;color:var(--muted);}
  .ep-footer-stats strong{color:var(--ink);}
  .ep-footer-bottom{font-size:12.5px;color:var(--muted);border-top:1px solid var(--line);padding-top:18px;}
</style>
</head>
<body <?php body_class(); ?>>

<!-- ============ TOP NAV ============ -->
<header class="ep-site-header">
  <div class="ep-nav-wrap">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="ep-logo">
      <span class="ep-logo-mark">+</span>
      <?php bloginfo('name'); ?>
    </a>
    <ul class="ep-primary-nav">
      <?php
      $nav_items = [
        'Nutrition'        => '/nutrition/',
        'Mental Wellness'  => '/mental-wellness/',
        'Preventive Health'=> '/preventive-health/',
        'Fitness'          => '/fitness/',
        'Skin Care'        => '/skin-care/',
      ];
      foreach ($nav_items as $label => $path) {
        echo '<li><a href="' . esc_url(home_url($path)) . '">' . esc_html($label) . '</a></li>';
      }
      ?>
    </ul>
    <div class="ep-nav-right">
      <a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a>
      <a href="<?php echo esc_url(home_url('/blog')); ?>" class="ep-btn-outline">All Articles</a>
    </div>
  </div>
</header>

<!-- ============ BREADCRUMB ============ -->
<div class="ep-breadcrumb-strip">
  <div class="ep-breadcrumb-wrap">
    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> &nbsp;/&nbsp; Editorial Policy
  </div>
</div>

<!-- ============ PAGE BODY ============ -->
<div class="ep-page-wrap">

  <!-- ============ MAIN COLUMN ============ -->
  <main class="ep-main-col">

    <div class="ep-policy-hero">
      <span class="ep-eyebrow">⚕ Editorial Standards</span>
      <h1>Our Editorial Policy</h1>
      <p class="ep-lede">
        Health Beyond Age exists to help people make informed decisions about their health.
        That only works if you can trust what you read here. This page explains exactly how
        our content gets made — from research to fact-checking to medical review — so you
        always know what's behind the advice.
      </p>
      <div class="ep-meta-row">
        <span>📅 Last updated: June 2026</span>
        <span>🔄 Reviewed annually, or sooner if guidelines change</span>
      </div>
    </div>

    <!-- COMMITMENT -->
    <div class="ep-section">
      <h2>Our Commitment to You</h2>
      <p>
        Every article published on Health Beyond Age is written or reviewed by someone with
        relevant clinical training, lived professional expertise, or a research background in
        the topic at hand. We are not a content farm repackaging other websites — every piece
        starts from primary sources and clinical guidelines, and is shaped by people who
        understand the subject matter firsthand.
      </p>
      <p>
        We accept that health information evolves. Where the science shifts, we update our
        articles to reflect it. Where something is uncertain or debated, we say so rather than
        presenting a single confident answer that doesn't exist yet.
      </p>
      <div class="ep-card-grid">
        <div class="ep-pcard"><span class="ep-pcard-num">01</span><h3>Expert-led</h3><p>Every article is written or reviewed by a credentialed health professional.</p></div>
        <div class="ep-pcard"><span class="ep-pcard-num">02</span><h3>Source-first</h3><p>Claims are built on peer-reviewed research and recognized clinical guidelines.</p></div>
        <div class="ep-pcard"><span class="ep-pcard-num">03</span><h3>Independently reviewed</h3><p>No article publishes without a medical reviewer checking it for accuracy.</p></div>
        <div class="ep-pcard"><span class="ep-pcard-num">04</span><h3>Kept current</h3><p>Content is revisited at least annually and updated as guidance changes.</p></div>
      </div>
    </div>

    <!-- RESEARCH -->
    <div class="ep-section">
      <h2>How We Research Our Content</h2>
      <p class="ep-section-sub">What happens before a single word gets written</p>
      <p>
        Topics are chosen because they're genuinely useful — common questions our readers ask,
        conditions that affect people as they age, or areas where misinformation tends to
        spread. From there, every article follows the same research backbone:
      </p>
      <div class="ep-steps">
        <div class="ep-step">
          <h3>Start with primary literature</h3>
          <p>Writers begin with peer-reviewed studies, systematic reviews, and meta-analyses rather than secondary blog summaries. If a claim can be traced to a single study, we note its limitations rather than treating it as settled fact.</p>
        </div>
        <div class="ep-step">
          <h3>Cross-check against clinical guidelines</h3>
          <p>We compare findings against guidance from major health authorities and medical associations relevant to the topic — for example, cardiology guidance for heart health content, or endocrinology guidance for diabetes content.</p>
        </div>
        <div class="ep-step">
          <h3>Apply professional, hands-on expertise</h3>
          <p>Many of our writers are practicing clinicians, registered dietitians, or certified specialists in their field. They bring real-world clinical context that a literature review alone can't provide.</p>
        </div>
        <div class="ep-step">
          <h3>Write for clarity, not just accuracy</h3>
          <p>Being correct isn't enough if no one can use the information. Drafts are written in plain language, with technical terms explained, so the guidance is genuinely actionable.</p>
        </div>
      </div>
    </div>

    <!-- FACT-CHECKING -->
    <div class="ep-section">
      <h2>Our Fact-Checking Process</h2>
      <p class="ep-section-sub">Nothing publishes on a single person's word</p>
      <p>Every factual claim — statistics, study findings, drug or supplement interactions, symptom descriptions, treatment recommendations — is checked against its original source before publication. Our fact-checking process includes:</p>
      <div class="ep-table-wrap">
        <table class="ep-policy-table">
          <thead><tr><th>Check</th><th>What it covers</th></tr></thead>
          <tbody>
            <tr><td>Source verification</td><td>Every statistic or study citation is traced back to its original publication, not a secondhand summary.</td></tr>
            <tr><td>Currency check</td><td>We confirm cited research and guidelines are still current, not superseded by more recent findings.</td></tr>
            <tr><td>Context check</td><td>We confirm a study's population, sample size, and limitations are represented accurately — not overstated for effect.</td></tr>
            <tr><td>Internal consistency</td><td>Claims are checked against other published Health Beyond Age content to avoid contradicting guidance elsewhere on the site.</td></tr>
            <tr><td>Medical accuracy</td><td>A qualified reviewer independently confirms the clinical content is correct and appropriately cautious (see below).</td></tr>
          </tbody>
        </table>
      </div>
      <div class="ep-callout">
        <h3>What we won't publish</h3>
        <p>We don't publish unverified claims, anecdotal "cures," exaggerated supplement or product benefits, or advice that contradicts established medical guidance. If a topic is genuinely unsettled in the research, our articles reflect that uncertainty rather than picking a side for the sake of a confident headline.</p>
      </div>
    </div>

    <!-- SOURCES -->
    <div class="ep-section">
      <h2>The Sources We Use</h2>
      <p class="ep-section-sub">Where our information actually comes from</p>
      <p>We prioritize primary and authoritative sources over secondary reporting. Depending on the topic, our writers and reviewers draw on:</p>
      <ul class="ep-source-list">
        <li><span class="ep-source-tag">Research</span> Peer-reviewed journals indexed in databases such as PubMed, Cochrane Library, and major specialty journals (e.g. JAMA, The Lancet, Diabetes Care)</li>
        <li><span class="ep-source-tag">Guidelines</span> Clinical practice guidelines from recognized medical bodies and specialty associations relevant to each topic (cardiology, endocrinology, dermatology, psychiatry, and so on)</li>
        <li><span class="ep-source-tag">Public Health</span> Data and guidance from national and international public health agencies</li>
        <li><span class="ep-source-tag">Clinical Expertise</span> Direct input from our physicians, registered dietitians, and certified specialists, drawn from their own practice</li>
        <li><span class="ep-source-tag">Reference Texts</span> Established clinical reference resources used in medical and allied health education</li>
      </ul>
      <p>We do not rely on user-generated content, unverified forum posts, manufacturer marketing claims, or other blogs as primary sources. Where we reference another publication's reporting for context, we link to it transparently and never present it as original research.</p>
    </div>

    <!-- MEDICAL REVIEW -->
    <div class="ep-section">
      <h2>Our Medical Review Process</h2>
      <p class="ep-section-sub">The final check before anything goes live</p>
      <p>All health and medical content on this site is reviewed by a qualified professional before publication — separate from the person who wrote it. This separation matters: it means every article gets an independent second opinion from someone with the clinical background to catch errors a writer might miss.</p>
      <div class="ep-reviewer-row">
        <img src="http://healthbeyondage.com/wp-content/uploads/2026/06/WhatsApp-Image-2026-06-10-at-12.55.05-PM.jpeg" alt="Dr. Sarah Matheson">
        <div>
          <div class="ep-rname">Dr. Sarah Matheson, MBChB, MRCGP</div>
          <div class="ep-rrole">Lead Medical Reviewer · Internal Medicine, Preventive Health &amp; Healthy Aging</div>
        </div>
      </div>
      <p style="margin-top:20px;">
        Our review team also includes physicians and specialists who review content within their own area of expertise — for example, our dermatology content is reviewed by a board-certified dermatologist, and our nutrition content is reviewed by a registered dietitian or physician with nutrition expertise. You can see our full reviewer team, credentials, and specialties on our <a href="<?php echo esc_url(home_url('/team')); ?>" style="color:var(--accent);font-weight:600;">Meet the Team</a> page.
      </p>
      <p>A medical review checks that an article:</p>
      <ul class="ep-plain">
        <li>States clinical information accurately and without exaggeration</li>
        <li>Reflects current, mainstream medical consensus, not a fringe or outdated view</li>
        <li>Includes appropriate caution around symptoms, treatments, or supplements that warrant a doctor's involvement</li>
        <li>Doesn't omit risks, side effects, or contraindications relevant to the topic</li>
      </ul>
      <p>Articles that pass review carry a <strong>"Medically Reviewed"</strong> label along with the reviewer's name, visible on the article itself.</p>
    </div>

    <!-- UPDATES -->
    <div class="ep-section">
      <h2>Updates and Corrections</h2>
      <p>Medical understanding changes, and so does our content. Articles are scheduled for re-review at least once a year, and sooner if relevant clinical guidelines are updated or new research meaningfully changes the picture. When we make a substantive update to an article's medical content, we note the revised date on the page.</p>
      <p>If you believe something we've published is inaccurate or out of date, we want to know. Every correction request is reviewed by a member of our medical team before any change is made, and where a correction is warranted, we make it promptly.</p>
    </div>

    <!-- WHAT THIS SITE IS / ISN'T -->
    <div class="ep-section">
      <h2>What This Site Is — and Isn't</h2>
      <div class="ep-faq-item">
        <h3>This is educational content, not personal medical advice</h3>
        <p>Our articles are written to inform, not to diagnose or treat any individual. They can't account for your specific medical history, medications, or circumstances. Always talk to a qualified healthcare provider about your own health decisions. See our <a href="<?php echo esc_url(home_url('/medical-disclaimer')); ?>" style="color:var(--accent);font-weight:600;">Medical Disclaimer</a> for full details.</p>
      </div>
      <div class="ep-faq-item">
        <h3>Advertising never influences editorial content</h3>
        <p>Health Beyond Age may earn revenue through advertising or affiliate partnerships. These relationships never determine what we write about or what conclusions an article reaches. Our writers and medical reviewers do not receive payment from product or supplement companies in exchange for favorable coverage.</p>
      </div>
      <div class="ep-faq-item">
        <h3>Sponsored content is always labeled</h3>
        <p>In the rare case we publish sponsored content, it is clearly labeled as such and still subject to the same factual accuracy standards as the rest of the site.</p>
      </div>
    </div>

    <div class="ep-contact-box">
      <h2>Questions About Our Editorial Process?</h2>
      <p>We're glad to explain how a specific article was researched or reviewed, or to hear about a correction you think we should make.</p>
      <a class="ep-btn-fill" href="<?php echo esc_url(home_url('/contact')); ?>">Contact Our Editorial Team</a>
    </div>

  </main>

  <!-- ============ SIDEBAR ============ -->
  <aside class="ep-sidebar">

    <!-- Trending -->
    <div class="ep-widget">
      <div class="ep-widget-title"><span class="ep-dot"></span> 🔥 Trending Articles</div>
      <div>
        <?php
        $trending = new WP_Query(['posts_per_page' => 5, 'orderby' => 'comment_count', 'order' => 'DESC', 'post_status' => 'publish']);
        $rank = 1;
        if ($trending->have_posts()) : while ($trending->have_posts()) : $trending->the_post();
          $tcat = get_the_category();
          $tcat_name = !empty($tcat) ? $tcat[0]->name : 'Health';
        ?>
        <div class="ep-trend-item">
          <div class="ep-trend-rank"><?php echo $rank++; ?></div>
          <div>
            <div class="ep-trend-meta"><?php echo esc_html($tcat_name); ?></div>
            <a class="ep-trend-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <div class="ep-trend-sub"><?php echo function_exists('hba_reading_time') ? esc_html(hba_reading_time(get_the_ID())) : '5 min read'; ?></div>
          </div>
        </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
    </div>

    <!-- Browse by Topic -->
    <div class="ep-widget">
      <div class="ep-widget-title"><span class="ep-dot"></span> Browse by Topic</div>
      <div class="ep-topic-pills">
        <?php
        $topic_cats = get_categories(['hide_empty' => true, 'number' => 15]);
        foreach ($topic_cats as $tc) {
          echo '<a href="' . esc_url(get_category_link($tc->term_id)) . '">' . esc_html($tc->name) . '</a>';
        }
        ?>
      </div>
    </div>

    <!-- Top Stories -->
    <div class="ep-widget">
      <div class="ep-widget-title"><span class="ep-dot"></span> 📖 Top Stories</div>
      <div>
        <?php
        $top_stories = new WP_Query(['posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish']);
        if ($top_stories->have_posts()) : while ($top_stories->have_posts()) : $top_stories->the_post();
          $scat = get_the_category();
          $scat_name = !empty($scat) ? $scat[0]->name : 'Health';
          $thumb = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
        ?>
        <div class="ep-story-item">
          <img class="ep-story-thumb" src="<?php echo $thumb ? esc_url($thumb) : 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=100&q=80'; ?>" alt="">
          <div>
            <div class="ep-story-cat"><?php echo esc_html($scat_name); ?></div>
            <a class="ep-story-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </div>
        </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
    </div>

    <!-- Reviewer Card -->
    <div class="ep-widget">
      <div class="ep-sidebar-card ep-reviewer-card">
        <img src="http://healthbeyondage.com/wp-content/uploads/2026/06/WhatsApp-Image-2026-06-10-at-12.55.05-PM.jpeg" alt="Dr. Sarah Matheson">
        <h4>Dr. Sarah Matheson</h4>
        <div class="ep-role">Lead Medical Reviewer</div>
        <p>Board-certified in internal medicine, with 18 years overseeing medical review at Health Beyond Age.</p>
        <a href="<?php echo esc_url(home_url('/team')); ?>">View Full Profile →</a>
      </div>
    </div>

    <!-- Newsletter -->
    <div class="ep-widget">
      <div class="ep-newsletter-card">
        <h4>✦ Stay Ahead of Your Health</h4>
        <p>Expert-curated wellness insights, delivered every Friday. No noise, no spam.</p>
        <a class="ep-btn-fill" href="<?php echo esc_url(home_url('/#subscribe')); ?>">Subscribe Free</a>
      </div>
    </div>

  </aside>

</div>

<!-- ============ FOOTER ============ -->
<footer class="ep-site-footer">
  <div class="ep-footer-wrap">
    <div class="ep-footer-top">

      <div class="ep-footer-brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="ep-logo">
          <span class="ep-logo-mark">+</span><?php bloginfo('name'); ?>
        </a>
        <p>Evidence-based health information to help you make informed choices and live a longer, healthier life.</p>
      </div>

      <div class="ep-footer-col">
        <h5>Categories</h5>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/fitness/')); ?>">Fitness</a></li>
          <li><a href="<?php echo esc_url(home_url('/heart-health/')); ?>">Heart Health</a></li>
          <li><a href="<?php echo esc_url(home_url('/mental-wellness/')); ?>">Mental Wellness</a></li>
          <li><a href="<?php echo esc_url(home_url('/nutrition/')); ?>">Nutrition</a></li>
          <li><a href="<?php echo esc_url(home_url('/preventive-health/')); ?>">Preventive Health</a></li>
          <li><a href="<?php echo esc_url(home_url('/skin-care/')); ?>">Skin Care</a></li>
        </ul>
      </div>

      <div class="ep-footer-col">
        <h5>Company</h5>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a></li>
          <li><a href="<?php echo esc_url(home_url('/team')); ?>">Meet Our Team</a></li>
          <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a></li>
          <li><a href="<?php echo esc_url(home_url('/blog')); ?>">All Articles</a></li>
          <li><a href="<?php echo esc_url(home_url('/trending')); ?>">Trending</a></li>
        </ul>
      </div>

      <div class="ep-footer-col">
        <h5>Legal</h5>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a></li>
          <li><a href="<?php echo esc_url(home_url('/terms-of-use')); ?>">Terms of Use</a></li>
          <li><a href="<?php echo esc_url(home_url('/medical-disclaimer')); ?>">Medical Disclaimer</a></li>
          <li><a href="<?php echo esc_url(home_url('/cookie-policy')); ?>">Cookie Policy</a></li>
          <li><a href="<?php echo esc_url(home_url('/editorial-policy')); ?>" style="font-weight:600;color:var(--accent);">Editorial Policy</a></li>
        </ul>
      </div>

    </div>
    <div class="ep-footer-stats">
      <span><strong>5</strong> Health Categories</span>
      <span><strong>100%</strong> Medically Reviewed</span>
      <span><strong>Since 2021</strong> Publishing</span>
    </div>
    <div class="ep-footer-bottom">&copy; <?php echo date('Y'); ?> Health Beyond Age. All rights reserved.</div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
