<?php
declare(strict_types=1);

namespace ContentReactor\web\twig;

use ContentReactor\Plugin;

class Variable
{
	public function registerAsset(string $bundleClass, string $assetPath, array $options = []): void
	{
		Plugin::getInstance()->getBundles()->registerAssetFile($bundleClass, $assetPath, $options);
	}
}
