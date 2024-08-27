<?php
    namespace Furniro\Repository;

    use PHPUnit\Framework\TestCase;
    use Furniro\Config\Database;
    use Furniro\Domain\Session;
    use Furniro\Domain\User;
    use Furniro\Repository\SessionRepository;
    use Furniro\Repository\UserRepository;

    class SessionRepositoryTest extends TestCase {
        private SessionRepository $sessionRepository;
        private UserRepository $userRepository;

        public function setUp(): void {
            $this->sessionRepository = new SessionRepository(Database::getConnection());
            $this->userRepository = new UserRepository(Database::getConnection());

            $this->sessionRepository->deleteAll();
            $this->userRepository->deleteAll();

            $user = new User();
            $user->id = 'farhan';
            $user->email = 'hans';
            $user->password = '1234';
            $this->userRepository->save($user);
        }

        public function testSaveSuccess() {
            $session = new Session();
            $session->id = uniqid();
            $session->userId = 'farhan';

            $this->sessionRepository->save($session);

            $result = $this->sessionRepository->findById($session->id);

            $this->assertEquals($session->id, $result->id);
            $this->assertEquals($session->userId, $result->userId);
        }

        public function testDeleteByIdSuccess() {
            $session = new Session();
            $session->id = uniqid();
            $session->userId = 'farhan';

            $this->sessionRepository->save($session);
            $this->sessionRepository->deleteById($session->id);

            $result = $this->sessionRepository->findById($session->id);

            $this->assertNull($result);
        }

        public function testFindByIdNotFound() {
            $result = $this->sessionRepository->findById('not found');

            $this->assertNull($result);
        }
    }