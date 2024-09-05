<?php

declare(strict_types=1);

namespace app\controllers;

use app\Core\AbstractController;
use app\Core\EntityManager;
use app\Entity\AlumnoEntity;

class AlumnosController extends AbstractController
{
    public function alumno(?string $id = null): void
    {
        $entityManager = (new EntityManager)->getEntityManager();
        $repository = $entityManager->getRepository(AlumnoEntity::class);
        if (!is_null($id)) {
            $alumno = $repository->findBy(['idAlumno' => intval($id)]);
        } else {
            if (count($_POST) > 0) {
                $nombre = $_POST['name'];
                $firstSurname = $_POST['firstSurname'];
                $secondSurname = (isset($_POST['secondSurname']) || !empty($_POST['secondSurname'])) ? $_POST['secondSurname'] : null;
                $alumno = [$repository->findOneBy(['nombreAlumno' => $nombre, 'primerApellidoAlumno' => $firstSurname, 'segundoApellidoAlumno' => $secondSurname])];
                if (is_null($alumno[0])) {
                    header('location:/listaAlumnos');
                }
            } else {
                $this->render(
                    "alumno.html.twig",
                    //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
                    [
                        'resultados' => null
                    ]
                );
            }
        }
        $niveles = $alumno[0]->getNiveles();
        if (count($niveles) > 0) {
            $niveles = $alumno[0]->getNiveles();
        } else {
            $niveles = null;
        }
        $this->render(
            "alumno.html.twig",
            //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
            [
                //'list' => 'one',
                'resultados' => $alumno,
                'niveles' => $niveles
            ]
        );
    }

    public function listaAlumnos(): void
    {
        $entityManager = (new EntityManager)->getEntityManager();
        $repository = $entityManager->getRepository(AlumnoEntity::class);
        $data = $repository->findAll();
        $this->render(
            "listaAlumnos.html.twig",
            //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
            [
                'list' => 'all',
                'title' => 'Lista de Alumnos',
                'title1' => 'Lista de Alumnos',
                'resultados' => $data
            ]
        );
    }
}
