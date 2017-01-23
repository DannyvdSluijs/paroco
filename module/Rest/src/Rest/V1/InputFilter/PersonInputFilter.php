<?php
/**
 * Simulation
 *
 * PHP Version 5.5
 *
 * @link      https://github.com/DannyvdSluijs/Simulation/
 * @copyright Copyright (c) 2016-2017
 * @license
 */

namespace Rest\V1\InputFilter;

use Zend\InputFilter\InputFilter;

class PersonInputFilter extends InputFilter
{
    /**
     * This function is automatically called when creating element with factory. It
     * allows to perform various operations (add elements...)
     *
     * @return void
     */
    public function init()
    {
        $this->add([
            'name' => 'givenName',
            'required' => true,
        ]);
        $this->add([
            'name' => 'familyName',
            'required' => true,
        ]);
        $this->add([
            'name' => 'dateOfBirth',
            'required' => true,
        ]);
    }

}