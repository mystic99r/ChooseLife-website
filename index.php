<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Service</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="back">
        <!------------------NAVBAR---------------------------->

        <section id="nav-bar">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <nav class="navbar navbar-light">
                        <img src="images/choose-life-logo.jpg" width="180" height="100" alt="Choose Life Logo">
                    </nav>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#nav-bar">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nurse.php">Nurses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.php">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.dmhospital.org/Feedbacks">Feedbacks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.dmhospital.org/careers">Openings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profile"><i class="fa fa-user-circle"></i></a>
                            <div class="dropdown-content">
                                <?php
                                if ($_SESSION['user_data']) {
                                    echo '<a class="drop" href="logout.php">Logout</a>';
                                } else {
                                    echo '<a class="drop" href="login.php">Login</a>';
                                }
                                ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </section>

        <!------------------TITLE---------------------------------->
        <section id="banner">
            <div class="row">
                <div class="col-md-5">
                    <p class="promo-title">Healthcare Services</p>
                    <p class="sub-title"><b>We are here to help you find Nurses to cater to your needs. Here you can find a reliable person near you immediately according to your requirement or choice. This website can immediately connect you to the nearest agency/independent help. Also, you can find Top Medical services <a href="#cards" style="text-decoration: none;color: white;"><u>here</u></a> for the betterment of your beautiful Life.</b></p>
                </div>
            </div>
        </section>
    </div>


    <!--------------------CARDS--------------------------------------->
    <section id="cards">
        <div class="container">
            <div class="card-container">
                <div class="card1">
                    <div class="column">
                        <div class="card">
                            <a href="https://deccanhospital.in/">
                                <img src="images/deccanHosp.jpg" alt="card1" style="width: 100%;">
                                <div class="contents">
                                    <h4>Deccan Hardikar Hospital</h4>
                                    <p>Deccan Hardikar Hospital is a pioneer in Orthopedic Care with a wide range of multispeciality services.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="http://ratnahospital.in/">
                                <img src="images/ratna.jpg" alt="card2" style="width: 100%;">
                                <div class="contents">
                                    <h4>Ratna Memorial Hospital</h4>
                                    <p>Ratna Memorial Hospital provides services like Urology, Gynaecology & Obstetrics, Neonatology, General & Laparoscopic Surgery.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://www.jehangirhospital.com/">
                                <img src="images/jehnagir.jpg" alt="card3" style="width: 100%;">
                                <div class="contents">
                                    <h4>Apollo Jehangir Hospital</h4>
                                    <p>Jahangir Hospital provides the best services for all types of surgeries. They have Dentistry, Endocrinology & Diabetology.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://www.kemhospitalpune.org/">
                                <img src="images/kem.jpg" alt="card4" style="width: 100%;">
                                <div class="contents">
                                    <h4>Kem Hospital</h4>
                                    <p>A Multi-Speciality tertiary level private hospital and it is one of the best hospitals for Liver Transplants, Kidney Transplants & Cochlear Implants.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://rubyhall.com/">
                                <img src="images/ruby.jpg" alt="card5" style="width: 100%;">
                                <div class="contents">
                                    <h4>Ruby Hall Clinic</h4>
                                    <p>Ruby Hall Clinic uses advanced technologies for patients to give them better lives. It provides the facility of a virtual clinic & video consultation.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://inamdarhospital.com/">
                                <img src="images/inam.jpg" alt="card6" style="width: 100%;">
                                <div class="contents">
                                    <h5>Inamdar Multispeciality Hospital</h5>
                                    <p>Inamdar Multispeciality Hospital is an endeavor to alleviate the suffering of patients by providing the best of healthcare at an optimal cost.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://www.aimspune.com/">
                                <img src="images/aims.jpeg" alt="card7" style="width: 100%;">
                                <div class="contents">
                                    <h4>AiMS Hospital</h4>
                                    <p>Provides better services for Cardiology, Obstetrics and Gynaecology, Orthopedics & Joint replacements. Gives 24/7 Emergency services.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://www.adityabirlahospital.com/">
                                <img src="images/aditya.jpg" alt="card8" style="width: 100%;">
                                <div class="contents">
                                    <h4>Aditya Birla Hospital</h4>
                                    <p>Inamdar Multispeciality Hospital is an endeavor to alleviate the suffering of patients by providing the best of healthcare at an optimal cost.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://sahyadrihospital.com/">
                                <img src="images/sahyadri.jpg" alt="card9" style="width: 100%;">
                                <div class="contents">
                                    <h4>Sahyadri Hospitals</h4>
                                    <p>It is the best hospital in Pune which provides services for Neurology, Organ Transplants, Haematology, Cardiology. It has 27 years of experience.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://www.noblehrc.com/">
                                <img src="images/noble.jpg" alt="card10" style="width: 100%;">
                                <div class="contents">
                                    <h4>Noble Hospital</h4>
                                    <p>Noble Hospital's specialties are Plastic Surgery, Infectious Disease, Obstetrics & Gynaecology. They provide personalized care and a Team of Experts.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://www.dmhospital.org/careers">
                                <img src="images/openings.jpg" alt="card11" style="width: 100%;">
                                <div class="contents">
                                    <h4>Openings</h4>
                                    <p>Explore career opportunities at DM Hospital and join our dedicated team in providing quality healthcare services.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <a href="https://www.nursys.com/LQC/LQCSearch.aspx">
                                <img src="images/verification.jpg" alt="card12" style="width: 100%;">
                                <div class="contents">
                                    <h4>Verification</h4>
                                    <p>Verify nursing licenses with Nursys QuickConfirm, a licensure verification lookup tool that provides real-time results.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!---------------------About us ----------------------------->
    <section id="about">
        <div class="container">
            <div class="abt">
                <div class="doctor">
                    <img src="images/doc.png" alt="Doctors image">
                </div>
                <div class="txt">
                    <p class="tit">When the Best Come Together, Your Medical Care Gets Even Better.</p>
                    <p class="sub">We <b style="color: rgb(10, 139, 226);">ChooseLife</b> services are glad to help every single person in need of medical urgency. We believe in contributing the fullest in our services and provide you with the ultimate prioritized healthcare service from our side. We hereby promise you to help you even better in ways possible and are very enthusiastic about our bond with you and will make it even stronger day by day.</p>
                </div>
            </div>
        </div>
    </section>

    <!-----------------------Contact ------------------------------->
    <section id="contact">
        <div class="container">
            <div class="cont">
                <p class="text"><b>Phone:</b> +91 8625914425<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+91 8208161788</p>
                <p class="text"><b>Email:</b> Jayahire1910@gmail.com <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ravhad934@gmail.com</p>
                <p class="text"><b>Whatsapp:</b> +91 7218910932 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+91 9503936697</p>
                <p class="text"><b>Ambulance:</b> +91 7666627467 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+91-9511247735</p>
                <hr style="background-color: white;width: 90%;margin-left: 80px;">
                <p class="text1"><i>&copy; 2023. All rights reserved.</i></p>
            </div>
        </div>
    </section>
</body>

</html>
