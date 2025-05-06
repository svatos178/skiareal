<?php
declare(strict_types = 1);
include_once("db.php");

function prepare_and_execc(string $query, ...$hodnoty) : mysqli_stmt
{
    global $db;
    $stmt = $db->prepare($query);
    if (!$stmt) {
        die("Illegal query, kys pls.");
    }
    $stmt->bind_param(str_repeat("s", count($hodnoty)), ...$hodnoty);
    $stmt->execute();
    return $stmt;
}

function selecc(string $query, ...$hodnoty) : ?array
{
    $stmt = prepare_and_execc($query, ...$hodnoty);
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    return $result;
}

function insert(string $query, ...$hodnoty): void
{
    $stmt = prepare_and_execc($query, ...$hodnoty); 
    $stmt->close();
}

function selecc_all(string $query, ...$hodnoty) : ?array
{
    $stmt = prepare_and_execc($query, ...$hodnoty);
    $result = $stmt->get_result()->fetch_all();
    $stmt->close();
    return $result;
}

function update(string $query, ...$hodnoty): void
{
    $stmt = prepare_and_execc($query, ...$hodnoty); 
    $stmt->close();
}