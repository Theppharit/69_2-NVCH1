
// ==========================================
// GREEN SHARE VERSION 3
// ระบบแบ่งปันสิ่งของเพื่อสิ่งแวดล้อม
// ==========================================

// 1. ข้อมูลตัวอย่าง
const defaultItems = [
    {
        id: 1,
        name: "เสื้อยืดสีเขียว",
        category: "เสื้อผ้า",
        description: "เสื้อสภาพดี ใส่ได้ปกติ",
        location: "นครราชสีมา",
        contact: "Line: greenshare",
        image: "",
        emoji: "👕",
        owner: "Green Share",
        own: false,
        created: 1,
        completed: false
    },
    {
        id: 2,
        name: "หนังสือเรียน",
        category: "หนังสือ",
        description: "หนังสือมือสอง สภาพดี เหมาะสำหรับนักเรียน",
        location: "บุรีรัมย์",
        contact: "Line: bookshare",
        image: "",
        emoji: "📚",
        owner: "สมาชิกใจดี",
        own: false,
        created: 2,
        completed: false
    },
    {
        id: 3,
        name: "กระเป๋าผ้า Eco",
        category: "กระเป๋า",
        description: "กระเป๋าผ้าสะอาด พร้อมใช้งาน",
        location: "สุรินทร์",
        contact: "Line: bagshare",
        image: "",
        emoji: "👜",
        owner: "Green Friend",
        own: false,
        created: 3,
        completed: false
    },
    {
        id: 4,
        name: "โคมไฟตั้งโต๊ะ",
        category: "ของใช้ในบ้าน",
        description: "โคมไฟใช้งานได้ปกติ",
        location: "นครราชสีมา",
        contact: "Line: homeshare",
        image: "",
        emoji: "💡",
        owner: "สมาชิกใจดี",
        own: false,
        created: 4,
        completed: false
    },
    {
        id: 5,
        name: "หูฟัง",
        category: "อิเล็กทรอนิกส์",
        description: "หูฟังสภาพดี ใช้งานได้",
        location: "กรุงเทพฯ",
        contact: "Line: techshare",
        image: "",
        emoji: "🎧",
        owner: "Green Friend",
        own: false,
        created: 5,
        completed: false
    }
];

// 2. ฟังก์ชันโหลดและบันทึกข้อมูล
function loadData(key, fallback) {
    try {
        const saved = localStorage.getItem(key);
        return saved ? JSON.parse(saved) : fallback;
    } catch (error) {
        return fallback;
    }
}

let items = loadData("greenItems", defaultItems);
let favorites = loadData("greenFavorites", []);
let profile = loadData("greenProfile", {
    name: "สมาชิก Green Share",
    email: "",
    points: 0
});
let notifications = loadData("greenNotifications", []);
let chats = loadData("greenChats", {});
let reviews = loadData("greenReviews", []);
let completedShares = loadData("greenCompletedShares", []);

let showFavoritesOnly = false;
let selectedRating = 5;
let selectedImage = "";
let toastTimer;

function saveData() {
    try {
        localStorage.setItem("greenItems", JSON.stringify(items));
        localStorage.setItem("greenFavorites", JSON.stringify(favorites));
        localStorage.setItem("greenProfile", JSON.stringify(profile));
        localStorage.setItem("greenNotifications", JSON.stringify(notifications));
        localStorage.setItem("greenChats", JSON.stringify(chats));
        localStorage.setItem("greenReviews", JSON.stringify(reviews));
        localStorage.setItem("greenCompletedShares", JSON.stringify(completedShares));
        return true;
    } catch (error) {
        showToast("พื้นที่บันทึกข้อมูลไม่เพียงพอ กรุณาลดขนาดรูปภาพ");
        return false;
    }
}

// 3. แสดงข้อความแจ้งเตือน
function showToast(message) {
    const toast = document.getElementById("toast");
    toast.textContent = message;
    toast.classList.add("show");

    clearTimeout(toastTimer);

    toastTimer = setTimeout(() => {
        toast.classList.remove("show");
    }, 2500);
}

