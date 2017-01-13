<?php

namespace Core\ValueObjects\PaperRouteComplaint;

use Core\ValueObjects\Enum\Enum;

class Severity extends Enum
{
    const INCIDENTAL = 'Incidental';
    const SEVERE = 'Severe';

}