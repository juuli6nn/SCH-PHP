<?php
$stage = isset($_GET['stage']) ? (int) $_GET['stage'] : 0;
$stage = max(0, min($stage, 4));
$nextStage = min($stage + 1, 4);
$refreshDelay = $stage < 4 ? 10 : 0;
$cookieCreated = false;

if ($stage === 1 && !isset($_COOKIE['studentCookie'])) {
    setcookie('studentCookie', 'StudentCookieCreated', time() + 3600, '/');
    $cookieCreated = true;
}

$cookieExists = isset($_COOKIE['studentCookie']) || $cookieCreated;
$nameParts = ['Arianne', 'Julian', 'Cruz'];

switch ($stage) {
    case 0:
    case 1:
        $displayName = implode(' ', $nameParts);
        break;
    case 2:
        $displayName = $nameParts[0] . ' ' . $nameParts[1];
        break;
    case 3:
        $displayName = $nameParts[0];
        break;
    default:
        $displayName = '';
        break;
}

$stageMessages = [
    0 => '10 seconds for cookie.',
    1 => 'Cookie Created.',
    2 => 'Last name has disappeared.',
    3 => 'Middle name has disappeared.',
    4 => 'First name has disappeared.',
];

$refreshUrl = $refreshDelay > 0 ? 'act2.php?stage=' . $nextStage : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity 2 - Cookie Management</title>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="act2.css">
    <?php if ($refreshUrl): ?>
        <meta http-equiv="refresh" content="<?php echo $refreshDelay; ?>; url=<?php echo htmlspecialchars($refreshUrl); ?>">
    <?php endif; ?>
</head>
<body>
    <a href="index.php" class="return-button">←</a>
    <div class="container">
        <h1>Cookies</h1>

        <div class="name-display">
            <p><?php echo htmlspecialchars($displayName ?: '---'); ?></p>
        </div>

        <div class="cookie-status">
            <h3>Cookie Status</h3>
            <p><?php echo htmlspecialchars($stageMessages[$stage]); ?></p>
        </div>

        <a href="act2.php" class="button">Reset Page</a>
    </div>
</body>
</html>
