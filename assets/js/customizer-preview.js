/* Customizer live preview script */
(function($) {
    // Primary color
    wp.customize('hba_primary_color', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--g1', to);
        });
    });
    // Secondary color
    wp.customize('hba_secondary_color', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--g2', to);
        });
    });
    // Body background
    wp.customize('hba_body_bg', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--off', to);
        });
    });
    // Text color
    wp.customize('hba_text_color', function(value) {
        value.bind(function(to) {
            document.documentElement.style.setProperty('--text', to);
        });
    });
    // Hero title
    wp.customize('hba_hero_title', function(value) {
        value.bind(function(to) {
            $('.home-hero-left h1').text(to);
        });
    });
    // Hero subtitle
    wp.customize('hba_hero_subtitle', function(value) {
        value.bind(function(to) {
            $('.home-hero-left > p').text(to);
        });
    });
    // Hero eyebrow
    wp.customize('hba_hero_eyebrow', function(value) {
        value.bind(function(to) {
            $('.home-eyebrow').text(to);
        });
    });
    // Button texts
    wp.customize('hba_hero_btn1_text', function(value) {
        value.bind(function(to) {
            $('.home-ctas .btn-primary').text(to);
        });
    });
    wp.customize('hba_hero_btn2_text', function(value) {
        value.bind(function(to) {
            $('.home-ctas .btn-secondary').text(to);
        });
    });
    // Footer about
    wp.customize('hba_footer_about', function(value) {
        value.bind(function(to) {
            $('.foot-about').text(to);
        });
    });
    // Copyright
    wp.customize('hba_footer_copyright', function(value) {
        value.bind(function(to) {
            $('.foot-copy').text(to);
        });
    });
    // Expert name
    wp.customize('hba_expert_name', function(value) {
        value.bind(function(to) {
            $('.expert-strip .exp-name').text(to);
        });
    });
    // Ann bar
    wp.customize('hba_ann_bar_text', function(value) {
        value.bind(function(to) {
            $('.ann-bar').html(to);
        });
    });
    // Nav CTA text
    wp.customize('hba_nav_cta_text', function(value) {
        value.bind(function(to) {
            $('.nav-right .btn-green').text(to);
        });
    });
})(jQuery);
