<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthController extends AbstractController
{
    /**
     * @Route("/api/register", name="register", methods={"POST"})
     * @param Request $request
     * @param UserPasswordHasherInterface $hasher
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function register(Request $request, UserPasswordHasherInterface $hasher)
    {
        $password = $request->get('password');
        $phone = $request->get('username');
        $user = new User();
        $user->setPhone($phone);
        $password = $hasher->hashPassword($user, $password);
        $user->setPassword($password);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->json([
            'user' => $user->getPhone()
        ]);
    }

    /**
     * @Route("/api/login", name="login", methods={"POST"})
     * @param Request $request
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $hasher
     * @param FormBuilderInterface $builder
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $hasher, ValidatorInterface $validator)
    {
        $data = $request->getContent();
        $data = json_decode($data, true);
        $data = ['phone' => $data['phone'], 'password' => $data['password']];
        $contains = new Assert\Collection([
            'phone' => [new Assert\Length(['min' => 18, 'max' => 18]), new Assert\NotBlank(), new Assert\Regex('/^\+\d{1,3}\s?\(\d{3}\)\s?\d{3}(-\d{2}){2}$/')],
            'password' => [new Assert\NotBlank()]
        ]);
        $valid = $validator->validate($data, $contains);
        if (count($valid) > 0) {
            return $this->json(['status' => 'error', 'message' => $valid[0]->getMessage()]);
        }
        $user = $userRepository->findOneBy([
            'phone' => $data['phone']
        ]);
        if (!$user) {
            return $this->json(['status' => 'error', 'message' => 'Пользователь не найден']);
        }

        if (!$hasher->isPasswordValid($user, $data['password'])) {
            return $this->json(['status' => 'error', 'message' => 'Неверный пароль']);
        }
        $payload = [
            'user' => $user->getPhone(),
            'exp' => (new \DateTime())->modify('+30 minutes')->getTimestamp()
        ];
        $jwt = JWT::encode($payload, $this->getParameter('jwt_secret'), 'HS256');
        return $this->json(['status' => 'success', 'message' => sprintf('Bearer %s', $jwt)]);

    }
}
