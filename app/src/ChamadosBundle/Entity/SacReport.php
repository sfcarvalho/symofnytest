<?php

namespace ChamadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SacReport
 *
 * @ORM\Table(name="chamados")
 * @ORM\Entity
 */
class SacReport
{


  /**
   * @var string
   *
   * @ORM\Column(name="email", type="string", length=250, nullable=false)
   */
  private $email;



  /**
   * @var integer
   *
   * @ORM\Column(name="numero_pedido", type="integer", nullable=false)
   */
  private $numero_pedido;


  /**
   * @return int
   */
  public function getNumeroPedido()
  {
    return $this->numero_pedido;
  }

  /**
   * @param int $numero_pedido
   */
  public function setNumeroPedido($numero_pedido)
  {
    $this->numero_pedido = $numero_pedido;
  }



  /**
   * @return string
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * @param string $email
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }



}