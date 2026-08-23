<?php
namespace Prime\Cleaner;

use Bitrix\Main;

class CSVParser
{
    private object $csv;

    public function __construct(string $path)
    {
        $this->csv = new \CCSVData('R', true);
        $this->csv->SetDelimiter(',');
        $this->csv->LoadFile($path);
    }

    public function getImagesPath(): array
    {
        $paths = [];

        while ($arRes = $this->csv->Fetch()) {
            $paths[] = $arRes[0];
        }

        return $paths;
    }

    public function analyze(): array
    {
        $analysis = [
            'total' => 0,
        ];

        $imagePaths = $this->getImagesPath();

        foreach ($imagePaths as $path) {
            $exe = URLParser::getExtension($path);
            $analysis[strtolower($exe)] += 1;
        }

        $analysis['total'] = count($imagePaths);

        return $analysis;
    }
}
