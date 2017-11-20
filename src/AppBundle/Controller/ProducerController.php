<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use AppBundle\Entity\Producer;
use AppBundle\Entity\Fruit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/producer")
 */
class ProducerController extends Controller
{
    /**
     * @Route("/index", name="producer_index")
     */
    public function indexAction()
    {
        $producers = $this->getDoctrine()
          ->getRepository(Producer::class)->findAll();
        return $this->render('AppBundle:Producer:index.html.twig', array(
            'producers' => $producers
        ));
    }
    /**
     * @Route("/add", name="producer_add")
     */
    public function addAction(Request $request)
    {
        // Quand une méthode doit gérer une soumission
        // de formulaire, elle doit utiliser un objet Request
        // création d'un objet vide
        $producer = new Producer();
        // la méthode createFormBuilder permet de créer un formulaire
        // en pur PHP OO (pas de balise HTML)
        $form = $this->createFormBuilder($producer)
          ->add('name', TextType::class, array())
            ->add('email', EmailType::class, array())
          ->add('submit', SubmitType::class, array(
            'label' => 'Enregistrer',
          ))
          ->getForm();
        // handleRequest() établit la connexion entre
        // l'objet $form et l'objet $request
        $form->handleRequest($request);
        // méthode permettant de savoir si le formulaire a été envoyé
        // équivalent de $request->getMethod() == 'POST' lorqu'on utilise
        // l'objet Request $request
        //la methode isValid() pour gerer ttes les annotations assert ds le classes
        if ($form->isSubmitted() && $form->isValid()) {
          // hydratation automatique grâce à getData()
          $producer = $form->getData();
          //validation des donnees en PHP ss annotations
          // $str_len= strlen($producer->getName());
          // $min=3;
          // $max=10;
          // $cond1= $str_len >=$min;
          // $cond2=$str_len <=$max;
          // $total_cond= $cond1 && $cond2;
          // $message="Le nom du producteur doit comporter";
          // $message.= "au moins ".$min." caracteres";
          // $message.= "et au plus ".$max." caracteres";
          //
          // if(!$total_cond) return new Response($message);

          // enregistrement en base de données
          $em = $this->getDoctrine()->getManager();
          $em->persist($producer);

          $em->flush();
          return $this->redirectToRoute('producer_index');
        }
        return $this->render('AppBundle:Producer:add.html.twig', array(
          'form' => $form->createView()
        ));
    }
    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:Producer:edit.html.twig', array(
            // ...
        ));
    }
    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Producer:delete.html.twig', array(
            // ...
        ));
    }
    /**
    * @Route("/detail/{id}", name="producer_detail")
    */
    public function detailsAction($id)
     {
        $producer=$this->getDoctrine()->getRepository(Producer::class)->find($id);
        return $this->render('AppBundle:Producer:details.html.twig',array(
        'producer'=>$producer,
        ));
    }
}
