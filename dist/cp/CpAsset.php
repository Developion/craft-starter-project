<?php
declare(strict_types=1);

namespace ContentReactor\web\assets\cp;

use ContentReactor\web\assets\font\FontAsset;
use craft\web\AssetBundle;

/**
 * @property string[] $depends
 * @property string[]|array<string>[] $js
 * @property string[]|array<string>[] $css
 */
class CpAsset extends AssetBundle
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
		'js/cp.js'
	];

	/**
	 * @var array<int, string>|array<int, array<string, string>> $css
	 */
	public $css = [
		'css/cp.css'
	];
}
