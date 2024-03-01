<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Bulk Email</title>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css" />

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="navbar">
            <div class="logo">
                <a href="#" class="">
                    <!-- <img src="assets/images/logo-2.png" alt="logo" class="logo" width="80" /> -->
                    <img class="logo" src="logo.png" alt=""> Bulk Emails
                </a>
                <!-- <p class="company-name">Bulk Emails</p> -->
            </div>

            <ul class="links">
                <li><a href="#">Home</a></li>
                <li><a href="#benefits">Features</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#workflow">About</a></li>
                <li><a href="dashboard.html">dashboard</a></li>
            </ul>

            <div class="logins">
                <a class="action_btn" href="./dashboard/user/login">Login</a>
                <a class="action_btn" href="./dashboard/user/register">Sign Up</a>
            </div>

            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

        <!-- <nav>
            <ul class="nav__links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">About</a></li>
                <li><a href="dashboard.html">dashboard</a></li>
            </ul>
        </nav> -->
        <div class="dropdown-container">
            <div class="dropdown_menu">
                <li><a href="#">Home</a></li>
                <li><a href="#benefits">Features</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#workflow">About</a></li>
                <li><a href="dashboard.html">dashboard</a></li>
                <div class="logins">
                    <li><a class="action_btn" href="./dashboard/user/login">Login</a></li>
                    <li><a class="action_btn" href="./dashboard/user/register">Sign Up</a></li>
                </div>
            </div>
        </div>

    </header>

    <!-- Hero Section -->
    <section id="hero">
        <h1>Send Personalized Emails to Thousands in Minutes</h1>
        <p>Streamline your outreach with our bulk email made easy</p>
        <button>Get Started - It's Free!</button>
        <button>Watch Video Demo</button>
    </section>

    <!-- Key Benefits -->
    <section id="benefits">
        <div class="container">
            <div class="features-container">
                <h2 class="section-title">Key Benefits</h2>
                <div class="row">
                    <div class="benefits-wrapper">

                        <div class="benefit">
                            <i class="fa-solid fa-calendar"></i>
                            <!-- <img src="/assets/images/calendar-days-regular.svg" alt="Calendar Icon"> -->
                            <h4>Schedule for Any Date</h4>
                            <p>Schedule your email campaigns to go out whenever it suits your schedule - in 5 minutes or
                                6
                                months
                                from
                                now.</p>
                        </div>

                        <div class="benefit">
                            <i class="fa-solid fa-chart-simple"></i>
                            <!-- <img src="icon2.png" alt="Chart Icon"> -->
                            <h4>Powerful Analytics</h4>
                            <p>Get real-time statistics and in-depth reports on open rates, clicks, unsubscribes, spam
                                complaints
                                and
                                more.</p>
                        </div>

                        <div class="benefit">
                            <i class="fa-solid fa-chart-pie"></i>
                            <!-- <img src="icon3.png" alt="Segment Icon"> -->
                            <h4>Granular Targeting</h4>
                            <p>Precisely target customers based on location, purchase history, preferences and more
                                using
                                flexible
                                segmenting tools.</p>
                        </div>

                        <div class="benefit">
                            <i class="fa-solid fa-inbox"></i>
                            <!-- <img src="icon4.png" alt="Inbox Icon"> -->
                            <h4>Max Inbox Placement</h4>
                            <p>With reliable deliverability and robust sender reputation safeguards, we optimize for
                                inbox
                                placement
                                not
                                the spam folder.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Work Flow -->
    <section id="workflow">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            <div class="timeline">
                <div class="timeline-container left-container">
                    <img src="./assets/images/pen-nib-solid-2.svg" alt="Calendar Icon">
                    <div class="text-box">
                        <h4>Compose Your Email</h4>
                        <p>Write your email content, design templates, and easily personalize messages.</p>

                        <span class="left-container-arrow"></span>
                    </div>
                </div>
                <div class="timeline-container right-container">
                    <img src="./assets/images/person-circle-plus-solid.svg">
                    <div class="text-box">
                        <h4>Add Recipients</h4>
                        <p>Upload recipient lists in bulk via integrated contacts or CSV file imports.</p>
                        <span class="right-container-arrow"></span>

                    </div>
                </div>
                <div class="timeline-container left-container">
                    <img src="./assets/images/share-from-square-solid.svg">
                    <div class="text-box">
                        <h4>Send and Schedule</h4>
                        <p>Once set up, press send or schedule campaigns for the date and time you specify.</p>

                        <span class="left-container-arrow"></span>

                    </div>
                </div>
                <div class="timeline-container right-container">
                    <img src="./assets/images/people-arrows-solid.svg">
                    <div class="text-box">
                        <h4>Track Performance</h4>
                        <p>
                            Review real-time email analytics to optimize open rates, click throughs and return on
                            investment.
                        </p>
                        <span class="right-container-arrow"></span>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Work Flow -->
    <!-- <section id="workflow">

        <div class="container">
            <h2 class="section-title">How It Works</h2>

            <div class="workflow-wrapper">

                <div class="workflow-item">
                    <img src="compose.png">
                    <h4>Compose Your Email</h4>
                    <p>Write your email content, design templates, and easily personalize messages.</p>
                </div>

                <div class="workflow-item">
                    <img src="recipients.png">
                    <h4>Add Recipients</h4>
                    <p>Upload recipient lists in bulk via integrated contacts or CSV file imports.</p>
                </div>

                <div class="workflow-item">
                    <img src="send.png">
                    <h4>Send and Schedule</h4>
                    <p>Once set up, press send or schedule campaigns for the date and time you specify.</p>
                </div>

                <div class="workflow-item">
                    <img src="reports.png">
                    <h4>Track Performance</h4>
                    <p>
                        Review real-time email analytics to optimize open rates, click throughs and return on
                        investment.
                    </p>
                </div>

            </div>
        </div>

    </section> -->

    <!-- Testimonials -->
    <section id="testimonial">
        <div class="container">
            <h2 class="section-title">What Our Clients Say</h2>
            <div class="testimonial-container">
                <div class="testimonial mySwiper">
                    <div class="testi-content swiper-wrapper">
                        <div class="slide swiper-slide">
                            <img src="./assets/images/client5.jpeg" class="image" alt="">
                            <p>
                                This bulk email service has been an invaluable part of our marketing efforts. It was
                                easy to
                                setup
                                and the templates look professional.
                            </p>

                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                            <div class="details">
                                <span class="name">Sarah K.</span>
                                <span class="job">Digital Agency</span>
                            </div>
                        </div>
                        <div class="slide swiper-slide">
                            <img src="./assets/images/client1.jpeg" class="image" alt="">
                            <p>
                                I've used many email marketing tools over the years and this is by far the most
                                effective
                                and
                                affordable service. Highly recommended!
                            </p>

                            <i class='bx bxs-quote-alt-left quote-icon'></i>

                            <div class="details">
                                <span class="name">Mark T.</span>
                                <span class="job">Entrepreneur</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next nav-btn"></div>
                    <div class="swiper-button-prev nav-btn"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing -->
    <section id="pricing">

        <div class="container">
            <h2 class="section-title">Pricing</h2>

            <div class="price-row">

                <div class="price-col-2">
                    <p>Free Plan</p>
                    <div class="price-col">
                        <h3>$0.00 <span>/ month</span></h3>
                        <!-- <span class="price">$9.99</span> -->
                        <ul class="free-plan">
                            <li>10 Emails per month</li>
                            <li>2 Templates</li>
                            <li>Standard Delivery</li>
                            <li>Basic Analytics</li>
                        </ul>
                        <button>Select Plan</button>
                        <!-- <a href="#" class="btn">Select Plan</a> -->
                    </div>
                </div>

                <div class="price-col-2">
                    <p>Basic Plan</p>
                    <div class="price-col">
                        <h3>$9.99 <span>/ month</span></h3>
                        <!-- <span class="price">$9.99</span> -->
                        <ul>
                            <li>10,000 Emails per month</li>
                            <li>Unlimited Templates</li>
                            <li>Standard Delivery</li>
                            <li>Basic Analytics</li>
                        </ul>
                        <button>Select Plan</button>
                        <!-- <a href="#" class="btn">Select Plan</a> -->
                    </div>
                </div>

                <div class="price-col-2">
                    <p>Professional Plan</p>
                    <div class="price-col ">
                        <h3>$14.99 <span>/ month</span></h3>
                        <!-- <span class="price">$14.99</span> -->
                        <ul>
                            <li>50,000 Emails per month</li>
                            <li>Unlimited Templates</li>
                            <li>Advanced Delivery</li>
                            <li>Detailed Analytics</li>
                        </ul>
                        <button>Select Plan</button>
                    </div>
                </div>

                <div class="price-col-2">
                    <p>Enterprise Plan</p>
                    <div class="price-col">
                        <h3>$29.99 <span>/ month</span></h3>
                        <!-- <span class="price">$29.99</span> -->
                        <ul>
                            <li>Unlimited Emails</li>
                            <li>Unlimited Templates</li>
                            <li>Premium Delivery </li>
                            <li>Real-Time Analytics</li>
                        </ul>
                        <button>Select Plan</button>
                    </div>
                </div>

            </div>
        </div>

    </section>


    <!-- <section id="pricing">

        <div class="container">
            <h2 class="section-title">Pricing</h2>

            <div class="pricing-tables">

                <div class="pricing-table">
                    <h4>Basic Plan</h4>
                    <span class="price">$9.99</span>
                    <ul>
                        <li>10,000 Emails per month</li>
                        <li>Unlimited Templates</li>
                        <li>Standard Delivery</li>
                        <li>Basic Analytics</li>
                    </ul>
                    <a href="#" class="btn">Select Plan</a>
                </div>

                <div class="pricing-table featured">
                    <h4>Professional Plan</h4>
                    <span class="price">$14.99</span>
                    <ul>
                        <li>50,000 Emails per month</li>
                        <li>Unlimited Templates</li>
                        <li>Advanced Delivery</li>
                        <li>Detailed Analytics</li>
                    </ul>
                    <a href="#" class="btn">Select Plan</a>
                </div>

                <div class="pricing-table">
                    <h4>Enterprise Plan</h4>
                    <span class="price">$29.99</span>
                    <ul>
                        <li>Unlimited Emails</li>
                        <li>Unlimited Templates</li>
                        <li>Premium Delivery </li>
                        <li>Real-Time Analytics</li>
                    </ul>
                    <a href="#" class="btn btn-accent">Select Plan</a>
                </div>

            </div>
        </div>

    </section> -->

    <!-- Call to action -->
    <section id="call-to-action">
        <h2 class="section-title">Ready to Get Started?</h2>
        <p>Sign up now to start sending bulk emails!</p>
        <button>Sign Up Now</button>
    </section>


    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col">
                <div class="logo-2">
                    <a href="#" class="">
                        Bulk Emails
                    </a>
                </div>
                <!-- <img src="/assets/images/logo.PNG" class="logo" alt=""> -->
                <p>Streamline your outreach with our bulk email made easy</p>
            </div>
            <div class="col">
                <h3>Office <div class="underline"><span></span></div>
                </h3>
                <p>Lenana Road</p>
                <p>iHub, Senteu Plaza</p>
                <p>PQ6M+97, Nairobi</p>
                <p class="email-id">felixprogrammer76@gmail.com</p>
                <h4>+254-768-850-167</h4>
            </div>
            <div class="col">
                <h3>Links <div class="underline"><span></span></div>
                </h3>
                <ul>
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#workflow">About</a></li>
                    <li><a href="#benefits">Features</a></li>
                    <li><a href="#contact">Contact</a></li>

                </ul>
            </div>
            <div class="col">
                <h3>Newsletter <div class="underline"><span></span></div>
                </h3>
                <form action="">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" placeholder="Enter your email here" required>
                    <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
                <div class="social-icons">
                    <i class="fa-brands fa-x-twitter"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                    <i class="fa-brands fa-facebook"></i>
                </div>
            </div>
        </div>
        <hr>
        <p class="copyright">&copy; 2024 Bulk Emails. All rights reserved.</p>
    </footer>


    <!-- <footer>
        <nav>
            <a href="#">Home</a>
            <a href="#">Features</a>
            <a href="#">Pricing</a>
            <a href="#">About</a>
            <a href="#">Login</a>
            <a href="#">Sign Up</a>
        </nav>
        <p>&copy; 2024 Bulk Email. All rights reserved.</p>
        <div class="social-links">
            <a href="#"><img src="facebook.png" alt="Facebook"></a>
            <a href="#"><img src="twitter.png" alt="Twitter"></a>
            <a href="#"><img src="instagram.png" alt="Instagram"></a>
        </div>
    </footer> -->


    <script src="./assets/js/swiper-bundle.min.js"></script>
    <script>
        const toggleBtn = document.querySelector('.toggle_btn')
        const toggleBtnIcon = document.querySelector('.toggle_btn i')
        const dropDownMenu = document.querySelector('.dropdown_menu')

        toggleBtn.onclick = function () {
            dropDownMenu.classList.toggle('open')
            const isOpen = dropDownMenu.classList.contains('open')

            toggleBtnIcon.classList = isOpen
                ? 'fa-solid fa-xmark'
                : 'fa-solid fa-bars'
        }


        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            grabCursor: true,
            // spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

    </script>
</body>

</html>