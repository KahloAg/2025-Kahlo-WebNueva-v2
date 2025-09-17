window.addEventListener("load", function () {
    gsap.registerPlugin(ScrollTrigger);

    gsap.to(".video-bg", {
        filter: "blur(12px) brightness(0.2)",
        scale: 1.05,
        opacity: 0,
        scrollTrigger: {
            trigger: ".degrade",
            start: "top top",
            endTrigger: ".next-section",
            end: "top top",
            scrub: true,
            pin: true,
            pinSpacing: false
        }
    });

    gsap.to(".black-overlay", {
        opacity: 1,
        scrollTrigger: {
            trigger: ".degrade",
            endTrigger: ".next-section",
            start: "top top",
            end: "top top",
            scrub: true
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    const blurOverlay = document.querySelector(".blur-overlay");

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: ".section-logos",
            start: "top top",
            end: "+=300%",
            scrub: true,
            pin: true,
            pinSpacing: true,
            onUpdate: (self) => {
                blurOverlay.style.opacity = self.progress > 0.5 ? 1 : 0;
            }
        }
    });

    tl.to(".section-logos", { backgroundColor: "#ffffff", duration: 0.2 }, 0);

    tl.to(".section-logos .before-title:first-of-type", { opacity: 1, y: 0, duration: 0.4 }, 0.3);
    tl.to(".section-logos h3", { opacity: 1, y: 0, duration: 0.4 }, "+=0.1");
    tl.to(".section-logos .before-title:last-of-type", { opacity: 1, y: 0, duration: 0.4 }, "+=0.2");

    tl.to(".animated-element", { opacity: 1, y: 0, duration: 0.6, stagger: 0.3 }, 1.8);
});

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", function () {
    const mainElement = document.querySelector("main");
    const footerElement = document.querySelector("footer");
    let footerHeight = footerElement.offsetHeight;
    const lastSection = mainElement.querySelector("section:last-of-type");
    let lastSectionBottom = lastSection.getBoundingClientRect().bottom;
    let viewportHeight = window.innerHeight;
    let adjustment = Math.max(0, viewportHeight - lastSectionBottom);

    gsap.to(mainElement, {
        y: -(footerHeight + adjustment),
        ease: "none",
        scrollTrigger: {
            trigger: mainElement,
            start: "bottom bottom",
            end: "bottom top",
            scrub: true
        }
    });

    document.body.style.overflowX = 'hidden';
});

const wrapper = document.querySelector('.trail-wrapper');
const cards = document.querySelectorAll('.card-servicios');
let lastTime = 0;
const MIN_INTERVAL = 450;

const imageOrderState = {
    idxByKey: {},
    defaultList: Array.from({ length: 15 }, (_, i) => `img/${i + 1}.jpg`)
};

let lastSpot = null;

cards.forEach(card => {
    card.addEventListener('mousemove', () => {
        const now = Date.now();
        if (now - lastTime > MIN_INTERVAL) {
            const category = card.dataset.category || '';
            createTrailPieceForCard(category);
            lastTime = now;
        }
    });
});

function nextSequentialImage(category) {
    let list = null;
    let key = "__default__";
    try {
        if (window.CARDS_IMAGES && category && Array.isArray(window.CARDS_IMAGES[category]) && window.CARDS_IMAGES[category].length > 0) {
            list = window.CARDS_IMAGES[category];
            key = `cat:${category}`;
        } else if (window.CARDS_IMAGES && Array.isArray(window.CARDS_IMAGES._default) && window.CARDS_IMAGES._default.length > 0) {
            list = window.CARDS_IMAGES._default;
            key = "__default__";
        }
    } catch (e) {}
    if (!list) list = imageOrderState.defaultList;
    if (typeof imageOrderState.idxByKey[key] !== 'number') imageOrderState.idxByKey[key] = 0;
    const i = imageOrderState.idxByKey[key] % list.length;
    const url = list[i];
    imageOrderState.idxByKey[key] = (i + 1) % list.length;
    return url;
}

function pickPositionAvoidingOverlap(vw, vh, w, h, pad) {
    const baseMin = Math.max(140, Math.min(vw, vh) * 0.12);
    const minDist = baseMin;
    let best = null;
    let bestScore = -1;
    for (let t = 0; t < 12; t++) {
        const x = Math.floor(pad + Math.random() * Math.max(1, vw - pad * 2 - w));
        const y = Math.floor(pad + Math.random() * Math.max(1, vh - pad * 2 - h));
        if (!lastSpot) return { x, y };
        const cx = x + w / 2;
        const cy = y + h / 2;
        const dx = cx - lastSpot.x;
        const dy = cy - lastSpot.y;
        const dist = Math.hypot(dx, dy);
        const score = dist;
        if (dist >= minDist) return { x, y };
        if (score > bestScore) {
            bestScore = score;
            best = { x, y };
        }
    }
    return best || { x: pad, y: pad };
}

