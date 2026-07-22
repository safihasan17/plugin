<?php


    global $wpdb;
    $table_name = $wpdb->prefix . 'hr_employees';

    // Handle delete
    if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'delete') {
        $id = intval($_GET['id']);
        if (isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'delete_employee_' . $id)) {
            $wpdb->delete($table_name, array('id' => $id));
            echo "<div class='notice notice-success is-dismissible'><p>Employee deleted successfully.</p></div>";
        }
    }

    $employees = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");

    echo "<div class='wrap'>";
    echo "<h1 class='wp-heading-inline'>Employees</h1>";
    echo "<a href='" . admin_url('admin.php?page=hr-employees-add') . "' class='page-title-action'>Add New</a>";

    echo "
    <table class='wp-list-table widefat fixed striped table-view-list tags'>
	<thead>
	<tr>
		<th scope='col' class='manage-column column-name column-primary'>Name</th>
		<th scope='col' class='manage-column'>Department</th>
		<th scope='col' class='manage-column'>Designation</th>
		<th scope='col' class='manage-column'>Email</th>
		<th scope='col' class='manage-column'>Phone</th>
		<th scope='col' class='manage-column'>Status</th>
		<th scope='col' class='manage-column'>Created At</th>
		<th scope='col' class='manage-column'>Actions</th>
	</tr>
	</thead>
	<tbody id='the-list'>";

    if ($employees) {
        foreach ($employees as $emp) {
            $edit_url   = admin_url('admin.php?page=hr-employees-edit&id=' . $emp->id);
            $delete_url = wp_nonce_url(
                admin_url('admin.php?page=hr-employees&action=delete&id=' . $emp->id),
                'delete_employee_' . $emp->id
            );

            $department_name = '—';
            if ($emp->department_id) {
                $department_name = $wpdb->get_var($wpdb->prepare(
                    "SELECT name FROM " . $wpdb->prefix . "hr_departments WHERE id = %d",
                    $emp->department_id
                ));
                $department_name = $department_name ? $department_name : '—';
            }

            $designation_name = '—';
            if ($emp->designation_id) {
                $designation_name = $wpdb->get_var($wpdb->prepare(
                    "SELECT name FROM " . $wpdb->prefix . "hr_designations WHERE id = %d",
                    $emp->designation_id
                ));
                $designation_name = $designation_name ? $designation_name : '—';
            }

            $created_at = date('d M, Y h:i A', strtotime($emp->created_at));

            $status_labels = array('active' => 'Active', 'inactive' => 'Inactive', 'on_leave' => 'On Leave');
            $status_text   = isset($status_labels[$emp->status]) ? $status_labels[$emp->status] : $emp->status;

            echo "
            <tr id='emp-{$emp->id}'>
                <td class='name column-name has-row-actions column-primary' data-colname='Name'>
                    <strong><a class='row-title' href='{$edit_url}'>" . esc_html($emp->name) . "</a></strong>
                </td>
                <td data-colname='Department'>" . esc_html($department_name) . "</td>
                <td data-colname='Designation'>" . esc_html($designation_name) . "</td>
                <td data-colname='Email'>" . esc_html($emp->email) . "</td>
                <td data-colname='Phone'>" . esc_html($emp->phone) . "</td>
                <td data-colname='Status'>" . esc_html($status_text) . "</td>
                <td data-colname='Created At'>" . esc_html($created_at) . "</td>
                <td>
                <div class=''>
                        <span class='edit'><a href='{$edit_url}'>Edit</a> | </span>
                        <span class='delete'><a href='{$delete_url}' onclick=\"return confirm('Are you sure you want to delete this employee?');\" style='color:#b32d2e;'>Delete</a></span>
                    </div>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No employees found yet.</td></tr>";
    }

    echo "
	</tbody>
	</table>
    </div>";


?>
