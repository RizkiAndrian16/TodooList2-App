/**
 * TaskFlow / TodooList Main Application Script
 * Clean & Modular UI Interaction Handlers
 */
document.addEventListener("DOMContentLoaded", () => {
  // 1. Auto-dismiss flash alerts setelah 5 detik
  const alerts = document.querySelectorAll(".alert");
  alerts.forEach((alert) => {
    // Tombol close manual
    const closeBtn = alert.querySelector(".alert-close");
    if (closeBtn) {
      closeBtn.addEventListener("click", () => {
        alert.style.transition = "opacity 0.2s ease, transform 0.2s ease";
        alert.style.opacity = "0";
        alert.style.transform = "translateY(-5px)";
        setTimeout(() => alert.remove(), 200);
      });
    }

    // Auto dismiss
    setTimeout(() => {
      if (document.body.contains(alert)) {
        alert.style.transition = "opacity 0.3s ease, transform 0.3s ease";
        alert.style.opacity = "0";
        alert.style.transform = "translateY(-5px)";
        setTimeout(() => alert.remove(), 300);
      }
    }, 5000);
  });

  // 2. Logging status inisialisasi aplikasi
  console.log("TaskFlow UI Core Ready — Architecture: Clean Modular Blade/CSS/JS.");
});

