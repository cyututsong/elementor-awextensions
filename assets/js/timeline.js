document.addEventListener("DOMContentLoaded", () => {

  function updateTimeline() {

    document.querySelectorAll(".rtimeline-style-storyline").forEach(timeline => {

      const items = timeline.querySelectorAll(".rtimeline-item");
      const timelineRect = timeline.getBoundingClientRect();
      const windowHeight = window.innerHeight;

      // Progress for line animation (CSS variable)
      let progress = (windowHeight - timelineRect.top) /
                     (timelineRect.height + windowHeight);

      progress = Math.max(0, Math.min(progress, 1));
      timeline.style.setProperty("--line-height", `${progress * 100}%`);

      items.forEach(item => {

        const itemRect = item.getBoundingClientRect();
        const content  = item.querySelector(".rtimeline-content");
        const image    = item.querySelector(".rtimeline-image");

        // Item enters viewport
        if (itemRect.top < windowHeight * 0.85) {

          item.classList.add("active");
          
          if (content) {
            content.classList.add("animated", "animated-slow", "fadeInUp");
          }

          if (image) {
            image.classList.add("animated");
          }

        } else {
          item.classList.remove("active");

          if (content) {
            content.classList.remove("animated", "animated-slow", "fadeInUp");
          }

          if (image) {
            image.classList.remove("animated");
          }
        }

      });
    });
  }

  window.addEventListener("scroll", updateTimeline, { passive: true });
  window.addEventListener("resize", updateTimeline);
  updateTimeline(); // initial trigger
});