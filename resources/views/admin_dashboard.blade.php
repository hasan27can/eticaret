<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli - Kontrol Merkezi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: #fff;
        }
        .sidebar a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            display: block;
            padding: 12px 18px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.15);
        }
        .card-stat {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s;
        }
        .card-stat:hover {
            transform: translateY(-3px);
        }
        .table img {
            object-fit: cover;
            border-radius: 6px;
        }
        .btn-custom-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        .btn-custom-delete:hover {
            background-color: #bb2d3b;
            color: white;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- SOL MENÜ (SIDEBAR) -->
        <div class="col-md-3 col-lg-2 sidebar p-3 d-none d-md-block">
            <h4 class="text-center mb-4 fw-bold text-primary">Yönetim Paneli</h4>
            <hr class="text-secondary">
            <nav class="nav flex-column gap-2">
                <a href="{{ route('admin.dashboard') }}" class="active">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a href="{{ route('products.index') }}">
                    <i class="bi bi-shop me-2"></i> Mağazaya Dön
                </a>
                <a href="{{ route('admin.orders.index') }}">
                    <i class="bi bi-box-seam me-2"></i> Siparişler
                </a>
                <a href="{{ route('admin.reviews.index') }}">
                    <i class="bi bi-chat-square-text me-2"></i> Yorumlar
                </a>
                <div class="border-top border-secondary my-2"></div>
                <a href="{{ route('custom_products.clear') }}" class="text-danger" onclick="return confirm('Eklediğiniz tüm özel ürünleri sıfırlamak istediğinize emin misiniz?');">
                    <i class="bi bi-trash3 me-2"></i> Tüm Ürünleri Sıfırla
                </a>
                <a href="{{ route('logout') }}" class="text-warning">
                    <i class="bi bi-box-arrow-right me-2"></i> Çıkış Yap
                </a>
            </nav>
        </div>

        <!-- SAĞ İÇERİK ALANI -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
            
            <!-- BİLDİRİMLER -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h3 fw-bold text-dark mb-1">Genel Bakış</h2>
                    <p class="text-muted mb-0">Sistem istatistikleri ve ürün yönetimi paneli</p>
                </div>
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary fw-semibold">
                    <i class="bi bi-eye me-1"></i> Siteyi İncele
                </a>
            </div>

            <!-- İSTATİSTİK KARTLARI -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card card-stat bg-primary text-white shadow-sm p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 text-uppercase mb-1 small fw-bold">Toplam Ürün Sayısı</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalProducts ?? 0 }}</h2>
                            </div>
                            <i class="bi bi-box-seam fs-1 text-white-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stat bg-success text-white shadow-sm p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 text-uppercase mb-1 small fw-bold">Toplam Sipariş</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalOrders ?? 0 }}</h2>
                            </div>
                            <i class="bi bi-cart-check fs-1 text-white-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-stat bg-warning text-dark shadow-sm p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-dark-50 text-uppercase mb-1 small fw-bold">Kullanıcı Yorumları</h6>
                                <h2 class="mb-0 fw-bold">{{ $totalReviews ?? 0 }}</h2>
                            </div>
                            <i class="bi bi-star fs-1 text-dark-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                
                <!-- YENİ ÜRÜN EKLEME FORMU -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white py-3 border-0">
                            <h5 class="card-title fw-bold mb-0 text-dark">
                                <i class="bi bi-plus-circle text-primary me-2"></i>Yeni Ürün Ekle
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.dashboard') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Ürün Adı</label>
                                    <input type="text" name="name" class="form-control" placeholder="Örn: Logitech G Pro X" required>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">Fiyat (TL)</label>
                                        <input type="number" step="0.01" name="price" class="form-control" placeholder="0.00" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">Stok Adedi</label>
                                        <input type="number" name="stock" class="form-control" value="10" required>
                                    </div>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">Kategori</label>
                                        <select name="category" class="form-select">
                                            <option value="fare">Fare</option>
                                            <option value="klavye">Klavye</option>
                                            <option value="kablolu-kulaklik">Kablolu Kulaklık</option>
                                            <option value="kablosuz-kulaklik">Kablosuz Kulaklık</option>
                                            <option value="akilli-saat">Akıllı Saat</option>
                                            <option value="dizustu-bilgisayar">Dizüstü Bilgisayar</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">Etiket / Badge</label>
                                        <input type="text" name="badge" class="form-control" placeholder="Örn: Yeni, İndirim">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Görsel URL</label>
                                    <input type="url" name="image" class="form-control" placeholder="https://..." value="https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?auto=format&fit=crop&w=800&q=80">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Ürün Açıklaması</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Ürün hakkında detay bilgi yazın..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">
                                    <i class="bi bi-check-lg me-1"></i> Ürünü Kaydet
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- EKLENEN ÖZEL ÜRÜNLER LİSTESİ VE SİLME BUTONLARI -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title fw-bold mb-0 text-dark">
                                <i class="bi bi-list-stars text-primary me-2"></i>Eklenen Özel Ürünler
                            </h5>
                            @if(!empty($customProducts))
                                <a href="{{ route('custom_products.clear') }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tüm eklenen özel ürünleri silmek istediğinize emin misiniz?');">
                                    <i class="bi bi-trash"></i> Tümünü Temizle
                                </a>
                            @endif
                        </div>
                        <div class="card-body p-0">
                            @if(empty($customProducts))
                                <div class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                    Henüz eklenmiş özel bir ürün bulunmuyor.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 70px;">Görsel</th>
                                                <th>Ürün Adı</th>
                                                <th>Fiyat</th>
                                                <th>Kategori</th>
                                                <th class="text-end px-3" style="width: 120px;">İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customProducts as $key => $product)
                                                @php
                                                    $productId = is_array($product) ? ($product['id'] ?? $key) : ($product->id ?? $key);
                                                    $productName = is_array($product) ? $product['name'] : $product->name;
                                                    $productPrice = is_array($product) ? $product['price'] : $product->price;
                                                    $productImage = is_array($product) ? $product['image'] : $product->image;
                                                    $productCategory = is_array($product) ? $product['category'] : $product->category;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <img src="{{ $productImage }}" alt="{{ $productName }}" style="width: 48px; height: 48px; object-fit: cover;">
                                                    </td>
                                                    <td>
                                                        <div class="fw-bold text-dark">{{ $productName }}</div>
                                                        <small class="text-muted">ID: #{{ $productId }}</small>
                                                    </td>
                                                    <td class="fw-semibold text-primary">{{ number_format((float)$productPrice, 2) }} TL</td>
                                                    <td>
                                                        <span class="badge bg-light text-dark border text-capitalize">{{ $productCategory }}</span>
                                                    </td>
                                                    <td class="text-end px-3">
                                                        <!-- SİLME FORMU VE BUTONU -->
                                                        <form action="{{ route('admin.products.delete', $productId) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm px-3 shadow-sm">
                                                                <i class="bi bi-trash me-1"></i> Sil
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>