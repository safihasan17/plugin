<?php

function hr_department_list()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hr_departments';

    // Handle delete
    if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'delete') {
        $id = intval($_GET['id']);
        if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'delete_department_' . $id)) {
            $wpdb->delete($table_name, array('id' => $id));
            echo "<div class='notice notice-success is-dismissible'><p>Department deleted successfully.</p></div>";
        }
    }

    $departments = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");

    echo "<div class='wrap'>";
    echo "<h1 class='wp-heading-inline'>Departments</h1>";
    echo "<a href='" . admin_url('admin.php?page=hr-departments-add') . "' class='page-title-action'>Add New</a>";

    echo "
    <table class='wp-list-table widefat fixed striped table-view-list tags'>
	<thead>
	<tr>
		<th scope='col' class='manage-column column-name column-primary'>Name</th>
		<th scope='col' class='manage-column column-description'>Description</th>
		<th scope='col' class='manage-column'>Created At</th>
		<th scope='col' class='manage-column'>Actions</th>
	</tr>
	</thead>
	<tbody id='the-list'>";

    if ($departments) {
        foreach ($departments as $dept) {
            $edit_url   = admin_url('admin.php?page=hr-departments-edit&id=' . $dept->id);
            $delete_url = wp_nonce_url(
                admin_url('admin.php?page=hr-departments&action=delete&id=' . $dept->id),
                'delete_department_' . $dept->id
            );

            $created_at = date('d M, Y h:i A', strtotime($dept->created_at));

            echo "
            <tr id='dept-{$dept->id}'>
                <td class='name column-name has-row-actions column-primary' data-colname='Name'>
                    <strong><a class='row-title' href='{$edit_url}'>" . esc_html($dept->name) . "</a></strong>
                    
                </td>
                <td class='description column-description' data-colname='Description'>" . esc_html($dept->description) . "</td>
                <td data-colname='Created At'>" . esc_html($created_at) . "</td>
                <td>
                <div class=''>
                        <span class='edit'><a href='{$edit_url}'>Edit</a> | </span>
                        <span class='delete'><a href='{$delete_url}' onclick=\"return confirm('Are you sure you want to delete this department?');\" style='color:#b32d2e;'>Delete</a></span>
                    </div>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No departments found yet.</td></tr>";
    }

    echo "
	</tbody>
	</table>
    </div>";
}
