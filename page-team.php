<?php
/**
 * Template Name: Meet Our Team
 */
get_header();
?>
<!-- TEAM HERO -->
  <section style="background:linear-gradient(135deg,var(--g1) 0%,#074030 100%);padding:4rem 1.5rem;text-align:center">
    <div style="max-width:680px;margin:0 auto" class="fade-up">
      <div style="display:inline-flex;align-items:center;gap:0.5rem;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;padding:0.3rem 1rem;font-size:0.68rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.8);margin-bottom:1.25rem">Our Experts</div>
      <h1 style="font-family:var(--serif);font-size:clamp(1.9rem,3.5vw,3rem);color:#fff;font-weight:700;line-height:1.15;margin-bottom:1rem">Meet the Team Behind<br/>Health Beyond Age</h1>
      <p style="font-size:0.95rem;color:rgba(255,255,255,0.6);line-height:1.8;max-width:560px;margin:0 auto">Every article on this site is shaped by credentialed health professionals — doctors, dietitians, trainers, and researchers committed to accuracy and your wellbeing.</p>
    </div>
    <div style="max-width:420px;margin:2.5rem auto 0;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:16px;padding:1.75rem;display:flex;align-items:center;gap:1.25rem" class="fade-up">
      <div style="width:72px;height:72px;border-radius:50%;overflow:hidden;border:3px solid rgba(255,255,255,0.35);flex-shrink:0">
        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&q=80" alt="Dr. Sarah Matheson" style="width:100%;height:100%;object-fit:cover"/>
      </div>
      <div style="text-align:left">
        <div style="font-size:0.6rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--g4);margin-bottom:0.25rem">Lead Medical Reviewer</div>
        <div style="font-size:0.95rem;font-weight:700;color:#fff;margin-bottom:0.2rem">Dr. Sarah Matheson, MD</div>
        <div style="font-size:0.78rem;color:rgba(255,255,255,0.55)">Internal Medicine · 18 yrs experience</div>
      </div>
    </div>
  </section>

  <!-- MEDICAL REVIEWERS (3 members) -->
  <div style="max-width:1180px;margin:0 auto;padding:3.5rem 1.5rem">
    <div style="font-size:0.65rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--g2);margin-bottom:1.25rem;padding-bottom:0.75rem;border-bottom:2px solid var(--border)">Medical Reviewers &amp; Lead Contributors</div>
    <div class="team-grid" style="margin-bottom:3rem">

      <!-- 1. Dr. Sarah Matheson -->
      <div class="team-card-new fade-up">
        <div class="team-photo-wrap">
          <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=300&q=80" alt="Dr. Sarah Matheson"/>
        </div>
        <div class="team-body">
          <div class="team-badge-role-new">Lead Medical Reviewer</div>
          <h3>Dr. Sarah Matheson</h3>
          <div class="cred">MD, Internal Medicine · 18 yrs</div>
          <p>Board-certified internist specializing in preventive medicine and healthy aging. Dr. Matheson oversees all medical review at Health Beyond Age, ensuring our content reflects current clinical guidelines.</p>
          <div class="team-tags"><span class="team-tag">Preventive Medicine</span><span class="team-tag">Aging</span><span class="team-tag">Cardiovascular</span></div>
        </div>
        <button class="view-profile-btn" onclick="openProfile('sarah')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          View Full Profile
        </button>
      </div>

      <!-- 2. Dr. Amara Osei -->
      <div class="team-card-new fade-up">
        <div class="team-photo-wrap">
          <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=300&q=80" alt="Dr. Amara Osei"/>
        </div>
        <div class="team-body">
          <div class="team-badge-role-new">Medical Reviewer</div>
          <h3>Dr. Amara Osei</h3>
          <div class="cred">MD, Family Medicine · 12 yrs</div>
          <p>Family medicine physician with expertise in nutrition-related conditions and metabolic disease prevention. Dr. Osei contributes primarily to our Nutrition and Preventive Health sections.</p>
          <div class="team-tags"><span class="team-tag">Family Medicine</span><span class="team-tag">Metabolic Health</span><span class="team-tag">Nutrition</span></div>
        </div>
        <button class="view-profile-btn" onclick="openProfile('amara')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          View Full Profile
        </button>
      </div>

      <!-- 3. Dr. Rachel Moore -->
      <div class="team-card-new fade-up">
        <div class="team-photo-wrap">
          <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=300&q=80" alt="Dr. Rachel Moore"/>
        </div>
        <div class="team-body">
          <div class="team-badge-role-new">Dermatology Reviewer</div>
          <h3>Dr. Rachel Moore</h3>
          <div class="cred">MD, Dermatology · 10 yrs</div>
          <p>Board-certified dermatologist focused on cosmetic dermatology and skin aging. Dr. Moore reviews all Skin Care articles, ensuring ingredient and routine advice is clinically accurate.</p>
          <div class="team-tags"><span class="team-tag">Dermatology</span><span class="team-tag">Anti-Aging</span><span class="team-tag">Skincare Science</span></div>
        </div>
        <button class="view-profile-btn" onclick="openProfile('rachel')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          View Full Profile
        </button>
      </div>
    </div>

    <!-- CONTRIBUTING WRITERS (3 members — Ben Okafor removed) -->
    <div style="font-size:0.65rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--g2);margin-bottom:1.25rem;padding-bottom:0.75rem;border-bottom:2px solid var(--border)">Contributing Writers &amp; Specialists</div>
    <div class="team-grid" style="margin-bottom:3rem">

      <!-- 4. Nora Kim -->
      <div class="team-card-new fade-up">
        <div class="team-photo-wrap">
          <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=300&q=80" alt="Nora Kim"/>
        </div>
        <div class="team-body">
          <div class="team-badge-role-new">Senior Nutrition Writer</div>
          <h3>Nora Kim, RD</h3>
          <div class="cred">Registered Dietitian · MS Nutrition Science</div>
          <p>Clinical dietitian turned health writer. Nora specializes in translating complex nutrition research into practical, accessible guidance and leads our Nutrition content strategy.</p>
          <div class="team-tags"><span class="team-tag">Nutrition</span><span class="team-tag">Gut Health</span><span class="team-tag">Longevity</span></div>
        </div>
        <button class="view-profile-btn" onclick="openProfile('nora')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          View Full Profile
        </button>
      </div>

      <!-- 5. Sofia Chen -->
      <div class="team-card-new fade-up">
        <div class="team-photo-wrap">
          <img src="https://images.unsplash.com/photo-1489424731084-a5d8b219a5bb?w=300&q=80" alt="Sofia Chen"/>
        </div>
        <div class="team-body">
          <div class="team-badge-role-new">Fitness Writer</div>
          <h3>Sofia Chen, MS</h3>
          <div class="cred">MS Exercise Science · NSCA-CSCS</div>
          <p>Certified strength and conditioning specialist with a master's in exercise science. Sofia writes our fitness content focusing on evidence-based training for adults over 40.</p>
          <div class="team-tags"><span class="team-tag">Strength Training</span><span class="team-tag">Mobility</span><span class="team-tag">Sports Science</span></div>
        </div>
        <button class="view-profile-btn" onclick="openProfile('sofia')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          View Full Profile
        </button>
      </div>

      <!-- 6. James Liu -->
      <div class="team-card-new fade-up">
        <div class="team-photo-wrap">
          <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&q=80" alt="James Liu"/>
        </div>
        <div class="team-body">
          <div class="team-badge-role-new">Psychology Writer</div>
          <h3>James Liu, PhD</h3>
          <div class="cred">PhD Clinical Psychology · CBT Specialist</div>
          <p>Clinical psychologist specializing in cognitive behavioral therapy and positive psychology. James leads our Mental Wellness content, bridging rigorous research and practical application.</p>
          <div class="team-tags"><span class="team-tag">Mental Health</span><span class="team-tag">Stress</span><span class="team-tag">Brain Health</span></div>
        </div>
        <button class="view-profile-btn" onclick="openProfile('james')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          View Full Profile
        </button>
      </div>
    </div>

    <!-- EDITORIAL STANDARDS BOX -->
    <div style="background:linear-gradient(135deg,var(--g-pale),#fff);border:1px solid var(--g-light);border-radius:16px;padding:3rem;text-align:center;display:grid;grid-template-columns:1fr 1fr 1fr;gap:2rem;margin-top:1rem" class="fade-up">
      <div style="text-align:center">
        <div style="width:52px;height:52px;border-radius:14px;background:var(--g-pale);border:1.5px solid var(--g-light);display:flex;align-items:center;justify-content:center;margin:0 auto 0.8rem;font-size:1.4rem">🔬</div>
        <h4 style="font-family:var(--serif);font-size:0.95rem;color:var(--text);font-weight:700;margin-bottom:0.4rem">Expert Authorship</h4>
        <p style="font-size:0.78rem;color:var(--mid);line-height:1.6;font-weight:300">Every article is written by a credentialed health professional with verified clinical experience.</p>
      </div>
      <div style="text-align:center">
        <div style="width:52px;height:52px;border-radius:14px;background:var(--g-pale);border:1.5px solid var(--g-light);display:flex;align-items:center;justify-content:center;margin:0 auto 0.8rem;font-size:1.4rem">✓</div>
        <h4 style="font-family:var(--serif);font-size:0.95rem;color:var(--text);font-weight:700;margin-bottom:0.4rem">Peer Review</h4>
        <p style="font-size:0.78rem;color:var(--mid);line-height:1.6;font-weight:300">All content undergoes independent medical review before publication and is updated as evidence evolves.</p>
      </div>
      <div style="text-align:center">
        <div style="width:52px;height:52px;border-radius:14px;background:var(--g-pale);border:1.5px solid var(--g-light);display:flex;align-items:center;justify-content:center;margin:0 auto 0.8rem;font-size:1.4rem">📚</div>
        <h4 style="font-family:var(--serif);font-size:0.95rem;color:var(--text);font-weight:700;margin-bottom:0.4rem">Primary Sources</h4>
        <p style="font-size:0.78rem;color:var(--mid);line-height:1.6;font-weight:300">Claims are fact-checked against peer-reviewed journals and current clinical guidelines — never opinion.</p>
      </div>
    </div>
    <div style="text-align:center;margin-top:1.5rem">
      <button class="btn-green" style="padding:0.7rem 1.75rem;font-size:0.88rem" onclick="showPage('about-us')">Learn About Our Editorial Process →</button>
    </div>
  </div>
<?php get_footer(); ?>
