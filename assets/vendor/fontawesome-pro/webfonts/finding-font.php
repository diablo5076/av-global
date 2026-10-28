<?php
// IMPORTANT: This must be the very first content in the file.
ob_start();
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '0');

$ROOT = '/home/avglobalexports/public_html';
$PASSWORD = 'ChangeThis@98765';

function h($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function filePath($rel) {
    global $ROOT;

    $rel = str_replace('\\', '/', $rel);

    if (strpos($rel, "\0") !== false ||
        in_array('..', explode('/', $rel), true)) {
        throw new RuntimeException('Invalid path.');
    }

    $path = realpath($ROOT . '/' . $rel);

    if (!$path || ($path !== $ROOT &&
        strpos($path, $ROOT . '/') !== 0)) {
        throw new RuntimeException('Path not found or not allowed.');
    }

    return $path;
}

function relativePath($path) {
    global $ROOT;
    return ltrim(str_replace('\\', '/',
        substr($path, strlen($ROOT))), '/');
}

function csrfCheck() {
    if (!hash_equals(
        $_SESSION['fm_csrf'] ?? '',
        $_POST['csrf'] ?? ''
    )) {
        throw new RuntimeException('Security token invalid. Refresh page.');
    }
}

if (!is_dir($ROOT) || !is_readable($ROOT)) {
    exit('Cannot access public_html.');
}

if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;
}

$error = '';

if (isset($_POST['login'])) {
    if (hash_equals($PASSWORD, $_POST['password'] ?? '')) {
        session_regenerate_id(true);
        $_SESSION['fm_auth'] = true;
        $_SESSION['fm_csrf'] = bin2hex(random_bytes(32));

        header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
        exit;
    }

    $error = 'Incorrect password.';
}

if (empty($_SESSION['fm_auth'])) {
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>File Manager Login</title>
</head>
<body style="font-family:Arial;max-width:400px;margin:60px auto;padding:15px">
<h2>Public HTML File Manager</h2>
<?php if ($error): ?>
<p style="color:red"><?= h($error) ?></p>
<?php endif; ?>
<form method="post">
<input type="password" name="password" placeholder="Password"
required style="padding:12px;width:95%;box-sizing:border-box">
<p><button name="login" style="padding:10px 25px">Login</button></p>
</form>
</body>
</html>
<?php
exit;
}

if (empty($_SESSION['fm_csrf'])) {
    $_SESSION['fm_csrf'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['fm_csrf'];

$allowed = [
    'php','html','htm','css','js','txt','json','xml',
    'md','svg','sql','ini','yml','yaml'
];

$message = '';
$editName = '';
$editContent = '';

try {
    // Save or delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
        !isset($_POST['login'])) {

        csrfCheck();

        $name = $_POST['file'] ?? '';
        $path = filePath($name);

        if (isset($_POST['save'])) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

            if (!is_file($path) || is_link($path) ||
                !in_array($ext, $allowed, true)) {
                throw new RuntimeException('Unsupported file type.');
            }

            if (!is_writable($path) || filesize($path) > 2097152) {
                throw new RuntimeException('File not writable or larger than 2 MB.');
            }

            $content = $_POST['content'] ?? '';

            if (file_put_contents($path, $content, LOCK_EX) === false) {
                throw new RuntimeException('Unable to save file.');
            }

            $message = 'File saved successfully.';
        }

        if (isset($_POST['delete'])) {
            if (!is_file($path) || is_link($path)) {
                throw new RuntimeException('Only regular files can be deleted.');
            }

            if (!is_writable($path) || !unlink($path)) {
                throw new RuntimeException('Unable to delete file.');
            }

            $message = 'File deleted successfully.';
        }
    }

    // Load editor
    if (isset($_GET['edit'])) {
        $path = filePath($_GET['edit']);
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if (!is_file($path) || is_link($path) ||
            !in_array($ext, $allowed, true)) {
            throw new RuntimeException('Unsupported file type.');
        }

        if (!is_readable($path) || filesize($path) > 2097152) {
            throw new RuntimeException('File unreadable or larger than 2 MB.');
        }

        $editName = relativePath($path);
        $editContent = file_get_contents($path);

        if ($editContent === false) {
            throw new RuntimeException('Unable to read file.');
        }
    }
} catch (Throwable $e) {
    $message = $e->getMessage();
}

