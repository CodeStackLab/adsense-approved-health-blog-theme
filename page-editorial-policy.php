<?php
/**
 * Template Name: Editorial Policy
 */
get_header(); ?>

<style>
/* Editorial Policy specific styles */

  .page-wrap{max-width:var(--maxw);margin:0 auto;padding:0 24px 64px;display:grid;grid-template-columns:1fr 320px;gap:48px;}
  @media (max-width:980px){
    .page-wrap{grid-template-columns:1fr;}
  }

  .main-col{min-width:0;}

  /* ============ HERO ============ */
  .policy-hero{padding:44px 0 30px;border-bottom:1px solid var(--line);margin-bottom:38px;}
  .eyebrow{display:inline-flex;align-items:center;gap:8px;font-size:12.5px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:var(--accent);background:var(--accent-soft);padding:6px 14px;border-radius:999px;margin-bottom:18px;}
  .policy-hero h1{font-size:clamp(28px,4vw,38px);line-height:1.15;margin:0 0 14px;letter-spacing:-0.01em;}
  .policy-hero p.lede{font-size:17.5px;color:var(--muted);max-width:600px;margin:0 0 20px;}
  .meta-row{display:flex;flex-wrap:wrap;gap:18px;font-size:13.5px;color:var(--muted);}
  .meta-row span{display:inline-flex;align-items:center;gap:6px;}

  /* ============ CONTENT SECTIONS ============ */
  .section{margin:42px 0;}
  .section h2{font-size:22px;margin:0 0 8px;letter-spacing:-0.01em;}
  .section .section-sub{color:var(--muted);font-size:14.5px;margin:0 0 20px;}
  .section p{margin:0 0 16px;font-size:15.5px;}

  .card-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:14px;margin:20px 0;}
  .pcard{background:var(--bg-soft);border:1px solid var(--line);border-radius:var(--radius);padding:18px 18px 16px;}
  .pcard .pcard-num{font-size:11.5px;font-weight:700;color:var(--accent);letter-spacing:0.05em;margin-bottom:8px;display:block;}
  .pcard h3{font-size:15.5px;margin:0 0 8px;}
  .pcard p{font-size:14px;color:var(--muted);margin:0;}

  .steps{border-left:2px solid var(--line);margin:22px 0 22px 6px;padding-left:26px;}
  .step{position:relative;padding-bottom:26px;}
  .step:last-child{padding-bottom:0;}
  .step::before{content:"";position:absolute;left:-33px;top:2px;width:14px;height:14px;border-radius:50%;background:var(--accent);border:3px solid #fff;box-shadow:0 0 0 1px var(--line);}
  .step h3{font-size:16px;margin:0 0 6px;}
  .step p{font-size:14.5px;color:var(--muted);margin:0;}

  .table-wrap{overflow-x:auto;margin:18px 0;border:1px solid var(--line);border-radius:var(--radius);}
  table.policy-table{width:100%;border-collapse:collapse;font-size:14px;}
  table.policy-table th,table.policy-table td{text-align:left;padding:12px 14px;border-bottom:1px solid var(--line);vertical-align:top;}
  table.policy-table tr:last-child td{border-bottom:none;}
  table.policy-table th{background:var(--bg-soft);font-weight:600;font-size:12.5px;text-transform:uppercase;letter-spacing:0.03em;color:var(--muted);}

  .source-list{list-style:none;margin:16px 0;padding:0;display:grid;gap:9px;}
  .source-list li{display:flex;gap:12px;align-items:flex-start;font-size:14.5px;background:#fff;border:1px solid var(--line);border-radius:10px;padding:11px 14px;}
  .source-tag{flex:none;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;color:var(--accent);background:var(--accent-soft);border-radius:6px;padding:3px 8px;margin-top:1px;}

  .callout{background:var(--accent-soft);border:1px solid #cfe3da;border-radius:var(--radius);padding:20px 22px;margin:22px 0;}
  .callout h3{margin:0 0 8px;font-size:15.5px;}
  .callout p{margin:0;font-size:14.5px;}

  .reviewer-row{display:flex;align-items:center;gap:14px;margin-top:14px;}
  .reviewer-row img{width:50px;height:50px;border-radius:50%;object-fit:cover;flex:none;display:block;background:var(--accent-soft);overflow:hidden;font-size:0;color:transparent;}
  .reviewer-row .rname{font-weight:600;font-size:14px;}
  .reviewer-row .rrole{font-size:12.5px;color:var(--muted);}

  ul.plain{margin:0 0 16px;padding-left:20px;}
  ul.plain li{margin-bottom:8px;font-size:14.5px;}

  .faq-item{border:1px solid var(--line);border-radius:10px;padding:15px 17px;margin-bottom:11px;}
  .faq-item h3{font-size:15px;margin:0 0 6px;}
  .faq-item p{font-size:14px;color:var(--muted);margin:0;}

  .contact-box{text-align:center;border:1px solid var(--line);border-radius:var(--radius);padding:34px 24px;margin-top:46px;background:linear-gradient(180deg,var(--bg-soft),#fff);}
  .contact-box h2{margin:0 0 10px;font-size:21px;}
  .contact-box p{color:var(--muted);margin:0 0 18px;font-size:14.5px;}
  .btn-fill{display:inline-block;background:var(--accent);color:#fff!important;font-weight:600;font-size:14.5px;padding:11px 24px;border-radius:999px;}
  .btn-fill:hover{background:var(--accent-dark);}

  /* ============ SIDEBAR ============ */
  .sidebar{display:flex;flex-direction:column;gap:30px;padding-top:6px;}
  .widget{}
  .widget-title{display:flex;align-items:center;gap:7px;font-size:14px;font-weight:700;text-transform:uppercase;letter-spacing:0.04em;color:var(--ink);margin:0 0 16px;}
  .widget-title .dot{width:7px;height:7px;border-radius:50%;background:var(--accent);}

  .trend-item{display:flex;gap:12px;padding:11px 0;border-bottom:1px solid var(--line);}
  .trend-item:last-child{border-bottom:none;padding-bottom:0;}
  .trend-rank{flex:none;width:24px;height:24px;border-radius:50%;background:var(--bg-soft);color:var(--accent);font-size:12px;font-weight:700;display:flex;align-items:center;justify-content:center;}
  .trend-meta{font-size:11px;color:var(--accent);font-weight:600;text-transform:uppercase;letter-spacing:0.03em;margin-bottom:3px;}
  .trend-title{font-size:13.5px;font-weight:500;line-height:1.4;color:var(--ink);}
  .trend-title:hover{color:var(--accent);}
  .trend-sub{font-size:11.5px;color:var(--muted);margin-top:3px;}

  .topic-pills{display:flex;flex-wrap:wrap;gap:8px;}
  .topic-pills a{font-size:13px;font-weight:500;border:1px solid var(--line);border-radius:999px;padding:7px 13px;color:var(--ink);}
  .topic-pills a:hover{border-color:var(--accent);color:var(--accent);background:var(--accent-soft);}

  .story-item{display:flex;gap:10px;align-items:flex-start;padding:10px 0;border-bottom:1px solid var(--line);}
  .story-item:last-child{border-bottom:none;padding-bottom:0;}
  .story-thumb{width:56px;height:56px;border-radius:9px;object-fit:cover;flex:none;background:var(--bg-soft);display:block;}
  .story-cat{font-size:10.5px;color:var(--accent);font-weight:700;text-transform:uppercase;letter-spacing:0.03em;margin-bottom:2px;}
  .story-title{font-size:13px;font-weight:500;line-height:1.35;}
  .story-title:hover{color:var(--accent);}

  .sidebar-card{background:var(--bg-soft);border:1px solid var(--line);border-radius:var(--radius);padding:20px;}
  .sidebar-card.reviewer-card{text-align:center;}
  .sidebar-card.reviewer-card img{width:64px;height:64px;border-radius:50%;object-fit:cover;margin:0 auto 12px;display:block;background:var(--accent-soft);overflow:hidden;font-size:0;color:transparent;}
  .sidebar-card.reviewer-card h4{font-size:15px;margin:0 0 4px;}
  .sidebar-card.reviewer-card .role{font-size:12px;color:var(--accent);font-weight:600;margin-bottom:10px;}
  .sidebar-card.reviewer-card p{font-size:12.5px;color:var(--muted);margin:0 0 14px;}
  .sidebar-card.reviewer-card a{font-size:12.5px;font-weight:600;color:var(--accent);}

  .newsletter-card{background:var(--accent-dark);border-radius:var(--radius);padding:24px 20px;color:#fff;}
  .newsletter-card h4{margin:0 0 8px;font-size:15.5px;}
  .newsletter-card p{font-size:12.5px;color:#cfe3da;margin:0 0 14px;}
  .newsletter-card .btn-fill{background:#fff;color:var(--accent-dark)!important;width:100%;text-align:center;}
  .newsletter-card .btn-fill:hover{background:#f1f1f1;}

  @media (max-width:980px){
    .sidebar{flex-direction:row;flex-wrap:wrap;}
    .widget{flex:1 1 280px;}
  }

  
</style>

<div class="breadcrumb"><div class="breadcrumb-inner"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="sep">›</span><span>Editorial Policy</span></div></div>


<div class="page-wrap">

  <!-- ============ MAIN COLUMN ============ -->
  <main class="main-col">

    <div class="policy-hero">
      <span class="eyebrow">âš• Editorial Standards</span>
      <h1>Our Editorial Policy</h1>
      <p class="lede">
        Health Beyond Age exists to help people make informed decisions about their health.
        That only works if you can trust what you read here. This page explains exactly how
        our content gets made â€” from research to fact-checking to medical review â€” so you
        always know what's behind the advice.
      </p>
      <div class="meta-row">
        <span>ðŸ“… Last updated: June 2026</span>
        <span>ðŸ”„ Reviewed annually, or sooner if guidelines change</span>
      </div>
    </div>

    <!-- COMMITMENT -->
    <div class="section">
      <h2>Our Commitment to You</h2>
      <p>
        Every article published on Health Beyond Age is written or reviewed by someone with
        relevant clinical training, lived professional expertise, or a research background in
        the topic at hand. We are not a content farm repackaging other websites â€” every piece
        starts from primary sources and clinical guidelines, and is shaped by people who
        understand the subject matter firsthand.
      </p>
      <p>
        We accept that health information evolves. Where the science shifts, we update our
        articles to reflect it. Where something is uncertain or debated, we say so rather than
        presenting a single confident answer that doesn't exist yet.
      </p>

      <div class="card-grid">
        <div class="pcard">
          <span class="pcard-num">01</span>
          <h3>Expert-led</h3>
          <p>Every article is written or reviewed by a credentialed health professional.</p>
        </div>
        <div class="pcard">
          <span class="pcard-num">02</span>
          <h3>Source-first</h3>
          <p>Claims are built on peer-reviewed research and recognized clinical guidelines.</p>
        </div>
        <div class="pcard">
          <span class="pcard-num">03</span>
          <h3>Independently reviewed</h3>
          <p>No article publishes without a medical reviewer checking it for accuracy.</p>
        </div>
        <div class="pcard">
          <span class="pcard-num">04</span>
          <h3>Kept current</h3>
          <p>Content is revisited at least annually and updated as guidance changes.</p>
        </div>
      </div>
    </div>

    <!-- RESEARCH -->
    <div class="section">
      <h2>How We Research Our Content</h2>
      <p class="section-sub">What happens before a single word gets written</p>
      <p>
        Topics are chosen because they're genuinely useful â€” common questions our readers ask,
        conditions that affect people as they age, or areas where misinformation tends to
        spread. From there, every article follows the same research backbone:
      </p>

      <div class="steps">
        <div class="step">
          <h3>Start with primary literature</h3>
          <p>
            Writers begin with peer-reviewed studies, systematic reviews, and meta-analyses
            rather than secondary blog summaries. If a claim can be traced to a single study,
            we note its limitations rather than treating it as settled fact.
          </p>
        </div>
        <div class="step">
          <h3>Cross-check against clinical guidelines</h3>
          <p>
            We compare findings against guidance from major health authorities and medical
            associations relevant to the topic â€” for example, cardiology guidance for heart
            health content, or endocrinology guidance for diabetes content.
          </p>
        </div>
        <div class="step">
          <h3>Apply professional, hands-on expertise</h3>
          <p>
            Many of our writers are practicing clinicians, registered dietitians, or certified
            specialists in their field. They bring real-world clinical context that a
            literature review alone can't provide.
          </p>
        </div>
        <div class="step">
          <h3>Write for clarity, not just accuracy</h3>
          <p>
            Being correct isn't enough if no one can use the information. Drafts are written
            in plain language, with technical terms explained, so the guidance is genuinely
            actionable.
          </p>
        </div>
      </div>
    </div>

    <!-- FACT-CHECKING -->
    <div class="section">
      <h2>Our Fact-Checking Process</h2>
      <p class="section-sub">Nothing publishes on a single person's word</p>
      <p>
        Every factual claim â€” statistics, study findings, drug or supplement interactions,
        symptom descriptions, treatment recommendations â€” is checked against its original
        source before publication. Our fact-checking process includes:
      </p>

      <div class="table-wrap">
        <table class="policy-table">
          <thead>
            <tr><th>Check</th><th>What it covers</th></tr>
          </thead>
          <tbody>
            <tr><td>Source verification</td><td>Every statistic or study citation is traced back to its original publication, not a secondhand summary.</td></tr>
            <tr><td>Currency check</td><td>We confirm cited research and guidelines are still current, not superseded by more recent findings.</td></tr>
            <tr><td>Context check</td><td>We confirm a study's population, sample size, and limitations are represented accurately â€” not overstated for effect.</td></tr>
            <tr><td>Internal consistency</td><td>Claims are checked against other published Health Beyond Age content to avoid contradicting guidance elsewhere on the site.</td></tr>
            <tr><td>Medical accuracy</td><td>A qualified reviewer independently confirms the clinical content is correct and appropriately cautious (see below).</td></tr>
          </tbody>
        </table>
      </div>

      <div class="callout">
        <h3>What we won't publish</h3>
        <p>
          We don't publish unverified claims, anecdotal "cures," exaggerated supplement or
          product benefits, or advice that contradicts established medical guidance. If a
          topic is genuinely unsettled in the research, our articles reflect that uncertainty
          rather than picking a side for the sake of a confident headline.
        </p>
      </div>
    </div>

    <!-- SOURCES -->
    <div class="section">
      <h2>The Sources We Use</h2>
      <p class="section-sub">Where our information actually comes from</p>
      <p>
        We prioritize primary and authoritative sources over secondary reporting. Depending on
        the topic, our writers and reviewers draw on:
      </p>

      <ul class="source-list">
        <li><span class="source-tag">Research</span> Peer-reviewed journals indexed in databases such as PubMed, Cochrane Library, and major specialty journals (e.g. JAMA, The Lancet, Diabetes Care)</li>
        <li><span class="source-tag">Guidelines</span> Clinical practice guidelines from recognized medical bodies and specialty associations relevant to each topic (cardiology, endocrinology, dermatology, psychiatry, and so on)</li>
        <li><span class="source-tag">Public Health</span> Data and guidance from national and international public health agencies</li>
        <li><span class="source-tag">Clinical Expertise</span> Direct input from our physicians, registered dietitians, and certified specialists, drawn from their own practice</li>
        <li><span class="source-tag">Reference Texts</span> Established clinical reference resources used in medical and allied health education</li>
      </ul>

      <p>
        We do not rely on user-generated content, unverified forum posts, manufacturer
        marketing claims, or other blogs as primary sources. Where we reference another
        publication's reporting for context, we link to it transparently and never present it
        as original research.
      </p>
    </div>

    <!-- MEDICAL REVIEW -->
    <div class="section">
      <h2>Our Medical Review Process</h2>
      <p class="section-sub">The final check before anything goes live</p>
      <p>
        All health and medical content on this site is reviewed by a qualified professional
        before publication â€” separate from the person who wrote it. This separation matters:
        it means every article gets an independent second opinion from someone with the
        clinical background to catch errors a writer might miss.
      </p>

      <div class="reviewer-row">
        <img src="http://healthbeyondage.com/wp-content/uploads/2026/06/WhatsApp-Image-2026-06-10-at-12.55.05-PM.jpeg" alt="Dr. Sarah Matheson">
        <div>
          <div class="rname">Dr. Sarah Matheson, MBChB, MRCGP</div>
          <div class="rrole">Lead Medical Reviewer Â· Internal Medicine, Preventive Health &amp; Healthy Aging</div>
        </div>
      </div>

      <p style="margin-top:20px;">
        Our review team also includes physicians and specialists who review content within
        their own area of expertise â€” for example, our dermatology content is reviewed by a
        board-certified dermatologist, and our nutrition content is reviewed by a registered
        dietitian or physician with nutrition expertise. You can see our full reviewer team,
        credentials, and specialties on our <a href="https://healthbeyondage.com/team" style="color:var(--accent);font-weight:600;">Meet the Team</a> page.
      </p>

      <p>A medical review checks that an article:</p>
      <ul class="plain">
        <li>States clinical information accurately and without exaggeration</li>
        <li>Reflects current, mainstream medical consensus, not a fringe or outdated view</li>
        <li>Includes appropriate caution around symptoms, treatments, or supplements that warrant a doctor's involvement</li>
        <li>Doesn't omit risks, side effects, or contraindications relevant to the topic</li>
      </ul>

      <p>
        Articles that pass review carry a <strong>"Medically Reviewed"</strong> label along
        with the reviewer's name, visible on the article itself.
      </p>
    </div>

    <!-- UPDATES -->
    <div class="section">
      <h2>Updates and Corrections</h2>
      <p>
        Medical understanding changes, and so does our content. Articles are scheduled for
        re-review at least once a year, and sooner if relevant clinical guidelines are updated
        or new research meaningfully changes the picture. When we make a substantive update to
        an article's medical content, we note the revised date on the page.
      </p>
      <p>
        If you believe something we've published is inaccurate or out of date, we want to
        know. Every correction request is reviewed by a member of our medical team before any
        change is made, and where a correction is warranted, we make it promptly.
      </p>
    </div>

    <!-- WHAT THIS SITE IS / ISN'T -->
    <div class="section">
      <h2>What This Site Is â€” and Isn't</h2>
      <div class="faq-item">
        <h3>This is educational content, not personal medical advice</h3>
        <p>
          Our articles are written to inform, not to diagnose or treat any individual. They
          can't account for your specific medical history, medications, or circumstances.
          Always talk to a qualified healthcare provider about your own health decisions. See
          our <a href="https://healthbeyondage.com/medical-disclaimer" style="color:var(--accent);font-weight:600;">Medical Disclaimer</a> for full details.
        </p>
      </div>
      <div class="faq-item">
        <h3>Advertising never influences editorial content</h3>
        <p>
          Health Beyond Age may earn revenue through advertising or affiliate partnerships.
          These relationships never determine what we write about or what conclusions an
          article reaches. Our writers and medical reviewers do not receive payment from
          product or supplement companies in exchange for favorable coverage.
        </p>
      </div>
      <div class="faq-item">
        <h3>Sponsored content is always labeled</h3>
        <p>
          In the rare case we publish sponsored content, it is clearly labeled as such and
          still subject to the same factual accuracy standards as the rest of the site.
        </p>
      </div>
    </div>

    <div class="contact-box">
      <h2>Questions About Our Editorial Process?</h2>
      <p>We're glad to explain how a specific article was researched or reviewed, or to hear about a correction you think we should make.</p>
      <a class="btn-fill" href="https://healthbeyondage.com/contact">Contact Our Editorial Team</a>
    </div>

  </main>

  <!-- ============ SIDEBAR ============ -->
  <aside class="sidebar">

    <!-- Trending -->
    <div class="widget">
      <div class="widget-title"><span class="dot"></span> ðŸ”¥ Trending Articles</div>
      <div>
        <div class="trend-item">
          <div class="trend-rank">1</div>
          <div>
            <div class="trend-meta">Preventive Health</div>
            <a class="trend-title" href="https://healthbeyondage.com/world-cup-crowd-safety/">World Cup Crowd Safety at Packed Matches</a>
            <div class="trend-sub">9 min read</div>
          </div>
        </div>
        <div class="trend-item">
          <div class="trend-rank">2</div>
          <div>
            <div class="trend-meta">Fitness</div>
            <a class="trend-title" href="https://healthbeyondage.com/brain-health-tips/">Brain Health Basics That Hold Up in 2026</a>
            <div class="trend-sub">8 min read</div>
          </div>
        </div>
        <div class="trend-item">
          <div class="trend-rank">3</div>
          <div>
            <div class="trend-meta">Mental Wellness</div>
            <a class="trend-title" href="https://healthbeyondage.com/foods-for-brain-health/">Foods for Brain Health That Support Memory</a>
            <div class="trend-sub">8 min read</div>
          </div>
        </div>
        <div class="trend-item">
          <div class="trend-rank">4</div>
          <div>
            <div class="trend-meta">Digestive Health</div>
            <a class="trend-title" href="https://healthbeyondage.com/gut-brain-connection/">Gut-Brain Connection Explained in Plain English</a>
            <div class="trend-sub">6 min read</div>
          </div>
        </div>
        <div class="trend-item">
          <div class="trend-rank">5</div>
          <div>
            <div class="trend-meta">Fitness</div>
            <a class="trend-title" href="https://healthbeyondage.com/world-cup-fan-guide/">World Cup Fan Guide for First-Time Travelers</a>
            <div class="trend-sub">8 min read</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Browse by Topic -->
    <div class="widget">
      <div class="widget-title"><span class="dot"></span> Browse by Topic</div>
      <div class="topic-pills">
        <a href="https://healthbeyondage.com/nutrition/">Nutrition</a>
        <a href="https://healthbeyondage.com/heart-health/">Heart Health</a>
        <a href="https://healthbeyondage.com/mental-wellness/">Mental Wellness</a>
        <a href="https://healthbeyondage.com/menopause/">Menopause</a>
        <a href="https://healthbeyondage.com/type-2-diabetes/">Type 2 Diabetes</a>
        <a href="https://healthbeyondage.com/weight-management/">Weight Management</a>
        <a href="https://healthbeyondage.com/sleep-health/">Sleep Health</a>
        <a href="https://healthbeyondage.com/skin-care/">Skin Care</a>
        <a href="https://healthbeyondage.com/fitness/">Fitness &amp; Exercise</a>
        <a href="https://healthbeyondage.com/preventive-health/">Preventive Health</a>
        <a href="https://healthbeyondage.com/digestive-health/">Digestive Health</a>
        <a href="https://healthbeyondage.com/anxiety-depression/">Anxiety &amp; Depression</a>
      </div>
    </div>

    <!-- Top Stories -->
    <div class="widget">
      <div class="widget-title"><span class="dot"></span> ðŸ“– Top Stories</div>
      <div>
        <div class="story-item">
          <img class="story-thumb" src="https://healthbeyondage.com/wp-content/uploads/2026/06/featured-dehydration-signs-treatment-and-when-to-get-help-ad53242b-300x167.jpg" alt="">
          <div>
            <div class="story-cat">Preventive Health</div>
            <a class="story-title" href="https://healthbeyondage.com/dehydration-symptoms-treatment/">Dehydration Signs, Treatment, and When to Get Help</a>
          </div>
        </div>
        <div class="story-item">
          <img class="story-thumb" src="https://healthbeyondage.com/wp-content/uploads/2026/06/featured-foot-pain-causes-relief-and-when-to-get-help-eb845047-300x167.jpg" alt="">
          <div>
            <div class="story-cat">Preventive Health</div>
            <a class="story-title" href="https://healthbeyondage.com/foot-pain/">Foot Pain: Causes, Relief, and When to Get Help</a>
          </div>
        </div>
        <div class="story-item">
          <img class="story-thumb" src="https://healthbeyondage.com/wp-content/uploads/2026/06/senior-woman-examining-calcium-supplement-f717cf60-300x169.jpg" alt="">
          <div>
            <div class="story-cat">Preventive Health</div>
            <a class="story-title" href="https://healthbeyondage.com/calcium-supplements-fracture-prevention/">Do Calcium Supplements Prevent Fractures in Older Adults?</a>
          </div>
        </div>
        <div class="story-item">
          <img class="story-thumb" src="https://healthbeyondage.com/wp-content/uploads/2026/06/featured-the-biggest-stadium-health-risks-for-fifa-fans-813350ac-300x167.jpg" alt="">
          <div>
            <div class="story-cat">Preventive Health</div>
            <a class="story-title" href="https://healthbeyondage.com/stadium-health-risks/">The Biggest Stadium Health Risks for FIFA Fans</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Reviewer card -->
    <div class="widget">
      <div class="sidebar-card reviewer-card">
        <img src="http://healthbeyondage.com/wp-content/uploads/2026/06/WhatsApp-Image-2026-06-10-at-12.55.05-PM.jpeg" alt="Dr. Sarah Matheson">
        <h4>Dr. Sarah Matheson</h4>
        <div class="role">Lead Medical Reviewer</div>
        <p>Board-certified in internal medicine, with 18 years overseeing medical review at Health Beyond Age.</p>
        <a href="https://healthbeyondage.com/team">View Full Profile â†’</a>
      </div>
    </div>

    <!-- Newsletter -->
    <div class="widget">
      <div class="newsletter-card">
        <h4>âœ¦ Stay Ahead of Your Health</h4>
        <p>Expert-curated wellness insights, delivered every Friday. No noise, no spam.</p>
        <a class="btn-fill" href="https://healthbeyondage.com/#subscribe">Subscribe Free</a>
      </div>
    </div>

  </aside>

</div>



<?php get_footer(); ?>

