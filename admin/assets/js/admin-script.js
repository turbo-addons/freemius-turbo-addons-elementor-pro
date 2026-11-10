/**
 * Turbo Addons Pro — Admin Dashboard Script
 * Mirrors the free plugin's admin-script.js but targets taep- prefixed elements.
 */

jQuery(document).ready(function ($) {

    // ---- Tab switching ----
    $('.taep-tab-link').on('click', function (e) {
        e.preventDefault();

        $('.taep-tab-link').removeClass('active');
        $('.taep-tab-content').removeClass('active');

        $(this).addClass('active');
        $('#' + $(this).data('tab')).addClass('active');

        // Keep all hidden current_tab inputs in sync
        $('input[name="current_tab"]').val($(this).data('tab'));
    });

    // Restore active tab on page load (after form save)
    var savedTab = $('input[name="current_tab"]').first().val();
    if (savedTab && savedTab !== '') {
        $('.taep-tab-link').removeClass('active');
        $('.taep-tab-content').removeClass('active');
        $('.taep-tab-link[data-tab="' + savedTab + '"]').addClass('active');
        $('#' + savedTab).addClass('active');
    }

    // ---- Alert dismiss ----
    $('.taep-alert-dismiss-button').on('click', function () {
        $(this).closest('.taep-alert-updated-div').fadeOut();
    });

    // ---- Admin menu icon class ----
    $('#adminmenu .toplevel_page_turbo_addons_pro .wp-menu-image img').addClass('taep-turbo-addon-pro-admin-dashboard-icon');

});


// ---- Widget category scroll-filter tabs (Free + Pro share same logic) ----
document.addEventListener('DOMContentLoaded', function () {

    // Helper: init a filter tab group
    function initFilterTabs(tabListSelector, tabContentSelector, offset) {
        var tabs        = document.querySelectorAll(tabListSelector);
        var tabContents = document.querySelectorAll(tabContentSelector);

        if (!tabs.length) return;

        // Show all sections by default (scroll-based navigation)
        tabContents.forEach(function (content) {
            content.style.display = 'block';
        });

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                var targetId      = tab.getAttribute('data-tab');
                var targetContent = document.getElementById(targetId);

                tabs.forEach(function (t) { t.classList.remove('active'); });
                tab.classList.add('active');

                if (targetContent) {
                    var scrollOffset = targetContent.getBoundingClientRect().top + window.scrollY - (offset || 140);
                    window.scrollTo({ top: scrollOffset, behavior: 'smooth' });
                }
            });
        });
    }

    // Free widgets tab
    initFilterTabs(
        '.taep-widget-tabs-list .taep-widget-filter-tab-item',
        '.taep-widget-tabs-content .taep-widget-tab-content',
        140
    );

});


// ---- Select All — Free widgets ----
document.addEventListener('DOMContentLoaded', function () {
    var selectAll        = document.getElementById('taep-select-all-free-widgets');
    var widgetCheckboxes = document.querySelectorAll('.taep-widget-checkbox');

    if (!selectAll || !widgetCheckboxes.length) return;

    function updateSelectAll() {
        selectAll.checked = Array.from(widgetCheckboxes).every(function (cb) { return cb.checked; });
    }

    function toggleAll(state) {
        widgetCheckboxes.forEach(function (cb) { cb.checked = state; });
    }

    updateSelectAll();

    selectAll.addEventListener('change', function () { toggleAll(selectAll.checked); });
    widgetCheckboxes.forEach(function (cb) { cb.addEventListener('change', updateSelectAll); });
});


// ---- Select All — Pro widgets ----
document.addEventListener('DOMContentLoaded', function () {
    var selectAll        = document.getElementById('taep-select-all-pro-widgets');
    var widgetCheckboxes = document.querySelectorAll('.taep-pro-widget-checkbox');

    if (!selectAll || !widgetCheckboxes.length) return;

    function updateSelectAll() {
        selectAll.checked = Array.from(widgetCheckboxes).every(function (cb) { return cb.checked; });
    }

    function toggleAll(state) {
        widgetCheckboxes.forEach(function (cb) { cb.checked = state; });
    }

    updateSelectAll();

    selectAll.addEventListener('change', function () { toggleAll(selectAll.checked); });
    widgetCheckboxes.forEach(function (cb) { cb.addEventListener('change', updateSelectAll); });
});


// ---- Select All — Extensions ----
document.addEventListener('DOMContentLoaded', function () {
    var selectAll  = document.getElementById('taep-select-all-extensions');
    var extBoxes   = document.querySelectorAll('.taep-extension-checkbox');

    if (!selectAll || !extBoxes.length) return;

    function updateSelectAll() {
        selectAll.checked = Array.from(extBoxes).every(function (cb) { return cb.checked; });
    }

    function toggleAll(state) {
        extBoxes.forEach(function (cb) { cb.checked = state; });
    }

    updateSelectAll();

    selectAll.addEventListener('change', function () { toggleAll(selectAll.checked); });
    extBoxes.forEach(function (cb) { cb.addEventListener('change', updateSelectAll); });
});


/* ============================================================
   Realtime Latest Template Polling
   - Polls the AJAX endpoint every 30 seconds
   - Compares template name with what's currently shown
   - If different → smoothly updates the card in place (no reload)
   ============================================================ */
/* ============================================================
   "Templates Added" slider — dot navigation, auto-advance and a
   live poll (every 30 s) that rebuilds the slider when the API
   returns a different list. Data shape (window.taepTemplates and
   the AJAX response): [{ title, desc, category, type, is_pro, link, thumb }]
   @since 1.9.6 (the old poll expected a single { name } object and never updated)
   ============================================================ */
