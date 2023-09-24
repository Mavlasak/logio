<?php declare(strict_types=1);

namespace App\Model\Cache;

use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

final class CacheService
{
    public function __construct(
        private readonly TagAwareCacheInterface $cachePool,
        private readonly string $prefix,
    ){}

    public function set(object $dataJson): void
    {
        $cacheItem = $this->cachePool->getItem($this->prefix . json_encode($dataJson->id));
        $cacheItem->tag($this->prefix);
        $cacheItem->set($dataJson);
        $this->cachePool->save($cacheItem);
    }

    public function getByKey(string $key): ?object
    {
        return $this->cachePool->get($this->prefix . $key, function (ItemInterface $item): void {});
    }
}
