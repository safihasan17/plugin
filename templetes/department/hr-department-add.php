<?php
  

    if (isset($_POST['submit'])) {

        global $wpdb;
        $table = $wpdb->prefix . 'hr_departments';
        $wpdb->insert(
            $table,
            array(
                'name'        => $_POST['name'],
                'description' => $_POST['description'],
            )
        );

        $insert_id = $wpdb->insert_id;
        if ($insert_id) {
            echo '<div class="notice notice-success is-dismissible">
          <p> Department saved successfully </p>
        </div>';
        } else {
            echo '<div class="notice notice-error is-dismissible">
          <p> Data not inserted </p>
        </div>';
        }
    };

    echo "
    <div class='form-wrap'>
<h2>Add Department</h2>
<form method='post' class='validate'>

<div class='form-field term-name-wrap'>
    <label>Name</label>
    <input name='name' type='text' value='' size='40' aria-required='true' aria-describedby='name-description'>
</div>

<div class='form-field term-slug-wrap'>
    <label>Description</label>
    <textarea name='description' rows='5' cols='40' aria-describedby='slug-description'></textarea>
</div>

<p class='submit'>
    <input type='submit' name='submit' id='submit' class='button button-primary' value='Add Department'>
    <span class='spinner'></span>
</p>
</form>
</div>
";

?>