<?php
// Database connection
$servername = "localhost"; // Change if using a remote DB
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password (default is empty in XAMPP)
$dbname = "peace_hub"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FirstName = $conn->real_escape_string($_POST["FirstName"]);
    $LastName = $conn->real_escape_string($_POST["LastName"]);
    $Contact = $conn->real_escape_string($_POST["Contact"]);
    $Category = $conn->real_escape_string($_POST["Category"]);
    $DOA = $conn->real_escape_string($_POST["DOA"]);
    $Email = $conn->real_escape_string($_POST["Email"]);
    $Address = $conn->real_escape_string($_POST["Address"]);
    $Message = $conn->real_escape_string($_POST["Message"]);

    // SQL Insert Query
    $sql = "INSERT INTO bookings (FirstName, LastName, Contact, Category, DOA, Email, Address, Message) VALUES ('$FirstName', '$LastName', '$Contact', '$Category', '$DOA', '$Email', '$Address', '$Message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking Successful!'); window.location.href='peace_hub.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book at PeaceHub</title>
    <link rel="stylesheet" href="book_now.css">

    <!-- location in form -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <script>
        function initAutocomplete() {
            var input = document.getElementById("location");
            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ["geocode"] // Restricting to address-based results
            });
        }
    </script>
    
</head>

<body>

    <div class="bg-image"></div>
    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">
            <a href="peace_hub.html">PEACE<span>☮</span>HUB</a>
        </div>
        <nav>
            <ul>
                <li><a href="peace_hub.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="teams.html">Teams</a></li>
            </ul>
        </nav>
        <button class="contact-btn">Contact Us →</button>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Book Now<br> At PeaceHub</h1>
    </section>

    <!-- Contact Section -->
    <section class="contact-container">
        <div class="form-container">
            <h2>Book Now</h2>
            <form name="insertData" method="POST" action="book_now.php" >
                <div class="name-email">
                    <input type="text" placeholder="First Name" name='FirstName' required>
                    <input type="text" placeholder="Last Name" name='LastName' required>
                </div>
                <input type="tel" placeholder="Contact" name="Contact" required>
                <input type="tel" placeholder="Category" name="Category" required>
                <input type="date" placeholder="Date" name="DOA" required>
                <input type="email" placeholder="Email" name="Email" required>
                <input type="text" id="location" name="Address" placeholder="Enter city, state, or country" required>
                <textarea placeholder="Message"  name="Message" required></textarea>
                <input type="submit" value="Book Now" class="btn">
            </form>
        </div>

        <div class="schedule">
            <h2>Our Schedule</h2>
            <p>Our clinic provides a safe and confidential environment for individuals to address their concerns and
                work towards personal growth.</p>
            <ul>
                <li>🕒 <strong>Monday to Friday</strong> <br> 9:00 AM to 5:00 PM</li>
                <li>🕒 <strong>Saturday</strong> <br> 9:00 AM to 2:00 PM</li>
            </ul>
        </div>
    </section>
    
    <!-- Map Section starts here -->
    <div class="container">
        <h1>Visit Our Office</h1>
        <p>Feel free to stop by our location during operating hours if you'd like in-person assistance</p>
        <p>or to explore our facilities firsthand.</p>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3886.8764137613475!2d80.1059391740973!3d13.043537687278473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5261004a5632e3%3A0x23e618c506668799!2sQueen%20Victoria%20Street!5e0!3m2!1sen!2sin!4v1740979006538!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen=""></iframe>
        </div>
        <div class="contact-info">
            <div class="info-box">
                <img src="images/image12.png" alt="Phone">
                <p><strong>Phone Number</strong><br>+123 456 7890</p>
            </div>
            <div class="info-box">
                <img src="images/image13.png" alt="Email">
                <p><strong>Email Address</strong><br>peacehub@gmail.com</p>
            </div>
            <div class="info-box">
                <img src="images/image14.png" alt="Address">
                <p><strong>Address</strong><br>Queen Victoria Street, Kolkata</p>
            </div>
        </div>
    </div>

    <!-- Wellness-Section -->
    <div class="wellness-section">
        <div class="text-content">
            <h2>Ready to embark on the journey of wellness?</h2>
            <p>Start your mental health transformation with our experienced therapists today. Get to be in your ultimate
                inner peace and lasting well-being with our programs, tailored special to your health needs.</p>
            <a href="#" class="btn">Get Started →</a>
        </div>

        <div class="image-content">
            <div class="main-image">
                <img src="images/image10.png" alt="Hands representing wellness">
                <div class="hotspot1">
                    <span class="dot">
                        <img src="images/image5.png" alt="">
                    </span>
                    <span class="hotspot-text">Confidentiality</span>
                </div>
                <div class="hotspot2">
                    <span class="dot">
                        <img src="images/image5.png" alt="">
                    </span>
                    <span class="hotspot-text">Accessibility</span>
                </div>
            </div>
            <div class="discount-section">
                <div class="hashtag">#LetsStayHealthy</div>
                <div class="discount">
                    <span>50%</span>
                    <p>Discount</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <h2>PEACE<span>☮</span>HUB</h2>
                <p>We are mental health experienced therapists that are passionate about our goal on empowering you
                    mentally with our wellness journey.</p>
                <div class="subscribe">
                    <input type="email" placeholder="email@gmail.com">
                    <button>Sign Up</button>
                </div>
            </div>

            <div class="footer-links">
                <div class="column">
                    <h3>Quick Links</h3>
                    <a href="#">Home</a>
                    <a href="#">About Us</a>
                    <a href="#">Services</a>
                    <a href="#">Teams</a>
                </div>
                <div class="column">
                    <h3>Resources</h3>
                    <a href="#">Depression</a>
                    <a href="#">Anxiety</a>
                    <a href="#">Relationship Issues</a>
                    <a href="#">Stress Management</a>
                </div>
                <div class="column">
                    <h3>Connect</h3>
                    <a href="#">Contact</a>
                    <a href="#">Instagram</a>
                    <a href="#">LinkedIn</a>
                    <a href="#">Facebook</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>Copyright © PeaceHub 2023</p>
            <a href="book_now.html"><button class="back-to-top">Back to Top</button></a>
        </div>
    </footer>
</body>

</html>