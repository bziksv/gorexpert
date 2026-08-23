<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}

/** @var CBitrixComponentTemplate $this */
/** @var array $arResult */
/** @var CMain $APPLICATION */

if (method_exists($this, 'setFrameMode')) {
	$this->setFrameMode(true);
}

$this->addExternalCss($this->GetFolder().'/style.css');

$cookieName = htmlspecialcharsbx($arResult['COOKIE_NAME']);
$textVer = (int)$arResult['TEXTVER'];
$padding = (int)$arResult['PADDINGSIZE'];
$opacity = htmlspecialcharsbx((string)$arResult['OPACITY']);
$zIndex = (int)$arResult['ZINDEX'];
$topOffset = (int)$arResult['TOP'];
$styleId = (int)$arResult['SETSTYLE'];
$position = htmlspecialcharsbx($arResult['POSITION']);
$animation = htmlspecialcharsbx($arResult['ANIMATION']);
$btnText = htmlspecialcharsbx($arResult['TEXTBTN']);
// MAINTEXT already sanitized in helper — safe subset of HTML
$mainText = $arResult['MAINTEXT'];

$classes = array(
	'nca-cookiesaccept-line',
	'style-'.$styleId,
	'nca-position-'.$position,
	'nca-animation-'.$animation,
);
if ($arResult['HIDE_MOBILE'] === 'Y') {
	$classes[] = 'nca-hidden-mobile';
}
if ($arResult['HIDE_PC'] === 'Y') {
	$classes[] = 'nca-hidden-pc';
}
if ($arResult['TOPORBOTTOM'] === '1') {
	$classes[] = 'nca-place-top';
} else {
	$classes[] = 'nca-place-bottom';
}

$styleVars = sprintf(
	'--nca-padding:%dpx;--nca-opacity:%s;--nca-zindex:%d;--nca-top:%d%%;',
	$padding,
	$opacity,
	$zIndex,
	$topOffset
);
?>
<div
	id="nca-cookiesaccept-line"
	class="<?=htmlspecialcharsbx(implode(' ', $classes))?>"
	style="<?=htmlspecialcharsbx($styleVars)?>"
	data-cookie-name="<?=$cookieName?>"
	data-textver="<?=$textVer?>"
	hidden
	role="dialog"
	aria-live="polite"
>
	<div class="nca-bar" id="nca-bar">
		<div class="nca-cookiesaccept-line-text"><?=$mainText?></div>
		<div class="nca-cookiesaccept-line-actions">
			<button type="button" id="nca-cookiesaccept-line-accept-btn" class="nca-accept-btn">
				<?=$btnText?>
			</button>
		</div>
	</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    (function () {
        if (window !== window.top) {
            return;
        }

        var root = document.getElementById('nca-cookiesaccept-line');
        if (!root) {
            return;
        }

        var cookieName = root.getAttribute('data-cookie-name') || '';
        if (!cookieName) {
            return;
        }

        function readCookie(name) {
            var parts = ('; ' + document.cookie).split('; ' + name + '=');
            if (parts.length === 2) {
                return parts.pop().split(';').shift();
            }
            return '';
        }

        function writeAcceptCookie(name) {
            var maxAge = 60 * 60 * 24 * 400; // ~400 days (browser caps)
            var parts = [
                name + '=Y',
                'path=/',
                'max-age=' + maxAge,
                'SameSite=Lax'
            ];
            if (window.location.protocol === 'https:') {
                parts.push('Secure');
            }
            document.cookie = parts.join('; ');
        }

        function hideBanner() {
            if (root && root.parentNode) {
                root.parentNode.removeChild(root);
            }
        }

        if (readCookie(cookieName) === 'Y') {
            hideBanner();
            return;
        }

        root.hidden = false;

        var btn = document.getElementById('nca-cookiesaccept-line-accept-btn');
        if (btn) {
            btn.addEventListener('click', function () {
                writeAcceptCookie(cookieName);
                hideBanner();
            });
        }
    })();
});
</script>