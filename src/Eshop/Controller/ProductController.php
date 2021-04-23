<?php

namespace Eshop\Controller;

use Eshop\Repository\ProductManager;
use Eshop\Repository\DBA;
use Simplex\Templating;
use Simplex\Service\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{
    /**
     * @var ProductManager
     */
    private ProductManager $productManager;

    public function __construct()
    {
        $this->productManager = new ProductManager((new DBA())->getPDO());
    }

    /**
     * @return Response
     */
    public function showProductsList(): Response
    {
        $products = $this->productManager->getProducts();
        $templating = new Templating();
        return new Response(
            $templating->render('Eshop::productsList.php', ['products' => $products]),
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }

    public function showProductItem($id): Response
    {
        $product = $this->productManager->getProduct($id);
        return new Response(json_encode($product));
    }

    public function delete(Request $request): Response
    {
        $id = $request->query->get('product-id');
        $productToDelete = $this->productManager->getProduct($id);

        if (($request->getMethod() === Request::METHOD_POST) && isset($_SESSION['security'])) {
            $productId = $productToDelete['id'];
            $productUserId = (int) $productToDelete['user_id'];
            $connectedUser = $_SESSION['security']['user']->getId();

            if ($productUserId === $connectedUser) {
                (new ProductManager())->deleteProduct($productId);
                header('Location: /');
                exit;
            } else {
                dump('Vous ne pouvez pas supprimer ce produit');
            }
        }

        $templating = new Templating();
        return new Response(
            $templating->render('Eshop::deleteProduct.php', ['productToDelete' => $productToDelete]),
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }

    public function update(Request $request): Response
    {
        $id = $request->query->get('product-id');
        $productToUpdate = $this->productManager->getProduct($id);

        if (($request->getMethod() === Request::METHOD_POST) && isset($_SESSION['security'])) {
            $product = Form::handleSubmit($request);
            $productId = $productToUpdate['id'];
            $productUserId = (int) $productToUpdate['user_id'];
            $connectedUser = $_SESSION['security']['user']->getId();

            if ($productUserId === $connectedUser) {
                (new ProductManager())->updateProduct($product, $productId, $productUserId);
                header('Location: /');
                exit;
            } else {
                dump('Vous ne pouvez pas modifier ce produit');
            }
        }

        $templating = new Templating();
        return new Response(
            $templating->render('Eshop::updateProduct.php', ['productToUpdate' => $productToUpdate]),
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }

    public function add(Request $request): Response
    {
        if ($request->getMethod() === Request::METHOD_POST) {
            $product = Form::handleSubmit($request);

            if (isset($_SESSION['security'])) {
                $connectedUser = $_SESSION['security']['user'];
                (new ProductManager())->addProduct($product, $connectedUser);
                header('Location: /');
                exit;
            } else {
                dump('Vous devez être connecté pour ajouter un produit');
            }
        }

        $templating = new Templating();
        return new Response(
            $templating->render('Eshop::createProduct.php', []),
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }
}