// 4. เพิ่มการแจ้งเตือน
function addNotification(message) {
    notifications.unshift({
        id: Date.now() + Math.random(),
        message: message,
        time: new Date().toLocaleString("th-TH")
    });

    notifications = notifications.slice(0, 50);

    saveData();
    updateNotificationBadge();
    displayNotifications();
}

function updateNotificationBadge() {
    document.getElementById("notificationBadge").textContent =
        notifications.length;
}

function displayNotifications() {
    const list = document.getElementById("notificationList");
    list.innerHTML = "";

    if (notifications.length === 0) {
        const empty = document.createElement("p");
        empty.className = "notification-empty";
        empty.textContent = "ยังไม่มีการแจ้งเตือน 🌱";
        list.appendChild(empty);
        return;
    }

    notifications.forEach(note => {
        const item = document.createElement("div");
        item.className = "notification-item";

        const message = document.createElement("p");
        message.textContent = "🔔 " + note.message;

        const time = document.createElement("small");
        time.textContent = note.time;

        item.append(message, time);
        list.appendChild(item);
    });
}

// 5. เลือกสัญลักษณ์ตามหมวดหมู่
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

// 6. แสดงรูปภาพในการ์ด
function createProductImage(item) {
    if (item.image) {
        const img = document.createElement("img");
        img.className = "product-image";
        img.src = item.image;
        img.alt = item.name;
        return img;
    }

    const emoji = document.createElement("div");
    emoji.className = "product-emoji";
    emoji.textContent = item.emoji || getEmoji(item.category);

    return emoji;
}

// 7. แสดงรายการสิ่งของ
function displayItems() {
    const productList = document.getElementById("productList");
    const searchText = document.getElementById("searchInput")
        .value.toLowerCase().trim();

    const category = document.getElementById("categoryFilter").value;
    const sortType = document.getElementById("sortFilter").value;

    let filtered = items.filter(item => {
        const matchName =
            item.name.toLowerCase().includes(searchText);

        const matchCategory =
            category === "ทั้งหมด" || item.category === category;

        const matchFavorite =
            !showFavoritesOnly || favorites.includes(item.id);

        return matchName && matchCategory && matchFavorite;
    });

    if (sortType === "newest") {
        filtered.sort((a, b) => b.created - a.created);
    } else if (sortType === "oldest") {
        filtered.sort((a, b) => a.created - b.created);
    } else {
        filtered.sort((a, b) =>
            a.name.localeCompare(b.name, "th")
        );
    }

    productList.innerHTML = "";

    document.getElementById("emptyMessage").hidden =
        filtered.length !== 0;

    filtered.forEach(item => {
        const card = document.createElement("article");
        card.className = "product-card";

        const image = createProductImage(item);

        const name = document.createElement("h3");
        name.textContent = item.name;

        const categoryText = document.createElement("p");
        categoryText.textContent = "หมวดหมู่: " + item.category;

        const description = document.createElement("p");
        description.textContent = item.description;

        const location = document.createElement("p");
        location.textContent = "📍 " + item.location;

        const owner = document.createElement("small");
        owner.className = "owner-label";
        owner.textContent = "แบ่งปันโดย: " + item.owner;

        const actions = document.createElement("div");
        actions.className = "card-actions";

        const detailBtn = document.createElement("button");
        detailBtn.className = "detail-btn";
        detailBtn.textContent = "ดูรายละเอียด";
        detailBtn.addEventListener("click", () => openDetails(item.id));

        const likeBtn = document.createElement("button");
        likeBtn.className = "like-btn";
        likeBtn.textContent =
            favorites.includes(item.id) ? "❤️" : "🤍";

        likeBtn.addEventListener("click", () => {
            toggleFavorite(item.id);
        });

        actions.append(detailBtn, likeBtn);

        card.append(
            image,
            name,
            categoryText,
            description,
            location,
            owner,
            actions
        );

        productList.appendChild(card);
    });

    document.getElementById("itemCount").textContent = items.length;
    document.getElementById("favoriteCount").textContent = favorites.length;

    updateChatOptions();
    updateReviewOptions();
}

