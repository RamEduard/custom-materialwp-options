<?php

/**
 * Composer Autoloader
 */
class ClassAutoloader 
{

    private static $loader;

    public static function loadClassLoader($class) 
    {
        if ('Autoloader\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ClassAutoloader', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Autoloader\Autoload\ClassLoader();
        spl_autoload_unregister(array('ClassAutoloader', 'loadClassLoader'));

        $loader->register(true);
        
        return $loader;
    }

}

function autoloaderRequire($file)
{
    require $file;
}
