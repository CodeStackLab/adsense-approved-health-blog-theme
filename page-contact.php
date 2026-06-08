<?php
/**
 * Template Name: Contact Us
 */
get_header(); ?>

<div class="articles-hero" style="background:var(--off); text-align:center; padding:4rem 1.5rem 3rem;">
    <div class="articles-hero-inner" style="max-width:700px; margin:0 auto;">
        <div class="eyebrow">Get In Touch</div>
        <h1 style="font-family:var(--serif); font-size:clamp(2rem,4vw,3.2rem); font-weight:700; color:var(--text); margin-bottom:1rem;">We'd Love to Hear From You</h1>
        <p style="font-size:1rem; color:var(--mid); line-height:1.7; max-width:500px; margin:0 auto;">Have a question about our content, a correction to report, or a collaboration idea? Our team is here and ready to help.</p>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div style="max-width:1100px; margin:0 auto; padding:3rem 1.5rem 6rem; display:grid; grid-template-columns:1.4fr 1fr; gap:4rem; align-items:start;">

    <!-- Contact Info Cards -->
    <div style="display:flex; flex-direction:column; gap:1.5rem;">

        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:2rem; display:flex; gap:1.25rem; align-items:flex-start;">
            <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg,var(--g1),var(--g2)); display:flex; align-items:center; justify-content:center; font-size:1.3rem; flex-shrink:0;">✉️</div>
            <div>
                <h3 style="font-size:1rem; font-weight:700; color:var(--text); margin:0 0 .3rem;">General Enquiries</h3>
                <p style="font-size:.9rem; color:var(--mid); margin:0 0 .5rem; line-height:1.6;">For questions, feedback, or general correspondence.</p>
                <a href="mailto:hello@healthbeyondage.com" style="color:var(--g1); font-weight:600; font-size:.9rem;">hello@healthbeyondage.com</a>
            </div>
        </div>

        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:2rem; display:flex; gap:1.25rem; align-items:flex-start;">
            <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg,#E81D76,#e84d7a); display:flex; align-items:center; justify-content:center; font-size:1.3rem; flex-shrink:0;">🔬</div>
            <div>
                <h3 style="font-size:1rem; font-weight:700; color:var(--text); margin:0 0 .3rem;">Editorial Corrections</h3>
                <p style="font-size:.9rem; color:var(--mid); margin:0 0 .5rem; line-height:1.6;">Found an inaccuracy? Please send us the article URL and the specific section so we can review promptly.</p>
                <a href="mailto:editorial@healthbeyondage.com" style="color:var(--g1); font-weight:600; font-size:.9rem;">editorial@healthbeyondage.com</a>
            </div>
        </div>

        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:2rem; display:flex; gap:1.25rem; align-items:flex-start;">
            <div style="width:48px; height:48px; border-radius:12px; background:linear-gradient(135deg,#2196F3,#64B5F6); display:flex; align-items:center; justify-content:center; font-size:1.3rem; flex-shrink:0;">🤝</div>
            <div>
                <h3 style="font-size:1rem; font-weight:700; color:var(--text); margin:0 0 .3rem;">Partnerships & Media</h3>
                <p style="font-size:.9rem; color:var(--mid); margin:0 0 .5rem; line-height:1.6;">For collaboration proposals, media interviews, and press enquiries.</p>
                <a href="mailto:partnerships@healthbeyondage.com" style="color:var(--g1); font-weight:600; font-size:.9rem;">partnerships@healthbeyondage.com</a>
            </div>
        </div>

        <div style="background:var(--off); border-radius:12px; padding:1.25rem 1.5rem;">
            <p style="font-size:.85rem; color:var(--mid); margin:0; line-height:1.6;">⏱ We aim to respond to all enquiries within <strong>2–3 business days</strong>.</p>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div style="position:sticky; top:6rem; display:flex; flex-direction:column; gap:1.5rem;">
        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:2rem;">
            <h3 style="font-family:var(--serif); font-size:1.3rem; color:var(--text); margin:0 0 1rem;">Important Notice</h3>
            <p style="font-size:.9rem; color:var(--mid); line-height:1.7; margin:0 0 1rem;">Health Beyond Age does not provide personalised medical advice. For health concerns, please consult a qualified healthcare professional.</p>
            <a href="<?php echo esc_url(home_url('/medical-disclaimer')); ?>" style="font-size:.85rem; color:var(--g1); font-weight:600;">Read our Medical Disclaimer →</a>
        </div>
        <div style="background:linear-gradient(135deg,var(--g1),var(--g2)); border-radius:16px; padding:2rem; color:#fff; text-align:center;">
            <div style="font-size:1.5rem; margin-bottom:.75rem;">📬</div>
            <h4 style="font-size:1rem; font-weight:700; margin:0 0 .5rem;">Stay Updated</h4>
            <p style="font-size:.85rem; opacity:.9; margin:0 0 1.25rem; line-height:1.5;">Get expert health insights delivered to your inbox every week.</p>
            <a href="#newsletter" style="display:inline-block; background:#fff; color:var(--g1); border-radius:8px; padding:.6rem 1.5rem; font-size:.85rem; font-weight:700; text-decoration:none;">Subscribe Free</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
