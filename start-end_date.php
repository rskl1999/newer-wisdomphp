<!DOCTYPE html>
<html lang="en">

<head>   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Layout</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="assets/css/Navbar-With-Button-icons.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
    
    
</head>

<body>
        <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
        <div class="container-fluid"><img src="assets/img/logo_black.png" width="140" height="29"></div></nav>
        <h1 style=><strong>Internship Duration</strong></h1> 

            <form method="post">
                        <?php

                            $startdate = isset($_POST['startdate']) ? $_POST['startdate'] : '';
                            $enddate = isset($_POST['enddate']) ? $_POST['enddate'] : '';

                            $conn = mysqli_connect("localhost", "root", "", "wisdomdb") or die ("connection failed");
                            $query = "INSERT INTO internshipduration (startdate, enddate) VALUES ('{$startdate}', '{$enddate}')";
                            $result = mysqli_query($conn, $query);

                        ?>

                        <label for="startdate">Start Date:</label>
                        <input type="date" id="startdate" name="startdate" required>

                        <br>

                        <!-- label same w/ id -->
                        <label for="enddate">End Date:</label>
                        <input type="date" id="enddate" name="enddate" required>
                        
                        <br>

                        <!-- <button type="submit" onclick="return showConfirmation()">Submit</button> -->
            

    <button class="btn btn-primary" type="button" style="position: fixed; bottom: 20px; right: 140px; border-radius: 35px;background: rgba(0,23,235,0);font-family: Poppins, sans-serif;width: 106.7812px;padding: 10px 16px;color: #0017eb;border-width: 2px;border-color: #0017eb;font-weight: bold;">Back</button>
    <button class="btn btn-primary" type="submit" onclick="return showConfirmation()" style="position: fixed; bottom: 20px; right: 20px; border-radius: 35px;background: #0017eb;font-family: Poppins, sans-serif;width: 106.7812px;padding: 10px 16px;">Submit</button>
    <!-- <button type="submit" onclick="return showConfirmation()">Submit</button> -->
    </form>



    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="assets/js/theme.js"></script>
</body>
</html>