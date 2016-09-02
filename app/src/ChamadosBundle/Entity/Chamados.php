<?php

namespace ChamadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chamados
 *
 * @ORM\Table(name="chamados")
 * @ORM\Entity
 */
class Chamados
{
  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="chamados_id_seq", allocationSize=1, initialValue=1)
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="titulo", type="string", length=250, nullable=true)
   */
  private $titulo;

  /**
   * @var string
   *
   * @ORM\Column(name="obs", type="string", length=250, nullable=true)
   */
  private $obs;

  /**
   * @var string
   *
   * @ORM\Column(name="id_cliente", type="integer", nullable=false)
   */
  private $id_cliente;


  /**
   * @var string
   *
   * @ORM\Column(name="id_pedido", type="integer", nullable=false)
   */
  private $id_pedido;

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getTitulo()
  {
    return $this->titulo;
  }

  /**
   * @param string $titulo
   */
  public function setTitulo($titulo)
  {
    $this->titulo = $titulo;
  }

  /**
   * @return string
   */
  public function getObs()
  {
    return $this->obs;
  }

  /**
   * @param string $obs
   */
  public function setObs($obs)
  {
    $this->obs = $obs;
  }

  /**
   * @return string
   */
  public function getIdCliente()
  {
    return $this->id_cliente;
  }

  /**
   * @param string $id_cliente
   */
  public function setIdCliente($id_cliente)
  {
    $this->id_cliente = $id_cliente;
  }

  /**
   * @return string
   */
  public function getIdPedido()
  {
    return $this->id_pedido;
  }

  /**
   * @param string $id_pedido
   */
  public function setIdPedido($id_pedido)
  {
    $this->id_pedido = $id_pedido;
  }

}

