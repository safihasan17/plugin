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
    add_submenu_page(
        "",
        "Add Department",
        "Add Department",
        "manage_options",
        "hr-departments-add",
        "hr_department_add"
    );
    add_submenu_page(
        "",                          // parent slug empty = hidden from menu
        "Edit Department",
        "Edit Department",
        "manage_options",
        "hr-departments-edit",
        "hr_department_edit"
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
    add_submenu_page(
        "",
        "Add Designation",
        "Add Designation",
        "manage_options",
        "hr-designations-add",
        "hr_designation_add"
    );
    add_submenu_page(
        "",
        "Edit Designation",
        "Edit Designation",
        "manage_options",
        "hr-designations-edit",
        "hr_designation_edit"
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
    add_submenu_page(
        "",
        "Add Employee",
        "Add Employee",
        "manage_options",
        "hr-employees-add",
        "hr_employee_add"
    );
    add_submenu_page(
        "",
        "Edit Employee",
        "Edit Employee",
        "manage_options",
        "hr-employees-edit",
        "hr_employee_edit"
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
    add_submenu_page(
        "",
        "Add Notice",
        "Add Notice",
        "manage_options",
        "hr-notices-add",
        "hr_notice_add"
    );
    add_submenu_page(
        "",
        "Edit Notice",
        "Edit Notice",
        "manage_options",
        "hr-notices-edit",
        "hr_notice_edit"
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
    add_submenu_page(
        "",
        "Add Holiday",
        "Add Holiday",
        "manage_options",
        "hr-holidays-add",
        "hr_holiday_add"
    );
    add_submenu_page(
        "",
        "Edit Holiday",
        "Edit Holiday",
        "manage_options",
        "hr-holidays-edit",
        "hr_holiday_edit"
    );



?>

