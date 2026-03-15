@extends('frontend.course.layout')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--default-font);
            color: var(--default-color);
            background-color: var(--background-color);
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--heading-font);
            color: var(--heading-color);
            line-height: 1.3;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Topbar */


        /* Header */
        .header {
            background: var(--surface-color);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--accent-color) 0%, #1e40af 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text h1 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--heading-color);
        }

        .logo-text span {
            font-size: 0.75rem;
            color: var(--muted-color);
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            font-family: var(--nav-font);
            font-weight: 500;
            color: var(--nav-color);
            transition: color 0.3s;
            position: relative;
        }

        .nav-link:hover {
            color: var(--nav-hover-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-family: var(--nav-font);
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-color) 0%, #1e40af 100%);
            color: var(--contrast-color);
            box-shadow: 0 4px 14px rgba(23, 92, 221, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(23, 92, 221, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
        }

        .btn-outline:hover {
            background: var(--accent-color);
            color: var(--contrast-color);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }

        /* Blog Hero */
        .blog-hero {
            background: linear-gradient(135deg, var(--heading-color) 0%, #1a3a5c 50%, #0f172a 100%);
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .blog-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .blog-hero-content {
            position: relative;
            z-index: 1;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 1.5rem;
        }

        .breadcrumb a {
            color: rgba(255, 255, 255, 0.7);
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: var(--contrast-color);
        }

        .breadcrumb-current {
            color: var(--contrast-color);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .hero-content {
            color: var(--contrast-color);
        }

        .post-category {
            display: inline-block;
            background: linear-gradient(135deg, var(--accent-color) 0%, #1e40af 100%);
            color: var(--contrast-color);
            padding: 0.375rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--contrast-color);
        }

        .post-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .author-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem;
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .author-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 3px solid var(--accent-color);
            object-fit: cover;
        }

        .author-info h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--contrast-color);
        }

        .author-info span {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .hero-image {
            position: relative;
        }

        .hero-image img {
            width: 100%;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .hero-image::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1.5rem;
            background: linear-gradient(135deg, var(--accent-color), transparent);
            opacity: 0.2;
            z-index: 1;
            pointer-events: none;
        }

        /* Blog Content */
        .blog-section {
            padding: 4rem 0;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 3rem;
        }

        .blog-main {
            background: var(--surface-color);
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .share-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .share-buttons {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .share-btn.facebook {
            background: #1877f2;
            color: white;
        }

        .share-btn.twitter {
            background: #1da1f2;
            color: white;
        }

        .share-btn.linkedin {
            background: #0077b5;
            color: white;
        }

        .share-btn.whatsapp {
            background: #25d366;
            color: white;
        }

        .share-btn.copy {
            background: #f3f4f6;
            color: var(--default-color);
        }

        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .like-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            border: 1px solid var(--border-color);
            background: var(--surface-color);
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.875rem;
        }

        .like-btn:hover {
            border-color: #ef4444;
            color: #ef4444;
        }

        /* Prose Styles */
        .prose {
            color: var(--default-color);
            line-height: 1.8;
            font-size: 1.0625rem;
        }

        .prose p {
            margin-bottom: 1.5rem;
        }

        .prose h2 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
        }

        .prose h3 {
            font-size: 1.375rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
        }

        .prose ul,
        .prose ol {
            padding-left: 1.5rem;
            margin: 1.25rem 0;
        }

        .prose li {
            margin: 0.5rem 0;
        }

        .prose ul {
            list-style-type: disc;
        }

        .prose ol {
            list-style-type: decimal;
        }

        .prose blockquote {
            border-left: 4px solid var(--accent-color);
            background: rgba(23, 92, 221, 0.05);
            padding: 1.25rem 1.5rem;
            margin: 2rem 0;
            border-radius: 0 0.75rem 0.75rem 0;
            font-style: normal;
        }

        .prose blockquote cite {
            display: block;
            margin-top: 0.75rem;
            font-size: 0.875rem;
            color: var(--muted-color);
        }

        .prose figure {
            margin: 2rem 0;
        }

        .prose figure img {
            border-radius: 0.75rem;
            width: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .prose figcaption {
            text-align: center;
            font-size: 0.875rem;
            color: var(--muted-color);
            margin-top: 0.75rem;
        }

        .prose strong {
            color: var(--heading-color);
            font-weight: 600;
        }

        .prose a {
            color: var(--accent-color);
        }

        .prose a:hover {
            text-decoration: underline;
        }

        .tip-box {
            background: linear-gradient(135deg, rgba(23, 92, 221, 0.08), rgba(23, 92, 221, 0.02));
            border: 1px solid rgba(23, 92, 221, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .tip-box h4 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            margin-bottom: 0.75rem;
            color: var(--accent-color);
        }

        /* Tags */
        .tags-section {
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .tags-section h4 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .tag {
            padding: 0.375rem 0.875rem;
            background: #f3f4f6;
            border-radius: 9999px;
            font-size: 0.8125rem;
            color: var(--default-color);
            transition: all 0.3s;
        }

        .tag:hover {
            background: var(--accent-color);
            color: var(--contrast-color);
        }

        /* Author Bio */
        .author-bio {
            margin-top: 2.5rem;
            padding: 2rem;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 1.5rem;
            display: flex;
            gap: 1.5rem;
        }

        .author-bio-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 4px solid var(--accent-color);
            object-fit: cover;
            flex-shrink: 0;
        }

        .author-bio-content h4 {
            font-size: 1.125rem;
            margin-bottom: 0.25rem;
        }

        .author-bio-content .role {
            font-size: 0.875rem;
            color: var(--accent-color);
            margin-bottom: 0.75rem;
        }

        .author-bio-content p {
            font-size: 0.9375rem;
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .author-social {
            display: flex;
            gap: 0.75rem;
        }

        .author-social a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--accent-color);
            color: var(--contrast-color);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .author-social a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(23, 92, 221, 0.3);
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .sidebar-card {
            background: var(--surface-color);
            border-radius: 1.5rem;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }

        .sidebar-card h3 {
            font-size: 1.125rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-card h3::after {
            content: '';
            flex: 1;
            height: 2px;
            background: linear-gradient(to right, var(--accent-color), transparent);
        }

        .category-list {
            list-style: none;
        }

        .category-list li {
            border-bottom: 1px dashed var(--border-color);
        }

        .category-list li:last-child {
            border-bottom: none;
        }

        .category-list a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            transition: all 0.3s;
        }

        .category-list a:hover {
            color: var(--accent-color);
            padding-left: 0.5rem;
        }

        .category-count {
            background: #f3f4f6;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .recent-posts {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .recent-post {
            display: flex;
            gap: 1rem;
        }

        .recent-post-image {
            width: 80px;
            height: 60px;
            border-radius: 0.5rem;
            object-fit: cover;
            flex-shrink: 0;
        }

        .recent-post-content h4 {
            font-size: 0.875rem;
            line-height: 1.4;
            margin-bottom: 0.25rem;
            transition: color 0.3s;
        }

        .recent-post:hover h4 {
            color: var(--accent-color);
        }

        .recent-post-content span {
            font-size: 0.75rem;
            color: var(--muted-color);
        }

        .popular-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .newsletter-form p {
            font-size: 0.875rem;
            color: var(--muted-color);
            margin-bottom: 0.5rem;
        }

        .newsletter-form input {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.3s;
        }

        .newsletter-form input:focus {
            border-color: var(--accent-color);
        }

        .newsletter-form button {
            width: 100%;
        }

        /* Related Posts */
        .related-section {
            padding: 4rem 0;
            background: #f8fafc;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-header h2 {
            font-size: 1.75rem;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .related-card {
            background: var(--surface-color);
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            transition: all 0.3s;
        }

        .related-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .related-card-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .related-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .related-card:hover .related-card-image img {
            transform: scale(1.05);
        }

        .related-card-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: linear-gradient(135deg, var(--accent-color) 0%, #1e40af 100%);
            color: var(--contrast-color);
            padding: 0.375rem 0.875rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .related-card-content {
            padding: 1.5rem;
        }

        .related-card-content h3 {
            font-size: 1.125rem;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .related-card-content p {
            font-size: 0.9375rem;
            color: var(--muted-color);
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .related-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8125rem;
            color: var(--muted-color);
        }

        .read-more {
            color: var(--accent-color);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* Newsletter CTA */
        .newsletter-cta {
            background: linear-gradient(135deg, var(--heading-color) 0%, #1a3a5c 50%, var(--accent-color) 100%);
            padding: 5rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .newsletter-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .newsletter-cta-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
        }

        .newsletter-cta h2 {
            font-size: 2.25rem;
            color: var(--contrast-color);
            margin-bottom: 1rem;
        }

        .newsletter-cta p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
            font-size: 1.125rem;
        }

        .newsletter-cta-form {
            display: flex;
            gap: 0.75rem;
            max-width: 450px;
            margin: 0 auto;
        }

        .newsletter-cta-form input {
            flex: 1;
            padding: 1rem 1.25rem;
            border: none;
            border-radius: 9999px;
            font-size: 1rem;
            outline: none;
        }

        .newsletter-cta-form button {
            white-space: nowrap;
        }



        /* Responsive */
        @media (max-width: 1024px) {
            .blog-grid {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .topbar-left {
                display: none;
            }

            .nav {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .hero-title {
                font-size: 1.75rem;
            }

            .sidebar {
                grid-template-columns: 1fr;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }

            .newsletter-cta-form {
                flex-direction: column;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .author-bio {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <main class="main">

        {{-- ===== BLOG HERO ===== --}}
        <section class="blog-hero">
            <div class="container">
                <div class="blog-hero-content">

                    {{-- Breadcrumb --}}
                    <nav class="breadcrumb">
                        <a href="{{ url('/') }}">Home</a>
                        <span>/</span>
                        <a href="#">Blog</a>
                        <span>/</span>
                        <span class="breadcrumb-current">{{ Str::limit($blog->title, 60) }}</span>
                    </nav>

                    <div class="hero-grid">
                        <div class="hero-content">

                            {{-- Category --}}
                            @if ($blog->category)
                                <span class="post-category">{{ $blog->category->category_name }}</span>
                            @endif

                            {{-- Title --}}
                            <h1 class="hero-title">{{ $blog->title }}</h1>

                            {{-- Meta --}}
                            <div class="post-meta">
                                <div class="meta-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    <span>{{ $blog->created_at->format('F j, Y') }}</span>
                                </div>
                                <div class="meta-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span>{{ max(1, (int) (str_word_count(strip_tags($blog->description ?? '')) / 200)) }}
                                        min read</span>
                                </div>
                                <div class="meta-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    <span id="viewCount">—</span>
                                </div>
                            </div>

                            {{-- Author card --}}
                            @if ($blog->author)
                                <div class="author-card">
                                    @if ($blog->author->image)
                                        <img src="{{ asset('img/authors/' . $blog->author->image) }}"
                                            alt="{{ $blog->author->name }}" class="author-avatar">
                                    @else
                                        <div class="author-avatar"
                                            style="background:var(--accent-color);display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;font-size:1.1rem;">
                                            {{ strtoupper(substr($blog->author->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="author-info">
                                        <h4>{{ $blog->author->name }}</h4>
                                        <span>{{ $blog->author->designation ?? 'Author' }}</span>
                                    </div>
                                </div>
                            @endif

                        </div>

                        {{-- Hero image --}}
                        <div class="hero-image">
                            @if ($blog->image)
                                <img src="{{ asset('img/' . $blog->image) }}" alt="{{ $blog->title }}">
                            @else
                                <div
                                    style="width:100%;height:100%;min-height:300px;background:linear-gradient(135deg,rgba(23,92,221,.15),rgba(23,92,221,.05));border-radius:16px;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-journal-richtext" style="font-size:5rem;color:rgba(23,92,221,.2);"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== BLOG CONTENT ===== --}}
        <section class="blog-section">
            <div class="container">
                <div class="blog-grid">

                    {{-- ── MAIN CONTENT ── --}}
                    <main class="blog-main">

                        {{-- Share bar --}}
                        <div class="share-bar">
                            <div class="share-buttons">
                                <span style="font-size:0.875rem;color:var(--muted-color);margin-right:0.5rem;">Share:</span>

                                {{-- Facebook --}}
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank" class="share-btn facebook" aria-label="Share on Facebook">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                    </svg>
                                </a>

                                {{-- Twitter --}}
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                                    target="_blank" class="share-btn twitter" aria-label="Share on Twitter">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                                    </svg>
                                </a>

                                {{-- LinkedIn --}}
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                    target="_blank" class="share-btn linkedin" aria-label="Share on LinkedIn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                        <rect x="2" y="9" width="4" height="12" />
                                        <circle cx="4" cy="4" r="2" />
                                    </svg>
                                </a>

                                {{-- WhatsApp --}}
                                <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}"
                                    target="_blank" class="share-btn whatsapp" aria-label="Share on WhatsApp">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                    </svg>
                                </a>

                                {{-- Copy link --}}
                                <button class="share-btn copy" aria-label="Copy link" onclick="copyLink(this)"
                                    data-url="{{ request()->url() }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                    </svg>
                                </button>
                            </div>

                            {{-- Like button --}}

                        </div>

                        {{-- Article body --}}
                        <article class="prose">
                            {!! $blog->description !!}
                        </article>

                        {{-- Tags --}}
                        @if ($blog->tags ?? false)
                            <div class="tags-section">
                                <h4>Tags</h4>
                                <div class="tags-list">
                                    @foreach (explode(',', $blog->tags) as $tag)
                                        <a href="#" class="tag">
                                            {{ trim($tag) }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @elseif($blog->category)
                            {{-- fallback: show category as a tag --}}
                            <div class="tags-section">
                                <h4>Tags</h4>
                                <div class="tags-list">
                                    <a href="{{ route('frontend.blog.category', $blog->category->slug) }}"
                                        class="tag">
                                        {{ $blog->category->category_name }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Author bio --}}
                        @if ($blog->author)
                            <div class="author-bio">
                                @if ($blog->author->image)
                                    <img src="{{ asset('img/authors/' . $blog->author->image) }}"
                                        alt="{{ $blog->author->name }}" class="author-bio-avatar">
                                @else
                                    <div class="author-bio-avatar"
                                        style="background:var(--accent-color);display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;font-size:1.5rem;">
                                        {{ strtoupper(substr($blog->author->name, 0, 2)) }}
                                    </div>
                                @endif
                                <div class="author-bio-content">
                                    <h4>{{ $blog->author->name }}</h4>
                                    <div class="role">{{ $blog->author->designation ?? 'Author' }}</div>
                                    @if ($blog->author->bio)
                                        <p>{{ $blog->author->bio }}</p>
                                    @endif
                                    <div class="author-social">
                                        @if ($blog->author->linkedin)
                                            <a href="{{ $blog->author->linkedin }}" target="_blank"
                                                aria-label="LinkedIn">
                                                <svg width="16" height="16" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                                    <rect x="2" y="9" width="4" height="12" />
                                                    <circle cx="4" cy="4" r="2" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if ($blog->author->twitter)
                                            <a href="{{ $blog->author->twitter }}" target="_blank" aria-label="Twitter">
                                                <svg width="16" height="16" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if ($blog->author->instagram)
                                            <a href="{{ $blog->author->instagram }}" target="_blank"
                                                aria-label="Instagram">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <rect x="2" y="2" width="20" height="20" rx="5"
                                                        ry="5" />
                                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                                </svg>
                                            </a>
                                        @endif
                                        @if ($blog->author->facebook)
                                            <a href="{{ $blog->author->facebook }}" target="_blank"
                                                aria-label="Facebook">
                                                <svg width="16" height="16" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </main>{{-- /blog-main --}}

                    {{-- ── SIDEBAR ── --}}
                    <aside class="sidebar">

                        {{-- Categories --}}
                        <div class="sidebar-card">
                            <h3>Categories</h3>
                            <ul class="category-list">
                                @foreach ($categories as $cat)
                                    <li>
                                        <a href="{{ route('frontend.blog.category', $cat->slug) }}"
                                            class="{{ $blog->category && $blog->category->slug === $cat->slug ? 'active' : '' }}">
                                            {{ $cat->category_name }}
                                            <span class="category-count">{{ $cat->blogs_count }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Recent Posts --}}
                        <div class="sidebar-card">
                            <h3>Recent Posts</h3>
                            <div class="recent-posts">
                                @foreach ($recentPosts as $rp)
                                    <a href="#" class="recent-post">
                                        @if ($rp->image)
                                            <img src="{{ asset('img/' . $rp->image) }}" alt="{{ $rp->title }}"
                                                class="recent-post-image">
                                        @else
                                            <div class="recent-post-image"
                                                style="background:linear-gradient(135deg,rgba(23,92,221,.15),rgba(23,92,221,.05));display:flex;align-items:center;justify-content:center;">
                                                <i class="bi bi-journal"
                                                    style="color:rgba(23,92,221,.3);font-size:1.2rem;"></i>
                                            </div>
                                        @endif
                                        <div class="recent-post-content">
                                            <h4>{{ Str::limit($rp->title, 55) }}</h4>
                                            <span>{{ $rp->created_at->format('F j, Y') }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Popular Tags --}}
                        <div class="sidebar-card">
                            <h3>Popular Tags</h3>
                            <div class="popular-tags">
                                @foreach ($tags as $tag)
                                    <a href="#" class="tag">{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Newsletter --}}
                        <div class="sidebar-card"
                            style="background:linear-gradient(135deg,rgba(23,92,221,.05),rgba(23,92,221,.02));border-color:rgba(23,92,221,.2);">
                            <h3>Newsletter</h3>
                            <form class="newsletter-form" onsubmit="subscribeNewsletter(event,this)">
                                <p>Get the latest tips, success stories, and exclusive workshop updates delivered to your
                                    inbox.</p>
                                <input type="email" placeholder="Your email address" required>
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </form>
                        </div>

                    </aside>
                </div>
            </div>
        </section>

        {{-- ===== RELATED POSTS ===== --}}
        @if ($related->count())
            <section class="related-section">
                <div class="container">
                    <div class="section-header">
                        <h2>Related Articles</h2>
                        <a href="#" class="btn btn-outline">View All Posts</a>
                    </div>
                    <div class="related-grid">
                        @foreach ($related as $rp)
                            <article class="related-card">
                                <div class="related-card-image">
                                    @if ($rp->image)
                                        <img src="{{ asset('img/' . $rp->image) }}" alt="{{ $rp->title }}">
                                    @else
                                        <div
                                            style="width:100%;height:100%;background:linear-gradient(135deg,rgba(23,92,221,.15),rgba(23,92,221,.05));">
                                        </div>
                                    @endif
                                    @if ($rp->category)
                                        <span class="related-card-category">{{ $rp->category->category_name }}</span>
                                    @endif
                                </div>
                                <div class="related-card-content">
                                    <h3>{{ $rp->title }}</h3>
                                    <p>{{ Str::limit(strip_tags($rp->short_description ?? $rp->description), 100) }}</p>
                                    <div class="related-card-footer">
                                        <span>{{ $rp->created_at->format('F j, Y') }}</span>
                                        <a href="#" class="read-more">
                                            Read More
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <line x1="5" y1="12" x2="19" y2="12" />
                                                <polyline points="12 5 19 12 12 19" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- ===== NEWSLETTER CTA ===== --}}
        <section class="newsletter-cta">
            <div class="container">
                <div class="newsletter-cta-content">
                    <h2>Stay Updated with Our Latest News</h2>
                    <p>Subscribe to our newsletter for exclusive tips, success stories, and updates on workshops and events.
                    </p>
                    <form class="newsletter-cta-form" onsubmit="subscribeNewsletter(event,this)">
                        <input type="email" placeholder="Enter your email address" required>
                        <button type="submit" class="btn btn-primary">Subscribe Now</button>
                    </form>
                </div>
            </div>
        </section>

    </main>
@endsection

@section('script')
    <script>
        // ── Copy link ──────────────────────────────────────────────────────────────
        function copyLink(btn) {
            navigator.clipboard.writeText(btn.dataset.url).then(() => {
                const svg = btn.innerHTML;
                btn.innerHTML =
                    '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>';
                btn.style.background = '#16a34a';
                btn.style.color = '#fff';
                setTimeout(() => {
                    btn.innerHTML = svg;
                    btn.style.background = '';
                    btn.style.color = '';
                }, 2000);
            });
        }

        // ── Like button ────────────────────────────────────────────────────────────
        function toggleLike(btn) {
            const liked = btn.classList.toggle('liked');
            const countEl = document.getElementById('likeCount');
            let count = parseInt(countEl.textContent) || 0;
            countEl.textContent = liked ? count + 1 : Math.max(0, count - 1);

            // Optional: persist to server via AJAX
            // fetch('/blog/{{ $blog->id }}/like', { method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'} });
        }

        // ── Newsletter ─────────────────────────────────────────────────────────────
        function subscribeNewsletter(e, form) {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const input = form.querySelector('input[type="email"]');
            const orig = btn.textContent;

            btn.textContent = 'Subscribing…';
            btn.disabled = true;

            setTimeout(() => {
                btn.textContent = '✓ Subscribed!';
                btn.style.background = '#16a34a';
                input.value = '';
                setTimeout(() => {
                    btn.textContent = orig;
                    btn.style.background = '';
                    btn.disabled = false;
                }, 3000);
            }, 800);
        }

        // ── Reading progress bar ───────────────────────────────────────────────────
        const progressBar = document.createElement('div');
        progressBar.style.cssText =
            'position:fixed;top:0;left:0;height:3px;background:var(--accent-color,#175cdd);z-index:9999;transition:width .1s linear;width:0;';
        document.body.prepend(progressBar);

        window.addEventListener('scroll', () => {
            const doc = document.documentElement;
            const scroll = doc.scrollTop || document.body.scrollTop;
            const height = doc.scrollHeight - doc.clientHeight;
            progressBar.style.width = (height > 0 ? (scroll / height) * 100 : 0) + '%';
        });
    </script>

    {{-- Liked state style --}}
    <style>
        .like-btn.liked {
            background: rgba(239, 68, 68, .1);
            color: #ef4444;
            border-color: rgba(239, 68, 68, .3);
        }

        .like-btn.liked svg {
            fill: #ef4444;
            stroke: none;
        }

        .category-list a.active {
            color: var(--accent-color);
            font-weight: 700;
        }
    </style>
@endsection
