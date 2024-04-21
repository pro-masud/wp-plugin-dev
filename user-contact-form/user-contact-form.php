<?php
/*
Plugin Name: User Contact Form
Description: Allows users to submit contact information and administrators to manage submissions.
Version: 1.0
Author: Masud Rana
*/

// Plugin code goes here
function user_contact_form_shortcode() {
    ob_start();
    ?>
    <form method="post" action="">
        <input type="text" name="user_name" placeholder="Your Name" required>
        <input type="email" name="user_email" placeholder="Your Email" required>
        <textarea name="user_message" placeholder="Your Message" required></textarea>
        <input type="submit" name="submit_contact_form" value="Submit">
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('user_contact_form', 'user_contact_form_shortcode');


function handle_contact_form_submission() {
    if (isset($_POST['submit_contact_form'])) {
        $name = sanitize_text_field($_POST['user_name']);
        $email = sanitize_email($_POST['user_email']);
        $message = sanitize_textarea_field($_POST['user_message']);

        $post_data = array(
            'post_title'   => $name,
            'post_content' => $message,
            'post_status'  => 'publish',
            'post_type'    => 'contact_submission',
            'meta_input'   => array(
                '_user_email' => $email
            )
        );

        $post_id = wp_insert_post($post_data);

        if ($post_id) {
            // Optionally, you can add a success message here
        }
    }
}
add_action('init', 'handle_contact_form_submission');


function user_contact_form_menu() {
    add_menu_page(
        'Contact Submissions',
        'Contact Submissions',
        'manage_options',
        'user-contact-submissions',
        'display_contact_submissions',
        'dashicons-email',
        20
    );
}
add_action('admin_menu', 'user_contact_form_menu');


function display_contact_submissions() {
    $submissions = new WP_Query(array(
        'post_type' => 'contact_submission',
        'posts_per_page' => -1
    ));

    if ($submissions->have_posts()) {
        echo '<ul>';
        while ($submissions->have_posts()) {
            $submissions->the_post();
            $name = get_the_title();
            $email = get_post_meta(get_the_ID(), '_user_email', true);
            $message = get_the_content();
            echo "<li>$name - $email - $message</li>";
        }
        echo '</ul>';
    } else {
        echo 'No submissions found.';
    }
}
