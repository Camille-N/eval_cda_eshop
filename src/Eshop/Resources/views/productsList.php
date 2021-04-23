<div class="container">
    <h1>Products</h1>
    <?php
    $products = $data['products'];
    foreach ($products as $product) {
        $title = $product['title'];
        $price = $product['price'];
        $id = $product['id'];
        echo "                  
            <div class=\"card-deck\">
                <div class=\"card\">
                    <div class=\"card-body\">
                        <h3 class=\"card-title\">Product title : $title</h5>
                        <p class=\"card-text\">Price : $price euros</p>
                        <a href=\"delete-product?product-id=$id\">Delete</a>
                        <a href=\"update-product?product-id=$id\">Update</a>
                    </div>
                </div>
            </div>
        ";
    }
    ?>
</div>