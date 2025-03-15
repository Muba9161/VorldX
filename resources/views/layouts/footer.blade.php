<!-- Country-selector modal-->
<div class="modal fade" id="country-selector">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content country-select-modal">
            <div class="modal-header">
                <h6 class="modal-title">Choose Country</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <ul class="row p-3">
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active">
                            <span class="country-selector"><img alt="" src="../assets/images/flags/us_flag.jpg"
                                    class="me-3 language"></span>USA
                        </a>
                    </li>
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt=""
                                    src="../assets/images/flags/italy_flag.jpg" class="me-3 language"></span>Italy
                        </a>
                    </li>
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt=""
                                    src="../assets/images/flags/spain_flag.jpg" class="me-3 language"></span>Spain
                        </a>
                    </li>
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt=""
                                    src="../assets/images/flags/india_flag.jpg" class="me-3 language"></span>India
                        </a>
                    </li>
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt=""
                                    src="../assets/images/flags/french_flag.jpg" class="me-3 language"></span>French
                        </a>
                    </li>
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt=""
                                    src="../assets/images/flags/russia_flag.jpg" class="me-3 language"></span>Russia
                        </a>
                    </li>
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt=""
                                    src="../assets/images/flags/germany_flag.jpg" class="me-3 language"></span>Germany
                        </a>
                    </li>
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt=""
                                    src="../assets/images/flags/argentina.jpg" class="me-3 language"></span>Argentina
                        </a>
                    </li>
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="" src="../assets/images/flags/malaysia.jpg"
                                    class="me-3 language"></span>Malaysia
                        </a>
                    </li>
                    <li class="col-lg-6 mb-2">
                        <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block">
                            <span class="country-selector"><img alt="" src="../assets/images/flags/turkey.jpg"
                                    class="me-3 language"></span>Turkey
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Country-selector modal-->



<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-md-12 col-sm-12 text-center">
                Copyright © <span id="year"></span> <a href="javascript:void(0)">Sash</a>. Designed
                with <span class="fa fa-heart text-danger"></span> by <a href="javascript:void(0)"> Spruko
                </a> All rights reserved.
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER CLOSED -->
</div>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- JQUERY JS -->
<script src="../assets/js/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- SIDEBAR JS -->
<script src="../assets/plugins/sidebar/sidebar.js"></script>

<!-- SIDE-MENU JS -->
<script src="../assets/plugins/sidemenu/sidemenu.js"></script>

<!-- TypeHead js -->
<script src="../assets/plugins/bootstrap5-typehead/autocomplete.js"></script>
<script src="../assets/js/typehead.js"></script>

<!-- INTERNAL File-Uploads Js-->
<script src="../assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="../assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="../assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="../assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="../assets/plugins/fancyuploder/fancy-uploader.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="../assets/plugins/p-scroll/pscroll.js"></script>
<script src="../assets/plugins/p-scroll/pscroll-1.js"></script>

<!-- Color Theme js -->
<script src="../assets/js/themeColors.js"></script>

<!-- Sticky js -->
<script src="../assets/js/sticky.js"></script>

<!-- CUSTOM JS-->
<script src="../assets/js/custom.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let folderIdToDelete = null; // Variable to hold the folder ID

    // Open the delete confirmation modal
    function openDeleteModal(folderId) {
        folderIdToDelete = folderId; // Set the folder ID dynamically
        $('#deleteMessage').text(`Are you sure you want to delete folder ${folderId}?`); // Dynamically set the message

        // Show the overlay and modal with fadeIn effect
        $('#modalOverlay').fadeIn(); // Show the overlay
        $('.modal-container').fadeIn(); // Show the modal
    }

    // Close the delete confirmation modal
    function closeDeleteModal() {
        $('#modalOverlay').fadeOut(); // Hide the overlay
        $('.modal-container').fadeOut(); // Hide the modal
        folderIdToDelete = null; // Reset the folder ID
    }

    // Handle the deletion when the user confirms
    $('#confirmDeleteBtn').click(function() {
        if (folderIdToDelete !== null) {
            $.ajax({
                url: '/folders/' + folderIdToDelete, // The folder's delete route
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // CSRF token for security
                },
                success: function(response) {
                    // Handle success

                    // Close the delete modal
                    closeDeleteModal();

                    // Remove the folder element dynamically from the page
                    setTimeout(function() {
                        location.reload(); // Reload the page after 2 seconds
                    }, 2000); // Optional: adjust timeout duration

                    // Open the success modal (optional)
                    openSuccessModal();

                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('There was an error deleting the folder.');
                }
            });
        }
    });

    // Open the success modal (you can reuse the previous code for the success modal)
    function openSuccessModal() {
        $('#successModalOverlay').fadeIn(); // Show the overlay
        $('.modal-container').fadeIn(); // Show the modal
    }

    // Close the success modal
    function closeSuccessModal() {
        $('#successModalOverlay').fadeOut(); // Hide the overlay
        $('.modal-container').fadeOut(); // Hide the modal
    }
</script>

<script>
    // Get the elements for drag-and-drop functionality
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('file-input');
    const fileList = document.getElementById('file-list');

    // Open the file input when the dropzone is clicked
    dropzone.addEventListener('click', () => {
        fileInput.click();
    });

    // Handle dragover and drop events for drag-and-drop functionality
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.style.backgroundColor = '#f8f9fa';
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.style.backgroundColor = '';
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.style.backgroundColor = '';
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    // Handle file selection via input
    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        handleFiles(files);
    });

    // Display the selected files in the list
    function handleFiles(files) {
        for (const file of files) {
            const listItem = document.createElement('li');
            listItem.textContent = file.name;
            fileList.appendChild(listItem);
        }
    }
</script>

<script>
    $(document).ready(function() {
        var copiedFolderId = null; // Store the ID of the copied folder
        var copiedParentId = null; // Store the parent ID of the copied folder

        // Handle Copy Folder action
        $('#copy-folder-link').on('click', function() {
            // Get the folder ID and parent ID
            copiedFolderId = $(this).data('folder-id');
            copiedParentId = $(this).data('parent-id');

            // Show the "Paste" action and hide the "Copy" action
            $('#copy-folder-link').hide();
            $('#paste-folder-link').show();

            alert('Folder copied! Now select a folder to paste it.');
        });

        // Handle Paste Folder action
        $('#paste-folder-link').on('click', function() {
            if (!copiedFolderId) {
                alert('No folder copied yet!');
                return;
            }

            var destinationFolderId = $(this).data(
            'folder-id'); // The folder where we want to paste the copied folder

            // Send AJAX request to paste the folder into the destination folder
            $.ajax({
                url: '/folders/' + copiedFolderId +
                '/paste', // Backend route for pasting folder
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    destination_folder_id: destinationFolderId,
                    parent_id: copiedParentId, // Pass the parent ID to copy subfolders
                },
                success: function(response) {
                    alert(response.message);

                    // After pasting, reset the state and show the "Copy" option again
                    copiedFolderId = null;
                    copiedParentId = null;
                    $('#copy-folder-link').show();
                    $('#paste-folder-link').hide();

                    location.reload(); // Optionally reload to show updated folder structure
                },
                error: function(xhr, status, error) {
                    alert('Error pasting the folder: ' + error);
                }
            });
        });
    });
</script>



</body>

</html>