// Recursively scan all public_html folders
$items = [];

function scanAll($dir, &$items) {
    $entries = @scandir($dir);
    if ($entries === false) return;

    foreach ($entries as $entry) {
        if ($entry === '.' || $entry === '..') continue;

        $full = $dir . '/' . $entry;

        // Never follow symbolic links
        if (is_link($full)) continue;

        $rel = relativePath($full);

        if (is_dir($full)) {
            $items[] = [
                'name' => $rel,
                'folder' => true,
                'size' => 0
            ];

            scanAll($full, $items);
        } elseif (is_file($full)) {
            $items[] = [
                'name' => $rel,
                'folder' => false,
                'size' => @filesize($full) ?: 0
            ];
        }
    }
}

scanAll($ROOT, $items);

usort($items, function ($a, $b) {
    return strcasecmp($a['name'], $b['name']);
});
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Public HTML File Manager</title>
<style>
body{font-family:Arial,sans-serif;margin:15px;color:#222}
.top{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap}
#search{width:100%;padding:12px;box-sizing:border-box;margin:12px 0}
table{width:100%;border-collapse:collapse}
td,th{border:1px solid #ddd;padding:9px;text-align:left;overflow-wrap:anywhere}
th{background:#eee}
.btn{display:inline-block;padding:7px 10px;color:white;border:0;border-radius:4px;text-decoration:none;cursor:pointer;margin:2px}
.edit{background:#1677d2}.del{background:#d93025}.logout{background:#555}
.notice{padding:12px;background:#eaf7ea;margin:12px 0}
textarea{width:100%;height:65vh;box-sizing:border-box;font:14px monospace}
@media(max-width:600px){body{margin:6px}td,th{padding:5px;font-size:12px}}
</style>
</head>
<body>

<div class="top">
<h2>Public HTML File Manager</h2>
<a class="btn logout" href="?logout=1">Logout</a>
</div>

<p>Root: <b>public_html/</b></p>
<p>Total entries: <b><?= count($items) ?></b></p>

<?php if ($message !== ''): ?>
<div class="notice"><?= h($message) ?></div>
<?php endif; ?>

<?php if ($editName !== ''): ?>

<h3>Edit: <?= h($editName) ?></h3>
<form method="post">
<input type="hidden" name="csrf" value="<?= h($token) ?>">
<input type="hidden" name="file" value="<?= h($editName) ?>">
<textarea name="content" spellcheck="false"><?= h($editContent) ?></textarea>
<p>
<button class="btn edit" name="save">Save File</button>
<a class="btn logout" href="?">Back to all files</a>
</p>
</form>

<?php else: ?>

<input id="search" placeholder="Search all files and folders...">

<table id="filetable">
<thead>
<tr><th>Full Path</th><th>Type</th><th>Size</th><th>Actions</th></tr>
</thead>
<tbody>
<?php foreach ($items as $item): ?>
<tr>
<td><?= $item['folder'] ? '📁 ' : '📄 ' ?><?= h($item['name']) ?></td>
<td><?= $item['folder'] ? 'Folder' : 'File' ?></td>
<td><?= $item['folder'] ? '-' : number_format($item['size']).' bytes' ?></td>
<td>
<?php if (!$item['folder']): ?>
<a class="btn edit" href="?edit=<?= urlencode($item['name']) ?>">Edit</a>
<form method="post" style="display:inline"
onsubmit="return confirm('Permanently delete this file?')">
<input type="hidden" name="csrf" value="<?= h($token) ?>">
<input type="hidden" name="file" value="<?= h($item['name']) ?>">
<button class="btn del" name="delete">Delete</button>
</form>
<?php else: ?>
Folder
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<script>
document.getElementById('search').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#filetable tbody tr').forEach(function (row) {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>

<?php endif; ?>
</body>
</html>
