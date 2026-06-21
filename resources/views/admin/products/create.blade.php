@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('content')
    <div class="page-header">
        <div>
            <h1><i class="fas fa-plus-circle"></i> Add Product</h1>
            <p class="text-muted">Create a new product with multiple images</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>Product Name <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Enter product name">
                    </div>
                    <div class="form-group">
                        <label>Price <span class="required">*</span></label>
                        <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price') }}" required placeholder="0.00">
                    </div>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Product description...">{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Category <span class="required">*</span></label>
                        <input type="text" name="category" class="form-control" value="{{ old('category') }}" required placeholder="e.g. Electronics">
                    </div>
                    <div class="form-group">
                        <label>Stock <span class="required">*</span></label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" min="0" required>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- MULTIPLE IMAGE UPLOAD -->
                <!-- ========================================== -->
                <div class="form-group">
                    <label>Product Images <span class="required">*</span></label>
                    <div class="image-upload-wrapper" id="imageUploadWrapper">
                        <div class="drop-zone" id="dropZone">
                            <i class="fas fa-cloud-upload-alt fa-3x"></i>
                            <p>Drag & drop images here or <span class="browse-link">browse</span></p>
                            <input type="file" name="images[]" id="imageInput" multiple accept="image/*" required>
                        </div>
                        <div class="image-preview-grid" id="imagePreviewGrid"></div>
                    </div>
                    <small class="text-muted">Upload multiple images. First image will be the main thumbnail.</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i> Save Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('imageInput');
    const previewGrid = document.getElementById('imagePreviewGrid');
    let files = [];

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

    // ==========================================
    // CLICK TO BROWSE
    // ==========================================
    dropZone.querySelector('.browse-link').addEventListener('click', () => fileInput.click());
    dropZone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', (e) => {
        const selectedFiles = Array.from(e.target.files);
        handleFiles(selectedFiles);
        fileInput.value = '';
    });

    // ==========================================
    // HANDLE FILES
    // ==========================================
    function handleFiles(newFiles) {
        // Limit to 10 images
        const remaining = 10 - files.length;
        const toAdd = newFiles.slice(0, remaining);
        
        if (newFiles.length > remaining) {
            showToast(`Maximum 10 images allowed. ${newFiles.length - remaining} skipped.`, 'warning');
        }

        files = [...files, ...toAdd];
        renderPreviews();
        updateFileInput();
    }

    // ==========================================
    // RENDER PREVIEWS
    // ==========================================
    function renderPreviews() {
        previewGrid.innerHTML = files.map((file, index) => `
            <div class="preview-item">
                <img src="${URL.createObjectURL(file)}" alt="Preview ${index + 1}">
                ${index === 0 ? '<span class="main-badge">Main</span>' : ''}
                <button type="button" class="remove-image" data-index="${index}" title="Remove image">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `).join('');

        // Remove image handler
        document.querySelectorAll('.remove-image').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                files.splice(index, 1);
                renderPreviews();
                updateFileInput();
            });
        });
    }

    // ==========================================
    // UPDATE FILE INPUT
    // ==========================================
    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
        
        // Update drop zone text
        const dropText = dropZone.querySelector('p');
        if (files.length > 0) {
            dropText.innerHTML = `<i class="fas fa-check-circle" style="color:#2ecc71;"></i> ${files.length} image${files.length > 1 ? 's' : ''} selected`;
        } else {
            dropText.innerHTML = 'Drag & drop images here or <span class="browse-link">browse</span>';
        }
    }

    // ==========================================
    // FORM SUBMIT VALIDATION
    // ==========================================
    document.getElementById('productForm').addEventListener('submit', function(e) {
        if (files.length === 0) {
            e.preventDefault();
            showToast('Please upload at least one image.', 'danger');
        }
    });
});
</script>
@endpush