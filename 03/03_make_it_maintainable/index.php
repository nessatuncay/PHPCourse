<?php
/* What's the Problem? 
    - PHP logic + HTML in one file
    - Works, but not scalable
    - Repetition will become a problem

    How can we refactor this code so it’s easier to maintain?


    My comment: I learned that breaking a page into different components and giving them their own files makes it
    easier to keep everything organized. Putting all of them in one file can make it too big and hard to go through. I'll be 
    breaking down the page areas in my project to keep things clean and manageable
*/

$items = ["Home", "About", "Contact"];

?>

<?php require 'includes/header.php'; ?>

<ul>
<?php foreach ($items as $item): ?>
    <li><?= $item ?></li>
<?php endforeach; ?>
</ul>

<?php require 'includes/footer.php'; ?>


