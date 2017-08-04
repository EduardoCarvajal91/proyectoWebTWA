<?php

namespace AppBundle\Entity;

use AppBundle\Repository\EstadoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Archivo
 * @ORM\Table(name="archivo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArchivoRepository")
 * @Vich\Uploadable
 */
class Archivo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @var Estado
     *
     * Many Archivo have One Estado.
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    private $estado;

    /**
     * @var PersonaProyecto
     *
     * Many Archivo have One PersonaProyecto.
     * @ORM\ManyToOne(targetEntity="PersonaProyecto", inversedBy="archivos",cascade={"persist"})
     * @ORM\JoinColumn(name="persona_proyecto_id", referencedColumnName="id")
     */
    private $personaProyecto;

    /**
     * @var ArrayCollection
     *
     * One Archivo has Many ArchivoHistorico.
     * @ORM\OneToMany(targetEntity="ArchivoHistorico", mappedBy="archivo")
     */
    private $archivoHistoricos;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="archivo_proyecto", fileNameProperty="nombre", mimeType="tipo")
     *
     * @var File
     */
    private $archivoFile;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct() {
        $this->archivoHistoricos = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Archivo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Archivo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @return Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param Estado $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return PersonaProyecto
     */
    public function getPersonaProyecto()
    {
        return $this->personaProyecto;
    }

    /**
     * @param PersonaProyecto $personaProyecto
     */
    public function setPersonaProyecto($personaProyecto)
    {
        $this->personaProyecto = $personaProyecto;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get proyecto
     *
     * @return Proyecto
     */
    public function getProyecto()
    {
        return $this->personaProyecto->getProyecto();
    }

    /**
     * Get persona
     *
     * @return Persona
     */
    public function getPersona()
    {
        return $this->personaProyecto->getPersona();
    }

    /**
     * @return ArrayCollection
     */
    public function getArchivoHistoricos()
    {
        return $this->archivoHistoricos;
    }

    /**
     * @param ArrayCollection $archivoHistoricos
     */
    public function setArchivoHistoricos($archivoHistoricos)
    {
        $this->archivoHistoricos = $archivoHistoricos;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setArchivoFile(File $archivo = null)
    {
        $this->archivoFile = $archivo;

        if ($archivo) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getArchivoFile()
    {
        return $this->archivoFile;
    }
}

