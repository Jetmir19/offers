'use strict';

/**
 * Show Modal
 *
 * @param {Object} options - Options for the modal.
 *    Available options:
 *      - data.headerText (string): The header text for the modal.
 *      - options.iframeUrl (string): The URL to be loaded in an iframe within the modal.
 *      - options.btnActionShow (boolean): Indicates whether the action button should be shown.
 *      - options.btnActionText (string): The text to be displayed on the action button (default: 'Submit').
 *      - options.btnAction (function): A function to be invoked when the action button is clicked.
 *      - options.btnActionDisabled (boolean): Indicates whether the action button should be disabled.
 */
//------------------------------------------------------------
function showIframeModal(options)
//------------------------------------------------------------
{
  console.log(options);

  // Dinamic Action button of the Modal
  let btnAction = `<button type="button" class="btn btn-success px-4" id="action-btn" name="action-btn" ${options.btnActionDisabled ? 'disabled' : ''}> ${options.btnActionText || 'Submit'} </button>`;

  let modalHTML = `
  <div class="modal fade" id="iframeModal" tabindex="-1" aria-labelledby="iframeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="iframeModalLabel">${options.headerText}</h5>
          <button type="button" id="closeModalX" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">
            <iframe id="miframe" name="miframe" src="${options.iframeUrl}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="modal-footer">
            ${options.btnActionShow ? btnAction : ""}
            <button type="button" id="closeModalBtn" class="btn btn-secondary" data-dismiss="modal">Anulo</button>
        </div>
      </div>
    </div>
  </div>`;
  // Inject Modal into the DOM
  document.body.insertAdjacentHTML('afterbegin', modalHTML.trim());

  // Create a new Bootstrap modal object with the specified options
  const modal = $('#iframeModal').modal({
    keyboard: false,
    backdrop: 'static'
  });

  // Show a loading spinner
  isLoading(true);

  // Select Modal iframe elements
  let iframe = document.querySelector("#miframe");
  let action_btn = document.getElementById("action-btn");

  // Handle iframe onload event
  iframe.onload = function () {
    // Check if the URL contain the query parameter 'iframe=true'
    if (!iframe.src.includes('iframe=true')) {
      console.log('URL does not include the query parameter "iframe=true"');
      iframe.contentDocument.body.innerHTML = '<p class="text-center p-3">URL does not include the query parameter "iframe=true"</p>';
      isLoading(false);
    } else {
      // Reset action button
      if (options.btnActionShow && options.btnActionDisabled) {
        action_btn.setAttribute("disabled", true);
      }
      setTimeout(() => {
        // resize Iframe
        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
        // remove spinner
        isLoading(false);
      }, 500);
    }
  }

  // Hide modal - x button on top
  document.getElementById("closeModalX").onclick = function () {
    modal.modal('hide');
  };
  // Hide Modal - button footer
  document.getElementById("closeModalBtn").onclick = function () {
    modal.modal('hide');
  };
  // Handle dinamic action Button
  if (action_btn != null) {
    action_btn.onclick = function () {
      // Invoke callback
      options.btnAction();
    };
  }

  // Show the modal
  modal.modal('show');
  // Update the layout of the modal
  modal.modal('handleUpdate');
  // Listen to the modal's 'shown.bs.modal' event
  modal.on('shown.bs.modal', function () {
    // console.log('Modal shown');
  });
  // Listen to the modal's 'hide.bs.modal' event
  modal.on('hide.bs.modal', function () {
    // console.log('Modal hide');
    // Remove modal from the DOM
    modal.remove();
  });
}

/**
 * Confirm Modal
 *
 * @param {string} headerText - The header text for the modal.
 * @param {string} html - The HTML content to be injected into the modal body.
 * @param {function} callback - A callback function to be invoked when a button is clicked.
 *    The callback function will response with a boolean parameter indicating the button clicked:
 *      - 'po': The "Po" button is clicked.
 *      - false: The "Anulo" button is clicked.
 */
//------------------------------------------------------------
function confirmModal(headerText = "", html = "", callback = null)
//------------------------------------------------------------
{
  let modalHTML = `
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="confirmModalLabel">${headerText}</h5>
        </div>
        <div class="modal-body">
          <!-- Inject html here... -->
          ${html}
        </div>
        <div class="modal-footer">
          <button type="button" id="anuloBtn" class="btn btn-secondary">Anulo</button>
          <button type="button" id="poBtn" class="btn btn-success px-4"> Po </button>
        </div>
      </div>
    </div>
  </div>`;
  // Inject Modal into the DOM
  document.body.insertAdjacentHTML('afterbegin', modalHTML.trim());

  // Create a new Bootstrap modal object with the specified options
  const modal = $('#confirmModal').modal({
    keyboard: false,
    backdrop: 'static'
  });

  // Show a loading spinner
  isLoading(true);

  // Button (Po) clicked
  document.getElementById("poBtn").onclick = function () {
    // return callback ('po' clicked)
    if (callback) {
      callback('po');
      modal.modal('hide');
    }
    // console.log('Button (Po) clicked');
  };

  // Button (Anulo) clicked
  document.getElementById("anuloBtn").onclick = function () {
    // return callback ('anulo' clicked)
    if (callback) {
      callback(false);
    }
    // console.log('Button (Anulo) clicked');
    modal.modal('hide');
  };

  // Show the modal
  modal.modal('show');
  // Update the layout of the modal
  modal.modal('handleUpdate');
  // Listen to the modal's 'shown.bs.modal' event
  modal.on('shown.bs.modal', function () {
    // console.log('Modal shown');
    // remove spinner
    isLoading(false);
  });
  // Listen to the modal's 'hide.bs.modal' event
  modal.on('hide.bs.modal', function () {
    // console.log('Modal hide');
    // Remove modal from the DOM
    modal.remove();
  });
}

//------------------------------------------------------------
function isLoading(show)
//------------------------------------------------------------
{
  let spinnerHTML = `
    <div id="modal-spinner" class="position-absolute top-50 start-50 translate-middle mt-1">
        <div class="modal-spinner-inner">
          <div class="spinner-border" role="status">
              <span class="sr-only visually-hidden">Loading...</span>
          </div>
        </div>
    </div>`;

  const modalBody = document.querySelector('.modal-body');
  const spinner = modalBody.querySelector('#modal-spinner');

  if (show === true) {
    modalBody.insertAdjacentHTML('afterbegin', spinnerHTML);
  } else {
    if (spinner) spinner.remove();
  }
}