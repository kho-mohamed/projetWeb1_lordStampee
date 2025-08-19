<?php
namespace App\Models;
use App\Models\CRUD;

class Image extends CRUD
{
    protected $table = 'image';
    protected $primaryKey = 'id';
    protected $fillable = ['lien', 'principale', 'timbreId'];

    public function upload($file)
    {
        $tmpName = $file['tmp_name'];
        $uniqueName = uniqid(rand(), true);
        $destination = './public/upload/' . $uniqueName . '.webp';
        $lien = 'upload/' . $uniqueName . '.webp';
        $result = move_uploaded_file($tmpName, $destination);
        if ($result) {
            return $lien;
        } else {
            return false;
        }
    }
}