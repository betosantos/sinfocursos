<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
* @ORM\Entity(repositoryClass=CursoRepository::class)
* @Vich\Uploadable
*/
class Curso
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
  private $titulo;

  /**
  * @ORM\Column(type="text", nullable=true)
  */
  private $descricao;

  /**
  * @Vich\UploadableField(mapping="cursos", fileNameProperty="imagem")
  */
  private $imageFile;

  /**
  * @ORM\Column(type="string", length=255, nullable=true)
  */
  private $imagem;

  /**
  * @ORM\Column(type="datetime")
  */
  private $criado;

  /**
  * @ORM\ManyToMany(targetEntity=Categoria::class, inversedBy="cursos")
  */
  private $categorias;




  public function __construct()
  {
    $this->categorias = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getTitulo(): ?string
  {
    return $this->titulo;
  }

  public function setTitulo(string $titulo): self
  {
    $this->titulo = $titulo;

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

  public function getImagem(): ?string
  {
    return $this->imagem;
  }

  public function setImagem(?string $imagem): self
  {
    $this->imagem = $imagem;

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
  * @return Collection|Categoria[]
  */
  public function getCategorias(): Collection
  {
    return $this->categorias;
  }

  public function addCategoria(Categoria $categoria): self
  {
    if (!$this->categorias->contains($categoria)) {
      $this->categorias[] = $categoria;
    }

    return $this;
  }

  public function removeCategoria(Categoria $categoria): self
  {
    $this->categorias->removeElement($categoria);

    return $this;
  }


  public function getImageFile(): ?File
  {
    return $this->imageFile;
  }

  public function setImageFile(?File $imageFile = null): self
  {
    $this->imageFile = $imageFile;
    return $this;

    // if (null !== $imageFile) {
    //   // It is required that at least one field changes if you are using doctrine
    //   // otherwise the event listeners won't be called and the file is lost
    //   $this->updatedAt = new \DateTimeImmutable();
    // }
  }

}
