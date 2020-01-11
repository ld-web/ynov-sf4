<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="product_list")
     */
    public function index(ProductRepository $productRepository)
    {
      $products = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/product/{id}", name="product_item")
     */
    public function item(Product $product)
    {
      return $this->render('product/item.html.twig', [
        'product' => $product
      ]);
    }
}
