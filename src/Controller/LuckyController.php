<?php
// src/Controller/LuckyController.php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Category;
use App\Entity\Pizza;
use App\Form\OrderFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
            $Pizzas = $em->getRepository(Pizza::class)->findBy(['category' => $a]);
        /** @var Category Category */
        /** @var Pizza Pizzas */
        return $this->render('sopranos/menu.html.twig', [ 'Category' => $Category, 'Pizzas' => $Pizzas]);
    }

    /** * @Route("/menu/{a}/item/{b}", name="app_item") */
    public function show3(EntityManagerInterface $em, int $a, int $b, Request $request):Response
    {
        $Category = $em->getRepository(Category::class)->findOneBy(['id' => $a]);
        $Item = $em->getRepository(Pizza::class)->findOneBy(['id' => $b]);
        $form = $this->createForm(OrderFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $order = new Order();
            $order->setTitle($data['title']);
            $order->setContent($data['content']);
            $em->persist($order);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }
        /** @var Category Category */
        /** @var Item Item */
        return $this->render('sopranos/item.html.twig', [ 'Category' => $Category, 'Item' => $Item, 'orderForm' => $form->createView()]);
    }
}