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

namespace Core\ValueObjects\Enum;

use Core\ValueObjects\ValueObjectInterface;

use ReflectionClass;
use InvalidArgumentException;
use LogicException;

abstract class Enum implements ValueObjectInterface
{
    /**
     * The selected enumerator value
     *
     * @var null|bool|int|float|string
     */
    private $value;

    /**
     * The ordinal number of the enumerator
     *
     * @var null|int
     */
    private $ordinal;

    /**
     * An array of available constants by class
     *
     * @var array ["$class" => ["$name" => $value, ...], ...]
     */
    private static $constants = array();

    /**
     * Already instantiated enumerators
     *
     * @var array ["$class" => ["$name" => $instance, ...], ...]
     */
    private static $instances = array();

    /**
     * Constructor
     *
     * @param null|bool|int|float|string $value   The value of the enumerator
     * @param int|null                   $ordinal The ordinal number of the enumerator
     */
    final private function __construct($value, $ordinal = null)
    {
        $this->value   = $value;
        $this->ordinal = $ordinal;
    }

    /**
     * @throws LogicException Enums are not cloneable
     *                        because instances are implemented as singletons
     */
    final private function __clone()
    {
        throw new LogicException('Enums are not cloneable');
    }

    /**
     * @throws LogicException Enums are not serializable
     *                        because instances are implemented as singletons
     */
    final public function __sleep()
    {
        throw new LogicException('Enums are not serializable');
    }

    /**
     * @throws LogicException Enums are not serializable
     *                        because instances are implemented as singletons
     */
    final public function __wakeup()
    {
        throw new LogicException('Enums are not serializable');
    }

    /**
     * Get the value of the enumerator
     *
     * @return null|bool|int|float|string
     */
    final public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the name of the enumarator
     *
     * @return string
     */
    final public function getName()
    {
        return array_search($this->value, self::detectConstants(get_called_class()), true);
    }

    /**
     * Get the ordinal number of the enumerator
     *
     * @return int
     */
    final public function getOrdinal()
    {
        if ($this->ordinal !== null) {
            return $this->ordinal;
        }
        // detect ordinal
        $ordinal = 0;
        $value   = $this->value;
        foreach (self::detectConstants(get_called_class()) as $constValue) {
            if ($value === $constValue) {
                break;
            }
            ++$ordinal;
        }
        $this->ordinal = $ordinal;
        return $ordinal;
    }

    /**
     * Compare this enumerator against another and check if it's the same.
     *
     * @param mixed $enumerator
     * @return bool
     */
    final public function is($enumerator)
    {
        return $this === $enumerator || $this->value === $enumerator;
    }

    /**
     * Get an enumerator instance of the given value or instance
     *
     * @param static|null|bool|int|float|string $value
     * @return static
     * @throws InvalidArgumentException On an unknwon or invalid value
     * @throws LogicException           On ambiguous constant values
     */
    final public static function get($value)
    {
        if ($value instanceof static && get_class($value) === get_called_class()) {
            return $value;
        }
        $class     = get_called_class();
        $constants = self::detectConstants($class);
        $name      = array_search($value, $constants, true);
        if ($name === false) {
            $message = is_scalar($value)
                ? 'Unknown value ' . var_export($value, true)
                : 'Invalid value of type ' . (is_object($value) ? get_class($value) : gettype($value));
            throw new InvalidArgumentException($message);
        }
        if (!isset(self::$instances[$class][$name])) {
            self::$instances[$class][$name] = new $class($constants[$name]);
        }
        return self::$instances[$class][$name];
    }

    /**
     * Get an enumarator instance by the given name
     *
     * @param string $name The name of the enumerator
     * @return static
     * @throws InvalidArgumentException On an invalid or unknown name
     * @throws LogicException           On ambiguous values
     */
    final public static function getByName($name)
    {
        $name  = (string) $name;
        $class = get_called_class();
        if (isset(self::$instances[$class][$name])) {
            return self::$instances[$class][$name];
        }
        $const = $class . '::' . $name;
        if (!defined($const)) {
            throw new InvalidArgumentException($const . ' not defined');
        }
        return self::$instances[$class][$name] = new $class(constant($const));
    }

