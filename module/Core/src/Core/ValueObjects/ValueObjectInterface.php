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

namespace Core\ValueObjects;

interface ValueObjectInterface
{
    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @return ValueObjectInterface
     */
    public static function fromNative() : ValueObjectInterface;

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object) : bool;

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString() : string;
}