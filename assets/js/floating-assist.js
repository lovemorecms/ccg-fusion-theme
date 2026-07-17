/**
 * Global scroll-to-top and CMS Assistant interactions.
 */
(function () {
  'use strict';

  var dock = document.querySelector('[data-fusion-float-dock]');
  if (!dock) return;

  var scrollTopButton = dock.querySelector('[data-fusion-scroll-top]');
  var chatToggle = dock.querySelector('[data-fusion-chat-toggle]');
  var chatPanel = dock.querySelector('[data-fusion-chat-panel]');
  var chatClose = dock.querySelector('[data-fusion-chat-close]');
  var chatRestart = dock.querySelector('[data-fusion-chat-restart]');
  var chatMessages = dock.querySelector('[data-fusion-chat-messages]');
  var chatForm = dock.querySelector('[data-fusion-chat-form]');
  var chatInput = dock.querySelector('[data-fusion-chat-input]');
  var welcome =
    "Hi! I'm here to help you with questions about CMS Hybrid Cloud. What would you like to know?";
  var stubReply =
    'Thanks for your message. Full CMS Assistant responses will be available in a future update.';

  function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  }

  function syncScrollTop() {
    if (!scrollTopButton) return;
    scrollTopButton.hidden = window.scrollY <= 360;
  }

  function setChatOpen(open, restoreFocus) {
    if (!chatPanel || !chatToggle) return;

    chatPanel.hidden = !open;
    chatToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    chatToggle.setAttribute('aria-label', open ? 'Close CMS Assistant' : 'Open CMS Assistant');

    if (open && chatInput) {
      window.setTimeout(function () {
        chatInput.focus();
      }, 0);
    } else if (restoreFocus) {
      chatToggle.focus();
    }
  }

  function appendMessage(text, role) {
    if (!chatMessages) return;

    var bubble = document.createElement('div');
    bubble.className =
      'fusion-chat-panel__bubble fusion-chat-panel__bubble--' + role;
    bubble.textContent = text;
    chatMessages.appendChild(bubble);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function resetChat() {
    if (!chatMessages) return;

    chatMessages.replaceChildren();
    appendMessage(welcome, 'assistant');
    if (chatInput) {
      chatInput.value = '';
      chatInput.focus();
    }
  }

  syncScrollTop();
  window.addEventListener('scroll', syncScrollTop, { passive: true });

  if (scrollTopButton) {
    scrollTopButton.addEventListener('click', function () {
      window.scrollTo({
        top: 0,
        behavior: prefersReducedMotion() ? 'auto' : 'smooth'
      });
    });
  }

  if (chatToggle) {
    chatToggle.addEventListener('click', function () {
      setChatOpen(chatToggle.getAttribute('aria-expanded') !== 'true', false);
    });
  }

  if (chatClose) {
    chatClose.addEventListener('click', function () {
      setChatOpen(false, true);
    });
  }

  if (chatRestart) {
    chatRestart.addEventListener('click', resetChat);
  }

  if (chatForm) {
    chatForm.addEventListener('submit', function (event) {
      event.preventDefault();
      if (!chatInput) return;

      var text = chatInput.value.trim();
      if (!text) return;

      appendMessage(text, 'user');
      chatInput.value = '';
      chatInput.focus();

      window.setTimeout(function () {
        appendMessage(stubReply, 'assistant');
      }, 450);
    });
  }

  document.addEventListener('keydown', function (event) {
    if (
      event.key === 'Escape' &&
      chatPanel &&
      !chatPanel.hidden
    ) {
      setChatOpen(false, true);
    }
  });
})();
