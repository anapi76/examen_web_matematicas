<?php
declare(strict_types=1);

namespace app\Entity;

use app\Repository\IntentosRepository;
use app\Repository\OperacionesRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity(repositoryClass: OperacionesRepository::class )]
#[Table(name: 'operaciones')]
class OperacionesEntity{

    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id_operacion', type:'integer')]
    private int $idOperacion;

    #[Column(name: 'nombre_operacion', type: 'string', length: 255)]
    private string $nombreOperacion;


    /**
     * Get the value of idOperacion
     */
    public function getIdOperacion(): int
    {
        return $this->idOperacion;
    }

    /**
     * Get the value of nombreOperacion
     */
    public function getNombreOperacion(): string
    {
        return $this->nombreOperacion;
    }

    /**
     * Set the value of nombreOperacion
     */
    public function setNombreOperacion(string $nombreOperacion):void
    {
        $this->nombreOperacion = $nombreOperacion;
    }
}