<?php

namespace App\Controller;

use App\Entity\Auto;
use App\Entity\Car;
use App\Form\AutoType;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
 * @Route("/add" ,name="app_add")
 */


public function add(Request $request){

    $em =  $this->getDoctrine()->getManager();

    $car = new Auto();
    $form = $this->createForm(AutoType::class,$car);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

        $updateCar = $form->getData();
        $em =  $this->getDoctrine()->getManager();
        $em->persist($car);
        $em->flush();
        $this->addFlash('MsgSuccess','Voiture Enregistreé');
        return $this->redirectToRoute("app_list");

}

return $this->render('admin/add.html.twig',[
    'form'=>$form->createView()
    ]);

}

/**
* @Route("/list" ,name="app_list")
*/

public function getAutos(){

    $repo = $this->getDoctrine()->getRepository(Auto::class);
    $cars = $repo->findAll();

    return $this->render("Admin/list.html.twig",[
        "tabcars" =>$cars
    ]);

}

/**
 * @Route("/edit/{id}", name="app_edit")
 */
public function editAuto(Auto $car,Request $request, EntityManagerInterface $em){
    // $car =$this->getDoctrine()->getRepository(Auto::class)->find($id);
    $form = $this->createFormBuilder($car)
                ->add('marque')
                ->add('modele')
                ->add('pays')
                ->add('prix',NumberType::class)
                ->add('category', EntityType::class,['label' =>'categorie','class'=>Categorie::class,'choice_label'=>'nom'])
                ->add('description')
                // ->add('Modifier',SubmitType::class)
                ->getForm();

                $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){

                        $updateCar = $form->getData();
                        // $em =  $this->getDoctrine()->getManager();
                        $em->flush();
                        $this->addFlash('MsgSuccess','Voiture Modifie');

                        return $this->redirectToRoute("app_list");


                }

    
        return $this->render("admin/edit.html.twig", 
        [
            "form_car"=>$form->createView(),
            "car" =>$car
            ]);
    
    
    dd($car);
}



      /**
 * @Route("/delete/{id}", name="app_delete")
 */

public function deleteAuto($id){

    $em = $this->getDoctrine()->getManager();
    $car = $em->getRepository(Auto::class)
              ->find($id);
          if(!$car){
              throw $this->createNotFoundException(
                  'Aucune voiture ne correspond à votre demande'
              );
          }
              $em->remove($car);
              $em->flush();
              $this->addFlash('MsgSuccess','Voiture Supprimeé');

         
     return $this->redirectToRoute('app_list');
 }

}
