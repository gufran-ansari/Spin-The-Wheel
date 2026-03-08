/**
 * Spin Wheel – Backend Core (FINAL)
 * - Prevents duplicate email + mobile
 * - Quota-safe
 * - AJAX authoritative
 */

/* ==============================
 * CONFIG
 * ============================== */
define('SPIN_GOOGLE_WEBHOOK', 'https://script.google.com/macros/s/AKfycbwxpRTT2Mx7eiNyOtsPOaEzGzDsUXTNN2gJ1rVM9-Bh0q35YBWvrkFPtHFdVkl3W04a1w/exec');

/* ==============================
 * DB TABLE (SAFE CREATE)
 * ============================== */
add_action('init', function () {
    global $wpdb;

    $table = $wpdb->prefix . 'spin_wheel_entries';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        mobile VARCHAR(50) NOT NULL,
        location VARCHAR(255) NOT NULL,
        result VARCHAR(100) NOT NULL,
        spin_id VARCHAR(50) NOT NULL,
        ip_address VARCHAR(45),
        user_agent TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY unique_email_mobile (email, mobile)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
});

/* ==============================
 * QUOTAS
 * ============================== */
function spin_wheel_get_quotas() {
    return [
        'voucher_1000' => 20,
        'voucher_500'  => 110,
        'blnt'         => 200,
    ];
}

/* ==============================
 * PICK RESULT (SERVER AUTHORITY)
 * ============================== */
function spin_wheel_pick_result() {
    global $wpdb;
    $table = $wpdb->prefix . 'spin_wheel_entries';
    $quotas = spin_wheel_get_quotas();

    $used = $wpdb->get_results("
        SELECT result, COUNT(*) AS total
        FROM $table
        GROUP BY result
    ", OBJECT_K);

    $remaining = [
        'voucher_1000' => max(0, $quotas['voucher_1000'] - ($used['voucher_1000']->total ?? 0)),
        'voucher_500'  => max(0, $quotas['voucher_500']  - ($used['voucher_500']->total ?? 0)),
        'blnt'         => max(0, $quotas['blnt']         - ($used['blnt']->total ?? 0)),
    ];

    $pool = [];
    foreach ($remaining as $key => $count) {
        $pool = array_merge($pool, array_fill(0, $count, $key));
    }

    if (empty($pool)) return false;

    return $pool[array_rand($pool)];
}

/* ==============================
 * AJAX HANDLER
 * ============================== */
add_action('wp_ajax_spin_wheel', 'spin_wheel_handle');
add_action('wp_ajax_nopriv_spin_wheel', 'spin_wheel_handle');

function spin_wheel_handle() {
    global $wpdb;
    $table = $wpdb->prefix . 'spin_wheel_entries';

    // Sanitize
    $name     = sanitize_text_field($_POST['name'] ?? '');
    $email    = sanitize_email($_POST['email'] ?? '');
    $mobile   = sanitize_text_field($_POST['mobile'] ?? '');
    $location = sanitize_text_field($_POST['location'] ?? '');

    if (!$name || !$email || !$mobile || !$location) {
        wp_send_json_error(['message' => 'Invalid submission.']);
    }

    // Pick result FIRST (server decides)
    $result_key = spin_wheel_pick_result();
    if (!$result_key) {
        wp_send_json_error(['message' => 'This giveaway has ended.']);
    }

    $result_map = [
        'voucher_1000' => '₹1000 Voucher',
        'voucher_500'  => '₹500 Voucher',
        'blnt'         => 'Better Luck Next Time',
    ];

    $spin_id = uniqid('SPIN_');
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // Insert (DB enforces uniqueness)
    $inserted = $wpdb->insert($table, [
        'full_name'  => $name,
        'email'      => $email,
        'mobile'     => $mobile,
        'location'   => $location,
        'result'     => $result_key,
        'spin_id'    => $spin_id,
        'ip_address' => $ip,
        'user_agent' => $ua,
    ]);

    if ($inserted === false) {
        wp_send_json_error([
            'message' => 'You have already participated.'
        ]);
    }

    // Push to Google Sheet (non-blocking)
    if (SPIN_GOOGLE_WEBHOOK) {
        wp_remote_post(SPIN_GOOGLE_WEBHOOK, [
            'headers'  => ['Content-Type' => 'application/json'],
            'body'     => wp_json_encode([
                'full_name' => $name,
                'email'     => $email,
                'mobile'    => $mobile,
                'location'  => $location,
                'result'    => $result_map[$result_key],
                'datetime'  => current_time('mysql'),
                'ip'        => $ip,
                'spin_id'   => $spin_id,
            ]),
            'timeout'  => 5,
            'blocking' => false,
        ]);
    }

    wp_send_json_success([
        'result_key'   => $result_key,
        'result_label' => $result_map[$result_key],
    ]);
}

