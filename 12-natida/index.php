
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Green Market - ตลาดออนไลน์รักษ์โลก</title>

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Tahoma, sans-serif;
    background: #f5f8f3;
    color: #183329;
}

header {
    background: #176b45;
    color: white;
    padding: 18px 7%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.logo {
    font-size: 25px;
    font-weight: bold;
}

nav a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}

nav a:hover {
    text-decoration: underline;
}

.hero {
    background: #dff1e5;
    padding: 65px 8%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 30px;
}

.hero-content {
    max-width: 600px;
}

.hero h1 {
    font-size: 40px;
    color: #176b45;
    margin-bottom: 20px;
}

.hero p {
    line-height: 1.8;
    margin-bottom: 25px;
}

.hero-image {
    font-size: 130px;
    text-align: center;
}

.btn {
    background: #176b45;
    color: white;
    border: none;
    padding: 12px 22px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
}

.btn:hover {
    background: #105335;
}

.search {
    max-width: 1100px;
    margin: 30px auto;
    padding: 0 20px;
    display: flex;
    gap: 10px;
}

.search input {
    flex: 1;
    padding: 14px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 16px;
}

.container {
    max-width: 1100px;
    margin: auto;
    padding: 30px 20px;
}

.section-title {
    font-size: 28px;
    color: #176b45;
    margin-bottom: 10px;
}

.description {
    color: #718277;
    margin-bottom: 25px;
}

.filters {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}

.filter-btn {
    padding: 9px 18px;
    border: 1px solid #176b45;
    background: white;
    color: #176b45;
    border-radius: 25px;
    cursor: pointer;
}

.filter-btn.active,
.filter-btn:hover {
    background: #176b45;
    color: white;
}

.products {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
}

.product {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid #e3ebe3;
    transition: 0.3s;
}

.product:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px #00000015;
}

.product-image {
    height: 180px;
    background: #e6f2e6;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 75px;
    position: relative;
}

.product-info {
    padding: 18px;
}

.product-info h3 {
    margin-bottom: 10px;
}

.product-info p {
    color: #718277;
    line-height: 1.6;
    min-height: 48px;
    margin-bottom: 15px;
}

.price {
    color: #21804f;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
}

.product-info button {
    width: 100%;
    padding: 10px;
    background: #176b45;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.product-info button:hover {
    background: #105335;
}

.impact {
    margin-top: 60px;
    background: #176b45;
    color: white;
    padding: 35px;
    border-radius: 18px;
    text-align: center;
}

.impact h2 {
    margin-bottom: 15px;
}

.stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 25px;
}

.stat {
    background: #ffffff20;
    padding: 20px;
    border-radius: 12px;
}

.stat h3 {
    font-size: 28px;
    margin-bottom: 8px;
}

footer {
    background: #e8f1e8;
    text-align: center;
    padding: 25px;
    margin-top: 50px;
    color: #55705e;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: #0009;
    justify-content: center;
    align-items: center;
    padding: 20px;
    z-index: 10;
}

