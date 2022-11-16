<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use app\Services\AuthService;
use app\Services\RouteService;

(new AuthService());
RouteService::run();
RouteService::boot();
