<?php
session_start();

if (!isset($_SESSION['color1'])) {
    header('Location: act3.php');
    exit();
}

function getColorHex(string $value): string {
    $value = trim($value);

    if (preg_match('/^#?([0-9a-f]{3}|[0-9a-f]{6})$/i', $value, $matches)) {
        $hex = strtoupper($matches[1]);
        return '#' . $hex;
    }

    $map = [
        'black' => '#000000',
        'white' => '#FFFFFF',
        'red' => '#FF0000',
        'green' => '#008000',
        'blue' => '#0000FF',
        'yellow' => '#FFFF00',
        'orange' => '#FFA500',
        'purple' => '#800080',
        'violet' => '#8A2BE2',
        'pink' => '#FFC0CB',
        'brown' => '#A52A2A',
        'gray' => '#808080',
        'grey' => '#808080',
        'cyan' => '#00FFFF',
        'magenta' => '#FF00FF',
        'lime' => '#00FF00',
        'maroon' => '#800000',
        'navy' => '#000080',
        'teal' => '#008080',
        'gold' => '#FFD700',
        'silver' => '#C0C0C0',
    ];

    $key = strtolower($value);
    return $map[$key] ?? '#000000';
}

function renderColorItem(string $label, string $color): string {
    $hex = getColorHex($color);
    $text = htmlspecialchars($color, ENT_QUOTES, 'UTF-8');
    return '<div class="result-item">'
        . '<strong>' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</strong> '
        . '<span class="color-value" style="color:' . $hex . ';">' . $text . '</span>'
        . ' <span class="hex-value">(' . $hex . ')</span>'
        . '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result - Favorite Colors</title>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="act3.css">
</head>
<body>
    <a href="index.php" class="return-button">←</a>
    
    <div class="container">
        <h1>My Favorite Colors</h1>
        <p class="subtitle">Session</p>

        <div class="result-box">
            <?php echo renderColorItem('My Favorite Color 1:', $_SESSION['color1']); ?>
            <?php echo renderColorItem('My Favorite Color 2:', $_SESSION['color2']); ?>
            <?php echo renderColorItem('My Favorite Color 3:', $_SESSION['color3']); ?>
            <?php echo renderColorItem('My Favorite Color 4:', $_SESSION['color4']); ?>
            <?php echo renderColorItem('My Favorite Color 5:', $_SESSION['color5']); ?>
        </div>
    </div>
</body>
</html>
