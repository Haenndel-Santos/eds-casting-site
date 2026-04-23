document.addEventListener('DOMContentLoaded', function () {
  const requestType = document.getElementById('request_type');
  const rfqTriggerRow = document.getElementById('rfqTriggerRow');
  const rfqStatus = document.getElementById('rfqStatus');
  const rfqModal = document.getElementById('rfqModal');
  const openRfqModal = document.getElementById('openRfqModal');
  const closeRfqModal = document.getElementById('closeRfqModal');
  const closeRfqModalBackdrop = document.getElementById('closeRfqModalBackdrop');
  const saveRfqDetails = document.getElementById('saveRfqDetails');
  const submitButton = document.getElementById('submitButton');

  const rfqFields = [
    document.getElementById('service'),
    document.getElementById('material'),
    document.getElementById('quantity'),
    document.getElementById('annual_volume'),
    document.getElementById('target_price'),
    document.getElementById('delivery_destination'),
    document.getElementById('attachments')
  ];

  function hasRfqContent() {
    return rfqFields.some((field) => {
      if (!field) return false;

      if (field.type === 'file') {
        return field.files && field.files.length > 0;
      }

      return String(field.value || '').trim() !== '';
    });
  }

  function openModal() {
    if (!rfqModal) return;
    rfqModal.classList.add('open');
    rfqModal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('rfq-modal-open');
  }

  function closeModal() {
    if (!rfqModal) return;
    rfqModal.classList.remove('open');
    rfqModal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('rfq-modal-open');
  }

  function updateRfqStatus() {
    if (!rfqStatus) return;

    if (hasRfqContent()) {
      rfqStatus.style.display = 'block';
    } else {
      rfqStatus.style.display = 'none';
    }
  }

  function toggleRequestTypeUI() {
    const isQuotation = requestType && requestType.value === 'quotation';

    if (rfqTriggerRow) {
      rfqTriggerRow.style.display = isQuotation ? 'block' : 'none';
    }

    if (!isQuotation) {
      closeModal();
      if (rfqStatus) rfqStatus.style.display = 'none';
    }

    if (submitButton) {
      submitButton.textContent = isQuotation ? 'Submit RFQ' : 'Send Message';
    }
  }

  if (requestType) {
    requestType.addEventListener('change', toggleRequestTypeUI);
    toggleRequestTypeUI();
  }

  if (openRfqModal) {
    openRfqModal.addEventListener('click', function () {
      openModal();
    });
  }

  if (closeRfqModal) {
    closeRfqModal.addEventListener('click', function () {
      closeModal();
    });
  }

  if (closeRfqModalBackdrop) {
    closeRfqModalBackdrop.addEventListener('click', function () {
      closeModal();
    });
  }

  if (saveRfqDetails) {
    saveRfqDetails.addEventListener('click', function () {
      updateRfqStatus();
      closeModal();
    });
  }

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && rfqModal && rfqModal.classList.contains('open')) {
      closeModal();
    }
  });

  rfqFields.forEach((field) => {
    if (!field) return;

    field.addEventListener('change', updateRfqStatus);
    field.addEventListener('input', updateRfqStatus);
  });

  updateRfqStatus();
});
