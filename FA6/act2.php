<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Records</title>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="act2.css">
</head>
<body>
    <a href="index.php" class="return-button">←</a>

    <div class="container">
        <h1>Dog Records</h1>

        <?php
        require_once 'db_connect.php';

        $query = "SELECT * FROM dogs ORDER BY created_at ASC";
        $result = $mysqli->query($query);

        if ($result && $result->num_rows > 0):
            $dogCounter = 1; 
        ?>
            <div class="record-grid">
        <?php
            while ($row = $result->fetch_assoc()):
        ?>
                <div class="record-card">
                    <h2>Dog <?php echo $dogCounter; ?></h2>
                    <div class="result-item"><strong>Name:</strong> <?php echo htmlspecialchars($row['dogname']); ?></div>
                    <div class="result-item"><strong>Breed:</strong> <?php echo htmlspecialchars($row['breed']); ?></div>
                    <div class="result-item"><strong>Age:</strong> <?php echo htmlspecialchars($row['age']); ?></div>
                    <div class="result-item"><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></div>
                    <div class="result-item"><strong>Color:</strong> <?php echo htmlspecialchars($row['color']); ?></div>
                    <div class="result-item"><strong>Height:</strong> <?php echo htmlspecialchars($row['height']); ?></div>
                    <div class="result-item"><strong>Weight:</strong> <?php echo htmlspecialchars($row['weight']); ?></div>
                    <div class="result-item"><strong>Registered:</strong> <?php echo htmlspecialchars($row['created_at']); ?></div>
                </div>
        <?php
                $dogCounter++; 
            endwhile;
        ?>
            </div>
        <?php
        else:
        ?>
            <div class="message">No dog records found yet.</div>
        <?php
        endif;

        if ($result) {
            $result->free();
        }
        $mysqli->close();
        ?>
    </div>
</body>
</html>
