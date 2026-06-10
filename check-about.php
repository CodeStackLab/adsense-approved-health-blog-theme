<?php
require_once('/var/www/html/wp-load.php');
$team_members = get_posts([
    'post_type' => 'hba_team',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]);

foreach ($team_members as $member) {
    echo "Member: " . $member->post_title . "\n";
    echo "About: " . get_post_meta($member->ID, '_hba_team_about', true) . "\n\n";
}
