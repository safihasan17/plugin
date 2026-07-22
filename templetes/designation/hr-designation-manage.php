<?php


    global $wpdb;
    $table_name = $wpdb->prefix . 'hr_designations';

    // Handle delete
    if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'delete') {
        $id = intval($_GET['id']);
        if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'delete_designation_' . $id)) {
            $wpdb->delete($table_name, array('id' => $id));
            echo "<div class='notice notice-success is-dismissible'><p>Designation deleted successfully.</p></div>";
        }
    }

    $designations = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");

    echo "<div class='wrap'>";
    echo "<h1 class='wp-heading-inline'>Designations</h1>";
    echo "<a href='" . admin_url('admin.php?page=hr-designations-add') . "' class='page-title-action'>Add New</a>";

    echo "
    <table class='wp-list-table widefat fixed striped table-view-list tags'>
	<thead>
	<tr>
		<th scope='col' class='manage-column column-name column-primary'>Name</th>
		<th scope='col' class='manage-column'>Department</th>
		<th scope='col' class='manage-column'>Created At</th>
		<th scope='col' class='manage-column'>Actions</th>
	</tr>
	</thead>
	<tbody id='the-list'>";

    if ($designations) {
        foreach ($designations as $desig) {
            $edit_url   = admin_url('admin.php?page=hr-designations-edit&id=' . $desig->id);
            $delete_url = wp_nonce_url(
                admin_url('admin.php?page=hr-designations&action=delete&id=' . $desig->id),
                'delete_designation_' . $desig->id
            );

            $department_name = '—';
            if ($desig->department_id) {
                $department_name = $wpdb->get_var($wpdb->prepare(
                    "SELECT name FROM " . $wpdb->prefix . "hr_departments WHERE id = %d",
                    $desig->department_id
                ));
                $department_name = $department_name ? $department_name : '—';
            }

            $created_at = date('d M, Y h:i A', strtotime($desig->created_at));

            echo "
            <tr id='desig-{$desig->id}'>
                <td class='name column-name has-row-actions column-primary' data-colname='Name'>
                    <strong><a class='row-title' href='{$edit_url}'>" . esc_html($desig->name) . "</a></strong>
                </td>
                <td data-colname='Department'>" . esc_html($department_name) . "</td>
                <td data-colname='Created At'>" . esc_html($created_at) . "</td>
                <td>
                <div class=''>
                        <span class='edit'><a href='{$edit_url}'>Edit</a> | </span>
                        <span class='delete'><a href='{$delete_url}' onclick=\"return confirm('Are you sure you want to delete this designation?');\" style='color:#b32d2e;'>Delete</a></span>
                    </div>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No designations found yet.</td></tr>";
    }

    echo "
	</tbody>
	</table>
    </div>";


?>
