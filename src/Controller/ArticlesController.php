<?php
/**
 * Created by PhpStorm.
 * User: csongorur
 * Date: 12/09/2018
 * Time: 18:03
 */

namespace App\Controller;


use App\Entity\Article;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        return $this->render('articles/create.html.twig');
    }

    public function store(Request $request)
    {
        $article = new Article();
        $article->setTitle($request->get('title'));
        $article->setBody($request->get('body'));
        $article->setCreatedAt(Carbon::now());

        $manager = $this->getDoctrine()->getManager();

        $manager->persist($article);
        $manager->flush();

        return $this->redirectToRoute('index');
    }
}