<?php
// IntelliTech - Master Administration & Content Management Hub
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/data/AuthManager.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$message = '';
$messageType = '';

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    AuthManager::logout();
    header('Location: admin.php?logged_out=1');
    exit;
}

if (isset($_GET['logged_out'])) {
    $message = 'You have safely signed out of the IntelliTech Admin Panel.';
    $messageType = 'info';
}

// Handle Login Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_action'])) {
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    if (AuthManager::verify($user, $pass)) {
        AuthManager::login($user);
        header('Location: admin.php');
        exit;
    } else {
        $message = 'Invalid username or password. Please verify your credentials.';
        $messageType = 'error';
    }
}

// Check if user is authenticated
$isAuthenticated = AuthManager::isLoggedIn();

// Handle Authenticated Actions
if ($isAuthenticated && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['admin_action'] ?? '';

    if ($action === 'save_all') {
        $content = ContentManager::load();

        // 1. Branding & Logo
        $content['branding']['company_name'] = trim($_POST['company_name'] ?? 'Intelli');
        $content['branding']['company_suffix'] = trim($_POST['company_suffix'] ?? 'Tech');
        $content['branding']['brand_tag'] = trim($_POST['brand_tag'] ?? 'Solutions');
        $content['branding']['logo_icon'] = trim($_POST['logo_icon'] ?? 'cpu');
        $content['branding']['favicon_path'] = trim($_POST['favicon_path'] ?? 'assets/images/favicon.svg');
        $content['branding']['tagline'] = trim($_POST['tagline'] ?? '');
        $content['branding']['hero_badge'] = trim($_POST['hero_badge'] ?? '');
        $content['branding']['hero_title_prefix'] = trim($_POST['hero_title_prefix'] ?? '');
        $content['branding']['hero_title_highlight'] = trim($_POST['hero_title_highlight'] ?? '');
        $content['branding']['hero_title_suffix'] = trim($_POST['hero_title_suffix'] ?? '');
        $content['branding']['hero_subtitle'] = trim($_POST['hero_subtitle'] ?? '');

        // 2. Rainbow Countdown Banner
        $content['countdown']['enabled'] = isset($_POST['countdown_enabled']);
        $content['countdown']['title'] = trim($_POST['countdown_title'] ?? '');
        $content['countdown']['badge'] = trim($_POST['countdown_badge'] ?? '');
        $content['countdown']['target_date'] = trim($_POST['countdown_target_date'] ?? '');
        $content['countdown']['discount_text'] = trim($_POST['countdown_discount_text'] ?? '');
        $content['countdown']['rainbow_active'] = isset($_POST['countdown_rainbow']);
        $content['countdown']['cta_text'] = trim($_POST['countdown_cta_text'] ?? 'Claim Consultation');
        $content['countdown']['cta_link'] = trim($_POST['countdown_cta_link'] ?? 'index.php?page=contact');

        // 3. Stats
        $content['stats']['homes'] = trim($_POST['stats_homes'] ?? '');
        $content['stats']['homes_label'] = trim($_POST['stats_homes_label'] ?? '');
        $content['stats']['offices'] = trim($_POST['stats_offices'] ?? '');
        $content['stats']['offices_label'] = trim($_POST['stats_offices_label'] ?? '');
        $content['stats']['factories'] = trim($_POST['stats_factories'] ?? '');
        $content['stats']['factories_label'] = trim($_POST['stats_factories_label'] ?? '');
        $content['stats']['energy'] = trim($_POST['stats_energy'] ?? '');
        $content['stats']['energy_label'] = trim($_POST['stats_energy_label'] ?? '');

        // 4. Contacts
        $content['contacts']['phone'] = trim($_POST['contact_phone'] ?? '');
        $content['contacts']['email'] = trim($_POST['contact_email'] ?? '');
        $content['contacts']['hours'] = trim($_POST['contact_hours'] ?? '');
        $content['contacts']['address'] = trim($_POST['contact_address'] ?? '');
        $content['contacts']['austin_address'] = trim($_POST['contact_austin_address'] ?? '');

        // 5. Pricing Packages
        if (isset($_POST['pkg_title']) && is_array($_POST['pkg_title'])) {
            $pkgs = [];
            foreach ($_POST['pkg_title'] as $idx => $t) {
                if (empty(trim($t))) continue;
                $featRaw = $_POST['pkg_features'][$idx] ?? '';
                $feats = array_filter(array_map('trim', explode("\n", $featRaw)));

                $pkgs[] = [
                    'id' => 'p' . ($idx + 1),
                    'category' => trim($_POST['pkg_category'][$idx] ?? ''),
                    'title' => trim($t),
                    'price' => trim($_POST['pkg_price'][$idx] ?? ''),
                    'period' => trim($_POST['pkg_period'][$idx] ?? '/ starting turnkey'),
                    'description' => trim($_POST['pkg_description'][$idx] ?? ''),
                    'badge' => trim($_POST['pkg_badge'][$idx] ?? ''),
                    'is_popular' => (isset($_POST['pkg_popular']) && $_POST['pkg_popular'] == $idx),
                    'features' => array_values($feats)
                ];
            }
            if (!empty($pkgs)) {
                $content['pricing'] = $pkgs;
            }
        }

        // 6. Cost Calculator
        $content['calculator']['home_mult'] = floatval($_POST['calc_home'] ?? 4.5);
        $content['calculator']['office_mult'] = floatval($_POST['calc_office'] ?? 3.8);
        $content['calculator']['factory_mult'] = floatval($_POST['calc_factory'] ?? 5.8);
        $content['calculator']['window_mult'] = floatval($_POST['calc_window'] ?? 6.2);

        // 7. Visuals
        $content['visuals']['enable_floating_boxes'] = isset($_POST['vis_floating_boxes']);

        // Save
        ContentManager::save($content);
        $siteContent = $content;
        $message = 'All website sections, prices, and branding successfully updated!';
        $messageType = 'success';
        $activeTab = 'branding';
    } elseif ($action === 'change_credentials') {
        $newUsername = trim($_POST['auth_new_username'] ?? $_POST['new_username'] ?? '');
        $newPassword = trim($_POST['auth_new_password'] ?? $_POST['new_password'] ?? '');
        $confirmPassword = trim($_POST['auth_confirm_password'] ?? $_POST['confirm_password'] ?? '');
        $adminName = trim($_POST['auth_admin_name'] ?? $_POST['admin_name'] ?? '');

        if (empty($newUsername)) {
            $message = 'Username cannot be blank.';
            $messageType = 'error';
        } elseif (!empty($newPassword) && strlen($newPassword) < 5) {
            $message = 'New password must be at least 5 characters long.';
            $messageType = 'error';
        } elseif (!empty($newPassword) && $newPassword !== $confirmPassword) {
            $message = 'New passwords do not match. Please re-type carefully.';
            $messageType = 'error';
        } else {
            $currentUser = AuthManager::findUserByUsername($_SESSION['admin_username'] ?? 'admin');
            if ($currentUser) {
                $updates = ['username' => $newUsername];
                if (!empty($adminName)) $updates['admin_name'] = $adminName;
                if (!empty($newPassword)) $updates['password'] = $newPassword;
                $res = AuthManager::updateUser($currentUser['id'], $updates);
                if ($res['success']) {
                    $_SESSION['admin_username'] = $newUsername;
                    $message = 'Your personal administrator credentials have been successfully updated!';
                    $messageType = 'success';
                } else {
                    $message = $res['error'] ?? 'Failed to update credentials.';
                    $messageType = 'error';
                }
            } else {
                AuthManager::updateCredentials($newUsername, $newPassword, $adminName);
                $_SESSION['admin_username'] = $newUsername;
                $message = 'Admin credentials successfully updated!';
                $messageType = 'success';
            }
        }
        $activeTab = 'security';
    } elseif ($action === 'add_user') {
        $uName = trim($_POST['user_username'] ?? '');
        $uPass = trim($_POST['user_password'] ?? '');
        $uFullName = trim($_POST['user_name'] ?? '');
        $uRole = trim($_POST['user_role'] ?? 'Operations Manager');
        $uEmail = trim($_POST['user_email'] ?? '');
        $uStatus = trim($_POST['user_status'] ?? 'active');

        if (empty($uName) || empty($uPass)) {
            $message = 'Error: Both username and password are required to create a new user.';
            $messageType = 'error';
        } elseif (strlen($uPass) < 5) {
            $message = 'Error: User password must be at least 5 characters long.';
            $messageType = 'error';
        } else {
            $res = AuthManager::addUser($uName, $uPass, $uFullName, $uRole, $uEmail, $uStatus);
            if ($res['success']) {
                $message = "User '{$uName}' ({$uRole}) was successfully created!";
                $messageType = 'success';
            } else {
                $message = $res['error'] ?? 'Failed to create user.';
                $messageType = 'error';
            }
        }
        $activeTab = 'security';
    } elseif ($action === 'change_user_password') {
        $userId = trim($_POST['pwd_user_id'] ?? '');
        $newPass = trim($_POST['pwd_new_password'] ?? '');
        $confirmPass = trim($_POST['pwd_confirm_password'] ?? '');

        if (empty($userId) || empty($newPass)) {
            $message = 'Error: User ID and new password are required.';
            $messageType = 'error';
        } elseif (strlen($newPass) < 5) {
            $message = 'Error: New password must be at least 5 characters long.';
            $messageType = 'error';
        } elseif ($newPass !== $confirmPass) {
            $message = 'Error: New passwords do not match. Please re-type.';
            $messageType = 'error';
        } else {
            $res = AuthManager::changePassword($userId, $newPass);
            if ($res['success']) {
                $targetUser = AuthManager::findUserById($userId);
                $targetName = $targetUser['username'] ?? 'User';
                $message = "Password for user '{$targetName}' was successfully changed!";
                $messageType = 'success';
            } else {
                $message = $res['error'] ?? 'Failed to update password.';
                $messageType = 'error';
            }
        }
        $activeTab = 'security';
    } elseif ($action === 'edit_user') {
        $userId = trim($_POST['edit_user_id'] ?? '');
        $newUsername = trim($_POST['edit_username'] ?? '');
        $newName = trim($_POST['edit_name'] ?? '');
        $newRole = trim($_POST['edit_role'] ?? '');
        $newEmail = trim($_POST['edit_email'] ?? '');
        $newStatus = trim($_POST['edit_status'] ?? 'active');

        $updates = [
            'username' => $newUsername,
            'admin_name' => $newName,
            'role' => $newRole,
            'email' => $newEmail,
            'status' => $newStatus
        ];

        if (!empty($_POST['edit_password'])) {
            if (strlen(trim($_POST['edit_password'])) >= 5) {
                $updates['password'] = trim($_POST['edit_password']);
            } else {
                $message = 'Error: Password must be at least 5 characters long.';
                $messageType = 'error';
            }
        }

        if (empty($message)) {
            $res = AuthManager::updateUser($userId, $updates);
            if ($res['success']) {
                $currentUser = AuthManager::findUserById($userId);
                if ($currentUser && isset($_SESSION['admin_user_id']) && $_SESSION['admin_user_id'] === $userId) {
                    $_SESSION['admin_username'] = $currentUser['username'];
                }
                $message = "User details for '{$newUsername}' successfully updated!";
                $messageType = 'success';
            } else {
                $message = $res['error'] ?? 'Failed to update user.';
                $messageType = 'error';
            }
        }
        $activeTab = 'security';
    } elseif ($action === 'delete_user') {
        $userId = trim($_POST['delete_user_id'] ?? '');
        $currentUsername = $_SESSION['admin_username'] ?? '';
        $res = AuthManager::deleteUser($userId, $currentUsername);
        if ($res['success']) {
            $message = 'User account was successfully removed from the system.';
            $messageType = 'success';
        } else {
            $message = $res['error'] ?? 'Failed to delete user.';
            $messageType = 'error';
        }
        $activeTab = 'security';
    } elseif ($action === 'clear_quotes') {
        file_put_contents(__DIR__ . '/data/quotes.json', json_encode([]));
        $message = 'Customer inquiries list cleared.';
        $messageType = 'info';
        $activeTab = 'quotes';
    }
}