// 8. รายการโปรด
function toggleFavorite(id) {
    if (favorites.includes(id)) {
        favorites = favorites.filter(itemId => itemId !== id);
        showToast("นำออกจากรายการโปรดแล้ว");
    } else {
        favorites.push(id);
        showToast("เพิ่มรายการโปรดแล้ว ❤️");
        addNotification("คุณเพิ่มสิ่งของลงในรายการโปรด");
    }

    saveData();
    displayItems();
}

document.getElementById("allBtn").addEventListener("click", function() {
    showFavoritesOnly = false;
    this.classList.add("active");
    document.getElementById("favoriteBtn").classList.remove("active");
    displayItems();
});

document.getElementById("favoriteBtn").addEventListener("click", function() {
    showFavoritesOnly = true;
    this.classList.add("active");
    document.getElementById("allBtn").classList.remove("active");
    displayItems();
});

document.getElementById("searchInput")
    .addEventListener("input", displayItems);

document.getElementById("categoryFilter")
    .addEventListener("change", displayItems);

document.getElementById("sortFilter")
    .addEventListener("change", displayItems);

// 9. อัปโหลดรูปภาพ
document.getElementById("itemImage").addEventListener("change", function() {
    const file = this.files[0];
    const preview = document.getElementById("imagePreview");

    selectedImage = "";

    if (!file) {
        preview.textContent = "🖼️ ตัวอย่างรูปภาพจะแสดงที่นี่";
        return;
    }

    if (!file.type.startsWith("image/")) {
        showToast("กรุณาเลือกไฟล์รูปภาพ");
        this.value = "";
        return;
    }

    if (file.size > 1024 * 1024) {
        showToast("รูปภาพต้องมีขนาดไม่เกิน 1 MB");
        this.value = "";
        return;
    }

    const reader = new FileReader();

    reader.onload = function(event) {
        selectedImage = event.target.result;

        preview.innerHTML = "";

        const img = document.createElement("img");
        img.src = selectedImage;
        img.alt = "ตัวอย่างรูปภาพ";

        preview.appendChild(img);
    };

    reader.readAsDataURL(file);
});

// 10. ลงประกาศสิ่งของ
document.getElementById("addForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const newItem = {
        id: Date.now(),
        name: document.getElementById("itemName").value.trim(),
        category: document.getElementById("itemCategory").value,
        description: document.getElementById("itemDescription").value.trim(),
        location: document.getElementById("itemLocation").value.trim(),
        contact: document.getElementById("itemContact").value.trim(),
        image: selectedImage,
        emoji: getEmoji(document.getElementById("itemCategory").value),
        owner: profile.name,
        own: true,
        created: Date.now(),
        completed: false
    };

    if (!newItem.name || !newItem.category ||
        !newItem.description || !newItem.location ||
        !newItem.contact) {
        showToast("กรุณากรอกข้อมูลให้ครบ");
        return;
    }

    items.unshift(newItem);
    profile.points += 10;

    if (!saveData()) {
        items.shift();
        profile.points -= 10;
        return;
    }

    this.reset();
    selectedImage = "";

    document.getElementById("imagePreview").textContent =
        "🖼️ ตัวอย่างรูปภาพจะแสดงที่นี่";

    updateProfile();
    displayItems();
    updatePoints();

    addNotification("คุณลงประกาศสิ่งของใหม่และได้รับ 10 คะแนน");
    showToast("ลงประกาศสำเร็จ! ได้รับ 10 คะแนน ⭐");

    document.getElementById("products").scrollIntoView({
        behavior: "smooth"
    });
});

