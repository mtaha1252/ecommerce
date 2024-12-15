<?php
session_start();

// Ensure cart is initialized before usage
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['cart_total'])) {
    $_SESSION['cart_total'] = 0;
}

$request = json_decode(file_get_contents("php://input"), true);

$action = $request['action'] ?? '';
$id = $request['id'] ?? '';

switch ($action) {
    case 'add':
        // Add item to cart
        $name = $request['name'] ?? '';
        $price = $request['price'] ?? 0;

        if ($id && $name && $price) {
            // If the product already exists in the cart, increment quantity
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity']++;
            } else {
                $_SESSION['cart'][$id] = [
                    'name' => $name,
                    'price' => $price,
                    'quantity' => 1
                ];
            }

            // Recalculate the total after adding
            $_SESSION['cart_total'] = 0;
            foreach ($_SESSION['cart'] as $item) {
                $_SESSION['cart_total'] += $item['price'] * $item['quantity'];
            }

            // Return response with cart info
            echo json_encode([
                'success' => true,
                'message' => 'Item added to cart!',
                'cart' => $_SESSION['cart'],
                'cart_total' => $_SESSION['cart_total']
            ]);
        }
        break;

    case 'remove':
        // Remove item from cart
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);  // Remove the item from the cart

            // Recalculate total after removal
            $_SESSION['cart_total'] = 0;
            foreach ($_SESSION['cart'] as $item) {
                $_SESSION['cart_total'] += $item['price'] * $item['quantity'];
            }

            // Return updated cart info
            echo json_encode([
                'success' => true,
                'message' => 'Item removed from cart!',
                'cart' => $_SESSION['cart'],
                'cart_total' => $_SESSION['cart_total']  // Send updated total with response
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Item not found in cart!'
            ]);
        }
        break;

    case 'view':
        // Show cart
        echo json_encode([
            'success' => true,
            'cart' => $_SESSION['cart'],
            'cart_total' => $_SESSION['cart_total'] // Send total for display
        ]);
        break;

    default:
        echo json_encode([
            'success' => false,
            'message' => 'Invalid action!'
        ]);
        break;
}
?>
