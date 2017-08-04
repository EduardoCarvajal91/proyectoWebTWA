<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 03-08-2017
 * Time: 19:38
 */

namespace AppBundle\Service;

use AppBundle\Entity\Archivo;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

class ArchivoService implements DirectoryNamerInterface
{
    /**
     * Get directory name
     *
     * @param Archivo $archivo
     * @param PropertyMapping $mapping
     *
     * @return string
     */
    public function directoryName($archivo, PropertyMapping $mapping)
    {
        return '\archivos\\'.$archivo->getProyecto()->getId();
    }
}