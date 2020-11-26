<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Curso;
use App\Form\CursoType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
* @Route("admin/", name="")
* @IsGranted("ROLE_ADMIN")
*/
class CursosController extends AbstractController
{
  /**
  * @Route("cursos", name="cursos")
  */
  public function cursos(): Response
  {
    $cursos =  $this->getDoctrine()->getRepository(Curso::class)->findall();

    return $this->render('admin/cursos/index.html.twig', compact('cursos'));
  }




  /**
  * @Route("cursos/edit/{id}", name="cursos_edit")
  */
  public function cursosEdit(Request $request, $id): Response
  {
    $curso =  $this->getDoctrine()->getRepository(Curso::class)->find($id);
    $form = $this->createForm(CursoType::class, $curso);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $curso = $form->getData();
      $curso->setCriado(new \DateTime('now'));

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($curso);
      $entityManager->flush();

      return $this->redirectToRoute('cursos');
    }

    return $this->render('admin/cursos/form.html.twig', [
      'form' => $form->createView(),
    ]);

  }




  /**
  * @Route("cursos/form", name="cursos_form")
  */
  public function cursosForm(Request $request): Response
  {
    $curso = new Curso();
    $form = $this->createForm(CursoType::class, $curso);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $curso = $form->getData();
      $curso->setCriado(new \DateTime('now'));

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($curso);
      $entityManager->flush();

      return $this->redirectToRoute('cursos');
    }

    return $this->render('admin/cursos/form.html.twig', [
      'form' => $form->createView(),
    ]);
  }




}
