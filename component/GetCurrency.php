<?php

namespace component;


use yii\base\Widget;
use yii\web\ServerErrorHttpException;

class GetCurrency extends Widget
{

    public $url;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return self::getData($this->url);
    }

    public static function getData($date, $currency = 'USD')
    {
        $domain = "www.cbu.uz";
        if (self::isConnection($domain)) {
            $url = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/{$currency}/{$date}";
            return json_decode(file_get_contents($url));
        } else {
            throw new ServerErrorHttpException("{$domain} bilan aloqa yo'q!", 500);
        }
    }

    public static function getCurrentCurrencyValue()
    {
        $domain = "www.cbu.uz";
        if (self::isConnection($domain)) {
            $date = date('Y-m-d');
            $rubl = json_decode(file_get_contents("https://cbu.uz/uz/arkhiv-kursov-valyut/json/RUB/{$date}"));
            $usd = json_decode(file_get_contents("https://cbu.uz/uz/arkhiv-kursov-valyut/json/USD/{$date}"));
            $eur = json_decode(file_get_contents("https://cbu.uz/uz/arkhiv-kursov-valyut/json/EUR/{$date}"));

            if (isset($_SESSION['currency'])) {
                return true;
            } else {
                $_SESSION['currency'] = [
                    'rubl' => $rubl[0]->Rate,
                    'usd' => $usd[0]->Rate,
                    'eur' => $eur[0]->Rate,
                    'time' => time()
                ];
            }
        } else {
            throw new ServerErrorHttpException("{$domain} bilan aloqa yo'q!", 500);
        }
    }

    public static function isConnection($domain)
    {
        $f = @fsockopen($domain, 80, $erc, $errm, 5);

        if (!$f) {
            throw new ServerErrorHttpException("{$domain} bilan aloqa yo'q!", 500);
        } else {
            return true;
        }
    }
}
