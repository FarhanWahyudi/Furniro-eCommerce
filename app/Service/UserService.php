<?php
    namespace Furniro\Service;

    use Furniro\Config\Database;
    use Furniro\Model\UserRegisterRequest;
    use Furniro\Model\UserRegisterResponse;
    use Furniro\Model\UserLoginRequest;
    use Furniro\Model\UserLoginResponse;
    use Furniro\Repository\UserRepository;
    use Furniro\Domain\User;
    use Furniro\Exception\ValidationException;

    class UserService {
        private UserRepository $userRepository;

        public function __construct(UserRepository $userRepository) {
            $this->userRepository = $userRepository;
        }

        public function register(UserRegisterRequest $request): UserRegisterResponse {
            $this->validateUserRegisterRequest($request);

            try {
                Database::beginTransaction();

                $userRequest = $this->userRepository->findByEmail($request->email);
                if ($userRequest) {
                    throw new ValidationException('Email is Already Exists');
                }

                $user = new User();
                $user->id = $request->id;
                $user->email = $request->email;
                $user->password = password_hash($request->password, PASSWORD_BCRYPT);

                if (password_verify($request->confirmPassword, $user->password)) {
                    $this->userRepository->save($user);
    
                    $response = new UserRegisterResponse();
                    $response->user = $user;
    
                    Database::commitTransaction();
    
                    return $response;
                } else {
                    throw new ValidationException('Password is Wrong');
                }
            } catch (\Exception $exception) {
                Database::rollbackTransaction();
                throw $exception;
            }
        }

        private function validateUserRegisterRequest(UserRegisterRequest $request) {
            if ($request->email == null || $request->password == null || trim($request->email) == '' || trim($request->password) == '' ) {
                throw new ValidationException('email or password can not blank');
            }
        }

        public function login(UserLoginRequest $request): UserLoginResponse {
            $this->validateUserLoginRequest($request);

            $user = $this->userRepository->findByEmail($request->email);
            if (!$user) {
                throw new ValidationException('email or password is wrong');
            }

            if (password_verify($request->password, $user->password)) {
                $response = new UserLoginResponse();
                $response->user = $user;
                return $response;
            } else {
                throw new ValidationException('email or password is wrong');
            }
        }

        private function validateUserLoginRequest(UserLoginRequest $request) {
            if ($request->email == null || $request->password == null || trim($request->email) == '' || trim($request->password) == '' ) {
                throw new ValidationException('email or password can not blank');
            }
        }
    }