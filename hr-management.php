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


//department

function hr_department_add()
{

include_once (__DIR__. '/templetes/department/hr-department-add.php');

}


include_once (__DIR__. '/templetes/department/hr-department-edit.php');

include_once (__DIR__. '/templetes/department/hr-department-manage.php');


// designation

function hr_designation_add()
{

   include_once (__DIR__. '/templetes/designation/hr-designation-add.php');
}


function hr_designation_edit()
{
  
  include_once (__DIR__. '/templetes/designation/hr-designation-edit.php');

}


function hr_designation_list()
{

  include_once (__DIR__. '/templetes/designation/hr-designation-manage.php');

}


// employee


function hr_employee_add()
{
  
    include_once (__DIR__. '/templetes/employees/hr-employee-add.php');

}


function hr_employee_edit()
{
  
    include_once (__DIR__. '/templetes/employees/hr-employee-edit.php');

}


function hr_employee_list()
{
  
    include_once (__DIR__. '/templetes/employees/hr-employee-manage.php');

}






function hr_management_db()
{
   
   include_once (__DIR__. '/includes/db-table.php');

}

register_activation_hook(__FILE__, 'hr_management_db');



