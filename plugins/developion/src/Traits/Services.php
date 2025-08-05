<?php
declare(strict_types=1);

namespace Developion\SitePlugin\Traits;

use Developion\SitePlugin\Services\Bundles;

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
