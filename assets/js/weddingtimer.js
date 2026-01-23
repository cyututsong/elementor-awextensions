/* ================================
   UNIVERSAL COUNTDOWN (Frontend + Editor)
================================ */

(function () {
    const MS = 1000;
    const MIN = MS * 60;
    const HOUR = MIN * 60;
    const DAY = HOUR * 24;

    const initCountdown = (el) => {
        const endDateAttr = el.dataset.endDate;
        const countDownStyle = el.dataset.style;


        if (!endDateAttr) return;

        const endTime = new Date(endDateAttr).getTime();
        if (isNaN(endTime)) return;

        const render = (distance) => {
            const days    = Math.floor(distance / DAY);
            const hours   = Math.floor((distance % DAY) / HOUR);
            const minutes = Math.floor((distance % HOUR) / MIN);
            const seconds = Math.floor((distance % MIN) / MS);



            console.log('Countdown style inside:', countDownStyle);

            if (countDownStyle == 'default') {

                el.innerHTML = `
                    <div class="ctn ctnDays">${days}<span class="label">Days</span></div>
                    <div class="ctn ctnHours">${hours}<span class="label">Hours</span></div>
                    <div class="ctn ctnMinute">${minutes}<span class="label">Minutes</span></div>
                    <div class="ctn ctnSeconds">${seconds}<span class="label">Seconds</span></div>
                `;

            } else {

                el.innerHTML = `
                    <div class="ctn ctnDays">${days}<span class="label">Days</span></div>
                    <div class="ctn sp">:</div>
                    <div class="ctn ctnHours">${hours}<span class="label">Hours</span></div>
                    <div class="ctn sp">:</div>
                    <div class="ctn ctnMinute">${minutes}<span class="label">Minutes</span></div>
                    <div class="ctn sp">:</div>
                    <div class="ctn ctnSeconds">${seconds}<span class="label">Seconds</span></div>
                `;

            }
        };

        const tick = () => {
            const now = Date.now();
            const distance = endTime - now;

            if (distance <= 0) {
                el.innerHTML = '🎉 The countdown is over!';
                if (timer) clearInterval(timer);
                return;
            }

            render(distance);
        };

        tick(); // initial render
        const timer = setInterval(tick, MS);
    };

    const initAllCountdowns = () => {
        const countdowns = document.querySelectorAll('.countdown');
        if (!countdowns.length) return;
        countdowns.forEach(initCountdown);
    };

    // Run normally on frontend
    if (!window.elementorFrontend || !elementorFrontend.isEditMode()) {
        document.addEventListener('DOMContentLoaded', initAllCountdowns);
    } else {
        // Elementor editor mode
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/weddingcountdown.default',
            ($scope) => {
                const countdowns = $scope.find('.countdown');
                countdowns.each((_, el) => initCountdown(el));
            }
        );
    }
})();
