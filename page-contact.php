<?php
/**
 * Template Name: Contact Us
 */
get_header(); ?>

<div class="articles-hero" style="background:var(--off); text-align:center; padding:4rem 1.5rem 3rem;">
    <div class="articles-hero-inner" style="max-width:700px; margin:0 auto;">
        <div class="eyebrow"><?php echo esc_html( get_theme_mod('hba_contact_eyebrow', 'Get In Touch') ); ?></div>
        <h1 style="font-family:var(--serif); font-size:clamp(2rem,4vw,3.2rem); font-weight:700; color:var(--text); margin-bottom:1rem;"><?php echo wp_kses_post( get_theme_mod('hba_contact_title', 'We\'d Love to Hear From You') ); ?></h1>
        <p style="font-size:1rem; color:var(--mid); line-height:1.7; max-width:500px; margin:0 auto;"><?php echo esc_html( get_theme_mod('hba_contact_desc', 'Have a question about our content, a correction to report, or a collaboration idea? Our team is here and ready to help.') ); ?></p>
    </div>
</div>

<?php hba_breadcrumb(); ?>

<div class="contact-page-layout">

    <!-- Left Sidebar: Contact Info -->
    <div style="display:flex; flex-direction:column; gap:1.5rem;" class="contact-sidebar">
        <div style="background:var(--off); border-radius:12px; padding:1.25rem 1.5rem;" class="contact-notice">
            <p style="font-size:.85rem; color:var(--mid); margin:0; line-height:1.6;"><?php echo wp_kses_post( get_theme_mod('hba_contact_time', '⏱ We aim to respond to all enquiries within <strong>2–3 business days</strong>.') ); ?></p>
        </div>

        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:1.5rem; display:flex; gap:1rem; align-items:flex-start;">
            <div style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg,var(--g1),var(--g2)); display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0;"><?php echo esc_html( get_theme_mod('hba_contact_c1_icon', '✉️') ); ?></div>
            <div>
                <h3 style="font-size:.95rem; font-weight:700; color:var(--text); margin:0 0 .2rem;"><?php echo esc_html( get_theme_mod('hba_contact_c1_title', 'General Enquiries') ); ?></h3>
                <p style="font-size:.85rem; color:var(--mid); margin:0 0 .4rem; line-height:1.5;"><?php echo esc_html( get_theme_mod('hba_contact_c1_desc', 'For questions, feedback, or general correspondence.') ); ?></p>
                <a href="mailto:<?php echo esc_attr( get_theme_mod('hba_contact_c1_email', 'hello@healthbeyondage.com') ); ?>" style="color:var(--g1); font-weight:600; font-size:.85rem;"><?php echo esc_html( get_theme_mod('hba_contact_c1_email', 'hello@healthbeyondage.com') ); ?></a>
            </div>
        </div>

        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:1.5rem; display:flex; gap:1rem; align-items:flex-start;">
            <div style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg,#E81D76,#e84d7a); display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0;"><?php echo esc_html( get_theme_mod('hba_contact_c2_icon', '🔬') ); ?></div>
            <div>
                <h3 style="font-size:.95rem; font-weight:700; color:var(--text); margin:0 0 .2rem;"><?php echo esc_html( get_theme_mod('hba_contact_c2_title', 'Editorial Corrections') ); ?></h3>
                <p style="font-size:.85rem; color:var(--mid); margin:0 0 .4rem; line-height:1.5;"><?php echo esc_html( get_theme_mod('hba_contact_c2_desc', 'Found an inaccuracy? Please send us the article URL and the specific section so we can review promptly.') ); ?></p>
                <a href="mailto:<?php echo esc_attr( get_theme_mod('hba_contact_c2_email', 'editorial@healthbeyondage.com') ); ?>" style="color:var(--g1); font-weight:600; font-size:.85rem;"><?php echo esc_html( get_theme_mod('hba_contact_c2_email', 'editorial@healthbeyondage.com') ); ?></a>
            </div>
        </div>

        <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:1.5rem; display:flex; gap:1rem; align-items:flex-start;">
            <div style="width:40px; height:40px; border-radius:10px; background:linear-gradient(135deg,#2196F3,#64B5F6); display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0;"><?php echo esc_html( get_theme_mod('hba_contact_c3_icon', '🤝') ); ?></div>
            <div>
                <h3 style="font-size:.95rem; font-weight:700; color:var(--text); margin:0 0 .2rem;"><?php echo esc_html( get_theme_mod('hba_contact_c3_title', 'Partnerships & Media') ); ?></h3>
                <p style="font-size:.85rem; color:var(--mid); margin:0 0 .4rem; line-height:1.5;"><?php echo esc_html( get_theme_mod('hba_contact_c3_desc', 'For collaboration proposals, media interviews, and press enquiries.') ); ?></p>
                <a href="mailto:<?php echo esc_attr( get_theme_mod('hba_contact_c3_email', 'partnerships@healthbeyondage.com') ); ?>" style="color:var(--g1); font-weight:600; font-size:.85rem;"><?php echo esc_html( get_theme_mod('hba_contact_c3_email', 'partnerships@healthbeyondage.com') ); ?></a>
            </div>
        </div>
    </div>

    <!-- Right Side: Contact Form -->
    <div style="background:#fff; border:1px solid var(--border); border-radius:16px; padding:2.5rem; box-shadow:0 10px 30px rgba(0,0,0,0.03);" class="contact-form-container">
        <h2 style="font-family:var(--serif); font-size:1.8rem; font-weight:700; margin-bottom:0.5rem; color:var(--text);">Send Us a Message</h2>
        <p style="color:var(--mid); font-size:.95rem; margin-bottom:2rem; line-height:1.6;">Use this form for any general enquiries. We'll get back to you within 2–3 business days.</p>
        
        <div class="hba-cf7-wrapper">
            <?php echo do_shortcode('[contact-form-7 id="268" title="Contact form 1"]'); ?>
        </div>
    </div>
