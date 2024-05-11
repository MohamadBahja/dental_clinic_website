<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Care</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
session_start();
if (!isset($_SESSION['message'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'dentalclinic') or die('connection failed');

$message = []; // Initialize an empty array for messages

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $date = $_POST['date'];
    $appointment_type = mysqli_real_escape_string($conn, $_POST['appointment_type']);

    // Retrieve price from selected appointment type
    $price = 0; // Default value
    if (isset($_POST['appointment_type'])) {
        $selected_option = $_POST['appointment_type'];
        $price = $_POST[$selected_option . '_price'];
    }

    // Check if the appointment date is available
    $availabilityQuery = "SELECT * FROM contact_form WHERE date = '$date'";
    $checkAvailability = mysqli_query($conn, $availabilityQuery);

    if (mysqli_num_rows($checkAvailability) > 0) {
        $message[] = 'Sorry, the appointment slot is already booked. Please choose another date and time.';
    } else {
        // If the appointment is available, proceed to insert into the database
        $insert = mysqli_query($conn, "INSERT INTO contact_form (name, email, number, date, type, price) 
                                        VALUES ('$name', '$email', '$number', '$date', '$appointment_type', '$price')") or die('query failed');

        if ($insert) {
            $message[] = 'Appointment made successfully!';
            
            // Destroy the session after the appointment is made
            session_destroy();
        } else {
            $message[] = 'Appointment failed';
        }
    }
}
?>
    <header class="header fixed-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <a href="#home" class="logo">dental<span>Care.</span></a>
                <nav class="nav">
                    <a href="#home">home</a>
                    <a href="#about">about</a>
                    <a href="#services">services</a>
                    <a href="#reviews">reviews</a>
                    <a href="#contact">contact</a>
                </nav>
                <a href="#contact" class="link-btn">make appointment</a>
                <div id="menu-btn" class="fas fa-bars"></div>
            </div>
        </div>
    </header>

    <section class="home" id="home">
        <div class="container">
            <div class="row min-vh-100 align-items-center">
                <div class="content text-center text-md-left">
                    <h3>Revitalize Your Smile with Us!</h3>
                    <p>Unveil the radiance of your smile at our cutting-edge dental haven.
                        We blend artistry with precision, sculpting not just teeth but
                        confidence, making every visit a celebration of your vibrant.
                    </p>
                    <a href="#contact" class="link-btn">make appointment</a>
                </div>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 image">
                    <img src="images/about-img.jpg" class="w-100 mb-5 mb-md-0" alt="">
                </div>
                <div class="col-md-6 content">
                    <span>about us</span>
                    <h3>Your Family's Dental Wellness Partner</h3>
                    <p>Since our inception, we've been crafting smiles and building
                        trust in dental excellence. Established with passion and commitment,
                        our journey began to redefine oral care, ensuring a legacy of
                        radiant smiles and satisfied patients.
                    </p>
                    <a href="#contact" class="link-btn">make appointment</a>
                </div>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <h1 class="heading">our services</h1>
        <div class="box-container container">
            <div class="box">
                <img src="images/icon-ser1.png" alt="">
                <h3>Preventive Dentistry</h3>
                <p style="text-align: center;">
                    Regular check-ups<br>
                    Cleanings<br>
                    Sealants<br>
                    Fluoride treatments
                </p>
            </div>
            <div class="box">
                <img src="images/icon-ser2.png" alt="">
                <h3>Cosmetic dentistry</h3>
                <p style="text-align: center;">
                    Teeth whitening<br>
                    Veneers<br>
                    Cosmetic bonding
                </p>
            </div>
            <div class="box">
                <img src="images/icon-ser3.png" alt="">
                <h3>Restorative Dentistry</h3>
                <p style="text-align: center;">
                    Fillings<br>
                    Crowns<br>
                    Bridges<br>
                    Implants
                </p>
            </div>
            <div class="box">
                <img src="images/icon-ser4.png" alt="">
                <h3>Orthodontics</h3>
                <p style="text-align: center;">
                    Braces<br>
                    Invisalign<br>
                </p>
            </div>
            <div class="box">
                <img src="images/icon-ser5.png" alt="">
                <h3>Oral Surgery</h3>
                <p style="text-align: center;">
                    Tooth extraction<br>
                    Wisdom teeth removal<br>
                </p>
            </div>
            <div class="box">
                <img src="images/icon-ser6.png" alt="">
                <h3>Periodontal (Gum) Treatment</h3>
                <p style="text-align: center;">
                    Scaling and root planing<br>
                    Gum surgery<br>
                    Gum disease management<br><br>
                </p>
            </div>
        </div>
    </section>

    <section class="process">
        <h1 class="heading">work process</h1>
        <div class="box-container container">
            <div class="box">
                <img src="images/process-1.png" alt="">
                <h3>Patient Examination and Diagnosis</h3>
                <p style="text-align: center;">
                    Oral health assessment<br>
                    X-rays and imaging<br><br>
                    Diagnosis of dental conditions
                </p>
            </div>
            <div class="box">
                <img src="images/process-2.png" alt="">
                <h3>Treatment Planning and Implementation</h3>
                <p style="text-align: center;">
                    Developing a customized treatment plan<br>
                    Implementing dental procedures (fillings, extractions, etc.)<br>
                    Coordinating with specialists for complex cases
                </p>
            </div>
            <div class="box">
                <img src="images/process-3.png" alt=""><br>
                <h3>Preventive Care and Ongoing Follow-up</h3>
                <p style="text-align: center;">
                    Providing oral hygiene instructions<br>
                    Scheduling regular check-ups and cleanings<br>
                    Monitoring and managing long-term oral health
                </p>
            </div>
        </div>
    </section>

    <section class="reviews" id="reviews">
        <h1 class="heading"> satisfied clients </h1>
        <div class="box-container container">
            <div class="box">
                <img src="images/rev-1.png" alt="">
                <p>Exceptional care, professionalism, and a friendly staff
                    make this dental clinic truly outstanding.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Hasan</h3>
                <span>satisfied client</span>
            </div>
            <div class="box">
                <img src="images/rev-2.png" alt="">
                <p>Top-notch care, friendly staff—this dental clinic exceeds expectations consistently.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Dina</h3>
                <span>satisfied client</span>
            </div>
            <div class="box">
                <img src="images/rev-1.png" alt="">
                <p>Exceptional service, skilled team—this dental clinic sets the standard impressively.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Mhamad</h3>
                <span>satisfied client</span>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
    <h1 class="heading">make appointment</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
        if (isset($message)) {
            if (is_array($message)) {
                foreach ($message as $msg) {
                    echo '<p class="message">' . $msg . '</p>';
                }
            } else {
                echo '<p class="message">' . $message . '</p>';
            }
        }
        ?>

        <span>your name:</span>
        <input type="text" name="name" placeholder="enter your name" class="box" required>

        <span>your email:</span>
        <input type="email" name="email" placeholder="enter your email" class="box" required>

        <span>your number:</span>
        <input type="number" name="number" placeholder="enter your number" class="box" required>

        <span>appointment date:</span>
        <input type="datetime-local" name="date" class="box" required>

        <span>select appointment type:</span>
        <select name="appointment_type" class="box" required>
            <option value="regular_checkup" data-price="50.00">Regular Check-Ups</option>
            <option value="cleanings" data-price="75.00">Cleanings</option>
            <option value="sealants" data-price="100.00">Sealants</option>
            <option value="fluoride_treatments" data-price="80.00">Fluoride Treatments</option>
            <option value="teeth_whitening" data-price="150.00">Teeth Whitening</option>
            <option value="veneers" data-price="200.00">Veneers</option>
            <option value="cosmetic_bonding" data-price="120.00">Cosmetic Bonding</option>
            <option value="fillings" data-price="90.00">Fillings</option>
            <option value="crowns" data-price="180.00">Crowns</option>
            <option value="bridges" data-price="250.00">Bridges</option>
            <option value="implants" data-price="300.00">Implants</option>
            <option value="braces" data-price="400.00">Braces</option>
            <option value="invisalign" data-price="350.00">Invisalign</option>
            <option value="tooth_extraction" data-price="120.00">Tooth Extraction</option>
            <option value="wisdom_teeth_removal" data-price="180.00">Wisdom Teeth Removal</option>
            <option value="scaling_and_root_planing" data-price="90.00">Scaling And Root Planing</option>
            <option value="gum_surgery" data-price="200.00">Gum Surgery</option>
            <option value="gum_disease_management" data-price="150.00">Gum Disease Management</option>
        </select>

        <!-- Hidden input fields for prices -->
        <input type="hidden" name="regular_checkup_price" value="50.00">
        <input type="hidden" name="cleanings_price" value="75.00">
        <input type="hidden" name="sealants_price" value="100.00">
        <input type="hidden" name="fluoride_treatments_price" value="80.00">
        <input type="hidden" name="teeth_whitening_price" value="150.00">
        <input type="hidden" name="veneers_price" value="200.00">
        <input type="hidden" name="cosmetic_bonding_price" value="120.00">
        <input type="hidden" name="fillings_price" value="90.00">
        <input type="hidden" name="crowns_price" value="180.00">
        <input type="hidden" name="bridges_price" value="250.00">
        <input type="hidden" name="implants_price" value="300.00">
        <input type="hidden" name="braces_price" value="400.00">
        <input type="hidden" name="invisalign_price" value="350.00">
        <input type="hidden" name="tooth_extraction_price" value="120.00">
        <input type="hidden" name="wisdom_teeth_removal_price" value="180.00">
        <input type="hidden" name="scaling_and_root_planing_price" value="90.00">
        <input type="hidden" name="gum_surgery_price" value="200.00">
        <input type="hidden" name="gum_disease_management_price" value="150.00">

        <input type="submit" value="make appointment" name="submit" class="link-btn">
    </form>
</section>
<section class="footer">
    <div class="box-container container" >
        <div class="box">
            <i class="fas fa-phone"></i>
            <h3>phone number</h3>
            <p>+961 76 790 317</p>
            <p>+961 01 789 635</p>
        </div>
        <div class="box">
            <i class="fas fa-map-marker-alt"></i>
            <h3>our address</h3>
            <p>Alhamra street, Beirut</p>
        </div>
        <div class="box">
            <i class="fas fa-clock"></i>
            <h3>opening hours</h3>
            <p>Monday-Friday  9:00-18:00</p>
        </div>
        <div class="box">
            <i class="fas fa-envelope"></i>
            <h3>email address</h3>
            <p>dentalcare@gmail.com</p>
        </div>
    </div>
    <div class="credit">&copy; copyright @ <?php echo date('Y');?> by Dental<span>Care.</span> Clinic</div>
   </section>
    <script src="script.js"></script>
</body>

</html>
