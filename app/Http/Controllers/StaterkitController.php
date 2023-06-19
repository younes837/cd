<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\ligneCommande;
use App\Models\Commande;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\UserProduit;
use DB;
use Auth;
class StaterkitController extends Controller
{
    // home
    public function home()
    {
        // $breadcrumbs = [
        //     ['link' => 'home', 'name' => 'Home'],
        //     ['name' => 'Index'],
        // ];
        $pageConfigs = [
   
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];
        $produits=Produit::latest()->take(4)->get();
        $produits2=Produit::where('rating',5)->get();
       
        $bestSellingProduct = Produit::select('produit.*')
            ->join('produit_commande', 'produit_commande.produit_id', '=', 'produit.id')
            ->join('commande', 'produit_commande.commande_id', '=', 'commande.id')
            ->where('commande.etat_id',2)
            ->groupBy('produit.id', 'produit.libelle','produit.photo','produit.promo','produit.stock','produit.price','produit.rating','produit.categorie_id','produit.brand_id','produit.propriete_id','produit.description','produit.created_at','produit.updated_at')
            ->orderByRaw('SUM(produit_commande.quantite) DESC')
            ->take(10)
            ->get();

        if (Auth::check()) {
           
            $user = Auth::user();
            $wishlist = $user->produits;
            return view('/content/home', [
                // 'breadcrumbs' => $breadcrumbs,
                "produits"=>$produits,
                "produits2"=>$produits2,
                "wishlist"=>$wishlist,
                "bestSellingProduct"=>$bestSellingProduct,
                'pageConfigs' => $pageConfigs,
            ]);
        }else {
            
            return view('/content/home', [
                // 'breadcrumbs' => $breadcrumbs,
                "produits"=>$produits,
                "produits2"=>$produits2,
                "bestSellingProduct"=>$bestSellingProduct,
             
                'pageConfigs' => $pageConfigs,
            ]);
        }
    }

