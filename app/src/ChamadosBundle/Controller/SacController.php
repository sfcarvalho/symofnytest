<?php

namespace ChamadosBundle\Controller;

use ChamadosBundle\Entity\Chamados;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ChamadosBundle\Entity\Sac;
use ChamadosBundle\Entity\Clientes;
use ChamadosBundle\Form\SacType;
use Symfony\Component\HttpFoundation\JsonResponse;

///**
// * Sac controller.
// *
// * @Route("/")
// */

class SacController extends Controller
{
  /**
   * @Route("/", name="sac_new")
   * @Method("GET")
   */
  public function newAction(Request $request)
  {
    $entity = new Sac();

    $form = $this->createCreateForm($entity);

    return $this->render('ChamadosBundle:Chamados:new.html.twig',
      array(
        'entity' => $entity,
        'form' => $form->createView()
      )
    );

  }

  /**
   * Creates a new Demo entity.
   *
   * @Route("/", name="sac_create")
   * @Method("POST")
   *
   */
  public function createAction(Request $request)
  {

    $entity = new Sac();
    $form = $this->createCreateForm($entity);
    $form->handleRequest($request);

    if ($form->isValid()) {

      $repo = $this->getDoctrine()->getRepository('ChamadosBundle:Pedidos');
      $pedidoId = $request->request->get('sac')['numero_pedido'];
      $pedido = $repo->findById($pedidoId);

      $repoCli = $this->getDoctrine()->getManager()->getRepository('ChamadosBundle:Clientes');
      $cliEmail = $request->request->get('sac')['email'];
      $cli = $repoCli->findOneByEmail($cliEmail);

      // Pedido não encontrado
      if(empty($pedido)){
        return new JsonResponse('', 200);
      }else{
        // Email não cadastrado
        if(is_null($cli) && !empty($cliEmail)){
          $cliente = new Clientes();
          $cliente->setNome('');
          $cliente->setEmail($cliEmail);
          $em = $this->getDoctrine()->getManager();
          $em->persist($cliente);
          $em->flush();

          $newCli = $repoCli->findOneByEmail($cliEmail);
          $chamado = new Chamados();
          $chamado->setIdCliente($newCli->id);
          $chamado->setIdPedido($pedidoId);
          $chamado->setObs($request->request->get('sac')['obs']);
          $chamado->setTitulo($request->request->get('sac')['titulo']);

          $em = $this->getDoctrine()->getManager();
          $em->persist($chamado);
          $em->flush();

          return new JsonResponse(['message' => 'Chamado cadastrado com suecesso! Novo cliente cadastrado.'],200);
        }else{
          $newCli = $repoCli->findOneByEmail($cliEmail);
          $chamado = new Chamados();
          $chamado->setIdCliente($newCli->id);
          $chamado->setIdPedido($pedidoId);
          $chamado->setObs($request->request->get('sac')['obs']);
          $chamado->setTitulo($request->request->get('sac')['titulo']);

          $em = $this->getDoctrine()->getManager();
          $em->persist($chamado);
          $em->flush();
          return new JsonResponse(['message' => 'Chamado cadastrado com suecesso!'],200);
        }
      }
    }

    $response = new JsonResponse(
      array(
        'message' => 'Error',
        'form' => $this->renderView('ChamadosBundle:Chamados:busca.html.twig',
          array(
            'entity' => $entity,
            'form' => $form->createView(),
          ))), 400);

    return $response;


//    $chamado = new Sac();
//    $form = $this->createForm('ChamadosBundle\Form\SacType', $chamado);
//    $form->handleRequest($request);
//
//    if ($form->isSubmitted() && $form->isValid()) {
//      return $this->redirectToRoute('busca', array('id' => $request->request->get('sac')['numero_pedido']));
//    }
//
//    return $this->render('ChamadosBundle:Sac:busca.html.twig', array(
//      'chamado' => $chamado,
//      'form' => $form->createView(),
//    ));
  }

  /**
   * Creates a form to create a Sac entity.
   *
   * @param Sac $entity The entity
   *
   * @return SymfonyComponentFormForm The form
   */
  private function createCreateForm(Sac $entity)
  {
    // die(var_dump($entity));
    $form = $this->createForm(SacType::class, $entity,
      array(
        'action' => $this->generateUrl('sac_create'),
        'method' => 'POST',
      ));

    return $form;
  }

}
