<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
* @ORM\Entity(repositoryClass=UsuarioRepository::class)
*/
class Usuario implements UserInterface
{
  /**
  * @ORM\Id
  * @ORM\GeneratedValue
  * @ORM\Column(type="integer")
  */
  private $id;

  /**
  * @ORM\Column(type="string", length=255)
  */
  private $nome;

  /**
  * @ORM\Column(type="string", length=255)
  */
  private $email;

  /**
  * @ORM\Column(type="string", length=255)
  */
  private $password;

  /**
  * @ORM\Column(type="date", nullable=true)
  */
  private $criado;

  /**
  * @ORM\Column(type="boolean")
  */
  private $status;

  /**
  * @ORM\Column(type="string", length=255)
  */
  private $roles;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getNome(): ?string
  {
    return $this->nome;
  }

  public function setNome(string $nome): self
  {
    $this->nome = $nome;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getPassword(): ?string
  {
    return $this->password;
  }

  public function setPassword(string $password): self
  {
    $this->password = $password;

    return $this;
  }

  public function getCriado(): ?\DateTimeInterface
  {
    return $this->criado;
  }

  public function setCriado(?\DateTimeInterface $criado): self
  {
    $this->criado = $criado;

    return $this;
  }

  public function getStatus(): ?bool
  {
    return $this->status;
  }

  public function setStatus(bool $status): self
  {
    $this->status = $status;

    return $this;
  }

  public function eraseCredentials()
  {
  }

  public function getSalt()
  {
    return null;
  }

  public function getUsername()
  {
    return $this->email;
  }

  public function getRoles(): array
  {
    $roles = json_decode($this->roles, true);
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
  }

  // public function getRoles()
  // {
  //   $roles = $this->roles;
  //   $roles[] = 'ROLE_USER';
  //   return roles;
  // }

  public function setRoles(string $roles): self
  {
    $this->roles = $roles;

    return $this;
  }


}