    public function search(Request $request)
    {
        // if ($request->ajax()) {
            
            if (Auth::check()) {
                $user = Auth::user();
                $wishlist = $user->produits;
            }
            $query = $request->get('query');
            $price = $request->get('price');
            $sort = $request->get('sort');
            $brand = $request->get('brand');
            $promo = $request->get('promo');
            $brandChamp='brand_id';
            if ($sort == 'asc') {
                $sortedby = 'created_at';
            } elseif ($sort == 'desc') {
                $sortedby = 'created_at';
            } else {
                $sortedby = 'id';
                $sort = 'asc';
            }
            $categorie = $request->get('categorie');
            if ($categorie == 'all') {
                $categorie = null;
                $cat = null;
            } else {
                $cat = 'categorie_id';
            }
            if ($brand=="all") {
                $brand=null;
                $brandChamp=null;
            }

            if ($promo=="all") {
           
                if ($query != '') {
                    if ($price == 'all') {
                        $produits = DB::table('produit')
                            ->where($cat, $categorie)
                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->where($brandChamp,$brand)
                                    ;
                            })
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '100') {
                        $produits = DB::table('produit')
                            ->where(function ($q) use ($query, $cat, $categorie) {
                                $q

                                    ->where('price', '<=', 100)
                                    ->where($cat, $categorie);
                            })
                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->Where($brandChamp,$brand);
                            })
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '100-1000') {
                        $produits = DB::table('produit')
                            ->where(function ($q) use ($cat, $categorie) {
                                $q
                                    ->where($cat, $categorie)
                                    ->where('price', '<=', 1000)
                                    ->where('price', '>=', 100);
                            })
                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->Where($brandChamp,$brand)
                                    ;
                            })
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '1000-5000') {
                        $produits = DB::table('produit')
                            ->where(function ($q) use ($cat, $categorie) {
                                $q
                                    ->where($cat, $categorie)
                                    ->where('price', '<=', 5000)
                                    ->where('price', '>=', 1000);
                            })
                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->Where($brandChamp,$brand)
                                    ;
                            })

                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '5000') {
                        $produits = DB::table('produit')
                            ->where(function ($q) use ($query, $cat, $categorie) {
                                $q
                                    ->where('price', '>=', 5000)
                                    ->where($cat, $categorie);
                            })

                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->Where($brandChamp,$brand)
                                    ;
                            })
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    }
                    $total_row = $produits->total();
                    session()->put('length', $total_row);
                } else {
                    $produits = DB::table('produit')->paginate(9);

                    if ($price == 'all') {
                        $produits = DB::table('produit')
                            ->where($cat, $categorie)
                            ->where($brandChamp, $brand)
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '100') {
                        $produits = DB::table('produit')
                            ->where('price', '<=', 100)
                            ->where($cat, $categorie)
                            ->where($brandChamp, $brand)
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '100-1000') {
                        $produits = DB::table('produit')
                            ->where('price', '<=', 1000)
                            ->where('price', '>=', 100)
                            ->where($brandChamp, $brand)
                            ->where($cat, $categorie)
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '1000-5000') {
                        $produits = DB::table('produit')
                            ->where('price', '<=', 5000)
                            ->where('price', '>=', 1000)
                            ->where($brandChamp, $brand)
                            ->where($cat, $categorie)
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '5000') {
                        $produits = DB::table('produit')
                            ->where('price', '>=', 5000)
                            ->where($cat, $categorie)
                            ->where($brandChamp, $brand)
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    }
                    $total_row = $produits->total();
                    session()->put('length', $total_row);
                }
            }else{
                if ($query != '') {
                    if ($price == 'all') {
                        $produits = DB::table('produit')
                            ->where($cat, $categorie)
                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->where($brandChamp,$brand)
                                    ;
                            })->whereNotNull('promo')
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '100') {
                        $produits = DB::table('produit')
                            ->where(function ($q) use ($query, $cat, $categorie) {
                                $q

                                    ->where('price', '<=', 100)
                                    ->where($cat, $categorie);
                            })->whereNotNull('promo')
                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->Where($brandChamp,$brand);
                            })
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '100-1000') {
                        $produits = DB::table('produit')
                            ->where(function ($q) use ($cat, $categorie) {
                                $q
                                    ->where($cat, $categorie)
                                    ->where('price', '<=', 1000)
                                    ->where('price', '>=', 100);
                            })
                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->Where($brandChamp,$brand)
                                    ;
                            })->whereNotNull('promo')
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '1000-5000') {
                        $produits = DB::table('produit')
                            ->where(function ($q) use ($cat, $categorie) {
                                $q
                                    ->where($cat, $categorie)
                                    ->where('price', '<=', 5000)
                                    ->where('price', '>=', 1000);
                            })
                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->Where($brandChamp,$brand)
                                    ;
                            })->whereNotNull('promo')

                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '5000') {
                        $produits = DB::table('produit')
                            ->where(function ($q) use ($query, $cat, $categorie) {
                                $q
                                    ->where('price', '>=', 5000)
                                    ->where($cat, $categorie);
                            })

                            ->where(function ($q) use ($query,$brand,$brandChamp) {
                                $q
                                    ->where('libelle', 'like', '%' . $query . '%')
                                    ->Where($brandChamp,$brand)
                                    ;
                            })->whereNotNull('promo')
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    }
                    $total_row = $produits->total();
                    session()->put('length', $total_row);
                } else {
                    $produits = DB::table('produit')->paginate(9);

                    if ($price == 'all') {
                        $produits = DB::table('produit')
                            ->where($cat, $categorie)
                            ->where($brandChamp, $brand)->whereNotNull('promo')
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '100') {
                        $produits = DB::table('produit')
                            ->where('price', '<=', 100)
                            ->where($cat, $categorie)
                            ->where($brandChamp, $brand)->whereNotNull('promo')
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '100-1000') {
                        $produits = DB::table('produit')
                            ->where('price', '<=', 1000)
                            ->where('price', '>=', 100)
                            ->where($brandChamp, $brand)
                            ->where($cat, $categorie)->whereNotNull('promo')
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '1000-5000') {
                        $produits = DB::table('produit')
                            ->where('price', '<=', 5000)
                            ->where('price', '>=', 1000)
                            ->where($brandChamp, $brand)
                            ->where($cat, $categorie)->whereNotNull('promo')
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    } elseif ($price == '5000') {
                        $produits = DB::table('produit')
                            ->where('price', '>=', 5000)
                            ->where($cat, $categorie)
                            ->where($brandChamp, $brand)->whereNotNull('promo')
                            ->orderBy($sortedby, $sort)
                            ->paginate(9);
                    }
                    $total_row = $produits->total();
                    session()->put('length', $total_row);
                }
            }
            
            if (Auth::check()) {
                # code...
                return view(
                    'content.ecommerce.content-shop',
                    compact('produits', 'wishlist')
                )->render();
            }
            return view(
                'content.ecommerce.content-shop',
                compact('produits')
            )->render();
        // }
    }
    public function filter_home(Request $request){
        $pageConfigs = [
            'contentLayout' => 'content-detached-left-sidebar',
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];

        // $breadcrumbs = [
        //     ['link' => '/', 'name' => 'Home'],
        //     ['link' => 'javascript:void(0)', 'name' => 'eCommerce'],
        //     ['name' => 'Shop'],
        // ];
            if ($request->categorie) {
                # code...
            
        $produits = Produit::where('categorie_id',$request->categorie)->paginate(9);
        $categories = Categorie::all();
        $brand = Brand::all();
        $p = Produit::all();
        $pr=Produit::where('brand_id',$request->brand)->get();
        session()->put('length', count($pr));
        $categorie=$request->categorie;
        $brand_id="all";
        }elseif ($request->brand) {
            $produits = Produit::where('brand_id',$request->brand)->paginate(9);
            $categories = Categorie::all();
            $brand = Brand::all();
            $p = Produit::all();
   
            $pr=Produit::where('brand_id',$request->brand)->get();
            session()->put('length', count($pr));
            $categorie="all";
            $brand_id=$request->brand;
        }
        // session()->flush();
        if (Auth::check()) {
            # code...
            $user = Auth::user();
            $wishlist = $user->produits;
            return view('/content/ecommerce/app-ecommerce-shop', [
                'pageConfigs' => $pageConfigs,
                'wishlist' => $wishlist,
                'brand' => $brand,
                'produits' => $produits,
                'categories' => $categories,
               
                'categorie_id' => $categorie,
                'brand_id' => $brand_id,
            ]);
        } else {
            return view('/content/ecommerce/app-ecommerce-shop', [
                'pageConfigs' => $pageConfigs,

                'brand' => $brand,
                'produits' => $produits,
                'categories' => $categories,
               
                'categorie_id' => $categorie,
                'brand_id' => $brand_id,
            ]);
        }
    }
    public function ecommerce_shop()
    {
        $pageConfigs = [
            'contentLayout' => 'content-detached-left-sidebar',
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];

        // $breadcrumbs = [
        //     ['link' => '/', 'name' => 'Home'],
        //     ['link' => 'javascript:void(0)', 'name' => 'eCommerce'],
        //     ['name' => 'Shop'],
        // ];
        $produits = Produit::orderBy('price','asc')->paginate(9);
        $categories = Categorie::all();
        $brand = Brand::all();
        $p = Produit::all();
        $length = count($p);
        $brand_id="all";
        session()->put('length', $length);
        // session()->flush();
        if (Auth::check()) {
            # code...
            $user = Auth::user();
            $wishlist = $user->produits;
            return view('/content/ecommerce/app-ecommerce-shop', [
                'pageConfigs' => $pageConfigs,
                'wishlist' => $wishlist,
                'brand' => $brand,
                'produits' => $produits,
                'categories' => $categories,
                'length' => $length,
                'categorie_id' => "all",
                "brand_id"=>"all",
            ]);
        } else {
            return view('/content/ecommerce/app-ecommerce-shop', [
                'pageConfigs' => $pageConfigs,

                'brand' => $brand,
                'produits' => $produits,
                'categories' => $categories,
                'length' => $length,
                'categorie_id' => "all",
                "brand_id"=>"all",
            ]);
        }
    }
    public function whishlist(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            if ($request->details == 'non') {
                if ($request->on == 'false') {
                    UserProduit::create([
                        'user_id' => $user->id,
                        'produit_id' => $request->id,
                    ]);
                } elseif ($request->on == 'true') {
                    UserProduit::where('user_id', $user->id)
                        ->where('produit_id', $request->id)
                        ->delete();
                }
                // $produit = Produit::find($request->id);
                // $produit->favorie = !$produit->favorie;
                // $produit->save();

                $wishlist = $user->produits;

                $produits = Produit::paginate(9);
                return view(
                    'content.ecommerce.content-shop',
                    compact('produits', 'wishlist')
                )->render();
            } elseif ($request->details == 'oui') {
                $produit = Produit::find($request->id);
                if ($request->on == 'false') {
                    UserProduit::create([
                        'user_id' => $user->id,
                        'produit_id' => $request->id,
                    ]);
                } elseif ($request->on == 'true') {
                    UserProduit::where('user_id', $user->id)
                        ->where('produit_id', $request->id)
                        ->delete();
                }
                $wishlist = $user->produits;
                return view(
                    'content/ecommerce/produit-details',
                    compact('produit', 'wishlist')
                )->render();
            }elseif($request->details == 'new'){
                $produit = Produit::find($request->id);
                if ($request->on == 'false') {
                    UserProduit::create([
                        'user_id' => $user->id,
                        'produit_id' => $request->id,
                    ]);
                } elseif ($request->on == 'true') {
                    UserProduit::where('user_id', $user->id)
                        ->where('produit_id', $request->id)
                        ->delete();
                }
                $wishlist = $user->produits;
                $produits=Produit::latest()->take(4)->get();
                $produits2=Produit::all()->take(6);
                return view('content/home-new-products',compact('produits','produits2','wishlist'));
            }elseif($request->details == 'top'){
                $produit = Produit::find($request->id);
                if ($request->on == 'false') {
                    UserProduit::create([
                        'user_id' => $user->id,
                        'produit_id' => $request->id,
                    ]);
                } elseif ($request->on == 'true') {
                    UserProduit::where('user_id', $user->id)
                        ->where('produit_id', $request->id)
                        ->delete();
                }
                $wishlist = $user->produits;
                $produits=Produit::all()->take(4);
                $produits2=Produit::where('rating',5)->get();
                return view('content/home-top-products',compact('produits','produits2','wishlist'));
            }
            elseif($request->details == 'best'){
                $produit = Produit::find($request->id);
                if ($request->on == 'false') {
                    UserProduit::create([
                        'user_id' => $user->id,
                        'produit_id' => $request->id,
                    ]);
                } elseif ($request->on == 'true') {
                    UserProduit::where('user_id', $user->id)
                        ->where('produit_id', $request->id)
                        ->delete();
                }
                $wishlist = $user->produits;
                $produits=Produit::all()->take(4);
                $produits2=Produit::all()->take(6);
                $bestSellingProduct = Produit::select('produit.*')
            ->join('produit_commande', 'produit_commande.produit_id', '=', 'produit.id')
            ->join('commande', 'produit_commande.commande_id', '=', 'commande.id')
            ->where('commande.etat_id',2)
            ->groupBy('produit.id', 'produit.libelle','produit.photo','produit.promo','produit.stock','produit.price','produit.rating','produit.categorie_id','produit.brand_id','produit.propriete_id','produit.description','produit.created_at','produit.updated_at')
            ->orderByRaw('SUM(produit_commande.quantite) DESC')
            ->take(10)
            ->get();

                return view('content/home-best-sellers',compact('produits','produits2','wishlist',"bestSellingProduct"));
            }
            
            elseif ($request->details == 'remove') {
                UserProduit::where('user_id', $user->id)
                ->where('produit_id', $request->id)
                ->delete();
                $produits = DB::table('user_produit')
                ->join('users', 'user_produit.user_id', 'users.id')
                ->join('produit', 'user_produit.produit_id', 'produit.id')
                ->select(
                    'produit.id',
                    'produit.libelle',
                    'produit.photo',
                    'produit.description',
               
                    'produit.stock',
                    'produit.rating',
                    'produit.price'
                    )
                    ->where('users.id',$user->id)
                    ->paginate(12);
                return view(
                    'content/ecommerce/wishlist-content',
                    compact('produits')
                )->render();
            }
        }
    }
    public function wishlist_details(Request $request)
    {
        if ($request->ajax()) {
            $users=Auth::user();
            $produits = DB::table('user_produit')
            ->join('users', 'user_produit.user_id', 'users.id')
            ->join('produit', 'user_produit.produit_id', 'produit.id')
            ->select(
                'produit.id',
                'produit.libelle',
                'produit.photo',
                'produit.description',
               
                'produit.stock',
                'produit.rating',
                'produit.price'
                )
                ->where('users.id',$users->id)
                ->paginate(12);
            return view(
                'content/ecommerce/wishlist-content',
                compact('produits')
            )->render();
        }
    }

    // Ecommerce Details
    public function ecommerce_details($id)
    {
        // return $id;
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];
        $produit = Produit::find($id);
        $brand = Brand::find($produit->brand_id);
        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'eCommerce'],
            ['link' => '/app/ecommerce/shop', 'name' => 'Shop'],
            ['name' => 'Details'],
        ];
        $user = Auth::user();
        if (Auth::check()) {
            # code...
            $wishlist = $user->produits;
            return view('/content/ecommerce/app-ecommerce-details', [
                'pageConfigs' => $pageConfigs,
                // 'breadcrumbs' => $breadcrumbs,
                'wishlist' => $wishlist,
                'produit' => $produit,
                'brand' => $brand,
            ]);
        }else {
            return view('/content/ecommerce/app-ecommerce-details', [
                'pageConfigs' => $pageConfigs,
                // 'breadcrumbs' => $breadcrumbs,
                'brand' => $brand,
                'produit' => $produit,
            ]);
        }

    }



    // Ecommerce Wish List
    public function ecommerce_wishlist()
    {
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];
        if (Auth::check()) {
            
            $user = Auth::user();
            
        $produits = DB::table('user_produit')
        ->join('users', 'user_produit.user_id', 'users.id')
            ->join('produit', 'user_produit.produit_id', 'produit.id')
            ->select(
                'produit.id',
                'produit.libelle',
                'produit.photo',
                'produit.description',
                
                'produit.promo',
                'produit.stock',
                'produit.rating',
                'produit.price'
                ) ->where('users.id',$user->id)
                ->paginate(12);
                return view('/content/ecommerce/app-ecommerce-wishlist', [
            'pageConfigs' => $pageConfigs,
            'produits' => $produits,
            // 'breadcrumbs' => $breadcrumbs,
        ]);
    }else {
        return view('/content/ecommerce/app-ecommerce-wishlist', [
            'pageConfigs' => $pageConfigs,
            'produits' => [],
            // 'breadcrumbs' => $breadcrumbs,
        ]);
        
        }
    }

    // Ecommerce Checkout
    public function ecommerce_checkout()
    {
        $pageConfigs = [
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];
        $user=Auth::user();

  

        return view('/content/ecommerce/app-ecommerce-checkout', [
            'pageConfigs' => $pageConfigs,
            "user"=>$user

        ]);
    }

    // Layout collapsed menu
    public function collapsed_menu()
    {
        $pageConfigs = ['sidebarCollapsed' => true];
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Layouts'],
            ['name' => 'Collapsed menu'],
        ];
        return view('/content/layout-collapsed-menu', [
            'breadcrumbs' => $breadcrumbs,
            'pageConfigs' => $pageConfigs,
        ]);
    }

    // layout boxed
    public function layout_full()
    {
        $pageConfigs = ['layoutWidth' => 'full'];

        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['name' => 'Layouts'],
            ['name' => 'Layout Full'],
        ];
        return view('/content/layout-full', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    // without menu
    public function without_menu()
    {
        $pageConfigs = ['showMenu' => false];
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Layouts'],
            ['name' => 'Layout without menu'],
        ];
        return view('/content/layout-without-menu', [
            'breadcrumbs' => $breadcrumbs,
            'pageConfigs' => $pageConfigs,
        ]);
    }

    // Empty Layout
    public function layout_empty()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Layouts'],
            ['name' => 'Layout Empty'],
        ];
        return view('/content/layout-empty', ['breadcrumbs' => $breadcrumbs]);
    }
    // Blank Layout
    public function layout_blank()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/layout-blank', ['pageConfigs' => $pageConfigs]);
    }


    public function addToCart($id)
    {
        $product = Produit::findOrFail($id);
        if ($product) {
            $brand=Brand::find($product->brand_id);
        }
 
        $cart = session()->get('cart', []);
        if ($product->promo) {
            $price=$product->price-$product->price*($product->promo/100);
        }else{
            $price=$product->price;
        }
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            
            $cart[$id] = [
                "product_name" => $product->libelle,
                "id" => $product->id,
                "photo" => $product->photo,
                "rating" => $product->rating,
                "brand" => $brand->name,
                "price" => $price,
                "quantity" => 1
            ];
        }

 
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }
    
    public function update(Request $request)
    {
        if($request->id){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        
            return view('content/ecommerce/content-checkout');
        }
    }
    public function contact()
    {
        $pageConfigs = [
   
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];
        return view('/content/contact', [        
            'pageConfigs' => $pageConfigs,
        ]);
    }
    public function create_commande(Request $request)
    {
        $total = 0;
        // return "hhhhh";
        foreach(session('cart') as $id => $details){
        $total += $details['price'] * $details['quantity'];
        }
        
        $data=Commande::create([
            'date'=>now()->format('Y-m-d'),
            'total'=>$total,
            'etat_id'=>1,
            "user_id"=>Auth::user()->id,
            "ville"=>$request->ville,
            "adress"=>$request->address,
        ]);
        foreach(session('cart') as $id => $details){
            ligneCommande::create([
                'produit_id'=>$details['id'],
                'commande_id'=>$data->id,
                'quantite'=>$details['quantity'],

            ]) ;       
        }
        session()->forget('cart');
         return redirect()->back();
        
        
        

    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
            return view('content/ecommerce/content-checkout');
        }
    }
    public function Aboutus()
    {
        $pageConfigs = [
   
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];
        return view('/content/about-us',['pageConfigs'=>$pageConfigs]);
    }
    public function swap($locale){
        // available language in template array
       $availLocale=['en'=>'en', 'fr'=>'fr','de'=>'de','pt'=>'pt'];
       // check for existing language
       if(array_key_exists($locale,$availLocale)){
           session()->put('locale',$locale);
       }
        return redirect()->back();
   }
}
