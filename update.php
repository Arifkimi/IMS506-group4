<?php

/**
  * List all books with a link to update
  */

try {
  require "config.php";
  require "common.php";

  $connection = new PDO($dsn, $user_name, $password, $options);

  $sql = "SELECT * FROM book";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "header.php"; ?>

<h2>Update Book</h2>

<table>
  <thead>
    <tr>
    <th>Book_title</th>
    <th>Book_ISBN</th>
    <th>Book_price</th>
    <th>Supp_num</th>
    <th>Update</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["Book_title"]); ?></td>
      <td><?php echo escape($row["Book_ISBN"]); ?></td>
      <td><?php echo escape($row["Book_price"]); ?></td>
      <td><?php echo escape($row["Supp_num"]); ?></td>
      <td><a href="update-single.php?Book_ISBN=<?php echo escape($row["Book_ISBN"]); ?>">Update</a></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>