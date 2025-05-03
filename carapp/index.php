<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ambitious Ladybug's Used Cars</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <header>
        <h1>Ambitious Ladybug's Used Cars</h1>
    </header>

    <main>
        <h2>Add a New Car</h2>
        <form method="post" action="components/insertCar.php">
            <input type="text" id="VIN" name="VIN" placeholder="VIN" required>
            <input type="text" id="Make" name="Make" placeholder="Make" required>
            <input type="text" id="Model" name="Model" placeholder="Model" required>
            <input type="number" id="Asking_Price" name="Asking_Price" step="0.01" placeholder="Asking Price" required>
            <button type="submit">Add Car</button>
        </form>

        <h2>Shop Our Used Cars</h2>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        include 'config_db.php';

        $query = "SELECT VIN, Make, Model, Asking_Price FROM inventory ORDER BY Make";
        $result = $mysqli->query($query);

        if ($result):
        ?>

        <table class="cars-list">
            <thead>
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Asking Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['Make']) ?></td>
                    <td><?= htmlspecialchars($row['Model']) ?></td>
                    <td>$<?= number_format($row['Asking_Price'], 2) ?></td>
                    <td>
                        <a class="btn-edit" href="index.php?edit=<?= urlencode($row['VIN']) ?>#edit-form">Edit</a>
                        <a class="btn-delete" href="components/deleteCar.php?VIN=<?= urlencode($row['VIN']) ?>" onclick="return confirm('Are you sure you want to delete this car?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php
        if (isset($_GET['added']) && $_GET['added'] === 'true') {
            echo '<h3 class="confirmation">New car added successfully!</h3>';
        }

        if (isset($_GET['deleted']) && $_GET['deleted'] === 'true') {
            echo '<h3 class="confirmation">Car deleted successfully!</h3>';
        }

        if (isset($_GET['updated']) && $_GET['updated'] === 'true') {
            echo '<h3 class="confirmation">Car updated successfully!</h3>';
        }

        if (isset($_GET['edit'])) {
            $editVIN = $mysqli->real_escape_string($_GET['edit']);
            $editQuery = "SELECT * FROM inventory WHERE VIN = '$editVIN'";
            $editResult = $mysqli->query($editQuery);

            if ($editResult && $editResult->num_rows > 0) {
                $car = $editResult->fetch_assoc();
        ?>
            <h2 id="edit-form">Edit Car</h2>
            <form method="post" action="components/updateCar.php">
                <input type="hidden" name="VIN" value="<?= htmlspecialchars($car['VIN']) ?>">
                <input type="text" name="Make" value="<?= htmlspecialchars($car['Make']) ?>" placeholder="Make" required>
                <input type="text" name="Model" value="<?= htmlspecialchars($car['Model']) ?>" placeholder="Model" required>
                <input type="number" id="Asking_Price" name="Asking_Price" step="0.01" value="<?= isset($car['Asking_Price']) ? htmlspecialchars($car['Asking_Price']) : '' ?>" 
    placeholder="Asking Price" required>
                <button type="submit">Update Car</button>
            </form>
        <?php
            }
        }
        ?>

        <?php else: ?>
            <p style="color: red;">Error fetching inventory: <?= $mysqli->error ?></p>
        <?php endif; ?>

        <?php $mysqli->close(); ?>
    </main>

    <footer>
        <p>© 2025 Ambitious Ladybug’s Cars. All rights reserved.</p>
        <p>We sell cars. Batteries not included.</p>
    </footer>
</body>
</html>
