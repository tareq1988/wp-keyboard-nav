<?php
/**
 * Plugin Name: Keyboard Navigation
 * Plugin URI: http://weDevs.com
 * Description: Easy navigation with keyboard for WordPress
 * Author: Tareq Hasan
 * Author URI: http://tareq.weDevs.com
 * Version: 1.0
 */

/**
 * Scripts for keyboard nav
 */
function kn_scripts() {
    global $post;
    
    $post_id = $post == null ? 0 : $post->ID;
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('mice', plugins_url('mousetrap.min.js', __FILE__));
    wp_enqueue_script('mouse', plugins_url('mouse.js', __FILE__));
    wp_localize_script('mouse', 'mouse', array(
        'home' => home_url('/'),
        'dashboard' => admin_url('/'),
        'settings' => admin_url('options-general.php'),
        'plugins' => admin_url('plugins.php'),
        'themes' => admin_url('themes.php'),
        'pages' => admin_url('edit.php?post_type=page'),
        'post_all' => admin_url('edit.php'),
        'post_new' => admin_url('post-new.php'),
        'page_all' => admin_url('edit.php?post_type=page'),
        'page_new' => admin_url('post-new.php?post_type=page'),
        'edit_link' => get_edit_post_link( $post_id ),
        'users' => admin_url('users.php'),
        'permalinks' => admin_url('options-permalink.php'),
        'login' => is_user_logged_in() ? wp_logout_url() : wp_login_url(),
        'current_page' => get_permalink(),
        'edit_comments' => admin_url('edit-comments.php'),
    ) );
    
    wp_enqueue_style('mouse', plugins_url('mouse.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'kn_scripts');
add_action('admin_enqueue_scripts', 'kn_scripts');

/**
 * Command Help area
 */
function kn_help() {
    ?>
    <div id="mouse">
        <div class="inner">
            <h1>Keyboard Shortcuts</h1>
            
            
            <table>
                <tr>
                    <td class="divide">
                        <table>
                            <?php kn_help_helper(array('g', 'h'), 'home', __( 'Go to front page', 'knav' )); ?>
                            <?php kn_help_helper(array('g', 'l'), 'login', __( 'Go to login page', 'knav' )); ?>
                            <?php kn_help_helper(array('g', 'd'), 'dashboard', __( 'Go to admin dashboard', 'knav' )); ?>
                            <?php kn_help_helper(array('g', 'c'), 'comment', __( 'Go to comment edit page', 'knav' )); ?>
                            <?php kn_help_helper(array('g', 't'), 'themes', __( 'Go to themes page', 'knav' )); ?>
                            <?php kn_help_helper(array('g', 'p'), 'plugins', __( 'Go to plugins page', 'knav' )); ?>
                            <?php kn_help_helper(array('g', 'u'), 'users', __( 'Go to users page', 'knav' )); ?>
                            <?php kn_help_helper(array('g', 's'), 'settings', __( 'Go to settings page', 'knav' )); ?>
                        </table>                    
                    </td>
                    <td class="divide">
                        <table>
                            <?php kn_help_helper(array('?'), 'help', __( 'Toggle the help area', 'knav' )); ?>
                            <?php kn_help_helper(array('/'), 'search', __( 'Focus the search box', 'knav' )); ?>
                            <?php kn_help_helper(array('d'), 'debug', __( 'Toggle the debug bar', 'knav' )); ?>
                            <?php kn_help_helper(array('r'), 'reload', __( 'Reload the current page', 'knav' )); ?>
                            <?php kn_help_helper(array('e'), 'edit', __( 'Edit current post', 'knav' )); ?>
                            
                            <?php kn_help_helper(array('p', 'a'), 'post all', __( 'All post listing', 'knav' )); ?>
                            <?php kn_help_helper(array('p', 'n'), 'post new', __( 'Create new post', 'knav' )); ?>
                            <?php kn_help_helper(array('Shift + p', 'a'), 'page all', __( 'All page listing', 'knav' )); ?>
                            <?php kn_help_helper(array('Shift + p', 'n'), 'page new', __( 'Create new page', 'knav' )); ?>
                        </table>
                    
                    </td>
                </tr>
            </table>
            
            
            
        </div>
    </div>
    <?php
}

add_action( 'wp_footer', 'kn_help' );
add_action( 'admin_footer', 'kn_help' );

/**
 * Prints the single command help
 * 
 * @param array $args command key combination
 * @param string $abbr abbriviation
 * @param string $desc command description
 */
function kn_help_helper($args, $abbr = '', $desc = '') {
    $cmd = array();
    $glue = ' <span class="thn">then</span> ';
    
    foreach( $args as $arg ) {
        $cmd[] = '<span class="cmd">' . $arg . '</span>';
    }
    ?>
    <tr>
        <td><?php echo implode( $glue, $cmd); ?></td>
        <td><?php echo $abbr == '' ? '&nbsp' : '<span class="help">&rarr; ' . $abbr . '</span>' ?></td>
        <td><?php echo $desc == '' ? '&nbsp' : $desc; ?></td>
    </tr>    
    <?
}

