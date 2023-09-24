<?php declare(strict_types=1);

namespace App\Model\Product;

use App\Entity\Product;
use App\Model\Cache\CacheService;
use App\Model\QueriesCount\QueriesCountService;
use App\Utils\SerializerFactory;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

final class ProductService
{
    private const PRODUCT = 'product';

    private readonly CacheService $productCache;

    public function __construct(
        private readonly TagAwareCacheInterface $cachePool,
        private readonly ProductRepository $productRepository,
        private readonly SerializerFactory $serializerFactory,
        private readonly QueriesCountService $queriesCountService,
    ) {
        $this->productCache = new CacheService($this->cachePool, self::PRODUCT);
    }

    public function getProductJson(string $productId): object
    {
        $productJson = $this->productCache->getByKey($productId);
        if ($productJson === null) {
            $product = $this->productRepository->find($productId);
            $productJson = $this->serializeProduct($product);
            $this->productCache->set($productJson);
            $this->queriesCountService->upQueriesCount($product->getId(), self::PRODUCT);

            return $productJson;
        }
        $this->queriesCountService->upQueriesCount($productJson->id, self::PRODUCT);

        return $productJson;
    }

    private function serializeProduct(Product $product): object
    {
        $serializer = $this->serializerFactory->create();

        return json_decode($serializer->serialize($product, 'json'));
    }
}
