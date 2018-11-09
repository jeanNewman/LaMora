<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Articulo;
use App\Seccion;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        //  $articulo = new Articulo;
      //  $articulo->setConnection('sqlsrv');
       // $queryArticulos = DB::table('articulos')->first();   
       $filtro = $request->filtro; 
       if($filtro == ''){
           $query1 = 'like';
           $query2 = '%%';

       }else{
        $query1 = '=';
        $query2 = $filtro;
       };

        $categorias =DB::connection('sqlsrv')
        ->table('articulos as a')
        ->join('articuloslin as b','a.codarticulo','=', 'b.codarticulo')
        ->where('a.dpto','=',1)
        ->where('a.descatalogado','=','F')
        ->where('a.seccion', $query1, $query2)
        ->where('a.eskit','=','T')
        ->select('a.codarticulo as codigo','a.descripcion as descripcion','b.ultimocoste as costo')
        //->get()
        ->paginate(10);
        $secciones = DB::connection('sqlsrv')
        ->table('secciones')
        ->where('numdpto','=',1)
        ->select('numseccion as codSeccion','descripcion as descSeccion')
        ->get();
      
         return [
            
          'pagination'=>[
            'total'         => $categorias->total(),
            'current_page'  => $categorias->currentPage(),
            'per_page'      => $categorias->perPage(),
            'last_page'     => $categorias->lastPage(),
            'from'          => $categorias->firstItem(),
            'to'            => $categorias->lastItem(),
          ],
          'categorias' => $categorias, 
          'secciones' => $secciones
        ]; 
        
        //->paginate(10);
        
       // select('select a.CODARTICULO as codigo,a.DESCRIPCION as descripcion, ROUND(b.ultimocoste,2,0) as costo from articulos as a inner join articuloslin as b on a.codarticulo = b.codarticulo   where dpto = ? ',[1],'and a.descatalogado = ? ',['F'])->paginate(10);
                                                        //where a.dpto = ? and a.DESCATALOGADO = ? and  a.ESKIT = ?',[1],['F'],['T']); // = Categoria::all();
       // dd($categorias);
       
    }

    public function listaFiltroRecetas(Request $request){
        $filtro = $request->filtro;
        $recetas = DB::connection('sqlsrv')
        ->table('articulos as a')
        ->join('articuloslin as b','a.codarticulo','=', 'b.codarticulo')
        ->where('a.dpto','=',1)
       // ->where('a.seccion', '=', $filtro)
        ->where('a.descatalogado','=','F')
        ->where('a.eskit','=','T')
        ->select('a.codarticulo as codigo','a.descripcion as descripcion','b.ultimocoste as costo')
        ->get();
       
        return ['recetas' => $recetas];
    }
   
    public function listarCards(Request $request){
        
        $kit = $request->kit;
        $cards = DB::connection('sqlsrv')
        ->table('kits')
        ->where('codarticulo','=',$kit)
        ->select('lineakit as linea','codartkit as codigo_kit','descripciokit as descripcion_kit')
        ->paginate(10);
        
         
        return [
            
            'pagination'=>[
              'total'         => $cards->total(),
              'current_page'  => $cards->currentPage(),
              'per_page'      => $cards->perPage(),
              'last_page'     => $cards->lastPage(),
              'from'          => $cards->firstItem(),
              'to'            => $cards->lastItem(),
            ],
            'tarjetas' => $cards, 
            
          ]; 
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
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = 1;
        $categoria->save();
         
    }

   

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $categoria = Categoria::findOrfail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = 1;
        $categoria->save();
    }

    public function desactivar(Request $request)
    {
        //
        $categoria = Categoria::findOrfail($request->id);
        $categoria->condicion = 0;
        $categoria->save();
    }

    public function activar(Request $request)
    {
        //
        $categoria = Categoria::findOrfail($request->id);
        $categoria->condicion = 1;
        $categoria->save();
    }

}
