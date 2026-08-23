<?php

Class prime_cleaner extends CModule
{
    var $MODULE_ID = "prime.cleaner";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;

    function __construct()
    {
        $arModuleVersion = null;

        include __DIR__ . '/version.php';

        if (isset($arModuleVersion) && is_array($arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = "Сleaner";
        $this->MODULE_DESCRIPTION = "Clean unused image files from the server";

        $this->PARTNER_NAME = "LTD PRIME";
        $this->PARTNER_URI = "https://prime-ltd.su/";
    }

    function DoInstall()
    {
        global $APPLICATION;
        if (!IsModuleInstalled($this->MODULE_ID))
        {
            RegisterModule($this->MODULE_ID);
        }
    }

    function DoUninstall()
    {
        UnRegisterModule($this->MODULE_ID);
    }
}