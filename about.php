<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            transition: background-color 0.3s ease;
        }
        .about-content {
            max-width: 900px;
            margin: auto;
            padding: 40px 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-top: 40px;
            margin-bottom: 40px;
           
        }
        .about-content:hover {
            transform: translateY(-5px);
        }
        .section {
            margin-bottom: 40px;
            padding: 20px;
            border-radius: 10px;
            background: #f9f9f9;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5em;
            color: #ff6f61;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .about-description p {
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }
        .feature-item {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: box-shadow 0.3s, transform 0.3s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .feature-item:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }
        .feature-item i {
            font-size: 40px;
            margin-bottom: 10px;
            color: #ff6f61;
            transition: transform 0.3s;
        }
        .feature-item:hover i {
            transform: scale(1.2);
        }
        .profile-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-5px);
        }
        .profile-image {
            font-size: 60px;
            color: #ff6f61;
            margin-bottom: 15px;
        }
        .roadmap {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 40px;
        }
        .roadmap-item {
            background: #ffffff;
            border-radius: 10px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.3s, transform 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .roadmap-item:hover {
            background: #ff6f61;
            color: #fff;
            transform: translateY(-3px);
        }
        .roadmap-item i {
            font-size: 24px;
            transition: transform 0.3s;
        }
        .roadmap-item:hover i {
            transform: scale(1.2);
        }
        .feedback-form {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #ff6f61;
            border: none;
            padding: 12px 25px;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-primary:hover {
            background-color: #e55a50;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <main class="about-content">
        <section class="section about-section">
            <h1 class="section-title">About NetConfig Generator</h1>
            <div class="about-description">
                <p>NetConfig Generator is a powerful web-based tool designed to simplify network device configuration.
                    It
                    supports multiple vendor platforms including Cisco, Juniper, and Nortel, allowing network
                    administrators
                    to quickly generate accurate and consistent device configurations.</p>
            </div>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-network-wired"></i>
                    <h3>Multi-Vendor Support</h3>
                    <p>Support for Cisco, Juniper, and Nortel devices</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-sliders-h"></i>
                    <h3>Intuitive Interface</h3>
                    <p>Easy configuration of VLANs, ports, STP, and VRRP/HSRP</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-file-export"></i>
                    <h3>Export Options</h3>
                    <p>Save and export in vendor-specific formats</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-tasks"></i>
                    <h3>Bulk Configuration</h3>
                    <p>Efficiently manage multiple device configurations</p>
                </div>
            </div>
        </section>

        <section class="section profile-section">
            <h2 class="section-title">Project By</h2>
            <div class="profile-card">
                <div class="profile-image">
                    <img src="tush.png" alt="Tusharan A/L Saravannan" style="width: 240px; ">
                </div>
                <h4>TUSHARAN A/L SARAVANNAN (CA21090)</h4>
                <p>FINAL YEAR PROJECT</p>
                <p>BACHELOR OF COMPUTER SCIENCE (COMPUTER SYSTEM AND NETWORKING) WITH HONOURS</p>
                <p>UNIVERSITI MALAYSIA PAHANG AL-SULTAN ABDULLAH</p>
                <a href="mailto:mtusharan@gmail.com" class="contact-link">
                    <i class="fas fa-envelope"></i> mtusharan@gmail.com
                </a>
            </div>
        </section>

        <section class="section future-section">
            <h2 class="section-title">Future Development</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-plus-circle"></i>
                    <h4>Additional Vendors</h4>
                    <p>Support for more network vendors and platforms</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-clipboard-check"></i>
                    <h4>Templates & Presets</h4>
                    <p>Advanced configuration templates and presets</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Security Features</h4>
                    <p>Enhanced security and compliance checks</p>
                </div>
                <div class="feature-item">
                    <i class="fas fa-code"></i>
                    <h4>API Integration</h4>
                    <p>Automated configuration via API</p>
                </div>
            </div>
        </section>

        <section class="section feedback-section">
            <h2 class="section-title">Feedback and Suggestions</h2>
            <div class="feedback-form">
                <form class="contact-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Feedback Category</label>
                        <select class="form-select" id="category" required>
                            <option value="">Select category</option>
                            <option value="feature">Feature Request</option>
                            <option value="bug">Bug Report</option>
                            <option value="improvement">Improvement Suggestion</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </form>
            </div>
        </section>
    </main>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>