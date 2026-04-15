/**
 * newsletter.js
 * Shared newsletter subscription handler.
 * Attaches click listeners to all .newsletter-subscribe-btn buttons.
 * Reads the email from the nearest .newsletter-email-input inside a
 * [data-newsletter] wrapper, then POSTs via AJAX and shows a toastr popup.
 *
 * Usage in blade:
 *   <div data-newsletter data-source="blog">
 *       <input type="email" class="newsletter-email-input" placeholder="..." />
 *       <button type="button" class="newsletter-subscribe-btn">Subscribe</button>
 *   </div>
 */

(function () {
    'use strict';

    // CSRF token — Laravel sets this in a meta tag
    function getCsrfToken() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    function toastrMsg(type, message) {
        if (typeof toastr !== 'undefined') {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 4000,
            };
            toastr[type](message);
        }
    }

    function handleSubscribe(btn) {
        var wrapper = btn.closest('[data-newsletter]');
        if (!wrapper) return;

        var input  = wrapper.querySelector('.newsletter-email-input');
        var source = wrapper.getAttribute('data-source') || 'general';

        if (!input) return;

        var email = input.value.trim();
        if (!email) {
            toastrMsg('warning', 'Please enter your email address.');
            input.focus();
            return;
        }

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            toastrMsg('warning', 'Please enter a valid email address.');
            input.focus();
            return;
        }

        // UI feedback
        var originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span style="opacity:.6">Subscribing…</span>';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/newsletter/subscribe', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', getCsrfToken());
        xhr.setRequestHeader('Accept', 'application/json');

        xhr.onload = function () {
            var data = {};
            try { data = JSON.parse(xhr.responseText); } catch (e) {}

            if (xhr.status === 200) {
                toastrMsg('success', data.message || 'Thank you for subscribing!');
                input.value = '';
                btn.innerHTML = '✓ Subscribed!';
                setTimeout(function () {
                    btn.innerHTML = originalText;
                    btn.disabled  = false;
                }, 3000);
            } else if (xhr.status === 409) {
                toastrMsg('info', data.message || 'You are already subscribed!');
                btn.innerHTML = originalText;
                btn.disabled  = false;
            } else if (xhr.status === 422) {
                var errors = data.errors || {};
                var msg    = errors.email ? errors.email[0] : (data.message || 'Invalid email.');
                toastrMsg('error', msg);
                btn.innerHTML = originalText;
                btn.disabled  = false;
            } else {
                toastrMsg('error', 'Something went wrong. Please try again.');
                btn.innerHTML = originalText;
                btn.disabled  = false;
            }
        };

        xhr.onerror = function () {
            toastrMsg('error', 'Network error. Please try again.');
            btn.innerHTML = originalText;
            btn.disabled  = false;
        };

        xhr.send(JSON.stringify({ email: email, source: source }));
    }

    // Delegate click on document so dynamically added buttons also work
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.newsletter-subscribe-btn');
        if (btn) {
            e.preventDefault();
            handleSubscribe(btn);
        }
    });

    // Also support forms with class newsletter-ajax-form
    document.addEventListener('submit', function (e) {
        if (e.target.classList.contains('newsletter-ajax-form')) {
            e.preventDefault();
            var btn = e.target.querySelector('.newsletter-subscribe-btn');
            if (btn) handleSubscribe(btn);
        }
    });
})();