// 11. รายละเอียดสิ่งของ
function openDetails(id) {
    const item = items.find(product => product.id === id);
    if (!item) return;

    const content = document.getElementById("detailContent");
    content.innerHTML = "";

    const image = createProductImage(item);

    const name = document.createElement("h2");
    name.textContent = item.name;

    const fields = [
        "หมวดหมู่: " + item.category,
        "รายละเอียด: " + item.description,
        "สถานที่นัดรับ: " + item.location,
        "ผู้แบ่งปัน: " + item.owner,
        "ช่องทางติดต่อ: " + item.contact
    ];

    content.append(image, name);

    fields.forEach(text => {
        const p = document.createElement("p");
        p.textContent = text;
        content.appendChild(p);
    });

    const chatButton = document.createElement("button");
    chatButton.className = "main-btn full-btn";
    chatButton.textContent = "💬 พูดคุยเกี่ยวกับสิ่งของนี้";

    chatButton.addEventListener("click", function() {
        document.getElementById("detailModal").classList.remove("show");
        document.getElementById("chatItemSelect").value = String(id);
        renderChat();
        document.getElementById("chat").scrollIntoView({
            behavior: "smooth"
        });
    });

    content.appendChild(chatButton);

    document.getElementById("detailModal").classList.add("show");
}

// 12. ระบบโปรไฟล์สมาชิก
function updateProfile() {
    document.getElementById("profileName").textContent = profile.name;
    document.getElementById("profileEmail").textContent =
        profile.email || "สมาชิกผู้รักสิ่งแวดล้อม 🌱";

    document.getElementById("profilePoints").textContent = profile.points;
    document.getElementById("memberPoints").textContent = profile.points;

    const avatar = document.getElementById("profileAvatar");
    avatar.textContent = "👤";

    document.getElementById("memberLevel").textContent =
        profile.points >= 100
            ? "🏆 สมาชิกนักอนุรักษ์"
            : profile.points >= 50
                ? "🌳 สมาชิกผู้แบ่งปัน"
                : "🌱 สมาชิกใหม่";
}

function openProfileEditor() {
    document.getElementById("editName").value = profile.name;
    document.getElementById("editEmail").value = profile.email;
    document.getElementById("profileModal").classList.add("show");
}

document.getElementById("editProfileBtn")
    .addEventListener("click", openProfileEditor);

document.getElementById("profileBtn")
    .addEventListener("click", openProfileEditor);

document.getElementById("profileForm")
    .addEventListener("submit", function(event) {
        event.preventDefault();

        const oldProfile = { ...profile };

        profile.name = document.getElementById("editName").value.trim();
        profile.email = document.getElementById("editEmail").value.trim();

        if (!profile.name) {
            showToast("กรุณากรอกชื่อสมาชิก");
            return;
        }

        if (!saveData()) {
            profile = oldProfile;
            return;
        }

        updateProfile();
        document.getElementById("profileModal").classList.remove("show");

        showToast("บันทึกโปรไฟล์แล้ว");
        addNotification("คุณแก้ไขข้อมูลโปรไฟล์เรียบร้อยแล้ว");
    });

// 13. ระบบคะแนนรักษ์โลก
function updatePoints() {
    document.getElementById("rewardPoints").textContent = profile.points;
    document.getElementById("profilePoints").textContent = profile.points;
    document.getElementById("memberPoints").textContent = profile.points;

    const progress = Math.min(profile.points % 100, 100);

    document.getElementById("pointsProgress").style.width =
        progress + "%";

    let message = "";

    if (profile.points >= 100) {
        message = "ยินดีด้วย! คุณเป็นสมาชิกนักอนุรักษ์ 🏆";
    } else {
        message = "อีก " + (100 - profile.points) +
            " คะแนน เพื่อไปสู่ระดับนักอนุรักษ์";
    }

    document.getElementById("pointsMessage").textContent = message;
}

document.getElementById("completeShareBtn")
    .addEventListener("click", function() {
        const eligible = items.find(item =>
            item.own && !item.completed
        );

        if (!eligible) {
            showToast("ยังไม่มีประกาศของคุณที่สามารถบันทึกการส่งต่อได้");
            return;
        }

        const confirmed = confirm(
            "ยืนยันว่าคุณส่งต่อสิ่งของ \"" +
            eligible.name + "\" สำเร็จแล้วใช่หรือไม่?"
        );

        if (!confirmed) return;

        eligible.completed = true;
        completedShares.push(eligible.id);
        profile.points += 20;

        if (!saveData()) {
            eligible.completed = false;
            completedShares.pop();
            profile.points -= 20;
            return;
        }

        updatePoints();
        updateProfile();

        showToast("ยินดีด้วย! ได้รับ 20 คะแนน ⭐");
        addNotification("บันทึกการส่งต่อสำเร็จ ได้รับ 20 คะแนน");
        displayItems();
    });

