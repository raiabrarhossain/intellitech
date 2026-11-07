<?php
// IntelliTech Solutions - Master Administration & Operations Hub
// Comprehensive Dashboard: Orders, Surveys, Analytics, Inventory, Purchases & Inquiries
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/data/AuthManager.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$ordersFile = __DIR__ . '/data/orders.json';
$surveysFile = __DIR__ . '/data/surveys.json';
$purchasesFile = __DIR__ . '/data/purchases.json';
$productsFile = __DIR__ . '/data/products.json';
$messagesFile = __DIR__ . '/data/messages.json';
$contentFile = __DIR__ . '/data/site_content.json';
$navFile = __DIR__ . '/data/navigation.json';
$footerFile = __DIR__ . '/data/footer_links.json';

$message = '';
$messageType = '';

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    AuthManager::logout();
    header('Location: admin.php?logged_out=1');
    exit;
}

if (isset($_GET['logged_out'])) {
    $message = 'You have safely signed out of IntelliTech Admin.';
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
        $message = 'Invalid username or password. (Default: admin / admin123)';
        $messageType = 'error';
    }
}

// Check authentication
$isAuthenticated = AuthManager::isLoggedIn();

// Handle Authenticated Actions
if ($isAuthenticated && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['admin_action'] ?? '';

    // 1. Update Order Status
    if ($action === 'update_order_status') {
        $orderId = trim($_POST['order_id'] ?? '');
        $newStatus = trim($_POST['new_status'] ?? '');
        if ($orderId && $newStatus && file_exists($ordersFile)) {
            $orders = json_decode(file_get_contents($ordersFile), true) ?: [];
            foreach ($orders as &$ord) {
                if ($ord['id'] === $orderId) {
                    $ord['status'] = $newStatus;
                    $ord['updated_at'] = date('Y-m-d H:i:s');
                    break;
                }
            }
            file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Order #{$orderId} status updated to '{$newStatus}' successfully!";
            $messageType = 'success';
        }
    }

    // 2. Delete Order
    if ($action === 'delete_order') {
        $orderId = trim($_POST['order_id'] ?? '');
        if ($orderId && file_exists($ordersFile)) {
            $orders = json_decode(file_get_contents($ordersFile), true) ?: [];
            $orders = array_values(array_filter($orders, fn($o) => $o['id'] !== $orderId));
            file_put_contents($ordersFile, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Order #{$orderId} deleted successfully.";
            $messageType = 'info';
        }
    }

    // 3. Update Survey Status & Assign Engineer
    if ($action === 'update_survey') {
        $surveyId = trim($_POST['survey_id'] ?? '');
        $status = trim($_POST['survey_status'] ?? '');
        $eng = trim($_POST['assigned_engineer'] ?? '');
        $date = trim($_POST['scheduled_date'] ?? '');
        $notes = trim($_POST['notes'] ?? '');

        if ($surveyId && file_exists($surveysFile)) {
            $surveys = json_decode(file_get_contents($surveysFile), true) ?: [];
            foreach ($surveys as &$surv) {
                if ($surv['id'] === $surveyId) {
                    if ($status) $surv['status'] = $status;
                    if ($eng) $surv['assigned_engineer'] = $eng;
                    if ($date) $surv['scheduled_date'] = $date;
                    if ($notes) $surv['notes'] = $notes;
                    $surv['updated_at'] = date('Y-m-d H:i:s');
                    break;
                }
            }
            file_put_contents($surveysFile, json_encode($surveys, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Survey booking #{$surveyId} updated successfully!";
            $messageType = 'success';
        }
    }

    // 4. Add Manual Survey Booking
    if ($action === 'add_survey_manual') {
        $name = trim($_POST['cust_name'] ?? '');
        $phone = trim($_POST['cust_phone'] ?? '');
        $city = trim($_POST['city'] ?? 'Faisalabad');
        $property = trim($_POST['property'] ?? '1 Kanal Luxury Villa');
        $statusConst = trim($_POST['construction_status'] ?? 'Retrofit (Ready Home)');
        $reqs = trim($_POST['requirements'] ?? '');
        $eng = trim($_POST['engineer'] ?? 'Faisalabad HQ Engineering Team');
        $sched = trim($_POST['sched_date'] ?? date('Y-m-d 11:00'));

        if ($name && $phone && file_exists($surveysFile)) {
            $surveys = json_decode(file_get_contents($surveysFile), true) ?: [];
            $newId = 'SURV-' . rand(100, 999);
            $newSurvey = [
                'id' => $newId,
                'created_at' => date('Y-m-d H:i:s'),
                'customer_name' => htmlspecialchars($name),
                'customer_phone' => htmlspecialchars($phone),
                'city' => htmlspecialchars($city),
                'property' => htmlspecialchars($property),
                'construction_status' => htmlspecialchars($statusConst),
                'requirements' => htmlspecialchars($reqs),
                'assigned_engineer' => htmlspecialchars($eng),
                'scheduled_date' => htmlspecialchars($sched),
                'status' => 'Survey Scheduled',
                'notes' => 'Booked directly by admin/helpline staff.'
            ];
            array_unshift($surveys, $newSurvey);
            file_put_contents($surveysFile, json_encode($surveys, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "New on-site CAD survey #{$newId} logged successfully!";
            $messageType = 'success';
        }
    }

    // 5. Delete Survey
    if ($action === 'delete_survey') {
        $surveyId = trim($_POST['survey_id'] ?? '');
        if ($surveyId && file_exists($surveysFile)) {
            $surveys = json_decode(file_get_contents($surveysFile), true) ?: [];
            $surveys = array_values(array_filter($surveys, fn($s) => $s['id'] !== $surveyId));
            file_put_contents($surveysFile, json_encode($surveys, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Survey booking #{$surveyId} removed.";
            $messageType = 'info';
        }
    }

    // 6. Record Purchase / Stock Intake ("purcase handel")
    if ($action === 'add_purchase') {
        $supplier = trim($_POST['supplier'] ?? 'Tuya Global');
        $invoice = trim($_POST['invoice_no'] ?? 'INV-' . rand(1000, 9999));
        $prodId = trim($_POST['product_id'] ?? '');
        $qty = max(1, intval($_POST['quantity'] ?? 10));
        $unitCost = intval($_POST['unit_cost'] ?? 0);
        $notes = trim($_POST['notes'] ?? '');
        $totalCost = $qty * $unitCost;

        if ($supplier && file_exists($purchasesFile)) {
            $purchases = json_decode(file_get_contents($purchasesFile), true) ?: [];
            $poId = 'PO-' . rand(1000, 9999);
            $newPO = [
                'id' => $poId,
                'date' => date('Y-m-d'),
                'supplier' => htmlspecialchars($supplier),
                'invoice_no' => htmlspecialchars($invoice),
                'product_id' => $prodId,
                'items_count' => $qty,
                'unit_cost' => $unitCost,
                'total_cost' => $totalCost,
                'payment_status' => 'Paid',
                'notes' => htmlspecialchars($notes)
            ];
            array_unshift($purchases, $newPO);
            file_put_contents($purchasesFile, json_encode($purchases, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

            // Automatically increment product stock in products.json
            if ($prodId && file_exists($productsFile)) {
                $prods = json_decode(file_get_contents($productsFile), true) ?: [];
                foreach ($prods as &$p) {
                    if ($p['id'] === $prodId) {
                        $p['stock'] = ($p['stock'] ?? 0) + $qty;
                        if ($unitCost > 0) $p['cost_price'] = $unitCost;
                        break;
                    }
                }
                file_put_contents($productsFile, json_encode($prods, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            }

            $message = "Purchase order #{$poId} recorded! +{$qty} units added to stock.";
            $messageType = 'success';
        }
    }

    // 7. Update Product Stock / Price
    if ($action === 'update_product_stock') {
        $prodId = trim($_POST['product_id'] ?? '');
        $newStock = intval($_POST['stock'] ?? 0);
        $newPrice = intval($_POST['price'] ?? 0);
        $newCost = intval($_POST['cost_price'] ?? 0);

        if ($prodId && file_exists($productsFile)) {
            $prods = json_decode(file_get_contents($productsFile), true) ?: [];
            foreach ($prods as &$p) {
                if ($p['id'] === $prodId) {
                    $p['stock'] = max(0, $newStock);
                    if ($newPrice > 0) $p['price'] = $newPrice;
                    if ($newCost > 0) $p['cost_price'] = $newCost;
                    break;
                }
            }
            file_put_contents($productsFile, json_encode($prods, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Product inventory for '{$prodId}' updated successfully!";
            $messageType = 'success';
        }
    }

    // 8. Update Message Status
    if ($action === 'update_message_status') {
        $msgId = trim($_POST['msg_id'] ?? '');
        $status = trim($_POST['status'] ?? 'Replied');
        if ($msgId && file_exists($messagesFile)) {
            $msgs = json_decode(file_get_contents($messagesFile), true) ?: [];
            foreach ($msgs as &$m) {
                if ($m['id'] === $msgId) {
                    $m['status'] = $status;
                    break;
                }
            }
            file_put_contents($messagesFile, json_encode($msgs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Inquiry marked as {$status}.";
            $messageType = 'info';
        }
    }

    // 9. Save Company Settings
    if ($action === 'save_settings') {
        $content = ContentManager::load();
        $content['contacts']['phone'] = trim($_POST['phone'] ?? '');
        $content['contacts']['phone_secondary'] = trim($_POST['phone_secondary'] ?? '');
        $content['contacts']['email'] = trim($_POST['email'] ?? 'info@intellitech.pk');
        $content['contacts']['address'] = trim($_POST['address_faisalabad'] ?? 'Plaza 18, Main Susan Road, Kohinoor City, Faisalabad, Punjab, Pakistan');
        $content['contacts']['faisalabad_address'] = trim($_POST['address_faisalabad'] ?? 'Plaza 18, Main Susan Road, Kohinoor City, Faisalabad, Punjab, Pakistan');
        $content['contacts']['office_title'] = 'Faisalabad Virtual Office';
        ContentManager::save($content);
        $message = "Store and Faisalabad virtual office contact settings updated successfully!";
        $messageType = 'success';
    }

    // 10. Change Admin Password
    if ($action === 'change_password') {
        $newPass = trim($_POST['new_password'] ?? '');
        if (strlen($newPass) >= 6) {
            $authData = AuthManager::getRawData();
            foreach ($authData['users'] as &$u) {
                if ($u['username'] === $_SESSION['admin_user']) {
                    $u['password_hash'] = password_hash($newPass, PASSWORD_DEFAULT);
                    $u['updated_at'] = date('Y-m-d H:i:s');
                    break;
                }
            }
            AuthManager::saveRawData($authData);
            $message = "Admin password updated successfully!";
            $messageType = 'success';
        } else {
            $message = "Password must be at least 6 characters long.";
            $messageType = 'error';
        }
    }

    // 11. Navbar Link Management
    if ($action === 'add_nav_item') {
        $title = trim($_POST['title'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $page = trim($_POST['page'] ?? '');
        $badge = trim($_POST['badge'] ?? '');
        $badgeColor = trim($_POST['badge_color'] ?? 'blue');
        $order = intval($_POST['order'] ?? 1);
        $active = isset($_POST['active']) && $_POST['active'] == '1';

        if (!$page && preg_match('/page=([a-z0-9_-]+)/i', $url, $m)) {
            $page = strtolower($m[1]);
        }

        if ($title && $url && file_exists($navFile)) {
            $navItems = json_decode(file_get_contents($navFile), true) ?: [];
            $newId = 'nav_' . substr(preg_replace('/[^a-z0-9]/', '', strtolower($title)), 0, 15) . '_' . rand(10, 99);
            $navItems[] = [
                'id' => $newId,
                'title' => htmlspecialchars($title),
                'url' => htmlspecialchars($url),
                'page' => htmlspecialchars($page),
                'badge' => htmlspecialchars($badge),
                'badge_color' => htmlspecialchars($badgeColor),
                'order' => $order,
                'active' => $active
            ];
            usort($navItems, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));
            file_put_contents($navFile, json_encode($navItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Navbar link '{$title}' added successfully!";
            $messageType = 'success';
        }
    }

    if ($action === 'update_nav_item') {
        $navId = trim($_POST['nav_id'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $url = trim($_POST['url'] ?? '');
        $page = trim($_POST['page'] ?? '');
        $badge = trim($_POST['badge'] ?? '');
        $badgeColor = trim($_POST['badge_color'] ?? 'blue');
        $order = intval($_POST['order'] ?? 1);
        $active = isset($_POST['active']) && $_POST['active'] == '1';

        if (!$page && preg_match('/page=([a-z0-9_-]+)/i', $url, $m)) {
            $page = strtolower($m[1]);
        }

        if ($navId && $title && file_exists($navFile)) {
            $navItems = json_decode(file_get_contents($navFile), true) ?: [];
            foreach ($navItems as &$item) {
                if ($item['id'] === $navId) {
                    $item['title'] = htmlspecialchars($title);
                    $item['url'] = htmlspecialchars($url);
                    $item['page'] = htmlspecialchars($page);
                    $item['badge'] = htmlspecialchars($badge);
                    $item['badge_color'] = htmlspecialchars($badgeColor);
                    $item['order'] = $order;
                    $item['active'] = $active;
                    break;
                }
            }
            usort($navItems, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));
            file_put_contents($navFile, json_encode($navItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Navbar link '{$title}' updated successfully!";
            $messageType = 'success';
        }
    }

    if ($action === 'delete_nav_item') {
        $navId = trim($_POST['nav_id'] ?? '');
        if ($navId && file_exists($navFile)) {
            $navItems = json_decode(file_get_contents($navFile), true) ?: [];
            $navItems = array_values(array_filter($navItems, fn($n) => $n['id'] !== $navId));
            file_put_contents($navFile, json_encode($navItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Navbar link removed successfully.";
            $messageType = 'info';
        }
    }

    if ($action === 'toggle_nav_item') {
        $navId = trim($_POST['nav_id'] ?? '');
        if ($navId && file_exists($navFile)) {
            $navItems = json_decode(file_get_contents($navFile), true) ?: [];
            foreach ($navItems as &$item) {
                if ($item['id'] === $navId) {
                    $item['active'] = !($item['active'] ?? true);
                    break;
                }
            }
            file_put_contents($navFile, json_encode($navItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Navbar link visibility updated!";
            $messageType = 'info';
        }
    }

    // 12. Footer Link Management
    if ($action === 'add_footer_link') {
        $section = trim($_POST['section'] ?? 'quick_links');
        $title = trim($_POST['title'] ?? '');
        $url = trim($_POST['url'] ?? '');

        if ($section && $title && $url && file_exists($footerFile)) {
            $footerData = json_decode(file_get_contents($footerFile), true) ?: [];
            if (isset($footerData[$section])) {
                $footerData[$section]['links'][] = [
                    'id' => 'fl_' . rand(100, 9999),
                    'title' => htmlspecialchars($title),
                    'url' => htmlspecialchars($url)
                ];
                file_put_contents($footerFile, json_encode($footerData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
                $message = "Footer link '{$title}' added to '{$footerData[$section]['title']}'!";
                $messageType = 'success';
            }
        }
    }

    if ($action === 'delete_footer_link') {
        $section = trim($_POST['section'] ?? '');
        $linkId = trim($_POST['link_id'] ?? '');

        if ($section && $linkId && file_exists($footerFile)) {
            $footerData = json_decode(file_get_contents($footerFile), true) ?: [];
            if (isset($footerData[$section]['links'])) {
                $footerData[$section]['links'] = array_values(array_filter($footerData[$section]['links'], fn($l) => $l['id'] !== $linkId));
                file_put_contents($footerFile, json_encode($footerData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
                $message = "Footer link removed successfully.";
                $messageType = 'info';
            }
        }
    }

    if ($action === 'update_footer_title') {
        $section = trim($_POST['section'] ?? '');
        $sectionTitle = trim($_POST['section_title'] ?? '');

        if ($section && $sectionTitle && file_exists($footerFile)) {
            $footerData = json_decode(file_get_contents($footerFile), true) ?: [];
            if (isset($footerData[$section])) {
                $footerData[$section]['title'] = htmlspecialchars($sectionTitle);
                file_put_contents($footerFile, json_encode($footerData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
                $message = "Footer column title updated to '{$sectionTitle}'!";
                $messageType = 'success';
            }
        }
    }

    // 13. Rates & Product Catalog Management
    if ($action === 'update_product_rate') {
        $prodId = trim($_POST['product_id'] ?? '');
        $price = intval($_POST['price'] ?? 0);
        $origPrice = intval($_POST['original_price'] ?? 0);
        $stock = intval($_POST['stock'] ?? 0);
        $costPrice = intval($_POST['cost_price'] ?? 0);

        if ($prodId && file_exists($productsFile)) {
            $prods = json_decode(file_get_contents($productsFile), true) ?: [];
            foreach ($prods as &$p) {
                if ($p['id'] === $prodId) {
                    if ($price > 0) $p['price'] = $price;
                    if ($origPrice > 0) $p['original_price'] = $origPrice;
                    $p['stock'] = max(0, $stock);
                    if ($costPrice > 0) $p['cost_price'] = $costPrice;
                    break;
                }
            }
            file_put_contents($productsFile, json_encode($prods, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Rate and stock for '{$prodId}' updated successfully! (Price: Rs. " . number_format($price) . ")";
            $messageType = 'success';
        }
    }

    if ($action === 'add_product') {
        $name = trim($_POST['name'] ?? '');
        $category = trim($_POST['category'] ?? 'zigbee');
        $catLabel = trim($_POST['category_label'] ?? 'Zigbee Devices');
        $price = intval($_POST['price'] ?? 0);
        $origPrice = intval($_POST['original_price'] ?? 0);
        $costPrice = intval($_POST['cost_price'] ?? 0);
        $stock = intval($_POST['stock'] ?? 10);
        $badge = trim($_POST['badge'] ?? '');
        $badgeColor = trim($_POST['badge_color'] ?? 'blue');
        $img = trim($_POST['image'] ?? 'assets/images/okasha/Smart_Gateway-3_in_1_4c6b1173-8555-4990-9d59-8b961182d5df.webp');
        $shortDesc = trim($_POST['short_desc'] ?? '');

        if ($name && $price > 0 && file_exists($productsFile)) {
            $prods = json_decode(file_get_contents($productsFile), true) ?: [];
            $newId = preg_replace('/[^a-z0-9_-]/', '', strtolower(str_replace(' ', '-', $name))) ?: ('prod-' . rand(100, 999));
            // Ensure unique ID
            $existingIds = array_column($prods, 'id');
            if (in_array($newId, $existingIds)) {
                $newId .= '-' . rand(10, 99);
            }

            $newProduct = [
                'id' => $newId,
                'name' => htmlspecialchars($name),
                'category' => htmlspecialchars($category),
                'category_label' => htmlspecialchars($catLabel),
                'price' => $price,
                'original_price' => $origPrice > 0 ? $origPrice : intval($price * 1.2),
                'rating' => 5.0,
                'reviews_count' => 12,
                'badge' => htmlspecialchars($badge),
                'badge_color' => htmlspecialchars($badgeColor),
                'image' => htmlspecialchars($img),
                'fallback_image' => '',
                'short_desc' => htmlspecialchars($desc ?: $name),
                'specs' => [
                    'Protocol' => 'Zigbee 3.0 / Tuya IoT',
                    'Warranty' => '1 Year Official Replacement'
                ],
                'features' => [
                    'Zero Wi-Fi overload',
                    'Faisalabad Virtual Office Support',
                    '1 Year Replacement Warranty'
                ],
                'stock' => max(0, $stock),
                'cost_price' => $costPrice > 0 ? $costPrice : intval($price * 0.65)
            ];

            array_unshift($prods, $newProduct);
            file_put_contents($productsFile, json_encode($prods, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "New product '{$name}' added to catalog with rate Rs. " . number_format($price) . "!";
            $messageType = 'success';
        }
    }

    if ($action === 'delete_product') {
        $prodId = trim($_POST['product_id'] ?? '');
        if ($prodId && file_exists($productsFile)) {
            $prods = json_decode(file_get_contents($productsFile), true) ?: [];
            $prods = array_values(array_filter($prods, fn($p) => $p['id'] !== $prodId));
            file_put_contents($productsFile, json_encode($prods, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $message = "Product #{$prodId} removed from catalog.";
            $messageType = 'info';
        }
    }

    // 14. User & Staff Management
    if ($action === 'add_user') {
        $uname = trim($_POST['username'] ?? '');
        $upass = trim($_POST['password'] ?? '');
        $unameFull = trim($_POST['admin_name'] ?? '');
        $urole = trim($_POST['role'] ?? 'Operations Manager');
        $uemail = trim($_POST['email'] ?? '');
        $ustatus = trim($_POST['status'] ?? 'active');

        $res = AuthManager::addUser($uname, $upass, $unameFull, $urole, $uemail, $ustatus);
        if ($res['success']) {
            $message = "Staff user '{$uname}' created successfully!";
            $messageType = 'success';
        } else {
            $message = "User creation failed: " . ($res['error'] ?? 'Unknown error');
            $messageType = 'error';
        }
    }

    if ($action === 'update_user') {
        $userId = trim($_POST['user_id'] ?? '');
        $updates = [
            'admin_name' => trim($_POST['admin_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'role' => trim($_POST['role'] ?? ''),
            'status' => trim($_POST['status'] ?? 'active')
        ];
        if (!empty($_POST['new_password'])) {
            $updates['password'] = trim($_POST['new_password']);
        }
        $res = AuthManager::updateUser($userId, $updates);
        if ($res['success']) {
            $message = "User details updated successfully!";
            $messageType = 'success';
        } else {
            $message = "Update failed: " . ($res['error'] ?? 'Unknown error');
            $messageType = 'error';
        }
    }

    if ($action === 'delete_user') {
        $userId = trim($_POST['user_id'] ?? '');
        $res = AuthManager::deleteUser($userId, $_SESSION['admin_user'] ?? '');
        if ($res['success']) {
            $message = "User account removed.";
            $messageType = 'info';
        } else {
            $message = "Delete failed: " . ($res['error'] ?? 'Unknown error');
            $messageType = 'error';
        }
    }
}

// Load Datasets
$orders = file_exists($ordersFile) ? (json_decode(file_get_contents($ordersFile), true) ?: []) : [];
$surveys = file_exists($surveysFile) ? (json_decode(file_get_contents($surveysFile), true) ?: []) : [];
$purchases = file_exists($purchasesFile) ? (json_decode(file_get_contents($purchasesFile), true) ?: []) : [];
$products = file_exists($productsFile) ? (json_decode(file_get_contents($productsFile), true) ?: []) : [];
$messages = file_exists($messagesFile) ? (json_decode(file_get_contents($messagesFile), true) ?: []) : [];
$navItems = file_exists($navFile) ? (json_decode(file_get_contents($navFile), true) ?: []) : [];
$footerData = file_exists($footerFile) ? (json_decode(file_get_contents($footerFile), true) ?: []) : [];
$allUsers = AuthManager::getAllUsers();
$content = ContentManager::load();

// Compute Analytics KPIs
$totalRevenue = array_reduce($orders, fn($acc, $o) => $acc + (isset($o['total']) ? intval($o['total']) : 0), 0);
$totalOrdersCount = count($orders);
$pendingOrdersCount = count(array_filter($orders, fn($o) => ($o['status'] ?? '') === 'Pending'));
$confirmedOrdersCount = count(array_filter($orders, fn($o) => ($o['status'] ?? '') === 'Confirmed'));
$deliveredOrdersCount = count(array_filter($orders, fn($o) => ($o['status'] ?? '') === 'Delivered'));

$totalSurveysCount = count($surveys);
$scheduledSurveysCount = count(array_filter($surveys, fn($s) => str_contains($s['status'] ?? '', 'Scheduled')));
$wonSurveysCount = count(array_filter($surveys, fn($s) => str_contains($s['status'] ?? '', 'Won')));

$totalInventoryStock = array_reduce($products, fn($acc, $p) => $acc + ($p['stock'] ?? 0), 0);
$totalInventoryValue = array_reduce($products, fn($acc, $p) => $acc + (($p['stock'] ?? 0) * ($p['price'] ?? 0)), 0);
$lowStockCount = count(array_filter($products, fn($p) => ($p['stock'] ?? 0) <= 5));

$unreadMessagesCount = count(array_filter($messages, fn($m) => ($m['status'] ?? '') === 'Unread'));

// Active Tab
$tab = $_GET['tab'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-900 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IntelliTech Solutions &bull; Master Administration Dashboard</title>

    <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace']
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a'
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="min-h-full flex flex-col font-sans bg-[#0c1322] text-slate-100 antialiased selection:bg-[#2189ff] selection:text-white">

<?php if (!$isAuthenticated): ?>
    <!-- =======================================================================
         LOGIN SCREEN
         ======================================================================= -->
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-slate-800/90 backdrop-blur-xl rounded-3xl border border-slate-700/80 p-8 shadow-2xl space-y-6">
            
            <div class="text-center space-y-2">
                <img src="assets/images/intellitech_logo_white.svg" alt="IntelliTech Solutions" class="h-10 mx-auto object-contain">
                <h1 class="text-xl font-black text-white tracking-tight">Master Admin Hub</h1>
                <p class="text-xs text-slate-400">Sign in to manage orders, site surveys, inventory & analytics</p>
            </div>

            <?php if ($message): ?>
                <div class="p-3.5 rounded-2xl text-xs <?= $messageType === 'error' ? 'bg-rose-500/20 text-rose-300 border border-rose-500/40' : 'bg-blue-500/20 text-blue-300 border border-blue-500/40' ?>">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <input type="hidden" name="login_action" value="1">
                
                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        required 
                        value="admin"
                        class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 text-sm text-white focus:outline-none focus:border-[#2189ff]"
                    >
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-1">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl bg-slate-900/80 border border-slate-700 text-sm text-white focus:outline-none focus:border-[#2189ff]"
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full py-3.5 rounded-xl bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-sm transition-all shadow-lg shadow-blue-500/25"
                >
                    Sign In to Dashboard &rarr;
                </button>
            </form>

            <div class="pt-4 border-t border-slate-700/60 text-center">
                <span class="text-[11px] text-slate-400">Default SuperAdmin: <code class="text-blue-400 font-mono">admin</code> / <code class="text-blue-400 font-mono">admin123</code></span>
            </div>

            <div class="text-center pt-2">
                <a href="index.php" class="text-xs text-slate-400 hover:text-white flex items-center justify-center gap-1.5 transition-colors">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Back to IntelliTech Store</span>
                </a>
            </div>

        </div>
    </div>

<?php else: ?>

    <!-- =======================================================================
         AUTHENTICATED DASHBOARD WORKSPACE
         ======================================================================= -->
    <div class="min-h-screen flex flex-col lg:flex-row">
        
        <!-- SIDEBAR -->
        <aside class="w-full lg:w-64 bg-slate-950 border-r border-slate-800 flex flex-col justify-between shrink-0">
            <div>
                <!-- Brand Header -->
                <div class="p-5 border-b border-slate-800/80 flex items-center justify-between">
                    <a href="index.php" class="flex items-center gap-2">
                        <img src="assets/images/intellitech_logo_white.svg" alt="IntelliTech" class="h-8 object-contain">
                    </a>
                </div>

                <!-- Navigation Tabs -->
                <nav class="p-3 space-y-1.5 text-xs font-bold text-slate-400">
                    
                    <a href="admin.php?tab=dashboard" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'dashboard' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                            <span>Dashboard & Analytics</span>
                        </div>
                    </a>

                    <a href="admin.php?tab=orders" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'orders' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                            <span>Orders Manager</span>
                        </div>
                        <?php if ($pendingOrdersCount > 0): ?>
                            <span class="px-2 py-0.5 rounded-full bg-amber-500 text-slate-950 text-[10px] font-black"><?= $pendingOrdersCount ?></span>
                        <?php endif; ?>
                    </a>

                    <a href="admin.php?tab=surveys" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'surveys' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="clipboard-pen" class="w-4 h-4"></i>
                            <span>Booked Surveys</span>
                        </div>
                        <?php if ($scheduledSurveysCount > 0): ?>
                            <span class="px-2 py-0.5 rounded-full bg-emerald-400 text-slate-950 text-[10px] font-black"><?= $scheduledSurveysCount ?></span>
                        <?php endif; ?>
                    </a>

                    <a href="admin.php?tab=rates" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'rates' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="tag" class="w-4 h-4"></i>
                            <span>Rates & Products</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full bg-blue-500/20 text-blue-300 text-[10px] font-black"><?= count($products) ?> Items</span>
                    </a>

                    <a href="admin.php?tab=navbar" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'navbar' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="menu" class="w-4 h-4"></i>
                            <span>Navbar Links</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 text-[10px] font-black"><?= count($navItems) ?> Links</span>
                    </a>

                    <a href="admin.php?tab=footer" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'footer' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="layout" class="w-4 h-4"></i>
                            <span>Footer Links</span>
                        </div>
                        <?php $flCount = array_reduce($footerData, fn($acc, $sec) => $acc + count($sec['links'] ?? []), 0); ?>
                        <span class="px-2 py-0.5 rounded-full bg-cyan-500/20 text-cyan-300 text-[10px] font-black"><?= $flCount ?> Links</span>
                    </a>

                    <a href="admin.php?tab=inventory" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'inventory' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="boxes" class="w-4 h-4"></i>
                            <span>Stock & Purchases</span>
                        </div>
                        <?php if ($lowStockCount > 0): ?>
                            <span class="px-2 py-0.5 rounded-full bg-rose-500 text-white text-[10px] font-black"><?= $lowStockCount ?> Low</span>
                        <?php endif; ?>
                    </a>

                    <a href="admin.php?tab=users" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'users' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            <span>Users & Staff</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full bg-purple-500/20 text-purple-300 text-[10px] font-black"><?= count($allUsers) ?> Staff</span>
                    </a>

                    <a href="admin.php?tab=messages" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'messages' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span>Customer Inquiries</span>
                        </div>
                        <?php if ($unreadMessagesCount > 0): ?>
                            <span class="px-2 py-0.5 rounded-full bg-blue-500 text-white text-[10px] font-black"><?= $unreadMessagesCount ?></span>
                        <?php endif; ?>
                    </a>

                    <a href="admin.php?tab=settings" class="flex items-center justify-between px-3.5 py-3 rounded-xl transition-all <?= $tab === 'settings' ? 'bg-[#2189ff] text-white shadow-md' : 'hover:bg-slate-900 hover:text-white' ?>">
                        <div class="flex items-center gap-3">
                            <i data-lucide="sliders" class="w-4 h-4"></i>
                            <span>Store & Settings</span>
                        </div>
                    </a>

                </nav>
            </div>

            <!-- Sidebar Footer User / Logout -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-950/60 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xs">
                        <?= strtoupper(substr($_SESSION['admin_user'] ?? 'A', 0, 1)) ?>
                    </div>
                    <div class="flex flex-col text-left">
                        <span class="text-xs font-bold text-white"><?= htmlspecialchars($_SESSION['admin_user'] ?? 'Administrator') ?></span>
                        <span class="text-[10px] text-emerald-400 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Online SuperAdmin
                        </span>
                    </div>
                </div>
                <a href="admin.php?action=logout" class="p-2 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-slate-900 transition-colors" title="Log Out">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 space-y-6">
            
            <!-- Top Alert Banner -->
            <?php if ($message): ?>
                <div class="p-4 rounded-2xl text-xs font-bold flex items-center justify-between <?= $messageType === 'success' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : ($messageType === 'error' ? 'bg-rose-500/20 text-rose-300 border border-rose-500/40' : 'bg-blue-500/20 text-blue-300 border border-blue-500/40') ?>">
                    <div class="flex items-center gap-2">
                        <i data-lucide="info" class="w-4 h-4"></i>
                        <span><?= htmlspecialchars($message) ?></span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-white">&times;</button>
                </div>
            <?php endif; ?>

            <!-- TAB 1: DASHBOARD & ANALYTICS -->
            <?php if ($tab === 'dashboard'): ?>
                <div class="space-y-6">
                    
                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Sales & Operations Analytics</h2>
                            <p class="text-xs text-slate-400 mt-1">Live metrics across Pakistani residential & commercial smart automation projects.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="index.php" target="_blank" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs flex items-center gap-2 transition-colors">
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                <span>View Live Website</span>
                            </a>
                            <a href="admin.php?tab=orders" class="px-4 py-2 rounded-xl bg-[#2189ff] hover:bg-blue-600 text-white font-bold text-xs flex items-center gap-2 transition-colors shadow-md">
                                <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                                <span>Manage Orders (<?= $totalOrdersCount ?>)</span>
                            </a>
                        </div>
                    </div>

                    <!-- 4 Metric KPI Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        
                        <!-- KPI 1: Gross Sales -->
                        <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 p-5 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Gross Sales</span>
                                <div class="w-9 h-9 rounded-xl bg-blue-500/20 text-[#2189ff] flex items-center justify-center font-bold">
                                    <i data-lucide="banknote" class="w-5 h-5"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-white">Rs. <?= number_format($totalRevenue) ?></div>
                                <span class="text-[10px] text-emerald-400 flex items-center gap-1 mt-1 font-bold">
                                    <i data-lucide="trending-up" class="w-3 h-3"></i>
                                    <span>+24.8% this month</span>
                                </span>
                            </div>
                        </div>

                        <!-- KPI 2: Total Orders -->
                        <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 p-5 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Orders</span>
                                <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">
                                    <i data-lucide="package-check" class="w-5 h-5"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-white"><?= $totalOrdersCount ?></div>
                                <div class="flex items-center gap-2 text-[10px] text-slate-400 mt-1">
                                    <span class="text-amber-400 font-bold"><?= $pendingOrdersCount ?> Pending</span>
                                    <span>&bull;</span>
                                    <span class="text-emerald-400 font-bold"><?= $deliveredOrdersCount ?> Delivered</span>
                                </div>
                            </div>
                        </div>

                        <!-- KPI 3: Surveys Booked -->
                        <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 p-5 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">On-Site Surveys</span>
                                <div class="w-9 h-9 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center font-bold">
                                    <i data-lucide="calendar" class="w-5 h-5"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-white"><?= $totalSurveysCount ?></div>
                                <span class="text-[10px] text-purple-300 font-bold mt-1 block">
                                    <?= $wonSurveysCount ?> Villa Projects Won
                                </span>
                            </div>
                        </div>

                        <!-- KPI 4: Inventory Asset Value -->
                        <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 p-5 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Stock Valuation</span>
                                <div class="w-9 h-9 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                                    <i data-lucide="boxes" class="w-5 h-5"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-white">Rs. <?= number_format($totalInventoryValue) ?></div>
                                <span class="text-[10px] text-slate-400 mt-1 block">
                                    <?= $totalInventoryStock ?> Units in Warehouse
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Interactive Charts Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                        
                        <!-- Sales Trend Line Chart (8 Cols) -->
                        <div class="lg:col-span-8 bg-slate-800/80 rounded-2xl border border-slate-700/80 p-5 space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-black text-white uppercase tracking-wider">Sales Revenue Trend (PKR)</h3>
                                <span class="text-xs text-slate-400">Past 6 Months</span>
                            </div>
                            <div class="h-64">
                                <canvas id="chart-sales-trend"></canvas>
                            </div>
                        </div>

                        <!-- Category Breakdown Doughnut Chart (4 Cols) -->
                        <div class="lg:col-span-4 bg-slate-800/80 rounded-2xl border border-slate-700/80 p-5 space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-black text-white uppercase tracking-wider">Revenue by Category</h3>
                            </div>
                            <div class="h-64 flex items-center justify-center">
                                <canvas id="chart-categories"></canvas>
                            </div>
                        </div>

                    </div>

                    <!-- Recent Orders & Recent Surveys Split Tables -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- Recent Orders -->
                        <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 p-5 space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-black text-white">Recent Customer Orders</h3>
                                <a href="admin.php?tab=orders" class="text-xs text-[#2189ff] hover:underline font-bold">View All &rarr;</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-xs">
                                    <thead>
                                        <tr class="border-b border-slate-700 text-slate-400 uppercase font-bold text-[10px]">
                                            <th class="pb-2">Order ID</th>
                                            <th class="pb-2">Customer</th>
                                            <th class="pb-2">Amount</th>
                                            <th class="pb-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/60">
                                        <?php foreach (array_slice($orders, 0, 4) as $o): ?>
                                            <tr class="hover:bg-slate-700/30">
                                                <td class="py-2.5 font-mono font-bold text-blue-400"><?= $o['id'] ?></td>
                                                <td class="py-2.5 font-bold text-white"><?= htmlspecialchars($o['customer_name']) ?> (<?= $o['city'] ?>)</td>
                                                <td class="py-2.5 font-bold">Rs. <?= number_format($o['total']) ?></td>
                                                <td class="py-2.5">
                                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold <?= $o['status'] === 'Confirmed' ? 'bg-emerald-500/20 text-emerald-400' : ($o['status'] === 'Pending' ? 'bg-amber-500/20 text-amber-400' : 'bg-blue-500/20 text-blue-400') ?>">
                                                        <?= $o['status'] ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Recent Surveys -->
                        <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 p-5 space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-black text-white">Upcoming On-Site Surveys</h3>
                                <a href="admin.php?tab=surveys" class="text-xs text-[#2189ff] hover:underline font-bold">View All &rarr;</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-xs">
                                    <thead>
                                        <tr class="border-b border-slate-700 text-slate-400 uppercase font-bold text-[10px]">
                                            <th class="pb-2">Homeowner</th>
                                            <th class="pb-2">Property</th>
                                            <th class="pb-2">City</th>
                                            <th class="pb-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/60">
                                        <?php foreach (array_slice($surveys, 0, 4) as $s): ?>
                                            <tr class="hover:bg-slate-700/30">
                                                <td class="py-2.5 font-bold text-white"><?= htmlspecialchars($s['customer_name']) ?></td>
                                                <td class="py-2.5 text-slate-300"><?= htmlspecialchars($s['property']) ?></td>
                                                <td class="py-2.5 text-slate-300"><?= htmlspecialchars($s['city']) ?></td>
                                                <td class="py-2.5">
                                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-500/20 text-purple-300">
                                                        <?= $s['status'] ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>

            <!-- TAB 2: ORDERS MANAGER -->
            <?php elseif ($tab === 'orders'): ?>
                <div class="space-y-6">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Customer Orders Management</h2>
                            <p class="text-xs text-slate-400 mt-1">Review orders, confirm dispatch, communicate with buyers on WhatsApp, and generate invoices.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-slate-400">Total: <strong><?= count($orders) ?></strong> Orders</span>
                        </div>
                    </div>

                    <!-- Orders Table Card -->
                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-900/80 border-b border-slate-700 text-slate-400 uppercase font-black text-[10px] tracking-wider">
                                    <tr>
                                        <th class="p-4">Order ID & Date</th>
                                        <th class="p-4">Customer Details</th>
                                        <th class="p-4">Items Ordered</th>
                                        <th class="p-4">Payment & Total</th>
                                        <th class="p-4">Status</th>
                                        <th class="p-4 text-right">Quick Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700/60">
                                    <?php if (empty($orders)): ?>
                                        <tr>
                                            <td colspan="6" class="p-8 text-center text-slate-400">No orders placed yet.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($orders as $ord): ?>
                                            <tr class="hover:bg-slate-700/30 transition-colors">
                                                
                                                <!-- ID & Date -->
                                                <td class="p-4 align-top">
                                                    <span class="font-mono font-black text-blue-400 block"><?= $ord['id'] ?></span>
                                                    <span class="text-[10px] text-slate-400 block mt-0.5"><?= $ord['created_at'] ?></span>
                                                </td>

                                                <!-- Customer Details -->
                                                <td class="p-4 align-top">
                                                    <span class="font-black text-white block text-sm"><?= htmlspecialchars($ord['customer_name']) ?></span>
                                                    <a href="tel:<?= $ord['customer_phone'] ?>" class="text-[11px] text-[#2189ff] hover:underline block font-semibold">
                                                        📞 <?= htmlspecialchars($ord['customer_phone']) ?>
                                                    </a>
                                                    <span class="text-[10px] text-slate-400 block mt-1 max-w-xs leading-snug">
                                                        📍 <?= htmlspecialchars($ord['address']) ?>, <?= htmlspecialchars($ord['city']) ?>
                                                    </span>
                                                </td>

                                                <!-- Items -->
                                                <td class="p-4 align-top">
                                                    <ul class="space-y-1 text-slate-300 max-w-xs">
                                                        <?php foreach ($ord['items'] as $item): ?>
                                                            <li class="flex items-center justify-between gap-2 border-b border-slate-700/40 pb-0.5">
                                                                <span class="font-medium truncate"><?= htmlspecialchars($item['name']) ?></span>
                                                                <span class="font-mono font-bold text-blue-300 shrink-0">x<?= $item['quantity'] ?></span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </td>

                                                <!-- Payment & Total -->
                                                <td class="p-4 align-top">
                                                    <span class="text-sm font-black text-white block">Rs. <?= number_format($ord['total']) ?></span>
                                                    <span class="text-[10px] px-2 py-0.5 rounded-md bg-slate-700 text-slate-300 font-bold inline-block mt-1">
                                                        <?= htmlspecialchars($ord['payment_method']) ?>
                                                    </span>
                                                </td>

                                                <!-- Status Badge -->
                                                <td class="p-4 align-top">
                                                    <?php
                                                    $st = $ord['status'] ?? 'Pending';
                                                    $stClass = match($st) {
                                                        'Confirmed' => 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30',
                                                        'Dispatched' => 'bg-blue-500/20 text-blue-400 border border-blue-500/30',
                                                        'Delivered' => 'bg-teal-500/20 text-teal-300 border border-teal-500/30',
                                                        'Cancelled' => 'bg-rose-500/20 text-rose-400 border border-rose-500/30',
                                                        default => 'bg-amber-500/20 text-amber-400 border border-amber-500/30'
                                                    };
                                                    ?>
                                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider <?= $stClass ?>">
                                                        <?= $st ?>
                                                    </span>
                                                </td>

                                                <!-- Actions -->
                                                <td class="p-4 align-top text-right space-y-1.5">
                                                    
                                                    <!-- Status Change Buttons -->
                                                    <div class="flex items-center justify-end gap-1">
                                                        <form method="POST" class="inline">
                                                            <input type="hidden" name="admin_action" value="update_order_status">
                                                            <input type="hidden" name="order_id" value="<?= $ord['id'] ?>">
                                                            <input type="hidden" name="new_status" value="Confirmed">
                                                            <button title="Confirm Order" class="px-2 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10px] transition-colors">
                                                                Confirm
                                                            </button>
                                                        </form>
                                                        <form method="POST" class="inline">
                                                            <input type="hidden" name="admin_action" value="update_order_status">
                                                            <input type="hidden" name="order_id" value="<?= $ord['id'] ?>">
                                                            <input type="hidden" name="new_status" value="Dispatched">
                                                            <button title="Mark Dispatched" class="px-2 py-1 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold text-[10px] transition-colors">
                                                                Dispatch
                                                            </button>
                                                        </form>
                                                        <form method="POST" class="inline">
                                                            <input type="hidden" name="admin_action" value="update_order_status">
                                                            <input type="hidden" name="order_id" value="<?= $ord['id'] ?>">
                                                            <input type="hidden" name="new_status" value="Delivered">
                                                            <button title="Mark Delivered" class="px-2 py-1 rounded-lg bg-teal-600 hover:bg-teal-500 text-white font-bold text-[10px] transition-colors">
                                                                Delivered
                                                            </button>
                                                        </form>
                                                    </div>

                                                    <!-- Direct WhatsApp Communication to Customer -->
                                                    <?php
                                                    $cleanPhone = preg_replace('/[^0-9]/', '', $ord['customer_phone']);
                                                    if (str_starts_with($cleanPhone, '0')) {
                                                        $cleanPhone = '92' . substr($cleanPhone, 1);
                                                    }
                                                    $waText = "Hello " . $ord['customer_name'] . "! This is IntelliTech Solutions. Your order #" . $ord['id'] . " (Total: Rs. " . number_format($ord['total']) . ") has been confirmed! Our dispatch rider will deliver to " . $ord['address'] . ", " . $ord['city'] . ". For any query email us at info@intellitech.pk.";
                                                    ?>
                                                    <div class="flex items-center justify-end gap-1.5 pt-1">
                                                        <a 
                                                            href="https://wa.me/<?= $cleanPhone ?>?text=<?= urlencode($waText) ?>" 
                                                            target="_blank" 
                                                            rel="noopener"
                                                            class="px-2.5 py-1 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-[10px] flex items-center gap-1 transition-colors"
                                                            title="Send Order Update on WhatsApp"
                                                        >
                                                            <i data-lucide="message-circle" class="w-3 h-3"></i>
                                                            <span>WhatsApp</span>
                                                        </a>

                                                        <!-- Delete Order -->
                                                        <form method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete order #<?= $ord['id'] ?>?');">
                                                            <input type="hidden" name="admin_action" value="delete_order">
                                                            <input type="hidden" name="order_id" value="<?= $ord['id'] ?>">
                                                            <button class="p-1 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-700 transition-colors" title="Delete Order">
                                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                            </button>
                                                        </form>
                                                    </div>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            <!-- TAB 3: BOOKED SURVEYS -->
            <?php elseif ($tab === 'surveys'): ?>
                <div class="space-y-6">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">On-Site Smart Home Survey Bookings</h2>
                            <p class="text-xs text-slate-400 mt-1">Manage CAD blueprint visits, assign electrical engineers, and close luxury villa automation contracts.</p>
                        </div>
                        <button onclick="document.getElementById('modal-add-survey').classList.remove('hidden')" class="px-4 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-extrabold text-xs flex items-center gap-2 transition-all shadow-md">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Log Manual Survey Lead</span>
                        </button>
                    </div>

                    <!-- Surveys Table -->
                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-900/80 border-b border-slate-700 text-slate-400 uppercase font-black text-[10px] tracking-wider">
                                    <tr>
                                        <th class="p-4">Survey ID</th>
                                        <th class="p-4">Homeowner Details</th>
                                        <th class="p-4">Property & Scope</th>
                                        <th class="p-4">Assigned Engineer & Schedule</th>
                                        <th class="p-4">Status</th>
                                        <th class="p-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700/60">
                                    <?php if (empty($surveys)): ?>
                                        <tr>
                                            <td colspan="6" class="p-8 text-center text-slate-400">No on-site survey requests logged yet.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($surveys as $surv): ?>
                                            <tr class="hover:bg-slate-700/30 transition-colors">
                                                
                                                <td class="p-4 align-top">
                                                    <span class="font-mono font-black text-purple-400 block"><?= $surv['id'] ?></span>
                                                    <span class="text-[10px] text-slate-400"><?= $surv['created_at'] ?></span>
                                                </td>

                                                <td class="p-4 align-top">
                                                    <span class="font-black text-white block text-sm"><?= htmlspecialchars($surv['customer_name']) ?></span>
                                                    <a href="tel:<?= $surv['customer_phone'] ?>" class="text-[11px] text-[#2189ff] hover:underline font-bold block">
                                                        📞 <?= htmlspecialchars($surv['customer_phone']) ?>
                                                    </a>
                                                    <span class="text-[10px] text-slate-400 block font-semibold">📍 <?= htmlspecialchars($surv['city']) ?></span>
                                                </td>

                                                <td class="p-4 align-top">
                                                    <span class="font-bold text-amber-300 block"><?= htmlspecialchars($surv['property']) ?></span>
                                                    <span class="text-[10px] text-slate-400 block font-medium"><?= htmlspecialchars($surv['construction_status'] ?? 'Retrofit') ?></span>
                                                    <p class="text-[10px] text-slate-300 mt-1 max-w-xs leading-relaxed line-clamp-2"><?= htmlspecialchars($surv['requirements'] ?? '') ?></p>
                                                </td>

                                                <td class="p-4 align-top">
                                                    <span class="text-xs font-bold text-emerald-400 block">👷 <?= htmlspecialchars($surv['assigned_engineer'] ?? 'Unassigned') ?></span>
                                                    <span class="text-[10px] text-slate-400 block font-mono mt-0.5">🗓️ <?= htmlspecialchars($surv['scheduled_date'] ?? 'TBD') ?></span>
                                                </td>

                                                <td class="p-4 align-top">
                                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-purple-500/20 text-purple-300 border border-purple-500/30">
                                                        <?= htmlspecialchars($surv['status']) ?>
                                                    </span>
                                                </td>

                                                <td class="p-4 align-top text-right space-y-1.5">
                                                    <?php
                                                    $cleanPhone = preg_replace('/[^0-9]/', '', $surv['customer_phone']);
                                                    if (str_starts_with($cleanPhone, '0')) {
                                                        $cleanPhone = '92' . substr($cleanPhone, 1);
                                                    }
                                                    $survWaText = "Hello " . $surv['customer_name'] . "! This is IntelliTech Solutions (Faisalabad HQ). We have received your smart home CAD blueprint survey request for your " . $surv['property'] . " in " . $surv['city'] . ". Our certified engineer (" . ($surv['assigned_engineer'] ?? 'Faisalabad Team') . ") would like to confirm your visit schedule. For direct inquiries email us at info@intellitech.pk.";
                                                    ?>
                                                    <div class="flex items-center justify-end gap-1.5">
                                                        <a 
                                                            href="https://wa.me/<?= $cleanPhone ?>?text=<?= urlencode($survWaText) ?>" 
                                                            target="_blank" 
                                                            rel="noopener"
                                                            class="px-2.5 py-1 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-[10px] flex items-center gap-1 transition-colors"
                                                            title="WhatsApp Homeowner"
                                                        >
                                                            <i data-lucide="message-circle" class="w-3 h-3"></i>
                                                            <span>WhatsApp</span>
                                                        </a>

                                                        <!-- Quick Status Update Modal Trigger -->
                                                        <button 
                                                            onclick="openEditSurveyModal('<?= $surv['id'] ?>', '<?= htmlspecialchars($surv['status']) ?>', '<?= htmlspecialchars($surv['assigned_engineer'] ?? '') ?>', '<?= htmlspecialchars($surv['scheduled_date'] ?? '') ?>')" 
                                                            class="px-2 py-1 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold text-[10px] transition-colors"
                                                        >
                                                            Update
                                                        </button>

                                                        <!-- Delete Survey -->
                                                        <form method="POST" class="inline" onsubmit="return confirm('Remove survey request #<?= $surv['id'] ?>?');">
                                                            <input type="hidden" name="admin_action" value="delete_survey">
                                                            <input type="hidden" name="survey_id" value="<?= $surv['id'] ?>">
                                                            <button class="p-1 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-700 transition-colors">
                                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal: Add Manual Survey -->
                    <div id="modal-add-survey" class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                        <div class="w-full max-w-lg bg-slate-900 border border-slate-700 rounded-3xl p-6 space-y-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                <h3 class="font-extrabold text-white text-base">Log New On-Site Smart Survey Lead</h3>
                                <button onclick="document.getElementById('modal-add-survey').classList.add('hidden')" class="text-slate-400 hover:text-white">&times;</button>
                            </div>
                            <form method="POST" class="space-y-3 text-xs">
                                <input type="hidden" name="admin_action" value="add_survey_manual">
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Customer Name *</label>
                                        <input type="text" name="cust_name" required placeholder="e.g. Asad Rauf" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Phone Number *</label>
                                        <input type="text" name="cust_phone" required placeholder="0300 1234567" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Property Type</label>
                                        <select name="property" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                            <option value="1 Kanal Luxury Villa">1 Kanal Luxury Villa</option>
                                            <option value="10 Marla Smart Home">10 Marla Smart Home</option>
                                            <option value="2 Kanal+ Smart Estate">2 Kanal+ Smart Estate</option>
                                            <option value="Corporate Office">Corporate Office / Plaza</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">City</label>
                                        <input type="text" name="city" value="Faisalabad" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Assigned Engineer</label>
                                    <input type="text" name="engineer" value="Engr. Zohaib (Faisalabad HQ Team)" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                </div>
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Requirements / Notes</label>
                                    <textarea name="requirements" rows="2" placeholder="e.g. 24 Switches, 5 AC switches, 360 camera..." class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none"></textarea>
                                </div>
                                <button type="submit" class="w-full py-3 rounded-xl bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-xs transition-colors shadow-md">
                                    Save & Schedule Survey
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal: Edit Survey Status -->
                    <div id="modal-edit-survey" class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                        <div class="w-full max-w-md bg-slate-900 border border-slate-700 rounded-3xl p-6 space-y-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                <h3 class="font-extrabold text-white text-base">Update Survey Status</h3>
                                <button onclick="document.getElementById('modal-edit-survey').classList.add('hidden')" class="text-slate-400 hover:text-white">&times;</button>
                            </div>
                            <form method="POST" class="space-y-3 text-xs">
                                <input type="hidden" name="admin_action" value="update_survey">
                                <input type="hidden" name="survey_id" id="edit-survey-id">
                                
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Status</label>
                                    <select name="survey_status" id="edit-survey-status" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                        <option value="New Request">New Request</option>
                                        <option value="Survey Scheduled">Survey Scheduled</option>
                                        <option value="Site Visited">Site Visited</option>
                                        <option value="Quotation Sent">Quotation Sent</option>
                                        <option value="Project Won">Project Won</option>
                                        <option value="Declined">Declined</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Assigned Engineer</label>
                                    <input type="text" name="assigned_engineer" id="edit-survey-eng" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Scheduled Visit Date/Time</label>
                                    <input type="text" name="scheduled_date" id="edit-survey-date" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                </div>

                                <button type="submit" class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-extrabold text-xs transition-colors shadow-md">
                                    Update Survey Booking
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            <!-- TAB: RATES & PRODUCT CATALOG -->
            <?php elseif ($tab === 'rates'): ?>
                <div class="space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Rates & Product Catalog Management</h2>
                            <p class="text-xs text-slate-400 mt-1">Manage live consumer rates, cut-off discount rates, profit margins, and catalog items.</p>
                        </div>
                        <button onclick="document.getElementById('modal-add-product').classList.remove('hidden')" class="px-4 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-extrabold text-xs flex items-center gap-2 transition-all shadow-md">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Add New Product to Catalog</span>
                        </button>
                    </div>

                    <!-- Metrics -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="p-4 rounded-2xl bg-slate-800/80 border border-slate-700/80">
                            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400">Total Catalog Items</div>
                            <div class="text-2xl font-black text-white mt-1"><?= count($products) ?></div>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-800/80 border border-slate-700/80">
                            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400">In Stock Devices</div>
                            <div class="text-2xl font-black text-emerald-400 mt-1"><?= count(array_filter($products, fn($p) => ($p['stock'] ?? 0) > 0)) ?></div>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-800/80 border border-slate-700/80">
                            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400">Low / Out of Stock</div>
                            <div class="text-2xl font-black text-rose-400 mt-1"><?= count(array_filter($products, fn($p) => ($p['stock'] ?? 0) <= 5)) ?></div>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-800/80 border border-slate-700/80">
                            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400">Total Catalog Worth</div>
                            <div class="text-xl font-black text-blue-400 mt-1">Rs. <?= number_format($totalInventoryValue) ?></div>
                        </div>
                    </div>

                    <!-- Filter & Search bar -->
                    <div class="flex items-center gap-3">
                        <div class="relative flex-1">
                            <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-3 text-slate-500"></i>
                            <input 
                                type="text" 
                                id="rateSearchInput" 
                                onkeyup="filterRatesTable()" 
                                placeholder="Search products by title, category, or ID..." 
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-xs text-white placeholder-slate-500 outline-none focus:border-blue-500"
                            >
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs" id="ratesTable">
                                <thead class="bg-slate-900/80 text-slate-400 uppercase font-black text-[10px] tracking-wider border-b border-slate-700">
                                    <tr>
                                        <th class="p-4">Product Details</th>
                                        <th class="p-4">Category</th>
                                        <th class="p-4">Current Rate (PKR)</th>
                                        <th class="p-4">Regular Rate (PKR)</th>
                                        <th class="p-4">Cost Price (PKR)</th>
                                        <th class="p-4">Stock</th>
                                        <th class="p-4 text-center">Quick Update Rates</th>
                                        <th class="p-4 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700">
                                    <?php foreach ($products as $p): ?>
                                        <tr class="hover:bg-slate-700/30 transition-colors">
                                            <td class="p-4">
                                                <div class="flex items-center gap-3">
                                                    <img src="<?= htmlspecialchars($p['image'] ?? 'assets/images/favicon.svg') ?>" alt="" class="w-11 h-11 rounded-xl bg-slate-900 object-contain p-1 border border-slate-700 shrink-0">
                                                    <div>
                                                        <div class="font-bold text-white"><?= htmlspecialchars($p['name']) ?></div>
                                                        <div class="text-[10px] text-slate-400 font-mono">ID: <?= htmlspecialchars($p['id']) ?></div>
                                                        <?php if (!empty($p['badge'])): ?>
                                                            <span class="inline-block mt-0.5 px-1.5 py-0.5 rounded text-[9px] font-black uppercase bg-blue-500/20 text-blue-300"><?= htmlspecialchars($p['badge']) ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-700 text-slate-300">
                                                    <?= htmlspecialchars($p['category_label'] ?? ucfirst($p['category'] ?? 'General')) ?>
                                                </span>
                                            </td>
                                            <td class="p-4 font-black text-blue-400 text-sm">
                                                Rs. <?= number_format($p['price'] ?? 0) ?>
                                            </td>
                                            <td class="p-4 text-slate-400 line-through">
                                                Rs. <?= number_format($p['original_price'] ?? 0) ?>
                                            </td>
                                            <td class="p-4 text-slate-300">
                                                Rs. <?= number_format($p['cost_price'] ?? 0) ?>
                                            </td>
                                            <td class="p-4">
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-black <?= ($p['stock'] ?? 0) > 5 ? 'bg-emerald-500/20 text-emerald-300' : (($p['stock'] ?? 0) > 0 ? 'bg-amber-500/20 text-amber-300' : 'bg-rose-500/20 text-rose-300') ?>">
                                                    <?= $p['stock'] ?? 0 ?> in stock
                                                </span>
                                            </td>
                                            <td class="p-4">
                                                <form method="POST" class="flex items-center gap-2 justify-center">
                                                    <input type="hidden" name="admin_action" value="update_product_rate">
                                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($p['id']) ?>">
                                                    <div class="flex flex-col gap-1">
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-[10px] text-slate-400 w-10">Rate:</span>
                                                            <input type="number" name="price" value="<?= intval($p['price'] ?? 0) ?>" class="w-24 px-2 py-1 rounded-lg bg-slate-900 border border-slate-700 text-xs text-white text-right font-bold outline-none focus:border-blue-500" title="Selling Rate (PKR)">
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-[10px] text-slate-400 w-10">Regular:</span>
                                                            <input type="number" name="original_price" value="<?= intval($p['original_price'] ?? 0) ?>" class="w-24 px-2 py-1 rounded-lg bg-slate-900 border border-slate-700 text-xs text-slate-300 text-right outline-none focus:border-blue-500" title="Regular Cut-off Rate (PKR)">
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col gap-1">
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-[10px] text-slate-400 w-10">Stock:</span>
                                                            <input type="number" name="stock" value="<?= intval($p['stock'] ?? 0) ?>" class="w-16 px-2 py-1 rounded-lg bg-slate-900 border border-slate-700 text-xs text-white text-right outline-none focus:border-blue-500" title="Stock Available">
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-[10px] text-slate-400 w-10">Cost:</span>
                                                            <input type="number" name="cost_price" value="<?= intval($p['cost_price'] ?? 0) ?>" class="w-16 px-2 py-1 rounded-lg bg-slate-900 border border-slate-700 text-xs text-slate-300 text-right outline-none focus:border-blue-500" title="Cost Price (PKR)">
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="px-3 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-black text-xs transition-colors shadow" title="Save Rates">
                                                        Save
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="p-4 text-right">
                                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete product \'<?= htmlspecialchars(addslashes($p['name'])) ?>\' from catalog?');" class="inline">
                                                    <input type="hidden" name="admin_action" value="delete_product">
                                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($p['id']) ?>">
                                                    <button type="submit" class="p-2 rounded-xl bg-slate-700 hover:bg-rose-500 text-slate-300 hover:text-white transition-colors" title="Delete Product">
                                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal: Add New Product -->
                    <div id="modal-add-product" class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                        <div class="w-full max-w-xl bg-slate-900 border border-slate-700 rounded-3xl p-6 space-y-4 max-h-[90vh] overflow-y-auto">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                <h3 class="font-extrabold text-white text-base">Add New Product & Set Rate</h3>
                                <button onclick="document.getElementById('modal-add-product').classList.add('hidden')" class="text-slate-400 hover:text-white">&times;</button>
                            </div>
                            <form method="POST" class="space-y-4 text-xs">
                                <input type="hidden" name="admin_action" value="add_product">
                                
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Product Name / Title *</label>
                                    <input type="text" name="name" required placeholder="e.g. Zigbee 3.0 Smart Touch Switch 3-Gang" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Category</label>
                                        <select name="category" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                            <option value="zigbee">Zigbee Devices</option>
                                            <option value="switches">Smart Switches & Sockets</option>
                                            <option value="locks">Smart Locks & Security</option>
                                            <option value="curtains">Motorized Curtains</option>
                                            <option value="sensors">Safety & Climate Sensors</option>
                                            <option value="lighting">Smart Lighting</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Category Display Label</label>
                                        <input type="text" name="category_label" value="Zigbee Devices" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Selling Rate (PKR) *</label>
                                        <input type="number" name="price" required placeholder="5500" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white font-bold outline-none focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Regular / Cut-off (PKR)</label>
                                        <input type="number" name="original_price" placeholder="7000" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Unit Cost Price (PKR)</label>
                                        <input type="number" name="cost_price" placeholder="3800" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Initial Stock</label>
                                        <input type="number" name="stock" value="15" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Badge Text (Optional)</label>
                                        <input type="text" name="badge" placeholder="e.g. ZIGBEE 3.0 / NEW" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Badge Color</label>
                                        <select name="badge_color" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                            <option value="blue">Blue</option>
                                            <option value="emerald">Emerald</option>
                                            <option value="amber">Amber</option>
                                            <option value="rose">Rose</option>
                                            <option value="purple">Purple</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Product Image Path or URL</label>
                                    <input type="text" name="image" value="assets/images/okasha/Smart_Gateway-3_in_1_4c6b1173-8555-4990-9d59-8b961182d5df.webp" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Short Description</label>
                                    <textarea name="short_desc" rows="2" placeholder="Brief summary of product features..." class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500"></textarea>
                                </div>

                                <button type="submit" class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-extrabold text-xs transition-colors shadow-md">
                                    Add Product to Store Catalog
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            <!-- TAB: NAVBAR LINKS MANAGER -->
            <?php elseif ($tab === 'navbar'): ?>
                <div class="space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Website Header Navigation Manager</h2>
                            <p class="text-xs text-slate-400 mt-1">Add, update order, change labels, or remove navigation links across the global site header.</p>
                        </div>
                        <button onclick="document.getElementById('modal-add-nav').classList.remove('hidden')" class="px-4 py-2 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white font-extrabold text-xs flex items-center gap-2 transition-all shadow-md">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Add Navbar Link</span>
                        </button>
                    </div>

                    <!-- Navigation Table -->
                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-900/80 text-slate-400 uppercase font-black text-[10px] tracking-wider border-b border-slate-700">
                                    <tr>
                                        <th class="p-4 w-16 text-center">Order</th>
                                        <th class="p-4">Link Title</th>
                                        <th class="p-4">Target URL</th>
                                        <th class="p-4">Page Key</th>
                                        <th class="p-4">Badge</th>
                                        <th class="p-4">Visibility</th>
                                        <th class="p-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700">
                                    <?php foreach ($navItems as $nav): ?>
                                        <tr class="hover:bg-slate-700/30 transition-colors">
                                            <td class="p-4 text-center font-black text-white">
                                                <span class="w-7 h-7 rounded-full bg-slate-900 border border-slate-700 inline-flex items-center justify-center font-mono">
                                                    <?= intval($nav['order'] ?? 0) ?>
                                                </span>
                                            </td>
                                            <td class="p-4">
                                                <div class="font-extrabold text-white text-sm"><?= htmlspecialchars($nav['title']) ?></div>
                                                <div class="text-[10px] text-slate-400 font-mono">ID: <?= htmlspecialchars($nav['id']) ?></div>
                                            </td>
                                            <td class="p-4">
                                                <code class="px-2 py-1 rounded-md bg-slate-900 border border-slate-700 text-blue-300 font-mono text-[11px]">
                                                    <?= htmlspecialchars($nav['url']) ?>
                                                </code>
                                            </td>
                                            <td class="p-4">
                                                <span class="text-slate-300 font-mono text-xs"><?= htmlspecialchars($nav['page'] ?? '-') ?></span>
                                            </td>
                                            <td class="p-4">
                                                <?php if (!empty($nav['badge'])): ?>
                                                    <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase <?= ($nav['badge_color'] ?? '') === 'emerald' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : (($nav['badge_color'] ?? '') === 'amber' ? 'bg-amber-500/20 text-amber-300 border border-amber-500/40' : 'bg-blue-500/20 text-blue-300 border border-blue-500/40') ?>">
                                                        <?= htmlspecialchars($nav['badge']) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-slate-500 text-[11px]">&mdash;</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="p-4">
                                                <form method="POST" class="inline">
                                                    <input type="hidden" name="admin_action" value="toggle_nav_item">
                                                    <input type="hidden" name="nav_id" value="<?= htmlspecialchars($nav['id']) ?>">
                                                    <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold flex items-center gap-1.5 <?= !empty($nav['active']) ? 'bg-emerald-500/20 text-emerald-300 hover:bg-emerald-500/30' : 'bg-slate-700 text-slate-400 hover:bg-slate-600' ?>" title="Click to toggle visibility">
                                                        <span class="w-1.5 h-1.5 rounded-full <?= !empty($nav['active']) ? 'bg-emerald-400 animate-pulse' : 'bg-slate-500' ?>"></span>
                                                        <span><?= !empty($nav['active']) ? 'Active (Visible)' : 'Hidden' ?></span>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="p-4 text-right space-x-2">
                                                <button 
                                                    type="button" 
                                                    onclick="openEditNavModal(<?= htmlspecialchars(json_encode($nav)) ?>)" 
                                                    class="p-2 rounded-xl bg-slate-700 hover:bg-blue-600 text-slate-300 hover:text-white transition-colors" 
                                                    title="Edit Navigation Link"
                                                >
                                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                                </button>
                                                <form method="POST" onsubmit="return confirm('Delete navbar link \'<?= htmlspecialchars(addslashes($nav['title'])) ?>\'?');" class="inline">
                                                    <input type="hidden" name="admin_action" value="delete_nav_item">
                                                    <input type="hidden" name="nav_id" value="<?= htmlspecialchars($nav['id']) ?>">
                                                    <button type="submit" class="p-2 rounded-xl bg-slate-700 hover:bg-rose-500 text-slate-300 hover:text-white transition-colors" title="Delete Link">
                                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal: Add Nav Item -->
                    <div id="modal-add-nav" class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                        <div class="w-full max-w-md bg-slate-900 border border-slate-700 rounded-3xl p-6 space-y-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                <h3 class="font-extrabold text-white text-base">Add New Header Navbar Link</h3>
                                <button onclick="document.getElementById('modal-add-nav').classList.add('hidden')" class="text-slate-400 hover:text-white">&times;</button>
                            </div>
                            <form method="POST" class="space-y-4 text-xs">
                                <input type="hidden" name="admin_action" value="add_nav_item">
                                
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Link Title *</label>
                                    <input type="text" name="title" required placeholder="e.g. Smart Lighting & Ambience" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Target URL *</label>
                                    <input type="text" name="url" required placeholder="index.php?page=lighting" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Page Identifier</label>
                                        <input type="text" name="page" placeholder="e.g. lighting" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Display Order</label>
                                        <input type="number" name="order" value="<?= count($navItems) + 1 ?>" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Badge Text (Optional)</label>
                                        <input type="text" name="badge" placeholder="e.g. NEW / HOT" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Badge Color</label>
                                        <select name="badge_color" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                            <option value="blue">Blue</option>
                                            <option value="emerald">Emerald</option>
                                            <option value="amber">Amber</option>
                                            <option value="rose">Rose</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 pt-2">
                                    <input type="checkbox" name="active" value="1" id="nav-active-check" checked class="w-4 h-4 rounded text-blue-600 bg-slate-800 border-slate-700">
                                    <label for="nav-active-check" class="text-xs text-slate-300 font-bold">Show link immediately in header</label>
                                </div>

                                <button type="submit" class="w-full py-3 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white font-extrabold text-xs transition-colors shadow-md">
                                    Add Link to Navigation
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal: Edit Nav Item -->
                    <div id="modal-edit-nav" class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                        <div class="w-full max-w-md bg-slate-900 border border-slate-700 rounded-3xl p-6 space-y-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                <h3 class="font-extrabold text-white text-base">Edit Header Navbar Link</h3>
                                <button onclick="document.getElementById('modal-edit-nav').classList.add('hidden')" class="text-slate-400 hover:text-white">&times;</button>
                            </div>
                            <form method="POST" class="space-y-4 text-xs">
                                <input type="hidden" name="admin_action" value="update_nav_item">
                                <input type="hidden" name="nav_id" id="edit-nav-id">
                                
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Link Title *</label>
                                    <input type="text" name="title" id="edit-nav-title" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Target URL *</label>
                                    <input type="text" name="url" id="edit-nav-url" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Page Identifier</label>
                                        <input type="text" name="page" id="edit-nav-page" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Display Order</label>
                                        <input type="number" name="order" id="edit-nav-order" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Badge Text (Optional)</label>
                                        <input type="text" name="badge" id="edit-nav-badge" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Badge Color</label>
                                        <select name="badge_color" id="edit-nav-badge-color" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                            <option value="blue">Blue</option>
                                            <option value="emerald">Emerald</option>
                                            <option value="amber">Amber</option>
                                            <option value="rose">Rose</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 pt-2">
                                    <input type="checkbox" name="active" value="1" id="edit-nav-active" class="w-4 h-4 rounded text-blue-600 bg-slate-800 border-slate-700">
                                    <label for="edit-nav-active" class="text-xs text-slate-300 font-bold">Show link in header</label>
                                </div>

                                <button type="submit" class="w-full py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-xs transition-colors shadow-md">
                                    Save Changes
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            <!-- TAB: FOOTER LINKS MANAGER -->
            <?php elseif ($tab === 'footer'): ?>
                <div class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-black text-white tracking-tight">Website Footer Links Manager</h2>
                        <p class="text-xs text-slate-400 mt-1">Manage all 3 global footer columns (Product Categories, Smart Solutions, Company & Support) and their respective links.</p>
                    </div>

                    <!-- 3 Columns Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <?php
                        $sectionsMeta = [
                            'categories' => ['label' => 'Product Categories', 'badge' => 'Col 1', 'color' => 'blue'],
                            'solutions' => ['label' => 'Custom Solutions', 'badge' => 'Col 2', 'color' => 'emerald'],
                            'quick_links' => ['label' => 'Company & Support', 'badge' => 'Col 3', 'color' => 'amber']
                        ];
                        ?>
                        <?php foreach ($sectionsMeta as $secKey => $meta): ?>
                            <?php $secData = $footerData[$secKey] ?? ['title' => $meta['label'], 'links' => []]; ?>
                            <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 p-5 flex flex-col justify-between shadow-xl space-y-4">
                                <div>
                                    <!-- Column Header & Rename Form -->
                                    <div class="flex items-center justify-between pb-3 border-b border-slate-700/80">
                                        <div>
                                            <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-slate-900 border border-slate-700 text-slate-400"><?= $meta['badge'] ?></span>
                                            <h3 class="font-extrabold text-white text-base mt-1"><?= htmlspecialchars($secData['title'] ?? $meta['label']) ?></h3>
                                        </div>
                                        <span class="text-xs font-black text-slate-400 bg-slate-900 px-2.5 py-1 rounded-full border border-slate-700">
                                            <?= count($secData['links'] ?? []) ?> links
                                        </span>
                                    </div>

                                    <!-- Column Rename Inline Form -->
                                    <form method="POST" class="mt-3 flex gap-2">
                                        <input type="hidden" name="admin_action" value="update_footer_title">
                                        <input type="hidden" name="section" value="<?= $secKey ?>">
                                        <input type="text" name="section_title" value="<?= htmlspecialchars($secData['title'] ?? $meta['label']) ?>" class="flex-1 px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-700 text-xs text-white outline-none focus:border-blue-500" placeholder="Column Title">
                                        <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-slate-700 hover:bg-slate-600 text-white font-bold text-xs transition-colors" title="Rename Column">
                                            Rename
                                        </button>
                                    </form>

                                    <!-- Links List -->
                                    <div class="mt-4 space-y-2">
                                        <?php if (empty($secData['links'])): ?>
                                            <div class="p-4 text-center text-slate-500 text-xs rounded-xl bg-slate-900/40">No links in this column yet.</div>
                                        <?php else: ?>
                                            <?php foreach ($secData['links'] as $link): ?>
                                                <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-900/60 border border-slate-700/60 hover:border-slate-600 transition-colors">
                                                    <div class="overflow-hidden pr-2">
                                                        <div class="font-bold text-white text-xs truncate"><?= htmlspecialchars($link['title']) ?></div>
                                                        <div class="text-[10px] text-blue-300 font-mono truncate"><?= htmlspecialchars($link['url']) ?></div>
                                                    </div>
                                                    <form method="POST" onsubmit="return confirm('Remove link \'<?= htmlspecialchars(addslashes($link['title'])) ?>\'?');" class="shrink-0">
                                                        <input type="hidden" name="admin_action" value="delete_footer_link">
                                                        <input type="hidden" name="section" value="<?= $secKey ?>">
                                                        <input type="hidden" name="link_id" value="<?= htmlspecialchars($link['id']) ?>">
                                                        <button type="submit" class="p-1.5 rounded-lg bg-slate-800 hover:bg-rose-500 text-slate-400 hover:text-white transition-colors" title="Delete Link">
                                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Add Link to Column Form -->
                                <div class="pt-4 border-t border-slate-700/80">
                                    <form method="POST" class="space-y-2 text-xs">
                                        <input type="hidden" name="admin_action" value="add_footer_link">
                                        <input type="hidden" name="section" value="<?= $secKey ?>">
                                        <div class="text-[11px] font-black uppercase text-slate-400">+ Add Link to <?= htmlspecialchars($secData['title'] ?? $meta['label']) ?></div>
                                        <input type="text" name="title" required placeholder="Link Label (e.g. Smart Locks)" class="w-full px-3 py-2 rounded-xl bg-slate-900 border border-slate-700 text-white outline-none focus:border-blue-500">
                                        <input type="text" name="url" required placeholder="Target URL (e.g. index.php?page=smart-glass)" class="w-full px-3 py-2 rounded-xl bg-slate-900 border border-slate-700 text-white outline-none focus:border-blue-500">
                                        <button type="submit" class="w-full py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-xs transition-colors shadow">
                                            + Add Link
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            <!-- TAB 4: STOCK & PURCHASES ("sale purcase handel") -->
            <?php elseif ($tab === 'inventory'): ?>
                <div class="space-y-6">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Stock Inventory & Supplier Purchases</h2>
                            <p class="text-xs text-slate-400 mt-1">Manage warehouse stock quantities, record incoming purchase shipments, and track product profit margins.</p>
                        </div>
                        <button onclick="document.getElementById('modal-add-purchase').classList.remove('hidden')" class="px-4 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-extrabold text-xs flex items-center gap-2 transition-all shadow-md">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            <span>Record Purchase / Stock Intake</span>
                        </button>
                    </div>

                    <!-- Products Inventory Table -->
                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 overflow-hidden shadow-xl">
                        <div class="p-4 bg-slate-900/60 border-b border-slate-700 flex items-center justify-between">
                            <span class="text-xs font-black text-white uppercase tracking-wider">Live Product Inventory (<?= count($products) ?> items)</span>
                            <span class="text-[10px] text-amber-400 font-bold">⚠️ Low Stock alert when &le; 5 units</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-900/40 border-b border-slate-700 text-slate-400 uppercase font-black text-[10px]">
                                    <tr>
                                        <th class="p-4">Product Name</th>
                                        <th class="p-4">Category</th>
                                        <th class="p-4">Current Stock</th>
                                        <th class="p-4">Cost Price</th>
                                        <th class="p-4">Retail Price</th>
                                        <th class="p-4">Margin</th>
                                        <th class="p-4 text-right">Quick Stock Adjustment</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700/60">
                                    <?php foreach ($products as $p): ?>
                                        <?php
                                        $stock = $p['stock'] ?? 0;
                                        $cost = $p['cost_price'] ?? intval($p['price'] * 0.6);
                                        $margin = $p['price'] > 0 ? round((($p['price'] - $cost) / $p['price']) * 100) : 0;
                                        ?>
                                        <tr class="hover:bg-slate-700/30 transition-colors">
                                            <td class="p-4">
                                                <div class="flex items-center gap-2.5">
                                                    <img src="<?= $p['image'] ?: $p['fallback_image'] ?>" alt="" class="w-9 h-9 object-contain rounded-lg bg-white p-0.5 border border-slate-600">
                                                    <div>
                                                        <span class="font-black text-white block text-xs line-clamp-1"><?= htmlspecialchars($p['name']) ?></span>
                                                        <span class="text-[10px] text-slate-400 font-mono"><?= $p['id'] ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 font-bold text-slate-300"><?= htmlspecialchars($p['category_label'] ?? $p['category']) ?></td>
                                            <td class="p-4">
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black <?= $stock <= 5 ? 'bg-rose-500/20 text-rose-300 border border-rose-500/40' : 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' ?>">
                                                    <?= $stock ?> Units <?= $stock <= 5 ? '(LOW)' : '' ?>
                                                </span>
                                            </td>
                                            <td class="p-4 font-mono font-bold text-slate-300">Rs. <?= number_format($cost) ?></td>
                                            <td class="p-4 font-mono font-black text-white">Rs. <?= number_format($p['price']) ?></td>
                                            <td class="p-4">
                                                <span class="text-[10px] font-extrabold text-emerald-400">+<?= $margin ?>%</span>
                                            </td>
                                            <td class="p-4 text-right">
                                                <form method="POST" class="inline-flex items-center gap-1.5 justify-end">
                                                    <input type="hidden" name="admin_action" value="update_product_stock">
                                                    <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                                                    <input type="number" name="stock" value="<?= $stock ?>" class="w-14 px-2 py-1 rounded-lg bg-slate-900 border border-slate-700 text-white font-mono text-center text-xs outline-none">
                                                    <input type="number" name="price" value="<?= $p['price'] ?>" class="w-20 px-2 py-1 rounded-lg bg-slate-900 border border-slate-700 text-white font-mono text-center text-xs outline-none" title="Selling Price">
                                                    <button type="submit" class="px-2.5 py-1 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs transition-colors">
                                                        Save
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Purchase Receipts History ("purcase handel") -->
                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 overflow-hidden shadow-xl">
                        <div class="p-4 bg-slate-900/60 border-b border-slate-700 flex items-center justify-between">
                            <span class="text-xs font-black text-white uppercase tracking-wider">Purchase Shipments & Stock Intake History</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-900/40 border-b border-slate-700 text-slate-400 uppercase font-black text-[10px]">
                                    <tr>
                                        <th class="p-4">PO Number & Date</th>
                                        <th class="p-4">Supplier / Vendor</th>
                                        <th class="p-4">Invoice No</th>
                                        <th class="p-4">Quantity Added</th>
                                        <th class="p-4">Total Cost</th>
                                        <th class="p-4">Notes</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700/60">
                                    <?php foreach ($purchases as $po): ?>
                                        <tr class="hover:bg-slate-700/30">
                                            <td class="p-4 font-mono font-bold text-blue-400"><?= $po['id'] ?> (<?= $po['date'] ?>)</td>
                                            <td class="p-4 font-black text-white"><?= htmlspecialchars($po['supplier']) ?></td>
                                            <td class="p-4 font-mono text-slate-300"><?= htmlspecialchars($po['invoice_no']) ?></td>
                                            <td class="p-4 font-bold text-emerald-400">+<?= $po['items_count'] ?> Units</td>
                                            <td class="p-4 font-black text-white">Rs. <?= number_format($po['total_cost']) ?></td>
                                            <td class="p-4 text-slate-400 text-[11px]"><?= htmlspecialchars($po['notes'] ?? '') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal: Add Purchase Shipment -->
                    <div id="modal-add-purchase" class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                        <div class="w-full max-w-lg bg-slate-900 border border-slate-700 rounded-3xl p-6 space-y-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                <h3 class="font-extrabold text-white text-base">Record Purchase / Stock Intake</h3>
                                <button onclick="document.getElementById('modal-add-purchase').classList.add('hidden')" class="text-slate-400 hover:text-white">&times;</button>
                            </div>
                            <form method="POST" class="space-y-3 text-xs">
                                <input type="hidden" name="admin_action" value="add_purchase">
                                
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Supplier / Vendor Name *</label>
                                        <input type="text" name="supplier" required value="Tuya Global IoT Supply Ltd" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Invoice / Shipment Number</label>
                                        <input type="text" name="invoice_no" placeholder="INV-2026-99" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Select Product Line to Restock *</label>
                                    <select name="product_id" required class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                        <?php foreach ($products as $pr): ?>
                                            <option value="<?= $pr['id'] ?>"><?= htmlspecialchars($pr['name']) ?> (Current: <?= $pr['stock'] ?? 0 ?> in stock)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Quantity Received *</label>
                                        <input type="number" name="quantity" required value="20" min="1" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Unit Purchase Cost (Rs.) *</label>
                                        <input type="number" name="unit_cost" required value="4500" min="0" class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Notes / Customs / Verification</label>
                                    <textarea name="notes" rows="2" placeholder="e.g. Cleared customs at Karachi port, verified 100% operational." class="w-full px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none"></textarea>
                                </div>

                                <button type="submit" class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-extrabold text-xs transition-colors shadow-md">
                                    Confirm Stock Intake & Update Inventory
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            <!-- TAB: USERS & STAFF MANAGEMENT -->
            <?php elseif ($tab === 'users'): ?>
                <div class="space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Admin Users & Staff Access Management</h2>
                            <p class="text-xs text-slate-400 mt-1">Manage administrator logins, staff roles (Super Admin, Sales Manager, Automation Engineer), access permissions and credentials.</p>
                        </div>
                        <button onclick="document.getElementById('modal-add-user').classList.remove('hidden')" class="px-4 py-2 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-extrabold text-xs flex items-center gap-2 transition-all shadow-md">
                            <i data-lucide="user-plus" class="w-4 h-4"></i>
                            <span>Create New Staff Account</span>
                        </button>
                    </div>

                    <!-- Staff Stats -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="p-4 rounded-2xl bg-slate-800/80 border border-slate-700/80">
                            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400">Total Staff Accounts</div>
                            <div class="text-2xl font-black text-white mt-1"><?= count($allUsers) ?></div>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-800/80 border border-slate-700/80">
                            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400">Active Accounts</div>
                            <div class="text-2xl font-black text-emerald-400 mt-1"><?= count(array_filter($allUsers, fn($u) => ($u['status'] ?? '') === 'active')) ?></div>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-800/80 border border-slate-700/80">
                            <div class="text-[10px] font-black uppercase tracking-wider text-slate-400">Your Current Session</div>
                            <div class="text-base font-black text-purple-400 mt-1 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <?= htmlspecialchars($_SESSION['admin_user'] ?? 'admin') ?>
                            </div>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-900/80 text-slate-400 uppercase font-black text-[10px] tracking-wider border-b border-slate-700">
                                    <tr>
                                        <th class="p-4">Staff Member</th>
                                        <th class="p-4">Email</th>
                                        <th class="p-4">Assigned Role</th>
                                        <th class="p-4">Status</th>
                                        <th class="p-4">Created / Updated</th>
                                        <th class="p-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700">
                                    <?php foreach ($allUsers as $u): ?>
                                        <?php 
                                        $isSelf = strtolower($u['username']) === strtolower($_SESSION['admin_user'] ?? '');
                                        ?>
                                        <tr class="hover:bg-slate-700/30 transition-colors">
                                            <td class="p-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-purple-600 to-blue-500 flex items-center justify-center text-white font-extrabold text-sm shrink-0">
                                                        <?= strtoupper(substr($u['admin_name'] ?? $u['username'], 0, 1)) ?>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-white text-sm flex items-center gap-2">
                                                            <span><?= htmlspecialchars($u['admin_name'] ?? $u['username']) ?></span>
                                                            <?php if ($isSelf): ?>
                                                                <span class="px-1.5 py-0.5 rounded text-[9px] font-black bg-blue-500/20 text-blue-300 border border-blue-500/40">You</span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="text-[11px] text-slate-400 font-mono">@<?= htmlspecialchars($u['username']) ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 text-slate-300">
                                                <?= htmlspecialchars($u['email'] ?? '-') ?>
                                            </td>
                                            <td class="p-4">
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold <?= str_contains(strtolower($u['role'] ?? ''), 'super') ? 'bg-purple-500/20 text-purple-300 border border-purple-500/40' : (str_contains(strtolower($u['role'] ?? ''), 'sales') ? 'bg-amber-500/20 text-amber-300 border border-amber-500/40' : 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40') ?>">
                                                    <?= htmlspecialchars($u['role'] ?? 'Staff') ?>
                                                </span>
                                            </td>
                                            <td class="p-4">
                                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold flex items-center gap-1.5 w-max <?= ($u['status'] ?? 'active') === 'active' ? 'bg-emerald-500/20 text-emerald-300' : 'bg-slate-700 text-slate-400' ?>">
                                                    <span class="w-1.5 h-1.5 rounded-full <?= ($u['status'] ?? 'active') === 'active' ? 'bg-emerald-400 animate-pulse' : 'bg-slate-500' ?>"></span>
                                                    <span><?= ucfirst($u['status'] ?? 'active') ?></span>
                                                </span>
                                            </td>
                                            <td class="p-4 text-slate-400 font-mono text-[11px]">
                                                <?= htmlspecialchars($u['created_at'] ?? ($u['updated_at'] ?? '-')) ?>
                                            </td>
                                            <td class="p-4 text-right space-x-2">
                                                <button 
                                                    type="button" 
                                                    onclick="openEditUserModal(<?= htmlspecialchars(json_encode($u)) ?>)" 
                                                    class="p-2 rounded-xl bg-slate-700 hover:bg-purple-600 text-slate-300 hover:text-white transition-colors" 
                                                    title="Edit User Role / Status / Password"
                                                >
                                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                                </button>

                                                <?php if (!$isSelf && count($allUsers) > 1): ?>
                                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete user account \'<?= htmlspecialchars(addslashes($u['username'])) ?>\'?');" class="inline">
                                                        <input type="hidden" name="admin_action" value="delete_user">
                                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($u['id']) ?>">
                                                        <button type="submit" class="p-2 rounded-xl bg-slate-700 hover:bg-rose-500 text-slate-300 hover:text-white transition-colors" title="Delete User">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <button disabled class="p-2 rounded-xl bg-slate-800 text-slate-600 cursor-not-allowed" title="<?= $isSelf ? 'Cannot delete your own account' : 'Cannot delete the only admin' ?>">
                                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal: Add User -->
                    <div id="modal-add-user" class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                        <div class="w-full max-w-md bg-slate-900 border border-slate-700 rounded-3xl p-6 space-y-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                <h3 class="font-extrabold text-white text-base">Create New Admin / Staff User</h3>
                                <button onclick="document.getElementById('modal-add-user').classList.add('hidden')" class="text-slate-400 hover:text-white">&times;</button>
                            </div>
                            <form method="POST" class="space-y-4 text-xs">
                                <input type="hidden" name="admin_action" value="add_user">
                                
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Username *</label>
                                    <input type="text" name="username" required placeholder="e.g. zohaib_eng" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-purple-500">
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Full Name *</label>
                                    <input type="text" name="admin_name" required placeholder="e.g. Engr. Zohaib Hassan" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-purple-500">
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Email Address</label>
                                    <input type="email" name="email" placeholder="e.g. zohaib@intellitech.pk" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-purple-500">
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Temporary Password (Min 6 chars) *</label>
                                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-purple-500">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Assigned Role</label>
                                        <select name="role" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                            <option value="Super Administrator">Super Administrator</option>
                                            <option value="Sales & Orders Manager">Sales & Orders Manager</option>
                                            <option value="Automation Engineer">Automation Engineer</option>
                                            <option value="Store Staff">Store Staff</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Account Status</label>
                                        <select name="status" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="w-full py-3 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-extrabold text-xs transition-colors shadow-md">
                                    Create Staff Account
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal: Edit User -->
                    <div id="modal-edit-user" class="hidden fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4">
                        <div class="w-full max-w-md bg-slate-900 border border-slate-700 rounded-3xl p-6 space-y-4">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                <h3 class="font-extrabold text-white text-base">Edit Staff User</h3>
                                <button onclick="document.getElementById('modal-edit-user').classList.add('hidden')" class="text-slate-400 hover:text-white">&times;</button>
                            </div>
                            <form method="POST" class="space-y-4 text-xs">
                                <input type="hidden" name="admin_action" value="update_user">
                                <input type="hidden" name="user_id" id="edit-user-id">
                                
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Full Name</label>
                                    <input type="text" name="admin_name" id="edit-user-name" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-purple-500">
                                </div>

                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Email Address</label>
                                    <input type="email" name="email" id="edit-user-email" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-purple-500">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Assigned Role</label>
                                        <select name="role" id="edit-user-role" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                            <option value="Super Administrator">Super Administrator</option>
                                            <option value="Sales & Orders Manager">Sales & Orders Manager</option>
                                            <option value="Automation Engineer">Automation Engineer</option>
                                            <option value="Store Staff">Store Staff</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-slate-400 mb-1 font-bold">Account Status</label>
                                        <select name="status" id="edit-user-status" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="pt-2 border-t border-slate-800">
                                    <label class="block text-slate-400 mb-1 font-bold">Change Password (Leave blank to keep current)</label>
                                    <input type="password" name="new_password" placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white outline-none focus:border-purple-500">
                                </div>

                                <button type="submit" class="w-full py-3 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-extrabold text-xs transition-colors shadow-md">
                                    Save User Updates
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            <!-- TAB 5: INQUIRIES & MESSAGES -->
            <?php elseif ($tab === 'messages'): ?>
                <div class="space-y-6">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Customer Inquiries & Messages</h2>
                            <p class="text-xs text-slate-400 mt-1">Review contact inquiries, respond directly on WhatsApp, and resolve homeowner questions.</p>
                        </div>
                    </div>

                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 overflow-hidden shadow-xl">
                        <div class="divide-y divide-slate-700">
                            <?php if (empty($messages)): ?>
                                <div class="p-8 text-center text-slate-400 text-xs">No inquiries received yet.</div>
                            <?php else: ?>
                                <?php foreach ($messages as $msg): ?>
                                    <div class="p-5 flex flex-col md:flex-row items-start justify-between gap-4 hover:bg-slate-700/20 transition-colors">
                                        <div class="space-y-1.5 flex-1">
                                            <div class="flex items-center gap-2">
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-black <?= $msg['status'] === 'Unread' ? 'bg-blue-500 text-white' : 'bg-slate-700 text-slate-300' ?>">
                                                    <?= $msg['status'] ?>
                                                </span>
                                                <span class="font-black text-white text-sm"><?= htmlspecialchars($msg['name']) ?></span>
                                                <span class="text-xs text-slate-400 font-mono">&bull; <?= $msg['created_at'] ?></span>
                                            </div>
                                            <div class="text-xs text-blue-300 font-bold"><?= htmlspecialchars($msg['subject'] ?? 'Website Inquiry') ?></div>
                                            <p class="text-xs text-slate-300 leading-relaxed max-w-2xl bg-slate-900/60 p-3 rounded-xl border border-slate-700/60 mt-1">
                                                <?= nl2br(htmlspecialchars($msg['message'])) ?>
                                            </p>
                                        </div>

                                        <!-- Quick Response Controls -->
                                        <div class="shrink-0 space-y-2 text-right">
                                            <?php
                                            $cleanMsgPhone = preg_replace('/[^0-9]/', '', $msg['phone']);
                                            if (str_starts_with($cleanMsgPhone, '0')) $cleanMsgPhone = '92' . substr($cleanMsgPhone, 1);
                                            ?>
                                            <div class="flex items-center gap-2 justify-end">
                                                <a 
                                                    href="https://wa.me/<?= $cleanMsgPhone ?>?text=<?= urlencode("Hello " . $msg['name'] . "! This is IntelliTech Solutions regarding your inquiry: " . ($msg['subject'] ?? '')) ?>" 
                                                    target="_blank" 
                                                    rel="noopener"
                                                    class="px-3 py-1.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-xs flex items-center gap-1.5 transition-colors"
                                                >
                                                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                                    <span>Reply on WhatsApp</span>
                                                </a>

                                                <form method="POST" class="inline">
                                                    <input type="hidden" name="admin_action" value="update_message_status">
                                                    <input type="hidden" name="msg_id" value="<?= $msg['id'] ?>">
                                                    <input type="hidden" name="status" value="Replied">
                                                    <button class="px-2.5 py-1.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white text-xs font-bold transition-colors">
                                                        Mark Replied
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="text-[11px] text-slate-400">
                                                📞 <?= htmlspecialchars($msg['phone']) ?> &bull; ✉️ <?= htmlspecialchars($msg['email']) ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

            <!-- TAB 6: STORE & SETTINGS -->
            <?php elseif ($tab === 'settings'): ?>
                <div class="space-y-6 max-w-4xl">
                    
                    <div>
                        <h2 class="text-2xl font-black text-white tracking-tight">Store & Company Settings</h2>
                        <p class="text-xs text-slate-400 mt-1">Manage contact numbers, nationwide showrooms, and super admin credentials.</p>
                    </div>

                    <!-- Contact & Hotlines Settings Card -->
                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 p-6 space-y-4">
                        <h3 class="font-black text-white text-sm uppercase tracking-wider">Company Hotlines & Addresses</h3>
                        
                        <form method="POST" class="space-y-4 text-xs">
                            <input type="hidden" name="admin_action" value="save_settings">
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">Primary Phone Hotline</label>
                                    <input type="text" name="phone" placeholder="e.g. +92 300 1234567 (optional)" value="<?= htmlspecialchars($content['contacts']['phone'] ?? '') ?>" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white outline-none">
                                </div>
                                <div>
                                    <label class="block text-slate-400 mb-1 font-bold">WhatsApp Hotline Number</label>
                                    <input type="text" name="phone_secondary" placeholder="e.g. +92 300 1234567 (optional)" value="<?= htmlspecialchars($content['contacts']['phone_secondary'] ?? '') ?>" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-slate-400 mb-1 font-bold">Official Support Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($content['contacts']['email'] ?? 'info@intellitech.pk') ?>" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white outline-none">
                            </div>

                            <div>
                                <label class="block text-slate-400 mb-1 font-bold">Faisalabad Virtual Office Address</label>
                                <textarea name="address_faisalabad" rows="2" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white outline-none"><?= htmlspecialchars($content['contacts']['address'] ?? 'Plaza 18, Main Susan Road, Kohinoor City, Faisalabad, Punjab, Pakistan') ?></textarea>
                            </div>

                            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#2189ff] hover:bg-blue-600 text-white font-extrabold text-xs transition-colors shadow-md">
                                Save Contact Settings
                            </button>
                        </form>
                    </div>

                    <!-- Change Admin Password Card -->
                    <div class="bg-slate-800/80 rounded-2xl border border-slate-700/80 p-6 space-y-4">
                        <h3 class="font-black text-white text-sm uppercase tracking-wider">Change SuperAdmin Password</h3>
                        
                        <form method="POST" class="space-y-4 text-xs max-w-md">
                            <input type="hidden" name="admin_action" value="change_password">
                            
                            <div>
                                <label class="block text-slate-400 mb-1 font-bold">New Password (Min 6 characters)</label>
                                <input type="password" name="new_password" required placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white outline-none">
                            </div>

                            <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-extrabold text-xs transition-colors shadow-md">
                                Update Password
                            </button>
                        </form>
                    </div>

                </div>
            <?php endif; ?>

        </main>
    </div>

    <!-- Script for Charts & Modal Handlers -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }

            // Sales Trend Chart
            const ctxTrend = document.getElementById('chart-sales-trend');
            if (ctxTrend) {
                new Chart(ctxTrend, {
                    type: 'line',
                    data: {
                        labels: ['June', 'July', 'August', 'September', 'October', 'November'],
                        datasets: [{
                            label: 'Monthly Revenue (PKR)',
                            data: [120000, 185000, 240000, 310000, 395000, <?= $totalRevenue ?>],
                            borderColor: '#2189ff',
                            backgroundColor: 'rgba(33, 137, 255, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.35,
                            pointBackgroundColor: '#2189ff',
                            pointRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } },
                            y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94a3b8' } }
                        }
                    }
                });
            }

            // Category Chart
            const ctxCat = document.getElementById('chart-categories');
            if (ctxCat) {
                new Chart(ctxCat, {
                    type: 'doughnut',
                    data: {
                        labels: ['Smart Switches', 'Zigbee Hubs', 'Smart Locks', 'Cameras', 'Lighting'],
                        datasets: [{
                            data: [42, 25, 18, 10, 5],
                            backgroundColor: ['#2189ff', '#10b981', '#a855f7', '#f43f5e', '#f59e0b'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom', labels: { color: '#cbd5e1', font: { size: 10 } } }
                        }
                    }
                });
            }
        });

        function openEditSurveyModal(id, status, eng, date) {
            document.getElementById('edit-survey-id').value = id;
            document.getElementById('edit-survey-status').value = status;
            document.getElementById('edit-survey-eng').value = eng;
            document.getElementById('edit-survey-date').value = date;
            document.getElementById('modal-edit-survey').classList.remove('hidden');
        }

        function openEditNavModal(nav) {
            document.getElementById('edit-nav-id').value = nav.id;
            document.getElementById('edit-nav-title').value = nav.title || '';
            document.getElementById('edit-nav-url').value = nav.url || '';
            document.getElementById('edit-nav-page').value = nav.page || '';
            document.getElementById('edit-nav-badge').value = nav.badge || '';
            document.getElementById('edit-nav-badge-color').value = nav.badge_color || 'blue';
            document.getElementById('edit-nav-order').value = nav.order || 1;
            document.getElementById('edit-nav-active').checked = !!nav.active;
            document.getElementById('modal-edit-nav').classList.remove('hidden');
        }

        function openEditUserModal(u) {
            document.getElementById('edit-user-id').value = u.id;
            document.getElementById('edit-user-name').value = u.admin_name || u.username;
            document.getElementById('edit-user-email').value = u.email || '';
            document.getElementById('edit-user-role').value = u.role || 'Super Administrator';
            document.getElementById('edit-user-status').value = u.status || 'active';
            document.getElementById('modal-edit-user').classList.remove('hidden');
        }

        function filterRatesTable() {
            const query = (document.getElementById('rateSearchInput')?.value || '').toLowerCase();
            const rows = document.querySelectorAll('#ratesTable tbody tr');
            rows.forEach(r => {
                const text = r.textContent.toLowerCase();
                r.style.display = text.includes(query) ? '' : 'none';
            });
        }
    </script>
<?php endif; ?>

</body>
</html>
