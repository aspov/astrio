<?php

function searchCategory($categories, $id)
{
    $iter = function ($node, $acc) use (&$iter, $id) {
        if (!is_array($node)) {
            return $acc;
        }
        if (array_key_exists('id', $node)) {
            if ($node['id'] == $id) {
                return $node['title'];
            }
        }
        return array_reduce($node, function ($newAcc, $child) use ($iter) {
            return $iter($child, $newAcc);
        }, $acc);
    };
    return $iter($categories, '');
}

//tags
$tags = ['</a>','<a>', '</a>',  '<div>','<a>', '</div>'];
function isCorrect(array $tags)
{
    $willClosed = [];
    foreach ($tags as $tag) {
        if ($tag[1] !== "/") {
            array_unshift($willClosed, str_replace('<', '</', $tag));
        } else {
            if (count($willClosed) == 0) {
                return false;
            }
            if ($tag !== $willClosed[0]) {
                return false;
            }
            array_shift($willClosed);
        }
    }
    return true;
}
var_dump(isCorrect($tags));
