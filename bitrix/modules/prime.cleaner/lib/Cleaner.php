<?php
namespace Prime\Cleaner;

class Cleaner
{
    private ImageFinder $curImages;
    private CSVParser $dataFile;

    public function __construct(ImageFinder $curImages, CSVParser $dataFile)
    {
        $this->curImages = $curImages;
        $this->dataFile = $dataFile;
    }

    public function execute(): int
    {
        $usedFiles = $this->prepareDataFile();

        $count = 0;

        foreach ($this->curImages->getPathname() as $imgPath) {

            if (!array_key_exists($this->getFileName($imgPath), $usedFiles)) {
                if (\Bitrix\Main\IO\File::deleteFile($imgPath)) {
                    $count += 1;
                }
            }
        }

        return $count;
    }

    private function prepareDataFile(): array
    {
        $paths = [];

        foreach ($this->dataFile->getImagesPath() as $path) {
            $relativePath = strtolower(URLParser::getFileName($path));
            $paths[$relativePath] = true;
        }

        return $paths;
    }

    private function getFileName(string $path): string
    {
        return strtolower(basename($path));
    }
}
