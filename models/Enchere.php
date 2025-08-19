<?php
namespace App\Models;
use App\Models\CRUD;

class Enchere extends CRUD
{
    protected $table = 'enchere';
    protected $primaryKey = 'id';
    protected $fillable = ['date_debut', 'date_fin', 'prix_plancher', 'coup_coeur_lord', "timbreId"];
}