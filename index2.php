<?php
    if(isset($_POST['signin'])){
        header('Location: login.php');
    }
    session_start();
    unset($_SESSION['accountID']);

?>
<!DOCTYPE html>
<html lang="en">
<!-- header-->
<?php include 'includes/header.php'; ?>

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
    <link rel="stylesheet" href="assets/css/Features-Cards-icons.css">
    <link rel="stylesheet" href="assets/css/Landing%20Page.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider-swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/Tasks.css">
    <link rel="stylesheet" href="assets/css/Ultimate-Event-Calendar.css">
</head>

<body style="font-family: Poppins, sans-serif;">
    
        <section style="height: 6200px;">
            <section class="py-4 py-xl-5" style="background: url(&quot;assets/img/landing_header.svg&quot;); background-size: cover;">
                <div class="container h-100" style="margin-top: 5rem;">
                <div class="row h-100">
                    <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div>
                            <h1 style="font-weight: bold;width: auto;font-size: 60px;">Find the internship of your&nbsp;<span style="color: #0017EB;">Dreams</span></h1>
                            <p class="mb-4" style="font-size: 22px; max-width: 40rem; margin: 0 auto;">Discover your ideal internship and work with professionals. Explore opportunities that fit your goals today!</p>
                            <a href="register.php" class="btn btn-primary fs-5 fw-semibold me-2 py-2 px-4" style="background: #0017EB; border-radius: 5REM; margin-top: 1rem;">Join Now</a>
                        </div>
                    </div>
                </div>
            </div>
        <div class="container py-4 py-xl-5" style="margin-top: 7rem;width: 1040px;">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h1 class="fw-semibold" style="width: auto;font-weight: bold;">Featured Projects</h1>
                    <p>Here are some of the projects done by the WISDOM team:</p>
                </div>
            </div>
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3" style="margin-top: -57px;">
                <div class="col"><a class="text-decoration-none" href="#" style="color: rgb(0,0,0);">
                        <div class="card" style="border-radius: 15px;border-style: none;box-shadow: 0px 3px 8px 0px rgb(215,215,215);padding: 5px 10px;">
                            <div class="card-body p-4"><img width="306" height="80" style="width: 100%;object-fit: cover;height: 130px;border-radius: 15px;" src="assets/img/technotyper.png">
                                <h4 class="card-title" style="margin-top: 16px;font-weight: bold;">TechnoTyper</h4>
                                <p class="card-text" style="font-size: 14px;"><span style="background-color: transparent;">A keyboarding web application to be developed for the purpose of teaching children with ages 4 to 6 years old the QWERTY finger typing method through fun and educational activities that will help develop and master typing skills using a keyboard.</span></p>
                            </div>
                        </div>
                    </a></div>
                <div class="col"><a class="text-decoration-none" href="#" style="color: rgb(0,0,0);">
                        <div class="card" style="border-radius: 15px;border-style: none;box-shadow: 0px 3px 8px 0px rgb(215,215,215);padding: 5px 10px;">
                            <div class="card-body p-4"><img width="306" height="80" style="width: 100%;object-fit: cover;height: 130px;border-radius: 15px;" src="assets/img/original-0219a6b663e274b49d3c5816428c890a.webp">
                                <h4 class="card-title" style="margin-top: 16px;font-weight: bold;">Project Name</h4>
                                <p class="card-text" style="font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a interdum ipsum. Nulla non ultrices ex. Quisque sit amet diam ante. Nullam lacinia, libero semper egestas varius, erat mauris molestie nibh, non vehicula neque massa eu sem.</p>
                            </div>
                        </div>
                    </a></div>
                <div class="col"><a class="text-decoration-none" href="#" style="color: rgb(0,0,0);">
                        <div class="card" style="border-radius: 15px;border-style: none;box-shadow: 0px 3px 8px 0px rgb(215,215,215);padding: 5px 10px;">
                            <div class="card-body p-4"><img width="306" height="80" style="width: 100%;object-fit: cover;height: 130px;border-radius: 15px;" src="assets/img/original-d210c6d256c9abb879cd7600b7e5c276.webp">
                                <h4 class="card-title" style="margin-top: 16px;font-weight: bold;"><strong>Project Name</strong></h4>
                                <p class="card-text" style="font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a interdum ipsum. Nulla non ultrices ex. Quisque sit amet diam ante. Nullam lacinia, libero semper egestas varius, erat mauris molestie nibh, non vehicula neque massa eu sem.</p>
                            </div>
                        </div>
                    </a></div>
            </div>
        </div>
        </section>
        <div class="container" style="margin-top: 5rem;max-width: 960px;">
            <div class="row" id="heading-1">
                <div class="col-md-12" style="text-align: center;">
                    <h4 style="color: rgb(0,23,235);font-family: Poppins, sans-serif;font-size: 20px;margin-bottom: -2px;">Choose Categories</h4>
                    <h1 class="fw-semibold" style="width: auto;font-weight: bold;">Internship Opportunities</h1>
                </div>
            </div>
            <div class="row row-cols-2">
                <div class="col-md-3" style="margin-top: 1rem;"><a href="#marketing-comm">
                        <div class="card card-categories" style="border-style: none;box-shadow: inset 0px 3px 8px 0px rgb(215,215,215);border-radius: 15px;">
                            <div class="card-body" style="height: 100px;padding: 18px;"><i class="fas fa-comments-dollar" style="font-size: 35px;color: rgb(0,23,235);"></i>
                                <div style="display: inline-block;position: absolute;margin-left: 10px;margin-right: 1rem;"><span class="fw-semibold" style="font-family: Poppins, sans-serif;font-size: 15px;color: rgb(0,0,0);">Marketing &amp; Communication</span>
                                    <h6 class="fw-lighter text-muted mb-2" style="font-family: Poppins, sans-serif;font-size: 12px;">12 Jobs Available</h6>
                                </div>
                            </div>
                        </div>
                    </a></div>
                <div class="col-md-3" style="margin-top: 1rem;"><a href="#ui-ux">
                        <div class="card card-categories" style="border-style: none;box-shadow: inset 0px 3px 8px 0px rgb(215,215,215);border-radius: 15px;">
                            <div class="card-body" style="padding: 20px;height: 100px;"><i class="fas fa-pen-nib" style="font-size: 35px;color: rgb(0,23,235);"></i>
                                <div style="display: inline-block;position: absolute;margin-right: 1rem;margin-left: 10px;"><span class="fw-semibold" style="font-family: Poppins, sans-serif;font-size: 15px;color: rgb(0,0,0);">UI/UX Design</span>
                                    <h6 class="fw-lighter text-muted mb-2" style="font-family: Poppins, sans-serif;font-size: 12px;">12 Jobs Available</h6>
                                </div>
                            </div>
                        </div>
                    </a></div>
                <div class="col-md-3" style="margin-top: 1rem;"><a href="#finance-management">
                        <div class="card card-categories" style="border-style: none;box-shadow: inset 0px 3px 8px 0px rgb(215,215,215);border-radius: 15px;">
                            <div class="card-body" style="height: 100px;padding: 20px;"><i class="fas fa-donate" style="font-size: 35px;color: rgb(0,23,235);"></i>
                                <div style="display: inline-block;position: absolute;margin-right: 1rem;margin-left: 10px;"><span class="fw-semibold" style="font-family: Poppins, sans-serif;font-size: 15px;color: rgb(0,0,0);">Finance Management</span>
                                    <h6 class="fw-lighter text-muted mb-2" style="font-family: Poppins, sans-serif;font-size: 12px;">12 Jobs Available</h6>
                                </div>
                            </div>
                        </div>
                    </a></div>
                <div class="col-md-3" style="margin-top: 1rem;"><a href="#web-dev">
                        <div class="card card-categories" style="border-style: none;box-shadow: inset 0px 3px 8px 0px rgb(215,215,215);border-radius: 15px;">
                            <div class="card-body" style="height: 100px;padding: 20px;"><i class="far fa-window-restore" style="font-size: 35px;color: rgb(0,23,235);"></i>
                                <div style="display: inline-block;position: absolute;margin-right: 1rem;margin-left: 10px;"><span class="fw-semibold" style="font-family: Poppins, sans-serif;font-size: 15px;color: rgb(0,0,0);">Web Development</span>
                                    <h6 class="fw-lighter text-muted mb-2" style="font-family: Poppins, sans-serif;font-size: 12px;">12 Jobs Available</h6>
                                </div>
                            </div>
                        </div>
                    </a></div>
                <div class="w-100"></div>
                <div class="w-100"></div>
            </div>
            <div class="row row-cols-2" style="height: auto;">
                <div class="col-md-3" style="margin-top: 1rem;"><a href="#project-management">
                        <div class="card card-categories" style="border-style: none;box-shadow: inset 0px 3px 8px 0px rgb(215,215,215);border-radius: 15px;">
                            <div class="card-body" style="height: 100px;padding: 20px;"><i class="far fa-folder-open" style="font-size: 35px;color: rgb(0,23,235);"></i>
                                <div style="display: inline-block;position: absolute;margin-right: 1rem;margin-left: 10px;"><span class="fw-semibold" style="font-family: Poppins, sans-serif;font-size: 15px;color: rgb(0,0,0);">Project Management</span>
                                    <h6 class="fw-lighter text-muted mb-2" style="font-family: Poppins, sans-serif;font-size: 12px;">12 Jobs Available</h6>
                                </div>
                            </div>
                        </div>
                    </a></div>
                <div class="col-md-3" style="margin-top: 1rem;"><a href="#buss-and-consulting">
                        <div class="card card-categories" style="border-style: none;box-shadow: inset 0px 3px 8px 0px rgb(215,215,215);border-radius: 15px;">
                            <div class="card-body" style="height: 100px;padding: 20px;"><i class="far fa-handshake" style="font-size: 35px;color: rgb(0,23,235);"></i>
                                <div style="display: inline-block;position: absolute;margin-right: 1rem;margin-left: 10px;"><span class="fw-semibold" style="font-family: Poppins, sans-serif;font-size: 15px;color: rgb(0,0,0);">Business &amp; Consulting</span>
                                    <h6 class="fw-lighter text-muted mb-2" style="font-family: Poppins, sans-serif;font-size: 12px;">12 Jobs Available</h6>
                                </div>
                            </div>
                        </div>
                    </a></div>
                <div class="col-md-3" style="margin-top: 1rem;"><a href="#graphic-designer">
                        <div class="card card-categories" style="border-style: none;box-shadow: inset 0px 3px 8px 0px rgb(215,215,215);border-radius: 15px;">
                            <div class="card-body" style="height: 100px;padding: 20px;"><i class="fas fa-paint-brush" style="font-size: 35px;color: rgb(0,23,235);"></i>
                                <div style="display: inline-block;position: absolute;margin-right: 1rem;margin-left: 10px;"><span class="fw-semibold" style="font-family: Poppins, sans-serif;font-size: 15px;color: rgb(0,0,0);">Graphic Designer</span>
                                    <h6 class="fw-lighter text-muted mb-2" style="font-family: Poppins, sans-serif;font-size: 12px;">12 Jobs Available</h6>
                                </div>
                            </div>
                        </div>
                    </a></div>
                <div class="col-md-3" style="margin-top: 1rem;"><a href="#video-editor">
                        <div class="card card-categories" style="border-style: none;box-shadow: inset 0px 3px 8px 0px rgb(215,215,215);border-radius: 15px;">
                            <div class="card-body" style="height: 100px;padding: 20px;"><i class="fas fa-photo-video" style="font-size: 35px;color: rgb(0,23,235);"></i>
                                <div style="display: inline-block;position: absolute;margin-right: 1rem;margin-left: 10px;"><span class="fw-semibold" style="font-family: Poppins, sans-serif;font-size: 15px;color: rgb(0,0,0);">Video Editor</span>
                                    <h6 class="fw-lighter text-muted mb-2" style="font-family: Poppins, sans-serif;font-size: 12px;">12 Jobs Available</h6>
                                </div>
                            </div>
                        </div>
                    </a></div>
            </div>
        </div>
        <section style="margin-top: 3rem;">
            <div class="container" style="display: flex; align-items: flex-start; width: 1319px; max-width: 960px; position: relative;">
            <img class="about-us-img" style="object-fit: cover; max-height: 650px; max-width: 700px; width: 630px; height: 700px; border-radius: 35px;" src="assets/img/about-us-img.png">
                <h3 id="abt-us" style="font-weight: bold; text-align: left; font-size: 16px; color: #0017EB; position: absolute; top: 8rem; right: 19.4rem; margin: 1rem;">About Us</h3>
                <h2 id="abt-wisdom" style="font-weight: bold; text-align: left; max-width:16rem; font-size: 26px; color: Gray 1; position: absolute; top: 10rem; right: 8rem; margin: 1rem;">What is WISDOM all about?</h2>
                <h4 id="wisdom-desc" style="text-align: justify; max-width:15rem; font-size: 13px; color: #000000; position: absolute; top: 15rem; right: 8.9rem; margin: 1rem;">FortWorth Inc. (PCMed - Technokids Philippines) is a premier I.T. company in the country specializing in I.T. solutions and providing I.T. education to our partners. <br><br> Its <span style="color:#1B3996">mission</span> is to combine education and technology to provide children with the core computing skills that will best prepare them for the future. <br><br> Its <span style="color:#1B3996">vision</span> is to be the leading pivotal force in transforming the Filipinos into becoming tech-savvy citizens who will make the Philippines an economically progressive and technologically advanced country.</h4>
             </div>
        </section>
        <section style="margin-top: 5rem;">
            <div class="container" style="width: 1319px;max-width: 1015px;">
                <h1 id="marketing-comm" style="font-weight: bold;text-align: left;font-size: 30px;margin-bottom: 16px;">Marketing &amp; Communication</h1>
                <div class="simple-slider" style="height: 300px;">
                    <div class="swiper-container" style="height: 320px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/socialmed.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Social Media Manager</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/consultant.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Advertising Consultant</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/marketing.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Digital Marketing Specialist</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/promotions.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Promotions Coordinator</h1>
                                </a></div>
                        </div>
                        <div class="swiper-pagination" style="margin-top: 103px;"></div>
                        <div class="swiper-button-prev" style="color: rgb(255,255,255);"></div>
                        <div class="swiper-button-next" style="color: rgb(255,255,255);"></div>
                    </div>
                </div>
            </div>
        </section>
        <section style="margin-top: 8rem;">
            <div class="container" style="width: 1319px;max-width: 1015px;">
                <h1 id="ui-ux" style="font-weight: bold;text-align: left;font-size: 30px;margin-bottom: 16px;">UI/UX Design</h1>
                <div class="simple-slider" style="height: 300px;">
                    <div class="swiper-container" style="height: 320px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/ui-designer.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">UI Designer</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/ux-designer.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">UX Designer</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/ui-ux.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">UI/UX Designer Specialist</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/jr-ui-ux.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Jr. UI/UX Designer</h1>
                                </a></div>
                        </div>
                        <div class="swiper-pagination" style="margin-top: 103px;"></div>
                        <div class="swiper-button-prev" style="color: rgb(255,255,255);"></div>
                        <div class="swiper-button-next" style="color: rgb(255,255,255);"></div>
                    </div>
                </div>
            </div>
        </section>
        <section style="margin-top: 8rem;">
            <div class="container" style="width: 1319px;max-width: 1015px;">
                <h1 id="finance-management" style="font-weight: bold;text-align: left;font-size: 30px;margin-bottom: 16px;">Finance Management</h1>
                <div class="simple-slider" style="height: 300px;">
                    <div class="swiper-container" style="height: 320px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/fin-analyst.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Financial Analyst</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/fin-planner.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Financial Planner</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/fin-manager.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Finance Manager</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/fin-specialist.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Financial Specialist</h1>
                                </a></div>
                        </div>
                        <div class="swiper-pagination" style="margin-top: 103px;"></div>
                        <div class="swiper-button-prev" style="color: rgb(255,255,255);"></div>
                        <div class="swiper-button-next" style="color: rgb(255,255,255);"></div>
                    </div>
                </div>
            </div>
        </section>
        <section style="margin-top: 8rem;">
            <div class="container" style="width: 1319px;max-width: 1015px;">
                <h1 id="web-dev" style="font-weight: bold;text-align: left;font-size: 30px;margin-bottom: 16px;">Web Development</h1>
                <div class="simple-slider" style="height: 300px;">
                    <div class="swiper-container" style="height: 320px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/front-end.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Front-end Web Developer</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/back-end.png">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Back-end Web Developer</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/full-stack.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Full Stack Web Developer</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/jr-web-dev.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Jr. Web Developer</h1>
                                </a></div>
                        </div>
                        <div class="swiper-pagination" style="margin-top: 103px;"></div>
                        <div class="swiper-button-prev" style="color: rgb(255,255,255);"></div>
                        <div class="swiper-button-next" style="color: rgb(255,255,255);"></div>
                    </div>
                </div>
            </div>
        </section>
        <section style="margin-top: 8rem;">
            <div class="container" style="width: 1319px;max-width: 1015px;">
                <h1 id="project-management" style="font-weight: bold;text-align: left;font-size: 30px;margin-bottom: 16px;">Project Management</h1>
                <div class="simple-slider" style="height: 300px;">
                    <div class="swiper-container" style="height: 320px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/proj-manager.png">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Project Manager</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/proj-coordinator.png">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Project Coordinator</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/associate-proj.png">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Associate Project Manager</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/jr-proj-manager.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Jr. Project Manager</h1>
                                </a></div>
                        </div>
                        <div class="swiper-pagination" style="margin-top: 103px;"></div>
                        <div class="swiper-button-prev" style="color: rgb(255,255,255);"></div>
                        <div class="swiper-button-next" style="color: rgb(255,255,255);"></div>
                    </div>
                </div>
            </div>
        </section>
        <section style="margin-top: 8rem;">
            <div class="container" style="width: 1319px;max-width: 1015px;">
                <h1 id="buss-and-consulting" style="font-weight: bold;text-align: left;font-size: 30px;margin-bottom: 16px;">Business & Consulting</h1>
                <div class="simple-slider" style="height: 300px;">
                    <div class="swiper-container" style="height: 320px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/bus-consultant.png">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Business Consultant</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/bus-analyst.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Business Analyst</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/bus-associate.png">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Business Consulting Associate</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/bus-manager.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Business Manager</h1>
                                </a></div>
                        </div>
                        <div class="swiper-pagination" style="margin-top: 103px;"></div>
                        <div class="swiper-button-prev" style="color: rgb(255,255,255);"></div>
                        <div class="swiper-button-next" style="color: rgb(255,255,255);"></div>
                    </div>
                </div>
            </div>
        </section>
        <section style="margin-top: 8rem;">
            <div class="container" style="width: 1319px;max-width: 1015px;">
                <h1 id="graphic-designer" style="font-weight: bold;text-align: left;font-size: 30px;margin-bottom: 16px;">Graphic Designer</h1>
                <div class="simple-slider" style="height: 300px;">
                    <div class="swiper-container" style="height: 320px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/multimedia.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Multimedia Artist</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/creative-design.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Creative Design Specialist</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/graphic-artist.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Graphic Artist</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/graphic-visual.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Graphic and Visual Design Analyst</h1>
                                </a></div>
                        </div>
                        <div class="swiper-pagination" style="margin-top: 103px;"></div>
                        <div class="swiper-button-prev" style="color: rgb(255,255,255);"></div>
                        <div class="swiper-button-next" style="color: rgb(255,255,255);"></div>
                    </div>
                </div>
            </div>
        </section>
        <section style="margin-top: 8rem;">
            <div class="container" style="width: 1319px;max-width: 1015px;">
                <h1 id="video-editor" style="font-weight: bold;text-align: left;font-size: 30px;margin-bottom: 16px;">Video Editor</h1>
                <div class="simple-slider" style="height: 300px;">
                    <div class="swiper-container" style="height: 320px;">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/videographer.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Videographer</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/motion-graphics.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Motion Graphics Designer</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/3d-animator.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">3D Animator</h1>
                                </a></div>
                            <div class="swiper-slide" style="border-radius: 15px;max-width: 300px;text-align: center;"><a class="text-decoration-none" href="#"><img class="category-img" style="object-fit: cover;max-height: 250px;max-width: 300px;width: 230px;height: 300px;border-radius: 15px;" src="assets/img/vid-editor.jpg">
                                    <h1 class="sub-category-name" style="max-width: 300px;margin-top: 5px;font-size: 20px;">Video Editor</h1>
                                </a></div>
                        </div>
                        <div class="swiper-pagination" style="margin-top: 103px;"></div>
                        <div class="swiper-button-prev" style="color: rgb(255,255,255);"></div>
                        <div class="swiper-button-next" style="color: rgb(255,255,255);"></div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Card-Carousel-slider.js"></script>
    <script src="assets/js/Daily-Logs-and-Tasks-Toggle.js"></script>
    <script src="assets/js/Simple-Slider-swiper-bundle.min.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
    <script src="assets/js/Task-List.js"></script>
    <script src="assets/js/Ultimate-Event-Calendar.js"></script>

<!-- footer-->
<?php include 'includes/footer.php'; ?>

</body>

</html>
