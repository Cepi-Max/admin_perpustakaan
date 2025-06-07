// Copy link functionality
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(
        function () {
            alert("Link berhasil disalin!");
        },
        function (err) {
            console.error("Gagal menyalin link: ", err);
        }
    );
}

// Smooth scroll for internal links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        }
    });
});

// Reading progress indicator
window.addEventListener("scroll", function () {
    const winScroll =
        document.body.scrollTop || document.documentElement.scrollTop;
    const height =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
    const scrolled = (winScroll / height) * 100;

    // You can add a progress bar here if needed
    console.log("Reading progress: " + scrolled + "%");
});
