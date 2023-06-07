<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd45ec48668701e4e9717fb2b7fa633cd
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'ElxDigital\\Vista\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ElxDigital\\Vista\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd45ec48668701e4e9717fb2b7fa633cd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd45ec48668701e4e9717fb2b7fa633cd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd45ec48668701e4e9717fb2b7fa633cd::$classMap;

        }, null, ClassLoader::class);
    }
}
