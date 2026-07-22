<?php


    if (isset($_POST['submit'])) {

        global $wpdb;
        $table = $wpdb->prefix . 'hr_designations';
        $wpdb->insert(
            $table,
            array(
                'name'          => $_POST['name'],
                'department_id' => $_POST['department_id'],
            )
        );

        $insert_id = $wpdb->insert_id;
        if ($insert_id) {
            echo '<div class="notice notice-success is-dismissible">
          <p> Designation saved successfully </p>
        </div>';
        } else {
            echo '<div class="notice notice-error is-dismissible">
          <p> Data not inserted </p>
        </div>';
        }
    };

    global $wpdb;
    $departments = $wpdb->get_results("SELECT id, name FROM " . $wpdb->prefix . "hr_departments ORDER BY name ASC");

    echo "
    <div class='form-wrap'>
<h2>Add Designation</h2>
<form method='post' class='validate'>

<div class='form-field term-name-wrap'>
    <label>Name</label>
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

<p class='submit'>
    <input type='submit' name='submit' id='submit' class='button button-primary' value='Add Designation'>
    <span class='spinner'></span>
</p>
</form>
</div>
";

?>
