add_shortcode('spin_wheel', function () {
    ob_start(); ?>

			<div id="spin-wheel-app">

				<!-- WHEEL -->
		<div class="spin-wheel-container">

		<div class="gold-ring"></div>

		<div class="wheel-pointer">
			<div class="pointer-arm"></div>
		</div>

		<!-- 🔥 ADD THIS WRAPPER -->
		<div id="spin-wheel-wheel">
			
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


        <!-- FORM -->
        <div class="spin-wheel-form">
            <form id="spin-wheel-form" onsubmit="return false;">

                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="text" name="mobile" placeholder="Mobile Number" required>
                <input type="text" name="location" placeholder="Location" required>

                <label class="spin-wheel-consent">
                    <input type="checkbox" name="consent" required>
                    <span>I agree to the <a href="https://chocolate-nightingale-996191.hostingersite.com/terms-and-conditions/" target="_blank" style="color: #fff; text-decoration: underline;">Terms & Conditions</a></span>
                </label>

                <button type="submit" id="spin-wheel-btn" disabled>
                    SPIN NOW
                </button>

            </form>

            <div id="spin-wheel-message"></div>
        </div>

    </div>

    <?php
    return ob_get_clean();
});
