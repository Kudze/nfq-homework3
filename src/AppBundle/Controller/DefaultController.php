<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

        $em = $this->getDoctrine()->getManager();

        $category = new Category();
        $category->setTitle('Geriausia kategorija');

        $product = new Product();
        $product->setTitle('Geriausias produktas');
        $product->setActive(true);
        $product->setCategory($category);
        $product->setPrice('69 Eurai');

        $em->persist($product);
        $em->flush();

        return $this->render('default/generate.html.twig', [
            'product' => $product
        ]);

    }

    /**
     * @Route("/delete/{product}", name="delete")
     * @ParamConverter("product")
     */
    public function deleteAction(Product $product) {

        $em = $this->getDoctrine()->getManager();

        if($product === null)
            $currRes = 'Nepavyko surasti produkto šiuo ID.';

        else {
            $em->remove($product);
            $em->flush();

            $currRes = 'Buvo ištrintas produktas, bet palikta kategorija.';
        }

        return $this->render('default/delete.html.twig', [
            'result' => $currRes
        ]);

    }




}
