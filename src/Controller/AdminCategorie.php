<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategorie extends AbstractController
{




/**
 * @Route("/add_cat" ,name="cat_add")
 */


public function add(Request $request){

    $em =  $this->getDoctrine()->getManager();

    $cat = new Categorie();
    $form = $this->createForm(CatType::class,$cat);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

        $updateCar = $form->getData();
        $em =  $this->getDoctrine()->getManager();
        $em->persist($cat);
        $em->flush();
        $this->addFlash('MsgSuccess','Voiture Enregistreé');
        return $this->redirectToRoute("cat_list");

}
return $this->render('admin/addCat.html.twig',[
    'form'=>$form->createView()
    ]);



}

/**
* @Route("/list_cat" ,name="cat_list")
*/

public function getAutos(){

    $repo = $this->getDoctrine()->getRepository(Categorie::class);
    $categories = $repo->findAll();
    // dd($categories);
    return $this->render("admin/listCat.html.twig",[
        "tabcat" =>$categories
    ]);

}


}


