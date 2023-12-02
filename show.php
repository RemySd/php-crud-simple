<?php

require_once './database.php';

$database = getDatabase();

$productId = empty($_GET['id']) ? null : $_GET['id'];
$product = null;

if ($productId) {
    $statement = $database->prepare('SELECT * FROM products WHERE id = :productId');
    $statement->bindValue(':productId', $productId);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);
}

if (empty($productId)) {
    header('Location: ./index.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Détails du produit</h1>

        <a class="btn btn-warning" href="./index.php">Retour</a>

        <div class="row">
            <div class="col-12">
                <p>Nom: <?= $product['name'] ?></p>
                <p>Prix: <?= $product['price'] ?> €</p>
                <p>Description: <?= $product['description'] ?></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>