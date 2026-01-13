document.addEventListener("DOMContentLoaded", function() {
  const countdowns = document.querySelectorAll(".countdown");

  countdowns.forEach(function(countdownEl) {
    const endDateStr = countdownEl.getAttribute("data-end-date");
    if (!endDateStr) return;

    const endDate = new Date(endDateStr).getTime();

    function updateCountdown() {
      const now = new Date().getTime();
      const distance = endDate - now;

      if (distance < 0) {
        countdownEl.innerHTML = "🎉 The countdown is over!";
        clearInterval(interval);
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      countdownEl.innerHTML = `
        <div class="ctn ctnDays">${days} <span class="label">Days</span></div>
        <div class="ctn ctnHours">${hours} <span class="label">Hours</span></div>
        <div class="ctn ctnMinute">${minutes} <span class="label">Minutes</span></div>
        <div class="ctn ctnSeconds">${seconds} <span class="label">Seconds</span></div>
      `;
    }

    const interval = setInterval(updateCountdown, 1000);
    updateCountdown();
  });
});

