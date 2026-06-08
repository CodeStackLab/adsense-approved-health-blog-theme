/* Theme JS for Health Beyond Age */
(function() {
  'use strict';

  // Mobile nav toggle
  document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navLinks  = document.querySelector('.nav-links');
    if (hamburger && navLinks) {
      hamburger.addEventListener('click', function() {
        navLinks.classList.toggle('open');
      });
    }

    // Carousel functionality
    initCarousel();

    // Filter tags
    initFilterTags();

    // Period tabs (trending)
    initPeriodTabs();

    // Share buttons
    initShareButtons();

    // Smooth scroll for TOC links
    initTOCLinks();

    // Fade-up animation on scroll
    initFadeUp();
  });

  function initCarousel() {
    const carousel = document.querySelector('.topic-carousel');
    if (!carousel) return;
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    const dots    = document.querySelectorAll('.carousel-dot');
    const cardWidth = carousel.querySelector('.topic-card') ? carousel.querySelector('.topic-card').offsetWidth + 16 : 176;
    let   currentPage = 0;
    const visibleCards = Math.floor(carousel.offsetWidth / cardWidth);
    const totalCards   = carousel.querySelectorAll('.topic-card').length;
    const totalPages   = Math.max(1, Math.ceil(totalCards / visibleCards));

    function scrollTo(page) {
      currentPage = Math.max(0, Math.min(page, totalPages - 1));
      carousel.scrollLeft = currentPage * visibleCards * cardWidth;
      dots.forEach((d, i) => d.classList.toggle('active', i === currentPage));
    }
    if (prevBtn) prevBtn.addEventListener('click', function() { scrollTo(currentPage - 1); });
    if (nextBtn) nextBtn.addEventListener('click', function() { scrollTo(currentPage + 1); });
    dots.forEach(function(dot, i) { dot.addEventListener('click', function() { scrollTo(i); }); });
  }

  function initFilterTags() {
    const tags = document.querySelectorAll('.filter-tags .tag');
    tags.forEach(function(tag) {
      tag.addEventListener('click', function() {
        tags.forEach(function(t) { t.classList.remove('active'); });
        tag.classList.add('active');
      });
    });
  }

  function initPeriodTabs() {
    const tabs = document.querySelectorAll('.period-tab');
    tabs.forEach(function(tab) {
      tab.addEventListener('click', function() {
        tabs.forEach(function(t) { t.classList.remove('active'); });
        tab.classList.add('active');
      });
    });
  }

  function initShareButtons() {
    const shareContainer = document.querySelector('.share-bar');
    if (!shareContainer) return;
    const url   = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(document.title);

    shareContainer.addEventListener('click', function(e) {
      const btn = e.target.closest('.share-btn');
      if (!btn) return;
      const text = btn.textContent.trim();
      let   link = '';
      if (text.includes('Facebook')) link = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
      else if (text.includes('Twitter') || text.includes('𝕏')) link = 'https://twitter.com/intent/tweet?url=' + url + '&text=' + title;
      else if (text.includes('Copy')) {
        navigator.clipboard.writeText(window.location.href).then(function() {
          const orig = btn.textContent;
          btn.textContent = '✓ Copied!';
          setTimeout(function() { btn.textContent = orig; }, 2000);
        });
        return;
      } else if (text.includes('Email')) {
        link = 'mailto:?subject=' + title + '&body=' + url;
        window.location.href = link;
        return;
      }
      if (link) window.open(link, '_blank', 'width=600,height=400');
    });
  }

  function initTOCLinks() {
    const tocLinks = document.querySelectorAll('.toc-list a');
    tocLinks.forEach(function(link) {
      link.addEventListener('click', function(e) {
        const href = link.getAttribute('href');
        if (href && href !== '#' && href.startsWith('#')) {
          e.preventDefault();
          const target = document.getElementById(href.slice(1));
          if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        }
      });
    });
  }

  function initFadeUp() {
    if (!('IntersectionObserver' in window)) return;
    const items = document.querySelectorAll('.art-card, .art-list-item, .featured-longread, .trend-item, .trend-main');
    const io = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('fade-up');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    items.forEach(function(item) { io.observe(item); });
  }
})();
