<?php
// about.php
require_once 'includes/auth_check.php';
include('includes/header.php');
?>

<main class="about-page">
    <div class="about-container">
        <h1>About Bookoria</h1>
        
        <section class="about-section">
            <div class="about-content">
                <h2>Our Story</h2>
                <p>Founded in 2024, Bookoria emerged from a shared passion for literature and technology. We combine cutting-edge recommendation systems with curated book selections to create a unique shopping experience for bibliophiles.</p>
                
                <h2>Our Mission</h2>
                <p>To connect readers with their next favorite book through intelligent recommendations and personalized service, while maintaining the largest collection of fantasy and fiction titles in the digital space.</p>
            </div>

            <div class="values-section">
                <div class="value-card">
                    <i class="fas fa-book-open"></i>
                    <h3>50 +Titles</h3>
                    <p>All genres</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-users"></i>
                    <h3>1M+ Readers</h3>
                    <p>Join our growing community</p>
                </div>
                <div class="value-card">
                    <i class="fas fa-star"></i>
                    <h3>4.8/5 Rating</h3>
                    <p>Trusted by book lovers worldwide</p>
                </div>
            </div>
        </section>

        <section class="team-section">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                   
                    <h4>Hamid Naeem</h4>
                    <p>CEO & Founder</p>
                </div>
             
            </div>
        </section>
    </div>
</main>

<style>
.about-page {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

.values-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin: 3rem 0;
}

.value-card {
    text-align: center;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.value-card:hover {
    transform: translateY(-5px);
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.team-member {
    text-align: center;
}
</style>

</body>
</html>