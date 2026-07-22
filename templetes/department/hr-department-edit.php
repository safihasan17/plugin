<?php

function hr_department_edit()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hr_departments';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $department = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

    if (! $department) {
        echo "<div class='wrap'><p>Department not found.</p></div>";
        return;
    }

    // Handle form submission
    if (isset($_POST['submit']) && isset($_POST['hr_dept_nonce']) && wp_verify_nonce($_POST['hr_dept_nonce'], 'edit_department_' . $id)) {
        $name        = sanitize_text_field($_POST['dept-name']);
        $description = sanitize_textarea_field($_POST['description']);

        $wpdb->update(
            $table_name,
            array(
                'name'        => $name,
                'description' => $description,
            ),
            array('id' => $id)
        );

        echo "<script>window.location.href = '" . admin_url('admin.php?page=hr-departments') . "';</script>";
        return;
    }

    echo "
    <div class='form-wrap'>
    <h2>Edit Department</h2>
    <form id='editdept' method='post'>
        " . wp_nonce_field('edit_department_' . $id, 'hr_dept_nonce', true, false) . "
        <div class='form-field form-required term-name-wrap'>
            <label for='dept-name'>Name</label>
            <input name='dept-name' id='dept-name' type='text' value='" . esc_attr($department->name) . "' size='40' required>
        </div>
        <div class='form-field term-description-wrap'>
            <label for='description'>Description</label>
            <textarea name='description' id='description' rows='5' cols='40'>" . esc_textarea($department->description) . "</textarea>
        </div>
        <p class='submit'>
            <input type='submit' name='submit' id='submit' class='button button-primary' value='Update Department'>
        </p>
    </form>
    </div>
    ";
}

?>