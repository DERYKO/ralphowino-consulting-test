<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite60fe4787a4c2366261769326b0eb0e9
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hootlex\\Friendships\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hootlex\\Friendships\\' => 
        array (
            0 => __DIR__ . '/..' . '/hootlex/laravel-friendships/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite60fe4787a4c2366261769326b0eb0e9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite60fe4787a4c2366261769326b0eb0e9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
