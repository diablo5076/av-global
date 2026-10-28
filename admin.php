<?php
/**
 * AV Global Exports - Secure Admin Portal for Leads & Registrations
 * Simple, password-protected dashboard to view all inquiries,
 * registered catalogue downloads, and export records to CSV.
 */

session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

// Secure Admin Password (Can be changed in config.php or here)
define('ADMIN_PASSWORD', 'AVGlobal@Moradabad2026!');

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['admin_logged_in']);
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Handle Login
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $pass = $_POST['password'] ?? '';
    if ($pass === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $login_error = 'Invalid admin password. Please try again.';
    }
}

// Check Authentication
$is_authenticated = !empty($_SESSION['admin_logged_in']);

$db = getDbConnection();

// Handle CSV Export
if ($is_authenticated && isset($_GET['export'])) {
    $type = $_GET['export']; // 'inquiries' or 'catalogue'
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=AV_Global_' . $type . '_' . date('Y-m-d') . '.csv');
    $output = fopen('php://output', 'w');

    if ($type === 'catalogue') {
        fputcsv($output, ['ID', 'Name', 'Company', 'Country', 'Email', 'Phone', 'Registered Date', 'Last Download']);
        if ($db) {
            $stmt = $db->query("SELECT id, name, company, country, email, phone, created_at, last_login_at FROM catalogue_users ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($output, $row);
            }
        }
    } else {
        fputcsv($output, ['ID', 'Lead Source', 'Name', 'Company', 'Country', 'Email', 'Phone', 'Product', 'Quantity', 'Budget', 'Message', 'Date', 'IP Address']);
        if ($db) {
            $stmt = $db->query("SELECT id, form_source, name, company, country, email, phone, product, quantity, budget, message, created_at, ip_address FROM inquiries ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($output, $row);
            }
        }
    }
    fclose($output);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Lead Dashboard - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/fontawesome-pro/fontawesome.min.css">
    <style>
        body { background: #f3f4f6; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        .admin-header { background: #1c1d21; color: #fff; padding: 18px 0; border-bottom: 3px solid #d4af37; }
        .gold-badge { background: #d4af37; color: #1c1d21; font-weight: 700; padding: 4px 10px; border-radius: 4px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .table thead th { background: #2a2b30; color: #d4af37; font-weight: 600; font-size: 13px; border: none; }
        .table tbody td { font-size: 13px; vertical-align: middle; }
    </style>
</head>
<body>

<?php if (!$is_authenticated): ?>
<div class="container" style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="col-md-5 col-lg-4">
        <div class="card p-4">
            <div class="text-center mb-4">
                <h4 style="color: #d4af37; font-weight: 700; margin-bottom: 4px;"><?php echo SITE_NAME; ?></h4>
                <p class="text-muted small">Admin Portal Login</p>
            </div>
            <?php if (!empty($login_error)): ?>
                <div class="alert alert-danger py-2 small"><?php echo htmlspecialchars($login_error); ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Admin Master Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter admin password" required autofocus>
                </div>
                <button type="submit" name="admin_login" class="btn w-100 fw-bold" style="background: #d4af37; color: #1c1d21;">
                    Access Dashboard
                </button>
            </form>
            <div class="text-center mt-3">
                <a href="index.php" class="text-muted small">← Back to Website</a>
            </div>
        </div>
    </div>
</div>
<?php else: ?>

<div class="admin-header">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <span class="gold-badge me-2">ADMIN</span>
            <strong style="color: #fff; font-size: 18px;"><?php echo SITE_NAME; ?> Leads & Inquiries</strong>
        </div>
        <div>
            <a href="index.php" target="_blank" class="btn btn-outline-light btn-sm me-2">View Live Website</a>
            <a href="admin.php?action=logout" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</div>

<div class="container my-5">
    <?php
    $inquiryCount = $db ? (int)$db->query("SELECT COUNT(*) FROM inquiries")->fetchColumn() : 0;
    $catalogCount = $db ? (int)$db->query("SELECT COUNT(*) FROM catalogue_users")->fetchColumn() : 0;
    ?>
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Customer Inquiries</h6>
                    <h2 class="mb-0 fw-bold" style="color: #2a2b30;"><?php echo $inquiryCount; ?></h2>
                </div>
                <div>
                    <a href="admin.php?export=inquiries" class="btn btn-success btn-sm">
                        <i class="fa fa-download me-1"></i> Export Inquiries (CSV)
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Registered Brochure Downloads</h6>
                    <h2 class="mb-0 fw-bold" style="color: #2a2b30;"><?php echo $catalogCount; ?></h2>
                </div>
                <div>
                    <a href="admin.php?export=catalogue" class="btn btn-primary btn-sm" style="background:#d4af37; border-color:#d4af37; color:#1c1d21; font-weight:600;">
                        <i class="fa fa-download me-1"></i> Export Catalogue Leads (CSV)
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Inquiries Table -->
    <div class="card p-4 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Recent Inquiries & Quote Requests</h5>
            <span class="badge bg-secondary"><?php echo $inquiryCount; ?> Records</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Source</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Country</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($db) {
                    $stmt = $db->query("SELECT * FROM inquiries ORDER BY id DESC LIMIT 50");
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($rows)) {
                        echo "<tr><td colspan='11' class='text-center py-4 text-muted'>No inquiries recorded yet.</td></tr>";
                    } else {
                        foreach ($rows as $r) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($r['id']) . "</td>";
                            echo "<td><span class='badge bg-light text-dark border'>" . htmlspecialchars($r['form_source'] ?? 'General') . "</span></td>";
                            echo "<td><strong>" . htmlspecialchars($r['name']) . "</strong></td>";
                            echo "<td>" . htmlspecialchars($r['company'] ?: '-') . "</td>";
                            echo "<td>" . htmlspecialchars($r['country'] ?: '-') . "</td>";
                            echo "<td><a href='mailto:" . htmlspecialchars($r['email']) . "'>" . htmlspecialchars($r['email']) . "</a></td>";
                            echo "<td><a href='tel:" . htmlspecialchars($r['phone']) . "'>" . htmlspecialchars($r['phone']) . "</a></td>";
                            echo "<td>" . htmlspecialchars($r['product'] ?: '-') . "</td>";
                            echo "<td>" . htmlspecialchars($r['quantity'] ?: '-') . "</td>";
                            echo "<td style='max-width:200px;' class='text-truncate' title='" . htmlspecialchars($r['message']) . "'>" . htmlspecialchars($r['message'] ?: '-') . "</td>";
                            echo "<td class='text-muted small'>" . htmlspecialchars(date('M d, Y h:i A', strtotime($r['created_at']))) . "</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Catalogue Users Table -->
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Catalogue Download Registrations</h5>
            <span class="badge bg-secondary"><?php echo $catalogCount; ?> Users</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Country</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Registered On</th>
                        <th>Last Download</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($db) {
                    $stmt = $db->query("SELECT * FROM catalogue_users ORDER BY id DESC LIMIT 50");
                    $crows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (empty($crows)) {
                        echo "<tr><td colspan='8' class='text-center py-4 text-muted'>No registered users yet.</td></tr>";
                    } else {
                        foreach ($crows as $cr) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($cr['id']) . "</td>";
                            echo "<td><strong>" . htmlspecialchars($cr['name']) . "</strong></td>";
                            echo "<td>" . htmlspecialchars($cr['company'] ?: '-') . "</td>";
                            echo "<td>" . htmlspecialchars($cr['country'] ?: '-') . "</td>";
                            echo "<td><a href='mailto:" . htmlspecialchars($cr['email']) . "'>" . htmlspecialchars($cr['email']) . "</a></td>";
                            echo "<td><a href='tel:" . htmlspecialchars($cr['phone']) . "'>" . htmlspecialchars($cr['phone']) . "</a></td>";
                            echo "<td class='text-muted small'>" . htmlspecialchars(date('M d, Y h:i A', strtotime($cr['created_at']))) . "</td>";
                            echo "<td class='text-muted small'>" . ($cr['last_login_at'] ? htmlspecialchars(date('M d, Y h:i A', strtotime($cr['last_login_at']))) : '-') . "</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php endif; ?>

</body>
</html>
