
// ----------------------------------
//     jQueryModal for Zhivina
// ----------------------------------

// // < !--HTML buttons-- >
// <button class="i-modal" data-someId="20">Open Modal 1</button>
// <button class="i-modal" data-someId="30">Open Modal 2</button>
// <button class="i-modal" data-someId="40">Open Modal 3</button>

// // <!--HTML modal-- >
//     <div class="modal" id="myModal">
//         <div class="modal-dialog">
//             <div class="modal-content">
//                 <!-- Modal content -->
//                 <div class="modal-header">
//                     <h5 class="modal-title">Modal Title</h5>
//                     <button type="button" class="close" data-dismiss="modal">&times;</button>
//                 </div>
//                 <div class="modal-body">
//                     <p>Modal body text goes here.</p>
//                 </div>
//             </div>
//         </div>
//     </div>


// jQuery - Function to open the modal

function openModal(options) {
    // Retrieve the data attributes from the options object
    var someId = options.someId;

    // Create a new Bootstrap modal object with the specified options
    var modal = $('#myModal').modal(options.modalOptions);

    // Update the modal content based on the data attribute value
    var modalBody = modal.find('.modal-body');
    modalBody.text('Some ID: ' + someId);

    // Show the modal
    modal.modal('show');

    // Update the layout of the modal
    modal.modal('handleUpdate');

    // Listen to the modal's 'shown.bs.modal' event
    modal.on('shown.bs.modal', function () {
        // Handle the modal shown event
        console.log('Modal shown');
    });

    // Listen to the modal's 'hide.bs.modal' event
    modal.on('hide.bs.modal', function () {
        // Handle the modal hide event
        console.log('Modal hide');
    });
}


// JavaScript - Usage:

// Get the button elements
var buttons = document.querySelectorAll('.i-modal');

// Attach a click event listener to each button
buttons.forEach(function (button) {
    button.addEventListener('click', function () {
        // Retrieve the data attribute values from the button
        var someId = button.getAttribute('data-someId');

        // Example usage: open the modal with options and data
        var options = {
            modalOptions: {
                keyboard: false
            },
            someId: someId
        };

        openModal(options);
    });
});







// ----------------------------------
// - ajax requests with fetch api-----
//     ----------------------------------

// GET
fetch('https://api.example.com/data', {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
    }
})
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // Handle the response data
        console.log(data);
    })
    .catch(error => {
        // Handle the error
        console.error('Error:', error.message);
    });


// POST
fetch('https://api.example.com/data', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ key: 'value' })
})
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // Handle the response data
        console.log(data);
    })
    .catch(error => {
        // Handle the error
        console.error('Error:', error.message);
    });

// ----------------------------------
// // or....
// ----------------------------------

// POST with formData
const form = document.getElementById('your-form-id');
const formData = new FormData(form);

fetch('https://api.example.com/data', {
    method: 'POST',
    body: formData
})
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // Handle the response data
        console.log(data);
    })
    .catch(error => {
        // Handle the error
        console.error('Error:', error.message);
    });

