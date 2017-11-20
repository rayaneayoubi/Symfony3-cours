<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
/**
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Category:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction(Request $request)
    {
      $category = new Category();
      $form=$this->createFormBuilder($category)
      ->add('name',TextType::class,array())
      ->add('submit',SubmitType::class,array(
        'label'=>'Add')
      )
      ->getForm();
      $form->handleRequest($request);
      if( $form->isSubmitted()){
        $category =$form->getData();
        $em=$this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();
      }
        return $this->render(
          'AppBundle:Category:add.html.twig', array(
                'form'=>  $form->createView()
        ));
    }
}
