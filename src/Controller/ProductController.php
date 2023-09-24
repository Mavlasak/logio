<?php declare(strict_types=1);

namespace App\Controller;

use App\Model\Product\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductService $productService,
    ) {
    }

    #[Route(path: '/produkt/{id}', name: 'app_product_detail')]
    public function detailAction(string $id): Response
    {
        $productJson = $this->productService->getProductJson($id);

        return $this->json($productJson);
    }
}
