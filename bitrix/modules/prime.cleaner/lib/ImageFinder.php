<?php
namespace Prime\Cleaner;

Class ImageFinder
{
    private $iterator;
    private array $images = [];
    private int $size = 0;

    public function __construct(string $absolutePath)
    {
        $this->init($absolutePath);
    }

    public function getPathname(): array
    {
        $imagesPath = [];

        foreach ($this->images as $image) {
            $imagesPath[] = $image->getPathname();
        }

        return $imagesPath;
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function getCount(): int
    {
        return count($this->images);
    }

    private function init(string $absolutePath): void
    {
        $this->iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($absolutePath));

        foreach ($this->iterator as $file) {
            if ($this->isImg($file)) {
                $this->images[] = $file;
                $this->size += $this->btk($file->getSize());
            }
        }
    }

    private function isImg(\SplFileInfo $file): bool
    {
        return $file->isFile() && preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $file->getFilename());
    }

    private function btk(int $byte): float
    {
        return round($byte / 1024, 2);
    }
}