<?php


function checkSimilarity($data1, $data2)
{
    similar_text($data1, $data2, $similarity);

    return round($similarity);
}


function checkDifference($data1, $data2)
{
    similar_text($data1, $data2, $similarity);

    return 100 - round($similarity);
}
?>