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