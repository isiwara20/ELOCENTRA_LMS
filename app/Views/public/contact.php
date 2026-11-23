<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Dedicated Contact Us Page
 * Strictly No Physical Address. Exact Emails and Phone Numbers. Modern SVGs.
 */
$email = 'eloengaca@gmail.com';
$phone1 = '077 7354892';
$phone2 = '077 2278069';
$hours = 'Monday - Saturday: 8.30 AM - 6.00 PM';
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
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 sm:h-16 text-[var(--page-bg)] fill-current transition-colors">
            <path d="M0,0 C150,90 350,-40 500,40 C650,120 900,20 1200,60 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- CONTACT CONTENT & INQUIRY FORM (MATCHING REFERENCE IMAGE)           -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-16 sm:py-24 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Column: Academy Contact Details -->
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <div class="text-[#E5A93C] text-xs font-bold uppercase tracking-widest">GET IN TOUCH</div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">We'd Love to Hear From You</h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm mt-2 leading-relaxed">
                        Whether you have questions about course enrollments, timetables, payment methods, or student support, our academic advisors are ready to assist.
                    </p>
                </div>

                <div class="space-y-4">
                    <!-- Email Card -->
                    <div class="elo-card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/15 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Official Email</div>
                            <a href="mailto:<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" class="text-sm font-bold text-slate-900 dark:text-white hover:text-[#E5A93C] transition-colors">
                                <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>
                            </a>
                        </div>
                    </div>

                    <!-- Phone 1 / WhatsApp Card -->
                    <div class="elo-card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/15 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Hotline &amp; WhatsApp</div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white">
                                <a href="tel:<?= preg_replace('/\s+/', '', $phone1) ?>" class="hover:text-[#E5A93C] transition-colors"><?= htmlspecialchars($phone1, ENT_QUOTES, 'UTF-8') ?></a>
                            </div>
                        </div>
                    </div>

                    <!-- Phone 2 Card -->
                    <div class="elo-card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/15 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Alternative Contact</div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white">
                                <a href="tel:<?= preg_replace('/\s+/', '', $phone2) ?>" class="hover:text-[#E5A93C] transition-colors"><?= htmlspecialchars($phone2, ENT_QUOTES, 'UTF-8') ?></a>
                            </div>
                        </div>
                    </div>

                    <!-- Office Hours Card -->
                    <div class="elo-card p-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/15 text-[#E5A93C] flex items-center justify-center shrink-0 border border-amber-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Operational Hours</div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($hours, ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    </div>
                </div>

                <!-- Academic Advisory Banner -->
                <div class="p-6 rounded-2xl bg-gradient-to-br from-[#0B132B] to-[#111A2E] text-white border border-[#E5A93C]/30 shadow-lg relative overflow-hidden">
                    <div class="text-xs font-bold text-[#E5A93C] uppercase tracking-wider">ELOCENTRA Academic Guidance</div>
                    <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                        Our student advisory team offers dedicated online consultation to help you choose the ideal English and professional development pathway.
                    </p>
                </div>
            </div>

            <!-- Right Column: "Send Us a Message" Card (Matching Reference Image) -->
            <div class="lg:col-span-7">
                <div class="elo-card p-8 sm:p-10 shadow-2xl">
                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white mb-2">Send Us a Message</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mb-8">Fill in the form below and an academic counselor will respond within 24 business hours.</p>

                    <form action="<?= BASE_URL ?>/contact" method="POST" class="space-y-5">
                        <?= csrfField() ?>

                        <!-- Full Name -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Full Name <span class="text-[#E5A93C]">*</span>
                            </label>
                            <input type="text" name="name" required placeholder="e.g. Kasun Perera"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Email Address <span class="text-[#E5A93C]">*</span>
                            </label>
                            <input type="email" name="email" required placeholder="e.g. kasun@example.com"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
                        </div>

                        <!-- Phone / WhatsApp -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                WhatsApp / Contact Number
                            </label>
                            <input type="text" name="phone" placeholder="e.g. 077 7354892"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
                        </div>

                        <!-- Subject -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Subject <span class="text-[#E5A93C]">*</span>
                            </label>
                            <select name="subject" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm">
                                <option value="Course Enrollment Inquiry">Course Enrollment Inquiry</option>
                                <option value="English & Communication Programs">English &amp; Communication Programs</option>
                                <option value="Psychology Courses">Psychology Courses</option>
                                <option value="Business Accounting Essentials">Business Accounting Essentials</option>
                                <option value="DirectPay & Payment Inquiries">DirectPay &amp; Payment Inquiries</option>
                                <option value="Corporate / Custom Training">Corporate / Custom Training</option>
                                <option value="General Inquiry">General Inquiry</option>
                            </select>
                        </div>

                        <!-- Your Message -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">
                                Your Message <span class="text-[#E5A93C]">*</span>
                            </label>
                            <textarea name="message" required rows="4" placeholder="How can ELOCENTRA assist you today?"
                                      class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0E1629] text-slate-900 dark:text-white focus:outline-none focus:border-[#E5A93C] focus:ring-2 focus:ring-[#E5A93C]/20 transition-all text-sm"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" class="btn-gold w-full text-sm sm:text-base py-3.5 font-bold shadow-lg shadow-[#E5A93C]/25">
                                <span>Send Message</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>
