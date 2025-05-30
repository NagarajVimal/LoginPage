document.addEventListener("DOMContentLoaded", function() {
    const filmCards = document.querySelectorAll('.film-card');

    filmCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('show'); // Add the show class after a delay
        }, index * 500); // Stagger the animation for each card
    });
});