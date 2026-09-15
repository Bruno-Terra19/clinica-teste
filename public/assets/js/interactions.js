document.addEventListener("DOMContentLoaded", () => {
    if (window.lucide) lucide.createIcons();

    document.querySelectorAll(".reveal-word-source").forEach((source) => {
        const words = source.textContent.trim().split(/\s+/);
        source.textContent = "";
        words.forEach((word, i) => {
            const span = document.createElement("span");
            span.className = "reveal-word";
            span.style.setProperty("--word-index", i);
            span.textContent = word;
            source.appendChild(span);
            source.appendChild(document.createTextNode(" "));
        });
    });

    const armWillChange = (el, properties) => {
        el.style.willChange = properties;
        el.addEventListener(
            "transitionend",
            () => {
                el.style.willChange = "auto";
            },
            { once: true },
        );
    };

    const animateCounters = (root) => {
        root.querySelectorAll("[data-count-to]").forEach((el) => {
            const target = parseInt(el.getAttribute("data-count-to"), 10);
            const duration = 1200;
            const start = performance.now();
            const tick = (now) => {
                const progress = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.round(target * eased);
                if (progress < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        });
    };

    if ("IntersectionObserver" in window) {
        const revealObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        armWillChange(entry.target, "opacity, transform");
                        entry.target.classList.add("is-visible");
                        animateCounters(entry.target);
                        revealObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.16, rootMargin: "0px 0px -8% 0px" },
        );
        document.querySelectorAll(".reveal").forEach((el, i) => {
            el.style.setProperty(
                "--reveal-delay",
                `${Math.min(i * 60, 480)}ms`,
            );
            revealObserver.observe(el);
        });

        const wordObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const words = Array.from(
                            entry.target.querySelectorAll(".reveal-word"),
                        );
                        words.forEach((w) =>
                            armWillChange(w, "opacity, transform"),
                        );
                        words.forEach((w) => w.classList.add("is-visible"));
                        wordObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.4 },
        );
        document
            .querySelectorAll(".reveal-word-source")
            .forEach((source) => wordObserver.observe(source));
    } else {
        document
            .querySelectorAll(".reveal, .reveal-word")
            .forEach((el) => el.classList.add("is-visible"));
        document.querySelectorAll("[data-count-to]").forEach((el) => {
            el.textContent = el.getAttribute("data-count-to");
        });
    }

    const contactForm = document.querySelector("[data-contact-form]");
    if (contactForm) {
        const note = contactForm.querySelector("[data-contact-note]");
        const defaultNote = note ? note.textContent : "";

        contactForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            const dados = {
                name: contactForm.querySelector('[name="nome"]').value,
                whatsapp: contactForm.querySelector('[name="whatsapp"]').value,
            };

            try {
                const resp = await fetch("/api/contato", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Contact-Token": "your_contact_form_token_123",
                    },
                    body: JSON.stringify(dados),
                });

                if (resp.ok) {
                    if (note) {
                        note.textContent =
                            "Contato registrado! Em breve retornamos por WhatsApp.";
                        note.classList.add("is-sent");
                    }
                    contactForm.reset();
                } else {
                    if (note)
                        note.textContent =
                            "Ops, algo deu errado. Tente novamente.";
                }
            } catch (err) {
                if (note) note.textContent = "Sem conexão. Tente novamente.";
            }

            if (note) {
                setTimeout(() => {
                    note.textContent = defaultNote;
                    note.classList.remove("is-sent");
                }, 5000);
            }
        });
    }

    const parallaxEls = document.querySelectorAll("[data-parallax-speed]");
    if (parallaxEls.length) {
        let ticking = false;
        const updateParallax = () => {
            const scrollY = window.scrollY;
            parallaxEls.forEach((el) => {
                const speed = parseFloat(
                    el.getAttribute("data-parallax-speed"),
                );
                el.style.transform = `translate3d(0, ${scrollY * speed}px, 0)`;
            });
            ticking = false;
        };
        window.addEventListener(
            "scroll",
            () => {
                if (!ticking) {
                    requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            },
            { passive: true },
        );
        updateParallax();
    }
});
