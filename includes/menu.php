<?php

 add_menu_page(
        'HR Management',            // page title
        'HR Management',            // menu title
        'manage_options',           // capability
        'hr-management',            // menu slug
        'hr_dashboard_page',      // callback function
        'dashicons-groups',         // icon
        26                          // position
    );



    // ---------- Department ----------
    add_submenu_page(
        "hr-management",            // parent slug
        "Departments",               // page title
        "Departments",                // menu title
        "manage_options",           // capability
        "hr-departments",           // menu slug
        "hr_department_list"        // callback function
    );
  
 

    // ---------- Designation ----------
    add_submenu_page(
        "hr-management",
        "Designations",
        "Designations",
        "manage_options",
        "hr-designations",
        "hr_designation_list"
    );
   
   

    // ---------- Employee ----------
    add_submenu_page(
        "hr-management",
        "Employees",
        "Employees",
        "manage_options",
        "hr-employees",
        "hr_employee_list"
    );
    
  
 

    // ---------- Notice ----------
    add_submenu_page(
        "hr-management",
        "Notices",
        "Notices",
        "manage_options",
        "hr-notices",
        "hr_notice_list"
    );
   
  

    // ---------- Holiday ----------
    add_submenu_page(
        "hr-management",
        "Holidays",
        "Holidays",
        "manage_options",
        "hr-holidays",
        "hr_holiday_list"
    );
 

?>

