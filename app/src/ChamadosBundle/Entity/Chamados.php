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



}

