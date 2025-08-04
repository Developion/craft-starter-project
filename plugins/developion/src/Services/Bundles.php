<?php
declare(strict_types=1);

namespace Developion\SitePlugin\Services;

use Craft;
use Exception;
use yii\base\Component;

class Bundles extends Component
{
	public function registerAssetFile(string $bundleClass, string $assetPath, array $options = []): void
	{
		preg_replace_callback('/\.(js|css)$/', static function ($matches) use ($bundleClass, $assetPath, $options): string {
			$extension = $matches[0];
			$assetManager = Craft::$app->getAssetManager();
			$url = $assetManager->getPublishedUrl(
				$assetManager->getBundle($bundleClass)->sourcePath,
				false,
				$assetPath,
			);
			match ($extension) {
				'.css' => Craft::$app->getView()->registerCssFile($url, $options),
				'.js' => Craft::$app->getView()->registerJsFile($url, $options),
				default => throw new Exception('Provided path is not a js or css file.'),
			};
			return 'Successfully Registered';
		}, $assetPath);
	}
}
