<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Student Calendar</title>
    <link rel="stylesheet" href="student-assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="student-assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="student-assets/css/Ludens---1-Index-Table-with-Search--Sort-Filters-v20.css">
    <link rel="stylesheet" href="student-assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="student-assets/style.css">
    <link rel="stylesheet" href="student-assets/css/Tasks.css">
</head>

<body style="font-family: Poppins, sans-serif;">
    <nav class="navbar navbar-light navbar-expand bg-white  topbar static-top" style="box-shadow: 0px 0px 2px rgba(33,37,41,0.66);">
        <div class="container-fluid"><a href="index.php"><img src="student-assets/img/logo_black.png" width="140" height="29" /></a>
            <ul class="navbar-nav flex-nowrap ms-auto">
                <li class="nav-item dropdown no-arrow">
                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" ><img class="border rounded-circle img-profile" src="student-assets/img/avatars/avatar1.jpeg" /></a>
                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="StudentProfile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Edit Profile</a><a class="dropdown-item" href="StudentDashboard.php"><i class="fas fa-home fa-sm fa-fw me-2 text-gray-400"></i>Dashboard</a>
                            <div class="dropdown-divider"></div><a id="dashboard_logout" class="dropdown-item"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section style="margin-top: 60px;color:#000000;">
        <div class="container">
            <div class="row">
                 <div class="col-md-8 col-lg-8" style="padding: 0;">
                    <h2 style="font-family: Poppins, sans-serif; font-size: 20px;">Calendar</h2> 
                        <div class="wrapper">
                            <div class="icons">
                                <h1 class="current-date" style="font-family: Poppins,sans-serif; font-weight:bold;"></h1>
                                <span id="prev" class="material-symbols-rounded" style="margin-left: 52%;">&lsaquo;</span>
                                <span id="next" class="material-symbols-rounded" style="margin-left: 55%;">&rsaquo;</span>
                            </div>
                        <div class="calendar">
                        <ul class="weeks">
                            <li>S</li>
                            <li>M</li>
                            <li>T</li>
                            <li>W</li>
                            <li>T</li>
                            <li>F</li>
                            <li>S</li>
                        </ul>
                        <ul class="days"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-xxl-4"> <!--logs and tasks-->
                    <div style="border-radius: 20px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 8px;margin-bottom: 27px;">
                        <div class="btn-group gap-2" role="group" style="width: 100%;height: 30px;"><button class="btn btn-primary" id="dailylogs-btn" type="button" style="border-radius: 50px;width: 50%;background: #ffffff;color: #0017eb;font-size: 15px;padding: 0 12px;">Daily Logs</button><button class="btn btn-primary" id="tasks-btn" type="button" style="border-radius: 50px;width: 50%;background: #0017eb;font-size: 15px;padding: 0 12px;">Tasks</button></div>
                    </div>
                    <div id="tasks-div" class="visible">
                        <div style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;">
                            <div>
                                <h1 class="fw-bold" style="font-size: 25px;">Tasks</h1>
                                <h1 class="fw-semibold" style="font-size: 18px;">Pending Tasks<i class="far fa-trash-alt float-end"></i></h1>
                                <section class="todo-list">
                                    <div class="list" id="todo-list"></div>
                                </section>
                            </div>
                            <hr style="border-width: 1px;border-color: rgb(147,147,147);margin-top: 20px;margin-bottom: 15px;">
                            <div>
                                <h1 class="fw-semibold" style="font-size: 18px;">Completed<i class="far fa-star float-end"></i></h1>
                                <ul id="completed-tasks" class="completed-list">
                                </ul>
                            </div>
                            <section class="create-todo">
                            <form id="new-todo-form">
                                <input 
                                    type="text" 
                                    id="content" 
                                    name="content"
                                    style="width: 100%;border-radius: 50px;padding: 5px 20px;border: 1.5px solid rgb(204,204,204);margin-top: 25px;"
                                    placeholder="Add task here" />
                                <button
                                    class="btn btn-primary"
                                    type="submit"
                                    style="width: 100%;border-radius: 50px;padding: 5px 10px;margin-top: 10px;background: #0017eb; color:white;">
                                    Add new task
                                </button>
                            </form>
                            </section>
                        </div>
                        <div style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;margin-top: 1.5rem;">
                            <div>
                                <h1 class="fw-bold" style="font-size: 20px;">Documentation</h1><input type="file" style="overflow: hidden;width: 255px;">
                            </div><input class="btn btn-primary" type="submit" style="width: 100%;border-radius: 20px;padding: 5px 10px;margin-top: 25px;background: #0017eb;">
                        </div>
                    </div>
                    <div id="dailylogs-div" class="hidden">
                    <div style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;">
                        <div>
                            <h1 class="fw-bold" style="font-size: 25px;">Daily Logs</h1>
                        </div>
                        <div class="row d-flex" style="border-radius: 15px;padding: 14px 7px;border: 1px solid rgb(218,218,218);">
                            <div class="col-auto col-xxl-5 offset-xxl-0 flex-fill align-self-center">
                                <h1 class="fw-semibold d-xxl-flex flex-fill align-items-xxl-center" style="font-size: 18px;text-align: left;margin-bottom: 0px;">Rendered Hours</h1>
                            </div>
                            <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                            <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;" id="rendered-hours">00</h1>
                            <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">hrs</h1>
                        </div>
                        <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                            <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;" id="rendered-minutes">00</h1>
                            <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">mins</h1>
                        </div>
                        </div>
                        <div>
                            <div class="row d-flex" style="margin-top: 12px;">
                                <div class="col-auto col-xxl-6 flex-shrink-1 flex-fill">
                                    <label class="form-label flex-shrink-1">Time In</label>
                                    <input type="time" id="time-in" style="width: 100%;height: 37px;border-radius: 25px;padding: 16px;border: 1px solid #dadada;">
                                </div>
                                <div class="col-auto col-xxl-6 flex-shrink-1 flex-fill">
                                    <label class="form-label flex-shrink-1">Time Out</label>
                                    <input type="time" id="time-out" style="width: 100%;border-radius: 25px;padding: 16px;height: 37px;border: 1px solid rgb(218,218,218);">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary d-xxl-flex justify-content-xxl-center align-items-xxl-center" id="new-task" type="button" style="width: 100%;border-radius: 50px;padding: 5px 10px;margin-top: 37px;background: #0017eb;">Submit Hours</button>
                    </div>
                        <div id="total-rendered-div" style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;margin-top: 1.5rem;">
                    <div>
                        <div class="row d-flex" style="padding: 14px 7px;">
                        <div class="col-auto col-xxl-5 offset-xxl-0 flex-fill align-self-center">
                            <h1 class="fw-semibold d-xxl-flex flex-fill align-items-xxl-center" style="font-size: 18px;text-align: left;margin-bottom: 0px;">Total Rendered</h1>
                        </div>
                        <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                            <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;" id="total-rendered-hours">00</h1>
                            <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">hrs</h1>
                        </div>
                        <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                            <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;" id="total-rendered-minutes">00</h1>
                            <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">mins</h1>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div id="total-remaining-div" style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;margin-top: 1.5rem;">
                        <div>
                            <div class="row d-flex" style="padding: 14px 7px;">
                                <div class="col-auto col-xxl-5 offset-xxl-0 flex-fill align-self-center">
                                    <h1 class="fw-semibold d-xxl-flex flex-fill align-items-xxl-center" style="font-size: 18px;text-align: left;margin-bottom: 0px;">Total Remaining</h1>
                                </div>
                                <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                                    <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;" id="total-remaining-hours">00</h1>
                                    <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">hrs</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="total-required-div" style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;margin-top: 1.5rem;">
                        <div>
                            <div class="row d-flex" style="padding: 14px 7px;">
                                <div class="col-auto col-xxl-3 offset-xxl-0 flex-fill align-self-center">
                                    <h1 class="fw-semibold d-xxl-flex flex-fill align-items-xxl-center" style="font-size: 18px;text-align: left;margin-bottom: 0px;">Total Required</h1>
                                </div>
                                <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                                    <input type="number" id="total-required-hours" min="0" max="500" value="0" style="font-family: Poppins,sans-serif; font-weight:bold;font-size: 26px;margin-bottom: 0px;width: 50px;border: none;text-align: center; width:70px;" />
                                    <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">hrs</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="student-assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="student-assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="student-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---1-Index-Table-with-Search--Sort-Filters.js"></script>
    <script src="student-assets/js/Ludens---1-Index-Table-with-Search--Sort-Filters-v20-Ludens---Material-UI-Actions.js"></script>
    <script src="student-assets/js/theme.js"></script>
    <script src="student-assets/script.js"></script>
    <script src="student-assets/js/Daily-Tasks-Toggle.js"></script>
    <script src="student-assets/js/logs.js"></script>
    <script src="../logout.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="scripts/nav.js"></script>
</body>

</html>