// 14. ระบบแชตจำลอง
function updateChatOptions() {
    const select = document.getElementById("chatItemSelect");
    const previous = select.value;

    select.innerHTML = "";

    const first = document.createElement("option");
    first.value = "";
    first.textContent = "เลือกสิ่งของที่ต้องการพูดคุย";
    select.appendChild(first);

    items.forEach(item => {
        const option = document.createElement("option");
        option.value = String(item.id);
        option.textContent = item.name;
        select.appendChild(option);
    });

    if (items.some(item => String(item.id) === previous)) {
        select.value = previous;
    }
}

function renderChat() {
    const itemId = document.getElementById("chatItemSelect").value;
    const area = document.getElementById("chatMessages");

    area.innerHTML = "";

    if (!itemId) {
        const empty = document.createElement("p");
        empty.className = "chat-empty";
        empty.textContent = "เลือกสิ่งของเพื่อเริ่มพูดคุย 💚";
        area.appendChild(empty);
        return;
    }

    const messages = chats[itemId] || [];

    if (messages.length === 0) {
        const empty = document.createElement("p");
        empty.className = "chat-empty";
        empty.textContent = "ยังไม่มีข้อความ เริ่มพูดคุยได้เลย 💚";
        area.appendChild(empty);
    }

    messages.forEach(message => {
        const bubble = document.createElement("div");
        bubble.className = "message " +
            (message.mine ? "mine" : "other");

        const text = document.createElement("span");
        text.textContent = message.text;

        const time = document.createElement("small");
        time.textContent = message.time;

        bubble.append(text, time);
        area.appendChild(bubble);
    });

    area.scrollTop = area.scrollHeight;
}

document.getElementById("chatItemSelect")
    .addEventListener("change", renderChat);

document.getElementById("chatForm")
    .addEventListener("submit", function(event) {
        event.preventDefault();

        const itemId = document.getElementById("chatItemSelect").value;
        const input = document.getElementById("chatInput");
        const messageText = input.value.trim();

        if (!itemId) {
            showToast("กรุณาเลือกสิ่งของก่อนส่งข้อความ");
            return;
        }

        if (!messageText) return;

        if (!chats[itemId]) {
            chats[itemId] = [];
        }

        chats[itemId].push({
            text: messageText,
            mine: true,
            time: new Date().toLocaleTimeString("th-TH", {
                hour: "2-digit",
                minute: "2-digit"
            })
        });

        if (!saveData()) {
            chats[itemId].pop();
            return;
        }

        input.value = "";
        renderChat();
        addNotification("คุณส่งข้อความใหม่ในห้องสนทนา");
        showToast("ส่งข้อความแล้ว 💬");
    });

// 15. ระบบรีวิวและให้คะแนน
function updateReviewOptions() {
    const select = document.getElementById("reviewItemSelect");
    const previous = select.value;

    select.innerHTML = "";

    const first = document.createElement("option");
    first.value = "";
    first.textContent = "เลือกสิ่งของ";
    select.appendChild(first);

    items.forEach(item => {
        const option = document.createElement("option");
        option.value = String(item.id);
        option.textContent = item.name;
        select.appendChild(option);
    });

    if (items.some(item => String(item.id) === previous)) {
        select.value = previous;
    }
}

function setRating(rating) {
    selectedRating = rating;

    document.querySelectorAll("#starPicker button")
        .forEach(button => {
            const number = Number(button.dataset.star);
            button.classList.toggle("selected", number <= rating);
        });
}

document.querySelectorAll("#starPicker button")
    .forEach(button => {
        button.addEventListener("click", function() {
            setRating(Number(this.dataset.star));
        });
    });

