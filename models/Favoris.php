<?php
namespace App\Models;
use App\Models\CRUD;

class Favoris extends CRUD
{
    protected $table = 'favoris';
    protected $primaryKey = '';
    protected $fillable = ['Membre_id', 'Enchere_id'];
}