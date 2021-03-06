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

namespace Core\ValueObjects\StringLiteral;

use Core\ValueObjects\ValueObjectInterface;

class StringLiteral implements ValueObjectInterface
{
    private $value;

    /**
     * Returns a StringLiteral object given a PHP native string as parameter.
     *
     * @param  string $value
     * @return StringLiteral
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);
        return new static($value);
    }

    /**
     * Returns a StringLiteral object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (false === \is_string($value)) {
            throw new InvalidNativeArgumentException($value, array('string'));
        }
        $this->value = $value;
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative() : string
    {
        return $this->value;
    }

    /**
     * Tells whether two string literals are equal by comparing their values
     *
     * @param  ValueObjectInterface $stringLiteral
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $stringLiteral) : bool
    {
        if (false === Util::classEquals($this, $stringLiteral)) {
            return false;
        }
        return $this->toNative() === $stringLiteral->toNative();
    }

    /**
     * Tells whether the StringLiteral is empty
     *
     * @return bool
     */
    public function isEmpty() : bool
    {
        return \strlen($this->toNative()) == 0;
    }

    /**
     * Returns the string value itself
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->toNative();
    }
}