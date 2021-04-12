<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogDeleteType;
use App\Form\BlogType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_index', methods: ['GET'])]
    public function index(): Response
    {
        $blogRepository = $this->getDoctrine()->getRepository(Blog::class);
        $blogs = $blogRepository->getBlogs();

        return $this->render('blog/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }

    #[Route('/blog/{id}', name: 'blog_detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function detail($id): Response
    {
        $blogRepository = $this->getDoctrine()->getRepository(Blog::class);
        $blog = $blogRepository->getBlogById($id);

        return $this->render('blog/detail.html.twig', [
            'blog' => $blog,
            'isAuthor' => $blog->getCreatedBy() === $this->getUser()
        ]);
    }

    #[Route('/blog/create', name: 'blog_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $user = $this->getUser();
        $blog = new Blog($user);
        $form = $this->createForm(BlogType::class, $blog);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $blogRepository = $this->getDoctrine()->getRepository(Blog::class);
            $blogRepository->save($blog);
            $this->addFlash('notice', 'Your blog entry was created!');

            return $this->redirectToRoute('blog_detail', ['id' => $blog->getId()]);
        }

        return $this->render('blog/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/blog/{id}/edit', name: 'blog_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, $id): Response
    {
        $blogRepository = $this->getDoctrine()->getRepository(Blog::class);
        $blog = $blogRepository->getBlogById($id);

        $this->denyAccessUnlessGranted('blog_edit', $blog);

        // Create delete form
        $formDelete = $this->createForm(
            BlogDeleteType::class, $blog,
            [ 'action_url' => $this->generateUrl('blog_delete', array('id' => $id)) ]
        );

        // Handle edit functionality
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $blogRepository->save($blog);
            $this->addFlash('notice', 'Your blog was saved!');

            return $this->redirectToRoute('blog_detail', ['id' => $blog->getId()]);
        }

        return $this->render('blog/edit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
            'form_delete' => $formDelete->createView(),
        ]);
    }

    #[Route('/blog/{id}/delete', name: 'blog_delete', methods: ['DELETE'])]
    public function delete($id): Response
    {
        $blogRepository = $this->getDoctrine()->getRepository(Blog::class);
        $blog = $blogRepository->getBlogById($id);

        $this->denyAccessUnlessGranted('blog_delete', $blog);

        $blogRepository->delete($blog);
        $this->addFlash('notice', 'Your blog was deleted!');

        return $this->redirectToRoute('blog_index');
    }
}
