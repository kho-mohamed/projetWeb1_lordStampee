<?php
namespace App\Models;
use App\Models\CRUD;

class Favoris extends CRUD
{
    protected $table = 'favoris';
    protected $primaryKey = null;
    protected $fillable = ['membre_id', 'enchere_id'];
}