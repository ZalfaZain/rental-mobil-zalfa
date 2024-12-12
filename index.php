<?php
// index.php
session_start();
require_once 'config/database.php';

try {
    // Ambil beberapa mobil terbaru
    $latest_cars = $pdo->prepare("
        SELECT * FROM mobil 
        WHERE status = :status
        ORDER BY created_at DESC 
        LIMIT 6
    ");
    $latest_cars->execute(['status' => 'tersedia']);
    $latest_cars = $latest_cars->fetchAll();

    // Hitung total mobil tersedia
    $total_available = $pdo->prepare("
        SELECT COUNT(*) FROM mobil WHERE status = :status
    ");
    $total_available->execute(['status' => 'tersedia']);
    $total_available = $total_available->fetchColumn();
} catch (Exception $e) {
    die("Terjadi kesalahan: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Bendi Car - Rental Mobil Terpercaya</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<!-- Hero Section -->
<div class="hero">
    <div class="container">
        <h1>Jelajahi Kemudahan Bersama PT Bendi Car</h1>
        <p>Partner terbaik untuk memenuhi kebutuhan transportasi Anda dengan nyaman dan terpercaya.</p>
        <div class="hero-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="katalog.php" class="btn btn-primary">Lihat Katalog</a>
            <?php else: ?>
                <a href="register.php" class="btn btn-primary">Daftar Sekarang</a>
                <a href="login.php" class="btn btn-secondary">Login</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Bendi Car - Rental Mobil Terpercaya</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <a href="index.php" class="navbar-brand">BENDI CAR</a>
            <div class="nav-menu">
                <a href="#home" class="nav-link">Home</a>
                <a href="#mengapa-kami" class="nav-link">Mengapa Kami</a>
                <a href="#mobil" class="nav-link">Daftar Mobil</a>
                <a href="#kontak" class="nav-link">Kontak</a>
            </div>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </header>

    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Rental Mobil Terpercaya</h1>
            <p>Solusi transportasi terbaik untuk perjalanan Anda</p>
            <a href="#kontak" class="btn btn-primary">Pesan Sekarang</a>
        </div>
    </section>

    <section class="features" id="mengapa-kami">
        <div class="container">
            <h2 class="section-title">Mengapa Memilih Kami?</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <i class="fas fa-car feature-icon"></i>
                    <h3>Armada Terawat</h3>
                    <p>Mobil selalu dalam kondisi prima dan terawat</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-money-bill-wave feature-icon"></i>
                    <h3>Harga Bersaing</h3>
                    <p>Harga terbaik dengan pelayanan maksimal</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-clock feature-icon"></i>
                    <h3>Pelayanan 24 Jam</h3>
                    <p>Siap melayani kapanpun Anda butuhkan</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-headset feature-icon"></i>
                    <h3>Pelayanan Ramah</h3>
                    <p>Staff profesional dan responsif</p>
                </div>
            </div>
        </div>
    </section>

    <section class="car-showcase" id="mobil">
    <div class="container">
        <h2 class="section-title">Daftar Mobil</h2>
        <div class="car-grid">
            <!-- Mobil 1 -->
            <div class="car-card">
                <img src="RollsRoyceBoatTail.jpg" alt="Rolls-Royce Boat Tail" class="car-image">
                <div class="car-details">
                    <h3 class="car-title">Rolls-Royce Boat Tail</h3>
                    <div class="car-specs">
                        <span class="spec-item"><i class="fas fa-users"></i> 4 Kursi</span>
                        <span class="spec-item"><i class="fas fa-cog"></i> Manual</span>
                    </div>
                    <div class="car-price">Rp 3.000.000/hari</div>
                    <a href="https://wa.me/6283898313866" class="btn btn-primary">Pesan Sekarang</a>
                </div>
            </div>

            <!-- Mobil 2 -->
            <div class="car-card">
                <img src="bugattilavoiturenoire.jpg" alt="Bugatti La Voiture Noire" class="car-image">
                <div class="car-details">
                    <h3 class="car-title">Bugatti La Voiture Noire</h3>
                    <div class="car-specs">
                        <span class="spec-item"><i class="fas fa-users"></i> 2 Kursi</span>
                        <span class="spec-item"><i class="fas fa-cog"></i> Automatic</span>
                    </div>
                    <div class="car-price">Rp 4.500.000/hari</div>
                    <a href="https://wa.me/6283898313866" class="btn btn-primary">Pesan Sekarang</a>
                </div>
            </div>

            <!-- Mobil 3 -->
            <div class="car-card">
                <img src="PaganiZondaHP.jpg" alt="Pagani Zonda HP Barchetta" class="car-image">
                <div class="car-details">
                    <h3 class="car-title">Pagani Zonda HP Barchetta</h3>
                    <div class="car-specs">
                        <span class="spec-item"><i class="fas fa-users"></i> 2 Kursi</span>
                        <span class="spec-item"><i class="fas fa-cog"></i> Automatic</span>
                    </div>
                    <div class="car-price">Rp 4.200.000/hari</div>
                    <a href="https://wa.me/6283898313866" class="btn btn-primary">Pesan Sekarang</a>
                </div>
            </div>

            <!-- Mobil 4 -->
            <div class="car-card">
                <img src="bugatticentodieci.jpg" alt="Bugatti Centodieci" class="car-image">
                <div class="car-details">
                    <h3 class="car-title">Bugatti Centodieci</h3>
                    <div class="car-specs">
                        <span class="spec-item"><i class="fas fa-users"></i> 2 Kursi</span>
                        <span class="spec-item"><i class="fas fa-cog"></i> Automatic</span>
                    </div>
                    <div class="car-price">Rp 4.800.000/hari</div>
                    <a href="https://wa.me/6283898313866" class="btn btn-primary">Pesan Sekarang</a>
                </div>
            </div>

            <!-- Mobil 5 -->
            <div class="car-card">
                <img src="MercedesBenz.jpeg" alt="Mercedes-Maybach Exelero" class="car-image">
                <div class="car-details">
                    <h3 class="car-title">Mercedes-Maybach Exelero</h3>
                    <div class="car-specs">
                        <span class="spec-item"><i class="fas fa-users"></i> 2 Kursi</span>
                        <span class="spec-item"><i class="fas fa-cog"></i> Automatic</span>
                    </div>
                    <div class="car-price">Rp 5.500.000/hari</div>
                    <a href="https://wa.me/6283898313866" class="btn btn-primary">Pesan Sekarang</a>
                </div>
            </div>

            <!-- Mobil 6 -->
            <div class="car-card">
                <img src="LamborghiniVeneno.jpg" alt="Lamborghini Veneno" class="car-image">
                <div class="car-details">
                    <h3 class="car-title">Lamborghini Veneno</h3>
                    <div class="car-specs">
                        <span class="spec-item"><i class="fas fa-users"></i> 2 Kursi</span>
                        <span class="spec-item"><i class="fas fa-cog"></i> Automatic</span>
                    </div>
                    <div class="car-price">Rp 5.000.000/hari</div>
                    <a href="https://wa.me/6283898313866" class="btn btn-primary">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="testimonials">
    <h2 class="section-title">Apa Kata Mereka</h2>
    <p class="section-subtitle">Pendapat pelanggan tentang layanan kami</p>
    <script src="script.js"></script>

    <div class="testimonial-slider">
        <!-- Testimonial 1 -->
        <div class="testimonial-item">
            <img src="pito.jpg" alt="Customer 1" class="profile-pic">
            <h3>Vito Aditya</h3>
            <p class="car-rented">Mobil yang disewa: Pagani Zonda HP Barchetta</p>
            <p class="testimonial-text">"Pelayanannya sangat baik, mobilnya bersih dan nyaman."</p>
        </div>
        <!-- Testimonial 2 -->
        <div class="testimonial-item">
            <img src="wayan.jpg" alt="Customer 2" class="profile-pic">
            <h3>Ni Wayan Widari</h3>
            <p class="car-rented">Mobil yang disewa: Bugatti La Voiture Noire</p>
            <p class="testimonial-text">"Harga terjangkau dengan kualitas terbaik. Sangat puas!"</p>
        </div>
        <!-- Testimonial 3 -->
        <div class="testimonial-item">
            <img src="yona.jpg" alt="Customer 2" class="profile-pic">
            <h3>Yona Amalia</h3>
            <p class="car-rented">Mobil yang disewa: Rolls-Royce Boat Tail</p>
            <p class="testimonial-text">"Harga terjangkau dengan kualitas terbaik. Sangat puas!"</p>
        </div>
         <!-- Testimonial 4 -->
        <div class="testimonial-item">
            <img src="alma.jpg" alt="Customer 2" class="profile-pic">
            <h3>Alma Rahmatia Ningrum</h3>
            <p class="car-rented">Mobil yang disewa: Bugatti Centodieci</p>
            <p class="testimonial-text">"Harga terjangkau dengan kualitas terbaik. Sangat puas!"</p>
        </div>
         <!-- Testimonial 5 -->
         <div class="testimonial-item">
            <img src="racel.jpg" alt="Customer 2" class="profile-pic">
            <h3>Racel Armanda Dwi Utami</h3>
            <p class="car-rented">Mobil yang disewa: Mercedes-Maybach Exelero</p>
            <p class="testimonial-text">"Harga terjangkau dengan kualitas terbaik. Sangat puas!"</p>
        </div>
         <!-- Testimonial 6 -->
         <div class="testimonial-item">
            <img src="citra.jpg" alt="Customer 2" class="profile-pic">
            <h3>Citra Anggun Cahyani</h3>
            <p class="car-rented">Mobil yang disewa: Lamborghini Veneno</p>
            <p class="testimonial-text">"Harga terjangkau dengan kualitas terbaik. Sangat puas!"</p>
        </div>
        <!-- Testimonial 7 -->
        <div class="testimonial-item">
            <img src="lifty.jpg" alt="Customer 2" class="profile-pic">
            <h3>Lifty Pavita</h3>
            <p class="car-rented">Mobil yang disewa: Rolls-Royce Boat Tail</p>
            <p class="testimonial-text">"Harga terjangkau dengan kualitas terbaik. Sangat puas!"</p>
        </div>
    </div>

    <!-- Slider Navigation -->
    <div class="slider-navigation">
        <button class="prev-btn">&lt;</button>
        <button class="next-btn">&gt;</button>
    </div>
</div>


<section class="contact" id="kontak">
    <div class="container">
        <h2 class="section-title">Tertarik dengan kendaraan kami?</h2>
        <h3>Hubungi Kami Sekarang!</h3>
        <p class="contact-desc">
            Untuk kenyamanan Anda kami sediakan mobil mobil terbaru dengan harga terbaik.
            Kami selalu merawat mobil secara berkala untuk menjaga performa dan stabilitas mesin.
        </p>
        
        <div class="contact-wrapper">
            <!-- Google Maps -->
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.3564687806883!2d105.2437082147666!3d-5.358967996116576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40d0cf8f35eaf3%3A0x22a5e99c1a401b74!2sGang%20Way%205%2C%20Rajabasa%20Raya%2C%20Bandar%20Lampung%2C%20Lampung!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                    width="100%" 
                    height="350" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
            
            <!-- Informasi Kontak -->
            <div class="contact-info">
                <div class="contact-item">
                    <h4><i class="fas fa-phone"></i> TELEPON/WHATSAPP</h4>
                    <p><a href="https://wa.me/6283898313866">083898313866</a></p>
                </div>
                <div class="contact-item">
                    <h4><i class="fas fa-envelope"></i> EMAIL</h4>
                    <p><a href="mailto:zalfazain160@gmail.com">zalfazain160@gmail.com</a></p>
                </div>
                <div class="contact-item">
                    <h4><i class="fas fa-map-marker-alt"></i> ALAMAT</h4>
                    <p>Gang Way Lima 2, Rajabasa Raya, Jl. Komarudin, Bandar Lampung</p>
                </div>
            </div>
        </div>
    </div>
</section>



    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>BENDI CAR</h3>
                    <p>Solusi Rental Mobil Terpercaya</p>
                </div>
                <div class="footer-social">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Bendi Car. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>

