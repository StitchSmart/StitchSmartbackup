<style>
/* ── OUR STORY HERO ── */
.story-hero {
    position: relative;
    min-height: 380px;
    background: linear-gradient(135deg, #fffcf7 0%, #fdf5e6 45%, #f9ebd0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 60px 20px;
    border-bottom: 1px solid rgba(202, 151, 69, 0.25);
}
.story-hero-content {
    max-width: 700px;
}
.story-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.5rem, 5vw, 3.8rem);
    font-weight: 900;
    color: #1a0f0a;
    margin-bottom: 20px;
    line-height: 1.1;
}
.story-hero h1 span {
    color: #ca9745;
}
.story-hero p {
    color: #4a4a4a;
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 0;
}
.story-divider {
    width: 80px;
    height: 3px;
    background: #ca9745;
    margin: 25px auto;
    border-radius: 2px;
}

/* ── STORY CONTENT ── */
.story-content-section {
    padding: 40px 0 80px;
    background-color: var(--page-bg, #000);
    color: var(--page-text, #f4e9d3);
}
.story-content-box {
    background: var(--bg-card, #0a0a0a);
    border: 1px solid rgba(202, 151, 69, 0.15);
    border-radius: 16px;
    padding: 50px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.story-content-box h2 {
    font-family: 'Playfair Display', serif;
    color: #ca9745;
    font-size: 2rem;
    margin-bottom: 25px;
    font-weight: 700;
}
.story-content-box p {
    font-size: 1.05rem;
    line-height: 1.8;
    opacity: 0.85;
    margin-bottom: 20px;
}

/* ── TEAM SECTION ── */
.team-section {
    padding: 80px 0;
    background-color: var(--page-bg, #000);
}
.team-title {
    text-align: center;
    font-family: 'Playfair Display', serif;
    color: var(--page-heading, #f4e9d3);
    font-size: 2.5rem;
    margin-bottom: 50px;
    font-weight: 700;
}
.team-card {
    background: var(--bg-card, #0a0a0a);
    border: 1px solid rgba(202, 151, 69, 0.15);
    border-radius: 16px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.4s ease;
    height: 100%;
}
.team-card:hover {
    transform: translateY(-10px);
    border-color: #ca9745;
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
}
.team-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ca9745, #e8c97a);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: #1a0f0a;
    margin: 0 auto 25px;
    border: 4px solid var(--bg-card, #0a0a0a);
    outline: 2px solid #ca9745;
}
.team-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    color: #ca9745;
    margin-bottom: 10px;
    font-weight: 700;
}
.team-card h6 {
    color: var(--page-text, #f4e9d3);
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 0.85rem;
    opacity: 0.8;
    margin-bottom: 20px;
}
.team-card p {
    color: var(--page-text, #f4e9d3);
    opacity: 0.7;
    font-size: 0.95rem;
    line-height: 1.6;
}
</style>

<div class="story-page-wrap">
    <!-- Hero Section -->
    <section class="story-hero">
        <div class="story-hero-content">
            <h1 class="animate-fade-up">Our <span>Story</span></h1>
            <div class="story-divider animate-fade-up"></div>
            <p class="animate-fade-up">From a passionate vision to a premium tailoring destination. Discover the craftsmanship and dedication that drives StitchSmart.</p>
        </div>
    </section>

    <!-- The Journey -->
    <section class="story-content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="story-content-box animate-fade-up">
                        <h2>Crafting Elegance</h2>
                        <p>StitchSmart was born out of a simple desire: to bridge the gap between premium bespoke tailoring and modern accessibility. We noticed that true craftsmanship was becoming harder to find, so we set out to build a platform that brings master tailors directly to you.</p>
                        <p>Our journey started with a commitment to uncompromised quality. We source the finest materials and employ generational techniques to ensure every garment we create is not just worn, but cherished. Today, StitchSmart stands as a symbol of elegance, personalized service, and timeless style.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2 class="team-title animate-fade-up">Meet the Leadership</h2>
            <div class="row g-4 justify-content-center">
                
                <!-- Moiz Ahmed -->
                <div class="col-md-6 col-lg-4">
                    <div class="team-card animate-fade-up">
                        <div class="team-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h3>Moiz Ahmed</h3>
                        <h6>Founder</h6>
                        <p>The visionary behind StitchSmart. Moiz built the foundation of our brand with an unwavering focus on quality, customer experience, and redefining modern tailoring.</p>
                    </div>
                </div>

                <!-- Bissma Ijaz -->
                <div class="col-md-6 col-lg-4">
                    <div class="team-card animate-fade-up" style="transition-delay: 0.1s;">
                        <div class="team-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h3>Bissma Ijaz</h3>
                        <h6>Co Founder</h6>
                        <p>With an exceptional eye for design and operational excellence, Bissma ensures that every collection and custom piece meets the highest standards of luxury.</p>
                    </div>
                </div>

                <!-- Ali Haider -->
                <div class="col-md-6 col-lg-4">
                    <div class="team-card animate-fade-up" style="transition-delay: 0.2s;">
                        <div class="team-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <h3>Ali Haider</h3>
                        <h6>Director</h6>
                        <p>Driving the strategic growth of StitchSmart, Ali connects our master tailors with clients worldwide, ensuring our legacy of craftsmanship reaches new horizons.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const elements = document.querySelectorAll('.animate-fade-up');
        elements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = `opacity 0.8s ease, transform 0.8s ease`;
            
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 50 + (index * 100)); // Staggered animation
        });
    });
</script>
