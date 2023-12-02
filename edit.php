<?php

require_once './database.php';

$database = getDatabase();

$productId = empty($_GET['id']) ? null : $_GET['id'];

if (empty($productId)) {
    header('Location: ./index.php');
}

$product = null;

if ($productId) {
    $statement = $database->prepare('SELECT * FROM products WHERE id = :productId');
    $statement->bindValue(':productId', $productId);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);
}

$isEdit = empty($productId) ? false : true;

if ($_POST) {

    if (!$isEdit) {
        $statement = $database->prepare("INSERT INTO products VALUES (null, :name, :price, :description)");
        $statement->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
        $statement->bindValue(":description", $_POST['description'], PDO::PARAM_STR);
        $statement->bindValue(":price", $_POST['price']);
        $statement->execute();
    } else {
        $statement = $database->prepare("UPDATE products SET name = :name, description = :description, price = :price WHERE id = :productId");
        $statement->bindValue(":productId", $productId);
        $statement->bindValue(":name", $_POST['name'], PDO::PARAM_STR);
        $statement->bindValue(":description", $_POST['description'], PDO::PARAM_STR);
        $statement->bindValue(":price", $_POST['price']);
        $statement->execute();
    }

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
        <h1><?= $isEdit ? 'Mise à jour d\'un produit' : 'Nouveau produit' ?></h1>

        <a class="btn btn-warning" href="./index.php">Retour</a>

        <form method="POST" action="./edit.php<?= $isEdit ? '?id=' . htmlspecialchars($productId) : '' ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input name="name" id="name" type="text" class="form-control" value="<?= $isEdit ? htmlspecialchars($product['name']) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description"><?= $isEdit ? htmlspecialchars($product['description']) : '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input name="price" id="price" type="number" class="form-control" value="<?= $isEdit ? htmlspecialchars($product['price']) : '' ?>">
            </div>

            <button type="submit" class="btn btn-primary">
                <?= $isEdit ? 'Mettre à jour' : 'Ajouter' ?>
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>