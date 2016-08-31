<?php

namespace ChamadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sac
 *
 * @ORM\Table(name="chamados")
 * @ORM\Entity
 */
class Sac
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
   * @ORM\Column(name="nome_cliente", type="string", length=250, nullable=true)
   */
  private $nome_cliente;

  /**
   * @var string
   *
   * @ORM\Column(name="email", type="string", length=250, nullable=true)
   */
  private $email;

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
   * @var integer
   *
   * @ORM\Column(name="numero_pedido", type="integer", nullable=false)
   */
  private $numero_pedido;

  /**
   * @var string
   *
   */
  private $isActive;

  /**
   * @return string
   */
  public function getIsActive()
  {
    return $this->isActive;
  }

  /**
   * @param string $isActive
   */
  public function setIsActive($isActive)
  {
    $this->isActive = $isActive;
  }

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
  public function getNomeCliente()
  {
    return $this->nome_cliente;
  }

  /**
   * @param string $nome_cliente
   */
  public function setNomeCliente($nome_cliente)
  {
    $this->nome_cliente = $nome_cliente;
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

}