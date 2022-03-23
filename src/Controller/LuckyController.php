<?php
// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
   /**
    * @Route("/lucky/number")
    */
    public function number() : Response
    {
        $pizzas = ['Pizza Salami','Pizza Pepperoni','Pizza Funghi','Pizza Margherita','Pizza Quattro Formaggi','Pizza Tandoori'];
        return $this->render('sopranos/pizzas.html.twig', [
            'pizzas' => $pizzas[array_rand($pizzas)],
        ]);
    }
}