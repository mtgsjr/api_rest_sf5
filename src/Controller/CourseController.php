<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/course", name="course_")
 */
class CourseController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */

    // Vai listar Tudo
    public function index(): Response
    {
        $courses = $this->getDoctrine()->getRepository(Course::class)->findAll();

        return $this->json([
            'data' => $courses
        ]);
    }
    /**
     * @Route("/{courseId}", name="show", methods={"GET"})
     */

    // Vai listar apenas um
    public function show($courseId)
    {

    }

     /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create()
    {
        
    }

     /**
     * @Route("/{courseId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($courseId)
    {
        
    }

     /**
     * @Route("/{courseId}", name="delete", methods={"DELETE"})
     */
    public function delete($courseId)
    {
        
    }


}
