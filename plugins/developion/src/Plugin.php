<?php
declare(strict_types=1);

namespace Developion\SitePlugin;

use Craft;
use craft\base\Plugin as BasePlugin;
use craft\events\RegisterTemplateRootsEvent;
use craft\web\twig\variables\CraftVariable;
use craft\web\View;
use Developion\SitePlugin\Services\Bundles;
use Developion\SitePlugin\Traits\Services;
use Developion\SitePlugin\Web\Twig\{
	Extension,
	Variable,
};
use Developion\SitePlugin\Web\assets\cp\CpAsset;
use Squirrel\TwigPhpSyntax\PhpSyntaxExtension;
use yii\base\Event;

/**
 * SitePlugin
 *
 * @method static Plugin getInstance()
 * @author Developion
 * @copyright Developion
 * @license MIT
 */
class Plugin extends BasePlugin
{
	use Services;

	public string $schemaVersion = '1.0.0';

	public static function config(): array
	{
		return [
			'components' => [
				'bundles' => Bundles::class,
			],
		];
	}

	public function init(): void
	{
		Craft::setAlias('sitePlugin', __DIR__);

		parent::init();

		$this->attachEventHandlers();

		Craft::$app->onInit(function() {
			if (!Craft::$app->getRequest()->getIsConsoleRequest()) {
				/** @var HtmlDumper $dumper */
				$dumper = Craft::$app->getDumper();
				$dumper->setTheme('dark');
			}
		});
		Craft::$app->view->registerTwigExtension(new Extension());
		Craft::$app->view->registerTwigExtension(new PhpSyntaxExtension());
	}

	private function attachEventHandlers(): void
	{
		Event::on(
			View::class,
			View::EVENT_BEFORE_RENDER_TEMPLATE,
			static function (): void {
				if (Craft::$app->getRequest()->getIsCpRequest()) {
					Craft::$app->getView()->registerAssetBundle(CpAsset::class);
				}
			}
		);

		Event::on(
			CraftVariable::class,
			CraftVariable::EVENT_INIT,
			static function (Event $event) {
				/** @var CraftVariable $variable */
				$variable = $event->sender;
				$variable->set('sitePlugin', Variable::class);
			}
		);

		Event::on(
			View::class,
			View::EVENT_REGISTER_SITE_TEMPLATE_ROOTS,
			static function (RegisterTemplateRootsEvent $event): void {
				$event->roots['@_site-plugin'] = __DIR__ . '/Templates';
			}
		);

		Event::on(
			View::class,
			View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
			static function (RegisterTemplateRootsEvent $event): void {
				$event->roots['@_site-plugin'] = __DIR__ . '/Templates';
			}
		);
	}
}