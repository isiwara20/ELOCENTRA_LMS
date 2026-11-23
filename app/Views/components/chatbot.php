<?php
/**
 * ELOCENTRA Academic Advisor Chatbot Component
 * Modern, responsive floating chat assistant
 */
?>
<!-- Chatbot Floating Launcher -->
<div id="eloChatbotContainer" class="fixed bottom-6 right-6 z-50 font-sans" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <!-- Launcher Button -->
    <button type="button" id="eloChatLauncher" aria-label="Open Academic Advisor Chat"
            class="group relative flex items-center gap-3 bg-gradient-to-r from-[#0B132B] to-[#14234C] text-[#E5A93C] hover:text-white px-4 py-3 rounded-full shadow-2xl border border-[#E5A93C]/40 hover:border-[#E5A93C] transition-all duration-300 hover:scale-105 focus:outline-none">
        <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
        </span>
        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#E5A93C] to-[#D49028] flex items-center justify-center text-[#0B132B] shadow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
        </div>
        <div class="hidden sm:flex flex-col text-left">
            <span class="text-xs font-bold text-white tracking-wide">ELOCENTRA AI</span>
            <span class="text-[11px] text-[#E5A93C] font-semibold">Academic Advisor</span>
        </div>
    </button>

    <!-- Chat Window Modal -->
    <div id="eloChatBox" class="hidden absolute bottom-16 right-0 w-[92vw] sm:w-[380px] h-[520px] bg-white dark:bg-[#0B132B] rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden transition-all duration-300">
        <!-- Chat Header -->
        <div class="bg-gradient-to-r from-[#0B132B] via-[#101D3F] to-[#0B132B] px-4 py-3.5 border-b border-amber-500/20 flex items-center justify-between text-white">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#E5A93C] to-[#F59E0B] flex items-center justify-center text-[#0B132B] font-bold shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white leading-tight">ELOCENTRA Advisor</h4>
                    <p class="text-[11px] text-amber-300 flex items-center gap-1.5 font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Online • 24/7 Academic Support
                    </p>
                </div>
            </div>
            <button type="button" id="eloChatClose" aria-label="Close Chat" class="p-1.5 text-slate-400 hover:text-white rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Chat Messages Container -->
        <div id="eloChatMessages" class="flex-1 p-4 overflow-y-auto space-y-3 text-xs leading-relaxed bg-slate-50 dark:bg-[#070D1F]">
            <!-- Bot Welcome Message -->
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-full bg-amber-500/20 text-[#E5A93C] flex items-center justify-center shrink-0 mt-0.5 border border-amber-500/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="bg-white dark:bg-[#111A2E] text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-800 p-3 rounded-2xl rounded-tl-sm shadow-sm max-w-[85%] space-y-2">
                    <p class="font-medium">Welcome to <strong>ELOCENTRA – English Academy</strong>! How can I assist you with your language learning goals today?</p>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">Select an option below or type your question:</p>
                </div>
            </div>

            <!-- Suggestion Quick Chips -->
            <div id="eloQuickChips" class="flex flex-wrap gap-1.5 pl-9">
                <button type="button" class="elo-chip bg-white dark:bg-[#152238] hover:bg-amber-50 dark:hover:bg-amber-900/30 text-slate-700 dark:text-slate-300 hover:text-[#E5A93C] border border-slate-200 dark:border-slate-700 px-2.5 py-1 rounded-full text-[11px] transition-colors" data-prompt="What courses are available?">
                    Available Courses
                </button>
                <button type="button" class="elo-chip bg-white dark:bg-[#152238] hover:bg-amber-50 dark:hover:bg-amber-900/30 text-slate-700 dark:text-slate-300 hover:text-[#E5A93C] border border-slate-200 dark:border-slate-700 px-2.5 py-1 rounded-full text-[11px] transition-colors" data-prompt="How do I enroll in a course?">
                    How to Enroll
                </button>
                <button type="button" class="elo-chip bg-white dark:bg-[#152238] hover:bg-amber-50 dark:hover:bg-amber-900/30 text-slate-700 dark:text-slate-300 hover:text-[#E5A93C] border border-slate-200 dark:border-slate-700 px-2.5 py-1 rounded-full text-[11px] transition-colors" data-prompt="What payment methods are supported?">
                    Payment Options
                </button>
                <button type="button" class="elo-chip bg-white dark:bg-[#152238] hover:bg-amber-50 dark:hover:bg-amber-900/30 text-slate-700 dark:text-slate-300 hover:text-[#E5A93C] border border-slate-200 dark:border-slate-700 px-2.5 py-1 rounded-full text-[11px] transition-colors" data-prompt="How can I contact ELOCENTRA?">
                    Contact Academy
                </button>
            </div>
        </div>

        <!-- Chat Input Form -->
        <form id="eloChatForm" class="p-3 bg-white dark:bg-[#0B132B] border-t border-slate-200 dark:border-slate-800 flex items-center gap-2">
            <input type="text" id="eloChatInput" placeholder="Ask anything about courses, fees, admissions..." 
                   class="flex-1 bg-slate-100 dark:bg-[#152238] text-slate-900 dark:text-slate-100 placeholder-slate-400 text-xs px-3.5 py-2.5 rounded-xl border border-transparent focus:border-[#E5A93C] focus:bg-white dark:focus:bg-[#111A2E] focus:outline-none transition-all">
            <button type="submit" aria-label="Send Message" class="bg-gradient-to-r from-[#E5A93C] to-[#D49028] text-[#0B132B] p-2.5 rounded-xl hover:shadow-md transition-all shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            </button>
        </form>
    </div>
</div>

<script>
(function() {
    var launcher = document.getElementById('eloChatLauncher');
    var chatBox = document.getElementById('eloChatBox');
    var closeBtn = document.getElementById('eloChatClose');
    var messages = document.getElementById('eloChatMessages');
    var form = document.getElementById('eloChatForm');
    var input = document.getElementById('eloChatInput');
    var chips = document.querySelectorAll('.elo-chip');

    if (!launcher || !chatBox) return;

    launcher.addEventListener('click', function() {
        chatBox.classList.toggle('hidden');
        if (!chatBox.classList.contains('hidden') && input) {
            setTimeout(function() { input.focus(); }, 150);
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            chatBox.classList.add('hidden');
        });
    }

    function addMessage(text, isUser) {
        var wrapper = document.createElement('div');
        wrapper.className = isUser ? 'flex justify-end' : 'flex items-start gap-2.5';

        if (isUser) {
            wrapper.innerHTML = '<div class="bg-gradient-to-r from-[#0B132B] to-[#14234C] text-[#E5A93C] border border-[#E5A93C]/30 p-3 rounded-2xl rounded-tr-sm shadow-sm max-w-[85%] font-medium">' + escapeHtml(text) + '</div>';
        } else {
            wrapper.innerHTML = '<div class="w-7 h-7 rounded-full bg-amber-500/20 text-[#E5A93C] flex items-center justify-center shrink-0 mt-0.5 border border-amber-500/30"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><div class="bg-white dark:bg-[#111A2E] text-slate-800 dark:text-slate-200 border border-slate-200 dark:border-slate-800 p-3 rounded-2xl rounded-tl-sm shadow-sm max-w-[85%] leading-relaxed">' + text + '</div>';
        }

        messages.appendChild(wrapper);
        messages.scrollTop = messages.scrollHeight;
    }

    function escapeHtml(string) {
        var pre = document.createElement('pre');
        var text = document.createTextNode(string);
        pre.appendChild(text);
        return pre.innerHTML;
    }

    function generateResponse(query) {
        var q = query.toLowerCase();
        if (q.includes('course') || q.includes('subject') || q.includes('class')) {
            return "ELOCENTRA offers professionally accredited courses across <strong>English & Communication</strong>, <strong>Psychology</strong>, and <strong>Business Accounting</strong>. You can browse all details and fees on our <a href='<?= BASE_URL ?>/courses' class='text-[#E5A93C] underline font-semibold'>Courses Page</a>.";
        } else if (q.includes('fee') || q.includes('pay') || q.includes('directpay') || q.includes('bank') || q.includes('cost')) {
            return "We support seamless online payments via <strong>DirectPay</strong> (Visa, Mastercard, LankaQR) and direct <strong>Bank Transfer / Cash Deposit</strong> with instant slip verification in your student portal.";
        } else if (q.includes('enroll') || q.includes('register') || q.includes('join') || q.includes('apply')) {
            return "Enrolling is quick and easy! First, create an account via our <a href='<?= BASE_URL ?>/register' class='text-[#E5A93C] underline font-semibold'>Two-Step Student Registration</a>, select your desired course, and complete the enrollment fee to get instant portal access.";
        } else if (q.includes('contact') || q.includes('phone') || q.includes('email') || q.includes('number') || q.includes('call') || q.includes('whatsapp')) {
            return "You can reach ELOCENTRA directly via:<br>• <strong>Email:</strong> <a href='mailto:eloengaca@gmail.com' class='text-[#E5A93C] underline'>eloengaca@gmail.com</a><br>• <strong>Phone / WhatsApp:</strong> 077 7354892<br>• <strong>Alternative Phone:</strong> 077 2278069";
        } else if (q.includes('teacher') || q.includes('resource') || q.includes('faculty') || q.includes('lecturer')) {
            return "Our courses are conducted by distinguished resource persons, including Senior English Lecturers, Chartered Accountants, and Certified Psychologists. Visit our <a href='<?= BASE_URL ?>/about' class='text-[#E5A93C] underline font-semibold'>About Us</a> section to learn more.";
        } else if (q.includes('vision') || q.includes('mission') || q.includes('goal') || q.includes('slogan')) {
            return "<strong>Our Slogan:</strong> <em>'Learn English. Speak Confidently. Succeed Globally.'</em><br>Our vision is to become a trusted, internationally recognised English academy empowering learners worldwide.";
        } else {
            return "Thank you for reaching out! To assist you specifically, you can explore our <a href='<?= BASE_URL ?>/courses' class='text-[#E5A93C] underline font-semibold'>Course Catalog</a>, send an email to <a href='mailto:eloengaca@gmail.com' class='text-[#E5A93C] underline'>eloengaca@gmail.com</a>, or call our student hotline at <strong>077 7354892</strong> / <strong>077 2278069</strong>.";
        }
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var text = (input.value || '').trim();
            if (!text) return;

            addMessage(text, true);
            input.value = '';

            setTimeout(function() {
                var response = generateResponse(text);
                addMessage(response, false);
            }, 400);
        });
    }

    chips.forEach(function(chip) {
        chip.addEventListener('click', function() {
            var prompt = chip.getAttribute('data-prompt');
            if (prompt) {
                addMessage(prompt, true);
                setTimeout(function() {
                    var response = generateResponse(prompt);
                    addMessage(response, false);
                }, 350);
            }
        });
    });
})();
</script>
