@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="page-header">
        <div>
            <h1><i class="fas fa-edit"></i> Edit Product</h1>
            <p class="text-muted">Update product details and images</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label>Product Name <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Price <span class="required">*</span></label>
                        <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Category <span class="required">*</span></label>
                        <input type="text" name="category" class="form-control" value="{{ old('category', $product->category) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Stock <span class="required">*</span></label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- MULTIPLE IMAGE UPLOAD WITH EXISTING IMAGES -->
                <!-- ========================================== -->
                <div class="form-group">
                    <label>Product Images <span class="required">*</span></label>
                    
                    @if($product->images)
                    <div class="existing-images">
                        <label>Existing Images:</label>
                        <div class="image-preview-grid">
                            @foreach(json_decode($product->images) as $index => $img)
                            <div class="preview-item existing">
                                <img src="{{ $img }}" alt="Product image">
                                <button type="button" class="remove-image" data-image="{{ $img }}" title="Remove image">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="image-upload-wrapper" id="imageUploadWrapper">
                        <div class="drop-zone" id="dropZone">
                            <i class="fas fa-cloud-upload-alt fa-3x"></i>
                            <p>Drag & drop new images here or <span class="browse-link">browse</span></p>
                            <input type="file" name="images[]" id="imageInput" multiple accept="image/*">
                        </div>
                        <div class="image-preview-grid" id="imagePreviewGrid"></div>
                    </div>
                    <small class="text-muted">Add new images or remove existing ones.</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i> Update Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden input for removed images -->
    <input type="hidden" name="removed_images" id="removedImages" value="">
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('imageInput');
    const previewGrid = document.getElementById('imagePreviewGrid');
    let files = [];

    // ==========================================
    // EXISTING IMAGE REMOVE
    // ==========================================
    let removedImages = [];

    document.querySelectorAll('.remove-image').forEach(btn => {
        btn.addEventListener('click', function() {
            const img = this.dataset.image;
            removedImages.push(img);
            this.closest('.preview-item').remove();
            document.getElementById('removedImages').value = JSON.stringify(removedImages);
            showToast('Image marked for removal', 'warning');
        });
    });

    // ==========================================
    // DRAG & DROP
    // ==========================================
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        const droppedFiles = Array.from(e.dataTransfer.files);
        handleFiles(droppedFiles);
    });

    dropZone.querySelector('.browse-link').addEventListener('click', () => fileInput.click());
    dropZone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', (e) => {
        const selectedFiles = Array.from(e.target.files);
        handleFiles(selectedFiles);
        fileInput.value = '';
    });

    function handleFiles(newFiles) {
        const remaining = 10 - files.length;
        const toAdd = newFiles.slice(0, remaining);
        if (newFiles.length > remaining) {
            showToast(`Maximum 10 images allowed. ${newFiles.length - remaining} skipped.`, 'warning');
        }
        files = [...files, ...toAdd];
        renderPreviews();
        updateFileInput();
    }

    function renderPreviews() {
        previewGrid.innerHTML = files.map((file, index) => `
            <div class="preview-item">
                <img src="${URL.createObjectURL(file)}" alt="Preview ${index + 1}">
                <button type="button" class="remove-image-new" data-index="${index}" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `).join('');

        document.querySelectorAll('.remove-image-new').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                files.splice(index, 1);
                renderPreviews();
                updateFileInput();
            });
        });
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
        
        const dropText = dropZone.querySelector('p');
        if (files.length > 0) {
            dropText.innerHTML = `<i class="fas fa-check-circle" style="color:#2ecc71;"></i> ${files.length} new image${files.length > 1 ? 's' : ''} selected`;
        } else {
            dropText.innerHTML = 'Drag & drop new images here or <span class="browse-link">browse</span>';
        }
    }

    // ==========================================
    // FORM SUBMIT VALIDATION
    // ==========================================
    document.getElementById('productForm').addEventListener('submit', function(e) {
        // Check if there are any images (existing or new)
        const existingImages = document.querySelectorAll('.existing .preview-item');
        if (existingImages.length === 0 && files.length === 0) {
            e.preventDefault();
            showToast('Product must have at least one image.', 'danger');
        }
    });
});
</script>
@endpush