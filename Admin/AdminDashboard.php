<?php
    require_once('../connection.php');
    session_start();

    include('../checkLogin.php');

    $accoundid = $_SESSION['accountID'];

    // Query for List of Accounts
    $account_query = "SELECT ac.accountID, IF(role='student',st.studentName, IF(role='school', sc.schoolName, IF(role='facilitator', fc.facilitatorName, hr.accountID))) AS Name, ac.email, ac.role
                    FROM account ac
                        LEFT JOIN student st ON st.accountID = ac.accountID
                        LEFT JOIN school sc ON sc.accountID = ac.accountID
                        LEFT JOIN facilitator fc ON fc.accountID = ac.accountID
                        LEFT JOIN hr ON hr.accountID = ac.accountID
                    WHERE NOT ac.accountID = ?";
    $account_stmt = $con->prepare($account_query);
    $account_stmt->bind_param("i", $accoundid);
    $account_stmt->execute();
    $account_stmt_result = $account_stmt->get_result();
    $accounts_detail = array();
    // Store query result inside array
    while($account_row = $account_stmt_result->fetch_assoc()) {
        $accounts_detail[] = $account_row;
    }

    $account_stmt->close();

    $total_items = count($accounts_detail);
    $items_per_page = 10;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>wisdom-1</title>
    <link rel="stylesheet" href="admin-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="admin-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="admin-assets/css/Bootstrap-Cards-v2.css">
    <link rel="stylesheet" href="admin-assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="admin-assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="admin-assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="admin-assets/css/Profile-Edit-Form-styles.css">
    <link rel="stylesheet" href="admin-assets/css/Profile-Edit-Form.css">
</head>

<body style="color: rgb(0,0,0);"><nav class="navbar navbar-light navbar-expand bg-white  topbar static-top">
    <div class="container-fluid"><a href="AdminDashboard.php"><img src="assets/img/logo.png" width="140" height="29" /></a>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown no-arrow mx-1"></li>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img class="border rounded-circle img-profile" src="admin-assets/img/avatars/avatar1.jpeg" /></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="AdminProfile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Edit Profile</a><a class="dropdown-item" href="AdminDashboard.php"><i class="fas fa-home fa-sm fa-fw me-2 text-gray-400"></i>Dashboard</a>
                        <div class="dropdown-divider"></div><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
    <div id="banner" style="height: 250px;background: url(assets/img/banner.jpg) center / cover no-repeat, #d3edff;">
    </div>
        <section id="table">
            <div class="container" style="border-color: rgb(233,78,80);">
                <h1 style="text-align: left;font-weight: bold;margin-bottom: 40px;margin-top: 30px;">Account Roles</h1>
                <div class="table-responsive" style="border-radius: 1.5rem;padding-top: 5px;border: 2px solid rgb(227,230,240);">
                    <table class="table">
                        <thead style="--bs-body-bg: #55565a;">
                            <tr style="--bs-body-bg: #55565a;height: 56.5px;">
                                <th style="padding-left: 30px;padding-right: 0px;padding-bottom: 15px;"><input type="checkbox" id="masterCheckbox" onchange="toggleAllCheckboxes()" style="padding-bottom: 15px;"></th>
                                <th style="padding-bottom: 15px;">Account Name</th>
                                <th style="padding-bottom: 15px;width: 326.594px;">Email</th>
                                <th style="width: 155px;padding-bottom: 15px;">Role</th>
                                <th style="padding-bottom: 15px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
                                $offset = ($page - 1) * $items_per_page;
                                
                                for($i = $offset; ($i < $total_items) & ($i < $offset + $items_per_page); $i++) {
                                    echo " <tr>
                                            <td style=\"padding-left: 30px;padding-right: 0px;\"><input type=\"checkbox\"></td>
                                            <td><h1 style=\"font-size: 16px;\">".$accounts_detail[$i]['Name']."</h1></td>
                                            <td>".$accounts_detail[$i]['email']."</td>
                                            <td>".$accounts_detail[$i]['role']."</td>
                                            <!-- Buttons -->
                                            <td>
                                                <a href=\"AdminEditRole.php?i=".$accounts_detail[$i]['accountID']."\">
                                                    <button class=\"btn btn-primary\" type=\"button\" style=\"border-style: solid;border-radius: .75rem;width: 50px;padding: 10px;margin-right: 15px;\">
                                                        <i class=\"far fa-edit\"></i>
                                                    </button>
                                                </a>
                                                <a onclick=\"confirmDelete(".$accounts_detail[$i]['accountID'].")\">
                                                    <button class=\"btn btn-primary\" type=\"button\" style=\"background: rgb(233,78,80);border-radius: .75rem;width: 50px;padding: 10px;border-style: solid;border-color: #E94E50;\">
                                                        <i class=\"far fa-trash-alt\"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>";
                                    
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
                <nav class="text-center" style="margin-left: 40%;margin-top: 3%;margin-right: 40%;">
                    <ul class="pagination">
                        <?php
                            $total_pages = ceil($total_items / $items_per_page);

                            if ($total_pages > 1) {
                                // Validate the current page number
                                $page = max($page, 1);
                                $page = min($page, $total_pages);
                            
                                // Generate the "Previous" button link
                                $prev_page = $page - 1;
                                if ($prev_page >= 1) {
                                    echo '<li class="page-item"><a class="page-link" aria-label="Previous" href="adminDashboard.php?page=' . $prev_page . '">«</a></li>';
                                }
                            
                                // Create the pagination links
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    if ($i == $page) {
                                        echo '<li class="page-item active"><a class="page-link" href="#">' . $i. '</a></li>';
                                    } else {
                                        echo '<li class="page-item"><a class="page-link" href="adminDashboard.php?page=' .$i. '">'.$i. '</a></li>';
                                    }
                                }
                            
                                // Generate the "Next" button link
                                $next_page = $page + 1;
                                if ($next_page <= $total_pages) {
                                    echo '<li class="page-item"><a class="page-link" aria-label="Next" href="admindashboard.php?page=' . $next_page . '">»</a></li>';
                                }
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </section>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
    
    <script>
        function toggleAllCheckboxes() {
        // Get the state (checked or unchecked) of the master checkbox
        const masterCheckbox = document.getElementById('masterCheckbox');
        const isChecked = masterCheckbox.checked;

        // Get all checkboxes (except the master checkbox) on the page
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#masterCheckbox)');

        // Loop through all checkboxes and set their 'checked' property based on the state of the master checkbox
        checkboxes.forEach((checkbox) => {
            checkbox.checked = isChecked;
        });
        }

        function confirmDelete(id) {
            var response = confirm('Are you sure you would like to delete this account?');
            if(response) {
                fetch('../account-delete.php?deleteid='+id)
                    .then(response => response.text())
                    .then(data => {
                        window.location.replace('AdminDashboard.php');
                    });
            }
            // console.log(response);
        }
    </script>

</body>
</html>