    /**
     * Get an enumeration instance by the given ordinal number
     *
     * @param int $ordinal The ordinal number or the enumerator
     * @return static
     * @throws InvalidArgumentException On an invalid ordinal number
     * @throws LogicException           On ambiguous values
     */
    final public static function getByOrdinal($ordinal)
    {
        $ordinal   = (int) $ordinal;
        $class     = get_called_class();
        $constants = self::detectConstants($class);
        $item      = array_slice($constants, $ordinal, 1, true);
        if (empty($item)) {
            throw new InvalidArgumentException(sprintf(
                'Invalid ordinal number, must between 0 and %s',
                count($constants) - 1
            ));
        }
        $name = key($item);
        if (isset(self::$instances[$class][$name])) {
            return self::$instances[$class][$name];
        }
        return self::$instances[$class][$name] = new $class(current($item), $ordinal);
    }

    /**
     * Clear all instantiated enumerators of the called class
     *
     * NOTE: This can break singleton behavior ... use it with caution!
     *
     * @return void
     */
    final public static function clear()
    {
        $class = get_called_class();
        unset(self::$instances[$class], self::$constants[$class]);
    }

    /**
     * Get a list of enumerator instances ordered by ordinal number
     *
     * @return static[]
     */
    final public static function getEnumerators()
    {
        return array_map('self::getByName', array_keys(self::detectConstants(get_called_class())));
    }

    /**
     * Get all available constants of the called class
     *
     * @return array
     * @throws LogicException On ambiguous constant values
     */
    final public static function getConstants()
    {
        return self::detectConstants(get_called_class());
    }

    /**
     * Is the given enumerator part of this enumeration
     *
     * @param static|null|bool|int|float|string $value
     * @return bool
     */
    final public static function has($value)
    {
        if ($value instanceof static && get_class($value) === get_called_class()) {
            return true;
        }
        $class     = get_called_class();
        $constants = self::detectConstants($class);
        return in_array($value, $constants, true);
    }

    /**
     * Detect all available constants by the given class
     *
     * @param string $class
     * @return array
     * @throws LogicException On ambiguous constant values
     */
    private static function detectConstants($class)
    {
        if (!isset(self::$constants[$class])) {
            $reflection = new ReflectionClass($class);
            $constants  = $reflection->getConstants();
            // values needs to be unique
            $ambiguous = array();
            foreach ($constants as $value) {
                $names = array_keys($constants, $value, true);
                if (count($names) > 1) {
                    $ambiguous[var_export($value, true)] = $names;
                }
            }
            if (!empty($ambiguous)) {
                throw new LogicException(
                    'All possible values needs to be unique. The following are ambiguous: '
                    . implode(', ', array_map(function ($names) use ($constants) {
                        return implode('/', $names) . '=' . var_export($constants[$names[0]], true);
                    }, $ambiguous))
                );
            }
            // This is required to make sure that constants of base classes will be the first
            while (($reflection = $reflection->getParentClass()) && $reflection->name !== __CLASS__) {
                $constants = $reflection->getConstants() + $constants;
            }
            self::$constants[$class] = $constants;
        }
        return self::$constants[$class];
    }

    /**
     * Get an enumerator instance by the given name.
     *
     * This will be called automatically on calling a method
     * with the same name of a defined enumerator.
     *
     * @param string $method The name of the enumeraotr (called as method)
     * @param array  $args   There should be no arguments
     * @return static
     * @throws InvalidArgumentException On an invalid or unknown name
     * @throws LogicException           On ambiguous constant values
     */
    final public static function __callStatic($method, array $args)
    {
        return self::getByName($method);
    }

    /**
     * Returns a new Enum object from passed value matching argument
     *
     * @param  string $value
     * @return static
     */
    public static function fromNative(): ValueObjectInterface
    {
        return static::get(func_get_arg(0));
    }

    /**
     * Returns the PHP native value of the enum
     *
     * @return mixed
     */
    public function toNative()
    {
        return parent::getValue();
    }

    /**
     * Tells whether two Enum objects are sameValueAs by comparing their values
     *
     * @param  Enum $enum
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $enum): bool
    {
        if (false === Util::classEquals($this, $enum)) {
            return false;
        }

        return $this->toNative() === $enum->toNative();
    }

    /**
     * Returns a native string representation of the Enum value
     *
     * @return string
     */
    public function __toString(): string
    {
        return \strval($this->toNative());
    }
}