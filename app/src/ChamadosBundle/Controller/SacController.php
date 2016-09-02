<?php

namespace ChamadosBundle\Controller;

use ChamadosBundle\Entity\Chamados;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ChamadosBundle\Entity\Sac;
use ChamadosBundle\Entity\SacReport;
use ChamadosBundle\Entity\Clientes;
use ChamadosBundle\Form\SacType;
use ChamadosBundle\Form\SacReportType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Sac controller.
 *
 * @Route("/")
 */

class SacController extends Controller
{
  /**
   * @Route("/", name="sac_index")
   * @Method("GET")
   */
  public function indexAction(Request $request)
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
   * Creates a new Sac entity.
   *
   * @Route("/novoChamado", name="sac_create")
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

  /**
   * @Route("/reports", name="sac_reports")
   * @Method("GET")
   */
  public function reportsAction(Request $request)
  {
    $entity = new SacReport();

    $form = $this->createCreateFormReport($entity);

    return $this->render('ChamadosBundle:Chamados:reports.html.twig',
      array(
        'entity' => $entity,
        'form' => $form->createView()
      )
    );

  }
  /**
   * @Route("/reportsResult", name="reports_results")
   * @Method("POST")
   */
  public function reportsResultAction(Request $request)
  {
    $entity = new SacReport();
    $form = $this->createCreateFormReport($entity);
    $form->handleRequest($request);

    $idPedido = $request->request->get('sac_report')['numero_pedido'];
    $emailCli = $request->request->get('sac_report')['email'];

    // Busca id do cliente pelo e-mail
    $repoCli = $this->getDoctrine()->getManager()->getRepository('ChamadosBundle:Clientes');
    $cli = $repoCli->findOneByEmail($emailCli);

    $em = $this->getDoctrine()->getManager();

    $query = $em->createQuery("select ch.titulo,ch.obs,p.nome,cli.email 
                              from ChamadosBundle:Chamados ch 
                              inner join ChamadosBundle:Clientes cli WITH cli.id = ch.id_cliente 
                              inner join ChamadosBundle:Pedidos p WITH p.id = ch.id_pedido 
                              where p.id = :id_pedido or cli.id = :id_cliente")
                              ->setParameter("id_pedido", 5)->setParameter("id_cliente", 39);

    $chamado = $query->getResult();

    return $this->render('ChamadosBundle:Chamados:reports.html.twig',
      array(
        'entity' => $entity,
        'form' => $form->createView()
      )
    );
  }



  /**
   * Creates a form to create a Sac entity.
   *
   * @param Sac $entity The entity
   *
   * @return SymfonyComponentFormForm The form
   */
  private function createCreateFormReport(SacReport $entity)
  {
    // die(var_dump($entity));
    $form = $this->createForm(SacReportType::class, $entity,
      array(
        'action' => $this->generateUrl('reports_results'),
        'method' => 'POST',
      ));

    return $form;
  }
}
