(function () {
  const allowedEvents = new Set([
    'commercial_cta_click',
    'commercial_overlay_open',
    'internal_strategy_link_click',
    'contact_category_selected',
    'rfq_option_selected',
    'file_upload_selected',
    'contact_form_submit_attempt',
    'contact_form_error',
    'contact_form_success',
    'email_click',
    'phone_click',
    'external_link_click'
  ]);

  function hasDataLayer() {
    return Array.isArray(window.dataLayer);
  }

  function getCampaignParams() {
    const allowed = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid'];
    const params = new URLSearchParams(window.location.search);
    const campaign = {};

    allowed.forEach(function (key) {
      const value = params.get(key);
      if (value) {
        campaign[key] = value;
        try {
          window.sessionStorage.setItem('eds_' + key, value);
        } catch (error) {
          /* sessionStorage may be unavailable; tracking must stay passive. */
        }
      } else {
        try {
          const storedValue = window.sessionStorage.getItem('eds_' + key);
          if (storedValue) campaign[key] = storedValue;
        } catch (error) {
          /* sessionStorage may be unavailable; tracking must stay passive. */
        }
      }
    });

    return campaign;
  }

  function cleanValue(value) {
    return String(value || '').trim().replace(/[^a-zA-Z0-9_:/#.@+-]/g, '_').slice(0, 160);
  }

  function pushEvent(eventName, payload) {
    if (!allowedEvents.has(eventName) || !hasDataLayer()) return;

    const eventPayload = { event: eventName };
    Object.keys(payload || {}).forEach(function (key) {
      const value = cleanValue(payload[key]);
      if (value !== '') eventPayload[key] = value;
    });

    const campaignParams = getCampaignParams();
    Object.keys(campaignParams).forEach(function (key) {
      const value = cleanValue(campaignParams[key]);
      if (value !== '') eventPayload[key] = value;
    });

    window.dataLayer.push(eventPayload);
  }

  function safeLinkUrl(rawUrl) {
    const value = String(rawUrl || '').trim();
    if (value === '') return '';
    if (value.indexOf('mailto:') === 0 || value.indexOf('tel:') === 0) return value;

    try {
      const url = new URL(value, window.location.origin);
      if (url.origin !== window.location.origin) return url.origin + url.pathname;
      return url.pathname + url.hash;
    } catch (error) {
      return '';
    }
  }

  function getLinkText(element) {
    return String(element.textContent || element.getAttribute('aria-label') || '').replace(/\s+/g, ' ').trim();
  }

  function getTrackPayload(element) {
    return {
      event_label: element.getAttribute('data-eds-label') || element.getAttribute('aria-label') || '',
      event_category: element.getAttribute('data-eds-category') || '',
      link_url: safeLinkUrl(element.getAttribute('href') || ''),
      page_path: window.location.pathname
    };
  }

  function closestElement(target, selector) {
    if (!target) return null;
    const element = target.closest ? target : target.parentElement;
    return element && element.closest ? element.closest(selector) : null;
  }

  document.addEventListener('click', function (event) {
    const tracked = closestElement(event.target, '[data-eds-track]');
    if (tracked) {
      pushEvent(tracked.getAttribute('data-eds-event') || 'commercial_cta_click', getTrackPayload(tracked));
    }

    const link = closestElement(event.target, 'a[href]');
    if (link) {
      const href = String(link.getAttribute('href') || '').trim();
      const payload = {
        link_url: safeLinkUrl(href),
        link_text: getLinkText(link),
        page_path: window.location.pathname
      };

      if (href.indexOf('mailto:') === 0) {
        pushEvent('email_click', payload);
      } else if (href.indexOf('tel:') === 0) {
        pushEvent('phone_click', payload);
      } else {
        try {
          const url = new URL(href, window.location.origin);
          if (url.origin !== window.location.origin) {
            pushEvent('external_link_click', payload);
          }
        } catch (error) {
          /* Invalid or unsupported href; leave normal browser behavior alone. */
        }
      }
    }

    const overlayTrigger = closestElement(event.target, '[data-eds-modal-open]');
    if (overlayTrigger) {
      pushEvent('commercial_overlay_open', {
        event_label: overlayTrigger.getAttribute('data-eds-label') || overlayTrigger.getAttribute('data-eds-modal-open'),
        event_category: overlayTrigger.getAttribute('data-eds-category') || 'commercial_overlay',
        page_path: window.location.pathname
      });
    }
  });

  document.addEventListener('change', function (event) {
    const target = event.target;

    if (target && target.id === 'challenge_category') {
      pushEvent('contact_category_selected', {
        event_label: target.value,
        event_category: 'contact_form',
        page_path: window.location.pathname
      });
    }

    if (target && target.id === 'request_type' && target.value === 'quotation') {
      pushEvent('rfq_option_selected', {
        event_label: 'request_type_quotation',
        event_category: 'contact_form',
        page_path: window.location.pathname
      });
    }

    if (target && target.type === 'file' && target.files && target.files.length > 0) {
      pushEvent('file_upload_selected', {
        event_label: 'attachments_selected',
        event_category: 'contact_form',
        file_count: String(target.files.length),
        page_path: window.location.pathname
      });
    }
  });

  document.addEventListener('submit', function (event) {
    const form = closestElement(event.target, 'form');
    if (!form || !form.classList.contains('form-lead')) return;

    pushEvent('contact_form_submit_attempt', {
      event_label: form.getAttribute('action') || 'contact_form',
      event_category: 'contact_form',
      page_path: window.location.pathname
    });
  }, true);

  document.addEventListener('invalid', function (event) {
    const field = event.target;
    if (!field || !field.form || !field.form.classList.contains('form-lead')) return;

    pushEvent('contact_form_error', {
      event_label: field.name || field.id || 'field_invalid',
      event_category: 'contact_form_validation',
      page_path: window.location.pathname
    });
  }, true);

  if (window.location.pathname === '/contact' && new URLSearchParams(window.location.search).get('sent') === '1') {
    pushEvent('contact_form_success', {
      event_label: 'contact_sent_redirect',
      event_category: 'contact_form',
      page_path: window.location.pathname
    });
  }
})();
