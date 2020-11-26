<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuario;
use App\Form\UsuarioType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsuariosController extends AbstractController
{
  /**
  * @Route("/registro", name="registro")
  */
  public function registrar(Request $request, UserPasswordEncoderInterface $encoder): Response
  {
    $usuario = new Usuario();
    $form = $this->createForm(UsuarioType::class, $usuario);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $usuario = $form->getData();
      $passwordEncoder = $encoder->encodePassword($usuario,$usuario->getPassword());
      $usuario->setPassword($passwordEncoder);
      $usuario->setCriado(new \DateTime('now'));
      $usuario->setStatus(1);
      $usuario->setRoles(array('ROLE_USER'));

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($usuario);
      $entityManager->flush();

      return $this->redirectToRoute('registro');
    }

    return $this->render('usuarios/registro.html.twig', [
      'form' => $form->createView(),
    ]);
  }



  public function logout()
  {
    return $this->render('usuarios/login.html.twig');
  }




  public function login()
  {
    return $this->render('usuarios/login.html.twig');
  }


}
