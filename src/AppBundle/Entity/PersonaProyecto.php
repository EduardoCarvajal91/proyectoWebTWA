<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PersonaProyecto
 *
 * @ORM\Table(name="persona_proyecto",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="search_idx", columns={"persona_id", "proyecto_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaProyectoRepository")
 */
class PersonaProyecto
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
     * @var Persona
     * Many PersonaProyecto have One Persona.
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="personaProyectos")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     */
    private $persona;

    /**
     * @var Proyecto
     *
     * Many PersonaProyecto have One Proyecto.
     * @ORM\ManyToOne(targetEntity="Proyecto", inversedBy="personaProyectos")
     * @ORM\JoinColumn(name="proyecto_id", referencedColumnName="id")
     */
    private $proyecto;

    /**
     * @var Rol
     *
     * Many PersonaProyecto have One Rol.
     * @ORM\ManyToOne(targetEntity="Rol")
     * @ORM\JoinColumn(name="rol_id", referencedColumnName="id")
     */
    private $rol;

    /**
     * @var ArrayCollection
     *
     * One PersonaProyecto has Many Archivo.
     * @ORM\OneToMany(targetEntity="Archivo", mappedBy="personaProyecto")
     */
    private $archivos;

    public function __construct() {
        $this->archivos = new ArrayCollection();
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
     * @return Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * @param Persona $persona
     */
    public function setPersona($persona)
    {
        $this->persona = $persona;
    }

    /**
     * @return Proyecto
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * @param Proyecto $proyecto
     */
    public function setProyecto($proyecto)
    {
        $this->proyecto = $proyecto;
    }

    /**
     * @return Rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param Rol $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return ArrayCollection
     */
    public function getArchivos(): ArrayCollection
    {
        return $this->archivos;
    }


}

