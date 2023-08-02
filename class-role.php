<?php

// Shortcode callback function
add_shortcode( 'zib_roles', function() {
    ob_start();
    ?>
    <!-- HTML markup for the roles management system -->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
        <?php get_template_part( 'template-parts/content', 'header' ); ?>
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
            <?php get_template_part( 'template-parts/content', 'dashboard' ); ?>
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        <?php echo get_the_title(); ?>
                                    </h1>
                                </div>
                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <button class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#role_form_model">Create Role</button>
                                </div>
                            </div>
                        </div>
                        <div id="kt_app_content" class="app-content  flex-column-fluid ">
                            <div id="kt_app_content_container" class="app-container  container-xxl ">
                                <div class="row gy-5 g-xl-10">
                                    <div class="col-xl-12">
                                        <div class="card card-flush h-xl-100">
                                            <div class="card-body" id="role_list">
                                                <?php echo zib_role_table(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="role_form_model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal_title">Add Role</h2>
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <div class="modal-body py-lg-10 px-lg-10">
                    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                            <form class="form" id="role_form">
                                <div class="current">
                                    <div class="w-100">
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Role Name</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid mb-2" name="role_name" placeholder="" value="" required />
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Access Level</span>
                                            </label>
                                            <?php
                                                $acc_names =  get_access();
                                                if (!empty($acc_names)) {
                                                    foreach ($acc_names as $acc_name) {
                                                        echo '<label class="form-check form-check-custom form-check-solid me-10">';
                                                        echo '<input class="form-check-input h-20px w-20px" type="checkbox" name="access[]" value="' . esc_attr($acc_name['access_id']) . '" data-role="'. esc_attr($acc_name['access_name']) .'">';
                                                        echo '<span class="form-check-label fw-semibold">'.esc_attr($acc_name['access_name']).'</span>';
                                                        echo '</label><br>';
                                                    }
                                                } else {
                                                    echo 'No access levels found.';
                                                }
                                                ?>
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                <span class="indicator-label">Add<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0"><span class="path1"></span><span class="path2"></span></i> </span>
                                                <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <?php wp_nonce_field( 'role_form', 'nonce' ); ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="update_role_form_model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-900px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal_title">Update Role</h2>
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <div class="modal-body py-lg-10 px-lg-10">
                    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="kt_modal_create_app_stepper">
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                            <form class="form" id="update_role_form">
                                <div class="current">
                                    <div class="w-100">
                                        <div class="fv-row mb-10">
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Role Name</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg form-control-solid mb-2" name="role_name" placeholder="" value="" required />
                                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                <span class="required">Access Level</span>
                                            </label>
                                                <?php
                                                      $acc_names =  get_access();

                                                      if (!empty($acc_names)) {
                                                          foreach ($acc_names as $acc_name) {
                                                            echo '<label class="form-check form-check-custom form-check-solid me-10">';
                                                            echo '<input class="form-check-input h-20px w-20px" type="checkbox" name="access[]" value="' . esc_attr($acc_name['access_id']) . '" data-role="'. esc_attr($acc_name['access_name']) .'">';
                                                            echo '<span class="form-check-label fw-semibold">'.esc_attr($acc_name['access_name']).'</span>';
                                                            echo '</label><br>';
                                                          }
                                                      } else {
                                                          echo 'No access levels found.';
                                                      }
                                                ?>
                                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                                    <span class="required">Status</span>
                                                </label>
                                                <div class="form-check form-check-solid form-check-custom form-switch">
                                                    <input class="form-check-input w-45px h-30px mb-2" name="role_status" type="checkbox" id="role_status">
                                                    <label class="form-check-label" for="role_status"></label>
                                                </div>
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                <span class="indicator-label">Update<i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0"><span class="path1"></span><span class="path2"></span></i> </span>
                                                <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <?php wp_nonce_field( 'role_form', 'nonce' ); ?>
                                            <input type="hidden" name="role_id">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- Rest of your HTML markup -->
    <?php
    return ob_get_clean();
} );


function get_access(){

    global $wpdb;
    $acce_query = 'SELECT access_id, access_name FROM wp_role_access';
    $acc_names = $wpdb->get_results($acce_query, ARRAY_A);

    return $acc_names;
}

function get_roles(){

    global $wpdb;
    $table_name = 'wp_role';
    $role_sql = "SELECT r.id, r.role, r.is_active, GROUP_CONCAT(a.access_name) AS access_names FROM wp_role r
    JOIN wp_role_access a ON FIND_IN_SET(a.access_id, r.role_access)
    GROUP BY r.id, r.role, r.is_active";
    $roles = $wpdb->get_results($role_sql, ARRAY_A);

    return $roles;
}

function zib_role_table(){
    ob_start();

    // $role_sql = "SELECT  r.id, r.role, a.access_name FROM wp_role r JOIN wp_role_access a ON r.access_level_id = a.access_id WHERE r.access_level_id = a.access_id ORDER BY id ASC";

    $roles = get_roles();

    if(!empty($roles)){
        ?>
        <table class="table align-middle table-row-dashed fs-6 gy-3" id="role_table">
            <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="pe-3 min-w-100px">Role ID</th>    
                    <th class="min-w-150px">Role Name</th>
                    <th class="min-w-150px">Access Level</th>
                    <th class="pe-3 min-w-100px">Status</th>
                    <th class="pe-3 min-w-100px">Action</th>
                </tr>
            </thead>
            <tbody class="fw-bold text-gray-600">
                <?php foreach($roles as $key => $role): ?>
                <tr data-role="<?php echo base64_encode(json_encode($role)); ?>">
                    <td>#<?php echo $role['id']; ?> </td>
                    <td>
                        <span class="text-dark text-hover-primary"><?php echo $role['role']; ?></span>
                    </td>
                    <td>
                        <span class="text-dark text-hover-primary"><?php echo  $role['access_names']; ?></span>
                    </td>
                    <td>
                        <span class="badge py-3 px-4 fs-7 <?php echo ($role['is_active'] == 1) ? 'badge-light-primary' : 'badge-light-danger'; ?>">
                            <?php echo ($role['is_active'] == 1) ? 'Active' : 'Deactive'; ?>
                        </span>
                    </td>
                    <td>
                        <a href="" class="btn btn-primary edit_role">Edit</a>
                         <!-- <a href="" class="btn btn-danger delete_role">Delete</a> -->
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    }else{
        ?>
        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
            <i class="ki-duotone ki-design-1 fs-2tx text-primary me-4"></i>
            <div class="d-flex flex-stack flex-grow-1 ">
                <div class=" fw-semibold">
                    <div class="fs-6 text-gray-700 ">No roles available now.</div>
                </div>
            </div>  
        </div>
        <?php
    }
    return ob_get_clean();
}

function create_role() {
    check_ajax_referer( 'role_form', 'nonce' );

    // Get department name from AJAX request
    $role_name = $_POST['role_name'];
    $access_level_id = $_POST['access_level_id'];
    $role_access = $_POST['access'];
    $selectedAccessLevels = $_POST['selected_access_levels'];
    $selectedAccessLevels = stripslashes($selectedAccessLevels); // Remove escaping slashes
    $accessLevelsArray = json_decode($selectedAccessLevels, true);

    if (!empty($accessLevelsArray)) {
        foreach ($accessLevelsArray as $accessLevel) {
            $role = $accessLevel['role'];
            $value = $accessLevel['value'];
        }
    }

    // Perform validation
    if (empty($role_name)) {
        $response = array(
            'success' => false,
            'message' => 'Role name is required.'
        );
        wp_send_json_error( $response );
    }

    if($role_access && !empty($role_access)){
       $rol_acc =  implode(',', $role_access);
    }
    else{
       $rol_acc = $_POST['access'];
    }

    // Save department to the custom table
    global $wpdb;
    $table_name = $wpdb->prefix . 'role'; // Assuming the table name is 'wp_department'

    $result = $wpdb->insert(
        $table_name,
        array(
            'role' => $role_name,
            'role_access' => $rol_acc,
            'is_active' => '1'
        )
    );
    
    $query = $wpdb->last_query;  
    
   // Check if the department was saved successfully
    if ($result !== false) {
        $response = array(
            'status' => 'success',
            'message' => 'Role created successfully.',
            'id' => $wpdb->insert_id,
            'html' => zib_role_table(),
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Failed to create Role.'
        );
    }

    echo json_encode($response);
    exit;
}
add_action( 'wp_ajax_create_role', 'create_role' );
add_action( 'wp_ajax_nopriv_create_role', 'create_role' );

// AJAX handler for updating a department
function update_role() {
    // Check for nonce security
    check_ajax_referer( 'role_form', 'nonce' );

    // Get department name and ID from AJAX request
     $role_name = $_POST['role_name'];
     $role_id = $_POST['role_id'];
     $role_access = $_POST['access'];
     $role_status = ($_POST['role_status'] == 'on') ? 1 : 0;
    // var_dump($dep_status);
    // die;

    global $wpdb;
    $table_name = $wpdb->prefix . 'role'; // Assuming the table name is 'wp_department'

    $result = $wpdb->update(
        $table_name,
        array(
            'role' => $role_name,
            'role_access' => implode(',', $role_access),
            'is_active' => $role_status
        ),
        array(
            'id' => $role_id
        )
    );

    $query = $wpdb->last_query; 
    
    if ($result !== false) {
        // Department updated successfully
        $response = array(
            'status' => 'success',
            'message' => 'Role updated successfully.',
            'id' => $role_id,
            'html' => zib_role_table(),
        );
    } else {
        // Failed to update department
        $response = array(
            'status' => 'error',
            'message' => 'Failed to update Role.'
        );
    }

    echo json_encode($response);
    exit;
}
add_action( 'wp_ajax_update_role', 'update_role' );
add_action( 'wp_ajax_nopriv_update_role', 'update_role' );

// function delete_role() {

//     $role_id = $_POST['role_id'];

//     // Delete role from the database
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'role'; // Assuming the table name is 'wp_role'

//     $result = $wpdb->delete(
//         $table_name,
//         array( 'id' => $role_id )
//     );

//     if ($result !== false) {
//         $response = array(
//             'status' => 'success',
//             'message' => 'Role deleted successfully.',
//         );
//     } else {
//         $response = array(
//             'status' => 'error',
//             'message' => 'Failed to delete role.'
//         );
//     }

//     echo json_encode($response);
//     exit;
// }
// add_action( 'wp_ajax_delete_role', 'delete_role' );
// add_action( 'wp_ajax_nopriv_delete_role', 'delete_role' );


