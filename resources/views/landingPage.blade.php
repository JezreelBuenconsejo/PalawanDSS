<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Palawan DSS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/landingPageBootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#" style="font-size: 18px;">Palawan Waste Decision Support System</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#About">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Team">Team</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ContactUs">Contact Us</a></li>
                </ul>
                @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                    <span class="navbar-text"><a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a></span>
                    @else
                    <span class="navbar-text"><a href="{{ route('login') }}" class="nav-link">Log in</a></span>
                    @endauth
                </div>
            @endif
                
            </div>
        </div>
    </nav>
    <main class="page landing-page">
        <section class="clean-block clean-hero" style="color: rgba(93,247,109,0.85);border-color: rgba(93,247,109,0.85);background: url(&quot;assets/img/tech/Sanitary-landfills-Design-4.jpg&quot;), #63d68a; background-size:cover;">
            <div class="text">
                <h2>Decision Support System for Ecological Solid Waste Center of Islands Municipalities in Palawan</h2>
                <p><span style="color: rgb(0, 0, 0); background-color: transparent;">The purpose of the decision support system (DSS) is to create aid planners in making decisions on the overall management of solid waste at a small island municipality. The DSS enables sanitary, efficient, and cost-effective solid waste storage, collection, transportation, treatment, and disposal without harming the environment, land, or water system.</span><br><br><br></p><button class="btn btn-outline-light btn-lg" type="button">Learn More</button>
            </div>
        </section>
        <section class="clean-block clean-info dark" id="About">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Info</h2>
                    <p><span style="color: rgb(0, 0, 0); background-color: transparent;">The Developers desire to develop a Web-based System of solid waste management in a small island, which helps the LGU in decision making activities, goal seeking and optimization. </span><br><br></p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6"><img class="img-thumbnail" src="assets/img/scenery/th-plastic.jpg"><img class="img-thumbnail" src="assets/img/scenery/singleuse-plastic-greenpeace.webp"></div>
                    <div class="col-md-6">
                        <h3><span style="color: rgb(0, 0, 0); background-color: transparent;">Basically this web-based application aims:</span><br></h3>
                        <div class="getting-started-info">
                            <p><span style="color: rgb(0, 0, 0); background-color: transparent;">1. To provide user interface for specific user in order to monitor and manipulate data.</span><br><br><span style="color: rgb(0, 0, 0); background-color: transparent;">2. To Develop a digital platform for Local Government Unit&nbsp; (LGU) that organizes, collects and analyzes data that can be used in decision making activities.</span><br><br><span style="color: rgb(0, 0, 0); background-color: transparent;">3. To determine the type of Ecological Center and its option for collection of waste in the selected small island municipalities in Palawan.</span><br><br><span style="color: rgb(0, 0, 0); background-color: transparent;">4.To increase the control, and capability of futuristic decision-making of the LGU.</span><br><br></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Features</h2>
                    <p><span style="color: rgb(68, 68, 68);">The Web-based Decision support system is specifically designed to perform a set of tasks. Thus, it can be viewed as an efficient tool used for solving a particular set of problems.</span><br><br></p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-5 feature-box"><i class="icon-star icon"></i>
                        <h4>Usability</h4>
                        <p>The Web-Based System has a<strong><span style="color: rgb(95, 99, 104);">&nbsp;</span></strong><span style="color: rgb(95, 99, 104);">capacity of&nbsp; to provide a condition for its users to perform the tasks safely, effectively, and efficiently.</span><br><br></p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-screen-desktop icon"></i>
                        <h4>Project Dashboard</h4>
                        <p>The Web-Based System provides monitoring plan for your Solid waste disposal in Island Municipality</p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-screen-smartphone icon"></i>
                        <h4>Responsive</h4>
                        <p><span style="color: rgb(51, 50, 50);">The Web-Based System is developed to facilitate its users with numerous capabilities, to ensure smooth operations of the respective task.</span><br><br></p>
                    </div>
                    <div class="col-md-5 feature-box"><i class="icon-refresh icon"></i>
                        <h4>All Browser Compatibility</h4>
                        <p><span style="color: rgb(32, 33, 36);">The&nbsp; developers want to provide a consistent experience for End-User. Making&nbsp;sure the site runs efficiently for a better user experience.&nbsp;</span><br><br></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block slider dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Palawan</h2>
                    <p><span style="color: rgb(32, 33, 36); background-color: rgb(255, 255, 255);">One of the best places to visit in the Philippines, is consistently ranked as one of the best islands in the world, and for a good reason. It boasts&nbsp;white sand beaches and islands, clear blue waters, a spectacular variety of marine life and shipwreck sites, and majestic towering limestone cliffs.</span><br><br>&nbsp;Let us all protect and preserve our treasure Islands</p>
                </div>
                <div class="carousel slide" data-bs-ride="carousel" id="carousel-1">
                    <div class="carousel-inner">
                        <div class="carousel-item active"><img class="w-100 d-block" src="assets/img/scenery/505894bc-b3a5-410c-b257-6e9467bbcac0.jpg" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="assets/img/scenery/cf9466f8-a386-4a6f-9f7f-4966077073d1.jpg" alt="Slide Image"></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="assets/img/scenery/7d9a55e0-93b2-4ff3-946d-8f0c5a593292.jpg" alt="Slide Image"></div>
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="clean-block about-us" id="Team">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Team</h2>
                    <p>&nbsp;The Developer of Web-Based Decision Support System for Solid Waste Disposal Center of Island Municipality <br><br>4th Year College Students of Palawan State University taking up Bachelor of Science in Computer Science.</p>
                </div>
                <div class="row gy-3 justify-content-center" style="margin-bottom: 0px;">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="assets/img/avatars/172310918_1864468880374443_5942431144869244148_n.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Jezreel Jose Buenconsejo</h4>
                                <p class="card-text">BSCS 4th Year<br>Palawan State University</p>
                                <div class="icons"><a href="#"><i class="icon-social-facebook"></i></a><a href="#"><i class="icon-social-instagram"></i></a><a href="#"><i class="icon-social-twitter"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="assets/img/avatars/306930414_3224922437758616_7053087656978589638_n.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Jesfert Roy Pabon</h4>
                                <p class="card-text">BSCS 4th Year<br>Palawan State University<br></p>
                                <div class="icons"><a href="#"><i class="icon-social-facebook"></i></a><a href="#"><i class="icon-social-instagram"></i></a><a href="#"><i class="icon-social-twitter"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="assets/img/avatars/117643819_705597696656298_4432439670189330094_n.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Reven Jeremiah Maglaque</h4>
                                <p class="card-text">BSCS 4th Year<br>Palawan State University<br></p>
                                <div class="icons"><a href="#"><i class="icon-social-facebook"></i></a><a href="#"><i class="icon-social-instagram"></i></a><a href="#"><i class="icon-social-twitter"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="assets/img/avatars/311244973_413961490917119_3525706715326300630_n.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Jayhan S. Bairulla</h4>
                                <p class="card-text">BSCS 4th Year<br>Palawan State University<br></p>
                                <div class="icons"><a href="#"><i class="icon-social-facebook"></i></a><a href="#"><i class="icon-social-instagram"></i></a><a href="#"><i class="icon-social-twitter"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center clean-card"><img class="card-img-top w-100 d-block" src="assets/img/avatars/295496586_1599690043761119_5395132662021850570_n.jpg">
                            <div class="card-body info">
                                <h4 class="card-title">Francis Deo H. Almazan</h4>
                                <p class="card-text">BSCS 4th Year<br>Palawan State University<br></p>
                                <div class="icons"><a href="#"><i class="icon-social-facebook"></i></a><a href="#"><i class="icon-social-instagram"></i></a><a href="#"><i class="icon-social-twitter"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block clean-form dark" id="ContactUs">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Contact Us</h2>
                    <p></p>
                </div>
                <form>
                    <div class="mb-3"><label class="form-label" for="name">Name</label><input class="form-control" type="text" id="name" name="name"></div>
                    <div class="mb-3"><label class="form-label" for="subject">Subject</label><input class="form-control" type="text" id="subject" name="subject"></div>
                    <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" type="email" id="email" name="email"></div>
                    <div class="mb-3"><label class="form-label" for="message">Message</label><textarea class="form-control" id="message" name="message"></textarea></div>
                    <div class="mb-3"><button class="btn btn-primary" type="submit">Send</button></div>
                </form>
            </div>
        </section>
    </main>
    <footer class="page-footer dark">
        <div class="footer-copyright">
            <p>© 2022 Copyright Text</p>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
    <script src="assets/js/vanilla-zoom.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>