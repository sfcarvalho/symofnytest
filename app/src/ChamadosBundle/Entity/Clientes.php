<?php

namespace ChamadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clientes
 *
 * @ORM\Table(name="clientes")
 * @ORM\Entity
 */
class Clientes
{
  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="clientes_id_seq", allocationSize=1, initialValue=1)
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="nome", type="string", length=250, nullable=false)
   */
  private $nome;

  /**
   * @var string
   *
   * @ORM\Column(name="email", type="string", length=100, nullable=false)
   */
  private $email;

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
  public function getNome()
  {
    return $this->nome;
  }

  /**
   * @param string $nome
   */
  public function setNome($nome)
  {
    $this->nome = $nome;
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

