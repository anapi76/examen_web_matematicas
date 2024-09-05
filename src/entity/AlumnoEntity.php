<?php

declare(strict_types=1);

namespace app\Entity;

use app\Repository\AlumnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity(repositoryClass: AlumnoRepository::class )]
#[Table(name: 'alumno')]
class AlumnoEntity
{
    #[Id]
    #[GeneratedValue]
    #[Column(name: 'id_alumno', type:'integer')]
    private int $idAlumno;

    #[Column(name: 'nombre_alumno', type: 'string', length: 50)]
    private string $nombreAlumno;

    #[Column(name: 'primer_apellido_alumno', type: 'string', length: 100)]
    private string $primerApellidoAlumno;

    #[Column(name: 'segundo_apellido_alumno', type: 'string', length: 100, nullable:true)]
    private ?string $segundoApellidoAlumno;

    #[OneToMany(targetEntity: NivelEntity::class, mappedBy: 'alumno')]
    private Collection $niveles;

    #[OneToMany(targetEntity:IntentosEntity::class, mappedBy: 'alumno')]
    private Collection $intentos; 

    public function __construct() {
        $this->niveles = new ArrayCollection();
        $this->intentos = new ArrayCollection();
    }

    /**
     * Get the value of idAlumno
     */
    public function getIdAlumno(): int
    {
        return $this->idAlumno;

    }

    /**
     * Get the value of nombreAlumno
     */
    public function getNombreAlumno(): string
    {
        return $this->nombreAlumno;
    }

    /**
     * Set the value of nombreAlumno
     */
    public function setNombreAlumno(string $nombreAlumno): void
    {
        $this->nombreAlumno = $nombreAlumno;
    }

    /**
     * Get the value of primerApellidoAlumno
     */
    public function getPrimerApellidoAlumno(): string
    {
        return $this->primerApellidoAlumno;
    }

    /**
     * Set the value of primerApellidoAlumno
     */
    public function setPrimerApellidoAlumno(string $primerApellidoAlumno): void
    {
        $this->primerApellidoAlumno = $primerApellidoAlumno;
    }

    /**
     * Get the value of segundoApellidoAlumno
     */
    public function getSegundoApellidoAlumno(): ?string
    {
        return $this->segundoApellidoAlumno;
    }

    /**
     * Set the value of segundoApellidoAlumno
     */
    public function setSegundoApellidoAlumno(?string $segundoApellidoAlumno): void
    {
        $this->segundoApellidoAlumno = $segundoApellidoAlumno;
    }

    /**
     * Get the value of niveles
     */
    public function getNiveles(): Collection
    {
        return $this->niveles;
    }

    /**
     * Set the value of niveles
     */
    public function setNiveles(Collection $niveles): void
    {
        $this->niveles = $niveles;
    }

        /**
     * Get the value of intentos
     */
    public function getIntentos(): Collection
    {
        return $this->intentos;
    } 

    /**
     * Set the value of intentos
     */
    public function setIntentos(Collection $intentos): void
    {
        $this->intentos = $intentos;
    } 
}
