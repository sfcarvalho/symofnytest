<?php

namespace ChamadosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ChamadosBundle\Entity\Sac;
use ChamadosBundle\Form\SacType;



/**
 * Default controller.
 *
 * @Route("/")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
      return $this->redirectToRoute('sac_index');
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
    //This is optional. Do not do this check if you want to call the same action using a regular request.
    if (!$request->isXmlHttpRequest()) {
      return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
    }

    $entity = new Demo();
    $form = $this->createCreateForm($entity);
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($entity);
      $em->flush();

      return new JsonResponse(array('message' => 'Success!'), 200);
    }

    $response = new JsonResponse(
      array(
        'message' => 'Error',
        'form' => $this->renderView('ChamadosBundle:Demo:form.html.twig',
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
//    return $this->render('ChamadosBundle:Default:busca.html.twig', array(
//      'chamado' => $chamado,
//      'form' => $form->createView(),
//    ));
  }

  /**
   * Creates a form to create a Demo entity.
   *
   * @param Sac $entity The entity
   *
   * @return SymfonyComponentFormForm The form
   */
  private function createCreateForm(Sac $entity)
  {
    $form = $this->createForm(new SacType(), $entity,
      array(
        'action' => $this->generateUrl('sac_create'),
        'method' => 'POST',
      ));

    return $form;
  }

}
