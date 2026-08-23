<?php
namespace Prime\Cleaner;

class Helper
{
    public static function redirectToModule(): void
    {
        global $APPLICATION;

        \LocalRedirect(
            $APPLICATION->GetCurPage() .
            '?mid=' . urlencode(MODULE_ID) .
            '&lang=' . urlencode(LANGUAGE_ID)
        );
    }
}
