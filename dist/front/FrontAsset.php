<?php
declare(strict_types=1);

namespace Developion\SitePlugin\web\assets\front;

use Developion\SitePlugin\web\assets\font\FontAsset;
use craft\web\AssetBundle;

/**
 * @property string[] $depends
 * @property string[]|array<string>[] $js
 * @property string[]|array<string>[] $css
 */
class FrontAsset extends AssetBundle
{
	public $sourcePath = __DIR__ . '/public';

	/**
	 * @var array<int, class-string<AssetBundle>> $depends
	 */
	public $depends = [
		FontAsset::class,
	];

	/**
	 * @var array<int, string>|array<int, array<string, string>> $js
	 */
	public $js = [
		'js/app.js',
	];

	/**
	 * @var array<int, string>|array<int, array<string, string>> $css
	 */
	public $css = [
		'css/main.css',
		'css/header.css',
		'css/footer.css'
	];
}