function displayReviews() {
    const list = document.getElementById("reviewList");
    list.innerHTML = "";

    if (reviews.length === 0) {
        const empty = document.createElement("p");
        empty.className = "notification-empty";
        empty.textContent = "ยังไม่มีรีวิว เป็นคนแรกที่เขียนรีวิวได้เลย!";
        list.appendChild(empty);
        return;
    }

    reviews.forEach(review => {
        const item = document.createElement("div");
        item.className = "review-item";

        const title = document.createElement("strong");
        title.textContent = review.itemName;

        const stars = document.createElement("div");
        stars.className = "review-stars";
        stars.textContent = "★".repeat(review.rating) +
            "☆".repeat(5 - review.rating);

        const reviewer = document.createElement("small");
        reviewer.textContent = "รีวิวโดย " + review.name;

        const comment = document.createElement("p");
        comment.textContent = review.comment;

        const date = document.createElement("small");
        date.textContent = review.date;

        item.append(title, stars, reviewer, comment, date);
        list.appendChild(item);
    });
}

document.getElementById("reviewForm")
    .addEventListener("submit", function(event) {
        event.preventDefault();

        const itemId = document.getElementById("reviewItemSelect").value;
        const comment = document.getElementById("reviewText").value.trim();

        if (!itemId || !comment) {
            showToast("กรุณากรอกข้อมูลรีวิวให้ครบ");
            return;
        }

        const selectedItem = items.find(item =>
            String(item.id) === itemId
        );

        const review = {
            id: Date.now(),
            itemName: selectedItem.name,
            name: profile.name,
            rating: selectedRating,
            comment: comment,
            date: new Date().toLocaleDateString("th-TH")
        };

        reviews.unshift(review);

        if (!saveData()) {
            reviews.shift();
            return;
        }

        this.reset();
        setRating(5);
        displayReviews();

        showToast("ขอบคุณสำหรับรีวิว ⭐");
        addNotification("คุณส่งรีวิวสิ่งของเรียบร้อยแล้ว");
    });

// 16. ศูนย์การแจ้งเตือน
document.getElementById("notificationBtn")
    .addEventListener("click", function() {
        displayNotifications();
        document.getElementById("notificationModal").classList.add("show");
    });

document.getElementById("clearNotifications")
    .addEventListener("click", function() {
        notifications = [];
        saveData();
        displayNotifications();
        updateNotificationBadge();
        showToast("ล้างการแจ้งเตือนแล้ว");
    });

// 17. เปิดและปิดหน้าต่างต่าง ๆ
document.querySelectorAll("[data-close]").forEach(button => {
    button.addEventListener("click", function() {
        document.getElementById(this.dataset.close)
            .classList.remove("show");
    });
});

document.querySelectorAll(".modal").forEach(modal => {
    modal.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.classList.remove("show");
        }
    });
});

document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        document.querySelectorAll(".modal.show").forEach(modal => {
            modal.classList.remove("show");
        });
    }
});

// 18. โหมดกลางวันและกลางคืน
const themeBtn = document.getElementById("themeBtn");

function applyTheme(theme) {
    const dark = theme === "dark";

    document.body.classList.toggle("dark-mode", dark);
    themeBtn.textContent = dark ? "☀️" : "🌙";

    localStorage.setItem("greenTheme", theme);
}

themeBtn.addEventListener("click", function() {
    const isDark = document.body.classList.contains("dark-mode");

    applyTheme(isDark ? "light" : "dark");
    showToast(isDark ? "เปลี่ยนเป็นโหมดกลางวัน" : "เปลี่ยนเป็นโหมดกลางคืน");
});

if (localStorage.getItem("greenTheme") === "dark") {
    applyTheme("dark");
}

// 19. ปุ่มกลับขึ้นด้านบน
const topBtn = document.getElementById("topBtn");

window.addEventListener("scroll", function() {
    topBtn.style.display =
        window.scrollY > 300 ? "block" : "none";
});

topBtn.addEventListener("click", function() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});

// 20. เริ่มต้นเว็บไซต์
updateProfile();
updatePoints();
displayItems();
displayReviews();
displayNotifications();
updateNotificationBadge();
setRating(5);
