<?php

/**
 * Plugin Name: HR Management
 * Description: Manage Employees, Departments, Designations, Notices/Announcements, and the Holiday Calendar — right from your WordPress admin.
 * Version: 1.0.0
 * Author: Safi
 * Author URI: https://example.com
 * Text Domain: hr-management
 */

if (! defined('ABSPATH')) {
    exit;
}

function hr_management_menu()
{
   
   include_once (__DIR__. '/includes/menu.php');

}

add_action('admin_menu', 'hr_management_menu');


function hr_management_db()
{
   
   include_once (__DIR__. '/includes/db-table.php');

}

register_activation_hook(__FILE__, 'hr_management_db');