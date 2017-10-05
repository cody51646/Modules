<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9424e76118cc13af02d129d09555e172
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9424e76118cc13af02d129d09555e172::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9424e76118cc13af02d129d09555e172::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}