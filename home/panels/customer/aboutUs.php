<?php
    echo "<div class='aboutPage' style='place-items: center;'>
            <div style='color: #FDFFF6; display: flex; flex-direction: column; justify-content: center; width: 100%;'>
                <h2 style='font-size: 32px; margin-top: 20px; margin-bottom: 10px; width: 100%; text-align: center;'>Welcome to Quick Ride</h2>
                <p style='width: 100%; text-align: center; font-size: 20px;'>Your trusted partner for seamless and hassle-free car rentals.</p>
                <p style='width: 100%; text-align: center; margin-top: 10px;'>Our System is designed to revolutionize the way you rent vehicles, offering a fast, convenient, and secure booking experience from the comfort of your home or on the go.</p>

                <span style='width: 100%; background-color: #38814a; margin-top: 20px; margin-bottom: 20px; padding: 40px;'>
                    <h2 style='font-size: 26px;'>Why Choose Our System?</h2>
                    <ul style='margin-left: 20px; margin-top: 5px; display: flex; flex-direction: column; gap: 5px;'>
                        <li>Easy Booking Process: Browse, compare, and reserve your preferred vehicle in just a few clicks.</li>
                        <li>Wide Selection: Choose from a diverse fleet of well-maintained cars, SUVs, and vans to suit every need and budget.</li>
                        <li>Transparent Pricing: No hidden fees—view all costs upfront, including insurance and optional add-ons.</li>
                        <li>Instant Confirmation: Receive real-time booking confirmations and reminders via email or SMS.</li>
                        <li>24/7 Accessibility: Book anytime, anywhere, using our user-friendly web platform.</li>
                    </ul>
                </span>
                <p style='padding: 20px 30px; width: 100%; text-align: center;'>At Quick Ride, we prioritize reliability, convenience, and customer satisfaction. Whether you're a traveler needing a rental car or a business looking to expand your fleet management capabilities, our platform is built to serve you better.</p>

                <h2 style='padding: 20px; width: 100%; text-align: center; font-size: 18px;'>Start your journey with us today!</h2>
            </div>
        </div>";
        
    include_once("./animations.php");
?>

<style type="text/css">
    .aboutPage {
        position: fixed;
        top: 0; left: 0;
        height: 100%;
        width: 100%;
        z-index: 90;
        background-color: #316C40;
        display: none;
    }
</style>