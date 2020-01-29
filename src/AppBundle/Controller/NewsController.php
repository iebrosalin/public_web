<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Model\Article;
use AppBundle\Model\ArticleQuery;
use AppBundle\Form\Type\ArticleType;


/**
 * Class NewsController
 * @package AppBundle\Controller
 */
class NewsController extends Controller
{
    /**
     * @Route("/{page}", name="news_index", requirements={"page"="\d+"})
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page=1)
    {


        $news = ArticleQuery::create()->paginate($page,5);
        $lastPage = ArticleQuery::create()->paginate($page,5)->getLastPage();
        if($news == null){
            throw $this->createNotFoundException();
        }
        if($page > $lastPage){
           throw \Exception();
        }
        $isEmpty = $news->count() == 0;
        return $this->render('news/index.html.twig', [
            'lastPage'=> $lastPage,
            'page' => $page,
            'news' => $news,
            'isEmpty' => $isEmpty
            ]);
    }

    /**
     * @Route("/search", name="news_search")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $searchAttribute = $request->request->get('search_attribute');
        $search = $request->request->get('search');
        switch ($searchAttribute){
            case 'Title':
                $news = ArticleQuery::create()->filterByTitle($search)->find();
                break;
            case 'Abstract':
                $news = ArticleQuery::create()->filterByAbstract($search)->find();
                break;
            case 'Date':
                $news = ArticleQuery::create()->filterByDate($search)->find();
                break;
            case 'Text':
                $news = ArticleQuery::create()->filterByText($search)->find();
                break;
            case 'Activity':
                $news = ArticleQuery::create()->filterByActivity($search)->find();
                break;
        }
        if($news == null){
            throw $this->createNotFoundException();
        }
        $isEmpty = $news->count() == 0;
        return $this->render('news/search.html.twig', [
            'news' => $news,
            'isEmpty' => $isEmpty,
            'searchAttribute' => $searchAttribute,
            'search' => $search,
        ]);
    }

    /**
     * @Route("/show/{id}", name="news_show", requirements={"id"="\d+"})
     */
    public function showAction($id){
        $article = ArticleQuery::create()->findPk($id);
        return $this->render('news/show.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/publish", name="publish_news")
     */
    public function publishAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data=$form->getData();
            $article->setTitle($data->getTitle());
            $article->setAbstract($data->getAbstract());
            $article->setDate($data->getDate());
            $article->setText($data->getText());
            $article->setActivity($data->getActivity());
            $article->save();
            return $this->redirectToRoute('news_index');

        }

        return $this->render('news/publish.html.twig', [
            'form' => $form->createView(),
        ]);
	}

    /**
     * @Route("/edit/{id}", name="news_edit", requirements={"id"="\d+"})
     */
    public function editAction(Request $request, $id)
    {
        $article = ArticleQuery::create()->findPk($id);
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data=$form->getData();
            $article->setTitle($data->getTitle());
            $article->setAbstract($data->getAbstract());
            $article->setDate($data->getDate());
            $article->setText($data->getText());
            $article->setActivity($data->getActivity());
            $article->save();
            return $this->redirectToRoute('news_index');
        }

        return $this->render('news/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="news_delete", requirements={"id"="\d+"})
     */
    public function deleteAction(Request $request, $id)
    {
        $article = ArticleQuery::create()->filterById($id)->find();
        $article->delete();
        return $this->redirectToRoute('news_index');
    }
}
