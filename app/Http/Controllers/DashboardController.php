<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Categorie;
use DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Categorie::orderBy('name','asc')->pluck('name')->all();

        $data = Categorie::leftJoin('produit', 'categorie.id', '=', 'produit.categorie_id')
            ->select('categorie.name', DB::raw('COUNT(produit.id) as count'))
            ->groupBy('categorie.name')
            ->orderBy('categorie.name','asc')
            ->get()
            ->pluck('count')
            ->all();
        $sales = Commande::join('produit_commande', 'commande.id', '=', 'produit_commande.commande_id')
            ->join('produit', 'produit_commande.produit_id', '=', 'produit.id')
            ->select(
                DB::raw('SUM(produit_commande.quantite * produit.price) as sales'),
                DB::raw("DATE_FORMAT(commande.created_at, '%b') as month")
            )
            ->where('commande.etat_id',2)
            ->groupBy('month')
            ->orderBy('commande.created_at')
            ->pluck('sales')
            ->all();
        $productSum = Commande::join('produit_commande', 'commande.id', '=', 'produit_commande.commande_id')
            ->join('produit', 'produit_commande.produit_id', '=', 'produit.id')
            ->select(
                DB::raw('SUM(produit_commande.quantite) as quantity_sold'),
                DB::raw("DATE_FORMAT(commande.created_at, '%b') as month")
            )->where('commande.etat_id',2)
            ->groupBy('month')
            ->orderBy('commande.created_at')
            ->get();
        $commande = DB::table('commande')
            ->select(DB::raw('COUNT(*) as command_count'), DB::raw("DATE_FORMAT(created_at, '%b') as month"))
            ->groupBy('month')
            ->orderBy('created_at')
            ->get();
        $commande_count=collect($commande)->pluck('command_count')->all();
    
        $quantite = collect($productSum)->pluck('quantity_sold')->all();
    
        $months = DB::table('commande')
            ->join('produit_commande', 'commande.id', '=', 'produit_commande.commande_id')
            ->join('produit', 'produit_commande.produit_id', '=', 'produit.id')
            ->select(DB::raw("DATE_FORMAT(commande.created_at, '%b') as month"))
            ->distinct()
            ->orderBy('commande.created_at')
            ->pluck('month')
            ->all();
    // return $sales;
        return view('/content/ecommerce/dashboard/dashboard',compact('sales','months',"quantite", 'commande_count','labels','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
