const casas = document.querySelectorAll('.casa');
let currentPlayer = 'X';

casas.forEach(casa => {
    casa.addEventListener('click', () => {
        if (casa.textContent === '') {
            casa.textContent = currentPlayer;
            // Verificar se houve vitória
            // ...
            currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
        }
    });
});

let botaoreset = document.querySelector(botao-reset)

botaoreset.addEventListener('click')