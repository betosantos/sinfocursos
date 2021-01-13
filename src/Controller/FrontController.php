<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categoria;
use App\Entity\Curso;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class FrontController extends AbstractController
{

  /**
  * @Route("/detalhes/{id}", name="detalhes")
  */
  public function detalhes($id): Response
  {
    $curso = $this->getDoctrine()->getRepository(Curso::class)->find($id);

    return $this->render('front/detalhes.html.twig',[
        'curso' => $curso
    ]);
  }



  /**
  * @Route("/", name="front")
  */
  public function index(): Response
  {
    // Pegar todos os registros da Categoria de Novidade e exibir na Homepage
    $categoriaNov = $this->getDoctrine()->getRepository(Categoria::class)->find(5);
    $categoriaPhp = $this->getDoctrine()->getRepository(Categoria::class)->find(1);
    $catMicrosoft = $this->getDoctrine()->getRepository(Categoria::class)->find(2);
    $cursos = $this->getDoctrine()->getRepository(Curso::class)->findall();

    return $this->render('front/index.html.twig', compact('categoriaNov','categoriaPhp','cursos','catMicrosoft'));
  }



  /**
  * @Route("/comacesso/{id}", name="comacesso")
  */
  public function comAcesso($id): Response
  {
    $curso = $this->getDoctrine()->getRepository(Curso::class)->find($id);

    return $this->render('front/comacesso.html.twig',[
        'curso' => $curso
    ]);
  }



}
