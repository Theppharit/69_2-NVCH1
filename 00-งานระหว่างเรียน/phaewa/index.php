<?php
// index.php — หน้าแรกเว็บไซต์อนุรักษ์สิ่งแวดล้อม
// ตอนนี้ใช้ข้อมูลตัวอย่างในอาร์เรย์ ภายหลังเปลี่ยนเป็นดึงจาก MySQL ด้วย PDO ได้
// ตัวอย่าง: $pdo = new PDO('mysql:host=localhost;dbname=eco;charset=utf8mb4', 'root', '');

$siteName = 'รักษ์ผืนป่า';

$stats = [
    ['value' => '12,480', 'label' => 'ต้นไม้ที่ปลูกแล้ว'],
    ['value' => '38',     'label' => 'ชุมชนที่ร่วมโครงการ'],
    ['value' => '6.2 ตัน', 'label' => 'ขยะที่เก็บจากลำน้ำ'],
];

$projects = [
    ['title' => 'ปลูกป่าชายเลน',  'text' => 'ฟื้นฟูแนวป่าชายเลนเพื่อป้องกันการกัดเซาะชายฝั่งและเป็นแหล่งอนุบาลสัตว์น้ำ', 'tag' => 'ป่าไม้'],
    ['title' => 'ลำน้ำใสสะอาด',   'text' => 'อาสาสมัครเก็บขยะและตรวจคุณภาพน้ำในลำน้ำสายหลักทุกเดือน', 'tag' => 'แหล่งน้ำ'],
    ['title' => 'โรงเรียนไร้ขยะ', 'text' => 'ชวนนักเรียนคัดแยกขยะและทำปุ๋ยหมักจากเศษอาหารในโรงเรียน', 'tag' => 'การศึกษา'],
];

$news = [
    ['date' => '2026-10-28', 'title' => 'เปิดรับอาสาสมัครปลูกป่าประจำเดือนพฤศจิกายน'],
    ['date' => '2026-10-15', 'title' => 'ผลตรวจคุณภาพน้ำไตรมาสที่ 3 ดีขึ้นร้อยละ 14'],
    ['date' => '2026-10-02', 'title' => 'เวิร์กช็อปทำปุ๋ยหมักสำหรับครัวเรือน'],
];

