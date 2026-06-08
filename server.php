<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * This file allows the PHP built-in server to serve static files from
 * the public directory when the server is started from the project root.
 *
 * Usage:  php -S 127.0.0.1:3000 server.php
 *
 * @see https://laravel.com/docs/deployment
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// If the requested URI corresponds to an actual file in the public directory,
// serve it directly. This handles CSS, JS, images, fonts, etc.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    // Get the file extension for MIME type mapping
    $ext = pathinfo($uri, PATHINFO_EXTENSION);

    $mimeTypes = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'json' => 'application/json',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
        'ico'  => 'image/x-icon',
        'webp' => 'image/webp',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
        'ttf'  => 'font/ttf',
        'eot'  => 'application/vnd.ms-fontobject',
        'otf'  => 'font/otf',
        'map'  => 'application/json',
        'mp4'  => 'video/mp4',
        'webm' => 'video/webm',
        'mp3'  => 'audio/mpeg',
        'wav'  => 'audio/wav',
        'pdf'  => 'application/pdf',
        'xml'  => 'application/xml',
        'txt'  => 'text/plain',
    ];

    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
    }

    readfile(__DIR__.'/public'.$uri);
    return;
}

// Otherwise, pass the request to the Laravel application entry point
require_once __DIR__.'/index.php';
