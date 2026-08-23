<?php
namespace Prime\Cleaner;

class General
{
    public function cleanUnusedFiles(array $request): void
    {
        $dataFile = PathParser::getAbsolutePath($request["DATA_FILE"]);

        if (!is_file($dataFile) || empty($request["DATA_FILE"])) {
            $this->msg('ERROR', "Файл не найден: " . $dataFile);
            Helper::redirectToModule();
        }

        $cleaner = new Cleaner($this->getCurImages(), new CSVParser($dataFile));

        $this->msg('OK', 'Удалено файлов: ' . $cleaner->execute());

        Helper::redirectToModule();
    }

    public function updateFileInfo(array $request): void
    {
        if (is_dir(PathParser::getAbsolutePath($request["DATA_DIR"]))) {
            \COption::setOptionString(MODULE_ID, DATA_DIR_NAME, $request["DATA_DIR"]);
        } else {
            $this->msg('ERROR', "Папки не существует: " . $request["DATA_DIR"]);
        }

        Helper::redirectToModule();
    }

    public function show(): array
    {
        $curImages = $this->getCurImages();

        return [
            'dir' => PathParser::getCurDirRel(),
            'quantity' => $curImages->getCount(),
            'size' => $curImages->getSize() . ' KB',
        ];
    }

    public function analyzeCSVFile(array $request): void
    {
        $csv = new CSVParser(PathParser::getAbsolutePath($request["DATA_FILE"]));
        $data = $csv->analyze();

        $msg = "";

        foreach ($data as $key => $value) {
            $msg .= $key . ": " . $value . "\n";
        }

        $this->msg('OK', nl2br($msg));

        Helper::redirectToModule();
    }

    private function msg(string $type, string $message): void
    {
        $_SESSION[SESSION_MESSAGE_KEY] = [
            'TYPE' => $type,
            'MESSAGE' => $message,
        ];
    }

    private function getCurImages(): ImageFinder
    {
        $dir = PathParser::getCurDir();

        return new ImageFinder($dir);
    }
}