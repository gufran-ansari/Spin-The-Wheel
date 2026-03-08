add_shortcode('spin_wheel', function () {
    ob_start(); ?>

    <div id="spin-wheel-app">
        <div class="spin-wheel-container">
            <div class="wheel-glow" aria-hidden="true"></div>
            <div class="gold-ring"></div>

            <div class="wheel-pointer">
                <div class="pointer-arm"></div>
            </div>

            <div id="spin-wheel-wheel" aria-label="Spin wheel">
                <div id="spin-wheel-image">
                    <div class="wheel-segment seg-0">
                        <span class="segment-text">₹1000<br>AMAZON<br>VOUCHER</span>
                    </div>
                    <div class="wheel-segment seg-1">
                        <span class="segment-text">BETTER LUCK<br>NEXT TIME</span>
                    </div>
                    <div class="wheel-segment seg-2">
                        <span class="segment-text">₹500<br>AMAZON<br>VOUCHER</span>
                    </div>
                    <div class="wheel-segment seg-3">
                        <span class="segment-text">BETTER LUCK<br>NEXT TIME</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="spin-wheel-form">
            <div class="spin-form-header">
                <p class="spin-kicker">Limited Giveaway</p>
                <h2 class="spin-title">Spin and Win</h2>
                <p class="spin-subtitle">Enter your details once and unlock your chance to win Amazon vouchers.</p>
            </div>

            <form id="spin-wheel-form" onsubmit="return false;">
                <input type="text" name="name" placeholder="Full Name" autocomplete="name" required>
                <input type="email" name="email" placeholder="Email Address" autocomplete="email" required>
                <input type="text" name="mobile" placeholder="Mobile Number" autocomplete="tel" required>
                <input type="text" name="location" placeholder="Location" autocomplete="address-level2" required>

                <label class="spin-wheel-consent">
                    <input type="checkbox" name="consent" required>
                    <span>I agree to the <a href="https://chocolate-nightingale-996191.hostingersite.com/terms-and-conditions/" target="_blank" rel="noopener">Terms & Conditions</a></span>
                </label>

                <button type="submit" id="spin-wheel-btn" disabled>
                    SPIN NOW
                </button>
            </form>

            <div id="spin-wheel-message" role="status" aria-live="polite"></div>
        </div>
    </div>

<?php
    return ob_get_clean();
});
