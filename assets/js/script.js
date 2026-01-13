document.addEventListener('DOMContentLoaded', function () {
  const music = document.getElementById('bg-music');
  const toggleBtn = document.getElementById('music-toggle');
  const musicIcon = document.getElementById('music-icon');

  if (!music || !toggleBtn || !musicIcon) return;

  let isPlaying = false;

  // Set initial icon (paused)
  musicIcon.src = ftMusicData.playIcon;

  // Try to start muted autoplay (allowed by browsers)
  music.muted = true;
  music.play().then(() => {
    console.log('Muted autoplay started');
    isPlaying = true;
    musicIcon.src = ftMusicData.pauseIcon;
    toggleBtn.classList.add('playing');
  }).catch(err => console.log('Muted autoplay blocked:', err));

  // ✅ On first user click/tap → unmute and ensure playing
  const activateAudio = () => {
    if (music.muted) {
      music.muted = false;
      music.play().then(() => {
        isPlaying = true;
        musicIcon.src = ftMusicData.pauseIcon;
        toggleBtn.classList.add('playing');
        console.log('Music unmuted and playing');
      }).catch(err => console.log('Playback blocked:', err));
    }
    document.removeEventListener('click', activateAudio);
    document.removeEventListener('touchstart', activateAudio);
  };
  document.addEventListener('click', activateAudio);
  document.addEventListener('touchstart', activateAudio);

  // 🎵 Toggle button behavior
  toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    if (isPlaying) {
      music.pause();
      isPlaying = false;
      musicIcon.src = ftMusicData.playIcon;
      toggleBtn.classList.remove('playing');
    } else {
      music.muted = false; // just in case
      music.play().then(() => {
        isPlaying = true;
        musicIcon.src = ftMusicData.pauseIcon;
        toggleBtn.classList.add('playing');
      }).catch(err => console.log('Playback blocked:', err));
    }
  });
});
