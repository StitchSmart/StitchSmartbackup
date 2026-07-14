<style>
/* Scoped Variables & Typography for About Us to prevent conflicts */
/* Base/Default Theme Variables for About Us */
:root .about-us-wrapper,
:root.theme-default .about-us-wrapper {
    --au-gold-primary: #ca9745;
    --au-gold-light: #f5efe6;
    --au-gold-dark: #8B6D3B;
    --au-bg-main: #fcf9f2;
    --au-bg-card: #ffffff;
    --au-bg-hero: #f5efe6;
    --au-text-main: #24150F;
    --au-text-muted: #5A3D2B;
    --au-border-color: rgba(90,61,43,0.12);
    
    --au-font-heading: 'Playfair Display', serif;
    --au-font-body: 'Plus Jakarta Sans', sans-serif;

    background-color: var(--au-bg-main);
    color: var(--au-text-main);
    font-family: var(--au-font-body);
    overflow-x: hidden;
    position: relative;
}

/* Luxury Theme Variables for About Us */
:root.theme-luxury .about-us-wrapper {
    --au-gold-primary: #ca9745;
    --au-gold-light: rgba(202, 151, 69, 0.1);
    --au-gold-dark: #ca9745;
    --au-bg-main: #0a0a0a;
    --au-bg-card: #141414;
    --au-bg-hero: #0f0f0f;
    --au-text-main: #ffffff;
    --au-text-muted: #a0a0a0;
    --au-border-color: rgba(202, 151, 69, 0.25);
}

