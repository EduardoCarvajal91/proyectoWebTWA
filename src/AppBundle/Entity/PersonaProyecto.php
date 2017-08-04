<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * Many PersonaProyecto have One Persona.
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="personaProyectos")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     */
    private $persona;

    /**
     * Many PersonaProyecto have One Proyecto.
     * @ORM\ManyToOne(targetEntity="Proyecto", inversedBy="personaProyectos")
     * @ORM\JoinColumn(name="proyecto_id", referencedColumnName="id")
     */
    private $proyecto;

    /**
     * Many PersonaProyecto have One Rol.
     * @ORM\ManyToOne(targetEntity="Rol")
     * @ORM\JoinColumn(name="rol_id", referencedColumnName="id")
     */
    private $rol;

    /**
     * One PersonaProyecto has Many Archivo.
     * @ORM\OneToMany(targetEntity="Archivo", mappedBy="personaProyecto")
     */
    private $archivos;


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
     * @return mixed
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * @param mixed $persona
     */
    public function setPersona($persona)
    {
        $this->persona = $persona;
    }

    /**
     * @return mixed
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * @param mixed $proyecto
     */
    public function setProyecto($proyecto)
    {
        $this->proyecto = $proyecto;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }


}

