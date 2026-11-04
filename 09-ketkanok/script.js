
// ข้อมูลตัวอย่างสิ่งของ
const defaultItems = [
    {
        id: 1,
        name: "เสื้อยืดสีเขียว",
        category: "เสื้อผ้า",
        description: "เสื้อสภาพดี ใส่ได้ปกติ",
        location: "นครราชสีมา",
        contact: "Line: greenshare",
        emoji: "👕"
    },
    {
        id: 2,
        name: "หนังสือเรียน",
        category: "หนังสือ",
        description: "หนังสือมือสอง มีประโยชน์สำหรับผู้เรียน",
        location: "นครราชสีมา",
        contact: "Line: bookshare",
        emoji: "📚"
    },
    {
        id: 3,
        name: "กระเป๋าผ้า",
        category: "กระเป๋า",
        description: "กระเป๋าผ้า สภาพดี พร้อมใช้งาน",
        location: "บุรีรัมย์",
        contact: "Line: bagshare",
        emoji: "👜"
    },
    {
        id: 4,
        name: "โคมไฟตั้งโต๊ะ",
        category: "ของใช้ในบ้าน",
        description: "โคมไฟใช้งานได้ปกติ",
        location: "สุรินทร์",
        contact: "Line: homeshare",
        emoji: "💡"
    },
    {
        id: 5,
        name: "หูฟัง",
        category: "อิเล็กทรอนิกส์",
        description: "หูฟังสภาพดี ใช้งานได้",
        location: "นครราชสีมา",
        contact: "Line: techshare",
        emoji: "🎧"
    },
    {
        id: 6,
        name: "ตุ๊กตา",
        category: "อื่นๆ",
        description: "ตุ๊กตาน่ารัก สภาพสะอาด",
        location: "บุรีรัมย์",
        contact: "Line: sharetoy",
        emoji: "🧸"
    }
];

// โหลดข้อมูลจากเบราว์เซอร์
let items = JSON.parse(localStorage.getItem("greenItems")) || defaultItems;
let favorites = JSON.parse(localStorage.getItem("greenFavorites")) || [];

// บันทึกข้อมูล
function saveData() {
    localStorage.setItem("greenItems", JSON.stringify(items));
    localStorage.setItem("greenFavorites", JSON.stringify(favorites));
}

// แสดงข้อความแจ้งเตือน
function showToast(message) {
    const toast = document.getElementById("toast");
    toast.textContent = message;
    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
    }, 2500);
}

// เลือกรูปสัญลักษณ์ตามหมวดหมู่
function getEmoji(category) {
    const emojis = {
        "เสื้อผ้า": "👕",
        "หนังสือ": "📚",
        "กระเป๋า": "👜",
        "ของใช้ในบ้าน": "💡",
        "อิเล็กทรอนิกส์": "🎧",
        "อื่นๆ": "🎁"
    };

    return emojis[category] || "📦";
}

// แสดงรายการสิ่งของ
function displayItems() {
    const productList = document.getElementById("productList");
    const searchText = document.getElementById("searchInput")
        .value.toLowerCase().trim();
    const category = document.getElementById("categoryFilter").value;

    const filteredItems = items.filter(item => {
        const matchName = item.name.toLowerCase().includes(searchText);
        const matchCategory =
            category === "ทั้งหมด" || item.category === category;

        return matchName && matchCategory;
    });

    productList.innerHTML = "";

    document.getElementById("emptyMessage").hidden =
        filteredItems.length !== 0;

    filteredItems.forEach(item => {
        const isFavorite = favorites.includes(item.id);

        const card = document.createElement("article");
        card.className = "product-card";

        const emoji = document.createElement("div");
        emoji.className = "product-emoji";
        emoji.textContent = item.emoji || getEmoji(item.category);

        const name = document.createElement("h3");
        name.textContent = item.name;

        const categoryText = document.createElement("p");
        categoryText.textContent = "หมวดหมู่: " + item.category;

        const description = document.createElement("p");
        description.textContent = item.description;

        const location = document.createElement("p");
        location.textContent = "📍 " + item.location;

        const actions = document.createElement("div");
        actions.className = "card-actions";

        const contactButton = document.createElement("button");
        contactButton.textContent = "ติดต่อรับสิ่งของ";
        contactButton.addEventListener("click", () => {
            showToast("ช่องทางติดต่อ: " + item.contact);
        });

        const likeButton = document.createElement("button");
        likeButton.className = "like-btn";
        likeButton.textContent = isFavorite ? "❤️" : "🤍";
        likeButton.setAttribute("aria-label", "เพิ่มหรือนำออกจากรายการโปรด");

        likeButton.addEventListener("click", () => {
            toggleFavorite(item.id);
        });

        actions.append(contactButton, likeButton);
        card.append(emoji, name, categoryText, description, location, actions);
        productList.appendChild(card);
    });

    document.getElementById("itemCount").textContent = items.length;
    document.getElementById("favoriteCount").textContent = favorites.length;
}

// เพิ่มหรือนำรายการโปรดออก
function toggleFavorite(id) {
    if (favorites.includes(id)) {
        favorites = favorites.filter(itemId => itemId !== id);
        showToast("นำออกจากรายการโปรดแล้ว");
    } else {
        favorites.push(id);
        showToast("เพิ่มรายการโปรดแล้ว ❤️");
    }

    saveData();
    displayItems();
}

// ค้นหาสิ่งของ
document.getElementById("searchInput")
    .addEventListener("input", displayItems);

// กรองหมวดหมู่
document.getElementById("categoryFilter")
    .addEventListener("change", displayItems);

// ลงประกาศสิ่งของใหม่
document.getElementById("addForm")
    .addEventListener("submit", function(event) {
        event.preventDefault();

        const newItem = {
            id: Date.now(),
            name: document.getElementById("itemName").value.trim(),
            category: document.getElementById("itemCategory").value,
            description: document.getElementById("itemDescription").value.trim(),
            location: document.getElementById("itemLocation").value.trim(),
            contact: document.getElementById("itemContact").value.trim()
        };

        if (!newItem.name || !newItem.category ||
            !newItem.description || !newItem.location || !newItem.contact) {
            showToast("กรุณากรอกข้อมูลให้ครบ");
            return;
        }

        newItem.emoji = getEmoji(newItem.category);

        items.unshift(newItem);
        saveData();
        displayItems();

        this.reset();

        document.getElementById("products").scrollIntoView({
            behavior: "smooth"
        });

        showToast("ลงประกาศสิ่งของเรียบร้อยแล้ว 🌱");
    });

// เปลี่ยนโหมดกลางวันและกลางคืน
const themeBtn = document.getElementById("themeBtn");

themeBtn.addEventListener("click", function() {
    document.body.classList.toggle("dark-mode");

    const isDark = document.body.classList.contains("dark-mode");

    themeBtn.textContent = isDark ? "☀️" : "🌙";
    localStorage.setItem("greenTheme", isDark ? "dark" : "light");
});

// จำโหมดที่เลือกไว้
if (localStorage.getItem("greenTheme") === "dark") {
    document.body.classList.add("dark-mode");
    themeBtn.textContent = "☀️";
}

// ปุ่มกลับขึ้นด้านบน
const topBtn = document.getElementById("topBtn");

window.addEventListener("scroll", function() {
    topBtn.style.display = window.scrollY > 300 ? "block" : "none";
});

topBtn.addEventListener("click", function() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});

// เริ่มแสดงข้อมูลเมื่อเปิดเว็บไซต์
displayItems();
