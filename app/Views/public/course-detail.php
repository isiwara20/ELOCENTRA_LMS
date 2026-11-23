<?php
/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Single Course Detail Page
 * Matching uploaded reference design (Middle-Right panel)
 */
$fee = number_format((float) ($course['price'] ?? $course['monthly_fee'] ?? 0), 2);
$rawFee = (float) ($course['price'] ?? $course['monthly_fee'] ?? 0);
$thumb = $course['course_thumbnail'] ?: '/assets/img/courses/english-global.jpg';
$isLoggedIn = function_exists('session_get') && session_get('user_id');
$userType = function_exists('session_get') ? session_get('user_type') : null;
?>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- COURSE DETAIL HERO & OVERVIEW (MATCHING REFERENCE IMAGE)            -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-8">
            <a href="<?= BASE_URL ?>/" class="hover:text-[#E5A93C] transition-colors">Home</a>
            <span>&gt;</span>
            <a href="<?= BASE_URL ?>/courses" class="hover:text-[#E5A93C] transition-colors">Courses</a>
            <span>&gt;</span>
            <span class="text-slate-800 dark:text-slate-200"><?= htmlspecialchars($course['class_name'], ENT_QUOTES, 'UTF-8') ?></span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Column: Video / Image Preview Player & Thumbnails -->
            <div class="lg:col-span-6 space-y-4">
                <!-- Large Main Player Container -->
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 bg-black aspect-video group">
                    <img id="mainCoursePreview" src="<?= BASE_URL ?>/assets/img/courses/detail-preview.jpg" alt="<?= htmlspecialchars($course['class_name'], ENT_QUOTES, 'UTF-8') ?>" class="w-full h-full object-cover">
                    <!-- Play Overlay Button -->
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                        <div class="w-16 h-16 rounded-full bg-[#E5A93C]/90 text-[#0B132B] flex items-center justify-center shadow-2xl pl-1 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- 3 Small Gallery Thumbnails (Matching Reference Image) -->
                <div class="grid grid-cols-3 gap-3">
                    <div class="rounded-xl overflow-hidden border-2 border-[#E5A93C] aspect-video cursor-pointer">
                        <img src="<?= BASE_URL ?>/assets/img/courses/detail-preview.jpg" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 aspect-video cursor-pointer hover:border-[#E5A93C] transition-colors">
                        <img src="<?= BASE_URL ?>/assets/img/brand/hero-student.jpg" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 aspect-video cursor-pointer hover:border-[#E5A93C] transition-colors">
                        <img src="<?= BASE_URL ?>/assets/img/brand/about-campus.jpg" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Right Column: Course Info, Key Metrics, Pricing & Purchasing -->
            <div class="lg:col-span-6 space-y-6">
                <!-- Category Pill -->
                <div class="inline-block px-3.5 py-1 rounded-full bg-[#E5A93C]/15 text-[#E5A93C] border border-[#E5A93C]/30 text-xs font-bold uppercase tracking-wider">
                    <?= htmlspecialchars($course['subject_area_name'] ?? $course['subject'] ?? 'English & Communication', ENT_QUOTES, 'UTF-8') ?>
                </div>

                <!-- Title -->
                <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    <?= htmlspecialchars($course['class_name'], ENT_QUOTES, 'UTF-8') ?>
                </h1>

                <!-- Description Paragraph -->
                <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                    <?= htmlspecialchars($course['description'] ?? 'A comprehensive course to improve your English language skills, confidence, language proficiency, communication confidence, and real-world communication for academic, professional, and global opportunities.', ENT_QUOTES, 'UTF-8') ?>
                </p>

                <!-- Key Information Grid (Matching Reference Image) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 py-4 border-y border-slate-200 dark:border-slate-800">
                    <!-- Metric 1: Duration -->
                    <div class="text-center p-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                        <div class="text-[#E5A93C] text-lg mb-1">⏱️</div>
                        <div class="text-xs font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($course['duration_weeks'] ?? '12 Weeks', ENT_QUOTES, 'UTF-8') ?></div>
                        <div class="text-[10px] text-slate-400">Duration</div>
                    </div>
                    <!-- Metric 2: Mode -->
                    <div class="text-center p-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                        <div class="text-[#E5A93C] text-lg mb-1">💻</div>
                        <div class="text-xs font-bold text-slate-900 dark:text-white"><?= ucfirst(htmlspecialchars($course['delivery_mode'] ?? 'Online', ENT_QUOTES, 'UTF-8')) ?></div>
                        <div class="text-[10px] text-slate-400">Mode</div>
                    </div>
                    <!-- Metric 3: Level -->
                    <div class="text-center p-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                        <div class="text-[#E5A93C] text-lg mb-1">📊</div>
                        <div class="text-xs font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($course['course_level'] ?? 'Intermediate', ENT_QUOTES, 'UTF-8') ?></div>
                        <div class="text-[10px] text-slate-400">Level</div>
                    </div>
                    <!-- Metric 4: Certificate -->
                    <div class="text-center p-3 rounded-xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                        <div class="text-[#E5A93C] text-lg mb-1">📜</div>
                        <div class="text-xs font-bold text-slate-900 dark:text-white">Certificate</div>
                        <div class="text-[10px] text-slate-400">Upon Completion</div>
                    </div>
                </div>

                <!-- Pricing Display -->
                <div class="pt-2">
                    <span class="text-xs uppercase tracking-wider text-slate-400 font-bold block mb-1">Total Course Fee</span>
                    <div class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">
                        LKR <?= $fee ?>
                    </div>
                </div>

                <!-- Action Buttons: [Buy Now] [Add to Cart] -->
                <div class="flex flex-wrap items-center gap-4 pt-4">
                    <button type="button" onclick="openEnrollmentModal()" class="btn-gold text-base py-3.5 px-10 shadow-lg shadow-[#E5A93C]/25 flex-1 text-center justify-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        Buy Now
                    </button>
                    <button type="button" onclick="openEnrollmentModal()" class="btn-outline-gold text-base py-3.5 px-8 text-slate-800 dark:text-white border-slate-300 dark:border-slate-700 hover:border-[#E5A93C]">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Add to Cart
                    </button>
                </div>

                <!-- Resource Person Preview -->
                <?php if (!empty($course['teacher_name'])): ?>
                    <div class="mt-6 p-4 rounded-2xl bg-slate-50 dark:bg-[#111A2E] border border-slate-200 dark:border-slate-800 flex items-center gap-4">
                        <img src="<?= BASE_URL . htmlspecialchars($course['teacher_photo'] ?: '/assets/img/teachers/senaka.jpg', ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($course['teacher_name'], ENT_QUOTES, 'UTF-8') ?>" class="w-14 h-14 rounded-full object-cover border-2 border-[#E5A93C]/40">
                        <div>
                            <div class="text-[10px] text-[#E5A93C] uppercase font-bold tracking-wider">Instructor / Resource Person</div>
                            <div class="text-sm font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($course['teacher_name'], ENT_QUOTES, 'UTF-8') ?></div>
                            <div class="text-xs text-slate-500 dark:text-slate-400"><?= htmlspecialchars($course['teacher_title'] ?? 'Senior Academic', ENT_QUOTES, 'UTF-8') ?></div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- COURSE SYLLABUS & LEARNING OUTCOMES                                 -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<section class="py-16 bg-slate-100/70 dark:bg-[#070D1F]/50 border-t border-slate-200 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8 space-y-8">
                <div>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white">What You Will Master</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Structured syllabus designed according to international academic and professional standards.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="elo-card p-5 space-y-2">
                        <div class="text-[#E5A93C] font-bold text-sm">Module 1: Advanced Spoken Fluency</div>
                        <p class="text-xs text-slate-600 dark:text-slate-300">Overcome public speaking hesitation, natural idiom mastery, speech structure, and accent modulation.</p>
                    </div>
                    <div class="elo-card p-5 space-y-2">
                        <div class="text-[#E5A93C] font-bold text-sm">Module 2: Professional Correspondence</div>
                        <p class="text-xs text-slate-600 dark:text-slate-300">Executive email etiquette, corporate proposals, formal reports, and persuasive written communication.</p>
                    </div>
                    <div class="elo-card p-5 space-y-2">
                        <div class="text-[#E5A93C] font-bold text-sm">Module 3: Interpersonal Psychology</div>
                        <p class="text-xs text-slate-600 dark:text-slate-300">Emotional intelligence in negotiations, assertive dialogue, active listening, and conflict de-escalation.</p>
                    </div>
                    <div class="elo-card p-5 space-y-2">
                        <div class="text-[#E5A93C] font-bold text-sm">Module 4: Global Presentation Craft</div>
                        <p class="text-xs text-slate-600 dark:text-slate-300">Slide narrative structuring, virtual meeting presence, handling Q&amp;A under pressure, and cross-cultural competence.</p>
                    </div>
                </div>

                <!-- Academic Certification Details -->
                <div class="p-6 rounded-2xl bg-gradient-to-r from-[#0B132B] to-[#111A2E] text-white border border-[#E5A93C]/30 flex items-start gap-4">
                    <div class="text-3xl">🎓</div>
                    <div>
                        <h4 class="text-base font-bold text-white">ELOCENTRA Official Academic Certificate</h4>
                        <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                            Upon satisfactory completion of course coursework, interactive assessments, and the final viva, you will receive an official verifiable digital and hard-copy Certificate of Completion issued by ELOCENTRA – English Academy (PVT) LTD.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Enrollment Highlights & Guarantee -->
            <div class="lg:col-span-4 space-y-6">
                <div class="elo-card p-6 space-y-4">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Enrollment Highlights</h3>
                    <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-3">
                        <li class="flex items-center gap-2">
                            <span class="text-[#E5A93C]">✓</span> Full 12-week interactive course curriculum
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#E5A93C]">✓</span> Weekly live classes with Senior Resource Persons
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#E5A93C]">✓</span> 24/7 access to student portal &amp; learning materials
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#E5A93C]">✓</span> Personalized speaking assessments &amp; feedback
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-[#E5A93C]">✓</span> Choice of Card Payment (DirectPay) or Bank Transfer
                        </li>
                    </ul>
                    <div class="pt-2">
                        <button type="button" onclick="openEnrollmentModal()" class="btn-gold w-full text-sm py-3 font-bold">
                            Enroll in Course Now
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════════ -->
<!-- COURSE ENROLLMENT & PAYMENT WORKFLOW MODAL                          -->
<!-- ═══════════════════════════════════════════════════════════════════ -->
<div id="enrollmentModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#111A2E] rounded-3xl max-w-xl w-full border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden max-h-[92vh] flex flex-col">
        
        <!-- Modal Header -->
        <div class="p-6 bg-[#0B132B] text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="<?= BASE_URL ?>/assets/img/brand/elocentra-icon.svg" class="w-8 h-8">
                <div>
                    <h3 class="text-base font-bold text-white">Course Enrollment &amp; Checkout</h3>
                    <p class="text-[11px] text-[#E5A93C]"><?= htmlspecialchars($course['class_name'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            </div>
            <button type="button" onclick="closeEnrollmentModal()" class="text-slate-400 hover:text-white text-2xl font-bold">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 overflow-y-auto space-y-6 flex-grow">
            
            <!-- Price Summary -->
            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <div>
                    <div class="text-xs text-slate-500 dark:text-slate-400">Total Payable Amount</div>
                    <div class="text-2xl font-extrabold text-slate-900 dark:text-white">LKR <?= $fee ?></div>
                </div>
                <div class="text-right">
                    <div class="text-[10px] text-[#E5A93C] uppercase font-bold">One-Time Fee</div>
                    <div class="text-xs text-slate-400">Includes all materials</div>
                </div>
            </div>

            <!-- Student Verification / Login Prompt if not logged in -->
            <?php if (!$isLoggedIn): ?>
                <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/30 text-amber-800 dark:text-amber-200 text-xs space-y-2">
                    <p class="font-bold">Are you an existing ELOCENTRA student?</p>
                    <p>Please <a href="<?= BASE_URL ?>/login" class="underline font-bold">Log in</a> to enroll under your student ID, or fill in your details below to automatically register while checking out.</p>
                </div>
            <?php endif; ?>

            <!-- Payment Method Tabs -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Select Payment Method</label>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" id="tabDirectPayBtn" onclick="selectPaymentMethod('directpay')"
                            class="p-3.5 rounded-xl border-2 border-[#E5A93C] bg-[#E5A93C]/10 text-slate-900 dark:text-white flex items-center justify-center gap-2 font-bold text-xs transition-all">
                        💳 Card (DirectPay)
                    </button>
                    <button type="button" id="tabBankBtn" onclick="selectPaymentMethod('bank')"
                            class="p-3.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-transparent text-slate-600 dark:text-slate-400 flex items-center justify-center gap-2 font-bold text-xs transition-all">
                        🏦 Bank Transfer
                    </button>
                </div>
            </div>

            <!-- Enrollment Form -->
            <form id="coursePurchaseForm" action="<?= BASE_URL ?>/courses/<?= (int) $course['id'] ?>/enroll" method="POST" enctype="multipart/form-data" class="space-y-4">
                <?= csrfField() ?>
                <input type="hidden" name="course_id" value="<?= (int) $course['id'] ?>">
                <input type="hidden" name="payment_method" id="selectedPaymentMethod" value="directpay">

                <!-- Guest Student Details (if not logged in) -->
                <?php if (!$isLoggedIn): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Full Name *</label>
                            <input type="text" name="student_name" required placeholder="e.g. Kasun Perera"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Email Address *</label>
                            <input type="email" name="student_email" required placeholder="e.g. kasun@example.com"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">WhatsApp Number *</label>
                            <input type="text" name="student_whatsapp" required placeholder="+94 77 123 4567"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">City / Address *</label>
                            <input type="text" name="student_address" required placeholder="Colombo, Sri Lanka"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        </div>
                    </div>
                <?php endif; ?>

                <!-- DirectPay Option Panel -->
                <div id="directPaySection" class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-600/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold">
                            DP
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 dark:text-white">DirectPay Payment Gateway</div>
                            <div class="text-[11px] text-slate-400">Visa, MasterCard, and Local Debit/Credit Cards</div>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        You will complete secure card authorization powered by DirectPay. Course access is activated immediately upon successful payment verification.
                    </p>
                </div>

                <!-- Bank Transfer Option Panel -->
                <div id="bankTransferSection" class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 space-y-4 hidden">
                    <div>
                        <div class="text-xs font-bold text-slate-900 dark:text-white mb-2">Academy Bank Account Details:</div>
                        <div class="space-y-2">
                            <?php foreach ($bankAccounts as $ba): ?>
                                <div class="p-3 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs">
                                    <div class="font-bold text-[#E5A93C]"><?= htmlspecialchars($ba['bank_name'], ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars($ba['branch_name'], ENT_QUOTES, 'UTF-8') ?>)</div>
                                    <div class="text-slate-700 dark:text-slate-300 mt-0.5">Account Name: <strong><?= htmlspecialchars($ba['account_name'], ENT_QUOTES, 'UTF-8') ?></strong></div>
                                    <div class="text-slate-700 dark:text-slate-300">Account No: <strong class="text-slate-900 dark:text-white tracking-wider"><?= htmlspecialchars($ba['account_number'], ENT_QUOTES, 'UTF-8') ?></strong></div>
                                    <?php if (!empty($ba['instructions'])): ?>
                                        <div class="text-[10px] text-slate-400 mt-1"><?= htmlspecialchars($ba['instructions'], ENT_QUOTES, 'UTF-8') ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Bank Transfer Fields -->
                    <div class="space-y-3 pt-2">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Bank Reference / Deposit Number</label>
                            <input type="text" name="bank_reference" placeholder="e.g. REF987654321"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mb-1">Upload Payment Receipt / Deposit Slip *</label>
                            <input type="file" name="payment_slip" accept="image/*,.pdf"
                                   class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
                            <span class="text-[10px] text-slate-400">Accepted formats: JPG, PNG, PDF. Max size: 5MB.</span>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-4">
                    <button type="submit" id="submitPaymentBtn" class="btn-gold w-full text-sm py-3.5 font-bold">
                        Proceed to DirectPay Card Payment &rarr;
                    </button>
                </div>
            </form>

        </div>

    </div>
</div>

<script>
function openEnrollmentModal() {
    var modal = document.getElementById('enrollmentModal');
    if (modal) modal.classList.remove('hidden');
}

function closeEnrollmentModal() {
    var modal = document.getElementById('enrollmentModal');
    if (modal) modal.classList.add('hidden');
}

function selectPaymentMethod(method) {
    var dpBtn = document.getElementById('tabDirectPayBtn');
    var bankBtn = document.getElementById('tabBankBtn');
    var dpSec = document.getElementById('directPaySection');
    var bankSec = document.getElementById('bankTransferSection');
    var methodInput = document.getElementById('selectedPaymentMethod');
    var submitBtn = document.getElementById('submitPaymentBtn');

    if (method === 'directpay') {
        methodInput.value = 'directpay';
        dpBtn.className = 'p-3.5 rounded-xl border-2 border-[#E5A93C] bg-[#E5A93C]/10 text-slate-900 dark:text-white flex items-center justify-center gap-2 font-bold text-xs transition-all';
        bankBtn.className = 'p-3.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-transparent text-slate-600 dark:text-slate-400 flex items-center justify-center gap-2 font-bold text-xs transition-all';
        dpSec.classList.remove('hidden');
        bankSec.classList.add('hidden');
        submitBtn.innerHTML = 'Proceed to DirectPay Card Payment &rarr;';
    } else {
        methodInput.value = 'bank_transfer';
        bankBtn.className = 'p-3.5 rounded-xl border-2 border-[#E5A93C] bg-[#E5A93C]/10 text-slate-900 dark:text-white flex items-center justify-center gap-2 font-bold text-xs transition-all';
        dpBtn.className = 'p-3.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-transparent text-slate-600 dark:text-slate-400 flex items-center justify-center gap-2 font-bold text-xs transition-all';
        bankSec.classList.remove('hidden');
        dpSec.classList.add('hidden');
        submitBtn.innerHTML = 'Submit Bank Transfer For Verification &rarr;';
    }
}
</script>
