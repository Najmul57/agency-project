@extends('admin.admin_master')

@section('admin_content')
    <style>
        #imagePreview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .image-container {
            position: relative;
            width: 100px;
            height: 100px;
            overflow: hidden;
        }

        .image-preview {
            max-width: 100%;
            max-height: 100%;
        }

        .remove-button {
            position: absolute;
            top: 0;
            right: 0;
            background: red;
            color: white;
            border: none;
            padding: 3px 6px;
            cursor: pointer;
        }
    </style>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Gallery</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('gallery.index') }}" class="btn btn-info">Gallery List</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" id="imageInput" class="form-control" name="image[]" multiple accept="image/*">
                    <div id="imagePreview" class="image-preview"></div>

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        // Function to handle image selection and preview
        function handleImageUpload() {
            const imageInput = document.getElementById("imageInput");
            const imagePreview = document.getElementById("imagePreview");

            imageInput.addEventListener("change", function() {
                for (let i = 0; i < imageInput.files.length; i++) {
                    const file = imageInput.files[i];
                    const imageContainer = document.createElement("div");
                    imageContainer.classList.add("image-container");

                    const removeButton = document.createElement("button");
                    removeButton.textContent = "Remove";
                    removeButton.classList.add("remove-button");
                    removeButton.addEventListener("click", () => {
                        imageContainer.remove(); // Remove the image container on button click
                    });

                    const newImage = document.createElement("img");
                    newImage.classList.add("image-preview");
                    newImage.src = URL.createObjectURL(file);

                    imageContainer.appendChild(newImage);
                    imageContainer.appendChild(removeButton);
                    imagePreview.appendChild(imageContainer);
                }
            });
        }

        // Call the function to initialize the image upload handler
        handleImageUpload();
    </script>
@endsection
