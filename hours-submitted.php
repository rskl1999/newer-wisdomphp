<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>wisdom</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i">
    <link rel="stylesheet" href="assets/css/swiper-icons.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Features-Cards-icons.css">
    <link rel="stylesheet" href="assets/css/Landing%20Page.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider-swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/Tasks.css">
</head>

<body style="font-family: Poppins, sans-serif;">
    <section style="margin-top: 71px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-5 col-xxl-4">
                    <div style="border-radius: 20px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 8px;margin-bottom: 27px;">
                        <div class="btn-group gap-2" role="group" style="width: 100%;height: 30px;"><button class="btn btn-primary" id="dailylogs-btn" type="button" style="border-radius: 50px;width: 50%;background: #0017eb;font-size: 15px;padding: 0 12px;">Daily Logs</button><button class="btn btn-primary" id="tasks-btn" type="button" style="border-radius: 50px;width: 50%;background: #ffffff;font-size: 15px;padding: 0 12px;color: #0017eb;">Tasks</button></div>
                    </div>
                    <div id="dailylogs-div" class="visible">
                        <div style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;">
                            <div>
                                <h1 class="fw-bold" style="font-size: 25px;">Daily Logs</h1>
                            </div>
                            <div class="row d-flex" style="border-radius: 15px;padding: 14px 7px;border: 1px solid rgb(218,218,218);">
                                <div class="col-auto col-xxl-5 offset-xxl-0 flex-fill align-self-center">
                                    <h1 class="fw-semibold d-xxl-flex flex-fill align-items-xxl-center" style="font-size: 18px;text-align: left;margin-bottom: 0px;">Rendered Hours</h1>
                                </div>
                                <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                                    <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;">08</h1>
                                    <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">hrs</h1>
                                </div>
                                <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                                    <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;">08</h1>
                                    <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">mins</h1>
                                </div>
                            </div>
                            <div>
                                <div class="row d-inline-flex" style="margin-top: 12px;">
                                    <div class="col-auto col-xxl-6 flex-shrink-1 flex-fill"><label class="form-label flex-shrink-1">Time In</label><input type="time" style="width: 100%;height: 37px;border-radius: 25px;padding: 16px;border: 1px solid #dadada;"></div>
                                    <div class="col-auto col-xxl-6 flex-shrink-1 flex-fill"><label class="form-label flex-shrink-1">Time Out</label><input type="time" style="width: 100%;border-radius: 25px;padding: 16px;height: 37px;border: 1px solid rgb(218,218,218);"></div>
                                </div>
                            </div><button class="btn btn-primary d-xxl-flex justify-content-xxl-center align-items-xxl-center" id="new-task" type="button" style="width: 100%;border-radius: 50px;padding: 5px 10px;margin-top: 37px;background: #BDCBD3; border-color: #BDCBD3;">Submitted Hours<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" style="margin-left: 5px;">
                                    <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                    <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                                </svg></button>
                        </div>
                        <div id="total-rendered-div" style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;margin-top: 1.5rem;">
                            <div>
                                <div class="row d-flex" style="padding: 14px 7px;">
                                    <div class="col-auto col-xxl-5 offset-xxl-0 flex-fill align-self-center">
                                        <h1 class="fw-semibold d-xxl-flex flex-fill align-items-xxl-center" style="font-size: 18px;text-align: left;margin-bottom: 0px;">Total Rendered</h1>
                                    </div>
                                    <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                                        <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;">08</h1>
                                        <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">hrs</h1>
                                    </div>
                                    <div class="col-auto col-xxl-3 d-inline-flex flex-fill justify-content-center align-items-xxl-center">
                                        <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;">08</h1>
                                        <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">mins</h1>
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
                                        <h1 class="fw-semibold" style="font-size: 26px;margin-bottom: 0px;">200</h1>
                                        <h1 class="fw-normal" style="font-size: 15px;margin-bottom: 0px;margin-left: 3px;">hrs</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tasks-div" class="visible">
                        <div style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;">
                            <div>
                                <h1 class="fw-bold" style="font-size: 25px;">Tasks</h1>
                                <h1 class="fw-semibold" style="font-size: 18px;">Pending Tasks<i class="far fa-trash-alt float-end"></i></h1>
                                <ul id="incomplete-tasks">
                                    <li><input type="checkbox"><label class="form-label">Label</label><button class="btn btn-primary float-end delete" type="button" style="padding: 0px;background: rgba(255,255,255,0);border-style: none;height: 22px;"><i class="far fa-trash-alt delete" style="color: rgb(221,21,21);"></i></button><button class="btn btn-primary float-end edit" type="button" style="padding: 0px;background: rgba(255,255,255,0);border-style: none;height: 22px;"><i class="far fa-edit edit" style="color: #0017eb;font-size: 17px;"></i></button></li>
                                    <li class="editMode"><input type="checkbox"><label class="form-label">Finish Task</label><input type="text"><button class="btn btn-primary float-end delete" type="button" style="padding: 0px;background: rgba(255,255,255,0);border-style: none;height: 22px;"><i class="far fa-trash-alt delete" style="color: rgb(221,21,21);"></i></button><button class="btn btn-primary float-end edit" type="button" style="padding: 0px;background: rgba(255,255,255,0);border-style: none;height: 22px;"><i class="far fa-edit edit" style="color: #0017eb;font-size: 17px;"></i></button></li>
                                </ul>
                            </div>
                            <hr style="border-width: 1px;border-color: rgb(147,147,147);margin-top: 20px;margin-bottom: 15px;">
                            <div>
                                <h1 class="fw-semibold" style="font-size: 18px;">Completed<i class="far fa-star float-end"></i></h1>
                                <ul id="completed-tasks">
                                    <li><label class="form-label"><input type="checkbox">Label</label></li>
                                    <li>Item 4</li>
                                    <li style="width: 98px;"></li>
                                </ul>
                            </div><input type="text" id="new-task" style="width: 100%;border-radius: 50px;padding: 5px 20px;border: 1.5px solid rgb(204,204,204);margin-top: 25px;" placeholder="Add task here"><button class="btn btn-primary" id="add-task-btn" type="button" style="width: 100%;border-radius: 50px;padding: 5px 10px;margin-top: 10px;background: #0017eb;">Add New Task</button>
                        </div>
                        <div style="border-radius: 15px;box-shadow: 0px 0px 10px 0px rgba(82,82,82,0.18);padding: 25px;margin-top: 1.5rem;">
                            <div>
                                <h1 class="fw-bold" style="font-size: 20px;">Documentation</h1><input type="file" style="overflow: hidden;width: 255px;">
                            </div><input class="btn btn-primary" type="submit" style="width: 100%;border-radius: 20px;padding: 5px 10px;margin-top: 25px;background: #0017eb;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Card-Carousel-slider.js"></script>
    <script src="assets/js/Daily-Logs-and-Tasks-Toggle.js"></script>
    <script src="assets/js/Simple-Slider-swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
    <script src="assets/js/Task-List.js"></script>
</body>

</html>