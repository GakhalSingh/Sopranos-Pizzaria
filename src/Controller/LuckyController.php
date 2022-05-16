<?php
// src/Controller/LuckyController.php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Category;
use App\Entity\Pizza;
use App\Entity\Order;
use App\Form\OrderFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /** * @Route("/home", name="app_home") */
    public function show(EntityManagerInterface $em) {
        $repository = $em->getRepository(Category::class);
        /** @var Category Categories */
        $Categories = $repository->findAll();
        return $this->render('sopranos/pizzas.html.twig', [ 'Categories' => $Categories, ]);
    }

    /** * @Route("/checkout", name="app_cart") */
    public function cart(EntityManagerInterface $em) {
        $repository = $em->getRepository(Order::class);
        /** @var Order Order */
        $Order = $repository->findAll();
        return $this->render('sopranos/cart.html.twig', [ 'Order' => $Order, ]);
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
            $order->setItem($Item);
            $order->setSize($data['size']);
            $order->setAmount($data['amount']);
            $order->setStatus("Preparing");
            $order->setOrderNumber(1);
            $em->persist($order);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }
        /** @var Category Category */
        /** @var Item Item */
        return $this->render('sopranos/item.html.twig', [ 'Category' => $Category, 'Item' => $Item, 'orderForm' => $form->createView()]);
    }
}