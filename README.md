![div](https://raw.github.com/Weedshaker/Poker_Effective_Hand_Strength/master/img/screenShot4_20150604.jpg)

# Poker_Effective_Hand_Strength

Poker_Effective_Hand_Strength calculates the hand strength [EHS = HS x (1 - NPOT) + (1 - HS) x PPOT] and hand potential by algorithms from https://en.wikipedia.org/wiki/Poker_Effective_Hand_Strength_%28EHS%29_algorithm

It extends https://github.com/mrAndersen/PokerAlgorithms ... PokerCore.php for calculating the deck combinations and adds the EHS calculations on top. It also uses jQuery for lazy dom selection for the view.

The actual heart is the HandStrength.php, which does all the calculations. The view has only been a fast fix to quickly get the decks into the processor.

## Use case

I have been testing it with different Poker sites and it certainly gave me an edge in difficult decissions. But also it quickly teaches you a sense of your decks "weight", especially when you are not a Poker Pro.

## How to get started

1. Install an Apache, PHP 5 environment. The easiest to start are Windows xampp or Linux tasksel and add LAMP.
2. Clone the Repo into your htdocs (xampp) or www/html (LAMP) folder.
3. You are good to go!
