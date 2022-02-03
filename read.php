<?php

/**
 * Function to query information based on 
 * a parameter: in this case, book.
 *
 */

if (isset($_POST['submit'])) {
    try  {
        
        require "config.php";
        require "common.php";

        $connection = new PDO($dsn, $user_name, $password, $options);

        $sql = "SELECT * 
                        FROM book
                        WHERE Book_title = :Book_title";

        $book = $_POST['book'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':Book_title', $book, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php require "header.php"; ?>
        
<?php  
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
        <h2>Results</h2>

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
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["Book_title"]); ?></td>
                <td><?php echo escape($row["Book_ISBN"]); ?></td>
                <td><?php echo escape($row["Book_price"]); ?></td>
                <td><?php echo escape($row["Supp_num"]); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['book']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>Find the book</h2>

<form method="post">
    <label for="book">Book</label>
    <input type="text" id="book" name="book">
    <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "footer.php"; ?>