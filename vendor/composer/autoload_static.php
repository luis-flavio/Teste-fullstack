<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit634d4641681b038f90276d9e8f8e04f8
{
    public static $files = array (
        'a7475afdfca93a6a33dbfb0eb259f61b' => __DIR__ . '/../..' . '/App/Config.php',
        '6eb17e1656ea92b6cca9adcb4dad5a77' => __DIR__ . '/../..' . '/App/Function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CoffeeCode\\Router\\' => 18,
            'CoffeeCode\\DataLayer\\' => 21,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
        'CoffeeCode\\DataLayer\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/datalayer/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit634d4641681b038f90276d9e8f8e04f8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit634d4641681b038f90276d9e8f8e04f8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit634d4641681b038f90276d9e8f8e04f8::$classMap;

        }, null, ClassLoader::class);
    }
}
