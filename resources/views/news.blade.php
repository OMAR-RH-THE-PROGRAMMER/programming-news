

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Space-Tech</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* ===== BASE ===== */
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  background: #000;
  color: #e5e7eb;
  overflow-x: hidden;
  font-family: 'Segoe UI', sans-serif;

}

/* ===== STAR SKY (SLOW & ELEGANT) ===== */
#stars, #stars2, #stars3 {
  position: fixed;
  top: 0; left: 0;
  width: 200%;
  height: 200%;
  pointer-events: none;
  z-index: 0;
}

.star {
  position: absolute;
  background: white;
  border-radius: 50%;
  opacity: 0.6;
  animation: twinkle 6s infinite ease-in-out;
}

/* slow cosmic movement */
#stars {
  animation: drift 450s linear infinite;
}
#stars2 {
  animation: drift 150s linear infinite;
}
#stars3 {
  animation: drift 450s linear infinite;
}

@keyframes drift {
  from { transform: translateY(0); }
  to { transform: translateY(-1200px); }
}

@keyframes twinkle {
  0% { opacity: 0.2; }
  50% { opacity: 1; }
  100% { opacity: 0.2; }
}

/* ===== UI ===== */
.content {
  position: relative;
  z-index: 2;
}

.navbar {
  background: rgba(0,0,0,0.6);
  backdrop-filter: blur(10px);
}

.hero {
  padding: 160px 20px;
  text-align: center;
}

.hero h1 {
  font-size: 3.2rem;
  font-weight: 800;
  letter-spacing: 1px;
}

.hero span {
  color: #38bdf8;
}

.hero p {
  max-width: 620px;
  margin: 20px auto;
  opacity: .7;
  font-size: 1.1rem;
}

.btn-future {
  border: 1px solid #38bdf8;
  color: #38bdf8;
  background: transparent;
  border-radius: 50px;
  padding: 14px 34px;
}

.btn-future:hover {
  background: #38bdf8;
  color: #000;
  box-shadow: 0 0 30px #38bdf8;
}

.card.glass {
  background: rgba(0,0,0,0.55);
  backdrop-filter: blur(12px);
  border-radius: 20px;
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 4px 15px rgba(56, 189, 248, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card.glass:hover {
  transform: translateY(-12px) scale(1.03) rotateX(2deg);
  box-shadow: 0 10px 30px rgba(56, 189, 248, 0.3);
}

.card img {
  border-radius: 20px 20px 0 0;
  object-fit: cover;
  height: 200px;
  transition: transform 0.3s ease;
}

.card:hover img {
  transform: scale(1.05);
}

.card-body h6 {
  color: #38bdf8;
  font-weight: 700;
  margin-bottom: 8px;
}

.card-body p {
  color: #e5e7eb;
  opacity: 0.8;
  font-size: 0.95rem;
}


/* ===== FOOTER ===== */
footer {
  margin-top: 120px;
  padding: 60px 0;
  background: rgba(0,0,0,0.7);
  backdrop-filter: blur(10px);
  border-top: 1px solid rgba(255,255,255,.1);
}

footer h5 {
  font-weight: 700;
}

footer p {
  opacity: .6;
  font-size: .95rem;
}

footer small {
  opacity: .4;
}
</style>
</head>

<body>

<!-- STAR LAYERS -->
<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>

<div class="content">

<!-- NAV -->
<nav class="navbar navbar-dark">
  <div class="container">
    <span class="navbar-brand fw-bold"> Space-Tech</span>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <h1>Exploring the <span>Future</span> of Technology</h1>
  <p>
    Space-Tech delivers the latest programming, AI, and technology news
    through a calm cosmic experience.
  </p>
  <a href="#news" class="btn btn-future">Explore News →</a>
</section>

<!-- NEWS -->
<section id="news" class="pb-5">
  <div class="container">
    <div class="row g-4">

      @foreach($articles as $article)
      <div class="col-md-6 col-lg-4">
        <div class="card glass h-100">
          <img src="{{ $article['urlToImage'] }}" alt="">
          <div class="card-body d-flex flex-column">
            <h6 class="fw-bold">{{ $article['title'] }}</h6>
            <p class="small opacity-75">{{ $article['description'] }}</p>
            <a href="{{ $article['url'] }}" target="_blank" class="btn btn-future mt-auto">
              Read →
            </a>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="row gy-4">

      <div class="col-md-4">
        <h5> Space-Tech</h5>
        <p>
          A futuristic platform delivering technology and programming news
          with clarity, depth, and vision.
        </p>
      </div>

      <div class="col-md-4">
        <h5>Mission</h5>
        <p>
          To explore tomorrow’s technology and present it through
          a calm, minimal, and inspiring experience.
        </p>
      </div>

      <div class="col-md-4">
        <h5>Built With</h5>
        <p>Laravel · APIs · Modern UI · Space Vision</p>
      </div>

    </div>

    <hr class="border-secondary my-4">

    <div class="text-center">
      <small>© {{ date('Y') }} Space-Tech — All rights reserved.</small>
    </div>
  </div>
</footer>

</div>

<!-- ===== JS: CREATE STARS ===== -->
<script>
function createStars(containerId, count, sizeRange) {
  const container = document.getElementById(containerId);
  for (let i = 0; i < count; i++) {
    const star = document.createElement('div');
    star.className = 'star';

    const size = Math.random() * sizeRange + 2;
    star.style.width = size + 'px';
    star.style.height = size + 'px';

    star.style.top = Math.random() * 200 + '%';
    star.style.left = Math.random() * 100 + '%';

    star.style.animationDelay = Math.random() * 10 + 's';

    container.appendChild(star);
  }
}
createStars('stars', 500, 2);
createStars('stars2', 500, 3);
createStars('stars3', 500, 4);

</script>

</body>
</html>
