<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubroingreso extends Model
{
    //cuando me vaya a traer todos los detalles que tiene un rubro o al revez intento no hacer esto: $article->tags
    //sino :  $articlesConTags = Article::with('tags')->get(); con esto nos traer de una vez todos los tags relacionados de cada articulo

    protected $fillable = [
        'nombre',
      ];


    public function detalles(){
     return $this->belongsToMany('App\Detalleingreso', 'ingresos', "rubroingreso_id", "detalleingreso_id" )
     ->withPivot('id', 'cantidad','dia', "mes", "año","descripcion")->withTimestamps();
               //por convencion la tabla pivot o intermedia se forma por los nombres de las dos tablas,
               //como no lo tengo asi entonces en el segundo parametro pongo el nombre de la tabla intermedia
               //en el tercer parametro pongo la foreign key que esta en la tabla intermedia perteneciente al modelo actual
               //en el cuarto parametro pongo la foreing key del otro modelo con el que quiero unir rubroingreso
    }   

   
    
    
    public function convertirNumeroLetra($numero){
      $numf = $this->milmillon($numero);
      return $numf."  pesos";
  }
  
  
  private function milmillon($nummierod){
      if ($nummierod >= 1000000000 && $nummierod <2000000000){
          $num_letrammd = "mil ".( $this->cienmillon($nummierod%1000000000));
      }
      if ($nummierod >= 2000000000 && $nummierod <10000000000){
          $num_letrammd =  $this->unidad(Floor($nummierod/1000000000))." mil ".( $this->cienmillon($nummierod%1000000000));
      }
      if ($nummierod < 1000000000)
          $num_letrammd =  $this->cienmillon($nummierod);
      
      return $num_letrammd;
  }
  
  
  public function cienmillon($numcmeros){
      if ($numcmeros == 100000000)
          $num_letracms = "cien millones";
      if ($numcmeros >= 100000000 && $numcmeros <1000000000){
          $num_letracms =  $this->centena(Floor($numcmeros/1000000))."  millones ".( $this->millon($numcmeros%1000000));       
      }
      if ($numcmeros < 100000000)
          $num_letracms =  $this->decmillon($numcmeros);
      return $num_letracms;
  }
  
  
  public function decmillon($numerodm){
      if ($numerodm == 10000000)
          $num_letradmm = "diez millones";
      if ($numerodm > 10000000 && $numerodm <20000000){
          $num_letradmm =  $this->decena(Floor($numerodm/1000000))."millones ".( $this->cienmiles($numerodm%1000000));        
      }
      if ($numerodm >= 20000000 && $numerodm <100000000){
          $num_letradmm =  $this->decena(Floor($numerodm/1000000))." millones ".( $this->millon($numerodm%1000000));      
      }
      if ($numerodm < 10000000)
          $num_letradmm =  $this->millon($numerodm);
      
      return $num_letradmm;
  }
  
  
  public function millon($nummiero){
      if ($nummiero >= 1000000 && $nummiero <2000000){
          $num_letramm = "un millon ".( $this->cienmiles($nummiero%1000000));
      }
      if ($nummiero >= 2000000 && $nummiero <10000000){
          $num_letramm =  $this->unidad(Floor($nummiero/1000000))." millones ".( $this->cienmiles($nummiero%1000000));
      }
      if ($nummiero < 1000000)
          $num_letramm =  $this->cienmiles($nummiero);
      
      return $num_letramm;
  }
  
  
  function cienmiles($numcmero){
      if ($numcmero == 100000)
          $num_letracm = "cien mil";
      if ($numcmero >= 100000 && $numcmero <1000000){
          $num_letracm =  $this->centena(Floor($numcmero/1000))." mil ".( $this->centena($numcmero%1000));        
      }
      if ($numcmero < 100000)
          $num_letracm =  $this->decmiles($numcmero);
      return $num_letracm;
  }
  
  
  
  public function decmiles($numdmero){
      if ($numdmero == 10000)
          $numde = "diez mil";
      if ($numdmero > 10000 && $numdmero <20000){
          $numde =  $this->decena(Floor($numdmero/1000))."mil ".( $this->centena($numdmero%1000));        
      }
      if ($numdmero >= 20000 && $numdmero <100000){
          $numde =  $this->decena(Floor($numdmero/1000))." mil ".( $this->miles($numdmero%1000));     
      }       
      if ($numdmero < 10000)
          $numde =  $this->miles($numdmero);
      
      return $numde;
  }
  
  
  public function miles($nummero){
      if ($nummero >= 1000 && $nummero < 2000){
          $numm = "mil ".( $this->centena($nummero%1000));
      }
      if ($nummero >= 2000 && $nummero <10000){
          $numm =  $this->unidad(Floor($nummero/1000))." mil ".( $this->centena($nummero%1000));
      }
      if ($nummero < 1000)
          $numm =  $this->centena($nummero);
      
      return $numm;
  }
  
  
  public function centena($numc){
      if ($numc >= 100)
      {
          if ($numc >= 900 && $numc <= 999)
          {
              $numce = "novecientos ";
              if ($numc > 900)
                  $numce = $numce.( $this->decena($numc - 900));
          }
          else if ($numc >= 800 && $numc <= 899)
          {
              $numce = "ochocientos ";
              if ($numc > 800)
                  $numce = $numce.( $this->decena($numc - 800));
          }
          else if ($numc >= 700 && $numc <= 799)
          {
              $numce = "setecientos ";
              if ($numc > 700)
                  $numce = $numce.( $this->decena($numc - 700));
          }
          else if ($numc >= 600 && $numc <= 699)
          {
              $numce = "seiscientos ";
              if ($numc > 600)
                  $numce = $numce.( $this->decena($numc - 600));
          }
          else if ($numc >= 500 && $numc <= 599)
          {
              $numce = "quinientos ";
              if ($numc > 500)
                  $numce = $numce.( $this->decena($numc - 500));
          }
          else if ($numc >= 400 && $numc <= 499)
          {
              $numce = "cuatrocientos ";
              if ($numc > 400)
                  $numce = $numce.( $this->decena($numc - 400));
          }
          else if ($numc >= 300 && $numc <= 399)
          {
              $numce = "trescientos ";
              if ($numc > 300)
                  $numce = $numce.( $this->decena($numc - 300));
          }
          else if ($numc >= 200 && $numc <= 299)
          {
              $numce = "doscientos ";
              if ($numc > 200)
                  $numce = $numce.( $this->decena($numc - 200));
          }
          else if ($numc >= 100 && $numc <= 199)
          {
              if ($numc == 100)
                  $numce = "cien ";
              else
                  $numce = "ciento ".( $this->decena($numc - 100));
          }
      }
      else
          $numce = $this->decena($numc);
      
      return $numce;  
  }
  
  
  public function decena($numdero){
      
          if ($numdero >= 90 && $numdero <= 99)
          {
              $numd = "noventa ";
              if ($numdero > 90)
                  $numd = $numd."y ".( $this->unidad($numdero - 90));
          }
          else if ($numdero >= 80 && $numdero <= 89)
          {
              $numd = "ochenta ";
              if ($numdero > 80)
                  $numd = $numd."y ".( $this->unidad($numdero - 80));
          }
          else if ($numdero >= 70 && $numdero <= 79)
          {
              $numd = "setenta ";
              if ($numdero > 70)
                  $numd = $numd."y ".( $this->unidad($numdero - 70));
          }
          else if ($numdero >= 60 && $numdero <= 69)
          {
              $numd = "sesenta ";
              if ($numdero > 60)
                  $numd = $numd."y ".( $this->unidad($numdero - 60));
          }
          else if ($numdero >= 50 && $numdero <= 59)
          {
              $numd = "cincuenta ";
              if ($numdero > 50)
                  $numd = $numd."y ".( $this->unidad($numdero - 50));
          }
          else if ($numdero >= 40 && $numdero <= 49)
          {
              $numd = "cuarenta ";
              if ($numdero > 40)
                  $numd = $numd."y ".( $this->unidad($numdero - 40));
          }
          else if ($numdero >= 30 && $numdero <= 39)
          {
              $numd = "treinta ";
              if ($numdero > 30)
                  $numd = $numd."y ".( $this->unidad($numdero - 30));
          }
          else if ($numdero >= 20 && $numdero <= 29)
          {
              if ($numdero == 20)
                  $numd = "veinte ";
              else
                  $numd = "veinti".( $this->unidad($numdero - 20));
          }
          else if ($numdero >= 10 && $numdero <= 19)
          {
              switch ($numdero){
              case 10:
              {
                  $numd = "diez ";
                  break;
              }
              case 11:
              {               
                  $numd = "once ";
                  break;
              }
              case 12:
              {
                  $numd = "doce ";
                  break;
              }
              case 13:
              {
                  $numd = "trece ";
                  break;
              }
              case 14:
              {
                  $numd = "catorce ";
                  break;
              }
              case 15:
              {
                  $numd = "quince ";
                  break;
              }
              case 16:
              {
                  $numd = "diecises ";
                  break;
              }
              case 17:
              {
                  $numd = "diecisiete ";
                  break;
              }
              case 18:
              {
                  $numd = "dieciocho ";
                  break;
              }
              case 19:
              {
                  $numd = "Diecinueve ";
                  break;
              }
              }   
          }
          else
              $numd =  $this->unidad($numdero);
      return $numd;
  }
  
  
  public function unidad($numuero){
      switch ($numuero)
      {
          case 9:
          {
              $numu = "nueve";
              break;
          }
          case 8:
          {
              $numu = "ocho";
              break;
          }
          case 7:
          {
              $numu = "siete";
              break;
          }       
          case 6:
          {
              $numu = "seis";
              break;
          }       
          case 5:
          {
              $numu = "cinco";
              break;
          }       
          case 4:
          {
              $numu = "cuatro";
              break;
          }       
          case 3:
          {
              $numu = "tres";
              break;
          }       
          case 2:
          {
              $numu = "dos";
              break;
          }       
          case 1:
          {
              $numu = "un";
              break;
          }       
          case 0:
          {
              $numu = "";
              break;
          }       
      }
      return $numu;   
  }
  
  
  
}
