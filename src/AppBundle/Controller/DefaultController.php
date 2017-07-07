<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orders;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $categories=$this->getDoctrine()->getRepository("AppBundle:Category")->findAll();
        $productCategories=$this->getDoctrine()->getRepository("AppBundle:ProductCategory")->findAll();



        // replace this example code with whatever you need
        return $this->render('::base.html.twig', array("categories"=>$categories,"productCategories"=>$productCategories,
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    public function addProductAction(Request $request)
    {
        $ProductName=$request->request->get('ProductName');
        $Category=$request->request->get('Category');
        $em = $this->getDoctrine()->getManager();



        $product = new Product();
        $product->setName($ProductName);
        $string = $ProductName;
        $replace = array();
        $delimiter = '-';
        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        if (!empty($replace)) {
            $clean = str_replace((array) $replace, ' ', $clean);
        }
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);
        setlocale(LC_ALL, $oldLocale);
        $product->setSlug($clean);
        $em->persist($product);

       foreach ($Category as $Ctg){
           $CategoryFind=$this->getDoctrine()->getRepository("AppBundle:Category")->findOneBy(array("name"=>$Ctg));

           $productCategory=new ProductCategory();
           $productCategory->setCategory($CategoryFind);
           $productCategory->setProduct($product);

           $em->persist($productCategory);
       }


        $check = $em->flush();
        if($check){
            dump($check);
            exit();
        }
        $this->addFlash(
            'notice','Ekleme işlemi başarılı!'
        );
        return $this->redirectToRoute("list_product");

    }

    public function listProductAciton()
    {
        dump("asd");
        exit();
        //7return new Response("AppBundle:");
    }

    public function orderAction(Request $request)
    {
        $productid=$request->request->get("productid");
        $product=$this->getDoctrine()->getRepository("AppBundle:Product")->find($productid);
        $em=$this->getDoctrine()->getManager();

        $order=new Orders();
        $order->setProduct($product);
        $em->persist($order);
        $em->flush();

        $dateTime =new \DateTime('now');

        if($dateTime->format("H")>"07" and $dateTime->format("H")<"15")
        {
            return new Response('Ürününüz bugün kargoya verilecektir.');
        }elseif ($dateTime->format("H")>"15" and $dateTime->format("H")<"24"){
            return new Response('Ürününüz yarın kargoya verilecektir.');
        }elseif($dateTime->format("H")>"0" and $dateTime->format("H")<"7"){
            return new Response('Ürününüz bugün çalışma saatleri içinde kargoya verilecektir.');
        }else{
            return new Response('Hata Oluştu.');
        }



    }
}
