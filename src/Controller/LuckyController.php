<?php
// src/Controller/LuckyController.php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /** * @Route("/home", name="app_show") */
    public function show(EntityManagerInterface $em) {
        $repository = $em->getRepository(Category::class);
        /** @var Category Categories */
        $Categories = $repository->findAll();
        return $this->render('sopranos/pizzas.html.twig', [ 'Categories' => $Categories, ]);
    }
}