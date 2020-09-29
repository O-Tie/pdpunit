<?php

/***** Stack  ****/
$stack = new SplStack();

echo '<h3>Stack</h3>';

$stack->push('first');
$stack->push('second');
$stack->push('third');

echo serialize($stack);

echo '<br>';

echo '1st in stack - ' . $stack->pop();
echo '<br>';
echo '2nd in stack - ' . $stack->pop();
echo '<br>';
echo '3rd in stack - ' . $stack->pop();
echo '<br>';

echo '<hr>';

/***** Queue *****/
echo '<h3>Queue</h3>';

$que = new SplQueue();

$que->enqueue('first');
$que->enqueue('second');
$que->enqueue('third');

echo serialize($que);

echo '<br>';

$que->dequeue();
$que->dequeue();

echo 'que last - ' . $que->top();
echo '<br>';
