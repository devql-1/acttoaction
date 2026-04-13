<script>
    // Chatbot Data - Pre-filled Q&A
    const chatbotData = [{
            id: 1,
            question: "What courses do you offer?",
            answer: "We offer a wide range of courses including web development, data science, mobile app development, digital marketing, and many more. Each course is designed by industry experts and includes hands-on projects."
        },
        {
            id: 2,
            question: "How much does a course cost?",
            answer: "Course prices vary from ₹499 to ₹9,999 depending on duration and content. We also offer 30% discount on all courses today only! Check our Grab Now deal for more details."
        },
        {
            id: 3,
            question: "Can I get a certificate after completion?",
            answer: "Yes! After completing your course, you'll receive a verified certificate that you can add to your LinkedIn profile and resume."
        },
        {
            id: 4,
            question: "What is the Skill Assessment?",
            answer: "Our Skill Assessment is a FREE test designed to evaluate your current knowledge level in various domains. It helps you identify your strengths and areas for improvement."
        },
        {
            id: 5,
            question: "Tell me about Summer Camp 2026",
            answer: "Summer Camp 2026 is an intensive program for students interested in learning tech skills during summer break. It includes live workshops, mentorship, and project-based learning with industry professionals."
        },
        {
            id: 6,
            question: "How do I contact support?",
            answer: "You can reach our support team through this chat interface 24/7. We respond to queries within 2 hours during business hours."
        },
        {
            id: 7,
            question: "Do you offer refunds?",
            answer: "Yes, we offer a 7-day money-back guarantee if you're not satisfied with the course. No questions asked!"
        },
        {
            id: 8,
            question: "Can I learn at my own pace?",
            answer: "Absolutely! All our courses are self-paced. You can start, pause, and resume anytime. Access course materials anytime, anywhere."
        }
    ];

    // Create Chatbot HTML
    function createChatbot() {
        const chatbotHTML = `
        <!-- Chatbot Container -->
        <div class="chatbot-container" id="chatbotContainer">
            <!-- Chatbot Header -->
            <div class="chatbot-header">
                <div class="chatbot-header-content">
                    <h3>Support Assistant</h3>
                    <p>How can we help?</p>
                </div>
                <button class="chatbot-close" onclick="closeChatbot()" aria-label="Close">✕</button>
            </div>

            <!-- Chatbot Messages Area -->
            <div class="chatbot-messages" id="chatbotMessages">
                <div class="message bot-message">
                    <div class="message-content">
                        <p>👋 Hi there! How can I help you today?</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Questions -->
            <div class="chatbot-faq" id="chatbotFAQ">
                <p class="faq-label">Popular Questions:</p>
                <div class="faq-buttons">
                    ${chatbotData.map(item => `
                        <button class="faq-btn" onclick="sendQuestion(${item.id})">
                            ${item.question}
                        </button>
                    `).join('')}
                </div>
            </div>

            <!-- Input Area -->
            <div class="chatbot-input-area">
                <input 
                    type="text" 
                    class="chatbot-input" 
                    id="chatbotInput" 
                    placeholder="Type your question..."
                    onkeypress="handleKeyPress(event)"
                >
                <button class="chatbot-send" onclick="sendMessage()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>

        <!-- Chatbot Backdrop -->
        <div class="chatbot-backdrop" id="chatbotBackdrop" onclick="closeChatbot()"></div>
    `;

        document.body.insertAdjacentHTML('beforeend', chatbotHTML);
        addChatbotStyles();
    }

    // Add Chatbot Styles
    function addChatbotStyles() {
        const styles = `
        /* ===== CHATBOT STYLES ===== */
        .chatbot-container {
            position: fixed;
            bottom: 80px;
            right: 25px;
            width: 380px;
            height: 600px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            display: flex;
            flex-direction: column;
            z-index: 999;
            opacity: 0;
            transform: scale(0.8) translateY(20px);
            animation: chatbotSlideIn 0.35s ease forwards;
        }

        @keyframes chatbotSlideIn {
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .chatbot-header {
            background: linear-gradient(135deg, #ff6a00, #ff8533);
            color: #ffffff;
            padding: 18px 20px;
            border-radius: 16px 16px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .chatbot-header-content h3 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            margin-bottom: 4px;
        }

        .chatbot-header-content p {
            font-size: 12px;
            margin: 0;
            opacity: 0.9;
        }

        .chatbot-close {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.2s ease;
        }

        .chatbot-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .chatbot-messages {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: #f8f9fb;
        }

        .message {
            display: flex;
            animation: messageSlideIn 0.3s ease;
        }

        @keyframes messageSlideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bot-message {
            justify-content: flex-start;
        }

        .user-message {
            justify-content: flex-end;
        }

        .message-content {
            max-width: 75%;
            padding: 10px 14px;
            border-radius: 12px;
            word-wrap: break-word;
            line-height: 1.4;
        }

        .bot-message .message-content {
            background: #ffffff;
            color: #0f2747;
            border: 1px solid #e0e4ea;
            font-size: 13px;
        }

        .user-message .message-content {
            background: #ff6a00;
            color: #ffffff;
            font-size: 13px;
        }

        .thinking {
            display: flex;
            gap: 4px;
            padding: 12px 14px;
        }

        .thinking-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #0f2747;
            animation: thinking 1.4s infinite;
        }

        .thinking-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .thinking-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes thinking {
            0%, 60%, 100% {
                transform: translateY(0);
                opacity: 0.6;
            }
            30% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }

        .chatbot-faq {
            padding: 12px 16px;
            border-top: 1px solid #e0e4ea;
            max-height: 200px;
            overflow-y: auto;
            flex-shrink: 0;
        }

        .faq-label {
            font-size: 12px;
            font-weight: 600;
            color: #0f2747;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .faq-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .faq-btn {
            background: #f0f2f5;
            border: 1px solid #e0e4ea;
            color: #0f2747;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: left;
            font-weight: 500;
            line-height: 1.3;
        }

        .faq-btn:hover {
            background: #ff6a00;
            color: #ffffff;
            border-color: #ff6a00;
            transform: translateX(4px);
        }

        .chatbot-input-area {
            display: flex;
            gap: 8px;
            padding: 12px 16px;
            background: #ffffff;
            border-top: 1px solid #e0e4ea;
            border-radius: 0 0 16px 16px;
            flex-shrink: 0;
        }

        .chatbot-input {
            flex: 1;
            border: 1px solid #e0e4ea;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 13px;
            font-family: Arial, sans-serif;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .chatbot-input:focus {
            border-color: #ff6a00;
            box-shadow: 0 0 0 3px rgba(255, 106, 0, 0.1);
        }

        .chatbot-send {
            background: #ff6a00;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
            font-size: 14px;
        }

        .chatbot-send:hover {
            background: #e65c00;
            transform: scale(1.05);
        }

        .chatbot-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 998;
            opacity: 0;
            animation: backdropFade 0.35s ease forwards;
        }

        @keyframes backdropFade {
            to {
                opacity: 1;
            }
        }

        /* Scrollbar Styling */
        .chatbot-messages::-webkit-scrollbar,
        .chatbot-faq::-webkit-scrollbar {
            width: 6px;
        }

        .chatbot-messages::-webkit-scrollbar-track,
        .chatbot-faq::-webkit-scrollbar-track {
            background: transparent;
        }

        .chatbot-messages::-webkit-scrollbar-thumb,
        .chatbot-faq::-webkit-scrollbar-thumb {
            background: #d0d5dd;
            border-radius: 3px;
        }

        .chatbot-messages::-webkit-scrollbar-thumb:hover,
        .chatbot-faq::-webkit-scrollbar-thumb:hover {
            background: #b0b5bd;
        }

        /* ===== MOBILE RESPONSIVE ===== */
        @media (max-width: 600px) {
            .chatbot-container {
                width: calc(100% - 24px);
                height: 500px;
                bottom: 90px;
                right: 12px;
                left: 12px;
            }

            .message-content {
                max-width: 85%;
                font-size: 12px;
            }

            .faq-btn {
                font-size: 11px;
                padding: 8px 10px;
            }
        }

        @media (max-width: 380px) {
            .chatbot-container {
                height: 450px;
                bottom: 85px;
            }

            .chatbot-header-content h3 {
                font-size: 14px;
            }

            .chatbot-header-content p {
                font-size: 11px;
            }

            .faq-label {
                font-size: 11px;
            }
        }
    `;

        const styleTag = document.createElement('style');
        styleTag.textContent = styles;
        document.head.appendChild(styleTag);
    }

    // Send Question from FAQ
    function sendQuestion(questionId) {
        const item = chatbotData.find(q => q.id === questionId);
        if (!item) return;

        // Clear FAQ and add user message
        const faqContainer = document.getElementById('chatbotFAQ');
        faqContainer.style.display = 'none';

        addUserMessage(item.question);
        showThinking();

        // Simulate bot thinking time
        setTimeout(() => {
            removeThinking();
            addBotMessage(item.answer);
            showFAQ();
        }, 1800);
    }

    // Send Custom Message
    function sendMessage() {
        const input = document.getElementById('chatbotInput');
        const message = input.value.trim();

        if (!message) return;

        // Check if question matches any FAQ
        const matchedItem = chatbotData.find(item =>
            item.question.toLowerCase().includes(message.toLowerCase()) ||
            message.toLowerCase().includes(item.question.toLowerCase())
        );

        addUserMessage(message);
        input.value = '';
        showThinking();

        setTimeout(() => {
            removeThinking();
            if (matchedItem) {
                addBotMessage(matchedItem.answer);
            } else {
                addBotMessage(
                    "Thanks for your question! Our support team will get back to you soon. In the meantime, check our FAQ for quick answers."
                );
            }
            showFAQ();
        }, 1800);
    }

    // Add User Message
    function addUserMessage(text) {
        const messagesContainer = document.getElementById('chatbotMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message user-message';
        messageDiv.innerHTML = `<div class="message-content">${text}</div>`;
        messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    // Add Bot Message
    function addBotMessage(text) {
        const messagesContainer = document.getElementById('chatbotMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message bot-message';
        messageDiv.innerHTML = `<div class="message-content">${text}</div>`;
        messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    // Show Thinking Animation
    function showThinking() {
        const messagesContainer = document.getElementById('chatbotMessages');
        const thinkingDiv = document.createElement('div');
        thinkingDiv.className = 'message bot-message';
        thinkingDiv.id = 'thinkingMessage';
        thinkingDiv.innerHTML = `
        <div class="thinking">
            <div class="thinking-dot"></div>
            <div class="thinking-dot"></div>
            <div class="thinking-dot"></div>
        </div>
    `;
        messagesContainer.appendChild(thinkingDiv);
        scrollToBottom();
    }

    // Remove Thinking Animation
    function removeThinking() {
        const thinkingMessage = document.getElementById('thinkingMessage');
        if (thinkingMessage) {
            thinkingMessage.remove();
        }
    }

    // Show FAQ Section
    function showFAQ() {
        const faqContainer = document.getElementById('chatbotFAQ');
        faqContainer.style.display = 'block';
    }

    // Scroll to Bottom
    function scrollToBottom() {
        const messagesContainer = document.getElementById('chatbotMessages');
        setTimeout(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 0);
    }

    // Handle Enter Key
    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    }

    // Close Chatbot
    function closeChatbot() {
        const container = document.getElementById('chatbotContainer');
        const backdrop = document.getElementById('chatbotBackdrop');

        container.style.animation = 'chatbotSlideOut 0.3s ease forwards';
        backdrop.style.animation = 'backdropFade 0.3s ease reverse forwards';

        setTimeout(() => {
            container.remove();
            backdrop.remove();
        }, 300);
    }

    // Add Slide Out Animation
    const style = document.createElement('style');
    style.textContent = `
    @keyframes chatbotSlideOut {
        to {
            opacity: 0;
            transform: scale(0.8) translateY(20px);
        }
    }
`;
    document.head.appendChild(style);

    // Initialize Chatbot when Support Button is Clicked
    function initChatbot() {
        if (document.getElementById('chatbotContainer')) return;
        createChatbot();
    }

    // Hook into Support Button
    document.addEventListener('DOMContentLoaded', function() {
        const supportBtn = document.querySelector('.support .pill-btn');
        if (supportBtn) {
            supportBtn.onclick = initChatbot;
        }
    });
</script>
