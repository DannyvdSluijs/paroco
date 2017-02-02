<?php
/**
 * PaRoCo
 *
 * PHP Version 7
 *
 * @link      https://github.com/DannyvdSluijs/paroco
 * @copyright Copyright (c) 2016 Danny van der Sluijs
 * @license   MIT License
 */

namespace Core;

use Core\Controller;

return [
    'invokables' => [
        Controller\IndexController::class => Controller\IndexController::class,
    ]
];