function createTrailPieceForCard(category) {
    const url = nextSequentialImage(category);
    const piece = new Image();
    piece.className = 'trail-piece';
    piece.style.position = 'fixed';
    piece.style.pointerEvents = 'none';
    piece.style.opacity = '0';
    piece.style.visibility = 'hidden';
    piece.style.transform = 'none';
    piece.src = url;
    piece.decoding = 'async';
    piece.loading = 'eager';

    const PAD = 16;
    const vw = window.innerWidth;
    const vh = window.innerHeight;
    const viewportLimit = Math.floor(Math.min(vw, vh) * 0.6);
    const BASE_MAX = 560;
    const MAX = Math.min(BASE_MAX, viewportLimit);

    document.body.appendChild(piece);

    piece.addEventListener('load', () => {
        const w = piece.naturalWidth || MAX;
        const h = piece.naturalHeight || MAX;
        const ratio = Math.min(MAX / w, MAX / h, 1);
        const sizeBoost = gsap.utils.random(1.35, 1.6) * 0.8;
        const finalW = Math.round(w * ratio * sizeBoost);
        const finalH = Math.round(h * ratio * sizeBoost);

        piece.style.width = finalW + 'px';
        piece.style.height = finalH + 'px';

        const pos = pickPositionAvoidingOverlap(vw, vh, finalW, finalH, PAD);
        piece.style.left = pos.x + 'px';
        piece.style.top = pos.y + 'px';

        const cx = pos.x + finalW / 2;
        const cy = pos.y + finalH / 2;
        lastSpot = { x: cx, y: cy };

        piece.style.visibility = 'visible';
        gsap.fromTo(
            piece,
            { opacity: 0, scale: 0.88 },
            { opacity: 1, scale: 1, duration: 0.9, ease: "power3.out" }
        );

        setTimeout(() => {
            piece.remove();
        }, 2000);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const clasesIn = {
        'magic-image': ['animate__animated', 'animate__zoomIn'],
        'magic-image2': ['animate__animated', 'animate__rotateIn'],
        'magic-image3': ['animate__animated', 'animate__bounceIn']
    };
    const clasesOut = {
        'magic-image': ['animate__animated', 'animate__zoomOut'],
        'magic-image2': ['animate__animated', 'animate__rotateOut'],
        'magic-image3': ['animate__animated', 'animate__bounceOut']
    };
    const inView = new Set();
    const animating = new WeakMap();
    let lastScrollY = window.pageYOffset;
    let scrollDir = 'down';

    function animateIn(el, key) {
        animating.set(el, true);
        el.classList.remove(...clasesOut[key]);
        el.classList.add(...clasesIn[key]);
        el.addEventListener('animationend', function handler() {
            animating.set(el, false);
            el.removeEventListener('animationend', handler);
        });
    }

    function animateOut(el, key) {
        animating.set(el, true);
        el.classList.remove(...clasesIn[key]);
        el.classList.add(...clasesOut[key]);
        el.addEventListener('animationend', function handler() {
            animating.set(el, false);
            el.removeEventListener('animationend', handler);
        });
    }

    window.addEventListener('scroll', function () {
        const currentY = window.pageYOffset;
        scrollDir = currentY > lastScrollY ? 'down' : 'up';
        lastScrollY = currentY;
        inView.forEach(function (el) {
            if (animating.get(el)) return;
            const key = Array.from(el.classList).find(c => clasesIn[c]);
            if (!key) return;
            const inClass = clasesIn[key][1];
            const outClass = clasesOut[key][1];
            if (scrollDir === 'down' && !el.classList.contains(inClass)) {
                animateIn(el, key);
            } else if (scrollDir === 'up' && !el.classList.contains(outClass)) {
                animateOut(el, key);
            }
        });
    });

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.intersectionRatio >= 0.1) inView.add(entry.target);
            else inView.delete(entry.target);
        });
    }, { threshold: [0.1] });

    document.querySelectorAll('.magic-image, .magic-image2, .magic-image3').forEach(function (el) {
        animating.set(el, false);
        observer.observe(el);
    });
});

gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", function () {
    const mainElement = document.querySelector("#main");
    const footerElement = document.querySelector("footer");
    let footerHeight = footerElement.offsetHeight;
    const lastSection = mainElement.querySelector("section:last-of-type");
    let lastSectionBottom = lastSection.getBoundingClientRect().bottom;
    let viewportHeight = window.innerHeight;
    let adjustment = Math.max(0, viewportHeight - lastSectionBottom);

    gsap.to(mainElement, {
        y: -(footerHeight + adjustment),
        ease: "none",
        scrollTrigger: {
            trigger: mainElement,
            start: "bottom bottom",
            end: "bottom top",
            scrub: true
        }
    });

    document.body.style.overflowX = 'hidden';
});

console.clear();
gsap.registerPlugin(ScrollTrigger);

const cardsWrappers = gsap.utils.toArray(".card-wrapper");
const tarjetas = gsap.utils.toArray(".tarjeta");

cardsWrappers.forEach(function(wrapper, i) {
  const tarjeta = tarjetas[i];
  let scale = 1;
  let rotation = 0;

  if (i !== tarjetas.length - 1) {
    scale = 0.9 + 0.025 * i;
    rotation = -10;
  }

  gsap.to(tarjeta, {
    scale: scale,
    rotationX: rotation,
    transformOrigin: "top center",
    ease: "none",
    scrollTrigger: {
      trigger: wrapper,
      start: "top " + (80 + 10 * i),
      end: "bottom 550",
      endTrigger: ".wrapper",
      scrub: true,
      pin: wrapper,
      pinSpacing: false,
      onUpdate: (self) => {
        if (i === tarjetas.length - 1) {
          tarjeta.style.filter = "none";
        } else {
          const blurAmount = gsap.utils.mapRange(0, 1, 0, 3, self.progress);
          tarjeta.style.filter = `blur(${blurAmount}px)`;
        }
      },
      markers: false,
      id: i + 1
    }
  });
});
