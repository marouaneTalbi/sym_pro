<?php
namespace App\Controller;

use App\Entity\Auto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Modele\Driver;

class HomeController extends AbstractController{


  
    /**
     * @Route("/accueil",name="app_accueil")
     */

    public function Accueil(){

    // $cars=[
    //     ["id" =>001,"marque"=>"pegeot","modele"=>5008,"pays"=>"France"],
    //     ["id" =>002,"marque"=>"renault","modele"=>"megane","pays"=>"France"],
    //     ["id" =>003,"marque"=>"fiat","modele"=>"punto","pays"=>"Italie"],
    // ];

    $driver = new Driver();
    $cars = $driver->getCars();
        return $this->render('home/accueil.html.twig',[
            "tabcars" =>$cars,
        ]);

    }

/**
 * @Route("/apropos" ,name="app_apropos")
 */

    public function presentation(){


            return $this->render('home/apropos.html.twig',[]);
    }


  

} 