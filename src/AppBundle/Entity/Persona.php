<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaRepository")
 * @UniqueEntity(fields="email", message="El email ya está siendo usado")
 * @UniqueEntity(fields="rut", message="El RUT ya está siendo usado")
 */
class Persona implements UserInterface
{
    /**
     * One Persona has Many PersonaProyecto.
     * @ORM\OneToMany(targetEntity="PersonaProyecto", mappedBy="persona", cascade={"all"})
     */
    private $personaProyectos;
    private $proyectos;

    public function __construct() {
        $this->personaProyectos = new ArrayCollection();
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
     * @ORM\Column(name="rut", type="string", length=9, unique=true)
     * @Assert\NotBlank()
     */
    private $rut;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=64)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="paterno", type="string", length=64)
     * @Assert\NotBlank()
     */
    private $paterno;

    /**
     * @var string
     *
     * @ORM\Column(name="materno", type="string", length=64)
     * @Assert\NotBlank()
     */
    private $materno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date")
     * @Assert\NotBlank()
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * Many Persona have One Rol.
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="personas")
     * @ORM\JoinColumn(name="rol_id", referencedColumnName="id")
     */
    private $rol;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;


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
     * Set rut
     *
     * @param string $rut
     *
     * @return Persona
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return string
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Persona
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
     * Set paterno
     *
     * @param string $paterno
     *
     * @return Persona
     */
    public function setPaterno($paterno)
    {
        $this->paterno = $paterno;

        return $this;
    }

    /**
     * Get paterno
     *
     * @return string
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Set materno
     *
     * @param string $materno
     *
     * @return Persona
     */
    public function setMaterno($materno)
    {
        $this->materno = $materno;

        return $this;
    }

    /**
     * Get materno
     *
     * @return string
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Persona
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Persona
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * Get proyectos
     *
     * @return mixed
     */
    public function getProyectos()
    {
        $this->proyectos = new ArrayCollection();

        foreach($this->personaProyectos as $pp)
        {
            $this->proyectos[] = $pp->getProyecto();
        }

        return $this->proyectos;
    }

    /**
     * Set proyectos
     *
     * @param mixed $proyectos
     */
    public function setProyectos($proyectos)
    {
        foreach($proyectos as $proyecto)
        {
            $personaProyecto = new PersonaProyecto();

            $personaProyecto->setPersona($this);
            $personaProyecto->setProyecto($proyecto);
            $personaProyecto->setRol($this->rol);

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

    //UserInterface implemented methods
    public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function  getUsername()
    {
        return $this->rut;
    }

    public function getRoles()
    {
        return array($this->rol->getNombreCodigo());
    }

    public function eraseCredentials()
    {
    }
}

