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

namespace Core\ValueObjects\PaperRouteComplaint;

use Core\ValueObjects\Enum\Enum;

class Severity extends Enum
{
    const INCIDENTAL = 'Incidental';
    const SEVERE = 'Severe';

}