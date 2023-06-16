<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ligneCommande;
class Produit extends Model
{
    use HasFactory;
    protected $table = 'produit';
    protected $fillable = [
        'libelle',
        'description',
        'photo',
        'stock',
        'price',
        'rating',
        'promo',
        'categorie_id','brand_id','propriete_id'
    ];
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_produit',
            'produit_id',
            'user_id',
            'id',
            'id'
        );
    }
    public function ligneCommandes()
    {
        return $this->hasMany(ligneCommande::class);
    }
}
