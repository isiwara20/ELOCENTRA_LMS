/**
 * ELOCENTRA – English Academy (PVT) LTD
 * Comprehensive Form Validation & Loading Animations Framework
 */
(function(window, document) {
    'use strict';

    // ─────────────────────────────────────────────────────────────────
    // 1. TOP PAGE LOADER & PROGRESS BAR
    // ─────────────────────────────────────────────────────────────────
    var ElocentraLoader = {
        bar: null,
        progress: 0,
        timer: null,

        init: function() {
            var existing = document.getElementById('eloPageLoader');
            if (existing) {
                this.bar = existing;
            } else {
                this.bar = document.createElement('div');
                this.bar.id = 'eloPageLoader';
                document.body.prepend(this.bar);
            }

            // Start simulated progress on page start
            this.start();

            // Finish on window load
            var self = this;
            if (document.readyState === 'complete') {
                self.finish();
            } else {
                window.addEventListener('load', function() {
                    self.finish();
                });
            }

            // Listen to internal link clicks
            document.addEventListener('click', function(e) {
                var target = e.target.closest('a');
                if (!target) return;
                var href = target.getAttribute('href');
                if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:') || target.getAttribute('target') === '_blank') {
                    return;
                }
                self.start();
            });
        },

        start: function() {
            if (!this.bar) return;
            this.progress = 20;
            this.bar.style.opacity = '1';
            this.bar.style.transform = 'translateX(-80%)';

            var self = this;
            clearInterval(this.timer);
            this.timer = setInterval(function() {
                if (self.progress < 85) {
                    self.progress += (90 - self.progress) * 0.15;
                    self.bar.style.transform = 'translateX(' + (-100 + self.progress) + '%)';
                }
            }, 120);
        },

        finish: function() {
            if (!this.bar) return;
            clearInterval(this.timer);
            this.progress = 100;
            this.bar.style.transform = 'translateX(0%)';
            var self = this;
            setTimeout(function() {
                self.bar.style.opacity = '0';
                setTimeout(function() {
                    self.bar.style.transform = 'translateX(-100%)';
                }, 400);
            }, 250);
        },

        // Button Loading State
        setBtnLoading: function(btn, customText) {
            if (!btn || btn.classList.contains('elo-btn-loading')) return;
            btn.classList.add('elo-btn-loading');
            btn.setAttribute('data-original-html', btn.innerHTML);
            btn.disabled = true;

            var spinnerSvg = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 inline-block text-current" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>';
            var text = customText || 'Processing...';
            btn.innerHTML = spinnerSvg + '<span>' + text + '</span>';
        },

        resetBtnLoading: function(btn) {
            if (!btn || !btn.classList.contains('elo-btn-loading')) return;
            btn.classList.remove('elo-btn-loading');
            btn.disabled = false;
            var orig = btn.getAttribute('data-original-html');
            if (orig) {
                btn.innerHTML = orig;
            }
        }
    };

    // ─────────────────────────────────────────────────────────────────
    // 2. UNIFIED FORM VALIDATION ENGINE
    // ─────────────────────────────────────────────────────────────────
    var ElocentraValidation = {
        showError: function(input, message) {
            this.clearError(input);
            input.classList.add('is-invalid-input', 'is-invalid');
            
            var err = document.createElement('div');
            err.className = 'elo-field-error';
            err.innerHTML = '<svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg><span>' + message + '</span>';
            
            // If inside relative container or input group, append after parent
            var container = input.closest('.relative') || input;
            if (container.parentNode) {
                container.parentNode.insertBefore(err, container.nextSibling);
            }
        },

        clearError: function(input) {
            input.classList.remove('is-invalid-input', 'is-invalid');
            var container = input.closest('.relative') || input;
            var parent = container.parentNode;
            if (parent) {
                var err = parent.querySelector('.elo-field-error');
                if (err) parent.removeChild(err);
            }
        },

        validateInput: function(input) {
            var val = (input.value || '').trim();
            var isRequired = input.hasAttribute('required');
            var type = (input.getAttribute('type') || '').toLowerCase();
            var name = (input.getAttribute('name') || '').toLowerCase();

            // 1. Required Check
            if (isRequired && val === '') {
                var labelEl = input.closest('div') ? input.closest('div').querySelector('label') : null;
                var labelName = labelEl ? labelEl.innerText.replace('*', '').trim() : 'This field';
                this.showError(input, labelName + ' is required.');
                return false;
            }

            // Skip further format validation if empty and not required
            if (val === '') {
                this.clearError(input);
                return true;
            }

            // 2. Email Validation
            if (type === 'email' || name.includes('email')) {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
                if (!emailRegex.test(val)) {
                    this.showError(input, 'Please enter a valid email address (e.g. name@domain.com).');
                    return false;
                }
            }

            // 3. Phone / WhatsApp Validation
            if (type === 'tel' || name.includes('phone') || name.includes('whatsapp')) {
                var cleanPhone = val.replace(/[\s\-\(\)\+]/g, '');
                if (cleanPhone.length < 9 || !/^\d+$/.test(cleanPhone)) {
                    this.showError(input, 'Please enter a valid phone number (at least 9 digits).');
                    return false;
                }
            }

            // 4. Min Length Check
            var minLength = input.getAttribute('data-min-length') || (type === 'password' && isRequired ? '8' : null);
            if (minLength && val.length < parseInt(minLength, 10)) {
                this.showError(input, 'Must be at least ' + minLength + ' characters.');
                return false;
            }

            // 5. Password Confirmation Match
            if (name.includes('confirm') || input.id.includes('confirm')) {
                var targetId = input.getAttribute('data-match') || (input.id.includes('confirm') ? input.id.replace('confirm_', '') : null);
                var matchInput = targetId ? document.getElementById(targetId) : null;
                if (!matchInput) {
                    var form = input.closest('form');
                    if (form) matchInput = form.querySelector('input[type="password"]:not([id*="confirm"]):not([name*="confirm"])');
                }
                if (matchInput && val !== matchInput.value.trim()) {
                    this.showError(input, 'Passwords do not match.');
                    return false;
                }
            }

            this.clearError(input);
            return true;
        },

        attachForm: function(form) {
            var self = this;
            var inputs = form.querySelectorAll('input:not([type="hidden"]):not([type="submit"]), textarea, select');

            inputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    self.clearError(input);
                });
                input.addEventListener('blur', function() {
                    if (input.value.trim() !== '') {
                        self.validateInput(input);
                    }
                });
            });

            form.addEventListener('submit', function(e) {
                var isValid = true;
                var firstInvalid = null;

                inputs.forEach(function(input) {
                    // Check if input is currently visible
                    if (input.offsetParent === null) return;
                    if (!self.validateInput(input)) {
                        isValid = false;
                        if (!firstInvalid) firstInvalid = input;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    if (firstInvalid) {
                        firstInvalid.focus();
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                } else {
                    // Show loading animation on submit button
                    var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                    if (submitBtn) {
                        var loadingMsg = form.getAttribute('data-loading-text') || 'Please wait...';
                        ElocentraLoader.setBtnLoading(submitBtn, loadingMsg);
                    }
                }
            });
        },

        initAll: function() {
            var self = this;
            document.querySelectorAll('form').forEach(function(form) {
                // Do not re-attach if marked ignore
                if (form.hasAttribute('data-no-auto-validate')) return;
                self.attachForm(form);
            });
        }
    };

    // Expose globally
    window.ElocentraLoader = ElocentraLoader;
    window.ElocentraValidation = ElocentraValidation;

    // Auto initialize on DOMContentLoaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            ElocentraLoader.init();
            ElocentraValidation.initAll();
        });
    } else {
        ElocentraLoader.init();
        ElocentraValidation.initAll();
    }

})(window, document);
