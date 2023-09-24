<?php declare(strict_types=1);

namespace App\Model\QueriesCount;

use Symfony\Component\Filesystem\Filesystem;

final class QueriesCountService
{
    private readonly string $queriesUploadPath;

    public function __construct(
        private readonly Filesystem $filesystem,
        string $uploadPath,
    ) {
        $this->queriesUploadPath = $uploadPath . '/queries';
    }

    public function upQueriesCount(int $id, string $type): void
    {
        $filePath = $this->queriesUploadPath . '/' . $type;
        $fileExist = $this->filesystem->exists($filePath);
        $queries = [];
        if ($fileExist) {
            $queries = json_decode(file_get_contents($filePath), true);
        }
        if (!isset($queries[$id])) {
            $queries[$id] = [
                'id' => $id,
                'count' => 0,
            ];
        }
        $queries[$id]['count']++;
        $this->filesystem->dumpFile($filePath, json_encode($queries));
    }
}
