<?php

namespace ContentReactor\web\twig;

use ContentReactor\web\assets\font\FontAsset;
use ContentReactor\web\assets\front\FrontAsset;
use Craft;
use craft\base\ElementInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigTest;

/**
 * Twig extension
 */
class Extension extends AbstractExtension implements GlobalsInterface
{
	public function getGlobals(): array
	{
		return [
			'frontAsset' => FrontAsset::class,
			'fontAsset' => FontAsset::class,
			'macros' => 'macros',
		];
	}

	public function getFilters()
	{
		// Define custom Twig filters
		// (see https://twig.symfony.com/doc/3.x/advanced.html#filters)
		return [
			new TwigFilter('passwordify', function ($string) {
				return strtr($string, [
					'a' => '@',
					'e' => '3',
					'i' => '1',
					'o' => '0',
					's' => '5',
				]);
			}),
			// ...
		];
	}

	public function getFunctions()
	{
		// Define custom Twig functions
		// (see https://twig.symfony.com/doc/3.x/advanced.html#functions)
		return [
			new TwigFunction('password', function ($length = 12) {
				$chars = '@bcd3fgh1jklmn0pqr5tuvwxyz';
				$password = '';
				for ($i = 0; $i < $length; $i++) {
					$password .= $chars[rand(0, 25)];
				}
				return $password;
			}),

			new TwigFunction('eagerLoad', function (ElementInterface $element, array $eagerLoadingMap = []): void {
				Craft::$app->getElements()->eagerLoadElements($element::class, [$element], $eagerLoadingMap);
			}),

			new TwigFunction('editComponent', function (ElementInterface $node): string {
				return Craft::$app->getView()->renderTemplate('components/util/componentEdit.twig', compact('node'));
			}, ['is_safe' => ['html']]),

			new TwigFunction('editElement', function (ElementInterface $element): string {
				return Craft::$app->getView()->renderTemplate('components/util/elementEdit.twig', compact('element'));
			}, ['is_safe' => ['html']]),
		];
	}

	public function getTests()
	{
		// Define custom Twig tests
		// (see https://twig.symfony.com/doc/3.x/advanced.html#tests)
		return [
			new TwigTest('passwordy', function ($string) {
				$insecureChars = ['a', 'e', 'i', 'o', 's'];
				foreach ($insecureChars as $char) {
					if (str_contains($string, $char)) {
						return false;
					}
				}
				return true;
			}),
			// ...
		];
	}
}
