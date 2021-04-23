<?php
$product = $data['productToUpdate'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body class="">

    <div class="container">
        <h2>Update your product</h2>
        <div class="row col-6">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?= $product['title'] ?> </h3>
                        <p class="card-text"><?= $product['price'] ?> euros</p>
                    </div>
                </div>
            </div>
        </div>
        <form action="/update-product?product-id=<?= $product['id'] ?>" method="post">
            <div class="row col-6">
                <div class="card-deck">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="productTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="productTitle" name="Eshop[Product][title]" placeholder="<?= $product['title'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Price</label>
                                <input type="text" class="form-control" id="productPrice" name="Eshop[Product][price]" placeholder="<?= $product['price'] ?>">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>