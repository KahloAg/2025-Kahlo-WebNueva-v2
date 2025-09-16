
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
                    pinSpacing: false,

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

            tl.to(".section-logos", {
                backgroundColor: "#ffffff",
                duration: 0.2
            }, 0);

tl.to(".section-logos .before-title:first-of-type", {
    opacity: 1,
    y: 0,
    duration: 0.4
}, 0.3);

tl.to(".section-logos h3", {
    opacity: 1,
    y: 0,
    duration: 0.4
}, "+=0.1");

tl.to(".section-logos .before-title:last-of-type", {
    opacity: 1,
    y: 0,
    duration: 0.4
}, "+=0.2");

            tl.to(".animated-element", {
                opacity: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.3
            }, 1.8);
        });



        gsap.registerPlugin(ScrollTrigger);

        document.addEventListener("DOMContentLoaded", function () {
            const mainElement = document.querySelector("main");
            const footerElement = document.querySelector("footer");

            // Altura del footer
            let footerHeight = footerElement.offsetHeight;

            // Altura de la última sección del main
            const lastSection = mainElement.querySelector("section:last-of-type");
            let lastSectionBottom = lastSection.getBoundingClientRect().bottom;
            let viewportHeight = window.innerHeight;

            // Ajuste dinámico: cuánto se "ve" la última sección desde el viewport
            let adjustment = Math.max(0, viewportHeight - lastSectionBottom);

            gsap.to(mainElement, {
                y: -(footerHeight + adjustment),
                ease: "none",
                scrollTrigger: {
                    trigger: mainElement,
                    start: "bottom bottom",
                    end: "bottom top",
                    scrub: true,
                }
            });

            document.body.style.overflowX = 'hidden';
        });


        const wrapper = document.querySelector('.trail-wrapper');
        const cards = document.querySelectorAll('.card-servicios');
        let lastTime = 0;

        cards.forEach(card => {
            card.addEventListener('mousemove', e => {
                const now = Date.now();
                if (now - lastTime > 100) {
                    const category = card.dataset.category || '';
                    createTrailPieceForCard(e.clientX, e.clientY, category);
                    lastTime = now;
                }
            });
        });

        function pickImageForCategory(category) {
            try {
                if (window.CARDS_IMAGES && category && Array.isArray(CARDS_IMAGES[category]) && CARDS_IMAGES[category].length > 0) {
                    const arr = CARDS_IMAGES[category];
                    const idx = Math.floor(Math.random() * arr.length);
                    return arr[idx];
                }
            } catch (e) {}
            const index = Math.floor(Math.random() * 15) + 1;
            return `img/${index}.jpg`;
        }

function createTrailPieceForCard(x, y, category) {
    const url = pickImageForCategory(category);
    const piece = new Image();
    piece.className = 'trail-piece';
    piece.style.left = x + 'px';
    piece.style.top = y + 'px';
    piece.src = url;
    piece.decoding = 'async';
    piece.loading = 'eager';

    wrapper.appendChild(piece);

    piece.addEventListener('load', () => {
        const maxW = 260;
        const maxH = 260;
        const w = piece.naturalWidth || maxW;
        const h = piece.naturalHeight || maxH;
        const ratio = Math.min(maxW / w, maxH / h, 1);

        piece.style.width = (w * ratio) + 'px';
        piece.style.height = (h * ratio) + 'px';

        piece.classList.add('animate');
    });

    piece.addEventListener('animationend', () => {
        piece.remove();
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

            document
                .querySelectorAll('.magic-image, .magic-image2, .magic-image3')
                .forEach(function (el) {
                    animating.set(el, false);
                    observer.observe(el);
                });
        });

        gsap.registerPlugin(ScrollTrigger);

        document.addEventListener("DOMContentLoaded", function () {
            const mainElement = document.querySelector("#main");
            const footerElement = document.querySelector("footer");

            // Altura del footer
            let footerHeight = footerElement.offsetHeight;

            // Altura de la última sección del main
            const lastSection = mainElement.querySelector("section:last-of-type");
            let lastSectionBottom = lastSection.getBoundingClientRect().bottom;
            let viewportHeight = window.innerHeight;

            // Ajuste dinámico: cuánto se "ve" la última sección desde el viewport
            let adjustment = Math.max(0, viewportHeight - lastSectionBottom);

            gsap.to(mainElement, {
                y: -(footerHeight + adjustment),
                ease: "none",
                scrollTrigger: {
                    trigger: mainElement,
                    start: "bottom bottom",
                    end: "bottom top",
                    scrub: true,
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