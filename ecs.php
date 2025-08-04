<?php
declare(strict_types=1);

use Developion\CodingStandards\SetList;

$config = require SetList::ECS;

return $config->withPaths([
		__DIR__ . '/plugins/module',
		__FILE__,
	])
;
