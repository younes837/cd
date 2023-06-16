<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Propriete;
use App\Models\Brand;
use DB;
use Auth;
use IlluminateSupportFacadesURL;


class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
           
        ];
        $labels = Categorie::orderBy('name','asc')->pluck('name')->all();

        $data = Categorie::leftJoin('produit', 'categorie.id', '=', 'produit.categorie_id')
            ->select('categorie.name', DB::raw('COUNT(produit.id) as count'))
            ->groupBy('categorie.name')
            ->orderBy('categorie.name','asc')
            ->get()
            ->pluck('count')
            ->all();
        $products=Produit::orderBy('price','asc')->paginate(10);
        $categories=Categorie::all();
        $proprietes=Propriete::all();
        $brands=Brand::all();
        return view('content/ecommerce/produit/index',[
            'pageConfigs' => $pageConfigs,
            'products'=>$products,
            'categories'=>$categories,
            'proprietes'=>$proprietes,
            'brands'=>$brands,
            'labels'=>$labels,
            'data'=>$data,
        ]);
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
        $request->validate([
            'libelle' => 'required',
            'photo' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'rating' => 'required',
            'price' => 'required',
            'categorie' => 'required',
            'propriete' => 'required',
            'brand' => 'required',
        ]);

        $file = $request->file('photo');
        $name = $request->file('photo')->getClientOriginalName();
        $file->move(public_path('/images/pages/eCommerce/'), $name);
        if ($request->promo=="") {
        
            $data = [
                'libelle' => $request->libelle,
                'photo' => "/images/pages/eCommerce/".$name,
                'description' => $request->description,
                'stock' => $request->stock,
                'rating' => $request->rating,
                'price' => $request->price,
                'categorie_id' => $request->categorie,
                'brand_id' => $request->brand,
                'propriete_id' => $request->propriete,
                'promo'=>null
            ];
        }else{
            $data = [
                'libelle' => $request->libelle,
                'photo' => "/images/pages/eCommerce/".$name,
                'description' => $request->description,
                'stock' => $request->stock,
                'rating' => $request->rating,
                'price' => $request->price,
                'categorie_id' => $request->categorie,
                'brand_id' => $request->brand,
                'propriete_id' => $request->propriete,
                'promo'=>$request->promo
            ];
        }
       $produit= Produit::create($data);
        $products = json_decode(file_get_contents(public_path('/data/search.json')), true);
        $products['listItems'][]=["id"=>$produit->id,"name"=>$produit->libelle,"url"=> "app/ecommerce/details/".$produit->id,"photo"=>$produit->photo];
        
        file_put_contents(public_path('/data/search.json'), json_encode($products));
        return redirect('product')->with('succes',"Product added Succefully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
           
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            
        ];
        $produit=Produit::find($id);
        $categories=Categorie::all();
        $proprietes=Propriete::all();
        $brands=Brand::all();
        return view('content/ecommerce/produit/edit',[
            'pageConfigs' => $pageConfigs,
            'produit'=>$produit,
            'categories'=>$categories,
            'proprietes'=>$proprietes,
            'brands'=>$brands,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'libelle' => 'required',
    //         'description' => 'required',
    //         'stock' => 'required',
    //         'rating' => 'required',
    //         'price' => 'required',
    //         'categorie' => 'required',
    //         'propriete' => 'required',
    //         'brand' => 'required',
    //     ]);
    //     $products = json_decode(file_get_contents(public_path('/data/search.json')), true);
    //     foreach ($products['listItems'] as  $item) {
    //         if (isset($item['id']) && $item['id'] == $id) {
    //             // return $item['name'];
    //             $item['name'] = 'Updated Name';
    //             // return $products; 
    //             // Replace 'Updated Name' with the desired new name
    //             $newJsonString = json_encode($products);
    //             file_put_contents(public_path('/data/search.json'), $newJsonString);
    //             break;
    //         }
    //     }
    //     if($request->photo === null){
    //         $prod =Produit::find($id);
    //         $oldpicture=$prod->photo;

    //         $prod->libelle = $request->libelle;
    //         $prod->photo = $oldpicture;
    //         $prod->description = $request->description;
    //         $prod->stock = $request->stock;
    //         $prod->rating = $request->rating;
    //         $prod->price = $request->price;
    //         $prod->categorie_id = $request->categorie;
    //         $prod->propriete_id = $request->propriete;
    //         $prod->brand_id = $request->brand;
    //         $prod->save();

    //     }else{
    //     $file = $request->file('photo');
    //     $name = $request->file('photo')->getClientOriginalName();
    //     $file->move(public_path('/images/pages/eCommerce/'), $name);

    //     $prod =Produit::find($id);
    //     $prod->libelle = $request->libelle;
    //     $prod->photo = "/images/pages/eCommerce/".$name;
    //     $prod->description = $request->description;
    //     $prod->stock = $request->stock;
    //     $prod->rating = $request->rating;
    //     $prod->price = $request->price;
    //     $prod->categorie_id = $request->categorie;
    //     $prod->propriete_id = $request->propriete;
    //     $prod->brand_id = $request->brand;
    //     $prod->save();

    //     }


    //     // $data = [
    //     //     'libelle' => $request->libelle,
    //     //     'photo' => "/images/pages/eCommerce/".$name,
    //     //     'description' => $request->description,
    //     //     'stock' => $request->stock,
    //     //     'rating' => $request->rating,
    //     //     'price' => $request->price,
    //     //     'categorie_id' => $request->categorie,
    //     //     'brand_id' => $request->brand,
    //     //     'propriete_id' => $request->propriete,
    //     // ];
    //     // Produit::update($data);

    //     return redirect('product')->with('update',"Product updated Succefully");
    // }
    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'rating' => 'required',
            'price' => 'required',
            'categorie' => 'required',
            'propriete' => 'required',
            'brand' => 'required',
        ]);
    
        $jsonFile = public_path('/data/search.json');
        $jsonData = file_get_contents($jsonFile);
        $products = json_decode($jsonData, true);
    
        // Update the product in the database
        if($request->photo === null){
            $prod =Produit::find($id);
            $oldpicture=$prod->photo;
            if ($request->promo=="") {
                $prod->promo=null;
            }else {
                $prod->promo=$request->promo;
            }

            $prod->libelle = $request->libelle;
            $prod->photo = $oldpicture;
            $prod->description = $request->description;
            $prod->stock = $request->stock;
            $prod->rating = $request->rating;
            $prod->price = $request->price;
            $prod->categorie_id = $request->categorie;
            $prod->propriete_id = $request->propriete;
            $prod->brand_id = $request->brand;
            $prod->save();
            foreach ($products['listItems'] as &$item) {
                if (isset($item['id']) && $item['id'] == $id) {
                    $item['name'] = $request->libelle;
                    break;
                }
            }

        }else{
            $file = $request->file('photo');
            $name = $request->file('photo')->getClientOriginalName();
            $file->move(public_path('/images/pages/eCommerce/'), $name);

            $prod =Produit::find($id);
            if ($request->promo=="") {
                $prod->promo=null;
            }else {
                $prod->promo=$request->promo;
            }
            $prod->libelle = $request->libelle;
            $prod->photo = "/images/pages/eCommerce/".$name;
            $prod->description = $request->description;
            $prod->stock = $request->stock;
            $prod->rating = $request->rating;
            $prod->price = $request->price;
            $prod->categorie_id = $request->categorie;
            $prod->propriete_id = $request->propriete;
            $prod->brand_id = $request->brand;
            $prod->save();
            foreach ($products['listItems'] as &$item) {
                if (isset($item['id']) && $item['id'] == $id) {
                    $item['name'] = $request->libelle;
                    $item['photo'] = "/images/pages/eCommerce/".$name;
                    break;
                }
            }

        }
        //json
      
    
    
        // Save the updated JSON data back to the file
        $newJsonString = json_encode($products);
        file_put_contents($jsonFile, $newJsonString);
        return redirect('product')->with('update', "Product updated successfully");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produit::destroy($id);
        $jsonFile = public_path('/data/search.json');
        $jsonData = file_get_contents($jsonFile);
        $products = json_decode($jsonData, true);
        foreach ($products['listItems'] as $index => $item) {
            if (isset($item['id']) && $item['id'] == $id) {
                unset($products['listItems'][$index]);
                break;
            }
        }
        $newJsonString = json_encode($products);
        file_put_contents($jsonFile, $newJsonString);
        return redirect('product')->with('delete',"Product deleted Succefully");


    }
    public function filter_categorie(Request $request){

        if($request->ajax()){
          
            $search=$request->search;
            $categorie=$request->categorie;
            if ($search!="") {
                
                if ($request->categorie=="all") {
                    $products=Produit::join('categorie','categorie.id','produit.categorie_id')
                    ->join('brand','brand.id','produit.brand_id')
                    ->where(function ($q) use ($search){
                        $q
                        ->where('produit.libelle', 'like', '%' . $search . '%')
                        ->OrWhere('brand.name', 'like', '%' . $search . '%')
                        ->OrWhere('categorie.name', 'like', '%' . $search . '%')
                        ->OrWhere('produit.price', 'like', '%' . $search . '%');
                    })
                    ->select('produit.id','produit.libelle','produit.price','produit.photo','produit.rating','produit.stock','produit.categorie_id','produit.brand_id')
                    ->orderBy('price','asc')
                    ->paginate(10);
                }else{
            
                $products=Produit::join('categorie','categorie.id','produit.categorie_id')
                ->join('brand','brand.id','produit.brand_id')
                ->where(function ($q) use ($categorie){
                    $q
                    ->where('produit.categorie_id',  $categorie ); 
                })
                ->where(function ($q) use ($search){
                    $q
                    ->where('produit.libelle', 'like', '%' . $search . '%')
                    ->OrWhere('brand.name', 'like', '%' . $search . '%')
                    ->OrWhere('categorie.name', 'like', '%' . $search . '%')
                    ->OrWhere('produit.price', 'like', '%' . $search . '%');
                })
                ->select('produit.id','produit.libelle','produit.price','produit.photo','produit.rating','produit.stock','produit.categorie_id','produit.brand_id')
                ->orderBy('price','asc')
                                ->paginate(10);
            }
        }else {
            if ($request->categorie=="all") {
                $products=Produit::join('categorie','categorie.id','produit.categorie_id')
                ->join('brand','brand.id','produit.brand_id')
                ->select('produit.id','produit.libelle','produit.price','produit.photo','produit.rating','produit.stock','produit.categorie_id','produit.brand_id')
                ->orderBy('price','asc')
                ->paginate(10);
            }else{
        
            $products=Produit::join('categorie','categorie.id','produit.categorie_id')
            ->join('brand','brand.id','produit.brand_id')
            ->where(function ($q) use ($categorie){
                $q
                ->where('produit.categorie_id',  $categorie ); 
            })                
            ->select('produit.id','produit.libelle','produit.price','produit.photo','produit.rating','produit.stock','produit.categorie_id','produit.brand_id')
            ->orderBy('price','asc')
            ->paginate(10);
        }
        }
            return view('content/ecommerce/produit/index-content',compact('products'));
        }


    }
}
