<?php

namespace App\Controller;


use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Repository\PostRepository;

class WebController extends AbstractController {

    /**
     * @Route("/", name="home")
     */
    public function index() {

        return $this->render('web/index.html.twig', [
        ]);
    }

    /**
     * @Route("/actions", name="actions")
     */
    public function actions(Request $request) {
        $webPath = $this->getParameter('kernel.project_dir');
        $file = 'value.json';
        $content = file_get_contents($webPath . '/public/publicassets/json/' . $file);
        $value_array = json_decode($content, true);

        return $this->render('web/api.html.twig', [
                    'value' => $value_array
        ]);
    }

    /**
     * @Route("/post/list", name="post_list")
     */
    public function posts(PostRepository $postRepository) {

        $posts = $postRepository->findAll();
        return $this->render('web/list.html.twig', [
                    'posts' => $posts
        ]);
    }

    /**
     * @Route("/post/create", name="post_create")
     */
    public function create(Request $request) {

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        
         if ($form->isSubmitted() && $form->isValid()) {
            //entity manager
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            
            return $this->redirect($this->generateUrl('post_list'));
        }

        return $this->render('web/create.html.twig', [
                    'form' => $form->createView()
        ]);
        
        return $this->render('web/create.html.twig', [
                    'posts' => $posts
        ]);
    }

}
