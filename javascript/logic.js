let players = ['x', 'o'];
let activePlayer = 0;
let board = [];
let size = 3;

function startGame() {
  board = [];

  for (let i = 0; i < size; i++) {
    board.push([]);

    for (let j = 0; j < size; j++) board[i].push('');
  }

  renderBoard(board);
  activePlayer = Math.floor(Math.random() * 2);
}

function countChar(str, char) {
  let count = 0;
  for (let i = 0; i < str.length; i++) {
    if (str[i] === char) {
      count++;
    }
  }
  return count;
}

function click(row, col) {
  if (board[row][col] === '') {
    board[row][col] = players[activePlayer];
    renderBoard(board);
    if (isGameOver()) showWinner(activePlayer);
    activePlayer = 1 - activePlayer;
  }
}

function isGameOver() {
  let winner = '';

  for (let i = 0; i < size; i++) {
    let r = '';
    let c = '';

    for (let j = 0; j < size; j++) {
      r += board[i][j];
      c += board[j][i];
    }

    for (let player of players) {
      if (countChar(r, player) === size) {
        return true;
      } else if (countChar(c, player) === size) {
        return true;
      }
    }
  }

  let d1 = (d2 = '');

  for (let i = 0; i < size; i++) {
    d1 += board[i][i];
    d2 += board[i][size - i - 1];
  }

  for (let player of players) {
    if (countChar(d1, player) === size) return true;
    else if (countChar(d2, player) === size) return true;
  }

  return false;
}
