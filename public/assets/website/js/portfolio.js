// Inlined from script.js
const nav = document.getElementById('nav');
if (nav) {
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 20);
  }, { passive: true });
}

const hamburger = document.querySelector('.nav__hamburger');
const mobileMenu = document.getElementById('mobile-menu');
const mobileLinks = document.querySelectorAll('.mobile-menu__link, .mobile-menu__dropdown-link, .mobile-menu__cta');

if (hamburger && mobileMenu) {
  const toggleMenu = (open) => {
    hamburger.classList.toggle('open', open);
    mobileMenu.classList.toggle('open', open);
    mobileMenu.setAttribute('aria-hidden', String(!open));
    hamburger.setAttribute('aria-expanded', String(open));
    document.body.style.overflow = open ? 'hidden' : '';
  };

  hamburger.addEventListener('click', () => {
    toggleMenu(!mobileMenu.classList.contains('open'));
  });

  mobileLinks.forEach(link => {
    link.addEventListener('click', () => toggleMenu(false));
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
      toggleMenu(false);
      hamburger.focus();
    }
  });
}

document.querySelectorAll('[data-nav-dropdown] .nav__dropdown-trigger').forEach((trigger) => {
  trigger.addEventListener('mousedown', (e) => {
    if (window.matchMedia('(min-width: 900px)').matches) {
      e.preventDefault();
    }
  });

  trigger.addEventListener('click', (e) => {
    if (window.matchMedia('(min-width: 900px)').matches) {
      e.preventDefault();
      trigger.blur();
    }
  });
});

document.querySelectorAll('[data-mobile-nav-dropdown]').forEach((dropdown) => {
  const trigger = dropdown.querySelector('.mobile-menu__dropdown-trigger');
  const panel = dropdown.querySelector('.mobile-menu__dropdown-panel');
  if (!trigger || !panel) return;

  trigger.addEventListener('click', () => {
    const willOpen = !dropdown.classList.contains('is-open');
    document.querySelectorAll('[data-mobile-nav-dropdown].is-open').forEach((openDropdown) => {
      if (openDropdown === dropdown) return;
      openDropdown.classList.remove('is-open');
      const openTrigger = openDropdown.querySelector('.mobile-menu__dropdown-trigger');
      const openPanel = openDropdown.querySelector('.mobile-menu__dropdown-panel');
      if (openTrigger) openTrigger.setAttribute('aria-expanded', 'false');
      if (openPanel) openPanel.hidden = true;
    });

    dropdown.classList.toggle('is-open', willOpen);
    trigger.setAttribute('aria-expanded', String(willOpen));
    panel.hidden = !willOpen;
  });
});

const revealElements = document.querySelectorAll('.reveal, .reveal--right');
const revealObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const siblings = Array.from(el.parentElement?.children || []);
        const idx = siblings.indexOf(el);
        const delay = idx > 0 ? idx * 80 : 0;
        setTimeout(() => {
          el.classList.add('is-visible');
        }, delay);
        revealObserver.unobserve(el);
      }
    });
  },
  { threshold: 0.12, rootMargin: '0px 0px -60px 0px' }
);

revealElements.forEach(el => revealObserver.observe(el));

const statValues = document.querySelectorAll('.stat-card__value[data-target]');
const easeOutExpo = (t) => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t));

const animateCounter = (el) => {
  const target = parseInt(el.dataset.target, 10);
  const duration = 1400;
  const start = performance.now();

  const tick = (now) => {
    const elapsed = now - start;
    const progress = Math.min(elapsed / duration, 1);
    const eased = easeOutExpo(progress);
    el.textContent = Math.round(eased * target);
    if (progress < 1) requestAnimationFrame(tick);
    else el.textContent = target;
  };

  requestAnimationFrame(tick);
};

const counterObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterObserver.unobserve(entry.target);
      }
    });
  },
  { threshold: 0.5 }
);

statValues.forEach(el => counterObserver.observe(el));

document.querySelectorAll('.video-card__thumb').forEach(thumb => {
  thumb.addEventListener('click', () => {
    const card = thumb.closest('.video-card');
    const link = card?.querySelector('a[href]');
    if (link) window.open(link.href, '_blank', 'noopener,noreferrer');
  });
  thumb.setAttribute('role', 'button');
  thumb.setAttribute('tabindex', '0');
  thumb.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      thumb.click();
    }
  });
});

/** Homepage: sync active nav with URL hash (#about, #faq, …). Route-based active state comes from PHP. */
(() => {
  if (!document.body.hasAttribute('data-nav-hash-root')) return;

  const HASH_KEYS = ['about', 'faq', 'policies', 'contact'];

  const syncNavFromHash = () => {
    const raw = window.location.hash.replace(/^#/, '');
    const section = HASH_KEYS.includes(raw) ? raw : '';

    document.querySelectorAll('[data-nav-key]').forEach((el) => {
      const key = el.dataset.navKey || '';
      let active = false;
      if (key === 'home') {
        active = !section;
      } else if (HASH_KEYS.includes(key)) {
        active = key === section;
      }

      el.classList.toggle('nav__link--active', active && el.classList.contains('nav__link'));
      el.classList.toggle('mobile-menu__link--active', active && el.classList.contains('mobile-menu__link'));
    });

    document.querySelectorAll('[data-nav-key]').forEach((el) => el.removeAttribute('aria-current'));
    document
      .querySelectorAll('.nav__link--active[data-nav-key], .mobile-menu__link--active[data-nav-key]')
      .forEach((el) => el.setAttribute('aria-current', 'page'));
  };

  window.addEventListener('hashchange', syncNavFromHash);
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', syncNavFromHash, { once: true });
  } else {
    syncNavFromHash();
  }
})();

/** FAQ page: keep a single accordion item open at a time (matches comp UX). */
(() => {
  const wrap = document.querySelector('.faq-accordion-wrap');
  if (!wrap) return;
  wrap.querySelectorAll('details.faq-accordion').forEach((det) => {
    det.addEventListener('toggle', () => {
      if (!det.open) return;
      wrap.querySelectorAll('details.faq-accordion').forEach((other) => {
        if (other !== det) other.removeAttribute('open');
      });
    });
  });
})();

/** Services page: tab panels per service card */
(() => {
  document.querySelectorAll('[data-service-tab-card]').forEach((card) => {
    const tabs = card.querySelectorAll('[data-service-tab]');
    const panels = card.querySelectorAll('[data-service-panel]');
    if (!tabs.length || !panels.length) return;

    const activate = (id) => {
      tabs.forEach((tab) => {
        const on = tab.dataset.serviceTab === id;
        tab.classList.toggle('is-active', on);
        tab.setAttribute('aria-selected', on ? 'true' : 'false');
      });
      panels.forEach((panel) => {
        const on = panel.dataset.servicePanel === id;
        panel.classList.toggle('is-active', on);
        if (on) panel.removeAttribute('hidden');
        else panel.setAttribute('hidden', '');
      });
      window.requestAnimationFrame(() => window.dispatchEvent(new Event('resize')));
    };

    tabs.forEach((tab) => {
      tab.addEventListener('click', () => activate(tab.dataset.serviceTab));
    });
  });
})();