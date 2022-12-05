<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentAdminController extends Controller
{
    /**
     * @Route("/admin/comment", name="comment_admin")
     * @IsGranted("ROLE_USER")
     */
    public function index(CommentRepository $repository, Request $request, PaginatorInterface $paginator)
    {
//      denyAccessUnlessGranted is the way to grant access to an URL through the controller
//        $this->denyAccessUnlessGranted('ROLE_USER');

//        * @IsGranted("ROLE_ADMIN") <<< is also a way to grant access

        $q = $request->query->get('q');

        $queryBuilder = $repository->getWithSearchQueryBuilder($q);

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('comment_admin/login.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
