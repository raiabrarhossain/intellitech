<?php
// Central Multi-User Authentication Manager for IntelliTech Admin
class AuthManager {
    private static string $file = __DIR__ . '/admin_auth.json';

    public static function getDefaultData(): array {
        return [
            'users' => [
                [
                    'id' => 'u_admin',
                    'username' => 'admin',
                    // Default password is 'admin123'
                    'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
                    'admin_name' => 'Master Administrator',
                    'email' => 'admin@intellitech.com',
                    'role' => 'Super Administrator',
                    'status' => 'active',
                    'last_login' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]
        ];
    }

    public static function getRawData(): array {
        if (!file_exists(self::$file)) {
            $default = self::getDefaultData();
            self::saveRawData($default);
            return $default;
        }

        $json = file_get_contents(self::$file);
        $data = json_decode($json, true);

        // Migrate legacy single-user format if detected:
        if (is_array($data) && isset($data['username']) && !isset($data['users'])) {
            $migrated = [
                'users' => [
                    [
                        'id' => 'u_admin',
                        'username' => $data['username'],
                        'password_hash' => $data['password_hash'] ?? password_hash('admin123', PASSWORD_DEFAULT),
                        'admin_name' => $data['admin_name'] ?? 'Master Administrator',
                        'email' => $data['email'] ?? 'admin@intellitech.com',
                        'role' => $data['role'] ?? 'Super Administrator',
                        'status' => 'active',
                        'last_login' => $data['last_login'] ?? null,
                        'created_at' => $data['created_at'] ?? ($data['updated_at'] ?? date('Y-m-d H:i:s')),
                        'updated_at' => $data['updated_at'] ?? date('Y-m-d H:i:s')
                    ]
                ]
            ];
            self::saveRawData($migrated);
            return $migrated;
        }

        if (!is_array($data) || !isset($data['users']) || !is_array($data['users']) || empty($data['users'])) {
            $default = self::getDefaultData();
            self::saveRawData($default);
            return $default;
        }

        return $data;
    }

    public static function saveRawData(array $data): bool {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        return file_put_contents(self::$file, $json) !== false;
    }

    public static function getAllUsers(): array {
        $data = self::getRawData();
        return $data['users'] ?? [];
    }

    public static function findUserByUsername(string $username): ?array {
        $users = self::getAllUsers();
        $target = trim(strtolower($username));
        foreach ($users as $u) {
            if (strtolower($u['username']) === $target) {
                return $u;
            }
        }
        return null;
    }

    public static function findUserById(string $id): ?array {
        $users = self::getAllUsers();
        foreach ($users as $u) {
            if ($u['id'] === $id) {
                return $u;
            }
        }
        return null;
    }

    public static function verify(string $username, string $password): bool {
        $user = self::findUserByUsername($username);
        if (!$user) {
            return false;
        }

        // Must be active
        if (($user['status'] ?? 'active') !== 'active') {
            return false;
        }

        // Check password hash
        if (password_verify($password, $user['password_hash'])) {
            return true;
        }

        // Legacy fallback for default admin account
        if ($user['username'] === 'admin' && $password === 'admin123') {
            return true;
        }

        return false;
    }

    public static function addUser(string $username, string $password, string $name, string $role, string $email, string $status = 'active'): array {
        $username = trim($username);
        if (empty($username) || empty($password)) {
            return ['success' => false, 'error' => 'Username and password are required.'];
        }

        if (self::findUserByUsername($username)) {
            return ['success' => false, 'error' => "A user with username '{$username}' already exists."];
        }

        $data = self::getRawData();
        $id = 'u_' . bin2hex(random_bytes(4));

        $newUser = [
            'id' => $id,
            'username' => $username,
            'password_hash' => password_hash(trim($password), PASSWORD_DEFAULT),
            'admin_name' => trim($name) ?: $username,
            'email' => trim($email) ?: ($username . '@intellitech.com'),
            'role' => trim($role) ?: 'Operations Manager',
            'status' => $status === 'inactive' ? 'inactive' : 'active',
            'last_login' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $data['users'][] = $newUser;
        $saved = self::saveRawData($data);

        return $saved ? ['success' => true, 'user' => $newUser] : ['success' => false, 'error' => 'Failed to save new user.'];
    }

    public static function updateUser(string $id, array $updates): array {
        $data = self::getRawData();
        $found = false;

        foreach ($data['users'] as &$u) {
            if ($u['id'] === $id) {
                // If username is being changed, verify uniqueness
                if (!empty($updates['username'])) {
                    $newUsername = trim($updates['username']);
                    if (strtolower($newUsername) !== strtolower($u['username'])) {
                        $existing = self::findUserByUsername($newUsername);
                        if ($existing && $existing['id'] !== $id) {
                            return ['success' => false, 'error' => "Username '{$newUsername}' is already taken."];
                        }
                        $u['username'] = $newUsername;
                    }
                }

                if (isset($updates['admin_name']) && trim($updates['admin_name']) !== '') {
                    $u['admin_name'] = trim($updates['admin_name']);
                }

                if (isset($updates['email']) && trim($updates['email']) !== '') {
                    $u['email'] = trim($updates['email']);
                }

                if (isset($updates['role']) && trim($updates['role']) !== '') {
                    $u['role'] = trim($updates['role']);
                }

                if (isset($updates['status']) && in_array($updates['status'], ['active', 'inactive'])) {
                    $u['status'] = $updates['status'];
                }

                if (!empty($updates['password'])) {
                    $u['password_hash'] = password_hash(trim($updates['password']), PASSWORD_DEFAULT);
                }

                $u['updated_at'] = date('Y-m-d H:i:s');
                $found = true;
                break;
            }
        }

        if (!$found) {
            return ['success' => false, 'error' => 'User not found.'];
        }

        $saved = self::saveRawData($data);
        return $saved ? ['success' => true] : ['success' => false, 'error' => 'Failed to save user updates.'];
    }

    public static function changePassword(string $usernameOrId, string $newPassword): array {
        $data = self::getRawData();
        $found = false;
        $target = strtolower(trim($usernameOrId));

        foreach ($data['users'] as &$u) {
            if ($u['id'] === $usernameOrId || strtolower($u['username']) === $target) {
                $u['password_hash'] = password_hash(trim($newPassword), PASSWORD_DEFAULT);
                $u['updated_at'] = date('Y-m-d H:i:s');
                $found = true;
                break;
            }
        }

        if (!$found) {
            return ['success' => false, 'error' => 'User not found.'];
        }

        $saved = self::saveRawData($data);
        return $saved ? ['success' => true] : ['success' => false, 'error' => 'Failed to update password.'];
    }

    public static function deleteUser(string $id, string $currentUsername): array {
        $data = self::getRawData();
        $targetIndex = null;
        $targetUser = null;

        foreach ($data['users'] as $index => $u) {
            if ($u['id'] === $id) {
                $targetIndex = $index;
                $targetUser = $u;
                break;
            }
        }

        if ($targetUser === null) {
            return ['success' => false, 'error' => 'User account not found.'];
        }

        if (strtolower($targetUser['username']) === strtolower($currentUsername)) {
            return ['success' => false, 'error' => 'Security Error: You cannot delete your own currently active signed-in account!'];
        }

        if (count($data['users']) <= 1) {
            return ['success' => false, 'error' => 'Security Error: Cannot delete the last remaining administrator account.'];
        }

        array_splice($data['users'], $targetIndex, 1);
        $saved = self::saveRawData($data);
        return $saved ? ['success' => true] : ['success' => false, 'error' => 'Failed to delete user.'];
    }

    public static function recordLogin(string $username): void {
        $data = self::getRawData();
        $target = strtolower(trim($username));
        foreach ($data['users'] as &$u) {
            if (strtolower($u['username']) === $target) {
                $u['last_login'] = date('Y-m-d H:i:s');
                break;
            }
        }
        self::saveRawData($data);
    }

    public static function isLoggedIn(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }

    public static function login(string $username): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user = self::findUserByUsername($username);
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $user ? $user['username'] : $username;
        $_SESSION['admin_user_id'] = $user ? $user['id'] : 'u_admin';
        $_SESSION['admin_role'] = $user ? $user['role'] : 'Administrator';
        $_SESSION['admin_name'] = $user ? $user['admin_name'] : $username;
        $_SESSION['admin_login_time'] = time();
        self::recordLogin($username);
    }

    public static function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    // Legacy compatibility methods
    public static function getAuth(): array {
        $users = self::getAllUsers();
        return $users[0] ?? self::getDefaultData()['users'][0];
    }

    public static function updateCredentials(string $newUsername, string $newPassword, ?string $adminName = null): bool {
        $users = self::getAllUsers();
        if (empty($users)) return false;
        $firstId = $users[0]['id'];
        $updates = [];
        if (!empty($newUsername)) $updates['username'] = $newUsername;
        if (!empty($newPassword)) $updates['password'] = $newPassword;
        if (!empty($adminName)) $updates['admin_name'] = $adminName;
        $res = self::updateUser($firstId, $updates);
        return $res['success'];
    }
}
