<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\EditUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('admin/dashboard.html.twig');
    }
    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function usersAction()
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        return $this->render('admin/usersList.html.twig',array('users'=>$users));
    }


    /**
     * @Route("/admin/user/add", name="admin_user_add")
     */
    public function addUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        $form = $this->createForm(EditUserType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            /** @var Participation $participation */
            $user = $form->getData();
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            $users = $this->getDoctrine()
                ->getRepository(User::class)
                ->findAll();
            return $this->render('admin/usersList.html.twig',array('users'=>$users));

        }

        return $this->render('admin/edit_user.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/admin/user/{id}/edit", name="admin_user_edit")
     */
    public function editUserAction(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder){

        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            /** @var Participation $participation */
            $user = $form->getData();
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            $users = $this->getDoctrine()
                ->getRepository(User::class)
                ->findAll();
            return $this->render('admin/usersList.html.twig',array('users'=>$users));

        }

        return $this->render('admin/edit_user.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));

    }

    /**
     * @Route("/admin/user/{id}/delete", name="admin_user_delete")
     * @Method({"DELETE"})
     */
    public function deleteUserAction(Request $request, User $user){

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('admin/usersList.html.twig',array('users'=>$users));

    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        return $this->render('admin/test.html.twig');
    }


}
