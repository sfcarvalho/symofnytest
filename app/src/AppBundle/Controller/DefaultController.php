<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ChamadosBundle\Entity\Sac;
use ChamadosBundle\Controller\SacController;
use Symfony\Component\HttpFoundation\Request;

use ChamadosBundle\Entity\Chamados;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ChamadosBundle\Entity\Clientes;
use ChamadosBundle\Form\SacType;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="main")
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
