add_shortcode('spin_wheel', function () {
    ob_start(); ?>

    <div id="spin-wheel-app">
        <div class="spin-pattern" aria-hidden="true"></div>

        <div class="spin-shell">
            <div class="spin-wheel-column">
                <div class="spin-wheel-stage">
                    <div class="spin-wheel-ring" aria-hidden="true"></div>

                    <div class="spin-wheel-clacker" aria-hidden="true">
                        <div class="spin-wheel-clacker-tip"></div>
                        <div class="spin-wheel-clacker-dot"></div>
                    </div>

                    <div class="spin-wheel-container">
                        <div class="wheel-glow" aria-hidden="true"></div>
                        <div class="gold-ring"></div>

                        <div id="spin-wheel-wheel" aria-label="Spin wheel">
                            <div id="spin-wheel-image">
                                <div class="wheel-segment seg-0">
                                    <span class="segment-text">₹1000<br>VOUCHER</span>
                                </div>
                                <div class="wheel-segment seg-1">
                                    <span class="segment-text">TRY<br>AGAIN</span>
                                </div>
                                <div class="wheel-segment seg-2">
                                    <span class="segment-text">₹500<br>VOUCHER</span>
                                </div>
                                <div class="wheel-segment seg-3">
                                    <span class="segment-text">NEXT<br>TIME</span>
                                </div>
                            </div>

                            <div class="spin-wheel-center-cap">
                                <svg class="spin-icon spin-icon-crown" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 18h18l-2-9-5 4-2-7-2 7-5-4-2 9z"></path>
                                </svg>
                                <span>Spin</span>
                            </div>
                        </div>
                    </div>

                    <div class="spin-wheel-stand-shadow" aria-hidden="true"></div>
                </div>
            </div>

            <div class="spin-form-column">
                <div class="spin-wheel-form-card">
                    <div class="spin-live-badge">
                        <svg class="spin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M8 4h8v2h3v3a5 5 0 0 1-5 5 4 4 0 0 1-1.3 1.8V19h3v2H8v-2h3v-2.2A4 4 0 0 1 9.7 14A5 5 0 0 1 5 9V6h3V4z"></path>
                        </svg>
                        LIVE
                    </div>

                    <div class="spin-form-header">
                        <p class="spin-kicker">Limited Giveaway</p>
                        <h2 class="spin-title">Claim Your <br>Rewards.</h2>
                        <p class="spin-subtitle">Enter the prize pool by providing your shipping details.</p>
                    </div>

                    <form id="spin-wheel-form" onsubmit="return false;" novalidate>
                        <div class="spin-field-group">
                            <label>Identity</label>
                            <div class="spin-input-wrap">
                                <svg class="spin-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="7" r="4"></circle>
                                    <path d="M5.5 21a6.5 6.5 0 0 1 13 0"></path>
                                </svg>
                                <input type="text" name="name" placeholder="Full Name" autocomplete="name">
                            </div>
                        </div>

                        <div class="spin-field-group">
                            <label>Contact</label>
                            <div class="spin-input-wrap">
                                <svg class="spin-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 6h16v12H4z"></path>
                                    <path d="M4 7l8 6 8-6"></path>
                                </svg>
                                <input type="email" name="email" placeholder="Email Address" autocomplete="email">
                            </div>
                        </div>

                        <div class="spin-grid-two">
                            <div class="spin-input-wrap">
                                <svg class="spin-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.9v3a2 2 0 0 1-2.2 2A19.9 19.9 0 0 1 11.1 18a20 20 0 0 1-6.2-6.2A19.9 19.9 0 0 1 2.1 3.2 2 2 0 0 1 4.1 1h3a2 2 0 0 1 2 1.7c.1.9.4 1.7.7 2.5a2 2 0 0 1-.5 2.1L8 8.6a16 16 0 0 0 6.5 6.5l1.3-1.3a2 2 0 0 1 2.1-.5c.8.3 1.6.6 2.5.7A2 2 0 0 1 22 16.9z"></path>
                                </svg>
                                <input type="text" name="mobile" placeholder="Phone" autocomplete="tel">
                            </div>

                            <div class="spin-input-wrap">
                                <svg class="spin-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-5.3 8-12a8 8 0 1 0-16 0c0 6.7 8 12 8 12z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <input type="text" name="location" placeholder="City" autocomplete="address-level2">
                            </div>
                        </div>

                        <label class="spin-agree-row">
                            <input type="checkbox" name="consent" id="spin-consent">
                            <span>I agree to the <a href="https://chocolate-nightingale-996191.hostingersite.com/terms-and-conditions/" target="_blank" rel="noopener">Terms of Entry</a>.</span>
                        </label>

                        <button type="submit" id="spin-wheel-btn">
                            <span class="spin-btn-label">Spin To Win</span>
                            <svg class="spin-btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>

                        <div id="spin-wheel-error" class="spin-form-error" hidden>
                            <svg class="spin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="13"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <p id="spin-wheel-error-text"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="spin-result-modal" class="spin-result-modal" hidden>
            <div class="spin-result-card">
                <div class="spin-result-glow" aria-hidden="true"></div>
                <div id="spin-result-gift" class="spin-result-gift">
                    <svg class="spin-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="8" width="18" height="13" rx="2"></rect>
                        <line x1="12" y1="8" x2="12" y2="21"></line>
                        <path d="M3 12h18"></path>
                        <path d="M12 8c-2.2 0-4-1.3-4-3 0-1.1.9-2 2-2 2.2 0 2.8 2.2 2 5z"></path>
                        <path d="M12 8c2.2 0 4-1.3 4-3 0-1.1-.9-2-2-2-2.2 0-2.8 2.2-2 5z"></path>
                    </svg>
                </div>
                <h3 id="spin-result-title"></h3>
                <p id="spin-result-text"></p>
                <button type="button" id="spin-result-close">Dismiss</button>
            </div>
        </div>
    </div>

<?php
    return ob_get_clean();
});
