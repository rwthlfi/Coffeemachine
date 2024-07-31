<?php
include ("connection.php");
session_start();
$product = $_GET['name'];
$_SESSION['productEdit'] = $product;
$sql = "SELECT * FROM product WHERE Name = '$product'";
$result = $conn->query($sql);
if ($result->num_rows==1){
    $row = $result->fetch_assoc();
    $productOldName = $row['Name'];
    $productOldPrice = $row['Price'];

}else {
    echo $product + "is not found !";
}
?>
<head>
    <h1> Edit: <?php echo $productOldName ?> </h1>
</head>
<form name="form" action="edit_product_process.php" method="POST">
    <label>Name: </label>
    <input type="text" id="name" name="name" value = "<?php echo $productOldName ?>" ></br></br>
    <label>Price: </label>
    <input type="number" step="any" id="price" name="price" value = "<?php echo $productOldPrice ?>" > </br></br> 

    <input type="submit" id="btn" value="finish" />
</form>