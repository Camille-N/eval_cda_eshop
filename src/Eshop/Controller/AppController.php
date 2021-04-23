<?php

namespace Eshop\Controller;

use Simplex\Templating;
use Eshop\Repository\ProductManager;
use Eshop\Repository\DBA;
use Symfony\Component\HttpFoundation\Response;

class AppController
{

    public function index()
    {
        $security = false;
        $productManager = (new ProductManager((new DBA())->getPDO()));
        $products = $productManager->getProducts();
        if (isset($_SESSION['security'])) {
            $security = $_SESSION['security'];
        }

        $templating = new Templating();
        return new Response(
            $templating->render('Eshop::home.php', ['security' => $security, 'products' => $products])
        );
    }
}
