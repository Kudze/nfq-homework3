<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        return $this->render('default/index.html.twig', []);

    }

    /**
     * @Route("/generate", name="generate")
     */
    public function generateAction() {

        $category = new Category();
        $category->setTitle('Geriausia kategorija');

        $product = new Product();
        $product->setTitle('Geriausias produktas');
        $product->setActive(true);
        $product->setCategory($category);
        $product->setPrice('69 Eurai');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->render('default/generate.html.twig', []);


    }
}
