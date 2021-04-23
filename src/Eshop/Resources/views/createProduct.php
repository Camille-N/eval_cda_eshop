<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body class="">

    <div class="container">
        <div class="row">
            <div>
                <form action="/new-product" method="post">
                    <h2>Add your product</h2>
                    <div class="mb-3">
                        <label for="productTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="productTitle" name="Eshop[Product][title]" placeholder="Your product">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="productPrice" name="Eshop[Product][price]" placeholder="Your price">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>