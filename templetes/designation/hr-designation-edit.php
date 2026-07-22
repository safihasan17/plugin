<?php


    global $wpdb;
    $table_name = $wpdb->prefix . 'hr_designations';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $designation = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

    if (! $designation) {
        echo "<div class='wrap'><p>Designation not found.</p></div>";
        return;
    }

    // Handle form submission
    if (isset($_POST['submit']) && isset($_POST['hr_desig_nonce']) && wp_verify_nonce($_POST['hr_desig_nonce'], 'edit_designation_' . $id)) {
        $name          = sanitize_text_field($_POST['name']);
        $department_id = intval($_POST['department_id']);

        $wpdb->update(
            $table_name,
            array(
                'name'          => $name,
                'department_id' => $department_id,
            ),
            array('id' => $id)
        );

        echo "<script>window.location.href = '" . admin_url('admin.php?page=hr-designations') . "';</script>";
        return;
    }

    $departments = $wpdb->get_results("SELECT id, name FROM " . $wpdb->prefix . "hr_departments ORDER BY name ASC");
    $created_at  = date('d M, Y h:i A', strtotime($designation->created_at));

    echo "
    <div class='form-wrap'>
    <h2>Edit Designation</h2>
    <form id='editdesig' method='post'>
        " . wp_nonce_field('edit_designation_' . $id, 'hr_desig_nonce', true, false) . "
        <div class='form-field form-required term-name-wrap'>
            <label for='name'>Name</label>
            <input name='name' id='name' type='text' value='" . esc_attr($designation->name) . "' size='40' required>
        </div>
        <div class='form-field term-slug-wrap'>
            <label for='department_id'>Department</label>
            <select name='department_id' id='department_id'>
                <option value=''>— Select Department —</option>";

    foreach ($departments as $dept) {
        $selected = ($designation->department_id == $dept->id) ? "selected" : "";
        echo "<option value='" . esc_attr($dept->id) . "' $selected>" . esc_html($dept->name) . "</option>";
    }

    echo "
            </select>
        </div>
        <div class='form-field'>
            <label>Created At</label>
            <p><strong>" . esc_html($created_at) . "</strong></p>
        </div>
        <p class='submit'>
            <input type='submit' name='submit' id='submit' class='button button-primary' value='Update Designation'>
        </p>
    </form>
    </div>
    ";


?>
