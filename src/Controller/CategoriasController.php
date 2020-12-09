<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categoria;
use App\Form\CategoriaType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
* @Route("admin/", name="")
* @IsGranted("ROLE_ADMIN")
*/
class CategoriasController extends AbstractController
{
  /**
  * @Route("categorias", name="categorias")
  */
  public function categorias(): Response
  {
    $categorias =  $this->getDoctrine()->getRepository(Categoria::class)->findBy(array(),array('nome' => 'ASC'));

    return $this->render('admin/categorias/index.html.twig', compact('categorias'));
  }



  /**
  * @Route("/categorias/delete/{id}", name="categorias_delete")
  */
  public function categoriasDelete(Request $request, $id): Response
  {
    $categoria = $this->getDoctrine()->getRepository(Categoria::class)->find($id);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($categoria);
    $entityManager->flush();

    return $this->redirectToRoute('categorias');
  }




  /**
  * @Route("/categorias/edit/{id}", name="categorias_edit")
  */
  public function categoriasEdit(Request $request, $id): Response
  {
    $categoria = $product = $this->getDoctrine()->getRepository(Categoria::class)->find($id);
    $form = $this->createForm(CategoriaType::class, $categoria);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $categoria = $form->getData();
      // $categoria->setCriado(new \DateTime('now'));

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($categoria);
      $entityManager->flush();

      $this->addFlash('success',"Categoria Atualizada com Sucesso!!");
      return $this->redirectToRoute('categorias');
    }

    return $this->render('admin/categorias/form.html.twig', [
      'form' => $form->createView(),
    ]);
  }




  /**
  * @Route("/categorias/form", name="categorias_form")
  */
  public function categoriasForm(Request $request): Response
  {
    $categoria = new Categoria();
    $form = $this->createForm(CategoriaType::class, $categoria);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $categoria = $form->getData();
      $categoria->setCriado(new \DateTime('now'));

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($categoria);
      $entityManager->flush();

      $this->addFlash('success',"Categoria Cadastrada com Sucesso!!");
      return $this->redirectToRoute('categorias');
    }

    return $this->render('admin/categorias/form.html.twig', [
      'form' => $form->createView(),
    ]);
  }





}
