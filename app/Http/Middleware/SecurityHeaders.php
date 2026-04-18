<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $csp = implode('; ', [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://checkout.razorpay.com https://cdn.razorpay.com https://cdn.jsdelivr.net https://cdn.ckeditor.com https://cdnjs.cloudflare.com",
            "script-src-elem 'self' 'unsafe-inline' https://checkout.razorpay.com https://cdn.razorpay.com https://cdn.jsdelivr.net https://cdn.ckeditor.com https://cdnjs.cloudflare.com",
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.bunny.net https://fonts.googleapis.com",
            "style-src-elem 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.bunny.net https://fonts.googleapis.com",
            "font-src 'self' data: https://fonts.bunny.net https://fonts.gstatic.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com",
            "img-src 'self' data: blob: https:",
            "media-src 'self' https:",
            "connect-src 'self' https://checkout.razorpay.com https://api.razorpay.com https://lumberjack.razorpay.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net",
            "frame-src 'self' https://api.razorpay.com https://checkout.razorpay.com https://www.youtube.com https://www.youtube-nocookie.com",
            "worker-src 'self' blob:",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self' https://checkout.razorpay.com",
            "frame-ancestors 'self'",
            "upgrade-insecure-requests",
        ]);

        $cspHeader = env('CSP_REPORT_ONLY', false)
            ? 'Content-Security-Policy-Report-Only'
            : 'Content-Security-Policy';

        $headers = [
            $cspHeader               => $csp,
            'X-Frame-Options'        => 'SAMEORIGIN',
            'X-Content-Type-Options' => 'nosniff',
            'Referrer-Policy'        => 'strict-origin-when-cross-origin',
            'Permissions-Policy'     => 'camera=(), microphone=(), geolocation=(), usb=(), magnetometer=(), payment=(self "https://checkout.razorpay.com" "https://api.razorpay.com"), accelerometer=(self "https://checkout.razorpay.com" "https://api.razorpay.com"), gyroscope=(self "https://checkout.razorpay.com" "https://api.razorpay.com")',
            'X-Permitted-Cross-Domain-Policies' => 'none',
            'Cross-Origin-Resource-Policy' => 'same-site',
        ];

        if ($request->isSecure() || app()->environment('production')) {
            $headers['Strict-Transport-Security'] = 'max-age=31536000; includeSubDomains';
        }

        foreach ($headers as $name => $value) {
            if (!$response->headers->has($name)) {
                $response->headers->set($name, $value);
            }
        }

        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
