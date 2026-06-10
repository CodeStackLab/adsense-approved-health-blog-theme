<?php
require_once('/var/www/html/wp-load.php');
$team_members = get_posts([
    'post_type' => 'hba_team',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]);

foreach ($team_members as $member) {
    if (strpos(strtolower($member->post_title), 'sarah matheson') !== false) {
        update_post_meta($member->ID, '_hba_team_role', 'Lead Medical Reviewer');
        update_post_meta($member->ID, '_hba_team_credentials', 'MD, Internal Medicine · 18 yrs');
        update_post_meta($member->ID, '_hba_team_tags', 'Preventive Medicine, Aging, Cardiovascular');
        update_post_meta($member->ID, '_hba_team_years_practice', '18+');
        update_post_meta($member->ID, '_hba_team_articles_reviewed', '340+');
        update_post_meta($member->ID, '_hba_team_publications_count', '12');
        update_post_meta($member->ID, '_hba_team_joined_year', '2021');
        update_post_meta($member->ID, '_hba_team_email', 'sarah.matheson@healthbeyondage.com');
        update_post_meta($member->ID, '_hba_team_quote', "I review content at Health Beyond Age with the same standard I apply in the clinic — if I would not say it to a patient, it does not go on the page. Accuracy is not optional in health information.");
        update_post_meta($member->ID, '_hba_team_education', "Doctor of Medicine (MD) | Johns Hopkins School of Medicine, Baltimore, MD — 2005\nResidency, Internal Medicine | Johns Hopkins Hospital, Baltimore, MD — 2005-2008\nFellowship, Preventive Medicine | Massachusetts General Hospital, Boston, MA — 2008-2010\nBachelor of Science, Human Biology | Stanford University, Palo Alto, CA — 2001");
        update_post_meta($member->ID, '_hba_team_certifications', "ABIM Board-Certified, Internal Medicine\nAmerican College of Preventive Medicine\nFellow, American College of Physicians (FACP)\nCPR/ACLS Certified");
        update_post_meta($member->ID, '_hba_team_publications_list', "Longitudinal Outcomes of Preventive Care Interventions in Adults Over 55. New England Journal of Medicine, 2022.\nStatin Use and Cardiovascular Risk Reduction in Middle-Aged Adults: A Systematic Review. JAMA Internal Medicine, 2019.\nDietary Patterns and All-Cause Mortality in a 10-Year Cohort Study. Annals of Internal Medicine, 2017.");
        echo "Updated Dr. Sarah Matheson!\n";
    }
}