/* Animations */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeInLeft {
    from { opacity: 0; transform: translateX(-40px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes fadeInRight {
    from { opacity: 0; transform: translateX(40px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}

.about-us-wrapper h1, 
.about-us-wrapper h2, 
.about-us-wrapper h3, 
.about-us-wrapper h4 {
    font-family: var(--au-font-heading);
    font-weight: 600;
    color: var(--au-text-main);
}

/* Hero Section */
.about-hero {
    position: relative;
    padding: 160px 0 100px;
    text-align: center;
    background: radial-gradient(circle at 50% 0%, var(--au-bg-hero) 0%, var(--au-bg-main) 100%);
    border-bottom: 1px solid var(--au-border-color);
    z-index: 1;
}

.about-hero .gold-accent {
    color: var(--au-gold-dark);
    font-size: 1.1rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    display: block;
    margin-bottom: 20px;
    opacity: 0;
    font-weight: 600;
    animation: fadeInUp 1s ease forwards;
}

.about-hero h1 {
    font-size: 4.5rem;
    color: var(--au-text-main);
    margin-bottom: 30px;
    opacity: 0;
    animation: fadeInUp 1s ease 0.2s forwards;
    line-height: 1.2;
}

.about-hero h1 span {
    color: var(--au-gold-primary);
    font-style: italic;
}

.about-hero p {
    font-size: 1.25rem;
    color: var(--au-text-muted);
    max-width: 700px;
    margin: 0 auto;
    opacity: 0;
    animation: fadeInUp 1s ease 0.4s forwards;
    line-height: 1.8;
}

/* Story Section */
.story-section {
    padding: 120px 0;
    position: relative;
    z-index: 1;
}

.story-content {
    opacity: 0;
    animation: fadeInLeft 1s ease 0.6s forwards;
    padding-right: 40px;
}

.story-content h2 {
    font-size: 3.5rem;
    color: var(--au-text-main);
    margin-bottom: 30px;
    position: relative;
}

.story-content h2 span {
    color: var(--au-gold-primary);
}

.story-content p {
    font-size: 1.15rem;
    line-height: 1.9;
    color: var(--au-text-muted);
    margin-bottom: 25px;
}

.story-image-container {
    position: relative;
    opacity: 0;
    animation: fadeInRight 1s ease 0.6s forwards;
}

.story-image-wrapper {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    z-index: 2;
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
}

.story-image-wrapper img {
    width: 100%;
    height: 600px;
    object-fit: cover;
    display: block;
    transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.story-image-container:hover img {
    transform: scale(1.05);
}

/* image accent removed */

/* Team Section */
.team-section {
    padding: 100px 0;
    background: var(--au-bg-hero);
    border-top: 1px solid var(--au-border-color);
    border-bottom: 1px solid var(--au-border-color);
    position: relative;
    z-index: 1;
}

.team-header {
    text-align: center;
    margin-bottom: 60px;
}

.team-header h2 {
    font-size: 3.5rem;
    color: var(--au-text-main);
    margin-bottom: 20px;
}

.team-member {
    text-align: center;
    padding: 40px 20px;
    background: var(--au-bg-card);
    border: 1px solid var(--au-border-color);
    border-radius: 20px;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.team-member:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 50px rgba(202, 151, 69, 0.15);
    border-color: var(--au-gold-primary);
}

.team-avatar {
    width: 120px;
    height: 120px;
    margin: 0 auto 25px;
    border-radius: 50%;
    background-color: var(--au-gold-light);
    border: 3px solid var(--au-gold-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: var(--au-gold-dark);
    overflow: hidden;
}

.team-name {
    font-family: var(--au-font-heading);
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--au-text-main);
    margin-bottom: 5px;
}

.team-role {
    font-size: 1rem;
    color: var(--au-gold-dark);
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: 600;
}

/* Core Values Section */
.values-section {
    padding: 120px 0;
    position: relative;
    z-index: 1;
}

.section-header {
    text-align: center;
    margin-bottom: 80px;
}

.section-header h2 {
    font-size: 3.5rem;
    color: var(--au-text-main);
    margin-bottom: 20px;
}

.section-header p {
    color: var(--au-text-muted);
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto;
}

.value-card {
    background: var(--au-bg-card);
    border: 1px solid var(--au-border-color);
    border-radius: 24px;
    padding: 50px 40px;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

.value-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 50px rgba(202, 151, 69, 0.15);
    border-color: var(--au-gold-primary);
}

.value-card .icon-wrapper {
    width: 90px;
    height: 90px;
    margin-bottom: 35px;
    background: var(--au-bg-hero);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: var(--au-gold-dark);
    border: 1px solid var(--au-border-color);
    transition: all 0.5s ease;
}

.value-card:hover .icon-wrapper {
    transform: scale(1.1) rotate(5deg);
    background: var(--au-gold-light);
    color: var(--au-gold-dark);
}

.value-card h3 {
    font-size: 1.8rem;
    color: var(--au-text-main);
    margin-bottom: 20px;
}

.value-card p {
    color: var(--au-text-muted);
    line-height: 1.8;
    font-size: 1.05rem;
    margin: 0;
}

/* Responsive */
@media (max-width: 991px) {
    .about-hero h1 { font-size: 3.5rem; }
    .story-content { padding-right: 0; margin-bottom: 60px; }
    .story-image-wrapper img { height: 400px; }
    .image-accent-box { display: none; }
}

@media (max-width: 768px) {
    .about-hero { padding: 120px 0 80px; }
    .about-hero h1 { font-size: 2.8rem; }
    .story-content h2 { font-size: 2.8rem; }
    .section-header h2 { font-size: 2.8rem; }
    .stat-number { font-size: 3rem; }
    .value-card { padding: 40px 30px; }
}
</style>

<div class="about-us-wrapper">
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <span class="gold-accent">The Stitch Smart Standard</span>
            <h1>Crafting <span>Premium</span> Apparel</h1>
            <p>Elevating the art of custom clothing with passion, precision, and an unwavering dedication to excellence.</p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="story-content">
                        <h2>Our <span>Legacy</span></h2>
                        <p>At <strong>Stitch Smart</strong>, we believe that clothing is more than just fabric—it's an expression of identity, ambition, and style. Founded on the principles of superior craftsmanship, we set out to redefine custom apparel manufacturing.</p>
                        <p>We source only the finest materials, employing expert artisans who pour their soul into every stitch. From luxurious hoodies and crewnecks to impeccably tailored sweatpants, we bridge the gap between your visionary designs and wearable reality.</p>
                        <p>Our journey began with a simple idea: to empower brands and individuals with premium, customizable clothing that doesn't compromise on quality or aesthetics. Today, we stand proud as a trusted partner to creators worldwide.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="story-image-container">
                        <div class="story-image-wrapper">
                            <!-- Beautiful Tailoring/Clothing Manufacturing Image -->
                            <img src="https://images.unsplash.com/photo-1551232864-3f0890e580d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Premium Custom Apparel Craftsmanship">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="team-header">
                <h2>Meet the Team</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="team-member">
                        <div class="team-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="team-name">Moiz Ahmed</div>
                        <div class="team-role">Founder</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-member">
                        <div class="team-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="team-name">Bissma Ijaz</div>
                        <div class="team-role">Co-Founder</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-member">
                        <div class="team-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="team-name">Ali Haider</div>
                        <div class="team-role">Director</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="values-section">
        <div class="container">
            <div class="section-header">
                <h2>The Core Pillars</h2>
                <p>The fundamental values that drive our passion and precision in every garment we create.</p>
            </div>
            <div class="row g-5">
                <!-- Value 1 -->
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-gem"></i>
                        </div>
                        <h3>Uncompromised Quality</h3>
                        <p>Every garment undergoes rigorous quality control. We select premium fabrics that offer unparalleled comfort, durability, and a luxurious feel.</p>
                    </div>
                </div>
                <!-- Value 2 -->
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </div>
                        <h3>Creative Freedom</h3>
                        <p>Your vision, our expertise. We provide extensive customization options—from dyes to distressing—giving you the ultimate creative control.</p>
                    </div>
                </div>
                <!-- Value 3 -->
                <div class="col-md-4">
                    <div class="value-card">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-handshake-angle"></i>
                        </div>
                        <h3>Trusted Partnership</h3>
                        <p>We are more than manufacturers; we are your partners. We pride ourselves on transparent communication and reliable, timely delivery.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
