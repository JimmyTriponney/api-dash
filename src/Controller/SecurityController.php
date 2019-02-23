<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminRegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{
    /**
     * @Route(
     *     "/admin/register",
     *     name="security_admin_registration",
     *     methods={"POST"}
     * )
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        // Récupération des données envoyé
        $data = $request->request->all();
        // Création du nouvelle Admin
        $admin = new Admin();
        // Création et complétion du formulaire
        $form = ($this->createForm(AdminRegistrationType::class, $admin))->submit($data);

        // Vérifie l'état du formulaire
        if (!$form->isSubmitted()) {
            // Si le formlaire n'est pas soumis on renvoi une erreur
            throw new Exception('Admin isn\'t submitted', 500);
        }

        // Encodage du password
        $hash = $encoder->encodePassword($admin, $admin->getPassword());
        $admin->setPassword($hash);

        // Sauvegarde de l'admin
        $manager->persist($admin);
        $manager->flush();

        return $this->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Admin create.',
            'data' => $admin,
            'request' => $request->request->all()
        ]);
    }

    /**
     * data in:
     *  {
     *      _username: string,
     *      _password: string
     * }
     *
     * @Route(
     *     "/admin/login",
     *     name="security_admin_login",
     *     methods={"POST"}
     * )
     */
    public function login(){}

    /**
     * @Route(
     *     "/admin/logout",
     *     name="security_admin_logout",
     *     methods={"POST"}
     * )
     */
    public function logout(){}
}
