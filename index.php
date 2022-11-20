<?php
  session_start();
  if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = array();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href='./styles.css' />

  <title>Cart do cezinha</title>
</head>
<body>
  <h2 class="title">Carrinho</h2>

  <?php 
    $_SESSION['contador'] = count($_SESSION['products']);

    $cart = array();
    $productsTemp = array();

    for ($i=0; $i < $_SESSION['contador']; $i++) { 
      if($_SESSION['products'][$i]['name'] == $_POST['productName']) {
  ?>
        <div class="error">
          <span> O produto já existe!</span>
          <a href="http://localhost/cezinha/newProduct">Tente outro produto</a>
        </div>;
  <?php
        return;
      }
    }

    if($_POST['productName']){
      $productsTemp['name'] = $_POST['productName'];
      $productsTemp['price'] = $_POST['productPrice'];
      array_push($_SESSION['products'], $productsTemp);
    }
    echo '<div class="products">';


    foreach($_SESSION['products'] as $product => $value){
  ?>
    <div class="product">
      <h2 class="product-name">
        <?php echo $value['name']?>
      </h2>
      <span class="product-price">R$:<?php echo $value['price']?></span>
      <a href="?adicionar<?php echo $product?>" class="add-to-cart">Adicionar ao carrinho</a>
    </div>
  <?php
    };
    echo '</div>';
  ?>
  <a href="http://localhost/cezinha/newProduct">Adicionar um novo produto para vender</a>
</body>
</html>