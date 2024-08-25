<?php
    namespace Furniro\Repository;

    use PHPUnit\Framework\TestCase;
    use Furniro\Config\Database;
    use Furniro\Domain\User;

    class UserRepositoryTest extends TestCase {
        private UserRepository $userRepository;
        
        public function setUp(): void {
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();
        }

        public function testSaveSuccess() {
            $user = new User();
            $user->id = 'hans';
            $user->name = 'hans';
            $user->password = 'hans123';

            $this->userRepository->save($user);

            $result = $this->userRepository->findById($user->id);
            
            $this->assertEquals($user->id, $result->id);
            $this->assertEquals($user->name, $result->name);
            $this->assertEquals($user->password, $result->password);
        }

        public function testFindByIdNotFound() {
            $user = $this->userRepository->findById('hans');
            $this->assertNull($user);
        }

        public function testUpdate() {
            $user = new User();
            $user->id = 'hans';
            $user->name = 'hans';
            $user->password = 'hans123';
            $this->userRepository->save($user);

            $user->name = 'budi';
            $this->userRepository->update($user);

            $result = $this->userRepository->findById($user->id);
            
            $this->assertEquals($user->id, $result->id);
            $this->assertEquals($user->name, $result->name);
            $this->assertEquals($user->password, $result->password);
        }
    }