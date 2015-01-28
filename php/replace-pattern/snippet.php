<?php

/* Copyright (C) 2015 Thomas ZILLIOX. This snippet is under MIT license */

function replacePattern($subject, $searchList, $replaceList)
{
    if (!is_array($searchList)) {
        $searchList = array($searchList);
    }
    if (!is_array($replaceList)) {
        $replaceList = array($replaceList);
    }
    if (count($searchList) !== count($replaceList)) {
        throw new \RuntimeException('The search & replace parameters should have the same array size.');
    }
    $subjectPartList = explode('\\\\', $subject);
    foreach ($searchList as $search) {
        $subjectPartList = explodeRecursive('\\' . $search, $subjectPartList);
        $subjectPartList = explodeRecursive($search, $subjectPartList);
    }
    foreach (array_reverse($searchList) as $key => $search) {
        $replace = $replaceList[count($searchList) - $key - 1];
        $subjectPartList = implodeRecursive($replace, $subjectPartList);
        $subjectPartList = implodeRecursive($search, $subjectPartList);
    }
    return implode('\\', $subjectPartList);
}

function explodeRecursive($delimiter, $array)
{
    $result = array();
    foreach ($array as $item) {
        if (is_array($item)) {
            $result[] = explodeRecursive($delimiter, $item);
        } else {
            $result[] = explode($delimiter, $item);
        }
    }
    return $result;
}

function implodeRecursive($delimiter, $array)
{
    $result = array();
    if (is_array(reset($array))) {
        foreach ($array as $item) {
            $result[] = implodeRecursive($delimiter, $item);
        }
    } else {
        $result = implode($delimiter, $array);
    }
    return $result;
}