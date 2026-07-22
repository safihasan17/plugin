<?php


    global $wpdb;
    $table_name = $wpdb->prefix . 'hr_employees';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $employee = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

    if (! $employee) {
        echo "<div class='wrap'><p>Employee not found.</p></div>";
        return;
    }

    // Handle form submission
    if (isset($_POST['submit']) && isset($_POST['hr_emp_nonce']) && wp_verify_nonce($_POST['hr_emp_nonce'], 'edit_employee_' . $id)) {
        $name           = sanitize_text_field($_POST['name']);
        $department_id  = intval($_POST['department_id']);
        $designation_id = intval($_POST['designation_id']);
        $email          = sanitize_text_field($_POST['email']);
        $phone          = sanitize_text_field($_POST['phone']);
        $joining_date   = sanitize_text_field($_POST['joining_date']);
        $employee_id_no = sanitize_text_field($_POST['employee_id_no']);
        $status         = sanitize_text_field($_POST['status']);
        $photo_url      = sanitize_text_field($_POST['photo_url']);

        $wpdb->update(
            $table_name,
            array(
                'name'           => $name,
                'department_id'  => $department_id,
                'designation_id' => $designation_id,
                'email'          => $email,
                'phone'          => $phone,
                'joining_date'   => $joining_date,
                'employee_id_no' => $employee_id_no,
                'status'         => $status,
                'photo_url'      => $photo_url,
            ),
            array('id' => $id)
        );

        echo "<script>window.location.href = '" . admin_url('admin.php?page=hr-employees') . "';</script>";
        return;
    }

    $departments  = $wpdb->get_results("SELECT id, name FROM " . $wpdb->prefix . "hr_departments ORDER BY name ASC");
    $designations = $wpdb->get_results("SELECT id, name FROM " . $wpdb->prefix . "hr_designations ORDER BY name ASC");
    $created_at   = date('d M, Y h:i A', strtotime($employee->created_at));

    echo "
    <div class='form-wrap'>
    <h2>Edit Employee</h2>
    <form id='editemp' method='post'>
        " . wp_nonce_field('edit_employee_' . $id, 'hr_emp_nonce', true, false) . "
        <div class='form-field form-required term-name-wrap'>
            <label for='name'>Full Name</label>
            <input name='name' id='name' type='text' value='" . esc_attr($employee->name) . "' size='40' required>
        </div>

        <div class='form-field term-slug-wrap'>
            <label for='department_id'>Department</label>
            <select name='department_id' id='department_id'>
                <option value=''>— Select Department —</option>";

    foreach ($departments as $dept) {
        $selected = ($employee->department_id == $dept->id) ? "selected" : "";
        echo "<option value='" . esc_attr($dept->id) . "' $selected>" . esc_html($dept->name) . "</option>";
    }

    echo "
            </select>
        </div>

        <div class='form-field term-slug-wrap'>
            <label for='designation_id'>Designation</label>
            <select name='designation_id' id='designation_id'>
                <option value=''>— Select Designation —</option>";

    foreach ($designations as $desig) {
        $selected = ($employee->designation_id == $desig->id) ? "selected" : "";
        echo "<option value='" . esc_attr($desig->id) . "' $selected>" . esc_html($desig->name) . "</option>";
    }

    echo "
            </select>
        </div>

        <div class='form-field term-slug-wrap'>
            <label for='email'>Email</label>
            <input name='email' id='email' type='text' value='" . esc_attr($employee->email) . "' size='40'>
        </div>

        <div class='form-field term-slug-wrap'>
            <label for='phone'>Phone</label>
            <input name='phone' id='phone' type='text' value='" . esc_attr($employee->phone) . "' size='40'>
        </div>

        <div class='form-field term-slug-wrap'>
            <label for='joining_date'>Joining Date</label>
            <input name='joining_date' id='joining_date' type='date' value='" . esc_attr($employee->joining_date) . "'>
        </div>

        <div class='form-field term-slug-wrap'>
            <label for='employee_id_no'>Employee ID No.</label>
            <input name='employee_id_no' id='employee_id_no' type='text' value='" . esc_attr($employee->employee_id_no) . "' size='40'>
        </div>

        <div class='form-field term-slug-wrap'>
            <label for='status'>Status</label>
            <select name='status' id='status'>";

    $statuses = array('active' => 'Active', 'inactive' => 'Inactive', 'on_leave' => 'On Leave');
    foreach ($statuses as $status_val => $status_label) {
        $selected = ($employee->status === $status_val) ? "selected" : "";
        echo "<option value='" . esc_attr($status_val) . "' $selected>" . esc_html($status_label) . "</option>";
    }

    echo "
            </select>
        </div>

        <div class='form-field term-slug-wrap'>
            <label for='photo_url'>Photo URL</label>
            <input name='photo_url' id='photo_url' type='text' value='" . esc_attr($employee->photo_url) . "' size='40'>
        </div>

        <div class='form-field'>
            <label>Created At</label>
            <p><strong>" . esc_html($created_at) . "</strong></p>
        </div>

        <p class='submit'>
            <input type='submit' name='submit' id='submit' class='button button-primary' value='Update Employee'>
        </p>
    </form>
    </div>
    ";


?>