.modal-content {
    background: white;
    padding: 25px;
    width: 450px;
    max-width: 100%;
    border-radius: 15px;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-content h2 {
    color: #176b45;
    margin-bottom: 20px;
}

.modal-content input,
.modal-content select,
.modal-content textarea {
    width: 100%;
    padding: 12px;
    margin: 8px 0 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
}

.modal-content label {
    font-weight: bold;
}

.close {
    float: right;
    cursor: pointer;
    font-size: 25px;
    border: none;
    background: none;
}

@media(max-width: 760px) {
    .hero h1 {
        font-size: 30px;
    }

    .products {
        grid-template-columns: repeat(2, 1fr);
    }

    .hero-image {
        width: 100%;
    }
}

@media(max-width: 480px) {
    .products {
        grid-template-columns: 1fr;
    }

    .stats {
        grid-template-columns: 1fr;
    }

    nav {
        display: flex;
        flex-wrap: wrap;
    }

    nav a {
        margin-left: 0;
        margin-right: 12px;
    }
}
</style>
</head>

<body>

<!-- ส่วนหัวเว็บไซต์ -->
<header>
    <div class="logo">🌱 Green Market</div>

    <nav>
        <a href="#home">หน้าแรก</a>
        <a href="#products">สินค้า</a>
        <a href="#impact">ผลกระทบต่อโลก</a>
        <a href="#contact">ติดต่อเรา</a>
    </nav>
</header>

<!-- หน้าแรก -->
<section class="hero" id="home">

    <div class="hero-content">
        <h1>ของที่คุณไม่ใช้<br>อาจมีคุณค่าสำหรับใครอีกคน</h1>

        <p>
            Green Market ตลาดออนไลน์รักษ์โลก
            แหล่งซื้อขาย แลกเปลี่ยน และส่งต่อสิ่งของมือสอง
            เพื่อช่วยลดขยะและใช้ทรัพยากรอย่างคุ้มค่า
        </p>

        <button class="btn"
        onclick="document.getElementById('products').scrollIntoView({behavior:'smooth'})">
            เลือกชมสินค้า
        </button>
    </div>

    <div class="hero-image">
        🌍
    </div>

</section>

<!-- ช่องค้นหาสินค้า -->
<div class="search">

    <input type="text"
    id="searchInput"
    placeholder="ค้นหาสินค้า เช่น กระเป๋า หนังสือ ขวดแก้ว">

    <button class="btn" onclick="searchProduct()">
        ค้นหา
    </button>

</div>

<!-- รายการสินค้า -->
<main class="container" id="products">

    <h2 class="section-title">
        สินค้าน่าใช้ ส่งต่อได้ ♻️
    </h2>

    <p class="description">
        เลือกซื้อสินค้ามือสองคุณภาพดี
        ช่วยลดการใช้ทรัพยากรใหม่และรักษาสิ่งแวดล้อม
    </p>

    <!-- หมวดหมู่สินค้า -->
    <div class="filters">

        <button class="filter-btn active"
        onclick="filterProduct('ทั้งหมด',this)">
            ทั้งหมด
        </button>

        <button class="filter-btn"
        onclick="filterProduct('แฟชั่น',this)">
            แฟชั่น
        </button>

        <button class="filter-btn"
        onclick="filterProduct('ของใช้',this)">
            ของใช้
        </button>

        <button class="filter-btn"
        onclick="filterProduct('หนังสือ',this)">
            หนังสือ
        </button>

        <button class="filter-btn"
        onclick="filterProduct('รีไซเคิล',this)">
            รีไซเคิล
        </button>

    </div>

    <!-- แสดงสินค้า -->
    <div class="products" id="productList"></div>

    <!-- ผลกระทบต่อสิ่งแวดล้อม -->
    <section class="impact" id="impact">

        <h2>ทุกการส่งต่อ มีความหมาย 🌳</h2>

        <p>
            เริ่มต้นจากสิ่งเล็ก ๆ ด้วยการเลือกใช้ของเดิมให้นานขึ้น
            เพื่อโลกที่น่าอยู่สำหรับทุกคน
        </p>

        <div class="stats">

            <div class="stat">
                <h3 id="totalItems">128</h3>
                <p>ชิ้นที่ถูกส่งต่อ</p>
            </div>

            <div class="stat">
                <h3>85 kg</h3>
                <p>ขยะที่ช่วยลดได้</p>
            </div>

            <div class="stat">
                <h3>320+</h3>
                <p>สมาชิกชุมชน</p>
            </div>

        </div>

    </section>

</main>

<!-- ส่วนท้ายเว็บไซต์ -->
<footer id="contact">

    <h3>🌿 Green Market</h3>

    <p>ส่งต่อของดี ลดขยะ สร้างโลกที่ยั่งยืน</p>

    <p>เว็บไซต์ต้นแบบเพื่อการศึกษา | Green Digital Business</p>

    <p>© 2026 Green Market</p>

</footer>

<!-- หน้าต่างลงขายสินค้า -->
<div class="modal" id="sellModal">

    <div class="modal-content">

        <button class="close" onclick="closeModal()">×</button>

        <h2>ลงขายสินค้า 🌱</h2>

        <form id="sellForm">

            <label>ชื่อสินค้า</label>

            <input type="text"
            id="itemName"
            placeholder="กรอกชื่อสินค้า"
            required>

            <label>หมวดหมู่สินค้า</label>

            <select id="itemCategory">

                <option value="แฟชั่น">แฟชั่น</option>
                <option value="ของใช้">ของใช้</option>
                <option value="หนังสือ">หนังสือ</option>
                <option value="รีไซเคิล">รีไซเคิล</option>

            </select>

            <label>ราคา (บาท)</label>

            <input type="number"
            id="itemPrice"
            min="0"
            placeholder="กรอกราคา"
            required>

            <label>รายละเอียดสินค้า</label>

            <textarea id="itemDesc"
            placeholder="รายละเอียดสินค้า"></textarea>

            <button class="btn" type="submit" style="width:100%">
                เพิ่มสินค้า
            </button>

        </form>

    </div>

</div>

<script>

// ข้อมูลสินค้าเริ่มต้น
let products = [

    {
        name: "กระเป๋าผ้าแคนวาส",
        category: "แฟชั่น",
        price: 89,
        description: "กระเป๋าผ้าสภาพดี ลดการใช้ถุงพลาสติก",
        image: "👜",
        color: "#e6efe0"
    },

    {
        name: "แก้วน้ำสเตนเลส",
        category: "ของใช้",
        price: 120,
        description: "แก้วน้ำเก็บอุณหภูมิ ใช้งานได้ดี",
        image: "🥤",
        color: "#e2edf0"
    },

    {
        name: "หนังสือปลูกต้นไม้",
        category: "หนังสือ",
        price: 60,
        description: "หนังสือให้ความรู้เกี่ยวกับการปลูกต้นไม้",
        image: "📚",
        color: "#f2eadb"
    },

    {
        name: "ขวดแก้วพร้อมใช้",
        category: "รีไซเคิล",
        price: 0,
        description: "ขวดแก้วสะอาด สามารถนำกลับมาใช้ใหม่",
        image: "🫙",
        color: "#e0efeb"
    },

    {
        name: "เสื้อเชิ้ตมือสอง",
        category: "แฟชั่น",
        price: 100,
        description: "เสื้อเชิ้ตมือสองสภาพดี",
        image: "👕",
        color: "#f2e5e2"
    },

    {
        name: "กระถางต้นไม้รีไซเคิล",
        category: "รีไซเคิล",
        price: 35,
        description: "กระถางต้นไม้ทำจากวัสดุเหลือใช้",
        image: "🪴",
        color: "#e5efdc"
    }

];

let currentCategory = "ทั้งหมด";

// แสดงรายการสินค้า
function showProducts() {

    let list = document.getElementById("productList");

    let keyword = document.getElementById("searchInput")
    .value.toLowerCase();

    let filtered = products.filter(function(p) {

        let matchCategory =
        currentCategory === "ทั้งหมด" ||
        p.category === currentCategory;

        let matchSearch =
        (p.name + p.description + p.category)
        .toLowerCase()
        .includes(keyword);

        return matchCategory && matchSearch;

    });

    list.innerHTML = "";

    if (filtered.length === 0) {

        list.innerHTML =
        "<p style='padding:30px'>ไม่พบสินค้าที่ค้นหา 🌱</p>";

        return;

    }

    filtered.forEach(function(p) {

        let card = document.createElement("div");

        card.className = "product";

        let image = document.createElement("div");
        image.className = "product-image";
        image.style.background = p.color;
        image.textContent = p.image;

        let info = document.createElement("div");
        info.className = "product-info";

        let name = document.createElement("h3");
        name.textContent = p.name;

        let desc = document.createElement("p");
        desc.textContent = p.description;

        let price = document.createElement("div");
        price.className = "price";
        price.textContent =
        p.price === 0 ? "ฟรี" : p.price.toLocaleString("th-TH") + " บาท";

        let button = document.createElement("button");
        button.textContent = "สนใจสินค้า";

        button.onclick = function() {
            alert("คุณสนใจสินค้า: " + p.name);
        };

        info.appendChild(name);
        info.appendChild(desc);
        info.appendChild(price);
        info.appendChild(button);

        card.appendChild(image);
        card.appendChild(info);

        list.appendChild(card);

    });

}

// ค้นหาสินค้า
function searchProduct() {
    showProducts();
}

// กรองหมวดหมู่สินค้า
function filterProduct(category, button) {

    currentCategory = category;

    document.querySelectorAll(".filter-btn")
    .forEach(function(btn) {
        btn.classList.remove("active");
    });

    button.classList.add("active");

    showProducts();

}

// เปิดหน้าต่างลงขายสินค้า
function openModal() {

    document.getElementById("sellModal")
    .style.display = "flex";

}

// ปิดหน้าต่างลงขายสินค้า
function closeModal() {

    document.getElementById("sellModal")
    .style.display = "none";

}

// เพิ่มสินค้าใหม่
document.getElementById("sellForm")
.addEventListener("submit", function(e) {

    e.preventDefault();

    let name = document.getElementById("itemName").value;

    let category = document.getElementById("itemCategory").value;

    let price = Number(document.getElementById("itemPrice").value);

    let description = document.getElementById("itemDesc").value;

    let icons = {
        "แฟชั่น": "👕",
        "ของใช้": "🏠",
        "หนังสือ": "📚",
        "รีไซเคิล": "♻️"
    };

    products.unshift({

        name: name,
        category: category,
        price: price,
        description: description,
        image: icons[category],
        color: "#e5efdf"

    });

    currentCategory = "ทั้งหมด";

    document.querySelectorAll(".filter-btn")
    .forEach(function(btn) {
        btn.classList.toggle(
            "active",
            btn.textContent.trim() === "ทั้งหมด"
        );
    });

    document.getElementById("sellForm").reset();

    closeModal();

    document.getElementById("totalItems").textContent =
    Number(document.getElementById("totalItems").textContent) + 1;

    showProducts();

    alert("เพิ่มสินค้าสำเร็จ 🌱");

});

// แสดงสินค้าเมื่อเปิดเว็บไซต์
showProducts();

</script>

</body>
</html>
