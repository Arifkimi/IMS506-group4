<?php

/**
 * Use an HTML form to create a new entry in the
 * book table.
 *
 */


if (isset($_POST['submit'])) {
    require "config.php";
    require "common.php";

    try  {
        $connection = new PDO($dsn , $user_name, $password, $options);
        
        $book = array(
            "Book_title" => $_POST['Book_title'],
            "Book_ISBN"  => $_POST['Book_ISBN'],
            "Supp_num"   => $_POST['Supp_num'],
            "Book_price" => $_POST['Book_price'],
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "book",
                implode(", ", array_keys($book)),
                ":" . implode(", :", array_keys($book))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($book);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['Book_title']; ?> Book successfully added.</blockquote>
<?php } ?>

<h2>Add a book</h2>

<form method="post">
	<label for="Book_title">Book Title</label>
	<input type="text" name="Book_title" id="Book_title">
	<label for="Book_ISBN">Book_ISBN</label>
	<input type="text" name="Book_ISBN" id="Book_ISBN">
	<label for="Supp_num">Supp_num</label>
	<input type="text" name="Supp_num" id="Supp_num">
	<label for="Book_price">Book_price(RM)</label>
	<input type="text" name="Book_price" id="Book_price">
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "footer.php"; ?>