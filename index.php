<?php
  session_start();
  if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = array();
  }

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
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
    $productName = $_POST['productName'] ? $_POST['productName'] : 'null';
    $productPrice = $_POST['productPrice'] ? $_POST['productPrice'] : 'null';

    $_SESSION['contador'] = count($_SESSION['products']);

    $productsTemp = array();

    for ($i=0; $i < $_SESSION['contador']; $i++) { 
      if($_SESSION['products'][$i]['name'] == $productName) {
  ?>
        <div class="error">
          <span> O produto já existe!</span>
          <a href="http://localhost/cezinha/newProduct">Tente outro produto</a>
        </div>;
  <?php
        return;
      }
    }


    if($productName !== 'null'){
      $productsTemp['name'] = $productName;
      $productsTemp['price'] = $productPrice;
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
      <a href="?adicionar=<?php echo $product?>" class="add-to-cart">Adicionar ao carrinho</a>
    </div>
  <?php
    };
    echo '</div>';
  ?>

  <?php
    if(isset($_GET['adicionar'])){
      //vamos adicionar ao carrinho.
      $idProduct = (int) $_GET['adicionar'];

      if(isset($_SESSION['products'][$idProduct])){
        if(isset($_SESSION['cart'][$idProduct])){
        $_SESSION['cart'][$idProduct]['quantity']++;
      }else{
        $_SESSION['cart'][$idProduct] = array('quantity'=>1, 'name'=>$_SESSION['products'][$idProduct]['name'],'price'=>$_SESSION['products'][$idProduct]['price']);
      }
        echo '<script>alert("o item foi adicionado ao carrinho.");</script>';
      }else{
        die('Voce não pode adicionar um item que não existe.');
      }
    }
  ?>

  <a href="http://localhost/cezinha/newProduct">Adicionar um novo produto para vender</a>

  <?php
    foreach ($_SESSION['cart'] as $key => $value) {
      echo '<div class="carrinho-item">';
      echo '<p>Nome: '.$value['name'].' | quantidade: '.$value['quantity'].' | Preço: '.($value['quantity']*$value['price']).'</p>';
      echo '</div>';
    }
  ?>
</body>
</html>