<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSwap & Recycle - แพลตฟอร์ม Green Digital เพื่อความยั่งยืน</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts (Kanit & Prompt) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #2d6a4f;
            --mint-green: #52b788;
            --soft-mint: #d8f3dc;
            --accent-yellow: #ffb703;
            --pastel-bg: #f4f9f4;
            --dark-text: #1b4332;
        }

        body {
            font-family: 'Prompt', 'Kanit', sans-serif;
            background-color: var(--pastel-bg);
            color: var(--dark-text);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Kanit', sans-serif;
        }

        /* Navbar Styling */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(45, 106, 79, 0.08);
        }

        .brand-logo {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-green);
        }

        .user-points-badge {
            background: linear-gradient(135deg, #e9c46a, #f4a261);
            color: #fff;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 50px;
            box-shadow: 0 4px 10px rgba(244, 162, 97, 0.3);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #d8f3dc 0%, #b7e4c7 100%);
            padding: 80px 0 60px 0;
            border-radius: 0 0 40px 40px;
            position: relative;
            overflow: hidden;
        }

        .hero-img {
            max-width: 100%;
            filter: drop-shadow(0 15px 25px rgba(0,0,0,0.1));
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }

        /* Cards */
        .custom-card {
            border: none;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(45, 106, 79, 0.12);
        }

        .stat-card {
            background: #ffffff;
            border-left: 5px solid var(--mint-green);
            padding: 20px;
            border-radius: 15px;
        }

        /* Buttons */
        .btn-eco-primary {
            background-color: var(--primary-green);
            color: white;
            border-radius: 30px;
            padding: 12px 28px;
            font-weight: 500;
            border: none;
            box-shadow: 0 5px 15px rgba(45, 106, 79, 0.3);
            transition: all 0.3s ease;
        }

        .btn-eco-primary:hover {
            background-color: #1b4332;
            color: white;
            transform: scale(1.03);
        }

        .btn-eco-secondary {
            background-color: #ffffff;
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
            border-radius: 30px;
            padding: 10px 26px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-eco-secondary:hover {
            background-color: var(--soft-mint);
            color: var(--primary-green);
        }

        /* Reward Cards */
        .reward-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent-yellow);
            color: #000;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        /* Modal styling */
        .modal-content {
            border-radius: 25px;
            border: none;
        }

        .bmc-box {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            height: 100%;
            border: 1px solid #e9ecef;
        }
        
        .bmc-title {
            color: var(--primary-green);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        /* Waste option selection */
        .waste-type-card {
            cursor: pointer;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            transition: all 0.2s ease;
        }

        .waste-type-card.selected {
            border-color: var(--mint-green);
            background-color: var(--soft-mint);
        }

        .waste-type-card i {
            font-size: 2rem;
            color: var(--primary-green);
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <!-- NAVBAR HEADER -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top navbar-custom">
        <div class="container">
            <a class="navbar-brand brand-logo" href="https://canva.link/pgakglakpijupdm">
                <i class="fa-solid fa-leaf text-success me-2"></i>EcoSwap
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-lg-4 mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#home">หน้าแรก</a></li>
                    <li class="nav-item"><a class="nav-link" href="#booking-section">เรียกรถรับขยะ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#rewards-section">ร้านค้าแลกแต้ม</a></li>
                    <li class="nav-item"><a class="nav-link" href="#impact-section">ผลกระทบต่อสิ่งแวดล้อม</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-warning text-dark fw-bold rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#bmcModal">
                        <i class="fa-solid fa-lightbulb me-1"></i> ดู BMC & Design Thinking
                    </button>
                    <div class="user-points-badge">
                        <i class="fa-solid fa-coins me-1"></i> <span id="userPointsDisplay">250</span> แต้ม
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- SECTION 1: HERO SECTION -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="badge bg-white text-success rounded-pill px-3 py-2 mb-3 shadow-sm fw-normal">
                        🌱 นวัตกรรมดิจิทัลเพื่อความยั่งยืน (Green Digital Platform)
                    </span>
                    <h1 class="display-5 fw-bold mb-3 text-success-emphasis">
                        เปลี่ยนขยะในบ้าน <br><span class="text-success">ให้กลายเป็นแต้มรีไซเคิล</span>
                    </h1>
                    <p class="lead text-secondary mb-4">
                        แพลตฟอร์มดิจิทัลที่ช่วยให้คุณส่งต่อขยะพลาสติก ขยะอิเล็กทรอนิกส์ และเสื้อผ้ามือสองเข้าสู่กระบวนการ Recycle ได้ง่ายๆ พร้อมรับสิทธิประโยชน์มากมาย
                    </p>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="#booking-section" class="btn btn-eco-primary">
                            <i class="fa-solid fa-truck-pickup me-2"></i>เรียกรถรับขยะถึงบ้าน
                        </a>
                        <button class="btn btn-eco-secondary" onclick="alert('ระบบค้นหาจุด Drop-off กำลังเปิดระบุตำแหน่งของคุณ...')">
                            <i class="fa-solid fa-location-dot me-2"></i>ค้นหาจุด Drop-off
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <svg viewBox="0 0 500 400" class="hero-img" xmlns="http://www.w3.org/2000/svg">
                        <!-- Graphic Illustration for Eco Digital -->
                        <circle cx="250" cy="200" r="150" fill="#a8e6cf" opacity="0.5"/>
                        <path d="M150 250 C150 150, 350 150, 350 250 Z" fill="#52b788"/>
                        <rect x="220" y="100" width="60" height="90" rx="10" fill="#2d6a4f"/>
                        <circle cx="250" cy="145" r="25" fill="#74c69d"/>
                        <path d="M200 280 Q250 220 300 280" stroke="#1b4332" stroke-width="8" stroke-linecap="round" fill="none"/>
                        <circle cx="180" cy="180" r="20" fill="#ffb703"/>
                        <i class="fa-solid fa-leaf"></i>
                        <!-- Plant icon element inside SVG -->
                        <path d="M 240 130 C 240 100, 270 100, 270 130 Z" fill="#d8f3dc"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- IMPACT STATS SECTION -->
    <section id="impact-section" class="container my-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="stat-card custom-card">
                    <i class="fa-solid fa-dumpster text-success fa-2x mb-2"></i>
                    <h3 class="fw-bold text-success mb-1" id="statPlastic">12,450 kg</h3>
                    <p class="text-muted mb-0">ขยะพลาสติกรีไซเคิลแล้ว</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card custom-card" style="border-left-color: #ffb703;">
                    <i class="fa-solid fa-bolt text-warning fa-2x mb-2"></i>
                    <h3 class="fw-bold text-warning mb-1">3,120 ชิ้น</h3>
                    <p class="text-muted mb-0">ขยะ E-Waste จัดการอย่างถูกวิธี</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card custom-card" style="border-left-color: #2a9d8f;">
                    <i class="fa-solid fa-cloud-arrow-down text-info fa-2x mb-2"></i>
                    <h3 class="fw-bold text-info mb-1">18.5 ตัน</h3>
                    <p class="text-muted mb-0">ลดการปล่อยก๊าซเรือนกระจก (CO2)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: PICK-UP BOOKING FORM -->
    <section id="booking-section" class="container my-5 py-4">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <span class="text-success fw-bold text-uppercase">Smart Service</span>
                <h2 class="fw-bold mb-3">จองคิวเรียกรถรับขยะถึงหน้าบ้าน</h2>
                <p class="text-muted">
                    เพียงระบุประเภทขยะและประเมินน้ำหนัก ระบบจะคำนวณ Eco-Points ที่คุณจะได้รับทันที จากนั้นทีมงานจะเข้ารับขยะถึงที่ตามวันและเวลาที่คุณสะดวก
                </p>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-white p-3 rounded-circle shadow-sm text-success">
                        <i class="fa-solid fa-shield-halved fa-xl"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">ปลอดภัย ปราศจากเชื้อโรค</h6>
                        <small class="text-muted">เจ้าหน้าที่ได้รับคัดกรองและสวมอุปกรณ์ป้องกันมาตรฐาน</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white p-3 rounded-circle shadow-sm text-success">
                        <i class="fa-solid fa-coins fa-xl"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">ได้รับแต้มทันที</h6>
                        <small class="text-muted">แต้มโอนเข้าบัญชีทันทีเมื่อขยะผ่านการชั่งน้ำหนัก</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="custom-card p-4 p-md-5">
                    <h4 class="fw-bold mb-4 text-success"><i class="fa-regular fa-calendar-check me-2"></i>ฟอร์มเรียกรถรับขยะ</h4>
                    
                    <form id="bookingForm" onsubmit="handleBookingSubmit(event)">
                        <!-- เลือกประเภทขยะ -->
                        <label class="form-label fw-bold">1. เลือกประเภทขยะที่คุณต้องการส่งต่อ</label>
                        <div class="row g-3 mb-4">
                            <div class="col-4">
                                <div class="waste-type-card selected" onclick="selectWasteType(this, 'plastic', 10)">
                                    <i class="fa-solid fa-bottle-water"></i>
                                    <div class="fw-bold small">พลาสติก</div>
                                    <small class="text-muted">10 แต้ม/กก.</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="waste-type-card" onclick="selectWasteType(this, 'ewaste', 50)">
                                    <i class="fa-solid fa-plug"></i>
                                    <div class="fw-bold small">E-Waste</div>
                                    <small class="text-muted">50 แต้ม/กก.</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="waste-type-card" onclick="selectWasteType(this, 'clothes', 15)">
                                    <i class="fa-solid fa-shirt"></i>
                                    <div class="fw-bold small">เสื้อผ้าเก่า</div>
                                    <small class="text-muted">15 แต้ม/กก.</small>
                                </div>
                            </div>
                        </div>

                        <!-- ประมาณการน้ำหนัก -->
                        <div class="mb-4">
                            <label for="weightInput" class="form-label fw-bold">2. ประเมินน้ำหนัก (กิโลกรัม)</label>
                            <input type="number" class="form-control form-control-lg rounded-pill" id="weightInput" min="1" max="100" value="5" oninput="calculateEstimatedPoints()" required>
                        </div>

                        <!-- ผลลัพธ์แต้มประมาณการ -->
                        <div class="p-3 bg-light rounded-4 mb-4 d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block">คะแนน Eco-Points ที่คาดว่าจะได้รับ:</small>
                                <span class="fs-4 fw-bold text-success" id="estimatedPointsDisplay">50</span> แต้ม
                            </div>
                            <i class="fa-solid fa-gift fa-2x text-warning"></i>
                        </div>

                        <!-- วันและเวลา -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">วันที่ต้องการให้เข้ารับ</label>
                                <input type="date" class="form-control rounded-pill" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">ช่วงเวลา</label>
                                <select class="form-select rounded-pill">
                                    <option>09:00 - 12:00 น.</option>
                                    <option>13:00 - 16:00 น.</option>
                                </select>
                            </div>
                        </div>

                        <!-- ที่อยู่ -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">ที่อยู่สำหรับเข้ารับขยะ</label>
                            <textarea class="form-control rounded-4" rows="2" placeholder="ระบุบ้านเลขที่ ถนน ซอย หรือจุดสังเกต..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-eco-primary w-100 py-3 fs-5">
                            <i class="fa-solid fa-paper-plane me-2"></i>ยืนยันการนัดหมาย
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: ECO-REWARD SHOP -->
    <section id="rewards-section" class="bg-white py-5">
        <div class="container">
            <div class="text-center max-w-2xl mx-auto mb-5">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-2">Eco-Reward Marketplace</span>
                <h2 class="fw-bold">ร้านค้าแลกรางวัล Green Points</h2>
                <p class="text-muted">นำแต้มสะสมที่คุณได้จากการแยกขยะมาแลกรับส่วนลดและของรางวัลสาย Green</p>
            </div>

            <div class="row g-4">
                <!-- Reward Item 1 -->
                <div class="col-md-4">
                    <div class="custom-card h-100 position-relative overflow-hidden">
                        <span class="reward-badge"><i class="fa-solid fa-coins me-1"></i>100 แต้ม</span>
                        <img src="https://images.unsplash.com/photo-1544787219-7f47ccb76574?auto=format&fit=crop&w=600&q=80" class="card-img-top" style="height: 180px; object-fit: cover;" alt="แก้วกาแฟรักษ์โลก" onerror="this.src='https://placehold.co/600x400/2d6a4f/ffffff?text=Eco+Coffee+Cup'">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold">ส่วนลด 50 บาท ร้าน Green Coffee</h5>
                            <p class="card-text text-muted small flex-grow-1">คูปองส่วนลดสำหรับเครื่องดื่มทุกประเภทเมื่อนำแก้วมาเองที่ร้านพันธมิตร</p>
                            <button class="btn btn-eco-primary w-100 mt-3" onclick="redeemReward('คูปองส่วนลด Green Coffee 50 บาท', 100)">
                                แลกรับสิทธิ์
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Reward Item 2 -->
                <div class="col-md-4">
                    <div class="custom-card h-100 position-relative overflow-hidden">
                        <span class="reward-badge"><i class="fa-solid fa-coins me-1"></i>150 แต้ม</span>
                        <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=600&q=80" class="card-img-top" style="height: 180px; object-fit: cover;" alt="ปลูกต้นไม้" onerror="this.src='https://placehold.co/600x400/52b788/ffffff?text=Plant+a+Tree'">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold">ร่วมปลูกต้นไม้ 1 ต้น (Tree Donation)</h5>
                            <p class="card-text text-muted small flex-grow-1">สมทบทุนปลูกต้นไม้ยางนาในพื้นที่ป่าชุมชน พร้อมรับเกียรติบัตรดิจิทัล</p>
                            <button class="btn btn-eco-primary w-100 mt-3" onclick="redeemReward('สิทธิ์สมทบทุนปลูกต้นไม้ 1 ต้น', 150)">
                                แลกรับสิทธิ์
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Reward Item 3 -->
                <div class="col-md-4">
                    <div class="custom-card h-100 position-relative overflow-hidden">
                        <span class="reward-badge"><i class="fa-solid fa-coins me-1"></i>200 แต้ม</span>
                        <img src="https://images.unsplash.com/photo-1590874103328-eac38a683ce7?auto=format&fit=crop&w=600&q=80" class="card-img-top" style="height: 180px; object-fit: cover;" alt="ถุงผ้าแคนวาส" onerror="this.src='https://placehold.co/600x400/ffb703/000000?text=Eco+Bag'">
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold">กระเป๋าผ้า EcoSwap Limited</h5>
                            <p class="card-text text-muted small flex-grow-1">กระเป๋าผ้าแคนวาสทำจากเส้นใยพลาสติกรีไซเคิล 100% สวยงามทนทาน</p>
                            <button class="btn btn-eco-primary w-100 mt-3" onclick="redeemReward('กระเป๋าผ้า EcoSwap Limited', 200)">
                                แลกรับสิทธิ์
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center text-md-start">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="fw-bold text-success mb-1"><i class="fa-solid fa-leaf me-2"></i>EcoSwap & Recycle</h5>
                    <p class="small text-secondary mb-0">โครงการต้นแบบข้อสอบปลายภาควิชาการสร้างเว็บไซต์ (Green Digital Project)</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-secondary">&copy; 2026 EcoSwap Platform. All Rights Reserved.</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- MODAL: BMC & DESIGN THINKING PRESENTATION -->
    <div class="modal fade" id="bmcModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="fa-solid fa-chalkboard-user me-2"></i>กรอบแนวคิด Green Digital, Design Thinking & BMC
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">

                    <!-- SECTION A: DESIGN THINKING -->
                    <div class="mb-5">
                        <h4 class="fw-bold text-success border-bottom pb-2 mb-3">
                            <i class="fa-solid fa-brain me-2"></i>1. กระบวนการ Design Thinking
                        </h4>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="bmc-box">
                                    <div class="bmc-title"><i class="fa-solid fa-heart me-1"></i> 1. Empathize (เข้าใจผู้ใช้)</div>
                                    <p class="small text-muted mb-0">ผู้คนในปัจจุบันต้องการแยกรักษา環境แต่ไม่รู้จะนำขยะไปทิ้งที่ไหน ขาดแรงจูงใจ และรู้สึกว่าขั้นตอนยุ่งยาก</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bmc-box">
                                    <div class="bmc-title"><i class="fa-solid fa-bullseye me-1"></i> 2. Define (กำหนดปัญหา)</div>
                                    <p class="small text-muted mb-0">สร้างโซลูชันอย่างไรให้การส่งต่อขยะรีไซเคิลเป็นเรื่องง่าย มีความสะดวก และได้รับรางวัลตอบแทน (Eco-Reward)</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bmc-box">
                                    <div class="bmc-title"><i class="fa-solid fa-lightbulb me-1"></i> 3. Ideate (ระดมความคิด)</div>
                                    <p class="small text-muted mb-0">ออกแบบเว็บแอปพลิเคชันระบบนัดเวลารถรับขยะถึงบ้าน พร้อมระบบคำนวณเปลี่ยนขยะเป็น Eco-Points</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION B: BUSINESS MODEL CANVAS -->
                    <div>
                        <h4 class="fw-bold text-success border-bottom pb-2 mb-3">
                            <i class="fa-solid fa-table-cells me-2"></i>2. Business Model Canvas (BMC 9 ช่อง)
                        </h4>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="bmc-box">
                                    <div class="bmc-title">1. Key Partners (พันธมิตร)</div>
                                    <ul class="small text-muted ps-3 mb-0">
                                        <li>โรงงาน/ร้านรับซื้อของเก่า</li>
                                        <li>แบรนด์รักษ์โลก & ร้านกาแฟ</li>
                                        <li>ผู้ให้บริการขนส่ง</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bmc-box">
                                    <div class="bmc-title">2. Key Activities (กิจกรรมหลัก)</div>
                                    <ul class="small text-muted ps-3 mb-0">
                                        <li>พัฒนาและดูแลระบบเว็บ</li>
                                        <li>บริหารการจัดส่ง/รถรับขยะ</li>
                                        <li>จัดกิจกรรมแลกแต้ม</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bmc-box">
                                    <div class="bmc-title">3. Value Propositions (คุณค่า)</div>
                                    <ul class="small text-muted ps-3 mb-0">
                                        <li>บริการรับขยะถึงบ้านสะดวกสบาย</li>
                                        <li>เปลี่ยนขยะเป็นแต้มลดหย่อนได้</li>
                                        <li>ช่วยลดก๊าซเรือนกระจกได้จริง</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bmc-box">
                                    <div class="bmc-title">4. Customer Relationships</div>
                                    <ul class="small text-muted ps-3 mb-0">
                                        <li>ระบบสมาชิกและแต้มสะสม</li>
                                        <li>การแจ้งเตือนสถานะการรับขยะ</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bmc-box">
                                    <div class="bmc-title">5. Customer Segments (กลุ่มเป้าหมาย)</div>
                                    <ul class="small text-muted ps-3 mb-0">
                                        <li>คนรุ่นใหม่ที่ใส่ใจสิ่งแวดล้อม</li>
                                        <li>ครัวเรือนทั่วไปในเมืองใหญ่</li>
                                        <li>โรงงานต้องการวัตถุดิบ Recycle</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bmc-box">
                                    <div class="bmc-title">6. Key Resources (ทรัพยากรหลัก)</div>
                                    <ul class="small text-muted ps-3 mb-0">
                                        <li>ซอฟต์แวร์แพลตฟอร์ม EcoSwap</li>
                                        <li>เครือข่ายจุด Drop-off และขนส่ง</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bmc-box">
                                    <div class="bmc-title">7. Cost Structure (โครงสร้างต้นทุน)</div>
                                    <small class="text-muted">ค่าพัฒนาเว็บ/เซิร์ฟเวอร์, ค่าขนส่งและรับซื้อขยะ, ค่าการตลาดประชาสัมพันธ์</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bmc-box">
                                    <div class="bmc-title">8. Revenue Streams (รายได้)</div>
                                    <small class="text-muted">ส่วนต่างการขายวัสดุรีไซเคิลให้โรงงาน, ค่าโฆษณาจากแบรนด์สาย Green, ค่าธรรมเนียมสปอนเซอร์</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">ปิดหน้าต่าง</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Interactivity Script -->
    <script>
        // State variables
        let userPoints = 250;
        let selectedWastePointsPerKg = 10; // Default plastic

        // Function to select waste type in form
        function selectWasteType(element, type, pointsPerKg) {
            // Remove selected class from all
            document.querySelectorAll('.waste-type-card').forEach(card => {
                card.classList.remove('selected');
            });
            // Add to current
            element.classList.add('selected');
            selectedWastePointsPerKg = pointsPerKg;
            calculateEstimatedPoints();
        }

        // Calculate points based on weight input
        function calculateEstimatedPoints() {
            const weight = parseFloat(document.getElementById('weightInput').value) || 0;
            const totalPoints = weight * selectedWastePointsPerKg;
            document.getElementById('estimatedPointsDisplay').innerText = totalPoints;
        }

        // Handle booking form submission
        function handleBookingSubmit(event) {
            event.preventDefault();
            const estimatedPoints = parseInt(document.getElementById('estimatedPointsDisplay').innerText);
            
            // Add points to user state
            userPoints += estimatedPoints;
            document.getElementById('userPointsDisplay').innerText = userPoints;

            alert(`🎉 บันทึกการนัดหมายเรียบร้อยแล้ว!\n\nขอบคุณที่ร่วมเป็นส่วนหนึ่งในการรักษ์โลก คุณจะได้รับคะแนนประมาณ ${estimatedPoints} แต้มเมื่อการเข้ารับเสร็จสิ้น`);
            
            // Reset form
            document.getElementById('bookingForm').reset();
            calculateEstimatedPoints();
        }

        // Redeem Reward Logic
        function redeemReward(rewardName, pointCost) {
            if (userPoints >= pointCost) {
                userPoints -= pointCost;
                document.getElementById('userPointsDisplay').innerText = userPoints;
                alert(`🎁 แลกรับสิทธิ์สำเร็จ!\n\nคุณได้แลกรับ: ${rewardName}\nแต้มคงเหลือ: ${userPoints} แต้ม`);
            } else {
                alert(`⚠️ แต้มสะสมของคุณไม่พอ!\n\nคุณต้องการ ${pointCost} แต้ม แต่มี่อยู่ ${userPoints} แต้ม (ลองส่งขยะมารีไซเคิลเพื่อสะสมแต้มเพิ่มได้นะ)`);
            }
             }
    </script>
</body>
</html>