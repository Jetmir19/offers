'use strict';

//------------------------------------------------------------
function showModal(data = [])
//------------------------------------------------------------
{
  console.log(data);

  // Dinamic Action button of the Modal
  let btnShow = `<button type="button" class="btn btn-success px-4" id="action-btn" name="action-btn" value="submit" ${data.btnActionDisabled ? 'disabled' : ''}> ${data.btnActionText} </button>`;

  let modalHTML = `
  <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="dataModalLabel">${data.header}</h5>
          <button type="button" id="closeModalX" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">
            <iframe id="miframe" name="miframe" src="${data.fullPath}" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="modal-footer">
            ${data.btnActionShow ? btnShow : ""}
            <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Anulo</button>
        </div>
      </div>
    </div>
  </div>`;

  // Inject Modal into the DOM
  document.getElementById("modal-container").innerHTML = modalHTML;

  let iframe = document.querySelector("#miframe");
  let modalSpinner = document.querySelector('#modal-spinner');
  let action_btn = document.getElementById("action-btn");

  iframe.onload = function () {
    // Reset action button
    if (data.btnActionShow && data.btnActionDisabled) {
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

  // Remove modal from the DOM - x button on top
  document.getElementById("closeModalX").onclick = function () {
    // $("#dataModal").modal('hide');
    document.getElementById("dataModal").remove();
  };
  // Remove Modal from the DOM - button footer
  document.getElementById("closeModal").onclick = function () {
    document.getElementById("dataModal").remove();
  };
  // Handle dinamic action Button
  if (action_btn != null) {
    action_btn.onclick = function () {
      // Invoke function from the data object
      data.btnAction();
    };
  }
}

//------------------------------------------------------------
function confirmModal(header = "", html, callback)
//------------------------------------------------------------
{
  // console.log(callback);
  let modalHTML = `
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="confirmModalLabel">${header}</h5>
        </div>
        <div class="modal-body">
          <!-- Inject html here... -->
          ${html}
        </div>
        <div class="modal-footer">
          <button type="button" id="closeConfirmModal" class="btn btn-secondary" data-dismiss="modal">Anulo</button>
          <button type="button" id="poBtn" class="btn btn-success"> Po </button>
        </div>
      </div>
    </div>
  </div>`;

  // Inject Modal into the DOM
  document.getElementById("modal-container").innerHTML = modalHTML;

  // Button (Po) clicked
  document.getElementById("poBtn").onclick = function () {
    // return callback ('po' clicked)
    callback(true);
    // Hide modal
    $('#confirmModal').modal('hide');
    // Remove Modal from the DOM
    document.getElementById("confirmModal").remove();
  };

  // Button (Anulo) clicked
  document.getElementById("closeConfirmModal").onclick = function () {
    // return callback ('anulo' clicked)
    callback(false);
    // Hide modal
    $('#confirmModal').modal('hide');
    // Remove Modal from the DOM
    document.getElementById("confirmModal").remove();
  };

}