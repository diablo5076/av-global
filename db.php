<?php
/**
 * Database Initialization & Helper for Inquiries and Catalogue Users
 * Uses SQLite with PDO for zero-configuration, robust lead storage.
 */

require_once __DIR__ . '/config.php';

function getDbConnection() {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    if (!is_dir(DB_DIR)) {
        @mkdir(DB_DIR, 0755, true);
    }

    $dbFile = DB_PATH;
    $isNew = !file_exists($dbFile);

    try {
        $pdo = new PDO('sqlite:' . $dbFile);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Initialize schema if newly created or missing tables
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS inquiries (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                form_source TEXT,
                name TEXT NOT NULL,
                company TEXT,
                country TEXT,
                email TEXT NOT NULL,
                phone TEXT NOT NULL,
                product TEXT,
                quantity TEXT,
                budget TEXT,
                message TEXT,
                ip_address TEXT,
                user_agent TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS catalogue_users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                company TEXT,
                country TEXT,
                email TEXT NOT NULL UNIQUE,
                phone TEXT NOT NULL,
                password_hash TEXT,
                is_verified INTEGER DEFAULT 1,
                verification_token TEXT,
                ip_address TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                last_login_at DATETIME
            );

            CREATE TABLE IF NOT EXISTS rate_limits (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                ip_address TEXT NOT NULL,
                action_type TEXT NOT NULL,
                timestamp INTEGER NOT NULL
            );

            CREATE INDEX IF NOT EXISTS idx_inquiries_created ON inquiries(created_at);
            CREATE INDEX IF NOT EXISTS idx_catalogue_users_email ON catalogue_users(email);
            CREATE INDEX IF NOT EXISTS idx_rate_limits_ip ON rate_limits(ip_address, timestamp);
        ");

        return $pdo;
    } catch (PDOException $e) {
        error_log("Database connection error: " . $e->getMessage());
        return null;
    }
}

/**
 * Check and record IP rate limit
 */
function checkRateLimit($action = 'inquiry', $limit = 5, $windowSeconds = 3600) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $db = getDbConnection();
    if (!$db) return true; // Fail open if DB unavailable

    $now = time();
    $cutoff = $now - $windowSeconds;

    // Clean up old entries
    $cleanupStmt = $db->prepare("DELETE FROM rate_limits WHERE timestamp < :cutoff");
    $cleanupStmt->execute([':cutoff' => $cutoff]);

    // Count recent attempts
    $countStmt = $db->prepare("SELECT COUNT(*) FROM rate_limits WHERE ip_address = :ip AND action_type = :action AND timestamp >= :cutoff");
    $countStmt->execute([
        ':ip' => $ip,
        ':action' => $action,
        ':cutoff' => $cutoff
    ]);
    $count = (int)$countStmt->fetchColumn();

    if ($count >= $limit) {
        return false;
    }

    // Record this attempt
    $insertStmt = $db->prepare("INSERT INTO rate_limits (ip_address, action_type, timestamp) VALUES (:ip, :action, :timestamp)");
    $insertStmt->execute([
        ':ip' => $ip,
        ':action' => $action,
        ':timestamp' => $now
    ]);

    return true;
}
