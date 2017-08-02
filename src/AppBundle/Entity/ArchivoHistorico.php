<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArchivoHistorico
 *
 * Un archivo puede pasar solo por un estado?
 * @ORM\Table(name="archivo_historico",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="search_idx", columns={"archivo_id", "estado_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArchivoHistoricoRepository")
 */
class ArchivoHistorico
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
     * Many ArchivoHistorico have one Archivo.
     * @ORM\ManyToOne(targetEntity="Archivo", inversedBy="archivoHistoricos")
     * @ORM\JoinColumn(name="archivo_id", referencedColumnName="id")
     */
    private $archivo;

    /**
     * Many ArchivoHistorico have one Estado.
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;


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
     * Set archivo
     *
     * @param string $archivo
     *
     * @return ArchivoHistorico
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return ArchivoHistorico
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return ArchivoHistorico
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}

