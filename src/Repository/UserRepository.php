<?php

namespace Repository;

use Model\UserModel;

class UserRepository
{
    private string $jsonPath = __DIR__ . '/../../data/users.json';

    public function save(array $data)
    {
        file_put_contents($this->jsonPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function create(UserModel $user)
    {
        $data = $this->getAllUsers();
        $data[] = $user;
        $this->save($data);
    }

    public function update(string $email, array $newData)
    {
        $data = $this->getAllUsers();

        foreach ($data as &$user) {
            if ($user['email'] === $email) {
                foreach ($newData as $key => $value) {
                    $user[$key] = $value;
                }
                $this->save($data);
                return $user;
            }
        }
        return null;
    }

    public function emailExists(string $email)
    {
        $data = $this->getAllUsers();

        foreach ($data as $user) {
            if ($user['email'] === $email) {
                return true;
            }
        }
        return false;
    }

    public function getUserByEmail(string $email)
    {
        $data = $this->getAllUsers();

        foreach ($data as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }

    private function getAllUsers()
    {
        if (file_exists($this->jsonPath)) {
            $data = file_get_contents($this->jsonPath);
            return json_decode($data, true) ?: [];
        }
        return [];
    }

    public function delete(string $email): bool
    {
        $data = $this->getAllUsers();

        foreach ($data as $key => $user) {
            if ($user['email'] === $email) {
                unset($data[$key]);
                $this->save($data);
                return true;
            }
        }

        return false;
    }
}
