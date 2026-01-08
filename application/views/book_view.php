<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Starfall Book Manager</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/adminlte/dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/sweetalert2/sweetalert2.min.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* --- COSMIC FOUNDATION --- */
        body {
            background: radial-gradient(circle at top, #1a1c29 0%, #000000 100%);
            color: #c2c7d0;
            font-family: 'Source Sans Pro', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* FIX: Make AdminLTE wrappers transparent so Stars show through */
        .wrapper, .content-wrapper, .main-footer {
            background-color: transparent !important;
        }

        /* 1. FALLING STARS */
        .stars-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: -1; }
        .star { position: absolute; background: white; border-radius: 50%; opacity: 0; animation: fall linear infinite; }
        @keyframes fall { 0% { opacity: 0; transform: translateY(-100px); } 10% { opacity: 1; } 100% { opacity: 0; transform: translateY(100vh); } }

        /* 2. SCROLL TRACKER */
        .scroll-star-track {
            position: fixed; left: 20px; top: 80px; bottom: 60px; width: 2px;
            background: rgba(255, 255, 255, 0.05); z-index: 900; border-radius: 2px;
        }
        #scrollStar {
            position: absolute; left: -5px; top: 0%; width: 12px; height: 12px;
            background: #ffffff; border-radius: 50%;
            box-shadow: 0 0 10px 2px rgba(255, 255, 255, 0.9), 0 0 20px 5px rgba(255, 255, 255, 0.5);
            transition: top 0.1s ease-out; z-index: 901;
        }

        /* 3. NAVBAR & SIDEBAR STYLING */
        .navbar-cosmic {
            background-color: rgba(5, 5, 10, 0.95) !important; 
            border-bottom: 1px solid #3d4c6e;
            box-shadow: 0 4px 15px rgba(0,0,0,0.9);
        }

        /* Sidebar Customization */
        .main-sidebar {
            background-color: #05050a; /* Dark Cosmic Background */
            border-right: 1px solid #3d4c6e;
            box-shadow: 5px 0 15px rgba(0,0,0,0.5);
        }
        .brand-link { border-bottom: 1px solid #3d4c6e !important; background-color: #05050a; }
        .user-panel { border-bottom: 1px solid #3d4c6e !important; }
        
        /* Sidebar Links */
        .nav-link { color: #c2c7d0 !important; }
        .nav-link:hover { background-color: rgba(255,255,255,0.1) !important; color: #fff !important; }
        .nav-link.active { 
            background-color: #007bff !important; 
            color: white !important; 
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5); 
        }

        .main-content { padding-top: 20px; padding-bottom: 30px; }

        /* 4. SHINING ANIMATIONS */
        .shiny-text {
            background: linear-gradient(to right, #6c757d 0%, #fff 50%, #6c757d 100%);
            background-size: 200% auto; color: #000;
            background-clip: text; -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: shine 3s linear infinite; font-weight: 700;
        }
        @keyframes shine { to { background-position: 200% center; } }

        .input-shine::placeholder { color: rgba(255,255,255,0.3); text-shadow: 0 0 5px rgba(255,255,255,0.1); animation: placeholderFlash 3s infinite alternate; font-style: italic; }
        .search-shadow-shine::placeholder { color: rgba(255,255,255,0.2); text-shadow: 0 0 5px rgba(255,255,255,0.1); animation: placeholderFlash 4s infinite ease-in-out; }
        @keyframes placeholderFlash { 0% { opacity: 0.2; } 100% { opacity: 1; } }

        /* 5. ADMINLTE CARD */
        .admin-card {
            background: #15171e; border-top: 3px solid #007bff;
            border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.5); padding: 20px;
        }
        /* Table Sizing Fixes */
        .table-responsive { overflow-x: auto; }
        .table-dark-custom { --bs-table-bg: transparent; color: #e0e0e0; }
        .table-dark-custom th { background-color: #0f1116; color: #007bff; border-bottom: 2px solid #3d4c6e; white-space: nowrap; }
        .table-dark-custom td { vertical-align: middle; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .table-dark-custom tbody tr:hover {
            background-color: rgba(30, 40, 60, 0.9) !important;
            transform: scale(1.002); z-index: 10; position: relative;
            box-shadow: inset 0 0 15px rgba(0, 123, 255, 0.1);
        }
        .book-thumb { width: 50px; height: 50px; aspect-ratio: 1/1; object-fit: cover; border: 1px solid #4b545c; border-radius: 3px; }

        /* 6. UI ELEMENTS */
        .pagination-box { display: flex; gap: 5px; align-items: center;}
        .page-btn {
            background: #1f2229; border: 1px solid #3d4c6e; color: #fff;
            padding: 5px 10px; cursor: pointer; border-radius: 4px; transition: all 0.2s; font-size: 0.9rem;
        }
        .page-btn:hover:not(.disabled) { background: #007bff; border-color: #007bff; }
        .page-btn.active { background: #007bff; border-color: #007bff; font-weight: bold; }
        .page-btn.disabled { opacity: 0.5; cursor: not-allowed; }

        .form-control, .form-select { background-color: #1f2229; border: 1px solid #4b545c; color: #fff; }
        .btn-primary-star { background-color: #007bff; border-color: #007bff; color: white; box-shadow: 0 0 10px rgba(0, 123, 255, 0.4); }
        
        .main-footer { border-top: 1px solid #3d4c6e; color: #869099; padding: 15px; text-align: center; width: 100%; position: relative; z-index: 10; }
        .swal2-popup { background: #1a1c29 !important; border: 1px solid #3d4c6e; color: #fff !important; }
        .modal-content-shine { background: #1f2229; color: #fff; border: 1px solid #4b545c; animation: modalGlow 2s infinite alternate ease-in-out; }
        @keyframes modalGlow { from { box-shadow: 0 0 10px rgba(0, 123, 255, 0.2); border-color: #4b545c; } to { box-shadow: 0 0 25px rgba(0, 123, 255, 0.6), 0 0 10px rgba(255, 255, 255, 0.3); border-color: #80bdff; } }
        .btn-close { filter: invert(1); }
        .fw-extra-bold { font-weight: 800 !important; }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

    <div class="stars-container" id="starsBg"></div>
    
    <div class="scroll-star-track"><div id="scrollStar"></div></div>

    <div class="wrapper">
        
        <nav class="main-header navbar navbar-expand navbar-cosmic">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block ml-2">
                    <a href="#" class="navbar-brand">
                        <i class="fas fa-meteor text-primary mr-2" style="font-size: 1.5rem;"></i>
                        <span class="brand-text fw-extra-bold text-white">Knowledge of the Stars</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button class="btn btn-primary-star btn-sm mr-3" onclick="openModal()">
                        <i class="fas fa-plus mr-1"></i> <span class="d-none d-sm-inline">Publish Book</span>
                    </button>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar elevation-4">
            <a href="#" class="brand-link text-center">
                <i class="fas fa-book-journal-whills text-primary"></i>
                <span class="brand-text font-weight-light text-white ml-2">Galactic Admin</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img src="<?php echo base_url('assets/company/defaultprofile.png'); ?>" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #007bff;">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block shiny-text">Alexis Aries</a>
                        <small class="text-muted" style="font-size: 0.8rem;">Head Librarian</small>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        
                        <li class="nav-header text-secondary small font-weight-bold">ADMINISTRATION</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Manage Books</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Authors & Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Analytics</p>
                            </a>
                        </li>

                        <li class="nav-header text-secondary small font-weight-bold">SYSTEM</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-danger">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="container-fluid px-md-5 main-content">
                <div class="text-center mb-4">
                    <h2 class="fw-extra-bold text-white">
                        <i class="fas fa-book-journal-whills text-primary mr-2"></i> Galactic Archives
                    </h2>
                    <small class="text-secondary font-italic">"Each starfall represents the books written in the world"</small>
                </div>

                <div class="admin-card">
                    <div class="row mb-3 g-2">
                        <div class="col-12 col-md-3 col-lg-2">
                            <select id="searchFilter" class="form-control" onchange="loadPage(1)">
                                <option value="BookName">Filter: Title</option>
                                <option value="ID">Filter: ID</option>
                                <option value="AuthorName">Author</option>
                                <option value="Genre">Genre</option>
                                <option value="Publisher">Publisher</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-8">
                            <input type="text" id="searchInput" class="form-control search-shadow-shine" 
                                   placeholder="Search your books here..." onkeyup="loadPage(1)">
                        </div>
                        <div class="col-12 col-md-3 col-lg-2">
                            <select id="ratingFilter" class="form-control" onchange="loadPage(1)">
                                <option value="">All Ratings</option>
                                <option value="5">★★★★★ (5)</option>
                                <option value="4">★★★★☆ (4)</option>
                                <option value="3">★★★☆☆ (3)</option>
                                <option value="2">★★☆☆☆ (2)</option>
                                <option value="1">★☆☆☆☆ (1)</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-dark-custom mb-0 w-100">
                            <thead>
                                <tr>
                                    <th style="min-width:70px; width:70px;">Cover</th>
                                    <th class="d-none d-lg-table-cell" style="width:60px;">ID</th>
                                    <th style="min-width:180px;">Title</th>
                                    <th style="min-width:150px;">Author</th>
                                    <th style="min-width:120px;">Genre</th>
                                    <th class="d-none d-md-table-cell" style="min-width:150px;">Publisher</th>
                                    <th style="min-width:100px;">Rating</th>
                                    <th class="text-right" style="min-width:100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="book_tbody"></tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 border-top border-secondary pt-3">
                        <div class="text-secondary small mb-2 mb-md-0" id="recordCount">Loading...</div>
                        <div class="pagination-box" id="pagination"></div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">Cosmic v2.0</div>
            <strong>Copyright &copy; 2025 <a href="#" class="text-primary">Starfall Systems</a>.</strong> All rights reserved.
        </footer>
    </div>

    <div class="modal fade" id="bookModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-content-shine">
                <div class="modal-header" style="border-bottom: 1px solid #4b545c;">
                    <h4 class="modal-title font-weight-bold">Book Entry</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bookForm" enctype="multipart/form-data">
                        <input type="hidden" name="ID" id="bookId">
                        <div class="row">
                            <div class="col-12 col-sm-4 text-center mb-3">
                                <img id="previewImg" src="" style="width: 120px; height: 120px; object-fit: cover; border: 1px solid #666; display:none; margin: 0 auto;">
                                <div class="mt-2">
                                    <label class="btn btn-outline-secondary btn-sm btn-block" for="BookCoverFile">
                                        <i class="fas fa-upload"></i> Upload
                                    </label>
                                    <input type="file" name="BookCoverFile" id="BookCoverFile" hidden accept="image/*" onchange="loadFile(event)">
                                </div>
                            </div>
                            <div class="col-12 col-sm-8">
                                <input type="text" name="BookName" id="BookName" class="form-control mb-2 input-shine" placeholder="Title *" required>
                                <input type="text" name="AuthorName" id="AuthorName" class="form-control mb-2 input-shine" placeholder="Author *" required>
                                <input type="text" name="Publisher" id="Publisher" class="form-control mb-2 input-shine" placeholder="Publisher *" required>
                                <div class="row">
                                    <div class="col-6">
                                        <select name="Genre" id="Genre" class="form-control input-shine" required>
                                            <option value="" disabled selected>Select Genre</option>
                                        </select>
                                    </div>
                                    <div class="col-6"><input type="number" step="0.1" max="5" name="Rating" id="Rating" class="form-control input-shine" placeholder="Rating" required></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between" style="border-top: 1px solid #4b545c;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary-star" onclick="saveBook()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/vendors/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendors/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendors/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendors/adminlte/dist/js/adminlte.min.js'); ?>"></script>

    <script>
        let currentPage = 1;

        $(document).ready(function(){
            const container = document.getElementById('starsBg');
            for(let i=0; i<60; i++) {
                let star = document.createElement('div');
                star.className = 'star';
                star.style.left = Math.random() * 100 + 'vw';
                star.style.width = Math.random() * 3 + 'px';
                star.style.height = star.style.width;
                star.style.animationDuration = (Math.random() * 5 + 3) + 's';
                container.appendChild(star);
            }

            window.onscroll = function() {
                let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                let scrolled = (winScroll / height) * 100;
                if(scrolled > 95) scrolled = 95;
                document.getElementById("scrollStar").style.top = scrolled + "%";
            };

            loadGenres(); 
            loadPage(1);
        });

        function loadGenres() {
            $.ajax({
                url: "<?php echo base_url('index.php/books/get_genres'); ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let opts = '<option value="" disabled selected>Select Genre</option>';
                    $.each(data, function(i, item) {
                        opts += `<option value="${item.ID}">${item.GenreName}</option>`;
                    });
                    $('#Genre').html(opts);
                }
            });
        }

        function loadPage(page) {
            currentPage = page;
            let filter = $('#searchFilter').val();
            let search = $('#searchInput').val();
            let rating = $('#ratingFilter').val();

            $.ajax({
                url: "<?php echo base_url('index.php/books/fetch'); ?>",
                type: "POST",
                dataType: "json",
                data: { filter: filter, search: search, rating: rating, page: page },
                success: function(res) {
                    renderTable(res.data);
                    renderPagination(res.pagination);
                }
            });
        }

        function renderTable(data) {
            let rows = '';
            if(data.length > 0){
                $.each(data, function(i, item){
                    let imgPath = getImagePath(item.BookCover);
                    let idHtml = `<span class="shiny-text" style="font-size:0.9rem">${item.ID}</span>`;
                    let ratingColor = item.Rating >= 4.5 ? 'text-warning' : (item.Rating >= 3 ? 'text-info' : 'text-secondary');
                    let genreDisplay = item.GenreName ? item.GenreName : '<span class="text-muted">Unknown</span>';

                    rows += `
                        <tr>
                            <td><img src="${imgPath}" class="book-thumb"></td>
                            <td class="d-none d-lg-table-cell">${idHtml}</td>
                            <td class="font-weight-bold text-white">${item.BookName}</td>
                            <td class="text-white">${item.AuthorName}</td>
                            <td><span class="badge badge-dark border border-secondary">${genreDisplay}</span></td>
                            <td class="d-none d-md-table-cell text-white-50 small">${item.Publisher}</td>
                            <td class="${ratingColor} font-weight-bold"><i class="fas fa-star small"></i> ${item.Rating}</td>
                            <td class="text-right">
                                <button class="btn btn-outline-info btn-xs" onclick='editBook(${JSON.stringify(item)})'><i class="fas fa-edit"></i></button>
                                <button class="btn btn-outline-danger btn-xs" onclick="deleteBook(${item.ID})"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>`;
                });
            } else {
                rows = `<tr><td colspan="8" class="text-center py-5 text-secondary">No books found in orbit.</td></tr>`;
            }
            $('#book_tbody').html(rows);
        }

        function renderPagination(pageData) {
            $('#recordCount').text(`Showing ${pageData.start_index}-${pageData.end_index} out of ${pageData.total_records}`);
            let btns = '';
            let total = pageData.total_pages;
            let current = pageData.current_page;
            let prevDisabled = (current === 1) ? 'disabled' : '';
            btns += `<div class="page-btn ${prevDisabled}" onclick="${prevDisabled ? '' : 'loadPage('+(current-1)+')'}">Prev</div>`;
            for(let i=1; i <= total; i++) {
                if (i === 1 || i === total || (i >= current - 1 && i <= current + 1)) {
                    let active = (i === current) ? 'active' : '';
                    btns += `<div class="page-btn ${active}" onclick="loadPage(${i})">${i}</div>`;
                } else if (i === current - 2 || i === current + 2) {
                    btns += `<div class="text-secondary p-1">...</div>`;
                }
            }
            let nextDisabled = (current === total) ? 'disabled' : '';
            btns += `<div class="page-btn ${nextDisabled}" onclick="${nextDisabled ? '' : 'loadPage('+(current+1)+')'}">Next</div>`;
            $('#pagination').html(btns);
        }

        function getImagePath(imgName) {
            let baseUrl = "<?php echo base_url(); ?>";
            if (!imgName || imgName === "" || imgName === "defaultprofile.png") {
                return baseUrl + "assets/company/defaultprofile.png";
            }
            return baseUrl + "assets/company/images/" + imgName + "?t=" + new Date().getTime();
        }

        function saveBook() {
            if($('#BookName').val() === '' || $('#AuthorName').val() === '') {
                Swal.fire({ icon: 'error', title: 'Missing Data', text: 'Please fill in Title and Author.' });
                return;
            }
            let form = $('#bookForm')[0];
            let formData = new FormData(form);
            $.ajax({
                url: "<?php echo base_url('index.php/books/save'); ?>",
                type: "POST", data: formData, dataType: "json",
                contentType: false, processData: false,
                success: function(res) {
                    if(res.status === 'error') {
                        Swal.fire({ icon: 'error', title: 'Error', text: res.message });
                    } else {
                        $('#bookModal').modal('hide');
                        Swal.fire({ icon: 'success', title: 'Success', text: res.message });
                        loadPage(currentPage);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({ icon: 'error', title: 'System Error', text: 'A hidden error occurred. Check Console.' });
                }
            });
        }

        function deleteBook(id) {
            Swal.fire({
                title: 'Delete this book?', icon: 'warning', showCancelButton: true,
                confirmButtonColor: '#d33', confirmButtonText: 'Yes, delete',
                background: '#1a1a2e', color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo base_url('index.php/books/delete'); ?>",
                        type: "POST", data: { id: id }, dataType: "json",
                        success: function(res) {
                            Swal.fire({ icon: 'success', title: 'Deleted', background: '#1a1a2e', color: '#fff' });
                            loadPage(currentPage);
                        }
                    });
                }
            });
        }

        function openModal() {
            $('#modalTitle').text('New Book Entry');
            $('#bookForm')[0].reset();
            $('#bookId').val('');
            $('#previewImg').hide().attr('src', '');
            $('#bookModal').modal('show');
        }

        function editBook(item) {
            $('#modalTitle').text('Edit Entry #' + item.ID);
            $('#bookId').val(item.ID);
            $('#BookName').val(item.BookName);
            $('#AuthorName').val(item.AuthorName);
            $('#Rating').val(item.Rating);
            $('#Publisher').val(item.Publisher);
            $('#Genre').val(item.Genre); 
            
            let imgPath = getImagePath(item.BookCover);
            $('#previewImg').attr('src', imgPath).show();
            $('#bookModal').modal('show');
        }

        var loadFile = function(event) {
            var output = document.getElementById('previewImg');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() { URL.revokeObjectURL(output.src) }
            output.style.display = "block";
        };
    </script>
</body>
</html>