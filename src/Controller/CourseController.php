<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Course;

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
        $course = $this->getDoctrine()->getRepository(Course::class)->find($courseId);
        
        return $this->json([
            'data' => $course
        ]);

    }

     /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $dados = $request->request->all();

        $course = new Course();
        
        $course->setName($dados['name']);
        $course->setDescription($dados['description']);
        $course->setSlug($dados['slug']);
        $course->setCreatedAt(new \DateTime('now', new \DateTimezone('America/Recife')));
        $course->setUpdatedAt(new \DateTime('now', new \DateTimezone('America/Recife')));
        
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->persist($course);
        $doctrine->flush();

        return $this->json($dados);
    }

     /**
     * @Route("/{courseId}", name="update", methods={"PUT", "PATCH"})
     */
    
     // PUT atualiza tudo, PATCH atualiza alguns campos

    public function update($courseId, Request $request)
    {
        $dados = $request->request->all();

        $course = $this->getDoctrine()->getRepository(Course::class)->find($courseId);
        
        if ($request->request->has('name'))
            $course->setName($dados['name']);
        
        if ($request->request->has('description'))    
            $course->setDescription($dados['description']);
         
        if ($request->request->has('slug'))    
            $course->setSlug($dados['slug']);

        $course->setUpdatedAt(new \DateTime('now', new \DateTimezone('America/Recife')));
        
        $doctrine = $this->getDoctrine()->getManager();        
        $doctrine->flush();

        return $this->json($dados);
    }

     /**
     * @Route("/{courseId}", name="delete", methods={"DELETE"})
     */
    public function delete($courseId)
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($courseId);
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->remove($course);
        $doctrine->flush();
        
        return $this->json([
            'data' => 'Curso Removido'
        ]);
    }


}
