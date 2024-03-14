<?php
if (isset($_POST['submit'])) {
    require "../common.php";
    require "../config.php";
    
    try {
        require "../DBconnect.php"; // Ensure the path is corrected

        $location = $_POST['location'];
        $sql = "SELECT * FROM users WHERE location = :location";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':location', $location, PDO::PARAM_STR); // Ensure proper parameter binding
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

require "templates/header.php";
?>

<h2>Find user based on location</h2>
<form method="post">
    <label for="location">Location</label>
    <input type="text" id="location" name="location">
    <input type="submit" name="submit" value="View Results">
</form>

<?php
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Age</th><th>Location</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . escape($row["id"]) . "</td>";
            echo "<td>" . escape($row["firstname"]) . "</td>";
            echo "<td>" . escape($row["lastname"]) . "</td>";
            echo "<td>" . escape($row["email"]) . "</td>";
            echo "<td>" . escape($row["age"]) . "</td>";
            echo "<td>" . escape($row["location"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No results found for " . escape($_POST['location']) . ".</p>";
    }
}
?>

<?php require "templates/footer.php"; ?>
