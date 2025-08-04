<?php
declare(strict_types=1);

namespace ContentReactor\traits;

use ContentReactor\services\Bundles;

/**
 * @mixin Plugin
 */
trait Services
{
	public function getBundles(): Bundles
	{
		return $this->get('bundles');
	}
}
