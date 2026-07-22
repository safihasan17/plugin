<?php


    if (isset($_POST['submit'])) {

        global $wpdb;
        $table = $wpdb->prefix . 'hr_employees';
        $wpdb->insert(
            $table,
            array(
                'name'           => $_POST['name'],
                'department_id'  => $_POST['department_id'],
                'designation_id' => $_POST['designation_id'],
                'email'          => $_POST['email'],
                'phone'          => $_POST['phone'],
                'joining_date'   => $_POST['joining_date'],
                'employee_id_no' => $_POST['employee_id_no'],
                'status'         => $_POST['status'],
                'photo_url'      => $_POST['photo_url'],
            )
        );

        $insert_id = $wpdb->insert_id;
        if ($insert_id) {
            echo '<div class="notice notice-success is-dismissible">
          <p> Employee saved successfully </p>
        </div>';
        } else {
            echo '<div class="notice notice-error is-dismissible">
          <p> Data not inserted </p>
        </div>';
        }
    };

    global $wpdb;
    $departments  = $wpdb->get_results("SELECT id, name FROM " . $wpdb->prefix . "hr_departments ORDER BY name ASC");
    $designations = $wpdb->get_results("SELECT id, name FROM " . $wpdb->prefix . "hr_designations ORDER BY name ASC");

    echo "
    <div class='form-wrap'>
<h2>Add Employee</h2>
<form method='post' class='validate'>

<div class='form-field term-name-wrap'>
    <label>Full Name</label>
    <input name='name' type='text' value='' size='40' aria-required='true' aria-describedby='name-description'>
</div>

<div class='form-field term-slug-wrap'>
    <label>Department</label>
    <select name='department_id'>
        <option value=''>— Select Department —</option>";

    foreach ($departments as $dept) {
        echo "<option value='" . esc_attr($dept->id) . "'>" . esc_html($dept->name) . "</option>";
    }

    echo "
    </select>
</div>

<div class='form-field term-slug-wrap'>
    <label>Designation</label>
    <select name='designation_id'>
        <option value=''>— Select Designation —</option>";

    foreach ($designations as $desig) {
        echo "<option value='" . esc_attr($desig->id) . "'>" . esc_html($desig->name) . "</option>";
    }

    echo "
    </select>
</div>

<div class='form-field term-slug-wrap'>
    <label>Email</label>
    <input name='email' type='text' value='' size='40'>
</div>

<div class='form-field term-slug-wrap'>
    <label>Phone</label>
    <input name='phone' type='text' value='' size='40'>
</div>

<div class='form-field term-slug-wrap'>
    <label>Joining Date</label>
    <input name='joining_date' type='date' value=''>
</div>

<div class='form-field term-slug-wrap'>
    <label>Employee ID No.</label>
    <input name='employee_id_no' type='text' value='' size='40'>
</div>

<div class='form-field term-slug-wrap'>
    <label>Status</label>
    <select name='status'>
        <option value='active'>Active</option>
        <option value='inactive'>Inactive</option>
        <option value='on_leave'>On Leave</option>
    </select>
</div>

<div class='form-field term-slug-wrap'>
    <label>Photo URL</label>
    <input name='photo_url' type='text' value='' size='40' placeholder='https://example.com/photo.jpg'>
</div>

<p class='submit'>
    <input type='submit' name='submit' id='submit' class='button button-primary' value='Add Employee'>
    <span class='spinner'></span>
</p>
</form>
</div>
";

?>
