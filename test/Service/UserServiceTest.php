<?php
    namespace Furniro\Service;

    use PHPUnit\Framework\TestCase;
    use Furniro\Config\Database;
    use Furniro\Domain\User;
    use Furniro\Repository\UserRepository;
    use Furniro\Repository\SessionRepository;
    use Furniro\Service\UserService;
    use Furniro\Model\UserRegisterRequest;
    use Furniro\Model\UserLoginRequest;
    use Furniro\Exception\ValidationException;

    class UserServiceTest extends TestCase {
        private UserRepository $userRepository;
        private SessionRepository $sessionRepository;
        private UserService $userService;

        public function setUp(): void {
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->sessionRepository = new SessionRepository(Database::getConnection());
            $this->userService = new UserService($this->userRepository);

            $this->sessionRepository->deleteAll();
            $this->userRepository->deleteAll();
        }

        public function testRegisterSuccess() {
            $user = new UserRegisterRequest();
            $user->id = uniqid();
            $user->email = 'farhan';
            $user->password = '1234';
            $user->confirmPassword = '1234';

            $response = $this->userService->register($user);

            $this->assertEquals($response->user->id, $user->id);
            $this->assertEquals($response->user->email, $user->email);
            $this->assertNotEquals($response->user->password, $user->password);
            $this->assertTrue(password_verify($user->password, $response->user->password));
        }

        public function testRegisterFailed() {
            $this->expectException(ValidationException::class);

            $request = new UserRegisterRequest();
            $request->id = '';
            $request->email = '';
            $request->password = '';
            $request->confirmPassword = '';

            $this->userService->register($request);
        }

        public function testRegisterDuplicate() {
            $this->expectException(ValidationException::class);

            $request = new UserRegisterRequest();
            $request->id = uniqid();
            $request->email = 'farhan';
            $request->password = '1234';

            $this->userService->register($request);

            $request2 = new UserRegisterRequest();
            $request2->id = uniqid();
            $request2->email = 'farhan';
            $request2->password = '12345678';

            $this->userService->register($request2);
        }

        public function testLoginNotFound() {
            $this->expectException(ValidationException::class);

            $request = new UserLoginRequest();
            $request->email = 'farhan';
            $request->password = '1234';

            $this->userService->login($request);
        }
        
        public function testLoginWrongPassword() {
            $this->expectException(ValidationException::class);

            $user = new UserRegisterRequest();
            $user->id = uniqid();
            $user->email = 'farhan';
            $user->password = '1234';

            $this->userService->register($user);

            $request = new UserLoginRequest();
            $request->email = 'farhan';
            $request->password = '12345';

            $this->userService->login($request);
        }

        public function testLoginSuccess() {
            $user = new UserRegisterRequest();
            $user->id = uniqid();
            $user->email = 'farhan';
            $user->password = '1234';
            $user->confirmPassword = '1234';

            $this->userService->register($user);

            $request = new UserLoginRequest();
            $request->email = 'farhan';
            $request->password = '1234';

            $response = $this->userService->login($request);

            $this->assertEquals($request->email, $response->user->email);
            $this->assertEquals($user->id, $response->user->id);
            $this->assertNotEquals($request->password, $response->user->password);
            $this->assertTrue(password_verify($request->password, $response->user->password));
        }
    }