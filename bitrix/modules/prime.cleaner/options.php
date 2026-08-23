<?php
use Bitrix\Main;
use Prime\Cleaner\General;

global $APPLICATION;

$module_id = 'prime.cleaner';

if (!Main\Loader::includeModule($module_id)) {
    throw new Main\SystemException("Module prime.cleaner is not installed");
}

$controller = new General();

$data = [];

$tabs = [
    [
        "DIV" => "edit1",
        "TAB" => "Настройки",
        "TITLE" => "Настройка параметров модуля",
    ],
];

$tabControl = new CAdminTabControl("tabControl", $tabs);

if (\check_bitrix_sessid()) {
    if ($_REQUEST["RUN"] <> '') {
        $controller->cleanUnusedFiles($_REQUEST);
    } elseif ($_REQUEST["UPDATE"] <> '') {
        $controller->updateFileInfo($_REQUEST);
    } elseif ($_REQUEST["DATA_FILE_ANALYZE"] <> '') {
        $controller->analyzeCSVFile($_REQUEST);
    }
}

if (!empty($_SESSION[SESSION_MESSAGE_KEY])) {
    $msg = new \CAdminMessage($_SESSION[SESSION_MESSAGE_KEY]);
    echo $msg->Show();
    unset($_SESSION[SESSION_MESSAGE_KEY]);
}

$tabControl->Begin();

$data = $controller->show();
?>
<form method="post" action="<?php echo $APPLICATION->GetCurPage() ?>?mid=<?=urlencode($mid)?>" ENCTYPE="multipart/form-data" name="dataload" id="dataload">

    <?php
        echo bitrix_sessid_post();
        $tabControl->BeginNextTab();
    ?>

    <tr class="heading">
        <td colspan="2">Файлы</td>
    </tr>

    <tr>
        <td width="40%">
            <span id="hint_dir"></span>
            Папка:
            <script>
                BX.hint_replace(BX('hint_dir'), 'Укажите путь к папке с изображениями, которые необходимо проверить на наличие неиспользуемых файлов. Путь должен быть указан относительно корня сайта. Например: /upload/');
            </script>
        </td>
        <td width="60%">
            <input type="text" name="DATA_DIR" value="<?php echo $data['dir']?>" size="30">
            <input type="button" value="Открыть" OnClick="DirPath()">
            <?php
            CAdminFileDialog::ShowScript([
                    'event' => 'DirPath',
                    'arResultDest' => [
                            'FORM_NAME' => 'dataload',
                            'FORM_ELEMENT_NAME' => 'DATA_DIR',
                    ],
                    'arPath' => [
                            'SITE' => SITE_ID,
                            'PATH' => '/' .Main\Config\Option::get('main', 'upload_dir', 'upload'),
                    ],
                    'select' => 'D', // F - file only, D - folder only
                    'operation' => 'O', // O - open, S - save
                    'showUploadTab' => false,
                    'showAddToMenuTab' => false,
                    'allowAllFiles' => true,
                    'SaveConfig' => false,
            ]);
            ?>
        </td>
    </tr>

    <tr>
        <td width="50%" class="adm-detail-content-cell-l">Количество: </td>
        <td width="50%" class="adm-detail-content-cell-r"><?php echo $data['quantity']?></td>
    </tr>

    <tr>
        <td width="50%" class="adm-detail-content-cell-l">Размер: </td>
        <td width="50%" class="adm-detail-content-cell-r"><?php echo $data['size']?></td>
    </tr>

    <tr>
        <td width="50%" class="adm-detail-content-cell-l"></td>
        <td width="50%" class="adm-detail-content-cell-r">
            <input type="submit" name="UPDATE" value="Обновить" title="Обновить">
        </td>
    </tr>

    <tr class="heading">
        <td colspan="2">Загрузка</td>
    </tr>

    <tr>
        <td width="40%">
            <span id="hint_csv_file"></span>
            Импорт CSV (лягушки):
            <script>
                BX.hint_replace(BX('hint_csv_file'), 'Файл CSV должен содержать список используемых на сайте изображений. Каждая строка файла должна содержать путь к изображению в первой колонке. Изображения, не указанные в файле, будут удалены из указанной папки.');
            </script>
        </td>
        <td width="60%">
            <input type="text" name="DATA_FILE" value="" size="30">
            <input type="button" value="Открыть" OnClick="UploadFile()">
            <?php
            CAdminFileDialog::ShowScript([
                    'event' => 'UploadFile',
                    'arResultDest' => [
                            'FORM_NAME' => 'dataload',
                            'FORM_ELEMENT_NAME' => 'DATA_FILE',
                    ],
                    'arPath' => [
                            'SITE' => SITE_ID,
                            'PATH' => '/' .Main\Config\Option::get('main', 'upload_dir', 'upload'),
                    ],
                    'select' => 'F', // F - file only, D - folder only
                    'operation' => 'O', // O - open, S - save
                    'showUploadTab' => true,
                    'showAddToMenuTab' => false,
                    'fileFilter' => 'csv',
                    'allowAllFiles' => false,
                    'SaveConfig' => false,
            ]);
            ?>
        </td>
    </tr>

    <tr>
        <td width="50%" class="adm-detail-content-cell-l"></td>
        <td width="50%" class="adm-detail-content-cell-r">
            <input type="submit" name="DATA_FILE_ANALYZE" value="Анализ CSV" title="Анализ CSV">
        </td>
    </tr>

    <?php $tabControl->Buttons(); ?>

        <input type="submit" name="RUN" value="Очистить" title="Очистить" class="adm-btn-save">

    <?php $tabControl->End(); ?>
</form>
