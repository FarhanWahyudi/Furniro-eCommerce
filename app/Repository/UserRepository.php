<?php
    namespace Furniro\Repository;

    use Furniro\Domain\User;

    class UserRepository {
        private \PDO $connection;

        public function __construct(\PDO $connection) {
            $this->connection = $connection;
        }

        public function save(User $user): User {
            $statement = $this->connection->prepare('INSERT INTO users(id, email, password) VALUES (?, ?, ?)');
            $statement->execute([
                $user->id,
                $user->email,
                $user->password
            ]);
            return $user;
        }

        public function update(User $user): User {
            $statement = $this->connection->prepare('UPDATE users SET email = ?, password = ? WHERE id = ?');
            $statement->execute([
                $user->email,
                $user->password,
                $user->id
            ]);
            return $user;
        }

        public function findById(string $id): ?User {
            $statement = $this->connection->prepare('SELECT id, email, password FROM users WHERE id = ?');
            $statement->execute([$id]);

            try {
                if ($row = $statement->fetch()) {
                    $user = new User();
                    $user->id = $row['id'];
                    $user->email = $row['email'];
                    $user->password = $row['password'];
                    return $user;
                } else {
                    return null;
                }
            } finally {
                $statement->closeCursor();
            }
        }

        public function findByEmail(string $email): ?User {
            $statement = $this->connection->prepare('SELECT id, email, password FROM users WHERE email = ?');
            $statement->execute([$email]);

            try {
                if ($row = $statement->fetch()) {
                    $user = new User();
                    $user->id = $row['id'];
                    $user->email = $row['email'];
                    $user->password = $row['password'];
                    return $user;
                } else {
                    return null;
                }
            } finally {
                $statement->closeCursor();
            }
        }

        public function deleteAll(): void {
            $statement = $this->connection->exec('DELETE FROM users');
        }
    }