@extends('Layout/user/main')

@section('content')


  <div class="container mt-4">
    <h2>Drag and Drop Images</h2>
    <div id="dropArea" class="mb-3">
      <p>Drag &amp; Drop images here or click to select</p>
      <input type="file" id="fileInput" multiple style="display: none;">
      <input id = "csrfToken" type = "hidden"  value =  "{{csrf_token()}}" />
    </div>
    <ul id="imageList"></ul>
    <button id="submitBtn" class="btn btn-primary">Submit Images</button>
   
  </div>

  <!-- Modal for image view -->
  <div class="modal fade" id="imageViewModal" tabindex="-1" role="dialog" aria-labelledby="imageViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageViewModalLabel">Image View</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="modalImage" src="" alt="Image" style="max-width: 100%; max-height: 100%;">
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('fileInput');
    const imageList = document.getElementById('imageList');
    const submitBtn = document.getElementById('submitBtn');

    dropArea.addEventListener('dragover', (event) => {
      event.preventDefault();
      dropArea.style.border = '2px dashed #000';
    });

    dropArea.addEventListener('dragleave', () => {
      dropArea.style.border = '2px dashed #ccc';
    });

    dropArea.addEventListener('drop', (event) => {
      event.preventDefault();
      const files = event.dataTransfer.files;
      fileInput.files = files;  // Set the dropped files to the file input
      fileInput.dispatchEvent(new Event('change'));
        });

    dropArea.addEventListener('click', () => {
      fileInput.click();
    });

    fileInput.addEventListener('change', (event) => {
      const files = event.target.files;
      handleFiles(files);
    });

    function handleFiles(files) {
      for (const file of files) {
        if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = (e) => {
            const imageItem = document.createElement('li');
            imageItem.classList.add('imageItem');

            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Image';

            const viewButton = document.createElement('button');
            viewButton.classList.add('btn', 'btn-info');
            viewButton.innerText = 'View';
            viewButton.addEventListener('click', () => {
              $('#imageViewModal').modal('show');
              document.getElementById('modalImage').src = e.target.result;
            });

            const deleteButton = document.createElement('button');
            deleteButton.classList.add('btn', 'btn-danger');
            deleteButton.innerText = 'Delete';
            deleteButton.addEventListener('click', () => {
              imageItem.remove();
            });

            imageItem.appendChild(img);
            
            const buttonsDiv = document.createElement('div');
            buttonsDiv.appendChild(viewButton);
            buttonsDiv.appendChild(deleteButton);
            imageItem.appendChild(buttonsDiv);

            imageList.appendChild(imageItem);
          };
          reader.readAsDataURL(file);
        }
      }
    }

const csrfToken = document.getElementById("csrfToken").value;

function uploadImages(images) {
  const formData = new FormData();
   console.log(formData);
  for (const image of images) {
    formData.append('images[]', image);
  }

  fetch('/user/upload', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
    },
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    alert('Images uploaded successfully');
    imageList.innerHTML = '';
  })
  .catch(error => {
    console.error('Error uploading images:', error);
    // Handle errors
  });
}

submitBtn.addEventListener('click', () => {
  const images = fileInput.files;
  if (images.length > 0) {
    uploadImages(images);
  } else {
    alert('Please select images to upload.');
  }
});



  </script>
</body>
</html>
