<?php

namespace connectfour\model;

require_once("Player.php");
require_once("Token.php");

use connectfour\model\{Player, Token};

use ArrayObject;

class Game {
    private int $length;
    private string $currentTurn;

    private array $tokens;

    private Player $player1;
    private Player $player2;

    private bool $isGameFinished;

    private string $connectFourCookieName;
    private string $previousTurnCookieName;
    private string $tokensCookieName;

    public function __construct(int $boardLength) {
        $this->length = $boardLength;
        
        $this->connectFourCookieName = "connectfour";
        $this->previousTurnCookieName = "connectfour_turn";
        $this->tokensCookieName = "connectfour_tokens";
        
        $this->initializeGame();
    }

    public function getPlayer1() {
        return $this->player1;
    }

    public function getPlayer2() {
        return $this->player2;
    }

    public function drawPlayerInformation() {
        echo('<table>
        <tr>
            <th>&nbsp;</th>
            <th>Player 1</th>
            <th>Player 2</th>
        </tr>
        <tr>
            <td>First Name</td>
            <td>' . $this->player1->getFirstName() . '</td>
            <td>' . $this->player2->getFirstName() . '</td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>' . $this->player1->getLastName() . '</td>
            <td>' . $this->player2->getLastName() . '</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>' . $this->player1->getAddress() . '</td>
            <td>' . $this->player2->getAddress() . '</td>
        </tr>
        <tr>
            <td>Country</td>
            <td>' . $this->player1->getCountry() . '</td>
            <td>' . $this->player2->getCountry() . '</td>
        </tr>
        <tr>
            <td>Province</td>
            <td>' . $this->player1->getProvince() . '</td>
            <td>' . $this->player2->getProvince() . '</td>
        </tr>
        <tr>
            <td>Age</td>
            <td>' . $this->player1->getAge() . '</td>
            <td>' . $this->player2->getAge() . '</td>
        </tr>
        <tr>
            <td>Color</td>
            <td>' . $this->player1->getColor() . '</td>
            <td>' . $this->player2->getColor() . '</td>
        </tr>
        <tr>
            <td>Tokens</td>
            <td>' . $this->player1->getTokenQuantity() . '</td>
            <td>' . $this->player2->getTokenQuantity() . '</td>
        </tr>
    </table>');
    }

    public function drawHud() {
        $message;
        $cssClass;
        $currentPlayerId;
        $currentPlayer;

        // previousCookieName was updated whet updateTokens was executed
        $currentPlayerID = $this->currentTurn == "p1" ? "1" : "2";
        $currentPlayer = $this->currentTurn == "p1" ? $this->player1 : $this->player2;

        $message = sprintf("Player %s: %d token left", $currentPlayerID, $currentPlayer->getTokenQuantity());
        $cssClass = "hud--" . $currentPlayer->getColor();

        print('<div class="hud">');
        printf("<h2 class=\"%s\">%s</h2>", $cssClass, $message);
        print('</div>');
    }

    public function drawBoard() {
        $tokens;
        $token;

        for ($i=0; $i < count($this->tokens); $i++) {
            print('<div class="board__row">');
            
            for ($j=0; $j < count($this->tokens[$i]); $j++) {
                print('<div class="board__location">');

                $token = $this->tokens[$i][$j];
                
                if (!$token->isEmpty()) {
                    printf("<div class=\"board__token board__token--%s\">&nbsp;</div>", $token->getColor());
                } else {
                    printf('<a href="game.php?row=%d&column=%d">', $i, $j);
                    print('<div class="board__token board__token--empty">&nbsp;</div>');
                    print('</a>');
                }
                print('</div>');
            }
            
            print('</div>');
        }
    }

    public function isPosition(int $column, int $row) {
        return $column >= 0 && $column < $this->length
            && $row >= 0 && $row < $this->length
            && $this->tokens[$column][$row]->isEmpty();
    }

    private function updateTokens() {
        $previousPlayer = $this->currentTurn == "p1" ? $this->player2 : $this->player1;

        if (
            $_SERVER["REQUEST_METHOD"] == "GET" 
            && isset($_GET["column"])
            && isset($_GET["row"])
            && $this->isPosition($_GET["row"], $_GET["column"])
        ) {
            $this->tokens[$_GET["row"]][$_GET["column"]]->setEmpty(false);
            $this->tokens[$_GET["row"]][$_GET["column"]]->setColor($previousPlayer->getColor());
        }

        $_SESSION[$this->tokensCookieName] = json_encode($this->tokens);
    }

    public function updatePlayerTurn() {
        $turn;
        $previousTurn;
        $currentTurn;
        $player1 = "p1";
        $player2 = "p2";

        if (isset($_SESSION[$this->previousTurnCookieName])) {
            $previousTurn = $_SESSION[$this->previousTurnCookieName];
            $currentTurn = $previousTurn == $player1 ? $player2 : $player1;

            // Updates tokens quantity
            if ($previousTurn == $player1) {
                $this->player1->setTokenQuantity($this->player1->getTokenQuantity() - 1);

            } else {
                $this->player2->setTokenQuantity($this->player2->getTokenQuantity() - 1);
            }
            
            $_SESSION[$this->connectFourCookieName] = json_encode(array(
                "player1" => $this->player1,
                "player2" => $this->player2,
            ));
        } else {
            $currentTurn = rand(0, 1) > 0 ? $player2 : $player1;
        }
        
        $this->currentTurn = $currentTurn;

        $_SESSION[$this->previousTurnCookieName] = $currentTurn;
    }

    private function initializeTokens() {
        $tokens;
        $objArray;
        $obj;

        if (!isset($_SESSION[$this->tokensCookieName])) {
            for ($i=0; $i < $this->length; $i++) { 
                for ($j=0; $j < $this->length; $j++) { 
                    $tokens[$i][$j] = new Token();
                }
            }
    
            $_SESSION[$this->tokensCookieName] = json_encode($tokens);
        } else {
            $objArray = json_decode($_SESSION[$this->tokensCookieName]);
            
            for ($i=0; $i < count($objArray); $i++) { 
                for ($j=0; $j < count($objArray[$i]); $j++) {
                    $obj = $objArray[$i][$j];
                    
                    $tokens[$i][$j] = new Token($obj->empty, $obj->color);
                }
            }
        }

        $this->tokens = $tokens;
    }

    private function initializePlayers() {
        if (isset($_SESSION[$this->connectFourCookieName])) {
            $players = json_decode($_SESSION[$this->connectFourCookieName]);
            
            $this->player1 = new Player(
                $players->player1->firstName,
                $players->player1->lastName,
                $players->player1->color,
                $players->player1->address,
                $players->player1->country,
                $players->player1->province,
                $players->player1->age,
                $players->player1->tokenQuantity,
            );
            
            $this->player2 = new Player(
                $players->player2->firstName,
                $players->player2->lastName,
                $players->player2->color,
                $players->player2->address,
                $players->player2->country,
                $players->player2->province,
                $players->player2->age,
                $players->player2->tokenQuantity,
            );
        }
    }

    public function isGameOver() {
        return !($this->player1->getTokenQuantity() > 0) && !($this->player2->getTokenQuantity() > 0);
    }

    private function initializeGame() {
        session_start();

        $this->initializeTokens();

        $this->initializePlayers();
        $this->updatePlayerTurn();
        $this->updateTokens();
    }
}