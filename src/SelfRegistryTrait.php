<?php

namespace Maximaster\SelfRegistry;

trait SelfRegistryTrait
{
    private static $instances = [];
    private static $nameToInstance = [];

    public static function registerInstance(string $name, self $instance): void
    {
        $instanceHash = spl_object_hash($instance);
        self::$instances[$instanceHash] = $instance;
        self::$nameToInstance[$name] = $instanceHash;
    }

    /**
     * @param string|null $name
     *
     * @return $this
     *
     * @throws UnregisteredInstanceAccessException
     */
    public static function getInstance(string $name = null): self
    {
        $name = static::normalizeName($name);

        if (empty(self::$nameToInstance[$name])) {
            throw new UnregisteredInstanceAccessException(sprintf("Can't find instance by name '%s'", $name));
        }

        $instanceHash = self::$nameToInstance[$name];

        if (empty(self::$instances[$instanceHash])) {
            throw new UnregisteredInstanceAccessException(sprintf("Instance named '%s' has been missed", $name));
        }

        return self::$instances[$instanceHash];
    }

    private static function normalizeName(?string $name): string
    {
        return $name ?: static::class;
    }

    public function registerItself(string $name = null)
    {
        self::registerInstance(static::normalizeName($name), $this);
    }
}
