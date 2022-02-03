<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "config.php";
require "common.php";
if (isset($_POST['Update'])) {
    try {
      $connection = new PDO($dsn, $user_name, $password, $options);
      $book =[
        "Book_title" => $_POST['Book_title'],
        "Book_ISBN"  => $_POST['Book_ISBN'],
        "Supp_num"   => $_POST['Supp_num'],
        "Book_price" => $_POST['Book_price'],
      ];

      $sql = "UPDATE book
      SET Book_ISBN = :Book_ISBN,
        Book_title = :Book_title,
        Supp_num = :Supp_num,
        Book_price = :Book_price 
        WHERE Book_ISBN =:Book_ISBN";

     $statement = $connection->prepare($sql);
     $statement->execute($book);

    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }

if (isset($_GET['Book_ISBN'])) {
    try {
        $connection = new PDO($dsn, $user_name, $password, $options);
        $Book_ISBN = $_GET['Book_ISBN'];
        $sql = "SELECT * FROM book WHERE Book_ISBN = :Book_ISBN";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':Book_ISBN', $Book_ISBN);
        $statement->execute();

        $Book_ISBN = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    echo $_GET['Book_ISBN']; // for testing purposes
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "header.php"; ?>

<h2>Edit a book</h2>

<form method="post">
    <?php foreach ($Book_ISBN as $key => $value) : ?>
        <label for="<?php echo $key; ?>">
            <?php echo ucfirst($key); ?>
        </label>
        <input type="text" name="<?php echo $key; ?>" Book_ISBN="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'Book_ISBN' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="Update" value="Update">
</form>

<a href="index.php">Back to home</a>

<?php require "footer.php"; ?>