<?php

namespace App\Controllers;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Config\Config;

abstract class GeneralController 
{
    private static ?Environment $_twig = null;

    public function __construct()
    {
        $this->twig = self::getTwig();
        $this->baseUrl = Config::getBaseUrl();
        unset($_SESSION['flash']);
    }

    private static function getTwig()
    {
        if (is_null(self::$_twig)) {
            $loader = new FilesystemLoader('src/Views');
            self::$_twig = new Environment($loader, [
                'cache' => false,
                'debug' => true
            ]);
            self::$_twig->addGlobal("baseUrl", Config::getBaseUrl());
            self::$_twig->addGlobal("session", $_SESSION);
            self::$_twig->addExtension(new DebugExtension());
        }
        return self::$_twig;
    }
}