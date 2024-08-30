<?php
    namespace Furniro\Middleware;

    use Furniro\Config\Database;
    use Furniro\App\View;
    use Furniro\Repository\UserRepository;
    use Furniro\Repository\SessionRepository;
    use Furniro\Service\SessionService;

    class MustLoginMiddleware implements Middleware {
        private SessionService $sessionService;

        public function __construct() {
            $sessionRepository = new SessionRepository(Database::getConnection());
            $userRepository = new UserRepository(Database::getConnection());

            $this->sessionService = new SessionService($sessionRepository, $userRepository);
        }

        public function before(): void {
            $user = $this->sessionService->current();

            if (!$user) {
                View::redirect('/login');
            }
        }
    }