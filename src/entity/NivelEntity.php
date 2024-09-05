<?php
declare(strict_types=1);

namespace app\Entity;

use app\Repository\NivelRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: NivelRepository::class )]
#[Table(name: 'nivel')]
class NivelEntity{

    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id_nivel', type:'integer')]
    private int $idNivel;

    #[ManyToOne(targetEntity: AlumnoEntity::class, inversedBy:'niveles')]
    #[JoinColumn(name: 'id_alumno', referencedColumnName: 'id_alumno')]
    private AlumnoEntity $alumno;

    #[ManyToOne(targetEntity: OperacionesEntity::class,inversedBy:'niveles')]
    #[JoinColumn(name: 'id_operacion', referencedColumnName: 'id_operacion')]
    private OperacionesEntity $operacion;

    #[Column(name: 'numero_fallos', type: 'integer')]
    private int $fallos;

    #[Column(name: 'numero_aciertos', type: 'integer')]
    private int $aciertos;

    /**
     * Get the value of idNivel
     */
    public function getIdNivel(): int
    {
        return $this->idNivel;
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
     * Get the value of fallos
     */
    public function getFallos(): int
    {
        return $this->fallos;
    }

    /**
     * Set the value of fallos
     */
    public function setFallos(int $fallos): void
    {
        $this->fallos = $fallos;
    }

    /**
     * Get the value of aciertos
     */
    public function getAciertos(): int
    {
        return $this->aciertos;
    }

    /**
     * Set the value of aciertos
     */
    public function setAciertos(int $aciertos):void
    {
        $this->aciertos = $aciertos;
    }

    /**
     * Get the value of operaciones
     */
    public function getOperacion(): OperacionesEntity
    {
        return $this->operacion;
    }

    /**
     * Set the value of operaciones
     */
    public function setOperacion(OperacionesEntity $operacion): void
    {
        $this->operacion = $operacion;
    }
}