<?php
// Mock data for search results (you can replace this with actual data retrieval from a database)
$products = array(
    array("id" => 1, "name" => "Product A", "price" => 20),
    array("id" => 2, "name" => "Product B", "price" => 30),
    array("id" => 3, "name" => "Product C", "price" => 25),
    array("id" => 4, "name" => "Product D", "price" => 40),
);

// Get the search query from the GET parameter
$query = isset($_GET['q']) ? $_GET['q'] : '';

// Filter products based on the search query
$results = array_filter($products, function($product) use ($query) {
    return stripos($product['name'], $query) !== false;
});

// Return the search results as JSON
header('Content-Type: application/json');
echo json_encode($results);
?>