// Reload fresh content
$content = ContentManager::load();
$b = $content['branding'];
$cd = $content['countdown'];
$st = $content['stats'];
$ct = $content['contacts'];
$pkgs = $content['pricing'];
$calc = $content['calculator'];
$vis = $content['visuals'];

$authData = AuthManager::getAuth();
$allUsers = AuthManager::getAllUsers();
$currentAuthUser = AuthManager::findUserByUsername($_SESSION['admin_username'] ?? 'admin') ?? $authData;
$activeTab = $activeTab ?? 'branding';

// Load received quotes
$quotesFile = __DIR__ . '/data/quotes.json';
$quotes = file_exists($quotesFile) ? (json_decode(file_get_contents($quotesFile), true) ?? []) : [];
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isAuthenticated ? 'Admin Control Hub' : 'Admin Login' ?> &bull; <?= APP_FULL_NAME ?></title>
    
    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/svg+xml" href="<?= APP_FAVICON ?>">
    <link rel="alternate icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicon-192x192.png">
    <meta name="theme-color" content="#2563EB">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace']
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="min-h-full flex flex-col font-sans bg-slate-100 text-slate-800 antialiased relative">

    <!-- Floating 3D Moving Ambient Glass Boxes -->
    <?php require_once __DIR__ . '/includes/ambient_boxes.php'; ?>

    <?php if (!$isAuthenticated): ?>
    <!-- =======================================================================
         1. ADMIN LOGIN VIEW
         ======================================================================= -->
    <div class="flex-1 flex items-center justify-center p-4 sm:p-6 min-h-screen">
        <div class="w-full max-w-md">
            
            <!-- Login Card -->
            <div class="glass-panel rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-2xl relative overflow-hidden bg-white/85">
                
                <!-- Logo & Brand Header -->
                <div class="text-center space-y-3 mb-8">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-sky-400 flex items-center justify-center text-white shadow-lg shadow-blue-500/25 mx-auto">
                        <i data-lucide="shield-check" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                            Intelli<span class="text-blue-600">Tech</span> <span class="text-slate-400 font-normal">Admin</span>
                        </h1>
                        <p class="text-xs text-slate-500 mt-1">Sign in to manage website content, prices, and branding</p>
                    </div>
                </div>

                <!-- Alert Message -->
                <?php if (!empty($message)): ?>
                    <div class="mb-6 p-3.5 rounded-xl text-xs font-bold flex items-center gap-2 <?= $messageType === 'error' ? 'bg-rose-50 text-rose-800 border border-rose-200' : 'bg-blue-50 text-blue-800 border border-blue-200' ?>">
                        <i data-lucide="<?= $messageType === 'error' ? 'alert-circle' : 'info' ?>" class="w-4 h-4 shrink-0"></i>
                        <span><?= htmlspecialchars($message) ?></span>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form method="POST" action="admin.php" class="space-y-4">
                    <input type="hidden" name="login_action" value="1">

                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Admin Username</label>
                        <div class="relative">
                            <i data-lucide="user" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input 
                                type="text" 
                                name="username" 
                                required 
                                autocomplete="username"
                                placeholder="Enter admin username" 
                                class="w-full pl-10 pr-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Password</label>
                        <div class="relative">
                            <i data-lucide="lock" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input 
                                type="password" 
                                id="login-password-field"
                                name="password" 
                                required 
                                autocomplete="current-password"
                                placeholder="Enter admin password" 
                                class="w-full pl-10 pr-10 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                            >
                            <button 
                                type="button" 
                                onclick="const f=document.getElementById('login-password-field'); f.type = f.type==='password'?'text':'password';" 
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600"
                            >
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-700 hover:to-indigo-800 text-white font-extrabold text-xs shadow-md transition-all flex items-center justify-center gap-2"
                    >
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        <span>Sign In to Admin Panel</span>
                    </button>
                </form>

                <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                    <a href="index.php" class="text-xs font-semibold text-slate-500 hover:text-blue-600 transition-colors flex items-center justify-center gap-1.5">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                        <span>Return to Public Website</span>
                    </a>
                </div>

            </div>

        </div>
    </div>

    <?php else: ?>
    <!-- =======================================================================
         2. AUTHENTICATED ADMIN DASHBOARD VIEW
         ======================================================================= -->
    <header class="sticky top-0 z-40 w-full px-3 sm:px-6 lg:px-8 pt-2.5 sm:pt-3 pb-1 transition-all duration-300">
        <div class="max-w-7xl mx-auto nav-glass-island glass-nav-shimmer rounded-2xl sm:rounded-full px-3.5 sm:px-5 h-14 sm:h-15 flex items-center justify-between gap-3">
            
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl sm:rounded-full bg-gradient-to-tr from-blue-600 via-indigo-600 to-purple-600 flex items-center justify-center text-white shadow-sm shadow-blue-500/25">
                    <i data-lucide="sliders" class="w-4 h-4"></i>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-sm sm:text-base tracking-tight text-slate-900"><?= htmlspecialchars($b['company_name'] ?? 'Intelli') ?><span class="text-blue-600"><?= htmlspecialchars($b['company_suffix'] ?? 'Tech') ?></span></span>
                        <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-full bg-purple-50 text-purple-700 border border-purple-200 uppercase tracking-wider">CMS Hub</span>
                    </div>
                    <div class="flex items-center gap-1.5 text-[10px] text-slate-400 leading-none">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 beacon-pulse"></span>
                        <span class="hidden sm:inline">Admin:</span> <strong class="text-slate-700"><?= htmlspecialchars($_SESSION['admin_username'] ?? 'admin') ?></strong>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a 
                    href="index.php" 
                    target="_blank"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-slate-200/90 bg-white/80 hover:bg-white text-slate-700 font-bold text-xs shadow-2xs transition-all hover:scale-[1.02]"
                >
                    <i data-lucide="external-link" class="w-3.5 h-3.5 text-blue-600"></i>
                    <span class="hidden sm:inline">View Public Site</span>
                </a>

                <button 
                    type="submit" 
                    form="admin-main-form"
                    class="inline-flex items-center gap-1.5 px-3.5 sm:px-4 py-1.5 sm:py-2 rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-700 hover:to-indigo-800 text-white font-extrabold text-xs shadow-sm shadow-blue-500/25 transition-all hover:scale-[1.02] active:scale-[0.98]"
                >
                    <i data-lucide="save" class="w-3.5 h-3.5"></i>
                    <span>Save All</span>
                </button>

                <!-- Logout Button -->
                <a 
                    href="admin.php?action=logout" 
                    onclick="return confirm('Sign out of the admin panel?')"
                    class="p-1.5 sm:px-3 sm:py-1.5 rounded-full border border-rose-200/90 bg-rose-50/80 hover:bg-rose-100 text-rose-700 font-bold text-xs transition-colors flex items-center gap-1"
                    title="Sign Out"
                >
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    <span class="hidden sm:inline">Logout</span>
                </a>
            </div>

        </div>
    </header>

    <!-- Main Admin Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full space-y-6">

        <!-- Notification Banner -->
        <?php if (!empty($message)): ?>
            <div class="p-4 rounded-2xl <?= $messageType === 'success' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : ($messageType === 'error' ? 'bg-rose-50 text-rose-800 border border-rose-200' : 'bg-blue-50 text-blue-800 border border-blue-200') ?> flex items-center justify-between text-xs font-bold shadow-xs animate-pulse">
                <div class="flex items-center gap-2">
                    <i data-lucide="<?= $messageType === 'success' ? 'check-circle' : ($messageType === 'error' ? 'alert-triangle' : 'info') ?>" class="w-4 h-4"></i>
                    <span><?= htmlspecialchars($message) ?></span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600">&times;</button>
            </div>
        <?php endif; ?>

        <!-- Quick Tabs Navigation Bar -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 border-b border-slate-200 text-xs font-bold">
            <button type="button" onclick="switchAdminTab('branding')" id="tab-btn-branding" class="admin-tab-btn px-4 py-2 rounded-xl bg-blue-600 text-white shadow-xs">
                🎨 Branding & Logo
            </button>
            <button type="button" onclick="switchAdminTab('countdown')" id="tab-btn-countdown" class="admin-tab-btn px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">
                🌈 Rainbow Countdown
            </button>
            <button type="button" onclick="switchAdminTab('pricing')" id="tab-btn-pricing" class="admin-tab-btn px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">
                💰 Pricing & Packages
            </button>
            <button type="button" onclick="switchAdminTab('hero')" id="tab-btn-hero" class="admin-tab-btn px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">
                📝 Hero & Texts
            </button>
            <button type="button" onclick="switchAdminTab('contacts')" id="tab-btn-contacts" class="admin-tab-btn px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">
                📞 Contacts & Addresses
            </button>
            <button type="button" onclick="switchAdminTab('visuals')" id="tab-btn-visuals" class="admin-tab-btn px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">
                ✨ Moving Boxes & FX
            </button>
            <button type="button" onclick="switchAdminTab('quotes')" id="tab-btn-quotes" class="admin-tab-btn px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">
                📬 Inquiries (<?= count($quotes) ?>)
            </button>
            <button type="button" onclick="switchAdminTab('security')" id="tab-btn-security" class="admin-tab-btn px-4 py-2 rounded-xl bg-white border border-purple-200 text-purple-700 hover:bg-purple-50">
                👥 User Management (<?= count($allUsers) ?>)
            </button>
        </div>

        <!-- Master Form Wrapper -->
        <form id="admin-main-form" method="POST" action="admin.php" class="space-y-6">
            <input type="hidden" name="admin_action" value="save_all">

            <!-- TAB 1: BRANDING & LOGO -->
            <div id="panel-branding" class="admin-panel space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm bg-white space-y-6">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">Brand Identity, Company Name & Logo</h2>
                        <p class="text-xs text-slate-500">Customize the corporate identity, logo typography, and navbar presentation across the entire website.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Company Name Prefix</label>
                            <input type="text" name="company_name" value="<?= htmlspecialchars($b['company_name']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                            <span class="text-[10px] text-slate-400 mt-1 block">E.g. "Intelli"</span>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Company Name Suffix (Accent Color)</label>
                            <input type="text" name="company_suffix" value="<?= htmlspecialchars($b['company_suffix']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                            <span class="text-[10px] text-slate-400 mt-1 block">E.g. "Tech"</span>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Sub-Brand Tag Badge</label>
                            <input type="text" name="brand_tag" value="<?= htmlspecialchars($b['brand_tag']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                            <span class="text-[10px] text-slate-400 mt-1 block">E.g. "Solutions" or "Automation"</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Brand Logo Icon</label>
                            <select name="logo_icon" class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none">
                                <option value="cpu" <?= $b['logo_icon'] === 'cpu' ? 'selected' : '' ?>>CPU Processor (Technology)</option>
                                <option value="layers" <?= $b['logo_icon'] === 'layers' ? 'selected' : '' ?>>Layers (Smart Glass / Multi-Domain)</option>
                                <option value="zap" <?= $b['logo_icon'] === 'zap' ? 'selected' : '' ?>>Zap / Lightning (Energy / Automation)</option>
                                <option value="sparkles" <?= $b['logo_icon'] === 'sparkles' ? 'selected' : '' ?>>Sparkles (AI Neural Mesh)</option>
                                <option value="shield" <?= $b['logo_icon'] === 'shield' ? 'selected' : '' ?>>Shield (Security Sentinel)</option>
                                <option value="sun-medium" <?= $b['logo_icon'] === 'sun-medium' ? 'selected' : '' ?>>Sun (Smart Glass & Solar)</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Brand Tagline</label>
                            <input type="text" name="tagline" value="<?= htmlspecialchars($b['tagline']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        </div>
                    </div>

                    <!-- Favicon & Browser Tab Visualizer -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <label class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                    <img src="assets/images/favicon.svg" alt="Favicon" class="w-4 h-4 rounded">
                                    Website Favicon & Browser Tab Icon
                                </label>
                                <p class="text-[11px] text-slate-500">Vector SVG + 32x32 ICO + Apple Touch icon format for high-DPI screens and mobile homescreens.</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="assets/images/favicon.svg" target="_blank" class="text-[11px] font-bold text-blue-600 hover:text-blue-700 px-3 py-1.5 rounded-lg bg-blue-50 border border-blue-200 flex items-center gap-1">
                                    <span>View Favicon SVG</span>
                                    <i data-lucide="external-link" class="w-3 h-3"></i>
                                </a>
                                <a href="favicon.ico" target="_blank" class="text-[11px] font-bold text-slate-600 hover:text-slate-800 px-3 py-1.5 rounded-lg bg-white border border-slate-200">
                                    favicon.ico
                                </a>
                            </div>
                        </div>

                        <!-- Browser Tab Simulation -->
                        <div class="bg-slate-200/80 p-2 rounded-xl flex items-center gap-2">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-2">Tab Preview:</span>
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-white border border-slate-300 shadow-2xs text-xs font-medium text-slate-700 max-w-xs truncate">
                                <img src="assets/images/favicon.svg" alt="Tab Icon" class="w-4 h-4 rounded-xs shrink-0">
                                <span class="truncate text-[11px] font-semibold">IntelliTech &bull; Intelligent Automation & AI Systems</span>
                                <span class="text-slate-400 hover:text-slate-600 ml-1 text-xs cursor-default">&times;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Live Logo Preview -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-600">Navbar Live Logo Render:</span>
                        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-2xs">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white">
                                <i data-lucide="<?= $b['logo_icon'] ?>" class="w-4 h-4"></i>
                            </div>
                            <span class="font-extrabold text-base text-slate-900"><?= htmlspecialchars($b['company_name']) ?><span class="text-blue-600"><?= htmlspecialchars($b['company_suffix']) ?></span></span>
                            <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200"><?= htmlspecialchars($b['brand_tag']) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: RAINBOW COUNTDOWN BANNER -->
            <div id="panel-countdown" class="admin-panel hidden space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm bg-white space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900">🌈 Rainbow Animated Countdown Banner</h2>
                            <p class="text-xs text-slate-500">Add an attention-grabbing countdown with animated rainbow gradient numbers and glowing flip cards.</p>
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <span class="text-xs font-bold text-slate-700">Display Banner:</span>
                            <div class="switch">
                                <input type="checkbox" name="countdown_enabled" <?= $cd['enabled'] ? 'checked' : '' ?>>
                                <span class="slider-toggle"></span>
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Banner Title</label>
                            <input type="text" name="countdown_title" value="<?= htmlspecialchars($cd['title']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Promotion / Incentive Badge</label>
                            <input type="text" name="countdown_badge" value="<?= htmlspecialchars($cd['badge']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Target Expiration Date & Time</label>
                            <input type="datetime-local" name="countdown_target_date" value="<?= htmlspecialchars(substr($cd['target_date'], 0, 16)) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Rainbow Spectrum Colors Active</label>
                            <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="countdown_rainbow" <?= $cd['rainbow_active'] ? 'checked' : '' ?> class="rounded text-blue-600">
                                <span class="text-xs font-bold text-rainbow-glow">Enable Flowing Rainbow Gradient Text</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Incentive Discount Offer Details</label>
                        <textarea name="countdown_discount_text" rows="2" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20"><?= htmlspecialchars($cd['discount_text']) ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">CTA Button Label</label>
                            <input type="text" name="countdown_cta_text" value="<?= htmlspecialchars($cd['cta_text']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">CTA Link</label>
                            <input type="text" name="countdown_cta_link" value="<?= htmlspecialchars($cd['cta_link']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: PRICING & PACKAGES -->
            <div id="panel-pricing" class="admin-panel hidden space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm bg-white space-y-6">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">💰 Pricing & Packages Editor</h2>
                        <p class="text-xs text-slate-500">Add or edit turnkey prices, feature checklists, and highlight popular packages.</p>
                    </div>

                    <div class="space-y-6" id="packages-container">
                        <?php foreach ($pkgs as $idx => $pkg): ?>
                            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-4">
                                <div class="flex items-center justify-between pb-3 border-b border-slate-200">
                                    <span class="text-xs font-extrabold text-slate-800">Package #<?= $idx + 1 ?></span>
                                    <label class="flex items-center gap-1.5 cursor-pointer text-xs font-bold text-cyan-700">
                                        <input type="radio" name="pkg_popular" value="<?= $idx ?>" <?= $pkg['is_popular'] ? 'checked' : '' ?>>
                                        <span>Mark as "Most Popular"</span>
                                    </label>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <div>
                                        <label class="text-xs font-bold text-slate-700 block mb-1">Package Title</label>
                                        <input type="text" name="pkg_title[<?= $idx ?>]" value="<?= htmlspecialchars($pkg['title']) ?>" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-xl">
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-slate-700 block mb-1">Turnkey Price</label>
                                        <input type="text" name="pkg_price[<?= $idx ?>]" value="<?= htmlspecialchars($pkg['price']) ?>" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-xl font-bold text-blue-600">
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-slate-700 block mb-1">Category Badge</label>
                                        <input type="text" name="pkg_category[<?= $idx ?>]" value="<?= htmlspecialchars($pkg['category']) ?>" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-xl">
                                    </div>
                                </div>

                                <div>
                                    <label class="text-xs font-bold text-slate-700 block mb-1">Short Description</label>
                                    <input type="text" name="pkg_description[<?= $idx ?>]" value="<?= htmlspecialchars($pkg['description']) ?>" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-xl">
                                </div>

                                <div>
                                    <label class="text-xs font-bold text-slate-700 block mb-1">Features Checklist (1 per line)</label>
                                    <textarea name="pkg_features[<?= $idx ?>]" rows="4" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-xl"><?= htmlspecialchars(implode("\n", $pkg['features'] ?? [])) ?></textarea>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- TAB 4: HERO & TEXTS -->
            <div id="panel-hero" class="admin-panel hidden space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm bg-white space-y-6">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">📝 Hero Section & Statistics Editor</h2>
                        <p class="text-xs text-slate-500">Edit hero headlines, value proposition texts, and social proof trust numbers.</p>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Hero Pill Badge</label>
                        <input type="text" name="hero_badge" value="<?= htmlspecialchars($b['hero_badge']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Hero Title (Prefix)</label>
                            <input type="text" name="hero_title_prefix" value="<?= htmlspecialchars($b['hero_title_prefix']) ?>" class="w-full px-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-blue-600 block mb-1">Hero Title (Gradient Highlight)</label>
                            <input type="text" name="hero_title_highlight" value="<?= htmlspecialchars($b['hero_title_highlight']) ?>" class="w-full px-3 py-1.5 text-xs bg-slate-50 border border-blue-200 rounded-xl font-bold">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Hero Title (Suffix)</label>
                            <input type="text" name="hero_title_suffix" value="<?= htmlspecialchars($b['hero_title_suffix']) ?>" class="w-full px-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Hero Subtitle</label>
                        <textarea name="hero_subtitle" rows="3" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl"><?= htmlspecialchars($b['hero_subtitle']) ?></textarea>
                    </div>

                    <!-- Statistics Bar -->
                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-xs font-bold text-slate-800 block mb-3">Homepage Social Proof Numbers:</span>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <div>
                                <label class="text-[10px] text-slate-400 block">Homes Count</label>
                                <input type="text" name="stats_homes" value="<?= htmlspecialchars($st['homes']) ?>" class="w-full px-2.5 py-1 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg">
                                <input type="text" name="stats_homes_label" value="<?= htmlspecialchars($st['homes_label']) ?>" class="w-full px-2.5 py-1 text-[11px] bg-slate-50 border border-slate-200 rounded-lg mt-1">
                            </div>
                            <div>
                                <label class="text-[10px] text-slate-400 block">Offices Count</label>
                                <input type="text" name="stats_offices" value="<?= htmlspecialchars($st['offices']) ?>" class="w-full px-2.5 py-1 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg">
                                <input type="text" name="stats_offices_label" value="<?= htmlspecialchars($st['offices_label']) ?>" class="w-full px-2.5 py-1 text-[11px] bg-slate-50 border border-slate-200 rounded-lg mt-1">
                            </div>
                            <div>
                                <label class="text-[10px] text-slate-400 block">Factories Count</label>
                                <input type="text" name="stats_factories" value="<?= htmlspecialchars($st['factories']) ?>" class="w-full px-2.5 py-1 text-xs font-bold bg-slate-50 border border-slate-200 rounded-lg">
                                <input type="text" name="stats_factories_label" value="<?= htmlspecialchars($st['factories_label']) ?>" class="w-full px-2.5 py-1 text-[11px] bg-slate-50 border border-slate-200 rounded-lg mt-1">
                            </div>
                            <div>
                                <label class="text-[10px] text-slate-400 block">Energy Saved</label>
                                <input type="text" name="stats_energy" value="<?= htmlspecialchars($st['energy']) ?>" class="w-full px-2.5 py-1 text-xs font-bold bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg">
                                <input type="text" name="stats_energy_label" value="<?= htmlspecialchars($st['energy_label']) ?>" class="w-full px-2.5 py-1 text-[11px] bg-slate-50 border border-slate-200 rounded-lg mt-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 5: CONTACTS -->
            <div id="panel-contacts" class="admin-panel hidden space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm bg-white space-y-6">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">📞 Contact Details & Physical Addresses</h2>
                        <p class="text-xs text-slate-500">Update phone lines, email addresses, and showroom locations displayed in the footer and contact page.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Phone Number</label>
                            <input type="text" name="contact_phone" value="<?= htmlspecialchars($ct['phone']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Contact Email</label>
                            <input type="email" name="contact_email" value="<?= htmlspecialchars($ct['email']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Support & Operating Hours</label>
                        <input type="text" name="contact_hours" value="<?= htmlspecialchars($ct['hours']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Primary Silicon Valley Address</label>
                            <input type="text" name="contact_address" value="<?= htmlspecialchars($ct['address']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Texas Hub Address</label>
                            <input type="text" name="contact_austin_address" value="<?= htmlspecialchars($ct['austin_address']) ?>" class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl">
                        </div>
                    </div>

                    <!-- Instant Cost Calculator Multipliers -->
                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-xs font-bold text-slate-800 block mb-2">Cost Calculator Multipliers ($/sq ft base rate):</span>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                            <div>
                                <label class="text-[10px] text-slate-400">Home Rate ($)</label>
                                <input type="number" step="0.1" name="calc_home" value="<?= $calc['home_mult'] ?>" class="w-full px-2.5 py-1 text-xs bg-slate-50 border border-slate-200 rounded-lg font-bold">
                            </div>
                            <div>
                                <label class="text-[10px] text-slate-400">Office Rate ($)</label>
                                <input type="number" step="0.1" name="calc_office" value="<?= $calc['office_mult'] ?>" class="w-full px-2.5 py-1 text-xs bg-slate-50 border border-slate-200 rounded-lg font-bold">
                            </div>
                            <div>
                                <label class="text-[10px] text-slate-400">Factory Rate ($)</label>
                                <input type="number" step="0.1" name="calc_factory" value="<?= $calc['factory_mult'] ?>" class="w-full px-2.5 py-1 text-xs bg-slate-50 border border-slate-200 rounded-lg font-bold">
                            </div>
                            <div>
                                <label class="text-[10px] text-slate-400">Smart Glass Rate ($)</label>
                                <input type="number" step="0.1" name="calc_window" value="<?= $calc['window_mult'] ?>" class="w-full px-2.5 py-1 text-xs bg-slate-50 border border-slate-200 rounded-lg font-bold">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 6: VISUALS & MOVING BOXES -->
            <div id="panel-visuals" class="admin-panel hidden space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm bg-white space-y-6">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">✨ Advanced Moving Background Boxes & Glass Effect</h2>
                        <p class="text-xs text-slate-500">Configure floating 3D glass tiles that drift smoothly across the website canvas.</p>
                    </div>

                    <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-200 bg-slate-50 cursor-pointer">
                        <div class="switch">
                            <input type="checkbox" name="vis_floating_boxes" <?= ($vis['enable_floating_boxes'] ?? true) ? 'checked' : '' ?>>
                            <span class="slider-toggle"></span>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-800 block">Enable Animated Floating 3D Glass Boxes</span>
                            <span class="text-[11px] text-slate-400">Renders 5 floating frosted glass tiles with smooth continuous 3D keyframe rotation and translation.</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- TAB 7: QUOTES & INQUIRIES -->
            <div id="panel-quotes" class="admin-panel hidden space-y-6">
                <div class="glass-card rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm bg-white space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-200">
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900">📬 Customer Consultation Requests</h2>
                            <span class="text-xs text-slate-400">Total Leads Received: <?= count($quotes) ?></span>
                        </div>

                        <?php if (!empty($quotes)): ?>
                            <button type="submit" form="form-clear-quotes" onclick="return confirm('Clear all customer inquiries?')" class="px-3 py-1.5 rounded-lg border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold">
                                Clear Inquiries
                            </button>
                        <?php endif; ?>
                    </div>

                    <?php if (empty($quotes)): ?>
                        <div class="p-8 text-center text-xs text-slate-400">
                            No quote requests received yet. Submit the contact form on the public site to test!
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full text-xs text-left">
                                <thead class="bg-slate-50 text-slate-400 font-bold uppercase tracking-wider text-[10px] border-b border-slate-200">
                                    <tr>
                                        <th class="py-2.5 px-3">Date</th>
                                        <th class="py-2.5 px-3">Customer</th>
                                        <th class="py-2.5 px-3">Contact</th>
                                        <th class="py-2.5 px-3">Service</th>
                                        <th class="py-2.5 px-3">Area</th>
                                        <th class="py-2.5 px-3">Message</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <?php foreach ($quotes as $q): ?>
                                        <tr class="hover:bg-slate-50">
                                            <td class="py-2.5 px-3 font-mono text-[10px] text-slate-400"><?= htmlspecialchars($q['created_at'] ?? '') ?></td>
                                            <td class="py-2.5 px-3 font-bold text-slate-900"><?= htmlspecialchars($q['name'] ?? '') ?></td>
                                            <td class="py-2.5 px-3">
                                                <a href="mailto:<?= htmlspecialchars($q['email'] ?? '') ?>" class="text-blue-600 block"><?= htmlspecialchars($q['email'] ?? '') ?></a>
                                                <span class="text-[10px] text-slate-400"><?= htmlspecialchars($q['phone'] ?? '') ?></span>
                                            </td>
                                            <td class="py-2.5 px-3"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700"><?= htmlspecialchars($q['service'] ?? '') ?></span></td>
                                            <td class="py-2.5 px-3 font-mono"><?= htmlspecialchars($q['property_size_sqft'] ?? '') ?> sq ft</td>
                                            <td class="py-2.5 px-3 text-slate-600 max-w-xs truncate" title="<?= htmlspecialchars($q['message'] ?? '') ?>"><?= htmlspecialchars($q['message'] ?? '') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- TAB 8: USER MANAGEMENT & SECURITY -->
            <div id="panel-security" class="admin-panel hidden space-y-6">
                
                <!-- 1. Users Overview & Stats Bar -->
                <div class="glass-card rounded-3xl p-6 sm:p-8 border border-purple-200/90 shadow-sm bg-white space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                        <div>
                            <h2 class="text-base sm:text-lg font-extrabold text-slate-900 flex items-center gap-2">
                                <i data-lucide="users" class="w-5 h-5 text-purple-600"></i>
                                <span>Team & User Account Management</span>
                            </h2>
                            <p class="text-xs text-slate-500 mt-0.5">Provision administrator accounts, assign access roles, reset passwords, and manage active team permissions.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1.5 rounded-xl bg-purple-50 text-purple-700 text-xs font-bold border border-purple-200/80 flex items-center gap-1.5">
                                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                                <span><?= count($allUsers) ?> Registered Accounts</span>
                            </span>
                            <span class="px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200/80 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 beacon-pulse"></span>
                                <span><?= count(array_filter($allUsers, fn($u) => ($u['status'] ?? 'active') === 'active')) ?> Active</span>
                            </span>
                        </div>
                    </div>

                    <!-- 2. Add New User Section -->
                    <div class="p-5 sm:p-6 rounded-2xl bg-gradient-to-br from-purple-50/60 to-slate-50 border border-purple-100/90 space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 flex items-center gap-2">
                                <i data-lucide="user-plus" class="w-4 h-4 text-purple-600"></i>
                                <span>Add New User Account</span>
                            </h3>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Zero-Config Authentication</span>
                        </div>

                        <!-- Form Add User -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="text-[11px] font-bold text-slate-700 block mb-1">Username <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 font-mono text-xs">@</span>
                                    <input 
                                        type="text" 
                                        name="user_username" 
                                        form="form-add-user"
                                        required 
                                        placeholder="e.g. john_doe"
                                        class="w-full pl-7 pr-3 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20 font-bold"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-700 block mb-1">Initial Password <span class="text-rose-500">*</span></label>
                                <div class="relative flex gap-1">
                                    <input 
                                        type="password" 
                                        name="user_password" 
                                        id="new-user-pwd"
                                        form="form-add-user"
                                        required 
                                        placeholder="Min 5 characters"
                                        class="w-full px-3 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                    >
                                    <button 
                                        type="button" 
                                        onclick="generateRandomUserPassword('new-user-pwd')" 
                                        class="px-2.5 py-2 rounded-xl bg-purple-100 hover:bg-purple-200 text-purple-700 text-[11px] font-bold shrink-0 transition-colors"
                                        title="Generate strong random password"
                                    >
                                        Generate
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-700 block mb-1">Full / Display Name</label>
                                <input 
                                    type="text" 
                                    name="user_name" 
                                    form="form-add-user"
                                    placeholder="e.g. John Doe"
                                    class="w-full px-3 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="text-[11px] font-bold text-slate-700 block mb-1">Assigned Role</label>
                                <select name="user_role" form="form-add-user" class="w-full px-3 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                                    <option value="Super Administrator">Super Administrator (Full System Access)</option>
                                    <option value="Operations Manager" selected>Operations Manager (Content, Pricing & Quotes)</option>
                                    <option value="Systems Engineer">Systems Engineer (Hardware & SCADA Telemetry)</option>
                                    <option value="Technician / Field Specialist">Technician / Field Specialist</option>
                                    <option value="Content Editor">Content Editor (Website Texts & Media)</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-700 block mb-1">Work Email</label>
                                <input 
                                    type="email" 
                                    name="user_email" 
                                    form="form-add-user"
                                    placeholder="e.g. john@intellitech.com"
                                    class="w-full px-3 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                >
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-700 block mb-1">Account Status</label>
                                <select name="user_status" form="form-add-user" class="w-full px-3 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20">
                                    <option value="active" selected>Active (Immediate Access)</option>
                                    <option value="inactive">Inactive / Suspended</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-2 flex items-center justify-end">
                            <button 
                                type="submit" 
                                form="form-add-user"
                                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-extrabold text-xs shadow-md shadow-purple-500/20 transition-all flex items-center gap-1.5 hover:scale-[1.02]"
                            >
                                <i data-lucide="user-plus" class="w-4 h-4"></i>
                                <span>Create User Account</span>
                            </button>
                        </div>
                    </div>

                    <!-- 3. Existing Users Roster Table -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 flex items-center gap-2">
                                <i data-lucide="shield" class="w-4 h-4 text-purple-600"></i>
                                <span>Active User Roster (<?= count($allUsers) ?>)</span>
                            </h3>
                            <span class="text-[10px] text-slate-400">Manage credentials and passwords per user</span>
                        </div>

                        <div class="overflow-x-auto rounded-2xl border border-slate-200">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold text-[10px] border-b border-slate-200">
                                    <tr>
                                        <th class="py-3 px-4">User</th>
                                        <th class="py-3 px-4">Role</th>
                                        <th class="py-3 px-4">Contact Email</th>
                                        <th class="py-3 px-4">Status</th>
                                        <th class="py-3 px-4">Last Login</th>
                                        <th class="py-3 px-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 bg-white">
                                    <?php foreach ($allUsers as $u): 
                                        $isCurrent = (strtolower($u['username']) === strtolower($_SESSION['admin_username'] ?? ''));
                                        $initial = strtoupper(substr($u['admin_name'] ?: $u['username'], 0, 1));
                                    ?>
                                        <tr class="hover:bg-slate-50/70 transition-colors">
                                            
                                            <!-- User Column -->
                                            <td class="py-3.5 px-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-extrabold text-xs shadow-2xs">
                                                        <?= htmlspecialchars($initial) ?>
                                                    </div>
                                                    <div>
                                                        <div class="flex items-center gap-1.5 font-bold text-slate-900">
                                                            <span><?= htmlspecialchars($u['admin_name'] ?? $u['username']) ?></span>
                                                            <?php if ($isCurrent): ?>
                                                                <span class="text-[9px] font-extrabold px-1.5 py-0.2 rounded-full bg-blue-100 text-blue-700 border border-blue-200">You</span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <span class="text-[10px] font-mono text-slate-400 block">@<?= htmlspecialchars($u['username']) ?></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Role Column -->
                                            <td class="py-3.5 px-4">
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border <?= 
                                                    str_contains($u['role'] ?? '', 'Super') 
                                                        ? 'bg-purple-50 text-purple-700 border-purple-200' 
                                                        : (str_contains($u['role'] ?? '', 'Engineer')
                                                            ? 'bg-cyan-50 text-cyan-700 border-cyan-200'
                                                            : 'bg-blue-50 text-blue-700 border-blue-200') ?>">
                                                    <?= htmlspecialchars($u['role'] ?? 'Administrator') ?>
                                                </span>
                                            </td>

                                            <!-- Email Column -->
                                            <td class="py-3.5 px-4 text-slate-600 font-mono text-[11px]">
                                                <?= htmlspecialchars($u['email'] ?? ($u['username'] . '@intellitech.com')) ?>
                                            </td>

                                            <!-- Status Column -->
                                            <td class="py-3.5 px-4">
                                                <?php if (($u['status'] ?? 'active') === 'active'): ?>
                                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 beacon-pulse"></span>
                                                        <span>Active</span>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                                        <span>Inactive</span>
                                                    </span>
                                                <?php endif; ?>
                                            </td>

                                            <!-- Last Login -->
                                            <td class="py-3.5 px-4 text-[10px] font-mono text-slate-400">
                                                <?= !empty($u['last_login']) ? htmlspecialchars($u['last_login']) : '<span class="text-slate-300">Never</span>' ?>
                                            </td>

                                            <!-- Action Buttons -->
                                            <td class="py-3.5 px-4 text-right">
                                                <div class="inline-flex items-center gap-1">
                                                    <!-- Change Password Trigger -->
                                                    <button 
                                                        type="button" 
                                                        onclick="toggleUserPanel('pwd-row-<?= $u['id'] ?>')"
                                                        class="p-1.5 rounded-lg border border-purple-200 bg-purple-50 hover:bg-purple-100 text-purple-700 font-bold transition-colors"
                                                        title="Change Password"
                                                    >
                                                        <i data-lucide="key" class="w-3.5 h-3.5"></i>
                                                    </button>

                                                    <!-- Edit User Trigger -->
                                                    <button 
                                                        type="button" 
                                                        onclick="toggleUserPanel('edit-row-<?= $u['id'] ?>')"
                                                        class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold transition-colors"
                                                        title="Edit User Details"
                                                    >
                                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                                    </button>

                                                    <!-- Delete User Trigger -->
                                                    <?php if (!$isCurrent && count($allUsers) > 1): ?>
                                                        <button 
                                                            type="submit" 
                                                            form="form-del-user-<?= $u['id'] ?>"
                                                            class="p-1.5 rounded-lg border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold transition-colors"
                                                            title="Delete Account"
                                                        >
                                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                        </button>
                                                    <?php else: ?>
                                                        <button 
                                                            type="button" 
                                                            disabled 
                                                            class="p-1.5 rounded-lg border border-slate-100 bg-slate-50 text-slate-300 cursor-not-allowed" 
                                                            title="<?= $isCurrent ? 'Cannot delete your own active account' : 'Cannot delete the only account' ?>"
                                                        >
                                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Expandable Inline Password Change Sub-Row -->
                                        <tr id="pwd-row-<?= $u['id'] ?>" class="hidden bg-purple-50/50">
                                            <td colspan="6" class="p-4 border-t border-purple-100">
                                                <form method="POST" action="admin.php" class="flex flex-wrap items-center gap-3">
                                                    <input type="hidden" name="admin_action" value="change_user_password">
                                                    <input type="hidden" name="pwd_user_id" value="<?= htmlspecialchars($u['id']) ?>">
                                                    <div class="flex items-center gap-2">
                                                        <i data-lucide="key" class="w-4 h-4 text-purple-600"></i>
                                                        <span class="text-xs font-bold text-purple-900">Change Password for <strong>@<?= htmlspecialchars($u['username']) ?></strong>:</span>
                                                    </div>
                                                    <input 
                                                        type="password" 
                                                        name="pwd_new_password" 
                                                        id="inline-pwd-<?= $u['id'] ?>"
                                                        required 
                                                        placeholder="New password (min 5)" 
                                                        class="px-3 py-1.5 text-xs bg-white border border-purple-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                                    >
                                                    <input 
                                                        type="password" 
                                                        name="pwd_confirm_password" 
                                                        required 
                                                        placeholder="Confirm password" 
                                                        class="px-3 py-1.5 text-xs bg-white border border-purple-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                                    >
                                                    <button 
                                                        type="button" 
                                                        onclick="generateRandomUserPassword('inline-pwd-<?= $u['id'] ?>')" 
                                                        class="px-2.5 py-1.5 rounded-lg bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold"
                                                    >
                                                        Generate
                                                    </button>
                                                    <button 
                                                        type="submit" 
                                                        class="px-4 py-1.5 rounded-lg bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs shadow-xs"
                                                    >
                                                        Save Password
                                                    </button>
                                                    <button 
                                                        type="button" 
                                                        onclick="toggleUserPanel('pwd-row-<?= $u['id'] ?>')" 
                                                        class="px-3 py-1.5 rounded-lg border border-slate-300 text-slate-600 text-xs hover:bg-white"
                                                    >
                                                        Cancel
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Expandable Inline Edit User Details Sub-Row -->
                                        <tr id="edit-row-<?= $u['id'] ?>" class="hidden bg-slate-50">
                                            <td colspan="6" class="p-4 border-t border-slate-200">
                                                <form method="POST" action="admin.php" class="space-y-3">
                                                    <input type="hidden" name="admin_action" value="edit_user">
                                                    <input type="hidden" name="edit_user_id" value="<?= htmlspecialchars($u['id']) ?>">
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                                            <i data-lucide="edit-3" class="w-3.5 h-3.5 text-blue-600"></i>
                                                            Edit Account Profile: <strong>@<?= htmlspecialchars($u['username']) ?></strong>
                                                        </span>
                                                        <button type="button" onclick="toggleUserPanel('edit-row-<?= $u['id'] ?>')" class="text-slate-400 hover:text-slate-600 text-xs font-bold">&times; Close</button>
                                                    </div>
                                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                                        <div>
                                                            <label class="text-[11px] font-bold text-slate-600 block mb-1">Display Name</label>
                                                            <input type="text" name="edit_name" value="<?= htmlspecialchars($u['admin_name'] ?? '') ?>" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg">
                                                        </div>
                                                        <div>
                                                            <label class="text-[11px] font-bold text-slate-600 block mb-1">Username</label>
                                                            <input type="text" name="edit_username" value="<?= htmlspecialchars($u['username']) ?>" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg font-bold">
                                                        </div>
                                                        <div>
                                                            <label class="text-[11px] font-bold text-slate-600 block mb-1">Email</label>
                                                            <input type="email" name="edit_email" value="<?= htmlspecialchars($u['email'] ?? '') ?>" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg">
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                                        <div>
                                                            <label class="text-[11px] font-bold text-slate-600 block mb-1">Role</label>
                                                            <select name="edit_role" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg">
                                                                <option value="Super Administrator" <?= ($u['role'] ?? '') === 'Super Administrator' ? 'selected' : '' ?>>Super Administrator</option>
                                                                <option value="Operations Manager" <?= ($u['role'] ?? '') === 'Operations Manager' ? 'selected' : '' ?>>Operations Manager</option>
                                                                <option value="Systems Engineer" <?= ($u['role'] ?? '') === 'Systems Engineer' ? 'selected' : '' ?>>Systems Engineer</option>
                                                                <option value="Technician / Field Specialist" <?= ($u['role'] ?? '') === 'Technician / Field Specialist' ? 'selected' : '' ?>>Technician / Field Specialist</option>
                                                                <option value="Content Editor" <?= ($u['role'] ?? '') === 'Content Editor' ? 'selected' : '' ?>>Content Editor</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="text-[11px] font-bold text-slate-600 block mb-1">Status</label>
                                                            <select name="edit_status" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg">
                                                                <option value="active" <?= ($u['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
                                                                <option value="inactive" <?= ($u['status'] ?? 'active') === 'inactive' ? 'selected' : '' ?>>Inactive (Suspended)</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="text-[11px] font-bold text-slate-600 block mb-1">Reset Password (Optional)</label>
                                                            <input type="password" name="edit_password" placeholder="Leave empty to keep current" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg">
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center justify-end gap-2 pt-1">
                                                        <button type="button" onclick="toggleUserPanel('edit-row-<?= $u['id'] ?>')" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 text-xs">Cancel</button>
                                                        <button type="submit" class="px-4 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-xs">Save Changes</button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- 4. Quick Personal Password Update for Current Logged-in Administrator -->
                    <div class="p-5 sm:p-6 rounded-2xl bg-purple-50/50 border border-purple-100 space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 flex items-center gap-2">
                                <i data-lucide="key" class="w-4 h-4 text-purple-600"></i>
                                <span>Quick Update: My Personal Credentials</span>
                            </h3>
                            <span class="text-[10px] font-bold text-purple-700 bg-purple-100/80 px-2.5 py-0.5 rounded-full">
                                Currently logged in as @<?= htmlspecialchars($_SESSION['admin_username'] ?? 'admin') ?>
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1">My Display Name</label>
                                <input 
                                    type="text" 
                                    name="auth_admin_name" 
                                    form="form-change-creds"
                                    value="<?= htmlspecialchars($currentAuthUser['admin_name'] ?? 'Master Administrator') ?>" 
                                    class="w-full px-3.5 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                >
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1">My Username</label>
                                <input 
                                    type="text" 
                                    name="auth_new_username" 
                                    form="form-change-creds"
                                    required
                                    value="<?= htmlspecialchars($currentAuthUser['username'] ?? 'admin') ?>" 
                                    class="w-full px-3.5 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20 font-bold"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-purple-100">
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1">New Password (leave blank to keep current)</label>
                                <input 
                                    type="password" 
                                    name="auth_new_password" 
                                    form="form-change-creds"
                                    placeholder="Enter new strong password" 
                                    class="w-full px-3.5 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                >
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1">Confirm New Password</label>
                                <input 
                                    type="password" 
                                    name="auth_confirm_password" 
                                    form="form-change-creds"
                                    placeholder="Repeat new password" 
                                    class="w-full px-3.5 py-2 text-xs bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20"
                                >
                            </div>
                        </div>

                        <div class="pt-2 flex items-center justify-between">
                            <span class="text-[11px] text-slate-400">Last updated: <?= htmlspecialchars($currentAuthUser['updated_at'] ?? 'Never') ?></span>
                            <button 
                                type="submit" 
                                form="form-change-creds"
                                class="px-5 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-extrabold text-xs shadow-md transition-all flex items-center gap-1.5"
                            >
                                <i data-lucide="key" class="w-3.5 h-3.5"></i>
                                <span>Save My Credentials</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </form>

        <!-- Hidden form for adding a new user -->
        <form id="form-add-user" method="POST" action="admin.php">
            <input type="hidden" name="admin_action" value="add_user">
        </form>

        <!-- Hidden forms for deleting users -->
        <?php foreach ($allUsers as $u): ?>
            <form id="form-del-user-<?= $u['id'] ?>" method="POST" action="admin.php" onsubmit="return confirm('Are you sure you want to permanently delete user @<?= htmlspecialchars($u['username']) ?>?');">
                <input type="hidden" name="admin_action" value="delete_user">
                <input type="hidden" name="delete_user_id" value="<?= htmlspecialchars($u['id']) ?>">
            </form>
        <?php endforeach; ?>

        <!-- Hidden form for updating personal credentials -->
        <form id="form-change-creds" method="POST" action="admin.php">
            <input type="hidden" name="admin_action" value="change_credentials">
        </form>

        <!-- Hidden form for clearing inquiries -->
        <form id="form-clear-quotes" method="POST" action="admin.php">
            <input type="hidden" name="admin_action" value="clear_quotes">
        </form>

    </div>

    <script>
    function switchAdminTab(tabKey) {
        document.querySelectorAll('.admin-panel').forEach(p => p.classList.add('hidden'));
        const panel = document.getElementById('panel-' + tabKey);
        if (panel) panel.classList.remove('hidden');

        document.querySelectorAll('.admin-tab-btn').forEach(btn => {
            btn.className = "admin-tab-btn px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50";
        });
        const activeBtn = document.getElementById('tab-btn-' + tabKey);
        if (activeBtn) {
            activeBtn.className = "admin-tab-btn px-4 py-2 rounded-xl bg-blue-600 text-white shadow-xs";
        }
        try {
            localStorage.setItem('intellitech_admin_active_tab', tabKey);
        } catch(e) {}
    }

    function toggleUserPanel(panelId) {
        const el = document.getElementById(panelId);
        if (!el) return;
        el.classList.toggle('hidden');
        if (!el.classList.contains('hidden')) {
            el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    function generateRandomUserPassword(targetInputId) {
        const chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789!@#$%';
        let pwd = '';
        for (let i = 0; i < 10; i++) {
            pwd += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        const input = document.getElementById(targetInputId);
        if (input) {
            input.value = pwd;
            input.type = 'text';
            input.select();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) window.lucide.createIcons();

        // Restore active tab
        const phpActiveTab = '<?= $activeTab ?? "branding" ?>';
        if (phpActiveTab !== 'branding') {
            switchAdminTab(phpActiveTab);
        } else {
            const saved = localStorage.getItem('intellitech_admin_active_tab');
            if (saved && document.getElementById('panel-' + saved)) {
                switchAdminTab(saved);
            }
        }
    });
    </script>
    <?php endif; ?>

</body>
</html>
