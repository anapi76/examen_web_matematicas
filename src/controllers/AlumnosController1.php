<?php

declare(strict_types=1);

namespace app\controllers;

use app\Core\AbstractController;
use app\Core\EntityManager;
use app\Entity\AlumnoEntity;
use app\Entity\NivelEntity;

class AlumnosController extends AbstractController
{
    public function listaAlumnos(): void
    {
    
        if (count($_POST) > 0) {
            $entityManager = (new EntityManager)->getEntityManager();
            $repository = $entityManager->getRepository(AlumnoEntity::class);
            $nombre = $_POST['name'];
            $firstSurname = $_POST['firstSurname'];
            $secondSurname = (isset($_POST['secondSurname']) || !empty($_POST['secondSurname'])) ? $_POST['secondSurname'] : null;
            $alumno = [$repository->findOneBy(['nombreAlumno' => $nombre, 'primerApellidoAlumno' => $firstSurname, 'segundoApellidoAlumno' => $secondSurname])];

            if (!is_null($alumno[0])) {
                $niveles = $alumno[0]->getNiveles();
                if (count($niveles) > 0) {
                    $niveles = $alumno[0]->getNiveles();
                } else {
                    $niveles = null;
                }
                dump($niveles);
                    $this->render(
                        "listaAlumnos.html.twig",
                        //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
                        [
                            'resultados' => $alumno,
                            'niveles'=>$niveles
                        ]
                    );
                }
             else {
                $entityManager = (new EntityManager)->getEntityManager();
                $repository = $entityManager->getRepository(AlumnoEntity::class);
                $data = $repository->findAll();
                $this->render(
                    "listaAlumnos.html.twig",
                    //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
                    [
                        'title' => 'Lista de Alumnos',
                        'title1' => 'Lista de Alumnos',
                        'resultados' => $data
                    ]
                );
            }
        } else {
            $this->render(
                "listaAlumnos.html.twig",
                //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
                [
                    'resultados' => null
                ]
            );
        }
    }
}
