<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;//ds vendor
use Symfony\Component\HttpFoundation\Response;
use AppBundle\classes\Fruit;
/**
* @Route("/test")
**/
class TestController extends Controller {
 private $message="Crashed";
 private $fruits=['peche','pomme','poire','abricot'];
 private $fruits2= array(
    array(
      'nom'=>'mange',
      'origin'=> 'Amerique du sud',
      'comestible'=> true),
    array(
    'nom'=>'banane',
    'origin'=> 'Guadeloupe',
    'comestible'=> true),
    array(
  'nom'=>'Ananaze',
  'origin'=> 'Tchernobyl',
  'comestible'=> false,
));
// private $fruits3 = array(
//   new Fruit('Orange', 'Sicile',true),
//   new Fruit('Tromate','Suceava',false),
//   new Fruit('Citron','Bari',true),
// );
private $fruits3;
public function __construct(){
$this->fruits3=array(
  new Fruit('Orange', 'Sicile',true,'https:fr.wikipedia.org/wiki/Orange_(fruit)'),
  new Fruit('Tromate','Suceava',false,NULL),
  new Fruit('Citron','Bari',true,'https:fr.wikipedia.org/wiki/Citron'),

);
}
 public function getMessage(){
   return $this->message;
 }
 private function getFruitList(){
   $output='<ul>';
   foreach($this->fruits as $fruit){ $output .='<li>' .$fruit . '</li>';}
   $output .='</ul>';
   return $output;
 }

 /**
  * @Route("/example", name="example_page")
  */
 public function exampleAction(){
  //return " toto" ;//reponse non valid il faut retourner un obj de type Response
  $res1= new Response("ILONA");
  $res2=new Response('<h1>ILONA</h1>');
  $res=new Response($this->getMessage());
  //$res3= new Response($this->fruits);//on peut pas le retourner car il n`est pas str (chaines des caractere)
  //il peut convertir un nombre, mais pas un tableau ni un booleen .
  // $res3= new Response($this->getFruitList());
  // return $res3;
  return $this->render('test/example.html.twig',array(
    'fruits'=> $this->fruits3
  ));
 }
 /**
  * @Route("/fruits/list")
  */
  public function fruitsListAction(){
    $res= new Response($this->getFruitList());
    return $res;
  }
 /**
  * @Route("/fruits/static")
  */
  public function fruitsStaticAction(){
    //renvoie un fichier html statique
  return $this->render('test/fruits.html');
  }
    /**
   * @Route("/fruits", name="fruits_page")
   */
   public function fruitsDynamicAction(){
     //renvoie un fichier html dynamique
     //2eme argument de la methode render est un tableau ass permettant de donner au template (fournir a la view) des donneesaussi bien simple(chaines entiers,etc)
     //et complexes (tableaux, obj)
    return $this->render('test/fruits.html.twig', array(
     'title'=>'liste de fruits',
     'message'=>$this-> getMessage(),
     'fruits'=>$this->fruits,
     'fruits2'=>$this->fruits2,
      'fruits3'=>$this->fruits3,
     'toto'=>NULL,

          ));
           }
           /**
          * @Route("/fruits/comestibles", name="fruits_comestibles")
          */
    public function FruitsComestible(){
      return $this->render('test/fruitscomestibles.html.twig',array(
        'fruits'=>$this->fruits3,
      ));
    }
}
 ?>
