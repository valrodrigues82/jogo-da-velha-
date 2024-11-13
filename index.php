<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <header('Content-Type: application/json')>
    
    <title>Jogo da Velha</title>
</head>
<body>
    <h1>Jogo da Velha</h1>

    <div id="tabuleiro">
   <div class="casa"></div>
   <div class="casa"></div>
   <div class="casa"></div>
   <div class="casa"></div>
   <div class="casa"></div>
   <div class="casa"></div>
   <div class="casa"></div>
   <div class="casa"></div>
   <div class="casa"></div>
</div>
<button type="botao-reset"></button>

<?php
session_start();

function getPlayerTurn() {
    $players = ['X' , 'O'];
    if(!isset($_SESSION['turn'])){
        $_SESSION['turn'] = 0;
    }
    $currentPlayer = $players[$_SESSION['turn']%2];

    return $currentPlayer;
}
?>

<?php
function makeMove($board, $position, $player){
    if  ($board[$position] == ''){
        $board[$position] = $player;
        if (checkwinner($board, $player)){
            return ['board' => $board, 'winner' => $player];            
        }
        $_SESSION['turn']++;
        return ['board' => $board, 'winner' => null];
   }else{
    return ['error' => 'Posição já ocupada!'];
   }

}
function checkWinner($board, $player) {
    $winningCombinations = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8],
        [0, 3, 6], [1, 4, 7], [2, 5, 8],
        [0, 4, 8], [2, 4, 6]
    ];
    foreach($winningCombinations as $combination){
        if ($board[$combination[0]] === $player &&
            $board[$combination[1]] === $player &&
            $board[$combination[2]] === $player) {
                return true;
            }
        
    }

    return false;
}
?>

<?php
session_start();
include 'caminho_das_funcoes.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo json_encode(['player' => getPlayerTurn()]);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$data = json_decode(file_get_contents("php://input"), true);

$board = isset($_SESSION['board']) ? $_SESSION['board'] : array_fill(0, 9, '');

$result = makeMove($board, $data['position'], $data['player']);
$_SESSION['board'] = $result['board'];

echo json_encode($result);

}

?>


/*<script src="scripts.js">
    </script>*/
</body>
</html>