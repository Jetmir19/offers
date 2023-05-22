'use strict';

/**
 * Show Modal
 *
 * @param {Object} options - Options for the modal.
 *    Available options:
 *      - options.btnActionDisabled (boolean): Indicates whether the action button should be disabled.
 *      - options.btnActionText (string): The text to be displayed on the action button.
 *      - data.headerText (string): The header text for the modal.
 *      - options.iframePath (string): The URL to be loaded in an iframe within the modal.
 *      - options.btnActionShow (boolean): Indicates whether the action button should be shown.
 *      - options.btnAction (function): A function to be invoked when the action button is clicked.
 */
//------------------------------------------------------------
function showIframeModal(options)
//------------------------------------------------------------
{
  console.log(options);

  // Dinamic Action button of the Modal
  let btnAction = `<button type="button" class="btn btn-success px-4" id="action-btn" name="action-btn" ${options.btnActionDisabled ? 'disabled' : ''}> ${options.btnActionText} </button>`;

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
            <iframe id="miframe" name="miframe" src="${options.iframePath}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="modal-footer">
            ${options.btnActionShow ? btnAction : ""}
            <button type="button" id="closeModalBtn" class="btn btn-secondary" data-dismiss="modal">Anulo</button>
        </div>
      </div>
    </div>
  </div>`;
  // Inject Modal into the DOM
  document.getElementById("modal-container").innerHTML = modalHTML;

  // Create a new Bootstrap modal object with the specified options
  const modal = $('#iframeModal').modal({
    keyboard: false,
    backdrop: 'static'
  });

  // Select Modal iframe elements
  let iframe = document.querySelector("#miframe");
  let modalSpinner = document.querySelector('#modal-spinner');
  let action_btn = document.getElementById("action-btn");
  // Handle iframe onload event
  iframe.onload = function () {
    // Reset action button
    if (options.btnActionShow && options.btnActionDisabled) {
      action_btn.setAttribute("disabled", true);
    }
    setTimeout(() => {
      // resize Iframe
      iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
      // remove spinner
      if (modalSpinner != null) {
        modalSpinner.remove();
      }
    }, 500);
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
 *      - true: The "Po" button is clicked.
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
          <button type="button" id="closeConfirmModal" class="btn btn-secondary">Anulo</button>
          <button type="button" id="poBtn" class="btn btn-success"> Po </button>
        </div>
      </div>
    </div>
  </div>`;
  // Inject Modal into the DOM
  document.getElementById("modal-container").innerHTML = modalHTML;

  // Create a new Bootstrap modal object with the specified options
  const modal = $('#confirmModal').modal({
    keyboard: false,
    backdrop: 'static'
  });

  // Button (Po) clicked
  document.getElementById("poBtn").onclick = function () {
    // return callback ('po' clicked)
    callback(true);
    modal.modal('hide');
  };

  // Button (Anulo) clicked
  document.getElementById("closeConfirmModal").onclick = function () {
    // return callback ('anulo' clicked)
    callback(false);
    modal.modal('hide');
  };

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