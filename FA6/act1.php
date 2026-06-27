<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Registration</title>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="act1.css">
</head>

<body>
    <a href="index.php" class="return-button">←</a>
    
    <div class="container">
        <h1>Dog Registration</h1>
        <p class="subtitle">Enter your dog’s details below and save them to the dog records list.</p>

        <?php
        $message = '';
        $messageClass = 'message';
        $dogname = '';
        $breed = '';
        $age = '';
        $address = '';
        $color = '';
        $height = '';
        $weight = '';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $dogname = trim($_POST['dogname']);
            $breed = trim($_POST['breed']);
            $age = trim($_POST['age']);
            $address = trim($_POST['address']);
            $color = trim($_POST['color']);
            $height = trim($_POST['height']);
            $weight = trim($_POST['weight']);

            if ($dogname === '' || $breed === '' || $age === '' || $address === '' || $color === '' || $height === '' || $weight === '') {
                $message = 'Please fill in all fields.';
                $messageClass = 'message error';
            } else {
                require_once 'db_connect.php';

                $stmt = $mysqli->prepare("INSERT INTO dogs (dogname, breed, age, address, color, height, weight) VALUES (?, ?, ?, ?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param('sssssss', $dogname, $breed, $age, $address, $color, $height, $weight);
                    if ($stmt->execute()) {
                        $message = 'Dog information saved successfully.';
                        $messageClass = 'message success';
                        $dogname = $breed = $age = $address = $color = $height = $weight = '';
                    } else {
                        $message = 'Save failed: ' . htmlspecialchars($stmt->error);
                        $messageClass = 'message error';
                    }
                    $stmt->close();
                } else {
                    $message = 'Prepare failed: ' . htmlspecialchars($mysqli->error);
                    $messageClass = 'message error';
                }

                $mysqli->close();
            }
        }
        ?>

        <?php if ($message !== ''): ?>
            <div class="<?php echo $messageClass; ?>"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="act1.php" method="POST">
            <div class="form-group">
                <label for="dogname">Name</label>
                <input id="dogname" type="text" name="dogname" placeholder="Enter dog name" value="<?php echo htmlspecialchars($dogname); ?>" required>
            </div>

            <div class="form-group">
                <label for="breed">Breed</label>
                <input id="breed" type="text" name="breed" placeholder="Enter dog breed" value="<?php echo htmlspecialchars($breed); ?>" required>
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input id="age" type="number" name="age" placeholder="Years old" min="0" value="<?php echo htmlspecialchars($age); ?>" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input id="address" type="text" name="address" placeholder="Enter owner address" value="<?php echo htmlspecialchars($address); ?>" required>
            </div>

            <div class="form-group">
                <label for="color">Color</label>
                <input id="color" type="text" name="color" placeholder="Enter color" value="<?php echo htmlspecialchars($color); ?>" required>
            </div>

            <div class="form-group">
                <label for="height">Height</label>
                <input id="height" type="text" name="height" placeholder="e.g. 2 ft" value="<?php echo htmlspecialchars($height); ?>" required>
            </div>

            <div class="form-group">
                <label for="weight">Weight</label>
                <input id="weight" type="text" name="weight" placeholder="e.g. 7 kg" value="<?php echo htmlspecialchars($weight); ?>" required>
            </div>

            <div class="button-row">
                <button type="submit">Save Dog</button>
                <a href="act2.php" class="button-link">View All Records</a>
            </div>
        </form>
    </div>
</body>
</html>
