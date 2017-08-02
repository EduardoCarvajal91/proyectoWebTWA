<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 24-07-2017
 * Time: 12:03
 */

// src/AppBundle/DataFixtures/ORM/LoadBaseData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Rol;
use AppBundle\Entity\Persona;
use AppBundle\Entity\Estado;

class LoadBaseData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $rolAdmin = new Rol();
        $rolAdmin->setNombre("Administrador");
        $rolAdmin->setNombreCodigo("ROLE_ADMIN");
        $manager->persist($rolAdmin);
        $manager->flush();

        $rol = new Rol();
        $rol->setNombre("Director");
        $rol->setNombreCodigo("ROLE_DIRECTOR");
        $manager->persist($rol);
        $manager->flush();

        $rol = new Rol();
        $rol->setNombre("Trabajador");
        $rol->setNombreCodigo("ROLE_TRABAJADOR");
        $manager->persist($rol);
        $manager->flush();

        $rol = new Rol();
        $rol->setNombre("Responsable Legal");
        $rol->setNombreCodigo("ROLE_RESPONSABLE_LEGAL");
        $manager->persist($rol);
        $manager->flush();

        $admin = new Persona();
        $admin->setRut('00');
        $admin->setNombre('admin');
        $admin->setPaterno('admin');
        $admin->setMaterno('admin');
        $nacimiento = '1970-01-01';
        $admin->setFechaNacimiento(new \DateTime($nacimiento));
        $admin->setEmail('admin@admin.com');
        $admin->setPassword('$2y$13$vSTki1ErJJ0qudjOswxCxOv4P4To906rqHv7A28qcUNYl5.Wa5TUO');//admin
        $admin->setRol($rolAdmin);
        $manager->persist($admin);
        $manager->flush();

        $estado = new Estado();
        $estado->setNombre('Borrador');
        $manager->persist($estado);
        $manager->flush();
        $estado = new Estado();
        $estado->setNombre('Publicado');
        $manager->persist($estado);
        $manager->flush();
        $estado = new Estado();
        $estado->setNombre('Eliminado');
        $manager->persist($estado);
        $manager->flush();

    }
}