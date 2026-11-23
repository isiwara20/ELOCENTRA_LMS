<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Dedicated Contact Us Page
 * Matching uploaded reference design
 */
$email = $settings['academy_email'] ?? 'info@elocentra.academy';
$phone = $settings['academy_phone'] ?? '+94 77 123 4567';
$address = $settings['academy_address'] ?? 'No. 123, Education Lane, Colombo, Sri Lanka';
$hours = $settings['academy_office_hours'] ?? 'Mon - Fri: 9.00 AM - 5.00 PM';
?>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- HERO BANNER (NAVY CURVED WAVE AS IN REFERENCE IMAGE)                -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="bg-[#0B132B] text-white pt-16 pb-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-3">
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Contact Us</h1>
        <div class="flex items-center justify-center gap-2 text-xs font-semibold text-slate-300">
            <a href="<?= BASE_URL ?>/" class="hover:text-[#E5A93C] transition-colors">Home</a>
            <span>&gt;</span>
            <span class="text-[#E5A93C]">Contact Us</span>
        </div>
    </div>
    <!-- Curved Wave Shape Divider -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 sm:h-16 text-[var(--page-bg)] fill-current">
            <path d="M0,0 C150,90 350,-40 500,40 C650,120 900,20 1200,60 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- CONTACT CONTENT & INQUIRY FORM (MATCHING REFERENCE IMAGE)           -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Column: Academy Contact Details -->
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <div class="text-[#E5A93C] text-xs font-bold uppercase tracking-widest">GET IN TOUCH</div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">We'd Love to Hear From You</h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm mt-2">
                        Whether you have questions about course enrollments, timetables, or customized corporate training, our academic advisors are here to assist.
                    </p>
                </div>

                <div class="space-y-4">
                    <!-- Email Card -->
                    <div class="elo-card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/15 text-[#E5A93C] flex items-center justify-center text-xl shrink-0">
                            ✉️
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Email</div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    </div>

                    <!-- Phone / WhatsApp Card -->
                    <div class="elo-card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/15 text-[#E5A93C] flex items-center justify-center text-xl shrink-0">
                            📱
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Phone / WhatsApp</div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    </div>

                    <!-- Address Card -->
                    <div class="elo-card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/15 text-[#E5A93C] flex items-center justify-center text-xl shrink-0">
                            📍
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Campus Address</div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($address, ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    </div>

                    <!-- Office Hours Card -->
                    <div class="elo-card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[#E5A93C]/15 text-[#E5A93C] flex items-center justify-center text-xl shrink-0">
                            ⏰
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Office Hours</div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($hours, ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    </div>
                </div>

                <!-- Neoclassical Academic Building Graphic / Box -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-[#0B132B] to-[#111A2E] text-white border border-[#E5A93C]/20 shadow-lg relative overflow-hidden">
                    <div class="text-xs font-bold text-[#E5A93C] uppercase tracking-wider">ELOCENTRA Main Campus</div>
                    <p class="text-xs text-slate-300 mt-1">Visit our modern learning suites and resource center in Colombo.</p>
                </div>
            </div>

            <!-- Right Column: "Send Us a Message" Card (Matching Reference Image) -->
            <div class="lg:col-span-7">
                <div class="elo-card p-8 sm:p-10 shadow-2xl">
                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white mb-2">Send Us a Message</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-8">Fill in the form below and an academic counselor will respond within 24 business hours.</p>

                    <form action="<?= BASE_URL ?>/contact" method="POST" class="space-y-5">
                        <?= csrfField() ?>

                        <!-- Full Name -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Full Name <span class="text-[#E5A93C]">*</span>
                            </label>
                            <input type="text" name="name" required placeholder="e.g. Kasun Perera"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Email Address <span class="text-[#E5A93C]">*</span>
                            </label>
                            <input type="email" name="email" required placeholder="e.g. kasun@example.com"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
                        </div>

                        <!-- Phone / WhatsApp -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                WhatsApp / Phone Number
                            </label>
                            <input type="text" name="phone" placeholder="e.g. +94 77 123 4567"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
                        </div>

                        <!-- Subject -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Subject <span class="text-[#E5A93C]">*</span>
                            </label>
                            <select name="subject" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
                                <option value="Course Enrollment Inquiry">Course Enrollment Inquiry</option>
                                <option value="English & Communication Programs">English &amp; Communication Programs</option>
                                <option value="Psychology Courses">Psychology Courses</option>
                                <option value="Business Accounting Essentials">Business Accounting Essentials</option>
                                <option value="Bank Transfer Payment Verification">Bank Transfer Payment Verification</option>
                                <option value="Corporate / Custom Training">Corporate / Custom Training</option>
                                <option value="General Inquiry">General Inquiry</option>
                            </select>
                        </div>

                        <!-- Your Message -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Your Message <span class="text-[#E5A93C]">*</span>
                            </label>
                            <textarea name="message" rows="5" required placeholder="Write your message or inquiry here..."
                                      class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm resize-none"></textarea>
                        </div>

                        <!-- Submit Button (Gold Button) -->
                        <div class="pt-2">
                            <button type="submit" class="btn-gold w-full text-base py-3.5">
                                Send Message &rarr;
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
