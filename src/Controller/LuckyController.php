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

    /** * @Route("/menu/{a}", name="app_menu") */
    public function show2(EntityManagerInterface $em, int $a):Response
    {
        $Category = $em->getRepository(Category::class)->findOneBy(['id' => $a]);
        /** @var Category Category */
        return $this->render('sopranos/menu.html.twig', [ 'Category' => $Category]);
    }
}