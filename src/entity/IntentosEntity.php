<?php
declare(strict_types=1);

namespace app\Entity;

use app\Repository\IntentosRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity(repositoryClass: IntentosRepository::class )]
#[Table(name: 'intentos')]
class IntentosEntity{

    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id_intentos', type:'integer')]
    private int $idIntento;

    #[ManyToOne(targetEntity: OperacionesEntity::class)]
    #[JoinColumn(name: 'id_operacion', referencedColumnName: 'id_operacion')]
    private OperacionesEntity $operacion;

    #[ManyToOne(targetEntity: AlumnoEntity::class)]
    #[JoinColumn(name: 'id_alumno', referencedColumnName: 'id_alumno')]
    private AlumnoEntity $alumno;
    
    #[Column(name: 'resultado', type: 'integer')]
    private int $resultado;


    /**
     * Get the value of idIntento
     */
    public function getIdIntento(): int
    {
        return $this->idIntento;
    }

    /**
     * Get the value of idOperacion
     */
    public function getOperacion(): OperacionesEntity
    {
        return $this->operacion;
    }

    /**
     * Set the value of idOperacion
     */
    public function setOperacion(OperacionesEntity $operacion):void
    {
        $this->operacion = $operacion;
    }

    /**
     * Get the value of idAlumno
     */
    public function getAlumno(): AlumnoEntity
    {
        return $this->alumno;
    }

    /**
     * Set the value of idAlumno
     */
    public function setAlumno(AlumnoEntity $alumno): void
    {
        $this->alumno = $alumno;
    }

    /**
     * Get the value of resultado
     */
    public function getResultado(): int
    {
        return $this->resultado;
    }

    /**
     * Set the value of resultado
     */
    public function setResultado(int $resultado): void
    {
        $this->resultado = $resultado;
    }
}