<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .section {
            margin: 40px 0;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .features-grid, .steps-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .feature-card, .step {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .feature-card:hover, .step:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .feature-card i {
            font-size: 40px;
            color: #ff6f61;
            margin-bottom: 10px;
        }
        .step-number {
            font-size: 24px;
            font-weight: bold;
            color: white;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <main class="main-content home-content">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Welcome to NetConfig Generator</h1>
            <p>NetConfig Generator is a powerful tool designed to simplify the process of network device configuration.</p>
            <p>Whether you're managing switches, routers, or other network equipment, our generator helps you create accurate and consistent configurations quickly and efficiently.</p>
            <p>With support for multiple vendor platforms including Cisco, Juniper, and others, NetConfig Generator streamlines your network configuration tasks and reduces the potential for human error.</p>
        </div>

        <!-- Key Features Section -->
        <div class="section features-section" style="margin-top: 80px;">
            <h2>Key Features</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-network-wired"></i>
                    <h3>Multi-Vendor Support</h3>
                    <p>Generate configurations for Cisco, Juniper, and Nortel devices from a single interface.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-cog"></i>
                    <h3>Easy Configuration</h3>
                    <p>Intuitive interface for configuring VLANs, ports, STP, and VRRP/HSRP settings.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-save"></i>
                    <h3>Save & Export</h3>
                    <p>Save your configurations and export them in the proper format for your network devices.</p>
                </div>
            </div>
        </div>

        <!-- Getting Started Section -->
        <div class="section getting-started-section" style="margin-top: 80px;">
            <h2>Getting Started</h2>
            <div class="steps-container">
                <div class="step">
                    <span class="step-number">1</span>
                    <p>Select your device vendor and enter basic network information</p>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <p>Configure ports, VLANs, and other network settings</p>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <p>Generate and download your configuration file</p>
                </div>
            </div>
        </div>

        <!-- Start Button -->
        <div class="start-section">
            <a href="index.php?page=generator" class="start-button">Start Generating Configuration</a>
        </div>
    </main>
</body>

</html>