<?php
require_once('/var/www/html/wp-load.php');
$team_members = get_posts([
    'post_type' => 'hba_team',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]);

$about_text = "Dr. Sarah Matheson is a board-certified internist with over 18 years of clinical experience in internal and preventive medicine. After completing her residency at Johns Hopkins Hospital, she spent a decade at Massachusetts General Hospital as an attending physician before transitioning into health communications and medical education. Dr. Matheson founded Health Beyond Age's medical review program in 2021, building the editorial standards and peer-review framework that ensures every article we publish reflects current evidence-based clinical guidelines. She brings a rare combination of frontline clinical experience and a genuine passion for making accurate health information accessible to everyone. Outside of medicine, she is a faculty lecturer at Harvard Medical School's continuing education program, where she teaches internal medicine residents the principles of preventive care and healthy aging.";

foreach ($team_members as $member) {
    if (strpos(strtolower($member->post_title), 'sarah matheson') !== false) {
        update_post_meta($member->ID, '_hba_team_about', $about_text);
        echo "Updated Dr. Sarah Matheson's About section!\n";
    }
}