(function ($) {
    'use strict';

    var card = document.getElementById('taep-template-card');
    if ( ! card ) return;

    var AUTO_DELAY    = 4000;  // 4 s auto-advance
    var POLL_INTERVAL = 30000; // 30 s
    var templates     = window.taepTemplates || [];
    var currentIdx    = 0;
    var autoTimer     = null;

    function $id( id ) { return document.getElementById( id ); }
    function capitalize( str ) { return str ? str.charAt(0).toUpperCase() + str.slice(1) : ''; }
    function escHtml( str ) {
        var d = document.createElement('div');
        d.textContent = str == null ? '' : String( str );
        return d.innerHTML;
    }
    function defaultDesc( title ) {
        return 'A brand-new "' + ( title || '' ) + '" template is now available. Import it in one click and go live faster.';
    }
    function signature( list ) {
        return ( list || [] ).map(function ( t ) { return t.title + '|' + t.thumb; }).join('||');
    }

    function goTo( idx ) {
        if ( ! templates.length ) return;
        if ( idx < 0 ) idx = templates.length - 1;
        if ( idx >= templates.length ) idx = 0;

        document.querySelectorAll('#taep-tpl-slides .taep-tpl-slide').forEach(function ( s, i ) {
            s.classList.toggle('active', i === idx);
        });
        document.querySelectorAll('#taep-tpl-dots .taep-tpl-dot').forEach(function ( d, i ) {
            d.classList.toggle('active', i === idx);
        });

        var tpl = templates[ idx ];
        var nameEl = $id('taep-tpl-name'), descEl = $id('taep-tpl-desc'), catEl = $id('taep-tpl-category'),
            typeEl = $id('taep-tpl-type'), prevEl = $id('taep-tpl-preview-btn'), curEl = $id('taep-tpl-current');
        if ( nameEl ) nameEl.textContent = tpl.title || '';
        if ( descEl ) descEl.textContent = tpl.desc || defaultDesc( tpl.title );
        if ( catEl )  catEl.textContent  = capitalize( tpl.category );
        if ( typeEl ) typeEl.textContent = capitalize( tpl.type );
        if ( prevEl ) prevEl.href        = tpl.link || '#';
        if ( curEl )  curEl.textContent  = idx + 1;

        currentIdx = idx;
    }

    function startAuto() {
        clearInterval( autoTimer );
        if ( templates.length > 1 ) {
            autoTimer = setInterval(function () { goTo( currentIdx + 1 ); }, AUTO_DELAY);
        }
    }

    // Rebuild slides, dots and counter from a new list.
    function rebuild( list ) {
        templates = list;
        window.taepTemplates = list;

        var slidesEl = $id('taep-tpl-slides');
        if ( slidesEl ) {
            slidesEl.innerHTML = list.map(function ( t, i ) {
                return '<div class="taep-tpl-slide' + ( i === 0 ? ' active' : '' ) + '" data-index="' + i + '">' +
                    '<img src="' + escHtml( t.thumb ) + '" alt="' + escHtml( t.title ) + '" class="taep-tpl-slide-img">' +
                    '<span class="taep-template-pro-badge">' + ( t.is_pro ? 'PRO' : 'FREE' ) + '</span>' +
                    '</div>';
            }).join('');
        }
        var dotsEl = $id('taep-tpl-dots');
        if ( dotsEl ) {
            dotsEl.innerHTML = list.map(function ( t, i ) {
                return '<button class="taep-tpl-dot' + ( i === 0 ? ' active' : '' ) + '" data-index="' + i + '" aria-label="' + escHtml( t.title ) + '"></button>';
            }).join('');
            dotsEl.style.display = list.length > 1 ? '' : 'none';
        }
        var counterEl = $id('taep-tpl-counter'), totalEl = $id('taep-tpl-total');
        if ( counterEl ) counterEl.style.display = list.length > 1 ? '' : 'none';
        if ( totalEl ) totalEl.textContent = list.length;

        goTo( 0 );
        startAuto();
        card.classList.add('taep-card-updated');
        setTimeout(function () { card.classList.remove('taep-card-updated'); }, 1200);
    }

    // Dot click (delegated, so rebuilt dots keep working).
    document.addEventListener('click', function ( e ) {
        var dot = e.target.closest ? e.target.closest('#taep-tpl-dots .taep-tpl-dot') : null;
        if ( ! dot ) return;
        goTo( parseInt( dot.getAttribute('data-index'), 10 ) );
        startAuto();
    });

    function poll() {
        if ( typeof taepAdmin === 'undefined' ) return;
        $.ajax({
            url:      taepAdmin.ajaxUrl,
            type:     'POST',
            dataType: 'json',
            data:     { action: 'taep_fetch_latest_template', nonce: taepAdmin.nonce },
            success:  function ( response ) {
                if ( response && response.success && Array.isArray( response.data ) && response.data.length &&
                     signature( response.data ) !== signature( templates ) ) {
                    rebuild( response.data );
                }
            }
            // Errors are ignored; the next poll retries.
        });
    }

    startAuto();
    setTimeout(function () {
        poll();
        setInterval( poll, POLL_INTERVAL );
    }, 5000);
}(jQuery));


/* ============================================================
   "How to Use" button — smooth scroll to video section
   ============================================================ */
document.addEventListener('DOMContentLoaded', function () {
    var btn     = document.querySelector('.taep-scroll-to-video');
    var target  = document.getElementById('watch-guide-video');
    if ( ! btn || ! target ) return;

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        var offset     = 80; // account for sticky WP admin bar
        var targetTop  = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top: targetTop, behavior: 'smooth' });
    });
});