function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
function thaiDate(string $d): string {
    $m = ['', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    $t = strtotime($d);
    return date('j', $t) . ' ' . $m[(int)date('n', $t)] . ' ' . (date('Y', $t) + 543);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($siteName) ?> | อนุรักษ์สิ่งแวดล้อม</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mitr:wght@400;500&family=Noto+Sans+Thai:wght@400;600&display=swap" rel="stylesheet">
<style>
:root{
  --forest:#12372F; --sage:#E6EEE3; --leaf:#4C8C5A; --river:#3C7A89; --sun:#E3B23C; --ink:#1B2623; --white:#fff;
}
*{box-sizing:border-box;margin:0}
body{font-family:'Noto Sans Thai',sans-serif;color:var(--ink);background:var(--sage);line-height:1.8}
h1,h2,h3{font-family:'Mitr',sans-serif;font-weight:500;line-height:1.3}
a{color:inherit}
:focus-visible{outline:3px solid var(--sun);outline-offset:3px}
.wrap{max-width:1080px;margin:0 auto;padding:0 20px}

header{background:var(--forest);color:var(--white)}
header .wrap{display:flex;align-items:center;justify-content:space-between;gap:16px;padding-top:14px;padding-bottom:14px;flex-wrap:wrap}
.logo{font-family:'Mitr',sans-serif;font-size:1.4rem;text-decoration:none}
nav a{margin-left:18px;text-decoration:none;opacity:.9}
nav a:hover{opacity:1;text-decoration:underline}

.hero{background:var(--forest);color:var(--white);padding:56px 0 88px;
  background-image:radial-gradient(circle at 85% 20%,rgba(227,178,60,.25) 0 90px,transparent 91px)}
.hero h1{font-size:clamp(2rem,6vw,3.6rem);max-width:14em}
.hero p{max-width:34em;margin:16px 0 28px;color:#CFE0D3}
.btn{display:inline-block;background:var(--sun);color:var(--forest);padding:12px 26px;border-radius:999px;font-weight:600;text-decoration:none}
.btn:hover{background:#f0c453}

.stats{margin-top:-48px;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px}
.stat{background:var(--white);border-radius:14px;padding:22px;border-left:6px solid var(--leaf)}
.stat strong{display:block;font-family:'Mitr',sans-serif;font-size:2rem;color:var(--forest)}

section{padding:64px 0 0}
section h2{font-size:1.8rem;color:var(--forest);margin-bottom:24px}

.projects{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px}
.project{background:var(--white);border-radius:14px;padding:24px}
.project:nth-child(2){border-top:6px solid var(--river)}
.project:nth-child(1){border-top:6px solid var(--leaf)}
.project:nth-child(3){border-top:6px solid var(--sun)}
.tag{font-size:.85rem;color:var(--river);font-weight:600}
.project h3{margin:4px 0 8px}

.news ul{list-style:none;padding:0;background:var(--white);border-radius:14px}
.news li{display:flex;gap:20px;padding:16px 22px;border-bottom:1px solid var(--sage)}
.news li:last-child{border-bottom:0}
.news time{min-width:110px;color:var(--river);font-weight:600}

.join{margin-top:64px;background:var(--leaf);color:var(--white);padding:48px 0}
.join .wrap{display:flex;justify-content:space-between;align-items:center;gap:20px;flex-wrap:wrap}
.join h2{color:var(--white);margin:0}

footer{background:var(--forest);color:#CFE0D3;padding:24px 0;text-align:center;font-size:.9rem}
@media (max-width:600px){nav a{margin:0 14px 0 0}.news li{flex-direction:column;gap:0}}
</style>
</head>
<body>

<header>
  <div class="wrap">
    <a class="logo" href="index.php"><?= e($siteName) ?></a>
    <nav aria-label="เมนูหลัก">
      <a href="#projects">โครงการ</a>
      <a href="#news">ข่าวสาร</a>
      <a href="#join">ร่วมเป็นอาสา</a>
      <a href="admin/login.php">ผู้ดูแลระบบ</a>
    </nav>
  </div>
</header>

<main>
  <div class="hero">
    <div class="wrap">
      <h1>ดูแลธรรมชาติ ตั้งแต่ชุมชนของเรา</h1>
      <p>เราทำงานร่วมกับชาวบ้าน โรงเรียน และอาสาสมัคร เพื่อฟื้นฟูป่า รักษาแหล่งน้ำ และลดขยะ</p>
      <a class="btn" href="#join">สมัครเป็นอาสาสมัคร</a>
    </div>
  </div>

  <div class="wrap">
    <div class="stats">
      <?php foreach ($stats as $s): ?>
        <div class="stat"><strong><?= e($s['value']) ?></strong><?= e($s['label']) ?></div>
      <?php endforeach; ?>
    </div>

    <section id="projects">
      <h2>โครงการของเรา</h2>
      <div class="projects">
        <?php foreach ($projects as $p): ?>
          <article class="project">
            <span class="tag"><?= e($p['tag']) ?></span>
            <h3><?= e($p['title']) ?></h3>
            <p><?= e($p['text']) ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <section id="news" class="news">
      <h2>ข่าวสารล่าสุด</h2>
      <ul>
        <?php foreach ($news as $n): ?>
          <li><time datetime="<?= e($n['date']) ?>"><?= thaiDate($n['date']) ?></time><span><?= e($n['title']) ?></span></li>
        <?php endforeach; ?>
      </ul>
    </section>
  </div>

  <div class="join" id="join">
    <div class="wrap">
      <h2>มาช่วยกันปลูกต้นไม้ต้นต่อไป</h2>
      <a class="btn" href="register.php">ลงทะเบียนอาสาสมัคร</a>
    </div>
  </div>
</main>

<footer>© <?= date('Y') + 543 ?> <?= e($siteName) ?> · สงวนลิขสิทธิ์</footer>
</body>
</html>
