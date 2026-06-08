/* Customizer output — dynamic colors/fonts set by WordPress Customizer */
:root {
  --g1: <?php echo get_theme_mod('hba_primary_color', '#1A7A3C'); ?>;
  --g2: <?php echo get_theme_mod('hba_secondary_color', '#22963F'); ?>;
}
body {
  font-family: <?php echo get_theme_mod('hba_body_font', "'DM Sans', system-ui, sans-serif"); ?>;
}
h1, h2, h3, h4, h5, h6,
.home-hero-left h1,
.art-body h3,
.fl-body h2 {
  font-family: <?php echo get_theme_mod('hba_heading_font', "'Merriweather', Georgia, serif"); ?>;
}
