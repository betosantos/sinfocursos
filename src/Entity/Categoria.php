<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass=CategoriaRepository::class)
*/
class Categoria
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
  * @ORM\Column(type="text", nullable=true)
  */
  private $descricao;

  /**
  * @ORM\Column(type="date")
  */
  private $criado;

  /**
  * @ORM\ManyToMany(targetEntity=Curso::class, mappedBy="categorias")
  */
  private $cursos;



  

  public function __construct()
  {
    $this->cursos = new ArrayCollection();
  }

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

  public function getDescricao(): ?string
  {
    return $this->descricao;
  }

  public function setDescricao(?string $descricao): self
  {
    $this->descricao = $descricao;

    return $this;
  }

  public function getCriado(): ?\DateTimeInterface
  {
    return $this->criado;
  }

  public function setCriado(\DateTimeInterface $criado): self
  {
    $this->criado = $criado;

    return $this;
  }

  /**
  * @return Collection|Curso[]
  */
  public function getCursos(): Collection
  {
    return $this->cursos;
  }

  public function addCurso(Curso $curso): self
  {
    if (!$this->cursos->contains($curso)) {
      $this->cursos[] = $curso;
      $curso->addCategoria($this);
    }

    return $this;
  }

  public function removeCurso(Curso $curso): self
  {
    if ($this->cursos->removeElement($curso)) {
      $curso->removeCategoria($this);
    }

    return $this;
  }

  public function __toString()
  {
    return (string) $this->nome;
  }


}
