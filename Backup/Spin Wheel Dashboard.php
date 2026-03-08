/**
 * Spin Wheel – Admin Dashboard
 */

/** ==============================
 * ADD ADMIN MENU
 * ============================== */
add_action('admin_menu', function () {
    add_menu_page(
        'Spin Wheel',
        'Spin Wheel',
        'manage_options',
        'spin-wheel-admin',
        'spin_wheel_admin_page',
        'dashicons-controls-repeat',
        26
    );
});

/** ==============================
 * ADMIN PAGE CONTENT
 * ============================== */
function spin_wheel_admin_page() {
    global $wpdb;
    $table = $wpdb->prefix . 'spin_wheel_entries';

    // Handle CSV export
    if (isset($_GET['export']) && $_GET['export'] === 'csv') {
        spin_wheel_export_csv();
        exit;
    }

    $rows = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");

    $counts = $wpdb->get_results("
        SELECT result, COUNT(*) as total
        FROM $table
        GROUP BY result
    ", OBJECT_K);

    $count_1000 = $counts['voucher_1000']->total ?? 0;
    $count_500  = $counts['voucher_500']->total ?? 0;
    $count_blnt = $counts['blnt']->total ?? 0;
    ?>

    <div class="wrap">
        <h1>Spin Wheel Dashboard</h1>

        <p>
            <strong>₹1000 Vouchers:</strong> <?php echo esc_html($count_1000); ?> /
            <strong>₹500 Vouchers:</strong> <?php echo esc_html($count_500); ?> /
            <strong>Better Luck:</strong> <?php echo esc_html($count_blnt); ?>
        </p>

        <p>
            <a href="<?php echo admin_url('admin.php?page=spin-wheel-admin&export=csv'); ?>" class="button button-primary">
                Export CSV
            </a>
        </p>

        <table class="widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Location</th>
                    <th>Result</th>
                    <th>Spin ID</th>
                    <th>Date</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows): foreach ($rows as $row): ?>
                    <tr>
                        <td><?php echo esc_html($row->id); ?></td>
                        <td><?php echo esc_html($row->full_name); ?></td>
                        <td><?php echo esc_html($row->email); ?></td>
                        <td><?php echo esc_html($row->mobile); ?></td>
                        <td><?php echo esc_html($row->location); ?></td>
                        <td>
                            <?php
                            echo esc_html(
                                $row->result === 'voucher_1000' ? '₹1000 Voucher' :
                                ($row->result === 'voucher_500' ? '₹500 Voucher' : 'Better Luck Next Time')
                            );
                            ?>
                        </td>
                        <td><?php echo esc_html($row->spin_id); ?></td>
                        <td><?php echo esc_html($row->created_at); ?></td>
                        <td><?php echo esc_html($row->ip_address); ?></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="9">No entries yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php
}

/** ==============================
 * EXPORT CSV
 * ============================== */
function spin_wheel_export_csv() {
    global $wpdb;
    $table = $wpdb->prefix . 'spin_wheel_entries';

    $rows = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC", ARRAY_A);

    if (!$rows) {
        wp_die('No data available');
    }

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="spin-wheel-data.csv"');

    $output = fopen('php://output', 'w');

    fputcsv($output, [
        'ID', 'Full Name', 'Email', 'Mobile', 'Location',
        'Result', 'Spin ID', 'Date', 'IP'
    ]);

    foreach ($rows as $row) {
        fputcsv($output, [
            $row['id'],
            $row['full_name'],
            $row['email'],
            $row['mobile'],
            $row['location'],
            $row['result'],
            $row['spin_id'],
            $row['created_at'],
            $row['ip_address']
        ]);
    }

    fclose($output);
    exit;
}
