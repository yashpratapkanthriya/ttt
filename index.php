<?php
$post_data = file_get_contents("php://input");
$data = json_decode($post_data);
$number = $data->num;
function mb_count_chars($input)
{
    $l = strlen($input);
    $unique = array();
    for ($i = 0;$i < $l;$i++)
    {
        $char = mb_substr($input, $i, 1, 'UTF-8');
        if (!array_key_exists($char, $unique)) $unique[$char] = 0;
        $unique[$char]++;
    }
    return $unique;
}
$handle = file_get_contents("http://terriblytinytales.com/test.txt", "r");
$handle = preg_replace('/\s+/', '', $handle);
$array = mb_count_chars($handle);
arsort($array);
$feed = ['data' => []];
foreach (array_slice($array, 0, $number) as $x => $x_value)
{
    $f[] = ['key' => $x, 'value' => $x_value];
}
$feed['data'] = $f;
echo json_encode($feed);
?>