<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <script type="text/javascript" src="js/lib/bower_components/jquery/dist/jquery.js"></script>
        <style>
            table{
                margin: 0 auto;
                width: 100%;
            }
            table img{
                width: 100%;
                height: auto;
            }
            table td input[type=checkbox]{
                -ms-transform: scale(3); /* IE */
                -moz-transform: scale(3); /* FF */
                -webkit-transform: scale(3); /* Safari and Chrome */
                -o-transform: scale(3); /* Opera */
                padding: 15px;
            }
            table td, table th{
                text-align: center;
            }
            table#tCardsActive{
                width: 43%;
            }
            table#tCardsActive td{
                width: 16.67%;
            }
            table#allCards{
                width: 100%;
            }
            table#allCards th, table#allCards td{
                width: 7.14%;
            }
            table#pCardsActive{
                width: 22%;
            }
            table#pCardsActive td{
                width: 25%;
            }
            div#result{
                text-align: center;
                padding: 10px;
            }
            div#result li{
                list-style-position: inside;
            }
            
            /* loader */
            .windows8 {
                margin: 0 auto;
            position: relative;
            width: 90px;
            height:90px;
            }

            .windows8 .wBall {
            position: absolute;
            width: 86px;
            height: 86px;
            opacity: 0;
            -moz-transform: rotate(225deg);
            -moz-animation: orbit 3.8499999999999996s infinite;
            -webkit-transform: rotate(225deg);
            -webkit-animation: orbit 3.8499999999999996s infinite;
            -ms-transform: rotate(225deg);
            -ms-animation: orbit 3.8499999999999996s infinite;
            -o-transform: rotate(225deg);
            -o-animation: orbit 3.8499999999999996s infinite;
            transform: rotate(225deg);
            animation: orbit 3.8499999999999996s infinite;
            }

            .windows8 .wBall .wInnerBall{
            position: absolute;
            width: 11px;
            height: 11px;
            background: #39CBF0;
            left:0px;
            top:0px;
            -moz-border-radius: 11px;
            -webkit-border-radius: 11px;
            -ms-border-radius: 11px;
            -o-border-radius: 11px;
            border-radius: 11px;
            }

            .windows8 #wBall_1 {
            -moz-animation-delay: 0.84s;
            -webkit-animation-delay: 0.84s;
            -ms-animation-delay: 0.84s;
            -o-animation-delay: 0.84s;
            animation-delay: 0.84s;
            }

            .windows8 #wBall_2 {
            -moz-animation-delay: 0.17s;
            -webkit-animation-delay: 0.17s;
            -ms-animation-delay: 0.17s;
            -o-animation-delay: 0.17s;
            animation-delay: 0.17s;
            }

            .windows8 #wBall_3 {
            -moz-animation-delay: 0.34s;
            -webkit-animation-delay: 0.34s;
            -ms-animation-delay: 0.34s;
            -o-animation-delay: 0.34s;
            animation-delay: 0.34s;
            }

            .windows8 #wBall_4 {
            -moz-animation-delay: 0.5s;
            -webkit-animation-delay: 0.5s;
            -ms-animation-delay: 0.5s;
            -o-animation-delay: 0.5s;
            animation-delay: 0.5s;
            }

            .windows8 #wBall_5 {
            -moz-animation-delay: 0.67s;
            -webkit-animation-delay: 0.67s;
            -ms-animation-delay: 0.67s;
            -o-animation-delay: 0.67s;
            animation-delay: 0.67s;
            }

            @-moz-keyframes orbit {
            0% {
            opacity: 1;
            z-index:99;
            -moz-transform: rotate(-180deg);
            -moz-animation-timing-function: ease-out;
            }

            7% {
            opacity: 1;
            -moz-transform: rotate(-300deg);
            -moz-animation-timing-function: linear;
            -moz-origin:0%;
            }

            30% {
            opacity: 1;
            -moz-transform:rotate(-410deg);
            -moz-animation-timing-function: ease-in-out;
            -moz-origin:7%;
            }

            39% {
            opacity: 1;
            -moz-transform: rotate(-645deg);
            -moz-animation-timing-function: linear;
            -moz-origin:30%;
            }

            70% {
            opacity: 1;
            -moz-transform: rotate(-770deg);
            -moz-animation-timing-function: ease-out;
            -moz-origin:39%;
            }

            75% {
            opacity: 1;
            -moz-transform: rotate(-900deg);
            -moz-animation-timing-function: ease-out;
            -moz-origin:70%;
            }

            76% {
            opacity: 0;
            -moz-transform:rotate(-900deg);
            }

            100% {
            opacity: 0;
            -moz-transform: rotate(-900deg);
            }

            }

            @-webkit-keyframes orbit {
            0% {
            opacity: 1;
            z-index:99;
            -webkit-transform: rotate(-180deg);
            -webkit-animation-timing-function: ease-out;
            }

            7% {
            opacity: 1;
            -webkit-transform: rotate(-300deg);
            -webkit-animation-timing-function: linear;
            -webkit-origin:0%;
            }

            30% {
            opacity: 1;
            -webkit-transform:rotate(-410deg);
            -webkit-animation-timing-function: ease-in-out;
            -webkit-origin:7%;
            }

            39% {
            opacity: 1;
            -webkit-transform: rotate(-645deg);
            -webkit-animation-timing-function: linear;
            -webkit-origin:30%;
            }

            70% {
            opacity: 1;
            -webkit-transform: rotate(-770deg);
            -webkit-animation-timing-function: ease-out;
            -webkit-origin:39%;
            }

            75% {
            opacity: 1;
            -webkit-transform: rotate(-900deg);
            -webkit-animation-timing-function: ease-out;
            -webkit-origin:70%;
            }

            76% {
            opacity: 0;
            -webkit-transform:rotate(-900deg);
            }

            100% {
            opacity: 0;
            -webkit-transform: rotate(-900deg);
            }

            }

            @-ms-keyframes orbit {
            0% {
            opacity: 1;
            z-index:99;
            -ms-transform: rotate(-180deg);
            -ms-animation-timing-function: ease-out;
            }

            7% {
            opacity: 1;
            -ms-transform: rotate(-300deg);
            -ms-animation-timing-function: linear;
            -ms-origin:0%;
            }

            30% {
            opacity: 1;
            -ms-transform:rotate(-410deg);
            -ms-animation-timing-function: ease-in-out;
            -ms-origin:7%;
            }

            39% {
            opacity: 1;
            -ms-transform: rotate(-645deg);
            -ms-animation-timing-function: linear;
            -ms-origin:30%;
            }

            70% {
            opacity: 1;
            -ms-transform: rotate(-770deg);
            -ms-animation-timing-function: ease-out;
            -ms-origin:39%;
            }

            75% {
            opacity: 1;
            -ms-transform: rotate(-900deg);
            -ms-animation-timing-function: ease-out;
            -ms-origin:70%;
            }

            76% {
            opacity: 0;
            -ms-transform:rotate(-900deg);
            }

            100% {
            opacity: 0;
            -ms-transform: rotate(-900deg);
            }

            }

            @-o-keyframes orbit {
            0% {
            opacity: 1;
            z-index:99;
            -o-transform: rotate(-180deg);
            -o-animation-timing-function: ease-out;
            }

            7% {
            opacity: 1;
            -o-transform: rotate(-300deg);
            -o-animation-timing-function: linear;
            -o-origin:0%;
            }

            30% {
            opacity: 1;
            -o-transform:rotate(-410deg);
            -o-animation-timing-function: ease-in-out;
            -o-origin:7%;
            }

            39% {
            opacity: 1;
            -o-transform: rotate(-645deg);
            -o-animation-timing-function: linear;
            -o-origin:30%;
            }

            70% {
            opacity: 1;
            -o-transform: rotate(-770deg);
            -o-animation-timing-function: ease-out;
            -o-origin:39%;
            }

            75% {
            opacity: 1;
            -o-transform: rotate(-900deg);
            -o-animation-timing-function: ease-out;
            -o-origin:70%;
            }

            76% {
            opacity: 0;
            -o-transform:rotate(-900deg);
            }

            100% {
            opacity: 0;
            -o-transform: rotate(-900deg);
            }

            }

            @keyframes orbit {
                0% {
                opacity: 1;
                z-index:99;
                transform: rotate(-180deg);
                animation-timing-function: ease-out;
                }

                7% {
                opacity: 1;
                transform: rotate(-300deg);
                animation-timing-function: linear;
                origin:0%;
                }

                30% {
                opacity: 1;
                transform:rotate(-410deg);
                animation-timing-function: ease-in-out;
                origin:7%;
                }

                39% {
                opacity: 1;
                transform: rotate(-645deg);
                animation-timing-function: linear;
                origin:30%;
                }

                70% {
                opacity: 1;
                transform: rotate(-770deg);
                animation-timing-function: ease-out;
                origin:39%;
                }

                75% {
                opacity: 1;
                transform: rotate(-900deg);
                animation-timing-function: ease-out;
                origin:70%;
                }

                76% {
                opacity: 0;
                transform:rotate(-900deg);
                }

                100% {
                opacity: 0;
                transform: rotate(-900deg);
                }
            }
        </style>
        <title>Poker Effective Hand Strength</title>
    </head>
    <body>
        <h1>Poker Effective Hand Strength</h1>
        <h2 id="remove">REMOVE ALL</h2>
        <table id="tCardsActive">
        <caption>Table Cards</caption>
            <tbody>
                <tr>
                    <td><input type="checkbox" value="tCardsActive"></td>
                    <td><img width="100" src="img/placeHolder.png"></td>
                    <td><img width="100" src="img/placeHolder.png"></td>
                    <td><img width="100" src="img/placeHolder.png"></td>
                    <td><img width="100" src="img/placeHolder.png"></td>
                    <td><img width="100" src="img/placeHolder.png"></td>
                </tr>
            </tbody>
        </table>
        <table id="allCards">
        <caption>52 poker playing cards</caption>
            <tbody>
                <tr>
                    <th>Suit</th>
                    <th>Ace</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>Jack</th>
                    <th>Queen</th>
                    <th>King</th>
                </tr>
                    <tr>
                    <th>Spades</th>
                    <td><img width="100" data-card="A|♠" src="img/Playing_card_spade_A.svg" alt="Ace of spades"></td>
                    <td><img width="100" data-card="2|♠" src="img/Playing_card_spade_2.svg" alt="2 of spades"></td>
                    <td><img width="100" data-card="3|♠" src="img/Playing_card_spade_3.svg" alt="3 of spades"></td>
                    <td><img width="100" data-card="4|♠" src="img/Playing_card_spade_4.svg" alt="4 of spades"></td>
                    <td><img width="100" data-card="5|♠" src="img/Playing_card_spade_5.svg" alt="5 of spades"></td>
                    <td><img width="100" data-card="6|♠" src="img/Playing_card_spade_6.svg" alt="6 of spades"></td>
                    <td><img width="100" data-card="7|♠" src="img/Playing_card_spade_7.svg" alt="7 of spades"></td>
                    <td><img width="100" data-card="8|♠" src="img/Playing_card_spade_8.svg" alt="8 of spades"></td>
                    <td><img width="100" data-card="9|♠" src="img/Playing_card_spade_9.svg" alt="9 of spades"></td>
                    <td><img width="100" data-card="10|♠" src="img/Playing_card_spade_10.svg" alt="10 of spades"></td>
                    <td><img width="100" data-card="J|♠" src="img/Playing_card_spade_J.svg" alt="Jack of spades"></td>
                    <td><img width="100" data-card="Q|♠" src="img/Playing_card_spade_Q.svg" alt="Queen of spades"></td>
                    <td><img width="100" data-card="K|♠" src="img/Playing_card_spade_K.svg" alt="King of spades"></td>
                    </tr>
                <tr>
                    <th>Hearts</th>
                    <td><img width="100" data-card="A|♥" src="img/Playing_card_heart_A.svg" alt="Ace of hearts"></td>
                    <td><img width="100" data-card="2|♥" src="img/Playing_card_heart_2.svg" alt="2 of hearts"></td>
                    <td><img width="100" data-card="3|♥" src="img/Playing_card_heart_3.svg" alt="3 of hearts"></td>
                    <td><img width="100" data-card="4|♥" src="img/Playing_card_heart_4.svg" alt="4 of hearts"></td>
                    <td><img width="100" data-card="5|♥" src="img/Playing_card_heart_5.svg" alt="5 of hearts"></td>
                    <td><img width="100" data-card="6|♥" src="img/Playing_card_heart_6.svg" alt="6 of hearts"></td>
                    <td><img width="100" data-card="7|♥" src="img/Playing_card_heart_7.svg" alt="7 of hearts"></td>
                    <td><img width="100" data-card="8|♥" src="img/Playing_card_heart_8.svg" alt="8 of hearts"></td>
                    <td><img width="100" data-card="9|♥" src="img/Playing_card_heart_9.svg" alt="9 of hearts"></td>
                    <td><img width="100" data-card="10|♥" src="img/Playing_card_heart_10.svg" alt="10 of hearts"></td>
                    <td><img width="100" data-card="J|♥" src="img/Playing_card_heart_J.svg" alt="Jack of hearts"></td>
                    <td><img width="100" data-card="Q|♥" src="img/Playing_card_heart_Q.svg" alt="Queen of hearts"></td>
                    <td><img width="100" data-card="K|♥" src="img/Playing_card_heart_K.svg" alt="King of hearts"></td>
                </tr>
                <tr>
                    <th>Diamonds</th>
                    <td><img width="100" data-card="A|♦" src="img/Playing_card_diamond_A.svg" alt="Ace of diamonds"></td>
                    <td><img width="100" data-card="2|♦" src="img/Playing_card_diamond_2.svg" alt="2 of diamonds"></td>
                    <td><img width="100" data-card="3|♦" src="img/Playing_card_diamond_3.svg" alt="3 of diamonds"></td>
                    <td><img width="100" data-card="4|♦" src="img/Playing_card_diamond_4.svg" alt="4 of diamonds"></td>
                    <td><img width="100" data-card="5|♦" src="img/Playing_card_diamond_5.svg" alt="5 of diamonds"></td>
                    <td><img width="100" data-card="6|♦" src="img/Playing_card_diamond_6.svg" alt="6 of diamonds"></td>
                    <td><img width="100" data-card="7|♦" src="img/Playing_card_diamond_7.svg" alt="7 of diamonds"></td>
                    <td><img width="100" data-card="8|♦" src="img/Playing_card_diamond_8.svg" alt="8 of diamonds"></td>
                    <td><img width="100" data-card="9|♦" src="img/Playing_card_diamond_9.svg" alt="9 of diamonds"></td>
                    <td><img width="100" data-card="10|♦" src="img/Playing_card_diamond_10.svg" alt="10 of diamonds"></td>
                    <td><img width="100" data-card="J|♦" src="img/Playing_card_diamond_J.svg" alt="Jack of diamonds"></td>
                    <td><img width="100" data-card="Q|♦" src="img/Playing_card_diamond_Q.svg" alt="Queen of diamonds"></td>
                    <td><img width="100" data-card="K|♦" src="img/Playing_card_diamond_K.svg" alt="King of diamonds"></td>
                    </tr>
                <tr>
                    <th>Clubs</th>
                    <td><img width="100" data-card="A|♣" src="img/Playing_card_club_A.svg" alt="Ace of clubs"></td>
                    <td><img width="100" data-card="2|♣" src="img/Playing_card_club_2.svg" alt="2 of clubs"></td>
                    <td><img width="100" data-card="3|♣" src="img/Playing_card_club_3.svg" alt="3 of clubs"></td>
                    <td><img width="100" data-card="4|♣" src="img/Playing_card_club_4.svg" alt="4 of clubs"></td>
                    <td><img width="100" data-card="5|♣" src="img/Playing_card_club_5.svg" alt="5 of clubs"></td>
                    <td><img width="100" data-card="6|♣" src="img/Playing_card_club_6.svg" alt="6 of clubs"></td>
                    <td><img width="100" data-card="7|♣" src="img/Playing_card_club_7.svg" alt="7 of clubs"></td>
                    <td><img width="100" data-card="8|♣" src="img/Playing_card_club_8.svg" alt="8 of clubs"></td>
                    <td><img width="100" data-card="9|♣" src="img/Playing_card_club_9.svg" alt="9 of clubs"></td>
                    <td><img width="100" data-card="10|♣" src="img/Playing_card_club_10.svg" alt="10 of clubs"></td>
                    <td><img width="100" data-card="J|♣" src="img/Playing_card_club_J.svg" alt="Jack of clubs"></td>
                    <td><img width="100" data-card="Q|♣" src="img/Playing_card_club_Q.svg" alt="Queen of clubs"></td>
                    <td><img width="100" data-card="K|♣" src="img/Playing_card_club_K.svg" alt="King of clubs"></td>
                </tr>
            </tbody>
        </table>
        <table id="pCardsActive">
        <caption>Player Cards</caption>
            <tbody>
                <tr>
                    <td><input type="checkbox" value="pCardsActive" checked></td>
                    <td><img width="100" src="img/placeHolder.png"></td>
                    <td><img width="100" src="img/placeHolder.png"></td>
                </tr>
            </tbody>
        </table>
        <hr />
        <div id="result"></div>
        <hr />
        <br>
        <br>
        <div>
            <table>
                <tbody>
                    <tr>
                        <td>getHandPotential ($handPotential4 - takes approx 30sec)</td>
                        <td><input type="checkbox" value="Ppot"></td>
                    </tr>
                    <tr>
                        <td>All possible board cards to come - ($handPotential3 - takes approx 4min)</td>
                        <td><input type="checkbox" value="Npot"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script type="text/javascript">
            /**
            * load silvan.js
            */
            function loadSilvan(){
                var headTag = document.getElementsByTagName("head")[0];
                var element = document.createElement('script');
                element.type = 'text/javascript';
                element.src = 'js/silvan.js';
                headTag.appendChild(element);
            }
            /**
            * load jquery
            */
            function load_jQuery(){
                var headTag = document.getElementsByTagName("head")[0];
                var element = document.createElement('script');
                element.type = 'text/javascript';
                element.src = 'https://code.jquery.com/jquery-1.11.1.min.js';
                element.onload = function(){loadSilvan(); jQuery.noConflict();};
                headTag.appendChild(element);
            }
            /**
            * check if jQuery is loaded
            */
            if(typeof jQuery === 'undefined'){
                load_jQuery();
            } else if(parseFloat(jQuery.fn.jquery).toFixed(2) < 1.6 && parseFloat(jQuery.fn.jquery).toFixed(2) >= 1.19){
                load_jQuery();
            }else{
                loadSilvan();
            }
        </script>
    </body>
</html>