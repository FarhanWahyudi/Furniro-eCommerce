<?php
    namespace Furniro\Service;

    use Furniro\Repository\SessionRepository;
    use Furniro\Repository\UserRepository;
    use Furniro\Domain\Session;
    use Furniro\Domain\User;

    class SessionService {
        public static string $COOKIE_NAME = 'X-FURNIRO-SESSION';
        private SessionRepository $sessionRepository;
        private UserRepository $userRepository;

        public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository) {
            $this->sessionRepository = $sessionRepository;
            $this->userRepository = $userRepository;
        }

        public function create(string $userId): Session {
            $session = new Session();
            $session->id = uniqid();
            $session->userId = $userId;

            $this->sessionRepository->save($session);

            setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 30), '/');

            return $session;
        }

        public function destroy(): void {
            $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';
            $this->sessionRepository->deleteById($sessionId);

            setcookie(self::$COOKIE_NAME, '', 1, '/');
        }

        public function current(): ?User {
            $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';
            $session = $this->sessionRepository->findById($sessionId);

            if (!$session) {
                return null;
            }

            return $this->userRepository->findById($session->userId);
        }
    }