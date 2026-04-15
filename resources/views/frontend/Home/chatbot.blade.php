<script>
    // ═══════════════════════════════════════════════════════════════
    //  DYNAMIC CHATBOT — FAQs from backend + Support Ticket flow
    // ═══════════════════════════════════════════════════════════════

    const CHATBOT_FAQS_URL   = '{{ route("chatbot.faqs") }}';
    const CHATBOT_TICKET_URL = '{{ route("chatbot.support") }}';
    const CHATBOT_CSRF       = '{{ csrf_token() }}';

    let chatbotFaqData = [];

    // ── Build HTML ────────────────────────────────────────────────
    function createChatbot() {
        const chatbotHTML = `
        <div class="chatbot-container" id="chatbotContainer">

            <div class="chatbot-header">
                <div class="chatbot-header-content">
                    <h3>Support Assistant</h3>
                    <p>How can we help?</p>
                </div>
                <button class="chatbot-close" onclick="closeChatbot()" aria-label="Close">&#x2715;</button>
            </div>

            <div class="chatbot-messages" id="chatbotMessages">
                <div class="message bot-message">
                    <div class="message-content">
                        <p>&#x1F44B; Hi there! How can I help you today?</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Buttons -->
            <div class="chatbot-faq" id="chatbotFAQ">
                <p class="faq-label">Popular Questions:</p>
                <div class="faq-buttons" id="faqButtons">
                    <div class="faq-loading">Loading questions&hellip;</div>
                </div>
            </div>

            <!-- Support Ticket Form (hidden by default) -->
            <div class="chatbot-support-form" id="chatbotSupportForm" style="display:none;">
                <p class="faq-label">Contact Support &mdash; fill in your details:</p>
                <div class="support-fields">
                    <input type="text"  id="supportName"    class="chatbot-support-input" placeholder="Your Name *">
                    <input type="email" id="supportEmail"   class="chatbot-support-input" placeholder="Email Address *">
                    <div style="display:flex;align-items:center;border:1px solid #ddd;border-radius:8px;overflow:hidden;background:#fff;margin-bottom:8px;">
                        <span style="padding:0 10px;background:#f5f5f5;border-right:1px solid #ddd;font-size:13px;font-weight:600;white-space:nowrap;display:flex;align-items:center;gap:4px;user-select:none;">+91</span>
                        <input type="tel" id="supportMobile" style="border:none!important;flex:1;padding:8px 10px;outline:none;font-size:13px;" placeholder="10-digit number" maxlength="10" inputmode="numeric">
                    </div>
                    <textarea          id="supportMessage"  class="chatbot-support-input chatbot-support-textarea" placeholder="Describe your problem *" rows="3"></textarea>
                    <div class="support-form-actions">
                        <button class="support-submit-btn" onclick="submitSupportTicket()">
                            <i class="fas fa-paper-plane"></i> Submit
                        </button>
                        <button class="support-cancel-btn" onclick="cancelSupportForm()">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="chatbot-input-area" id="chatbotInputArea">
                <input
                    type="text"
                    class="chatbot-input"
                    id="chatbotInput"
                    placeholder="Type your question&hellip;"
                    onkeypress="handleKeyPress(event)">
                <button class="chatbot-send" onclick="sendMessage()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>

        <div class="chatbot-backdrop" id="chatbotBackdrop" onclick="closeChatbot()"></div>
        `;

        document.body.insertAdjacentHTML('beforeend', chatbotHTML);
        addChatbotStyles();
        loadFAQs();
    }

    // ── Fetch FAQs from backend ───────────────────────────────────
    function loadFAQs() {
        fetch(CHATBOT_FAQS_URL)
            .then(function(r) { return r.json(); })
            .then(function(data) {
                chatbotFaqData = data;
                renderFAQButtons();
            })
            .catch(function() {
                var btn = document.getElementById('faqButtons');
                if (btn) btn.innerHTML = '<p style="font-size:12px;color:#999;padding:4px 0;">Could not load questions.</p>';
            });
    }

    function renderFAQButtons() {
        var container = document.getElementById('faqButtons');
        if (!container) return;

        if (chatbotFaqData.length === 0) {
            container.innerHTML =
                '<p style="font-size:12px;color:#999;padding:4px 0;">No FAQs available.</p>' +
                '<button class="faq-btn faq-btn-support" onclick="openSupportForm()">' +
                '<i class="fas fa-headset" style="margin-right:6px;"></i>Contact Support Team</button>';
            return;
        }

        var faqHtml = chatbotFaqData.map(function(item) {
            return '<button class="faq-btn" onclick="sendQuestion(' + item.id + ')">' + item.question + '</button>';
        }).join('');

        faqHtml += '<button class="faq-btn faq-btn-support" onclick="openSupportForm()">' +
                   '<i class="fas fa-headset" style="margin-right:6px;"></i>Contact Support Team</button>';

        container.innerHTML = faqHtml;
    }

    // ── Send pre-defined FAQ answer ───────────────────────────────
    function sendQuestion(questionId) {
        var item = chatbotFaqData.find(function(q) { return q.id === questionId; });
        if (!item) return;

        hideFAQ();
        addUserMessage(item.question);
        showThinking();

        setTimeout(function() {
            removeThinking();
            addBotMessage(item.answer);
            showFAQ();
        }, 1200);
    }

    // ── Send typed message ────────────────────────────────────────
    function sendMessage() {
        var input   = document.getElementById('chatbotInput');
        var message = input.value.trim();
        if (!message) return;

        var msgLower = message.toLowerCase();
        var matched = null;
        for (var i = 0; i < chatbotFaqData.length; i++) {
            var qLower = chatbotFaqData[i].question.toLowerCase();
            if (qLower.includes(msgLower) || msgLower.includes(qLower.split(' ').slice(0, 3).join(' '))) {
                matched = chatbotFaqData[i];
                break;
            }
        }

        addUserMessage(message);
        input.value = '';
        hideFAQ();
        showThinking();

        setTimeout(function() {
            removeThinking();
            if (matched) {
                addBotMessage(matched.answer);
            } else {
                addBotMessage(
                    "Thanks for your question! I couldn\u2019t find an exact match. " +
                    "Select from our popular questions below, or click <strong>Contact Support Team</strong> to send us your query directly."
                );
            }
            showFAQ();
        }, 1200);
    }

    // ── Support Ticket Form ───────────────────────────────────────
    function openSupportForm() {
        hideFAQ();
        hideChatInput();
        addUserMessage('I want to contact the support team.');
        addBotMessage('Sure! Please fill in your details below and describe your problem. Our team will get back to you soon.');

        setTimeout(function() {
            var form = document.getElementById('chatbotSupportForm');
            if (form) form.style.display = 'block';
        }, 300);
    }

    function cancelSupportForm() {
        var form = document.getElementById('chatbotSupportForm');
        if (form) form.style.display = 'none';
        showChatInput();
        showFAQ();
    }

    // Restrict mobile input to digits only
    (function() {
        var el = document.getElementById('supportMobile');
        if (el) el.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
    })();

    function submitSupportTicket() {
        var name    = document.getElementById('supportName').value.trim();
        var email   = document.getElementById('supportEmail').value.trim();
        var rawMob  = document.getElementById('supportMobile').value.replace(/\D/g, '');
        var message = document.getElementById('supportMessage').value.trim();

        // Clear previous error
        var prevErr = document.getElementById('supportFormError');
        if (prevErr) prevErr.remove();

        if (!name || !email || !rawMob || !message) {
            showFormError('Please fill in all required fields.');
            return;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showFormError('Please enter a valid email address.');
            return;
        }
        if (rawMob.length !== 10) {
            showFormError('Please enter a valid 10-digit mobile number.');
            return;
        }

        var mobile = '+91' + rawMob;

        var submitBtn = document.querySelector('.support-submit-btn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting\u2026';

        fetch(CHATBOT_TICKET_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CHATBOT_CSRF,
            },
            body: JSON.stringify({ name: name, email: email, mobile: mobile, message: message }),
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var form = document.getElementById('chatbotSupportForm');
            if (form) form.style.display = 'none';
            showChatInput();

            if (data.success) {
                addBotMessage(
                    '\u2705 <strong>Ticket submitted successfully!</strong><br><br>' +
                    data.message +
                    '<br><br><small style="opacity:.8;">Submitted by: ' + escapeHtml(name) +
                    ' | ' + escapeHtml(mobile) + '</small>'
                );
            } else {
                addBotMessage('\u274C Something went wrong. Please try again.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit';
            }
            showFAQ();
        })
        .catch(function() {
            var form = document.getElementById('chatbotSupportForm');
            if (form) form.style.display = 'none';
            showChatInput();
            addBotMessage('\u274C Network error. Please check your connection and try again.');
            showFAQ();
        });
    }

    function showFormError(msg) {
        var err = document.createElement('p');
        err.id = 'supportFormError';
        err.style.cssText = 'color:#e00;font-size:12px;margin:4px 0 0;';
        err.textContent = msg;
        document.querySelector('.support-form-actions').before(err);
    }

    // ── Message helpers ───────────────────────────────────────────
    function addUserMessage(text) {
        var container = document.getElementById('chatbotMessages');
        var div = document.createElement('div');
        div.className = 'message user-message';
        div.innerHTML = '<div class="message-content">' + escapeHtml(text) + '</div>';
        container.appendChild(div);
        scrollToBottom();
    }

    function addBotMessage(html) {
        var container = document.getElementById('chatbotMessages');
        var div = document.createElement('div');
        div.className = 'message bot-message';
        div.innerHTML = '<div class="message-content">' + html + '</div>';
        container.appendChild(div);
        scrollToBottom();
    }

    function escapeHtml(text) {
        var d = document.createElement('div');
        d.appendChild(document.createTextNode(text));
        return d.innerHTML;
    }

    function showThinking() {
        var container = document.getElementById('chatbotMessages');
        var div = document.createElement('div');
        div.className = 'message bot-message';
        div.id = 'thinkingMessage';
        div.innerHTML = '<div class="thinking">' +
            '<div class="thinking-dot"></div>' +
            '<div class="thinking-dot"></div>' +
            '<div class="thinking-dot"></div>' +
            '</div>';
        container.appendChild(div);
        scrollToBottom();
    }

    function removeThinking() {
        var el = document.getElementById('thinkingMessage');
        if (el) el.remove();
    }

    function showFAQ()     { var el = document.getElementById('chatbotFAQ');         if (el) el.style.display = 'block'; }
    function hideFAQ()     { var el = document.getElementById('chatbotFAQ');         if (el) el.style.display = 'none';  }
    function showChatInput(){ var el = document.getElementById('chatbotInputArea');  if (el) el.style.display = 'flex';  }
    function hideChatInput(){ var el = document.getElementById('chatbotInputArea');  if (el) el.style.display = 'none';  }

    function scrollToBottom() {
        var container = document.getElementById('chatbotMessages');
        setTimeout(function() { container.scrollTop = container.scrollHeight; }, 50);
    }

    function handleKeyPress(event) {
        if (event.key === 'Enter') sendMessage();
    }

    // ── Close ─────────────────────────────────────────────────────
    function closeChatbot() {
        var container = document.getElementById('chatbotContainer');
        var backdrop  = document.getElementById('chatbotBackdrop');
        if (!container) return;
        container.style.animation = 'chatbotSlideOut 0.3s ease forwards';
        backdrop.style.animation  = 'backdropFade 0.3s ease reverse forwards';
        setTimeout(function() { container.remove(); backdrop.remove(); }, 300);
    }

    function initChatbot() {
        if (document.getElementById('chatbotContainer')) return;
        createChatbot();
    }

    // ── Slide-out keyframe ────────────────────────────────────────
    (function() {
        var s = document.createElement('style');
        s.textContent = '@keyframes chatbotSlideOut { to { opacity:0; transform:scale(0.8) translateY(20px); } }';
        document.head.appendChild(s);
    })();

    // ── Hook support button ───────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function() {
        var supportBtn = document.querySelector('.support .pill-btn');
        if (supportBtn) supportBtn.onclick = initChatbot;
    });

    // ══════════════════════════════════════════════════════════════
    //  CSS
    // ══════════════════════════════════════════════════════════════
    function addChatbotStyles() {
        var styles = `
        .chatbot-container {
            position:fixed; bottom:80px; right:25px; width:380px; max-height:640px;
            background:#fff; border-radius:16px; box-shadow:0 8px 32px rgba(0,0,0,.18);
            display:flex; flex-direction:column; z-index:999;
            opacity:0; transform:scale(0.8) translateY(20px);
            animation:chatbotSlideIn .35s ease forwards;
        }
        @keyframes chatbotSlideIn { to { opacity:1; transform:scale(1) translateY(0); } }

        .chatbot-header {
            background:linear-gradient(135deg,#ff6a00,#ff8533); color:#fff;
            padding:18px 20px; border-radius:16px 16px 0 0;
            display:flex; justify-content:space-between; align-items:center; flex-shrink:0;
        }
        .chatbot-header-content h3 { font-size:16px; font-weight:700; margin:0 0 4px; }
        .chatbot-header-content p  { font-size:12px; margin:0; opacity:.9; }
        .chatbot-close {
            background:none; border:none; color:#fff; font-size:20px; cursor:pointer;
            padding:0; width:32px; height:32px; display:flex; align-items:center;
            justify-content:center; border-radius:50%; transition:background .2s;
        }
        .chatbot-close:hover { background:rgba(255,255,255,.2); }

        .chatbot-messages {
            flex:1; overflow-y:auto; padding:16px;
            display:flex; flex-direction:column; gap:12px;
            background:#f8f9fb; min-height:0;
        }
        .message { display:flex; animation:msgIn .3s ease; }
        @keyframes msgIn { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .bot-message  { justify-content:flex-start; }
        .user-message { justify-content:flex-end; }
        .message-content {
            max-width:78%; padding:10px 14px; border-radius:12px;
            word-wrap:break-word; line-height:1.5; font-size:13px;
        }
        .bot-message  .message-content { background:#fff; color:#0f2747; border:1px solid #e0e4ea; }
        .user-message .message-content { background:#ff6a00; color:#fff; }

        .thinking { display:flex; gap:4px; padding:12px 14px; }
        .thinking-dot {
            width:8px; height:8px; border-radius:50%; background:#0f2747;
            animation:thinkAnim 1.4s infinite;
        }
        .thinking-dot:nth-child(2) { animation-delay:.2s; }
        .thinking-dot:nth-child(3) { animation-delay:.4s; }
        @keyframes thinkAnim {
            0%,60%,100%{transform:translateY(0);opacity:.6}
            30%{transform:translateY(-10px);opacity:1}
        }

        .chatbot-faq {
            padding:12px 16px; border-top:1px solid #e0e4ea;
            max-height:175px; overflow-y:auto; flex-shrink:0;
        }
        .faq-label {
            font-size:11px; font-weight:700; color:#0f2747;
            margin:0 0 8px; text-transform:uppercase; letter-spacing:.5px;
        }
        .faq-buttons { display:flex; flex-direction:column; gap:6px; }
        .faq-loading { font-size:12px; color:#aaa; padding:4px 0; }
        .faq-btn {
            background:#f0f2f5; border:1px solid #e0e4ea; color:#0f2747;
            padding:9px 12px; border-radius:8px; font-size:12px; cursor:pointer;
            transition:all .2s; text-align:left; font-weight:500; line-height:1.3;
        }
        .faq-btn:hover { background:#ff6a00; color:#fff; border-color:#ff6a00; transform:translateX(4px); }
        .faq-btn-support { background:#0f2747; border-color:#0f2747; color:#fff !important; margin-top:4px; }
        .faq-btn-support:hover { background:#1a3a6b !important; border-color:#1a3a6b !important; }

        .chatbot-support-form {
            padding:12px 16px; border-top:1px solid #e0e4ea;
            flex-shrink:0; background:#fff;
            max-height:250px; overflow-y:auto;
        }
        .support-fields { display:flex; flex-direction:column; gap:8px; }
        .chatbot-support-input {
            width:100%; border:1px solid #e0e4ea; border-radius:8px;
            padding:9px 12px; font-size:12px; font-family:Arial,sans-serif;
            outline:none; transition:border-color .2s; box-sizing:border-box; resize:none;
        }
        .chatbot-support-input:focus { border-color:#ff6a00; box-shadow:0 0 0 3px rgba(255,106,0,.1); }
        .chatbot-support-textarea { min-height:60px; }
        .support-form-actions { display:flex; gap:8px; }
        .support-submit-btn {
            flex:1; background:#ff6a00; color:#fff; border:none; border-radius:8px;
            padding:9px; font-size:12px; font-weight:600; cursor:pointer;
            transition:background .2s; display:flex; align-items:center; justify-content:center; gap:6px;
        }
        .support-submit-btn:hover:not(:disabled) { background:#e65c00; }
        .support-submit-btn:disabled { opacity:.7; cursor:not-allowed; }
        .support-cancel-btn {
            background:#f0f2f5; color:#0f2747; border:1px solid #e0e4ea;
            border-radius:8px; padding:9px 14px; font-size:12px; cursor:pointer;
            transition:background .2s;
        }
        .support-cancel-btn:hover { background:#e0e4ea; }

        .chatbot-input-area {
            display:flex; gap:8px; padding:12px 16px; background:#fff;
            border-top:1px solid #e0e4ea; border-radius:0 0 16px 16px; flex-shrink:0;
        }
        .chatbot-input {
            flex:1; border:1px solid #e0e4ea; border-radius:8px;
            padding:10px 12px; font-size:13px; font-family:Arial,sans-serif;
            outline:none; transition:border-color .2s;
        }
        .chatbot-input:focus { border-color:#ff6a00; box-shadow:0 0 0 3px rgba(255,106,0,.1); }
        .chatbot-send {
            background:#ff6a00; color:#fff; border:none; border-radius:8px;
            width:36px; height:36px; display:flex; align-items:center; justify-content:center;
            cursor:pointer; transition:background .2s,transform .2s; font-size:14px;
        }
        .chatbot-send:hover { background:#e65c00; transform:scale(1.05); }

        .chatbot-backdrop {
            position:fixed; inset:0; background:rgba(0,0,0,.3); z-index:998;
            opacity:0; animation:backdropFade .35s ease forwards;
        }
        @keyframes backdropFade { to { opacity:1; } }

        .chatbot-messages::-webkit-scrollbar,
        .chatbot-faq::-webkit-scrollbar,
        .chatbot-support-form::-webkit-scrollbar { width:5px; }
        .chatbot-messages::-webkit-scrollbar-track,
        .chatbot-faq::-webkit-scrollbar-track,
        .chatbot-support-form::-webkit-scrollbar-track { background:transparent; }
        .chatbot-messages::-webkit-scrollbar-thumb,
        .chatbot-faq::-webkit-scrollbar-thumb,
        .chatbot-support-form::-webkit-scrollbar-thumb { background:#d0d5dd; border-radius:3px; }

        @media (max-width:600px) {
            .chatbot-container { width:calc(100% - 24px); max-height:520px; bottom:90px; right:12px; left:12px; }
            .message-content { max-width:85%; font-size:12px; }
            .faq-btn { font-size:11px; padding:8px 10px; }
        }
        @media (max-width:380px) {
            .chatbot-container { max-height:460px; bottom:85px; }
        }
        `;

        var tag = document.createElement('style');
        tag.textContent = styles;
        document.head.appendChild(tag);
    }
</script>
