<?php 
protected $routeMiddleware = [
  'auth' => \App\Http\Middleware\Authenticate::class,
  'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
  'role' => \App\Http\Middleware\CheckRole::class, // Pastikan ini ada
];

?>