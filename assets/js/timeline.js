document.addEventListener('DOMContentLoaded', () => {

// ----------------------------
// TIMELINE ANIMATION
// ----------------------------
/* helper: update timeline state */

function updateTimeline() {
  const timeline = document.querySelector(".rtimeline");
  if (!timeline) return;

  const rect = timeline.getBoundingClientRect();
  const windowHeight = window.innerHeight;

  const start = windowHeight;
  const end = rect.height + windowHeight;

  let progress = (start - rect.top) / (end - start);
  progress = Math.max(0, Math.min(progress, 1));

  // set css var for visual line
  timeline.style.setProperty("--line-height", (progress * 100) + "%");

  // -----------------------
  // compute line height
  // -----------------------
    const lineHeightNow = parseFloat(getComputedStyle(timeline, "::before").height) || 0;

    const items = Array.from(document.querySelectorAll(".rtimeline-item"));

    items.forEach(item => {
      const itemTop = item.offsetTop; // distance from top of timeline
      const content = item.querySelector(".rtimeline-content");
      const contImage = item.querySelector(".rtimeline-image");

      // ANIMATION CONDITION
      if (lineHeightNow >= itemTop) {
        item.classList.add("active");
        if (content && !content.classList.contains("animated")) {
          content.classList.add("animated-slow", "animated", "fadeInUp");
        }
        if (contImage && !contImage.classList.contains("animated")) {
          contImage.classList.add("animated");
        }
      } else {
        item.classList.remove("active");
        if (content) {
          content.classList.remove("animated-slow", "animated", "fadeInUp");
        }
        if (contImage) {
          contImage.classList.remove("animated");
        }
      }
    });

    // ⭐ Add active to LAST item
    const lastItem = items[items.length - 1];
    if (lastItem) {
      const lastItemTop = lastItem.offsetTop;
      if (lineHeightNow >= lastItemTop) {
        lastItem.classList.add("active");
      }
    }

    
    // -------------------------------
    // FIRST ITEM FALLBACK (ONLY IF VISIBLE)
    // -------------------------------
    if (items.length) {
      const first = items[0];
      const firstRect = first.getBoundingClientRect();
      const firstContent = first.querySelector(".rtimeline-content");
      const firstImage = first.querySelector(".rtimeline-image");

      // Check if first item is visible in viewport (top < window height)
      if (firstRect.top < windowHeight * 0.95) {
        first.classList.add("active");
        if (firstContent && !firstContent.classList.contains("animated")) {
          firstContent.classList.add("animated-slow", "animated", "fadeInUp");
        }
        if (firstImage && !firstImage.classList.contains("animated")) {
          firstImage.classList.add("animated");
        }
      }
    }
  }

  /* wire events */
  window.addEventListener("scroll", updateTimeline, { passive: true });
  window.addEventListener("resize", updateTimeline);
  window.addEventListener("DOMContentLoaded", updateTimeline);
  window.addEventListener("load", updateTimeline);

});
