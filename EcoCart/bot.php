<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ecocart";

// Connect to DB
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user message and username (if available)
$userMsg = strtolower(trim($_POST['message']));
$username = isset($_POST['username']) ? $_POST['username'] : "Guest";

// Default fallback reply
$reply = "I'm still learning 🌱. Please try asking about our eco products, pricing, or orders.";

// Keyword-based responses
switch (true) {
    // 🔹 Exact-match questions
    case $userMsg === 'do you have bamboo toothbrushes?':
        $reply = "Yes! We offer bamboo toothbrushes that are biodegradable and perfect for eco-conscious living.";
        break;

    case $userMsg === 'what’s the price of a metal straw?':
    case $userMsg === 'what is the price of a metal straw?':
        $reply = "Our reusable metal straw costs just $3.00!";
        break;

    case $userMsg === 'how do i place an order?':
        $reply = "Just add items to your cart, log in or sign up, and click 'Checkout' to complete your order!";
        break;

    case $userMsg === 'can i return a product?':
        $reply = "Yes, you can return products within 7 days if they’re in unused condition. Read our return policy for more details.";
        break;

    case $userMsg === 'are your products biodegradable?':
        $reply = "Absolutely! Most of our products are made from biodegradable or compostable materials 🌱.";
        break;

    case $userMsg === 'what is ecocart?':
        $reply = "EcoCart is your eco-friendly shopping assistant that helps you find sustainable alternatives to everyday items.";
        break;

    // 🔹 Existing keyword-based conditions
    case strpos($userMsg, 'what is ecocart') !== false:
    case strpos($userMsg, 'about ecocart') !== false:
        $reply = "EcoCart is a sustainable shopping assistant that helps you find and choose eco-friendly alternatives!";
        break;

    case strpos($userMsg, 'products') !== false:
    case strpos($userMsg, 'eco-friendly') !== false:
        $reply = "We offer bamboo toothbrushes, biodegradable bags, reusable straws, and much more!";
        break;

    case strpos($userMsg, 'bamboo toothbrush') !== false:
    case strpos($userMsg, 'toothbrush') !== false:
        $reply = "Yes! Our bamboo toothbrush is compostable, plastic-free, and perfect for eco-living.";
        break;

    case strpos($userMsg, 'plastic bottles') !== false:
        $reply = "Switch to our reusable stainless steel water bottles – no more plastic waste!";
        break;

    case strpos($userMsg, 'bamboo straws') !== false:
    case strpos($userMsg, 'metal straws') !== false:
        $reply = "Both are great! Bamboo straws are compostable, while metal straws are durable and reusable.";
        break;

    case strpos($userMsg, 'compostable') !== false:
        $reply = "Yes, we have compostable items like trash bags and utensils.";
        break;

    case strpos($userMsg, 'biodegradable') !== false:
        $reply = "Absolutely! Most of our products are biodegradable and safe for nature.";
        break;

    case strpos($userMsg, 'eco rating') !== false:
        $reply = "Products are rated as High, Medium, or Low based on materials and environmental impact.";
        break;

    case strpos($userMsg, 'how long') !== false:
    case strpos($userMsg, 'durable') !== false:
        $reply = "Our products are designed to be long-lasting and sustainable.";
        break;

    case strpos($userMsg, 'vegan') !== false:
        $reply = "Yes! Many of our items are vegan-friendly and cruelty-free.";
        break;

    case strpos($userMsg, 'price') !== false && strpos($userMsg, 'metal straw') !== false:
        $reply = "Our metal straw is just $3.00!";
        break;

    case strpos($userMsg, 'price') !== false && strpos($userMsg, 'bamboo toothbrush') !== false:
        $reply = "The bamboo toothbrush is priced at $2.50.";
        break;

    case strpos($userMsg, 'affordable') !== false:
    case strpos($userMsg, 'cheap') !== false:
        $reply = "We aim to offer eco-products that are affordable and accessible to all.";
        break;

    case strpos($userMsg, 'bulk') !== false:
    case strpos($userMsg, 'discount') !== false:
        $reply = "Yes, we offer discounts on bulk orders! Contact us for custom deals.";
        break;

    case strpos($userMsg, 'free shipping') !== false:
        $reply = "We provide free shipping on orders above $50.";
        break;

    case strpos($userMsg, 'place order') !== false:
        $reply = "Add items to your cart, log in, and proceed to checkout to place your order.";
        break;

    case strpos($userMsg, 'deliver') !== false:
    case strpos($userMsg, 'shipping') !== false:
        $reply = "Yes, we deliver nationwide. Delivery usually takes 3–5 business days.";
        break;

    case strpos($userMsg, 'track order') !== false:
        $reply = "After placing your order, you'll receive a tracking link via email.";
        break;

    case strpos($userMsg, 'damaged') !== false:
        $reply = "Sorry to hear that! Please email us with photos and we’ll help resolve it quickly.";
        break;

    case strpos($userMsg, 'return') !== false && strpos($userMsg, 'product') !== false:
        $reply = "Yes, you can return most products within 7 days of delivery.";
        break;

    case strpos($userMsg, 'refund') !== false:
        $reply = "Our refund policy ensures a full return for eligible products within the return window.";
        break;

    case strpos($userMsg, 'initiate') !== false:
    case strpos($userMsg, 'start return') !== false:
        $reply = "To start a return, go to your order history and click 'Return Item'.";
        break;

    case strpos($userMsg, 'exchange') !== false:
        $reply = "Yes, we offer exchanges if the product is in unused condition.";
        break;

    case strpos($userMsg, 'assistant') !== false && strpos($userMsg, 'what') !== false:
        $reply = "I’m your EcoCart Assistant 🤖. I help you shop sustainably and answer product questions!";
        break;

    case strpos($userMsg, 'chatbot') !== false:
    case strpos($userMsg, 'how do i use') !== false:
        $reply = "Just type your question in the box! I'm always here to help 🌱.";
        break;

    case strpos($userMsg, 'recommend') !== false:
    case strpos($userMsg, 'suggest') !== false:
        $reply = "Try our Ecofriendly Houseware – it has the highest eco rating!";
        break;

    case strpos($userMsg, 'sustainable') !== false && strpos($userMsg, 'toothbrush') !== false:
        $reply = "The bamboo toothbrush is your best sustainable option!";
        break;

    case strpos($userMsg, 'reusable') !== false && strpos($userMsg, 'plastic straws') !== false:
        $reply = "Use our reusable metal or bamboo straws instead of single-use plastic ones!";
        break;

    case strpos($userMsg, 'account') !== false:
    case strpos($userMsg, 'sign up') !== false:
    case strpos($userMsg, 'log in') !== false:
        $reply = "You can sign up or log in from the Login button in the top-right corner.";
        break;

    case strpos($userMsg, 'save items') !== false:
    case strpos($userMsg, 'cart') !== false:
        $reply = "Yes! Logged-in users can save items in their cart.";
        break;

    case strpos($userMsg, 'check out') !== false:
        $reply = "Click on your cart, then select 'Checkout' to proceed with your order.";
        break;

    case strpos($userMsg, 'who runs') !== false:
    case strpos($userMsg, 'certified') !== false:
        $reply = "EcoCart is managed by a team of green-minded entrepreneurs 🌿. Yes, we work with certified eco-brands!";
        break;

    case strpos($userMsg, 'hello') !== false:
    case strpos($userMsg, 'hi') !== false:
        $reply = "Hello 👋 I'm your EcoCart Assistant. Ask me about products, prices, or eco tips!";
        break;
}

// Save chat to database
$stmt = $conn->prepare("INSERT INTO chatbot (username, user_message, bot_reply) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $userMsg, $reply);
$stmt->execute();

// Send reply
echo $reply;
$conn->close();
?>
