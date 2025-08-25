<?php
namespace App\Models;
use App\Models\CRUD;

class Mise extends CRUD
{
    protected $table = 'mise';
    protected $primaryKey = 'id';
    protected $fillable = ['membreId', 'enchereId', 'montant', 'date_mise'];
}