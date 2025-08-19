<?php
namespace App\Models;
use App\Models\CRUD;

class Timbre extends CRUD
{
    protected $table = 'timbre';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'date_creation', 'certifie', 'tirage', 'dimension', "membreId", "couleursId", "paysId", "conditionId"];
}