</div>

<style>
/* Layout */
.contact-page-layout {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    padding: 3rem 1.5rem 6rem;
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 4rem;
    align-items: start;
    box-sizing: border-box;
}
.contact-sidebar {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
}
.contact-sidebar a {
    word-break: break-all;
}
.contact-form-container {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    overflow: hidden;
}

/* Styling for CF7 Form to match theme */
.hba-cf7-wrapper * { box-sizing: border-box; max-width: 100%; }
.hba-cf7-wrapper form { display: flex; flex-direction: column; gap: 1.25rem; width: 100%; }
.hba-cf7-wrapper p { margin: 0; width: 100%; }
.hba-cf7-wrapper label { font-size: .85rem; font-weight: 600; color: var(--text); margin-bottom: .4rem; display: block; width: 100%; }
.hba-cf7-wrapper input[type="text"],
.hba-cf7-wrapper input[type="email"],
.hba-cf7-wrapper textarea,
.hba-cf7-wrapper select { width: 100%; border: 1px solid var(--border); border-radius: 8px; padding: .8rem 1rem; font-family: var(--sans); font-size: .95rem; background: var(--off); transition: border-color .2s; }
.hba-cf7-wrapper input:focus, .hba-cf7-wrapper textarea:focus { outline: none; border-color: var(--g1); background: #fff; }
.hba-cf7-wrapper input[type="submit"] { background: var(--g1); color: #fff; border: none; padding: .9rem 2rem; font-family: var(--sans); font-weight: 700; font-size: 1rem; border-radius: 30px; cursor: pointer; transition: background .2s; width: 100%; white-space: normal; }
.hba-cf7-wrapper input[type="submit"]:hover { background: var(--g2); }
@media (max-width: 900px) {
    .contact-page-layout { grid-template-columns: 1fr; gap: 2.5rem; padding: 2rem 1.5rem 4rem; }
}
@media (max-width: 768px) {
    .hba-cf7-wrapper .wpcf7-form-control-wrap { display: block; width: 100%; }
    .contact-form-container { padding: 1.5rem !important; }
}
@media (max-width: 480px) {
    .articles-hero { padding: 3rem 1rem 2rem !important; }
    .articles-hero h1 { font-size: 2rem !important; }
    .contact-sidebar > div { flex-direction: column; align-items: flex-start !important; }
    .contact-sidebar > div > div:first-child { margin-bottom: 0.5rem; }
}
</style>

<?php get_footer(); ?>
