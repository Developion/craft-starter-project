<?php

namespace ContentReactor;

use ContentReactor\services\Bundles;
use ContentReactor\traits\Services;
use ContentReactor\web\assets\cp\CpAsset;
use ContentReactor\web\twig\Variable;
use Craft;
use yii\base\Event;
use craft\base\Plugin as BasePlugin;
use craft\web\twig\variables\CraftVariable;
use craft\web\View;
use ContentReactor\web\twig\Extension;
use Squirrel\TwigPhpSyntax\PhpSyntaxExtension;

/**
 * ContentReactor
 *
 * @method static Plugin getInstance()
 * @author Content Reactor
 * @copyright Content Reactor
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
                'bundles' => Bundles::class
            ],
        ];
    }

    public function init(): void
    {
        Craft::setAlias('@ContentReactor', __DIR__);

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
				$variable->set('cr', Variable::class);
			}
		);
    }
}
