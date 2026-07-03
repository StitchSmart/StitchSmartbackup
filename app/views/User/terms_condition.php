<style>
/* ── TERMS HERO ── */
.terms-hero {
    position: relative;
    min-height: 380px;
    background: linear-gradient(135deg, #fffcf7 0%, #fdf5e6 45%, #f9ebd0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 60px 20px;
    border-bottom: 1px solid rgba(193, 154, 78, 0.25);
}
.terms-hero-content {
    max-width: 650px;
}
.terms-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.5rem, 5vw, 3.8rem);
    font-weight: 900;
    color: #1a0f0a;
    margin-bottom: 20px;
    line-height: 1.1;
}
.terms-hero h1 span {
    color: #c19a4e;
}
.terms-hero p {
    color: #4a4a4a;
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 0;
}
.terms-divider {
    width: 80px;
    height: 3px;
    background: #c19a4e;
    margin: 25px auto;
    border-radius: 2px;
}

/* ── TERMS CONTENT ── */
.terms-section {
    padding: 40px 0 80px;
    background-color: var(--page-bg, #000);
}
.terms-container {
    background: var(--bg-card, #0a0a0a);
    border: 1px solid rgba(193, 154, 78, 0.15);
    border-radius: 16px;
    padding: 50px 60px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.terms-content h2 {
    font-family: 'Playfair Display', serif;
    color: #c19a4e;
    font-size: 1.8rem;
    margin-top: 40px;
    margin-bottom: 20px;
    font-weight: 700;
    border-bottom: 1px solid rgba(193, 154, 78, 0.15);
    padding-bottom: 10px;
}
.terms-content h2:first-child {
    margin-top: 0;
}
.terms-content p {
    color: var(--page-text, #f4e9d3);
    opacity: 0.85;
    font-size: 1.05rem;
    line-height: 1.8;
    margin-bottom: 20px;
}
.terms-content ul {
    color: var(--page-text, #f4e9d3);
    opacity: 0.85;
    font-size: 1.05rem;
    line-height: 1.8;
    margin-bottom: 25px;
    padding-left: 20px;
}
.terms-content li {
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .terms-container {
        padding: 30px 20px;
    }
}
</style>

<div class="terms-page-wrap">
    <!-- Hero Section -->
    <section class="terms-hero">
        <div class="terms-hero-content">
            <h1 class="animate-fade-up">Terms & <span>Conditions</span></h1>
            <div class="terms-divider animate-fade-up"></div>
            <p class="animate-fade-up">Please read these terms carefully. By using our platform, you agree to the conditions outlining our services, custom tailoring policies, and your rights as a consumer.</p>
        </div>
    </section>

    <!-- Terms Content -->
    <section class="terms-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="terms-container animate-fade-up">
                        <div class="terms-content">
                            
                            <h2>1. Introduction</h2>
                            <p>Welcome to StitchSmart. These Terms and Conditions govern your use of our website and services. By accessing our platform, placing an order, or utilizing our custom tailoring services, you agree to be bound by these terms in full.</p>

                            <h2>2. Custom Tailoring & Measurements</h2>
                            <p>Our core service revolves around bespoke and custom-tailored garments. Please note:</p>
                            <ul>
                                <li>Customers are responsible for providing accurate measurements if not measured by our in-house staff.</li>
                                <li>We are not liable for ill-fitting garments resulting from incorrect measurements provided by the customer.</li>
                                <li>A tolerance of 0.5 to 1 inch is standard in the bespoke tailoring industry and is not considered a defect.</li>
                            </ul>

                            <h2>3. Order Processing & Deposits</h2>
                            <p>For custom orders, a 50% non-refundable deposit is required to initiate the crafting process. The remaining balance must be cleared prior to dispatch. Standard retail items require full payment at checkout.</p>
                            <p>Orders cannot be canceled once the fabric has been cut or the crafting process has commenced.</p>

                            <h2>4. Pricing & Payments</h2>
                            <p>All prices are subject to change without notice. We reserve the right to modify or discontinue any product or service without prior notice. Secure checkout is provided, and we do not store your payment information on our servers.</p>

                            <h2>5. Returns & Alterations</h2>
                            <p>Due to the personalized nature of custom garments, we do not offer full refunds on bespoke items. However, we are committed to your satisfaction and offer complementary alterations within 14 days of delivery if the garment does not meet the agreed specifications.</p>
                            <p>Standard retail items (non-custom) can be returned within 14 days in their original, unworn condition.</p>

                            <h2>6. Intellectual Property</h2>
                            <p>All content, designs, logos, and materials present on the StitchSmart platform are the exclusive property of StitchSmart. Unauthorized use, reproduction, or distribution is strictly prohibited.</p>

                            <h2>7. Limitation of Liability</h2>
                            <p>StitchSmart shall not be liable for any indirect, incidental, or consequential damages arising from the use of our products or services. Our maximum liability shall not exceed the total amount paid by you for the product in question.</p>

                            <h2>8. Contact & Notices</h2>
                            <p>If you have any questions regarding these Terms and Conditions or need to serve notice, please reach out to us exclusively through our <strong>Contact Support</strong> portal or via the phone numbers provided on our platform. We do not process legal or formal disputes via email.</p>
                            
                        </div>
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
            }, 50 + (index * 150)); 
        });
    });
</script>
