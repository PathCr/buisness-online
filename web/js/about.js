// Простой слайдер для секции команды (можно заменить на более продвинутый)
const teamSlider = document.querySelector('.team-slider');

if (teamSlider) {
    let isDown = false;
    let startX;
    let scrollLeft;

    teamSlider.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX - teamSlider.offsetLeft;
        scrollLeft = teamSlider.scrollLeft;
        teamSlider.classList.add('active');
    });
    teamSlider.addEventListener('mouseleave', () => {
        isDown = false;
        teamSlider.classList.remove('active');
    });
    teamSlider.addEventListener('mouseup', () => {
        isDown = false;
        teamSlider.classList.remove('active');
    });
    teamSlider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - teamSlider.offsetLeft;
        const walk = (x - startX) * 1; //scroll-fast
        teamSlider.scrollLeft = scrollLeft - walk;
    });
}