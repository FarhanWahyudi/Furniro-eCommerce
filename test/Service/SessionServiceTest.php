<?php
    namespace Furniro\Service;

    use PHPUnit\Framework\TestCase;
    use Furniro\Config\Database;
    use Furniro\Repository\UserRepository;
    use Furniro\Repository\SessionRepository;
    use Furniro\Domain\User;
    use Furniro\Domain\Session;

    function setcookie(string $name, string $value) {
        echo "$name: $value";
    }

    class SessionServiceTest extends TestCase {
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;
        private UserService $userService;
        private SessionService $sessionService;
        private User $user;

        protected function setUp(): void {
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->sessionRepository = new SessionRepository(Database::getConnection());
            $this->sessionService = new SessionService($this->sessionRepository, $this->userRepository);

            $this->sessionRepository->deleteAll();
            $this->userRepository->deleteAll();

            $this->user = new User();
            $this->user->id = uniqid();
            $this->user->email = 'hans';
            $this->user->password = '12345';
            $this->userRepository->save($this->user);
        }

        public function testCreate() {
            $session = $this->sessionService->create($this->user->id);

            $this->expectOutputRegex("[X-FURNIRO-SESSION: $session->id]");
            $result = $this->sessionRepository->findById($session->id);
            $this->assertEquals($this->user->id, $session->userId);
        }

        public function testDestroy() {
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $this->user->id;

            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $this->sessionService->destroy();

            $this->expectOutputRegex("[X-FURNIRO-SESSION: ]");

            $result = $this->sessionRepository->findById($session->id);
            $this->assertNull($result);
        }

        public function testCurrent() {
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $this->user->id;

            $this->sessionRepository->save($session);

            $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

            $user = $this->sessionService->current();

            $this->assertEquals($user->id, $session->userId);
            $this->assertEquals($user->email, $this->user->email);
        }
    }