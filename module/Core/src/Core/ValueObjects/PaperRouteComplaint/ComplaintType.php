<?php

namespace Core\ValueObjects\PaperRouteComplaint;

use Core\ValueObjects\Enum\Enum;

class ComplaintType extends Enum
{
    const UNDELIVERED = 'Undelivered';
    const INCORRECT = 'Incorrect';

}