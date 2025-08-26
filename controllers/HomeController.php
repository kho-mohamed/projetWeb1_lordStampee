<?php
namespace App\Controllers;
use App\Models\Timbre;
use App\Models\Image;
use App\Models\Pays;
use App\Models\Enchere;
use App\Providers\View;


class HomeController
{

    public function index()
    {
        $timbre = new Timbre;
        $listTimbres = $timbre->select();
        $image = new Image;
        $listImages = $image->select();
        $pays = new Pays;
        $listPays = $pays->select();
        $enchere = new Enchere;
        $listEncheres = $enchere->select();

        // Nettoie chaque timbre pour ne garder que les clés associatives
        $listTimbresAssoc = array_map(function ($timbre) {
            return array_filter($timbre, function ($key) {
                return !is_int($key);
            }, ARRAY_FILTER_USE_KEY);
        }, $listTimbres);

        // Select 4 random stamps
        $keys = array_keys($listTimbresAssoc);
        shuffle($keys);
        $randomKeys = array_slice($keys, 0, 4);

        $selectionTimbreRandom = [];
        foreach ($randomKeys as $key) {
            $selectionTimbreRandom[$key] = $listTimbresAssoc[$key];
        }
        var_dump(['timbres' => $selectionTimbreRandom], ['timbres selection' => $listTimbresAssoc], ['images' => $listImages], ['pays' => $listPays], ['encheres' => $listEncheres]);
        return View::render('index', ['timbres' => $selectionTimbreRandom, 'images' => $listImages, 'pays' => $listPays, 'encheres' => $listEncheres]);
    }
}