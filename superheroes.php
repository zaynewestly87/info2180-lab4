<?php

$superheroes = [
    [
        "alias" => "Superman",
        "name" => "Clark Kent",
        "biography" => "Superman is a fictional superhero appearing in American comic books published by DC Comics."
    ],
    [
        "alias" => "Batman",
        "name" => "Bruce Wayne",
        "biography" => "Batman is a superhero appearing in American comic books published by DC Comics."
    ],
    [
        "alias" => "Wonder Woman",
        "name" => "Diana Prince",
        "biography" => "Wonder Woman is a superhero appearing in American comic books published by DC Comics."
    ],
    [
        "alias" => "Flash",
        "name" => "Barry Allen",
        "biography" => "The Flash is a superhero appearing in American comic books published by DC Comics."
    ],
    [
        "alias" => "Iron Man",
        "name" => "Tony Stark",
        "biography" => "Iron Man is a superhero appearing in American comic books published by Marvel Comics."
    ],
    [
        "alias" => "Captain America",
        "name" => "Steve Rogers",
        "biography" => "Captain America is a superhero appearing in American comic books published by Marvel Comics."
    ],
];

$query = $_GET['query'] ?? '';
$query = trim($query);

header("Access-Control-Allow-Origin: *");

if ($query === '') {
    // ----- Return full list -----
    echo "<ul>";
    foreach ($superheroes as $hero) {
        echo "<li>{$hero['alias']}</li>";
    }
    echo "</ul>";
    exit;
}

// Sanitize input
$query = filter_var($query, FILTER_SANITIZE_STRING);

// ----- Search for exact or partial match (case-insensitive) -----
$found = null;

foreach ($superheroes as $hero) {
    if (stripos($hero['alias'], $query) !== false || 
        stripos($hero['name'], $query) !== false) {
        $found = $hero;
        break;
    }
}

if ($found) {
    echo "<h3>{$found['alias']}</h3>";
    echo "<h4>{$found['name']}</h4>";
    echo "<p>{$found['biography']}</p>";
} else {
    echo "<p>Superhero not found</p>";
}
