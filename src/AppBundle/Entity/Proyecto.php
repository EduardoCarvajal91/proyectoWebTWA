<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Proyecto
 *
 * @ORM\Table(name="proyecto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProyectoRepository")
 */
class Proyecto
{
    /**
     * One Proyecto has Many PersonaProyecto.
     * @ORM\OneToMany(targetEntity="PersonaProyecto", mappedBy="proyecto", cascade={"all"})
     */
    private $personaProyectos;

    private $personas;

    public function __construct() {
        $this->personaProyectos = new ArrayCollection();
        $this->personas = new ArrayCollection();
    }

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
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date")
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="termino", type="date")
     */
    private $termino;


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
     * @return Proyecto
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
     * Set inicio
     *
     * @param \DateTime $inicio
     *
     * @return Proyecto
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;

        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set termino
     *
     * @param \DateTime $termino
     *
     * @return Proyecto
     */
    public function setTermino($termino)
    {
        $this->termino = $termino;

        return $this;
    }

    /**
     * Get termino
     *
     * @return \DateTime
     */
    public function getTermino()
    {
        return $this->termino;
    }

    // Important
    /**
     * Get personas
     *
     * @return mixed
     */
    public function getPersonas()
    {
        $this->personas = new ArrayCollection();

        foreach($this->personaProyectos as $pp)
        {
            $this->personas[] = $pp->getPersona();
        }

        return $this->personas;
    }

    /**
     * Set personas
     *
     * @param mixed $personas
     */
    public function setPersonas($personas)
    {
        foreach($personas as $persona)
        {
            $personaProyecto = new PersonaProyecto();

            $personaProyecto->setPersona($persona);
            $personaProyecto->setProyecto($this);
            $personaProyecto->setRol($persona->getRol());

            $this->addPersonaProyecto($personaProyecto);
        }
    }

    /**
     * Add one PersonaProyecto
     *
     * @param mixed $personaProyecto
     */
    private function addPersonaProyecto($personaProyecto)
    {
        $this->personaProyectos[] = $personaProyecto;
    }
}

