<?php

namespace App\Models;
use App\Models\Commande;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ligneCommande extends Model
{
    use HasFactory;
    protected $table = 'produit_commande';
    protected $fillable = [
        'id',
        'produit_id',
        'commande_id',
        'quantite',
        
    ];
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
