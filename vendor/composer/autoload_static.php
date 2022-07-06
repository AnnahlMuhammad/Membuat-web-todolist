<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0677e5f7fb5e4e8287adb125cc9cab5d
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0677e5f7fb5e4e8287adb125cc9cab5d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0677e5f7fb5e4e8287adb125cc9cab5d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0677e5f7fb5e4e8287adb125cc9cab5d::$classMap;

        }, null, ClassLoader::class);
    }
}
