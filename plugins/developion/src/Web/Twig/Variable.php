<?php
declare(strict_types=1);

namespace Developion\SitePlugin\Web\Twig;

use Developion\SitePlugin\Plugin;

class Variable
{
	public function registerAsset(string $bundleClass, string $assetPath, array $options = []): void
	{
		Plugin::getInstance()->getBundles()->registerAssetFile($bundleClass, $assetPath, $options);
	}
}
