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

class ComplaintType extends Enum
{
    const UNDELIVERED = 'Undelivered';
    const INCORRECT = 'Incorrect';

}