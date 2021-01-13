<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CursoRepository;
use Symfony\Component\HttpFoundation\Request;

class CartController extends AbstractController
{
    private $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }



    /**
     * @Route("/cart", name="front_cart", priority="10")
     */
    public function index()
    {
        $cart = $this->cart->getAll();
        //dd($cart);
        return $this->render('cart/cart.html.twig', compact('cart'));        
    }

    

    /**
     * @Route("/cart/add/{item}", name="front_cart_add")
     */
    public function add($item, CursoRepository $cursoRepository, Request $request) 
    {
        if($request->request->get('quantidade') <= 0 ) {
            return $this->redirectToRoute('front');
        }

        //$curso = $cursoRepository->findById($item);
        $curso = $cursoRepository->findCursoToCartById($item);
        $curso['quantidade'] = $request->request->get('quantidade');        
        //$curso["preco"] = $curso["preco"] / 100;            

        //dd($curso);

        $this->cart->addItem($curso);
        
        return $this->redirectToRoute('detalhes', ['id' => $curso['id']]);
    }



    /**
     * @Route("/cart/remove/{item}", name="front_cart_remove")
     */
    public function removeItem($item) 
    {
       $this->cart->removeItem($item);   
       
       return $this->redirectToRoute('front_cart');
    }



    /**
     * @Route("/cart/limpar", name="front_cart_limpar")
     */
    public function limpar()
    {
        $this->cart->limpar();

        return $this->redirectToRoute('front_cart');
    }

}
