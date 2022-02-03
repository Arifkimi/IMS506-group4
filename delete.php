<?php

/**
 * Delete a user
 */

require "config.php";
require "common.php";

if (isset($_GET["Book_ISBN"])) {
    try {
        $connection = new PDO($dsn, $user_name, $password, $options);

        $Book_ISBN = $_GET["Book_ISBN"];

        $sql = "DELETE FROM book WHERE Book_ISBN = :Book_ISBN";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':Book_ISBN', $Book_ISBN);
        $statement->execute();

        $success = "User successfully deleted";
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $user_name, $password, $options);

    $sql = "SELECT * FROM book";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "header.php"; ?>

<h2>Delete users</h2>

<table>
    <thead>
        <tr>
            <th>Book_title</th>
            <th>Book_ISBN</th>
            <th>Book_price</th>
            <th>Supp_num</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["Book_title"]); ?></td>
                <td><?php echo escape($row["Book_ISBN"]); ?></td>
                <td><?php echo escape($row["Book_price"]); ?></td>
                <td><?php echo escape($row["Supp_num"]); ?></td>
                <td><a href="delete.php?Book_ISBN=<?php echo escape($row["Book_ISBN"]); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "footer.php"; ?>