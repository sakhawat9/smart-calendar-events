<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1e9c2ee83049e52bc3a689ecd32561a2
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fixolab\\SmartCalendarEvents\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fixolab\\SmartCalendarEvents\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1e9c2ee83049e52bc3a689ecd32561a2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1e9c2ee83049e52bc3a689ecd32561a2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1e9c2ee83049e52bc3a689ecd32561a2::$classMap;

        }, null, ClassLoader::class);
    }
}
