<?php

function gorexpert_sanitize_legal_html($html)
{
	$html = preg_replace('/<p class="legal-page__note">.*?<\/p>\s*/s', '', $html);
	$html = preg_replace('/<ul class="legal-page__legend">.*?<\/ul>\s*/s', '', $html);

	while (preg_match('/<span class="project-var(?:-block)?"[^>]*>(.*?)<\/span>/s', $html))
	{
		$html = preg_replace('/<span class="project-var(?:-block)?"[^>]*>(.*?)<\/span>/s', '$1', $html);
	}

	$html = preg_replace('/<li class="project-var-block"[^>]*>/', '<li>', $html);
	$html = preg_replace('/\.legal-page__note[^}]*\}/', '', $html);
	$html = preg_replace('/\.legal-page__legend[^}]*\}/', '', $html);
	$html = preg_replace('/\.legal-page__legend li[^}]*\}/', '', $html);
	$html = preg_replace('/\.project-var[^}]*\}/', '', $html);
	$html = preg_replace('/\.project-var-block[^}]*\}/', '', $html);
	$html = preg_replace('/body\s*\{[^}]*\}/', '', $html);

	return $html;
}

function gorexpert_render_legal_page($htmlFile, $pageTitle, $metaTitle = null)
{
	global $APPLICATION;

	$metaTitle = $metaTitle ?: $pageTitle;
	$APPLICATION->SetPageProperty('title', $metaTitle);
	$APPLICATION->SetTitle($pageTitle);

	$path = $_SERVER['DOCUMENT_ROOT'] . '/legal-html/' . ltrim($htmlFile, '/');
	if (!is_readable($path)) {
		echo '<p>Документ не найден.</p>';
		return;
	}

	$html = gorexpert_sanitize_legal_html(file_get_contents($path));

	if (preg_match('/<style>(.*?)<\/style>/s', $html, $styleMatch)) {
		echo '<style>' . $styleMatch[1] . '</style>';
	}

	if (preg_match('/<article class="legal-page">(.*)<\/article>/s', $html, $articleMatch)) {
		echo '<article class="legal-page">' . $articleMatch[1] . '</article>';
		return;
	}

	echo '<p>Не удалось загрузить документ.</p>';
}
