<?php

namespace IESLaCierva\Entrypoint\Controllers\Session;


use IESLaCierva\Infrastructure\Files\CsvUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    public function execute(Request $request): Response
    {

        $email = $request->get('email');
        $password = $request->get('password');

//        $connection =  new \PDO("mysql:host=mysql;port=3306;dbname=posts","root","admin1234",[]);
//
//        $stmt = $connection->prepare('SELECT id, email, password, role FROM user WHERE email = :email');
//
//        $stmt->execute([':email' => $request->get('email')]);
//
//        if ($stmt->rowCount() === 0) {
//            return new JsonResponse(['Invalid user or password'], Response::HTTP_UNAUTHORIZED);
//        }
//
//        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
//
//        if (password_verify($password, $result['password']) === false) {
//            return new JsonResponse(['Invalid user or password'], Response::HTTP_UNAUTHORIZED);
//        }

        $userRepository = new CsvUserRepository();
        $user = $userRepository->findByEmail($email);

        if ($user === null) {
            return new JsonResponse('Invalid email or password');
        }

        if ($user->password() !== $password) {
            return new JsonResponse('Invalid email or password');
        }

        $_SESSION['email'] = $email;
        $_SESSION['role'] = $user->role();
        $_SESSION['name'] = $user->name();

        return new JsonResponse(['ok']);

    }
}
