<?php

declare(strict_types=1);

namespace app\controllers;

use app\Core\AbstractController;
use app\Core\EntityManager;
use app\Entity\AlumnoEntity;
use app\Entity\IntentosEntity;
use app\Entity\NivelEntity;
use app\Entity\OperacionesEntity;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OperacionesController extends AbstractController
{
    public function sumar(): void
    {
        $entityManager = (new EntityManager)->getEntityManager();
        if (count($_POST) > 0) {
            $repositoryAlumno = $entityManager->getRepository(AlumnoEntity::class);
            $numero1 = $_POST['numero1'];
            $numero2 = $_POST['numero2'];
            $nombre = $_POST['name'];
            $firstSurname = $_POST['firstSurname'];
            $secondSurname = (isset($_POST['secondSurname']) || !empty($_POST['secondSurname'])) ? $_POST['secondSurname'] : null;
            $resultado = intval($_POST['resultado']);

            $alumno = [$repositoryAlumno->findOneBy(['nombreAlumno' => $nombre, 'primerApellidoAlumno' => $firstSurname, 'segundoApellidoAlumno' => $secondSurname])];
            $suma = $numero1 + $numero2;

            $repositoryOperacion = $entityManager->getRepository(OperacionesEntity::class);
            $operacion = $repositoryOperacion->findOneBy(['idOperacion' => '1']);
            //dump($alumno);
            $validate = ($suma === $resultado) ? 1 : 0;
            if (!is_null($alumno[0])) {
                $idAlumno = $alumno[0]->getIdAlumno();
                $newIntento = new IntentosEntity();
                $newIntento->setOperacion($operacion);
                $newIntento->setAlumno($alumno[0]);
                $newIntento->setResultado($validate);
                $entityManager->persist($newIntento);

                $repositoryNivel = $entityManager->getRepository(NivelEntity::class);
                $nivel = $repositoryNivel->findOneBy(['operacion' => 1, 'alumno' => $idAlumno]);
                if (!is_null($nivel)) {
                    $aciertosNivel = $nivel->getAciertos();
                    $fallosNivel = $nivel->getFallos();
                    $aciertos = ($validate == 1) ? $aciertosNivel + 1 : $aciertosNivel;
                    $fallos = ($validate == 1) ? $fallosNivel : $fallosNivel+1;
                } else {
                    $nivel = new NivelEntity();
                    $aciertos = ($validate == 1) ? 1 : 0;
                    $fallos = ($validate == 1) ? 0 : 1;
                }
                $nivel->setAlumno($alumno[0]);
                $nivel->setOperacion($operacion);
                $nivel->setAciertos($aciertos);
                $nivel->setFallos($fallos);

                $entityManager->persist($nivel);
                $entityManager->flush();

                $rutaDestino = '/sumar';  // Reemplaza con tu ruta real
                $response = new RedirectResponse($rutaDestino);
                $response->send();
            } else {
                $repositoryAlumno = $entityManager->getRepository(AlumnoEntity::class);
                $newAlumno = new AlumnoEntity();
                $newAlumno->setNombreAlumno($nombre);
                $newAlumno->setPrimerApellidoAlumno($firstSurname);
                $newAlumno->setSegundoApellidoAlumno($secondSurname);
                $entityManager->persist($newAlumno);

                $newIntento = new IntentosEntity();
                $newIntento->setOperacion($operacion);
                $newIntento->setAlumno($newAlumno);
                $newIntento->setResultado($validate);
                $entityManager->persist($newIntento);

                $newNivel = new NivelEntity();
                $newNivel->setAlumno($newAlumno);
                $newNivel->setOperacion($operacion);
                $aciertos = ($validate == 1) ? 1 : 0;
                $fallos = ($validate == 1) ? 0 : 1;
                $newNivel->setAciertos($aciertos);
                $newNivel->setFallos($fallos);

                $entityManager->persist($newNivel);
                $entityManager->flush();

                $rutaDestino = '/sumar';  // Reemplaza con tu ruta real
                $response = new RedirectResponse($rutaDestino);
                $response->send();
            }
        } else {
            $numero1 = random_int(1, 10);
            $numero2 = random_int(1, 10);
            $data = null;
            $this->render(
                "operaciones.html.twig",
                //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
                [
                    'numero1' => $numero1,
                    'numero2' => $numero2,
                    'operacion' => ' + ',
                    'title' => 'Sumar',
                    'title1' => 'Sumar',
                    'resultados' => $data
                ]
            );
        }
    }

    public function restar(): void
    {
        $entityManager = (new EntityManager)->getEntityManager();
        if (count($_POST) > 0) {
            $repositoryAlumno = $entityManager->getRepository(AlumnoEntity::class);
            $numero1 = $_POST['numero1'];
            $numero2 = $_POST['numero2'];
            $nombre = $_POST['name'];
            $firstSurname = $_POST['firstSurname'];
            $secondSurname = (isset($_POST['secondSurname']) || !empty($_POST['secondSurname'])) ? $_POST['secondSurname'] : null;
            $resultado = intval($_POST['resultado']);

            $alumno = [$repositoryAlumno->findOneBy(['nombreAlumno' => $nombre, 'primerApellidoAlumno' => $firstSurname, 'segundoApellidoAlumno' => $secondSurname])];
            $resta = $numero1 - $numero2;

            $repositoryOperacion = $entityManager->getRepository(OperacionesEntity::class);
            $operacion = $repositoryOperacion->findOneBy(['idOperacion' => '2']);
            $validate = ($resta === $resultado) ? 1 : 0;
            if (!is_null($alumno[0])) {
                $idAlumno = $alumno[0]->getIdAlumno();
                $newIntento = new IntentosEntity();
                $newIntento->setOperacion($operacion);
                $newIntento->setAlumno($alumno[0]);
                $newIntento->setResultado($validate);
                $entityManager->persist($newIntento);

                $repositoryNivel = $entityManager->getRepository(NivelEntity::class);
                $nivel = $repositoryNivel->findOneBy(['operacion' => 2, 'alumno' => $idAlumno]);
                dump($nivel);
                if (!is_null($nivel)) {
                    $aciertosNivel = $nivel->getAciertos();
                    $fallosNivel = $nivel->getFallos();
                    $aciertos = ($validate == 1) ? $aciertosNivel + 1 : $aciertosNivel;
                    $fallos = ($validate == 1) ? $fallosNivel  : $fallosNivel +1;
                } else {
                    $nivel = new NivelEntity();
                    $aciertos = ($validate == 1) ? 1 : 0;
                    $fallos = ($validate == 1) ? 0 : 1;
                }
                $nivel->setAlumno($alumno[0]);
                $nivel->setOperacion($operacion);
                $nivel->setAciertos($aciertos);
                $nivel->setFallos($fallos);

                $entityManager->persist($nivel);
                $entityManager->flush();

                $rutaDestino = '/restar';
                $response = new RedirectResponse($rutaDestino);
                $response->send();
            } else {
                $repositoryAlumno = $entityManager->getRepository(AlumnoEntity::class);
                $newAlumno = new AlumnoEntity();
                $newAlumno->setNombreAlumno($nombre);
                $newAlumno->setPrimerApellidoAlumno($firstSurname);
                $newAlumno->setSegundoApellidoAlumno($secondSurname);
                $entityManager->persist($newAlumno);

                $newIntento = new IntentosEntity();
                $newIntento->setOperacion($operacion);
                $newIntento->setAlumno($newAlumno);
                $newIntento->setResultado($validate);
                $entityManager->persist($newIntento);

                $newNivel = new NivelEntity();
                $newNivel->setAlumno($newAlumno);
                $newNivel->setOperacion($operacion);
                $aciertos = ($validate == 1) ? 1 : 0;
                $fallos = ($validate == 1) ? 0 : 1;
                $newNivel->setAciertos($aciertos);
                $newNivel->setFallos($fallos);

                $entityManager->persist($newNivel);
                $entityManager->flush();

                $rutaDestino = '/restar';  // Reemplaza con tu ruta real
                $response = new RedirectResponse($rutaDestino);
                $response->send();
            }
        } else {
            $numero1 = random_int(1, 10);
            $numero2 = random_int(1, 10);
            $data = null;
            $this->render(
                "operaciones.html.twig",
                //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
                [
                    'numero1' => $numero1,
                    'numero2' => $numero2,
                    'operacion' => ' - ',
                    'title' => 'Restar',
                    'title1' => 'Restar',
                    'resultados' => $data
                ]
            );
        }
    }

    public function multiplicar(): void
    {
        $entityManager = (new EntityManager)->getEntityManager();
        if (count($_POST) > 0) {
            $repositoryAlumno = $entityManager->getRepository(AlumnoEntity::class);
            $numero1 = $_POST['numero1'];
            $numero2 = $_POST['numero2'];
            $nombre = $_POST['name'];
            $firstSurname = $_POST['firstSurname'];
            $secondSurname = (isset($_POST['secondSurname']) || !empty($_POST['secondSurname'])) ? $_POST['secondSurname'] : null;
            $resultado = intval($_POST['resultado']);

            $alumno = [$repositoryAlumno->findOneBy(['nombreAlumno' => $nombre, 'primerApellidoAlumno' => $firstSurname, 'segundoApellidoAlumno' => $secondSurname])];
            $multiplicacion = $numero1 * $numero2;

            $repositoryOperacion = $entityManager->getRepository(OperacionesEntity::class);
            $operacion = $repositoryOperacion->findOneBy(['idOperacion' => '3']);
            $validate = ($multiplicacion === $resultado) ? 1 : 0;
            if (!is_null($alumno[0])) {
                $idAlumno = $alumno[0]->getIdAlumno();
                $newIntento = new IntentosEntity();
                $newIntento->setOperacion($operacion);
                $newIntento->setAlumno($alumno[0]);
                $newIntento->setResultado($validate);
                $entityManager->persist($newIntento);

                $repositoryNivel = $entityManager->getRepository(NivelEntity::class);
                $nivel = $repositoryNivel->findOneBy(['operacion' => 3, 'alumno' => $idAlumno]);
                dump($nivel);
                if (!is_null($nivel)) {
                    $aciertosNivel = $nivel->getAciertos();
                    $fallosNivel = $nivel->getFallos();
                    $aciertos = ($validate == 1) ? $aciertosNivel + 1 : $aciertosNivel;
                    $fallos = ($validate == 1) ? $fallosNivel : $fallosNivel +1;
                } else {
                    $nivel = new NivelEntity();
                    $aciertos = ($validate == 1) ? 1 : 0;
                    $fallos = ($validate == 1) ? 0 : 1;
                }
                $nivel->setAlumno($alumno[0]);
                $nivel->setOperacion($operacion);
                $nivel->setAciertos($aciertos);
                $nivel->setFallos($fallos);

                $entityManager->persist($nivel);
                $entityManager->flush();

                $rutaDestino = '/multiplicar';
                $response = new RedirectResponse($rutaDestino);
                $response->send();
            } else {
                $repositoryAlumno = $entityManager->getRepository(AlumnoEntity::class);
                $newAlumno = new AlumnoEntity();
                $newAlumno->setNombreAlumno($nombre);
                $newAlumno->setPrimerApellidoAlumno($firstSurname);
                $newAlumno->setSegundoApellidoAlumno($secondSurname);
                $entityManager->persist($newAlumno);

                $newIntento = new IntentosEntity();
                $newIntento->setOperacion($operacion);
                $newIntento->setAlumno($newAlumno);
                $newIntento->setResultado($validate);
                $entityManager->persist($newIntento);

                $newNivel = new NivelEntity();
                $newNivel->setAlumno($newAlumno);
                $newNivel->setOperacion($operacion);
                $aciertos = ($validate == 1) ? 1 : 0;
                $fallos = ($validate == 1) ? 0 : 1;
                $newNivel->setAciertos($aciertos);
                $newNivel->setFallos($fallos);

                $entityManager->persist($newNivel);
                $entityManager->flush();

                $rutaDestino = '/multiplicar';  // Reemplaza con tu ruta real
                $response = new RedirectResponse($rutaDestino);
                $response->send();
            }
        } else {
            $numero1 = random_int(1, 10);
            $numero2 = random_int(1, 10);
            $data = null;
            $this->render(
                "operaciones.html.twig",
                //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
                [
                    'numero1' => $numero1,
                    'numero2' => $numero2,
                    'operacion' => ' * ',
                    'title' => 'Multiplicar',
                    'title1' => 'Multiplicar',
                    'resultados' => $data
                ]
            );
        }
    }

    public function dividir(): void
    {
        $entityManager = (new EntityManager)->getEntityManager();
        if (count($_POST) > 0) {
            $repositoryAlumno = $entityManager->getRepository(AlumnoEntity::class);
            $numero1 = $_POST['numero1'];
            $numero2 = $_POST['numero2'];
            $nombre = $_POST['name'];
            $firstSurname = $_POST['firstSurname'];
            $secondSurname = (isset($_POST['secondSurname']) || !empty($_POST['secondSurname'])) ? $_POST['secondSurname'] : null;
            $resultadoCociente = intval($_POST['resultado']);
            $resultadoResto=intval($_POST['resto']);
            $alumno = [$repositoryAlumno->findOneBy(['nombreAlumno' => $nombre, 'primerApellidoAlumno' => $firstSurname, 'segundoApellidoAlumno' => $secondSurname])];
            $cociente = floor($numero1 / $numero2);
            dump($cociente);
            $resto=$numero1%$numero2;
            dump($resto);

            $repositoryOperacion = $entityManager->getRepository(OperacionesEntity::class);
            $operacion = $repositoryOperacion->findOneBy(['idOperacion' => '4']);
            $validate = ($resultadoCociente ===intval($cociente) && $resultadoResto==$resto) ? 1 : 0;
            if (!is_null($alumno[0])) {
                $idAlumno = $alumno[0]->getIdAlumno();
                $newIntento = new IntentosEntity();
                $newIntento->setOperacion($operacion);
                $newIntento->setAlumno($alumno[0]);
                $newIntento->setResultado($validate);
                $entityManager->persist($newIntento);

                $repositoryNivel = $entityManager->getRepository(NivelEntity::class);
                $nivel = $repositoryNivel->findOneBy(['operacion' => 4, 'alumno' => $idAlumno]);
                dump($nivel);
                if (!is_null($nivel)) {
                    $aciertosNivel = $nivel->getAciertos();
                    $fallosNivel = $nivel->getFallos();
                    $aciertos = ($validate == 1) ? $aciertosNivel + 1 : $aciertosNivel;
                    $fallos = ($validate == 1) ? $fallosNivel : $fallosNivel +1;
                } else {
                    $nivel = new NivelEntity();
                    $aciertos = ($validate == 1) ? 1 : 0;
                    $fallos = ($validate == 1) ? 0 : 1;
                }
                $nivel->setAlumno($alumno[0]);
                $nivel->setOperacion($operacion);
                $nivel->setAciertos($aciertos);
                $nivel->setFallos($fallos);

                $entityManager->persist($nivel);
                $entityManager->flush();

                $rutaDestino = '/dividir';
                $response = new RedirectResponse($rutaDestino);
                $response->send();
            } else {
                $repositoryAlumno = $entityManager->getRepository(AlumnoEntity::class);
                $newAlumno = new AlumnoEntity();
                $newAlumno->setNombreAlumno($nombre);
                $newAlumno->setPrimerApellidoAlumno($firstSurname);
                $newAlumno->setSegundoApellidoAlumno($secondSurname);
                $entityManager->persist($newAlumno);

                $newIntento = new IntentosEntity();
                $newIntento->setOperacion($operacion);
                $newIntento->setAlumno($newAlumno);
                $newIntento->setResultado($validate);
                $entityManager->persist($newIntento);

                $newNivel = new NivelEntity();
                $newNivel->setAlumno($newAlumno);
                $newNivel->setOperacion($operacion);
                $aciertos = ($validate == 1) ? 1 : 0;
                $fallos = ($validate == 1) ? 0 : 1;
                $newNivel->setAciertos($aciertos);
                $newNivel->setFallos($fallos);

                $entityManager->persist($newNivel);
                $entityManager->flush();

                $rutaDestino = '/dividir';  // Reemplaza con tu ruta real
                $response = new RedirectResponse($rutaDestino);
                $response->send();
            }
        } else {
            $numero1 = random_int(1, 10);
            $numero2 = random_int(1, 10);
            while($numero1<$numero2){
                $numero1 = random_int(1, 10);
            }        
            
            $data = null;
            $this->render(
                "operaciones.html.twig",
                //-- Le pasamos al renderizado los parámetros, que son todos los datos que hemos obtenido del modelo.
                [
                    'op'=>'division',
                    'numero1' => $numero1,
                    'numero2' => $numero2,
                    'operacion' => ' / ',
                    'title' => 'Dividir',
                    'title1' => 'Dividir',
                    'resultados' => $data
                ]
            );
        }
    }
}

