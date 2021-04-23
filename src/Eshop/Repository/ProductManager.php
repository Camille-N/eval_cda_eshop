<?php

namespace Eshop\Repository;

use Eshop\Model\Product;
use Eshop\Model\User;

class ProductManager
{
    private ?\PDO $db;

    public function __construct()
    {
        $this->db = (new DBA())->getPDO();
    }


    public function addProduct(Product $product, User $user)
    {
        $ADD_PRODUCT = $this->db->prepare('
            INSERT INTO product 
            SET title=:title, price=:price, user_id=:userId');

        $ADD_PRODUCT->bindValue(':title', $product->getTitle());
        $ADD_PRODUCT->bindValue(':price', $product->getPrice());
        $ADD_PRODUCT->bindValue(':userId', $user->getId());

        $ADD_PRODUCT->execute();
    }

    public function getProducts(): array
    {
        $sth =  $this->db->prepare(
            'SELECT * FROM product'
        );

        $sth->execute();
        return $sth->fetchAll();
    }

    public function updateProduct(Product $product, $product_id, $user_id)
    {
        $product_id = (int) $product_id;
        $user_id = (int) $user_id;
        $UP_PRODUCT = $this->db->prepare('
        UPDATE product 
        SET title=:title, price=:price, user_id=:userId WHERE id=:id');
        $UP_PRODUCT->bindValue(':title', $product->getTitle());
        $UP_PRODUCT->bindValue(':price', $product->getPrice());
        $UP_PRODUCT->bindValue(':userId', $user_id);
        $UP_PRODUCT->bindValue(':id', $product_id);
        $UP_PRODUCT->execute();
    }

    public function getProduct($product_id)
    {
        $product_id = (int) $product_id;
        $PRODUCT = $this->db->prepare('SELECT * FROM product WHERE id=:id');
        $PRODUCT->bindValue(':id', $product_id);
        $PRODUCT->execute();
        return $PRODUCT->fetch(\PDO::FETCH_ASSOC);
    }

    public function deleteProduct($product_id)
    {
        $product_id = (int) $product_id;
        $DEL_PRODUCT = $this->db->prepare('DELETE FROM product WHERE id=:id');
        $DEL_PRODUCT->bindValue(':id', $product_id);
        $DEL_PRODUCT->execute();
    }
}
