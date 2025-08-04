<?php

declare(strict_types=1);

namespace Developion\web\assets\font;

use craft\web\AssetBundle;

/**
 * @property string[] $depends
 * @property string[]|array<string>[] $js
 * @property string[]|array<string>[] $css
 */
class FontAsset extends AssetBundle
{
	public $sourcePath = __DIR__ . '/public';

	/**
	 * @var array<int, class-string<AssetBundle>> $depends
	 */
	public $depends = [];

	/**
	 * @var array<int, string>|array<int, array<string, string>> $js
	 */
	public $js = [];

	/**
	 * @var array<int, string>|array<int, array<string, string>> $css
	 */
	public $css = [
		[
			'css/fonts.css',
			'as' => 'style',
			'rel' => 'stylesheet preload',
		],
	];
}
