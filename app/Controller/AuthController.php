<?php
    namespace Furniro\Controller;

    use Furniro\App\View;
    use Furniro\Config\Database;
    use Furniro\Repository\UserRepository;
    use Furniro\Repository\SessionRepository;
    use Furniro\Service\UserService;
    use Furniro\Service\SessionService;
    use Furniro\Model\UserLoginRequest;
    use Furniro\Model\UserRegisterRequest;
    use Furniro\Exception\ValidationException;
    
    class AuthController {
        private UserService $userService;
        private SessionService $sessionService;

        public function __construct() {
            $userRepository = new UserRepository(Database::getConnection());
            $sessionRepository = new SessionRepository(Database::getConnection());

            $this->userService = new UserService($userRepository);
            $this->sessionService = new SessionService($sessionRepository, $userRepository);
        }
        
        public function login() {
            View::render('Auth/login', [
                'title' => 'Furniro | Login',
                'style' => '/Styles/login.css'
            ]);
        }

        public function postLogin() {
            $request = new UserLoginRequest();
            $request->email = $_POST['email'];
            $request->password = $_POST['password'];

            try {
                $response = $this->userService->login($request);
                $this->sessionService->create($response->user->id);
                View::redirect('/');
            } catch (ValidationException $exception) {
                View::render('Auth/login', [
                    'title' => 'Furniro | Login',
                    'style' => '/Styles/login.css',
                    'error' => $exception->getMessage()
                ]);
            }
        }

        public function register() {
            View::render('Auth/register', [
                'title' => 'Furniro | Register',
                'style' => '/Styles/register.css'
            ]);
        }

        public function postRegister() {
            $request = new UserRegisterRequest();
            $request->id = uniqid();
            $request->email = $_POST['email'];
            $request->password = $_POST['password'];
            $request->confirmPassword = $_POST['confirmPassword'];

            try {
                $response = $this->userService->register($request);
                View::redirect('/login');
            } catch (ValidationException $exception) {
                View::render('Auth/register', [
                    'title' => 'Furniro | Register',
                    'style' => '/Styles/register.css',
                    'error' => $exception->getMessage()
                ]);
            }
        }

        public function logout() {
            $this->sessionService->destroy();
            View::redirect('/');
        }
    }